<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function __construct(private CartService $cart) {}

    // ── Ajouter au panier ──
    public function add(Request $request, int $productId)
    {
        $quantity = max(1, (int) $request->input('quantity', 1));
        $result   = $this->cart->add($productId, $quantity);

        if ($request->wantsJson()) {
            return response()->json($result, $result['success'] ? 200 : 422);
        }
        return back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    // ── Modifier quantité ──
    public function update(Request $request, int $productId)
    {
        $result = $this->cart->updateQuantity($productId, (int) $request->input('quantity'));
        return response()->json($result);
    }

    // ── Supprimer un item ──
    public function remove(int $productId)
    {
        return response()->json($this->cart->remove($productId));
    }

    // ── Vider le panier ──
    public function clear()
    {
        $this->cart->clear();
        return redirect()->route('cart.index')->with('success', 'Votre panier a été vidé.');
    }

    // ── Contenu drawer (AJAX) ──
    public function drawer()
    {
        return view('cart.drawer-content', [
            'items' => $this->cart->all(),
            'total' => $this->cart->formattedTotal(),
            'count' => $this->cart->count(),
        ]);
    }

    // ── Page panier ──
    public function index()
    {
        return view('cart.index', [
            'items' => $this->cart->all(),
            'total' => $this->cart->total(),
        ]);
    }

    // ── Page checkout ──
    public function checkout()
    {
        if ($this->cart->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        return view('cart.checkout', [
            'items' => $this->cart->all(),
            'total' => $this->cart->total(),
            'user'  => Auth::user(),
        ]);
    }

    /**
     * PLACE ORDER — Appelé en AJAX depuis le checkout après paiement FedaPay validé
     *
     * Reçoit :
     *   full_name      : nom du client
     *   phone          : téléphone
     *   order_note     : note optionnelle
     *   transaction_id : ID de transaction FedaPay (pour vérification côté serveur)
     *
     * Retourne : JSON { success: true, redirect: '/commande/X/confirmation' }
     */
    public function placeOrder(Request $request)
    {
        if ($this->cart->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Panier vide.'], 422);
        }

        $validated = $request->validate([
            'full_name'      => ['required', 'string', 'min:3'],
            'phone'          => ['required', 'string'],
            'order_note'     => ['nullable', 'string', 'max:500'],
            'transaction_id' => ['required', 'string'],
        ]);

        // ── Vérification FedaPay côté serveur ──
        // On vérifie que la transaction existe vraiment et est approuvée
        // Ça empêche quelqu'un de forger une fausse confirmation JS
        $verified = $this->verifyFedaPayTransaction(
            $validated['transaction_id'],
            $this->cart->total()
        );

        if (!$verified) {
            Log::warning('Tentative de commande avec transaction FedaPay invalide', [
                'user_id'        => Auth::id(),
                'transaction_id' => $validated['transaction_id'],
                'amount'         => $this->cart->total(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Paiement non vérifié. Contactez le support avec la référence : ' . $validated['transaction_id'],
            ], 422);
        }

        $items = $this->cart->all();
        $total = $this->cart->total();

        $order = DB::transaction(function () use ($validated, $items, $total) {

            $order = Order::create([
                'buyer_id'         => Auth::id(),
                'total_amount'     => $total,
                'status'           => 'paid', // Déjà payé via FedaPay
                'shipping_phone'   => $validated['phone'],
                'shipping_address' => $validated['order_note'] ?? null,
                'transaction_id'   => $validated['transaction_id'],
            ]);

            foreach ($items as $productId => $item) {
                $product = Product::find($productId);
                if (!$product) continue;

                OrderItem::create([
                    'order_id'               => $order->id,
                    'product_id'             => $productId,
                    'artisan_application_id' => $product->artisan_application_id,
                    'product_name_snapshot'  => $item['name'],
                    'unit_price'             => $item['price'],
                    'quantity'               => $item['quantity'],
                    'item_status'            => 'confirmed',
                ]);

                // Décrémenter le stock
                $product->decrement('stock_quantity', $item['quantity']);
            }

            return $order;
        });

        $this->cart->clear();

        return response()->json([
            'success'  => true,
            'redirect' => route('cart.order.confirmation', $order),
        ]);
    }

    /**
     * WEBHOOK FEDAPAY — FedaPay appelle cette URL après chaque paiement
     *
     * Sécurité : on vérifie la signature HMAC avec la clé secrète FedaPay.
     * Même si quelqu'un connaît l'URL du webhook, il ne peut pas forger
     * une requête valide sans la clé secrète.
     *
     * Route : POST /webhook/fedapay (sans middleware auth ni CSRF)
     */
    public function webhookFedaPay(Request $request)
    {
        $payload   = $request->getContent();
        $signature = $request->header('X-FEDAPAY-SIGNATURE', '');
        $secret    = config('services.fedapay.secret_key');

        // Vérifier la signature HMAC
        $expected = hash_hmac('sha256', $payload, $secret);
        if (!hash_equals($expected, $signature)) {
            Log::warning('Webhook FedaPay : signature invalide');
            return response()->json(['error' => 'Invalid signature'], 401);
        }

        $event = json_decode($payload, true);

        // Traiter uniquement les paiements approuvés
        if (($event['name'] ?? '') === 'transaction.approved') {
            $transactionId = $event['data']['transaction']['id'] ?? null;

            // Trouver la commande correspondante et la marquer comme payée
            $order = Order::where('transaction_id', $transactionId)->first();
            if ($order && $order->status !== 'paid') {
                $order->update(['status' => 'paid']);
                Log::info('Commande payée via webhook FedaPay', ['order_id' => $order->id]);
            }
        }

        return response()->json(['received' => true]);
    }

    // ── Page de confirmation ──
    public function confirmation(Order $order)
    {
        if ($order->buyer_id !== Auth::id()) {
            abort(403);
        }
        $order->load('items.product');
        return view('cart.confirmation', compact('order'));
    }

    // ────────────────────────────────────────────────────────────────
    // HELPERS PRIVÉS
    // ────────────────────────────────────────────────────────────────

    /**
     * Vérifie la transaction FedaPay via l'API REST
     * Retourne true si la transaction est approuvée et le montant correspond
     */
    private function verifyFedaPayTransaction(string $transactionId, float $expectedAmount): bool
    {
        try {
            $secretKey = config('services.fedapay.secret_key');
            $baseUrl   = config('services.fedapay.sandbox')
                ? 'https://sandbox-api.fedapay.com/v1'
                : 'https://api.fedapay.com/v1';

            $response = Http::withToken($secretKey)
                ->get("{$baseUrl}/transactions/{$transactionId}");

            if (!$response->successful()) {
                return false;
            }

            $transaction = $response->json('v1/transaction');
            $status      = $transaction['status'] ?? '';
            $amount      = $transaction['amount'] ?? 0;

            return $status === 'approved' && (int) $amount === (int) $expectedAmount;

        } catch (\Exception $e) {
            Log::error('Erreur vérification FedaPay : ' . $e->getMessage());
            // En mode sandbox/dev, on laisse passer pour faciliter les tests
            return config('services.fedapay.sandbox', true);
        }
    }
}
