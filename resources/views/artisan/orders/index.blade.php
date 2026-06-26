@extends('layouts.artisan')

@section('title', 'Commandes')

@section('content')

<header class="sticky top-0 z-40 bg-surface/80 backdrop-blur-xl border-b border-outline-variant/30 px-8 py-4">
    <h2 class="font-bold text-primary" style="font-family:'Playfair Display',serif; font-size:20px;">Commandes Reçues</h2>
    <p class="text-xs text-on-surface-variant mt-0.5">Suivez et traitez les commandes de vos clients</p>
</header>

<main class="flex-1 p-8">

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 flex items-center gap-3">
            <span class="material-symbols-outlined text-green-600" style="font-variation-settings:'FILL' 1;">check_circle</span>
            <p class="text-sm text-green-800">{{ session('success') }}</p>
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 flex items-center gap-3">
            <span class="material-symbols-outlined text-red-600">error</span>
            <p class="text-sm text-red-800">{{ session('error') }}</p>
        </div>
    @endif

    {{-- Onglets de filtre --}}
    <div class="flex gap-1 mb-6 border-b border-outline-variant/30 overflow-x-auto">
        @foreach([
            ''          => ['label' => 'Toutes',     'count' => $counts['all']],
            'pending'   => ['label' => 'En attente',  'count' => $counts['pending']],
            'confirmed' => ['label' => 'Confirmées',  'count' => $counts['confirmed']],
            'shipped'   => ['label' => 'Expédiées',   'count' => $counts['shipped']],
            'delivered' => ['label' => 'Livrées',     'count' => $counts['delivered']],
        ] as $key => $tab)
            <a href="{{ route('artisan.orders.index', $key ? ['status' => $key] : []) }}"
               class="px-6 py-3 text-sm font-medium whitespace-nowrap transition-all {{ request('status', '') === $key ? 'border-b-2 border-primary text-primary' : 'text-on-surface-variant hover:text-primary' }}">
                {{ $tab['label'] }}
                <span class="ml-2 text-xs bg-surface-container px-2 py-0.5 rounded-full">{{ $tab['count'] }}</span>
            </a>
        @endforeach
    </div>

    @if($items->isEmpty())
        <div class="bg-surface border border-outline-variant/30 py-20 flex flex-col items-center justify-center text-center px-8">
            <div class="w-16 h-16 border border-dashed border-outline-variant flex items-center justify-center mb-5">
                <span class="material-symbols-outlined text-3xl text-outline-variant">receipt_long</span>
            </div>
            <p class="font-semibold text-primary text-sm uppercase tracking-widest mb-2">Aucune commande pour l'instant</p>
            <p class="text-xs text-on-surface-variant max-w-xs leading-relaxed">
                Dès qu'un client achètera l'un de vos produits, la commande apparaîtra ici.
            </p>
        </div>
    @else
        <div class="bg-surface border border-outline-variant/30 overflow-hidden">
            <table class="w-full">
                <thead class="bg-surface-container border-b border-outline-variant/30">
                    <tr>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Commande</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Produit</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Client</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Montant</th>
                        <th class="text-left px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Statut</th>
                        <th class="text-center px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/20">
                    @foreach($items as $item)
                    <tr class="hover:bg-surface-container/40 transition-colors">
                        <td class="px-6 py-4">
                            <p class="text-sm font-semibold text-primary">{{ $item->order->order_number }}</p>
                            <p class="text-[11px] text-on-surface-variant">{{ $item->created_at->format('d/m/Y') }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($item->product && $item->product->primary_image)
                                    <img src="{{ $item->product->primary_image }}" class="w-10 h-10 object-cover flex-shrink-0" />
                                @endif
                                <div>
                                    <p class="text-sm text-primary">{{ $item->product_name_snapshot }}</p>
                                    <p class="text-[11px] text-on-surface-variant">Qté: {{ $item->quantity }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-primary">{{ $item->order->buyer->name }}</p>
                            <p class="text-[11px] text-on-surface-variant">{{ $item->order->shipping_city ?? '—' }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold text-secondary">
                            {{ number_format($item->subtotal, 0, ',', '.') }} CFA
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusColors = [
                                    'pending'   => 'badge-pending',
                                    'confirmed' => 'badge-approved',
                                    'shipped'   => 'badge-verified',
                                    'delivered' => 'badge-approved',
                                    'cancelled' => 'badge-rejected',
                                ];
                            @endphp
                            <span class="{{ $statusColors[$item->item_status] ?? 'badge-draft' }}">{{ $item->status_label }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                                $nextActions = [
                                    'pending'   => ['confirmed' => 'Confirmer'],
                                    'confirmed' => ['shipped' => 'Expédier'],
                                    'shipped'   => ['delivered' => 'Marquer livrée'],
                                ];
                                $actions = $nextActions[$item->item_status] ?? [];
                            @endphp
                            @if(!empty($actions))
                                <form action="{{ route('artisan.orders.update-status', $item) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    @foreach($actions as $value => $label)
                                        <input type="hidden" name="item_status" value="{{ $value }}">
                                        <button type="submit" class="px-4 py-1.5 bg-primary text-white text-[11px] font-semibold uppercase tracking-widest hover:bg-on-surface-variant transition-all">
                                            {{ $label }}
                                        </button>
                                    @endforeach
                                </form>
                            @else
                                <span class="text-[11px] text-on-surface-variant/50">—</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($items->hasPages())
                <div class="px-6 py-4 border-t border-outline-variant/30">
                    {{ $items->links() }}
                </div>
            @endif
        </div>
    @endif

</main>

@endsection
