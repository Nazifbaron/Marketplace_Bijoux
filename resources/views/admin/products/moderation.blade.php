<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Modération Produits | Admin L'Éclat du Bénin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = { theme: { extend: {
            colors: {
                "primary":"#012F24","secondary":"#735c00","background":"#faf9f6","surface":"#ffffff",
                "surface-container":"#efeeeb","surface-container-low":"#f4f3f1","outline-variant":"#c4c7c7",
                "on-surface-variant":"#444748","on-surface":"#1a1c1a","secondary-container":"#fed65b",
                "secondary-fixed":"#ffe088","error":"#ba1a1a","error-container":"#ffdad6","outline":"#747878",
            },
            fontFamily: { "sans":["Montserrat","sans-serif"] }
        }}}
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24; }
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 2px 10px; font-size: 10px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; }
        .badge-pending { background: #fff8e1; color: #735c00; border: 1px solid #ffe088; }
        .badge-approved { background: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; }
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
        <a href="{{ route('admin.products.moderation') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium bg-white/10 text-white transition-all">
            <span class="material-symbols-outlined text-[20px]">inventory_2</span> Modération Produits
            @if($counts['pending_review'] > 0)
                <span class="ml-auto bg-secondary-container text-secondary text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $counts['pending_review'] }}</span>
            @endif
        </a>
        <a href="{{ route('admin.products.verification') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-white/60 hover:text-white hover:bg-white/5 transition-all">
            <span class="material-symbols-outlined text-[20px]">verified</span> Vérification Badges
        </a>
    </nav>
</aside>

<div class="ml-64">
    <header class="bg-surface border-b border-outline-variant/30 px-8 py-5 flex items-center justify-between sticky top-0 z-40">
        <div>
            <h2 class="text-xl font-bold text-primary font-serif">Modération des Produits</h2>
            <p class="text-sm text-on-surface-variant mt-0.5">Validez les fiches produits avant publication sur le site</p>
        </div>
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
                'pending_review' => ['label' => 'En attente', 'count' => $counts['pending_review']],
                'published'      => ['label' => 'Publiés',    'count' => $counts['published']],
                'rejected'       => ['label' => 'Rejetés',    'count' => $counts['rejected']],
                'all'            => ['label' => 'Tous',       'count' => $counts['pending_review'] + $counts['published'] + $counts['rejected']],
            ] as $key => $tab)
                <a href="{{ route('admin.products.moderation', ['status' => $key]) }}"
                   class="px-6 py-3 text-sm font-medium transition-all {{ $status === $key ? 'border-b-2 border-primary text-primary' : 'text-on-surface-variant hover:text-primary' }}">
                    {{ $tab['label'] }}
                    <span class="ml-2 text-xs bg-surface-container px-2 py-0.5 rounded-full">{{ $tab['count'] }}</span>
                </a>
            @endforeach
        </div>

        @if($products->isEmpty())
            <div class="bg-surface border border-outline-variant/30 py-20 text-center">
                <span class="material-symbols-outlined text-6xl text-outline-variant block mb-4">inventory_2</span>
                <p class="text-on-surface-variant">Aucun produit dans cette catégorie.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="bg-surface border border-outline-variant/30 overflow-hidden">
                        <div class="aspect-[4/3] bg-surface-container-low relative">
                            @php $primaryImg = $product->images->firstWhere('is_primary', true) ?? $product->images->first(); @endphp
                            @if($primaryImg)
                                <img src="{{ $primaryImg->url }}" class="w-full h-full object-cover" />
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-4xl text-outline-variant">image</span>
                                </div>
                            @endif
                            <div class="absolute top-3 left-3">
                                @if($product->moderation_status === 'pending_review')
                                    <span class="badge badge-pending">En attente</span>
                                @elseif($product->moderation_status === 'published')
                                    <span class="badge badge-approved">Publié</span>
                                @else
                                    <span class="badge badge-rejected">Rejeté</span>
                                @endif
                            </div>
                        </div>
                        <div class="p-5">
                            <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">{{ $product->category->name ?? '—' }}</p>
                            <h3 class="font-semibold text-primary text-sm my-1">{{ $product->name }}</h3>
                            <p class="text-xs text-on-surface-variant mb-2">
                                Par <strong>{{ $product->vendor->shop_name ?? $product->vendor->full_name }}</strong>
                            </p>
                            <p class="text-sm font-bold text-secondary mb-3">{{ number_format($product->price, 0, ',', '.') }} CFA</p>
                            <p class="text-xs text-on-surface-variant leading-relaxed mb-4 line-clamp-3">{{ $product->description }}</p>

                            @if($product->moderation_status === 'pending_review')
                                <div class="flex gap-2">
                                    <form action="{{ route('admin.products.publish', $product) }}" method="POST" class="flex-1">
                                        @csrf
                                        <button type="submit" class="w-full py-2 bg-green-700 text-white text-xs font-semibold uppercase tracking-widest hover:bg-green-800 transition-all">
                                            Publier
                                        </button>
                                    </form>
                                    <button onclick="openRejectModal({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                        class="flex-1 py-2 border border-error text-error text-xs font-semibold uppercase tracking-widest hover:bg-error-container/30 transition-all">
                                        Rejeter
                                    </button>
                                </div>
                            @elseif($product->moderation_status === 'rejected' && $product->moderation_notes)
                                <div class="p-2 bg-error-container/30 text-[11px] text-error">
                                    Motif: {{ $product->moderation_notes }}
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">{{ $products->appends(['status' => $status])->links() }}</div>
        @endif

    </main>
</div>

{{-- Modale de rejet --}}
<div class="modal-overlay hidden" id="reject-modal">
    <div class="bg-surface w-full max-w-md p-8">
        <div class="text-center mb-6">
            <span class="material-symbols-outlined text-5xl text-error block mb-4">cancel</span>
            <h3 class="text-lg font-bold text-primary">Rejeter ce produit</h3>
            <p class="text-sm text-on-surface-variant mt-2">Vous allez refuser « <strong id="reject-product-name">—</strong> ».</p>
        </div>
        <form method="POST" id="reject-form">
            @csrf
            <div class="mb-6">
                <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Motif du rejet <span class="text-error">*</span></label>
                <textarea name="moderation_notes" rows="4" required id="reject-notes"
                    placeholder="Photos insuffisantes, description trop courte, prix incohérent..."
                    class="w-full border border-outline-variant px-4 py-3 text-sm focus:outline-none focus:border-error resize-none"></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeRejectModal()" class="flex-1 py-3 border border-outline-variant text-sm text-on-surface-variant hover:text-primary transition-all">Annuler</button>
                <button type="submit" class="flex-1 py-3 bg-error text-white text-sm font-semibold uppercase tracking-widest hover:bg-red-800 transition-all">Confirmer le rejet</button>
            </div>
        </form>
    </div>
</div>

<script>
function openRejectModal(id, name) {
    document.getElementById('reject-product-name').textContent = name;
    document.getElementById('reject-form').action = `/admin/produits/${id}/rejeter`;
    document.getElementById('reject-modal').classList.remove('hidden');
    setTimeout(() => document.getElementById('reject-notes').focus(), 100);
}
function closeRejectModal() {
    document.getElementById('reject-modal').classList.add('hidden');
}
</script>

</body>
</html>
