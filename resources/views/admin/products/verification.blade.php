<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Vérification Produits | Admin L'Éclat du Bénin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = { theme: { extend: {
            colors: {
                "primary":"#012F24","secondary":"#735c00","background":"#faf9f6","surface":"#ffffff",
                "surface-container":"#efeeeb","outline-variant":"#c4c7c7","on-surface-variant":"#444748",
                "on-surface":"#1a1c1a","secondary-container":"#fed65b","secondary-fixed":"#ffe088",
                "error":"#ba1a1a","error-container":"#ffdad6","outline":"#747878",
            },
            fontFamily: { "sans":["Montserrat","sans-serif"] }
        }}}
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24; }
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 2px 10px; font-size: 10px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; }
        .badge-pending  { background: #fff8e1; color: #735c00; border: 1px solid #ffe088; }
        .badge-verified { background: #fff8e1; color: #735c00; border: 1px solid #e9c349; }
        .badge-rejected { background: #ffdad6; color: #ba1a1a; border: 1px solid #ffb4ab; }
        .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 100; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .modal-overlay.hidden { display: none; }
    </style>
</head>
<body class="bg-background text-on-surface min-h-screen">

<aside class="fixed left-0 top-0 h-full w-64 bg-primary text-white z-50 flex flex-col">
    <div class="p-6 border-b border-white/10">
        <h1 class="font-bold text-sm uppercase tracking-widest">L'ÉCLAT DU BÉNIN</h1>
        <p class="text-white/40 text-xs mt-1 tracking-widest uppercase">Administration</p>
    </div>
    <nav class="flex-1 p-4 space-y-1">
        <a href="{{ route('admin.artisans.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-white/60 hover:text-white hover:bg-white/5 transition-all">
            <span class="material-symbols-outlined text-[20px]">storefront</span> Artisans
        </a>
        <a href="{{ route('admin.products.moderation') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-white/60 hover:text-white hover:bg-white/5 transition-all">
            <span class="material-symbols-outlined text-[20px]">inventory_2</span> Modération Produits
        </a>
        <a href="{{ route('admin.products.verification') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium bg-white/10 text-white transition-all">
            <span class="material-symbols-outlined text-[20px]">verified</span> Vérification Badges
            @if($counts['pending'] > 0)
                <span class="ml-auto bg-secondary-container text-secondary text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $counts['pending'] }}</span>
            @endif
        </a>
    </nav>
</aside>

<div class="ml-64">
    <header class="bg-surface border-b border-outline-variant/30 px-8 py-5 sticky top-0 z-40">
        <h2 class="text-xl font-bold text-primary font-serif">Vérification d'Authenticité</h2>
        <p class="text-sm text-on-surface-variant mt-0.5">Examinez les demandes de badge "Produit Vérifié" — gage de confiance pour les acheteurs</p>
    </header>

    <main class="p-8">

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 flex items-center gap-3">
                <span class="material-symbols-outlined text-green-600" style="font-variation-settings:'FILL' 1;">check_circle</span>
                <p class="text-sm text-green-800">{{ session('success') }}</p>
            </div>
        @endif

        <div class="flex gap-1 mb-6 border-b border-outline-variant/30">
            @foreach([
                'pending'    => ['label' => 'Demandes en attente', 'count' => $counts['pending']],
                'verified'   => ['label' => 'Vérifiés',            'count' => $counts['verified']],
                'rejected'   => ['label' => 'Refusés',             'count' => $counts['rejected']],
                'all'        => ['label' => 'Tous',                'count' => array_sum($counts)],
            ] as $key => $tab)
                <a href="{{ route('admin.products.verification', ['status' => $key]) }}"
                   class="px-6 py-3 text-sm font-medium transition-all {{ $status === $key ? 'border-b-2 border-primary text-primary' : 'text-on-surface-variant hover:text-primary' }}">
                    {{ $tab['label'] }}
                    <span class="ml-2 text-xs bg-surface-container px-2 py-0.5 rounded-full">{{ $tab['count'] }}</span>
                </a>
            @endforeach
        </div>

        @if($products->isEmpty())
            <div class="bg-surface border border-outline-variant/30 py-20 text-center">
                <span class="material-symbols-outlined text-6xl text-outline-variant block mb-4">verified</span>
                <p class="text-on-surface-variant">Aucune demande de vérification dans cette catégorie.</p>
            </div>
        @else
            <div class="bg-surface border border-outline-variant/30 overflow-hidden">
                <table class="w-full">
                    <thead class="bg-surface-container border-b border-outline-variant/30">
                        <tr>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Produit</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Vendeur</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Prix</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Statut</th>
                            <th class="text-center px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20">
                        @foreach($products as $product)
                        <tr class="hover:bg-surface-container/40 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @php $img = $product->images->first(); @endphp
                                    @if($img)
                                        <img src="{{ $img->url }}" class="w-10 h-10 object-cover flex-shrink-0" />
                                    @endif
                                    <p class="text-sm font-semibold text-primary">{{ $product->name }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-on-surface-variant">
                                {{ $product->vendor->shop_name ?? $product->vendor->full_name }}
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold text-secondary">
                                {{ number_format($product->price, 0, ',', '.') }} CFA
                            </td>
                            <td class="px-6 py-4">
                                @if($product->verification_status === 'pending')
                                    <span class="badge badge-pending">En attente</span>
                                @elseif($product->verification_status === 'verified')
                                    <span class="badge badge-verified">
                                        <span class="material-symbols-outlined text-[12px]" style="font-variation-settings:'FILL' 1;">verified</span> Vérifié
                                    </span>
                                @elseif($product->verification_status === 'rejected')
                                    <span class="badge badge-rejected">Refusé</span>
                                @else
                                    <span class="text-xs text-on-surface-variant">Non demandé</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($product->verification_status === 'pending')
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="openVerifyModal({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                            class="px-4 py-1.5 bg-secondary-fixed text-primary text-[11px] font-semibold uppercase tracking-widest hover:bg-secondary-fixed/80 transition-all">
                                            Approuver
                                        </button>
                                        <button onclick="openVerifyRejectModal({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                            class="px-4 py-1.5 border border-error text-error text-[11px] font-semibold uppercase tracking-widest hover:bg-error-container/30 transition-all">
                                            Refuser
                                        </button>
                                    </div>
                                @else
                                    <span class="text-[11px] text-on-surface-variant/50">—</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($products->hasPages())
                    <div class="px-6 py-4 border-t border-outline-variant/30">{{ $products->appends(['status' => $status])->links() }}</div>
                @endif
            </div>
        @endif

    </main>
</div>

{{-- Modale d'approbation --}}
<div class="modal-overlay hidden" id="verify-modal">
    <div class="bg-surface w-full max-w-md p-8">
        <div class="text-center mb-6">
            <span class="material-symbols-outlined text-5xl text-secondary block mb-4" style="font-variation-settings:'FILL' 1;">verified</span>
            <h3 class="text-lg font-bold text-primary">Approuver la vérification</h3>
            <p class="text-sm text-on-surface-variant mt-2">« <strong id="verify-product-name">—</strong> » obtiendra le badge "Produit Vérifié".</p>
        </div>
        <form method="POST" id="verify-form">
            @csrf
            <div class="mb-6">
                <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Note interne (optionnel)</label>
                <textarea name="verification_notes" rows="3" placeholder="Authenticité confirmée par photo des matériaux..."
                    class="w-full border border-outline-variant px-4 py-3 text-sm focus:outline-none focus:border-secondary resize-none"></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeModal('verify-modal')" class="flex-1 py-3 border border-outline-variant text-sm text-on-surface-variant hover:text-primary transition-all">Annuler</button>
                <button type="submit" class="flex-1 py-3 bg-secondary text-white text-sm font-semibold uppercase tracking-widest hover:bg-secondary/90 transition-all">Confirmer</button>
            </div>
        </form>
    </div>
</div>

{{-- Modale de refus --}}
<div class="modal-overlay hidden" id="verify-reject-modal">
    <div class="bg-surface w-full max-w-md p-8">
        <div class="text-center mb-6">
            <span class="material-symbols-outlined text-5xl text-error block mb-4">cancel</span>
            <h3 class="text-lg font-bold text-primary">Refuser la vérification</h3>
            <p class="text-sm text-on-surface-variant mt-2">« <strong id="verify-reject-product-name">—</strong> » restera visible mais sans badge.</p>
        </div>
        <form method="POST" id="verify-reject-form">
            @csrf
            <div class="mb-6">
                <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Motif du refus <span class="text-error">*</span></label>
                <textarea name="verification_notes" rows="3" required id="verify-reject-notes"
                    placeholder="Photos insuffisantes pour confirmer l'authenticité des matériaux..."
                    class="w-full border border-outline-variant px-4 py-3 text-sm focus:outline-none focus:border-error resize-none"></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeModal('verify-reject-modal')" class="flex-1 py-3 border border-outline-variant text-sm text-on-surface-variant hover:text-primary transition-all">Annuler</button>
                <button type="submit" class="flex-1 py-3 bg-error text-white text-sm font-semibold uppercase tracking-widest hover:bg-red-800 transition-all">Confirmer le refus</button>
            </div>
        </form>
    </div>
</div>

<script>
function openVerifyModal(id, name) {
    document.getElementById('verify-product-name').textContent = name;
    document.getElementById('verify-form').action = `/admin/produits/${id}/verifier`;
    document.getElementById('verify-modal').classList.remove('hidden');
}
function openVerifyRejectModal(id, name) {
    document.getElementById('verify-reject-product-name').textContent = name;
    document.getElementById('verify-reject-form').action = `/admin/produits/${id}/refuser-verification`;
    document.getElementById('verify-reject-modal').classList.remove('hidden');
    setTimeout(() => document.getElementById('verify-reject-notes').focus(), 100);
}
function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
}
</script>

</body>
</html>
