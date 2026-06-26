<x-collection>
    {{-- ── HEADER ── --}}
    <header class="mb-16 text-center md:text-left">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
            <div>
                <span class="font-label-caps text-label-caps text-secondary mb-4 block">ARTISANAT SÉLECTIONNÉ</span>
                <h2 class="font-display-lg text-display-lg-mobile md:text-display-lg">La Collection Heritage</h2>
            </div>
            <p class="max-w-md text-on-surface-variant font-body-md opacity-80 italic">
                Un hommage au savoir-faire ancestral du Dahomey, où chaque point de couture et chaque grain d'or racontent l'histoire de la souveraineté béninoise.
            </p>
        </div>
        <div class="h-px w-full bg-outline-variant/30 mt-12"></div>
    </header>

    {{-- ── FILTRES DYNAMIQUES PAR CATÉGORIE ── --}}
    <section class="flex flex-col md:flex-row gap-8 mb-12">
        <div class="flex-1 flex flex-wrap gap-4 items-center">
            <span class="font-label-caps text-label-caps text-on-surface-variant mr-4">FILTRER PAR:</span>

            <a href="{{ route('collection.index') }}"
               class="px-6 py-2 border font-label-caps text-label-caps transition-all {{ !request('category') ? 'border-secondary text-secondary bg-secondary/5' : 'border-outline-variant text-on-surface-variant hover:border-secondary' }}">
                TOUTES LES PIÈCES
            </a>

            @foreach($categories as $cat)
                <a href="{{ route('collection.index', ['category' => $cat->slug]) }}"
                   class="px-6 py-2 border font-label-caps text-label-caps transition-all {{ request('category') === $cat->slug ? 'border-secondary text-secondary bg-secondary/5' : 'border-outline-variant text-on-surface-variant hover:border-secondary' }}">
                    {{ strtoupper($cat->name) }}
                </a>
            @endforeach
        </div>
    </section>

    {{-- ── GRILLE PRODUITS (tous vendeurs confondus) ── --}}
    @if($products->isEmpty())
        <div class="text-center py-20">
            <span class="material-symbols-outlined text-6xl text-outline-variant block mb-4">inventory_2</span>
            <p class="font-headline-md text-headline-md text-primary mb-2">Aucune pièce disponible pour le moment</p>
            <p class="font-body-md text-body-md text-on-surface-variant">Nos artisans enrichissent la collection chaque semaine.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-20 gap-x-gutter">
            @foreach($products as $product)
                @include('collection.partials.product-card', ['product' => $product])
            @endforeach
        </div>

        <div class="mt-16 flex justify-center">
            {{ $products->links() }}
        </div>
    @endif
</x-collection>
