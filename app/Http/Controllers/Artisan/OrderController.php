<?php

namespace App\Http\Controllers\Artisan;

use App\Http\Controllers\Controller;
use App\Models\ArtisanApplication;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        $application = ArtisanApplication::where('user_id', Auth::id())->firstOrFail();

        $query = OrderItem::where('artisan_application_id', $application->id)
            ->with(['order.buyer', 'product.images'])
            ->orderBy('created_at', 'desc');

        if ($status = $request->get('status')) {
            $query->where('item_status', $status);
        }

        $items = $query->paginate(15);

        $counts = [
            'all'       => OrderItem::where('artisan_application_id', $application->id)->count(),
            'pending'   => OrderItem::where('artisan_application_id', $application->id)->where('item_status', 'pending')->count(),
            'confirmed' => OrderItem::where('artisan_application_id', $application->id)->where('item_status', 'confirmed')->count(),
            'shipped'   => OrderItem::where('artisan_application_id', $application->id)->where('item_status', 'shipped')->count(),
            'delivered' => OrderItem::where('artisan_application_id', $application->id)->where('item_status', 'delivered')->count(),
        ];

        return view('artisan.orders.index', compact('items', 'counts'));
    }

   
    public function updateStatus(Request $request, OrderItem $item)
    {
        $application = ArtisanApplication::where('user_id', Auth::id())->firstOrFail();

        if ($item->artisan_application_id !== $application->id) {
            abort(403);
        }

        $validated = $request->validate([
            'item_status' => ['required', 'in:confirmed,shipped,delivered,cancelled'],
        ]);

        // Empêcher de revenir en arrière dans le workflow (sécurité logique)
        $allowedTransitions = [
            'pending'   => ['confirmed', 'cancelled'],
            'confirmed' => ['shipped', 'cancelled'],
            'shipped'   => ['delivered'],
        ];

        $current = $item->item_status;
        if (!isset($allowedTransitions[$current]) || !in_array($validated['item_status'], $allowedTransitions[$current])) {
            return back()->with('error', "Impossible de passer de « {$item->status_label} » à ce statut directement.");
        }

        $item->update(['item_status' => $validated['item_status']]);

        return back()->with('success', 'Statut de la commande mis à jour.');
    }
}
