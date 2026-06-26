@extends('layouts.artisan')

@section('title', 'Mes Produits')

@section('extra-styles')
    .product-card { transition: transform 0.15s ease, box-shadow 0.15s ease; }
    .product-card:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.06); }
@endsection

@section('content')

<header class="sticky top-0 z-40 bg-surface/80 backdrop-blur-xl border-b border-outline-variant/30 px-8 py-4 flex items-center justify-between">
    <div>
        <h2 class="font-bold text-primary" style="font-family:'Playfair Display',serif; font-size:20px;">Mes Produits</h2>
        <p class="text-xs text-on-surface-variant mt-0.5">Gérez votre catalogue et suivez le statut de vos articles</p>
    </div>
    <a href="{{ route('artisan.products.create') }}" class="flex items-center gap-2 bg-primary text-white px-5 py-2.5 text-xs font-semibold uppercase tracking-widest hover:bg-on-surface-variant transition-all">
        <span class="material-symbols-outlined text-[16px]">add</span>
        Ajouter un Produit
    </a>
</header>

<main class="flex-1 p-8">

    {{-- Messages flash --}}
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

    {{-- ── ONGLETS DE FILTRE ── --}}
    <div class="flex gap-1 mb-6 border-b border-outline-variant/30">
        @foreach([
            'all'       => ['label' => 'Tous',        'count' => $counts['all']],
            'published' => ['label' => 'Publiés',      'count' => $counts['published']],
            'pending'   => ['label' => 'En attente',   'count' => $counts['pending']],
            'verified'  => ['label' => 'Vérifiés',     'count' => $counts['verified']],
        ] as $key => $tab)
            <a href="{{ route('artisan.products.index', $key !== 'all' ? ['filter' => $key] : []) }}"
               class="px-6 py-3 text-sm font-medium transition-all {{ ($filter ?? 'all') === $key ? 'border-b-2 border-primary text-primary' : 'text-on-surface-variant hover:text-primary' }}">
                {{ $tab['label'] }}
                <span class="ml-2 text-xs bg-surface-container px-2 py-0.5 rounded-full">{{ $tab['count'] }}</span>
            </a>
        @endforeach
    </div>

    @if($products->isEmpty())
        {{-- État vide --}}
        <div class="bg-surface border border-outline-variant/30 py-20 flex flex-col items-center justify-center text-center px-8">
            <div class="w-16 h-16 border border-dashed border-outline-variant flex items-center justify-center mb-5">
                <span class="material-symbols-outlined text-3xl text-outline-variant">inventory_2</span>
            </div>
            <p class="font-semibold text-primary text-sm uppercase tracking-widest mb-2">Aucun produit dans cette catégorie</p>
            <p class="text-xs text-on-surface-variant max-w-xs leading-relaxed mb-6">
                Présentez vos créations artisanales à notre clientèle de prestige.
            </p>
            <a href="{{ route('artisan.products.create') }}" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 text-xs font-semibold uppercase tracking-widest hover:bg-on-surface-variant transition-all">
                <span class="material-symbols-outlined text-[16px]">add</span>
                Ajouter mon premier produit
            </a>
        </div>
    @else
        {{-- ── GRILLE PRODUITS ── --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="product-card bg-surface border border-outline-variant/30 overflow-hidden">

                    {{-- Image + badges superposés --}}
                    <div class="aspect-[4/3] bg-surface-container-low relative overflow-hidden">
                        @if($product->primary_image)
                            <img src="{{ $product->primary_image }}" class="w-full h-full object-cover" alt="{{ $product->name }}" />
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-4xl text-outline-variant">image</span>
                            </div>
                        @endif

                        {{-- Badge de modération (en haut à gauche) --}}
                        <div class="absolute top-3 left-3">
                            @if($product->moderation_status === 'published')
                                <span class="badge-approved">Publié</span>
                            @elseif($product->moderation_status === 'pending_review')
                                <span class="badge-pending">En revue</span>
                            @elseif($product->moderation_status === 'rejected')
                                <span class="badge-rejected">Rejeté</span>
                            @else
                                <span class="badge-draft">Brouillon</span>
                            @endif
                        </div>

                        {{-- Badge vérifié (en haut à droite) --}}
                        @if($product->is_verified)
                            <div class="absolute top-3 right-3">
                                <span class="badge-verified">
                                    <span class="material-symbols-outlined text-[12px]" style="font-variation-settings:'FILL' 1;">verified</span>
                                    Vérifié
                                </span>
                            </div>
                        @elseif($product->verification_status === 'pending')
                            <div class="absolute top-3 right-3">
                                <span class="badge-pending">
                                    <span class="material-symbols-outlined text-[12px]">hourglass_top</span>
                                    Vérif. en cours
                                </span>
                            </div>
                        @endif
                    </div>

                    {{-- Infos --}}
                    <div class="p-5">
                        <p class="text-[10px] text-on-surface-variant uppercase tracking-widest mb-1">{{ $product->category->name ?? '—' }}</p>
                        <h3 class="font-semibold text-primary text-sm mb-2 truncate" style="font-family:'Playfair Display',serif;">{{ $product->name }}</h3>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-bold text-secondary">{{ $product->formatted_price }}</span>
                            <span class="text-[11px] text-on-surface-variant">Stock: {{ $product->stock_quantity }}</span>
                        </div>

                        {{-- Si rejeté, afficher le motif --}}
                        @if($product->moderation_status === 'rejected' && $product->moderation_notes)
                            <div class="mb-3 p-2 bg-error-container/30 text-[11px] text-error">
                                Motif: {{ $product->moderation_notes }}
                            </div>
                        @endif

                        {{-- Actions --}}
                        <div class="flex items-center gap-2">
                            <a href="{{ route('artisan.products.edit', $product) }}"
                               class="flex-1 text-center py-2 border border-outline-variant text-xs font-semibold uppercase tracking-widest text-on-surface-variant hover:text-primary hover:border-primary transition-all">
                                Modifier
                            </a>

                            @if($product->canRequestVerification() && $product->isPublished())
                                <form action="{{ route('artisan.products.request-verification', $product) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full py-2 bg-secondary-fixed text-primary text-xs font-semibold uppercase tracking-widest hover:bg-secondary-fixed/80 transition-all"
                                        onclick="return confirm('Demander la vérification de ce produit ? Notre équipe examinera l\'authenticité.')">
                                        Vérifier
                                    </button>
                                </form>
                            @else
                                <button onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                    class="flex-1 py-2 border border-error/30 text-error text-xs font-semibold uppercase tracking-widest hover:bg-error-container/30 transition-all">
                                    Supprimer
                                </button>
                            @endif
                        </div>

                        @if($product->canRequestVerification() && $product->isPublished())
                            <button onclick="confirmDelete({{ $product->id }}, '{{ addslashes($product->name) }}')"
                                class="w-full mt-2 py-1.5 text-[11px] text-error/70 hover:text-error transition-all">
                                Supprimer ce produit
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @endif

</main>

{{-- Formulaire caché de suppression, soumis via JS --}}
<form id="delete-form" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

@endsection

@section('extra-scripts')
<script>
function confirmDelete(productId, productName) {
    if (confirm(`Supprimer définitivement « ${productName} » ? Cette action est irréversible.`)) {
        const form = document.getElementById('delete-form');
        form.action = `/artisan/produits/${productId}`;
        form.submit();
    }
}
</script>
@endsection
