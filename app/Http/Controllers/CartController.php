<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    public function __construct(private CartService $cart) {}

    // ----------------------------------------------------------------
    // ACTIONS AJAX
    // ----------------------------------------------------------------

    /**
     * Ajouter un produit au panier
     * Appelé depuis le bouton "Ajouter au panier" de la fiche produit
     */
    public function add(Request $request, int $productId)
    {
        $quantity = max(1, (int) $request->input('quantity', 1));
        $result   = $this->cart->add($productId, $quantity);

        if ($request->wantsJson()) {
            return response()->json($result, $result['success'] ? 200 : 422);
        }

        return back()->with($result['success'] ? 'success' : 'error', $result['message']);
    }

    /**
     * Modifier la quantité d'un item
     * Appelé depuis les boutons +/- dans le drawer et la page panier
     */
    public function update(Request $request, int $productId)
    {
        $quantity = (int) $request->input('quantity');
        $result   = $this->cart->updateQuantity($productId, $quantity);

        return response()->json($result);
    }

    /**
     * Supprimer un item du panier
     */
    public function remove(int $productId)
    {
        $result = $this->cart->remove($productId);
        return response()->json($result);
    }

    /**
     * Vider tout le panier
     */
    public function clear()
    {
        $this->cart->clear();
        return redirect()->route('cart.index')->with('success', 'Votre panier a été vidé.');
    }

    /**
     * Retourne le HTML du drawer (pour rechargement partiel)
     */
    public function drawer()
    {
        $items = $this->cart->all();
        $total = $this->cart->formattedTotal();
        $count = $this->cart->count();
        return view('cart.drawer-content', compact('items', 'total', 'count'));
    }

    // ----------------------------------------------------------------
    // PAGES
    // ----------------------------------------------------------------

    /**
     * Page panier complète — /panier
     */
    public function index()
    {
        $items = $this->cart->all();
        $total = $this->cart->total();
        return view('cart.index', compact('items', 'total'));
    }

    /**
     * Page checkout — /commander
     * Requiert d'être connecté (middleware auth dans les routes)
     */
    public function checkout()
    {
        if ($this->cart->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Votre panier est vide.');
        }

        $items = $this->cart->all();
        $total = $this->cart->total();
        $user  = Auth::user();

        return view('cart.checkout', compact('items', 'total', 'user'));
    }

    /**
     * Confirmer la commande
     * Crée les enregistrements Order + OrderItem en DB, vide le panier
     */
    public function placeOrder(Request $request)
    {
        if ($this->cart->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $validated = $request->validate([
            'full_name'       => ['required', 'string', 'min:3'],
            'phone'           => ['required', 'string'],
            'shipping_address'=> ['required', 'string', 'min:5'],
            'shipping_city'   => ['required', 'string'],
        ], [
            'full_name.required'        => 'Votre nom est obligatoire.',
            'phone.required'            => 'Votre téléphone est obligatoire.',
            'shipping_address.required' => 'L\'adresse de livraison est obligatoire.',
            'shipping_city.required'    => 'La ville est obligatoire.',
        ]);

        $items = $this->cart->all();
        $total = $this->cart->total();

        $order = DB::transaction(function () use ($validated, $items, $total) {

            // Créer la commande principale
            $order = Order::create([
                'buyer_id'         => Auth::id(),
                'total_amount'     => $total,
                'status'           => 'pending_payment',
                'shipping_address' => $validated['shipping_address'],
                'shipping_city'    => $validated['shipping_city'],
                'shipping_phone'   => $validated['phone'],
            ]);

            // Créer chaque ligne de commande
            foreach ($items as $productId => $item) {
                $product = \App\Models\Product::find($productId);
                if (!$product) continue;

                OrderItem::create([
                    'order_id'               => $order->id,
                    'product_id'             => $productId,
                    'artisan_application_id' => $product->artisan_application_id,
                    'product_name_snapshot'  => $item['name'],
                    'unit_price'             => $item['price'],
                    'quantity'               => $item['quantity'],
                    'item_status'            => 'pending',
                ]);

                // Décrémenter le stock
                $product->decrement('stock_quantity', $item['quantity']);
            }

            return $order;
        });

        // Vider le panier après commande passée
        $this->cart->clear();

        return redirect()
            ->route('cart.order.confirmation', $order)
            ->with('success', 'Commande confirmée avec succès !');
    }

    /**
     * Page de confirmation après commande
     */
    public function confirmation(Order $order)
    {
        // Sécurité : seul l'acheteur voit sa confirmation
        if ($order->buyer_id !== Auth::id()) {
            abort(403);
        }

        $order->load('items.product');
        return view('cart.confirmation', compact('order'));
    }
}
