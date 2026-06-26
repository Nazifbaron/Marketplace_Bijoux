<?php

namespace App\Http\Controllers\Artisan;

use App\Http\Controllers\Controller;
use App\Models\ArtisanApplication;
use App\Models\Conversation;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * DASHBOARD ARTISAN — VERSION AVEC VRAIES DONNÉES
 * =====================================================================
 * Remplace l'ancien controller qui avait des stats à zéro en dur.
 * Maintenant tout vient de vraies requêtes sur products/orders/conversations.
 * =====================================================================
 */
class ArtisanDashboardController extends Controller
{
    public function index()
    {
        $user        = Auth::user();
        $application = ArtisanApplication::where('user_id', $user->id)->firstOrFail();

        if (!$application->isApproved()) {
            return redirect()->route('artisan.onboarding.waiting');
        }

        // ── Statistiques réelles ──
        $stats = [
            'products'         => $application->products()->count(),
            'products_published' => $application->products()->where('moderation_status', 'published')->count(),
            'products_pending' => $application->products()->where('moderation_status', 'pending_review')->count(),
            'products_verified' => $application->products()->where('verification_status', 'verified')->count(),

            'views'   => $application->products()->sum('views_count'),

            'orders'           => $application->orderItems()->count(),
            'orders_pending'   => $application->orderItems()->where('item_status', 'pending')->count(),

            // Revenu du mois en cours (commandes livrées uniquement)
            'revenue' => $application->orderItems()
                ->where('item_status', 'delivered')
                ->whereMonth('created_at', now()->month)
                ->get()
                ->sum(fn($item) => $item->unit_price * $item->quantity),

            // Messages non lus tous fils confondus
            'unread_messages' => Conversation::where('artisan_application_id', $application->id)
                ->get()
                ->sum(fn($conv) => $conv->unreadCountFor($user->id)),
        ];

        // ── Derniers produits ajoutés (pour la liste rapide du dashboard) ──
        $recentProducts = $application->products()
            ->with('images', 'category')
            ->orderByDesc('created_at')
            ->limit(4)
            ->get();

        // ── Dernières commandes reçues ──
        $recentOrders = OrderItem::where('artisan_application_id', $application->id)
            ->with('order.buyer', 'product')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        // ── Dernières conversations ──
        $recentConversations = Conversation::where('artisan_application_id', $application->id)
            ->with('buyer', 'latestMessage')
            ->orderByDesc('last_message_at')
            ->limit(4)
            ->get();

        // ── Calcul de la complétion du profil (pour la barre de progression) ──
        $completionSteps = [
            'profile_created'  => true, // toujours vrai à ce stade
            'shop_configured'  => true,
            'first_product'    => $stats['products'] > 0,
            'cover_photo'      => false, // à implémenter si tu ajoutes une photo de couverture boutique
        ];
        $completionPct = round((array_sum($completionSteps) / count($completionSteps)) * 100);

        return view('artisan.dashboard', compact(
            'application', 'stats', 'recentProducts', 'recentOrders',
            'recentConversations', 'completionPct'
        ));
    }
}
