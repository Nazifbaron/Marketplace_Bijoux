<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * CONTROLLER ADMIN : MODÉRATION & VÉRIFICATION DES PRODUITS
 * =====================================================================
 * Deux responsabilités bien séparées, comme on l'a établi :
 *
 * 1. MODÉRATION (publier/rejeter) — décide si le produit est visible
 *    sur le site. Tout nouveau produit attend ici avant publication.
 *
 * 2. VÉRIFICATION (badge doré) — décide si le produit affiche le badge
 *    de confiance, façon Alibaba. Optionnel, demandé par le vendeur.
 * =====================================================================
 */
class AdminProductController extends Controller
{
    /**
     * Liste des produits en attente de MODÉRATION (nouveaux produits)
     */
    public function moderationQueue(Request $request)
    {
        $status = $request->get('status', 'pending_review');

        $query = Product::with(['vendor', 'category', 'images'])
            ->orderBy('created_at', 'desc');

        if ($status !== 'all') {
            $query->where('moderation_status', $status);
        }

        $products = $query->paginate(20);

        $counts = [
            'pending_review' => Product::where('moderation_status', 'pending_review')->count(),
            'published'      => Product::where('moderation_status', 'published')->count(),
            'rejected'       => Product::where('moderation_status', 'rejected')->count(),
        ];

        return view('admin.products.moderation', compact('products', 'status', 'counts'));
    }

    /**
     * Liste des produits en attente de VÉRIFICATION D'AUTHENTICITÉ
     */
    public function verificationQueue(Request $request)
    {
        $status = $request->get('status', 'pending');

        $query = Product::with(['vendor', 'category', 'images'])
            ->orderBy('created_at', 'desc');

        if ($status !== 'all') {
            $query->where('verification_status', $status);
        }

        $products = $query->paginate(20);

        $counts = [
            'pending'    => Product::where('verification_status', 'pending')->count(),
            'verified'   => Product::where('verification_status', 'verified')->count(),
            'rejected'   => Product::where('verification_status', 'rejected')->count(),
            'unverified' => Product::where('verification_status', 'unverified')->count(),
        ];

        return view('admin.products.verification', compact('products', 'status', 'counts'));
    }

    /**
     * Publie un produit (le rend visible sur le site)
     */
    public function publish(Product $product)
    {
        $product->update([
            'moderation_status' => 'published',
            'moderation_notes'  => null,
        ]);

        return back()->with('success', "« {$product->name} » est maintenant visible sur le site.");
    }

    /**
     * Rejette un produit (fiche incorrecte, contenu interdit...)
     */
    public function rejectModeration(Request $request, Product $product)
    {
        $validated = $request->validate([
            'moderation_notes' => ['required', 'string', 'min:10', 'max:1000'],
        ], [
            'moderation_notes.required' => 'Merci d\'indiquer la raison du rejet.',
        ]);

        $product->update([
            'moderation_status' => 'rejected',
            'moderation_notes'  => $validated['moderation_notes'],
        ]);

        return back()->with('success', "« {$product->name} » a été rejeté. Le vendeur verra le motif.");
    }

    /**
     * Approuve la demande de vérification → badge doré activé
     */
    public function approveVerification(Request $request, Product $product)
    {
        $validated = $request->validate([
            'verification_notes' => ['nullable', 'string', 'max:500'],
        ]);

        $product->update([
            'verification_status' => 'verified',
            'verification_notes'  => $validated['verification_notes'] ?? null,
            'verified_by'          => Auth::id(),
            'verified_at'          => now(),
        ]);

        return back()->with('success', "« {$product->name} » a obtenu le badge Produit Vérifié.");
    }

    /**
     * Refuse la demande de vérification (le produit reste visible, sans badge)
     */
    public function rejectVerification(Request $request, Product $product)
    {
        $validated = $request->validate([
            'verification_notes' => ['required', 'string', 'min:10', 'max:500'],
        ], [
            'verification_notes.required' => 'Merci d\'indiquer la raison du refus.',
        ]);

        $product->update([
            'verification_status' => 'rejected',
            'verification_notes'  => $validated['verification_notes'],
            'verified_by'          => Auth::id(),
            'verified_at'          => now(),
        ]);

        return back()->with('success', "Demande de vérification refusée pour « {$product->name} ».");
    }
}
