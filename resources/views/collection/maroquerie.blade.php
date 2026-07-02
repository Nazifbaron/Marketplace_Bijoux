<x-collection.layout active="maroquinerie" title="Maroquinerie de Prestige | L'Éclat du Bénin">

    {{--
        PAGE MAROQUINERIE — DYNAMIQUE
        =====================================================================
        Design conservé :
          - Hero centré plein écran avec overlay texte centré
          - Filtres sticky (Toutes / Sacs à main / Voyages / Accessoires)
          - Premier produit : featured 8 colonnes avec description complète
          - Colonne droite 4 : 2 produits empilés
          - Ligne suivante : 3 colonnes carrées
          - Section "Savoir-Faire" / Brand Story (adaptée pour afficher les
            stats dynamiques du vendeur du 1er produit ou stats globales)
          - Newsletter finale
        =====================================================================
    --}}

    {{-- ── HERO PLEIN ÉCRAN ── --}}
    <section class="relative h-[618px] w-full flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            @if($category->hero_image)
                <img class="w-full h-full object-cover grayscale-[20%] contrast-[1.1]"
                     src="{{ asset('storage/' . $category->hero_image) }}" alt="{{ $category->name }}" />
            @else
                <div class="w-full h-full bg-primary"></div>
            @endif
            <div class="absolute inset-0 bg-primary/20"></div>
        </div>
        <div class="relative z-10 text-center px-margin-mobile museum-fade-in">
            <span class="font-label-caps text-label-caps text-white mb-4 block tracking-[0.3em]">Héritage d'Excellence</span>
            <h2 class="font-display-lg text-display-lg-mobile md:text-display-lg text-white mb-6 uppercase">
                {{ $category->hero_title ?? 'Maroquinerie' }}
            </h2>
            <p class="font-body-lg text-white/90 max-w-2xl mx-auto italic">
                {{ $category->hero_description ?? "Des pièces uniques façonnées à la main par nos maîtres artisans de Cotonou, alliant tradition ancestrale et élégance contemporaine." }}
            </p>
        </div>
    </section>

    {{-- ── FILTRES STICKY ── --}}
    <nav class="sticky top-20 z-40 bg-background/90 backdrop-blur-md border-b border-outline-variant/10">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-6 flex flex-wrap justify-between items-center gap-4">
            <div class="flex gap-6 md:gap-16 overflow-x-auto no-scrollbar">
                <button data-filter="all" class="filter-btn active font-label-caps text-label-caps text-primary border-b-2 border-primary pb-1 whitespace-nowrap">
                    Toutes les collections
                </button>
                @foreach($subcategories as $sub)
                    <button data-filter="{{ $sub->slug }}" class="filter-btn font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors pb-1 whitespace-nowrap">
                        {{ $sub->name }}
                    </button>
                @endforeach
            </div>
            <div class="flex items-center gap-3 flex-shrink-0">
                <span class="font-label-caps text-[10px] text-on-surface-variant/60">{{ $products->total() }} article(s)</span>
                <select onchange="sortProducts(this.value)" class="bg-transparent border-none font-label-caps text-[10px] text-on-surface-variant focus:ring-0 cursor-pointer">
                    <option value="">Trier</option>
                    <option value="price_desc">Prix décroissant</option>
                    <option value="price_asc">Prix croissant</option>
                    <option value="newest">Nouveautés</option>
                </select>
            </div>
        </div>
    </nav>

    {{-- ── GRILLE PRODUITS ── --}}
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">

        @if($products->isEmpty())
            <div class="text-center py-24">
                <span class="material-symbols-outlined text-6xl text-outline-variant block mb-4">shopping_bag</span>
                <p class="font-headline-md text-headline-md text-primary mb-2">Aucune pièce de maroquinerie disponible</p>
                <p class="font-body-md text-on-surface-variant">Nos ateliers travaillent à de nouvelles créations.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter product-grid">

                @foreach($products as $product)
                    @php
                        $pos = $loop->index % 6;
                        $img = $product->images->firstWhere('is_primary', true) ?? $product->images->first();
                        $isFeatured = $pos === 0;
                        $isSide     = $pos === 1 || $pos === 2;
                        $isSquare   = $pos >= 3;
                    @endphp

                    @if($isFeatured)
                        {{-- ── PRODUIT FEATURED (8 colonnes) ── --}}
                        <div class="md:col-span-8 group reveal"
                             data-category="{{ $product->subcategory?->slug ?? 'all' }}"
                             data-price="{{ $product->price }}"
                             data-id="{{ $product->id }}">
                            <div class="image-zoom-container relative aspect-[4/3] bg-surface-container-low hairline-border overflow-hidden">
                                @if($img)
                                    <img class="w-full h-full object-cover" src="{{ $img->url }}" alt="{{ $product->name }}" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-surface-container">
                                        <span class="material-symbols-outlined text-5xl text-outline-variant">shopping_bag</span>
                                    </div>
                                @endif
                                <button onclick="openQuickView({{ $product->id }})"
                                    class="absolute bottom-6 left-1/2 -translate-x-1/2 bg-primary text-on-primary px-8 py-3 font-label-caps text-label-caps opacity-0 group-hover:opacity-100 transition-opacity duration-300 shadow-xl whitespace-nowrap">
                                    Quick View
                                </button>
                                @if($product->is_verified)
                                    <div class="absolute top-4 left-4 badge-verified">
                                        <span class="material-symbols-outlined text-secondary-fixed text-[12px]" style="font-variation-settings:'FILL' 1">verified</span>
                                        <span class="font-label-caps text-[9px] text-secondary-fixed">VÉRIFIÉ</span>
                                    </div>
                                @endif
                                @if($product->condition_label_text)
                                    <div class="absolute top-4 right-4">
                                        <span class="bg-primary text-white font-label-caps text-[9px] px-3 py-1">{{ $product->condition_label_text }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-8 flex justify-between items-end">
                                <div>
                                    <span class="font-label-caps text-[10px] text-secondary tracking-widest uppercase mb-2 block">
                                        {{ $product->short_story ?? ($product->vendor?->shop_name ?? 'Atelier de Maroquinerie') }}
                                    </span>
                                    <h3 class="font-headline-md text-headline-md text-primary uppercase">{{ $product->name }}</h3>
                                    <p class="font-body-md text-on-surface-variant mt-1 max-w-md">
                                        {{ Str::limit($product->description, 100) }}
                                    </p>
                                    <a href="{{ route('collection.product', $product) }}" class="mt-4 inline-block font-label-caps text-[10px] text-secondary border-b border-secondary hover:text-primary hover:border-primary transition-colors">
                                        Voir la fiche complète →
                                    </a>
                                </div>
                                <p class="font-price-display text-price-display text-primary whitespace-nowrap ml-8">{{ $product->formatted_price }}</p>
                            </div>
                        </div>

                    @elseif($isSide)
                        {{-- ── PRODUITS COLONNE DROITE (4 colonnes, 2 empilés) ── --}}
                        @if($pos === 1)
                            <div class="md:col-span-4 flex flex-col gap-gutter">
                        @endif
                                <div class="group reveal"
                                     data-category="{{ $product->subcategory?->slug ?? 'all' }}"
                                     data-price="{{ $product->price }}"
                                     data-id="{{ $product->id }}">
                                    <div class="image-zoom-container relative aspect-[4/5] bg-surface-container-low hairline-border overflow-hidden">
                                        @if($img)
                                            <img class="w-full h-full object-cover" src="{{ $img->url }}" alt="{{ $product->name }}" />
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-surface-container">
                                                <span class="material-symbols-outlined text-4xl text-outline-variant">shopping_bag</span>
                                            </div>
                                        @endif
                                        <button onclick="openQuickView({{ $product->id }})"
                                            class="absolute inset-0 flex items-center justify-center bg-black/0 group-hover:bg-black/10 transition-colors">
                                            <span class="opacity-0 group-hover:opacity-100 transition-opacity bg-white text-primary font-label-caps text-[10px] px-5 py-2 shadow-xl">Quick View</span>
                                        </button>
                                    </div>
                                    <div class="mt-6 text-center">
                                        <span class="font-label-caps text-[10px] text-secondary tracking-widest uppercase mb-1 block">
                                            {{ $product->subcategory?->name ?? 'Maroquinerie' }}
                                        </span>
                                        <a href="{{ route('collection.product', $product) }}">
                                            <h3 class="font-body-lg font-semibold text-primary uppercase hover:text-secondary transition-colors">{{ $product->name }}</h3>
                                        </a>
                                        <p class="font-price-display text-price-display mt-1 text-primary">{{ $product->formatted_price }}</p>
                                    </div>
                                </div>
                        @if($pos === 2)
                            </div>
                        @endif

                    @else
                        {{-- ── PRODUITS EN GRILLE 3 COLONNES CARRÉES ── --}}
                        @if($pos === 3)
                            {{-- Ouvrir la grille 3 colonnes --}}
                            <div class="md:col-span-12 grid grid-cols-1 md:grid-cols-3 gap-gutter">
                        @endif
                                <div class="group mt-8 reveal"
                                     data-category="{{ $product->subcategory?->slug ?? 'all' }}"
                                     data-price="{{ $product->price }}"
                                     data-id="{{ $product->id }}">
                                    <div class="image-zoom-container relative aspect-square bg-surface-container-low hairline-border overflow-hidden">
                                        @if($img)
                                            <img class="w-full h-full object-cover" src="{{ $img->url }}" alt="{{ $product->name }}" />
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-surface-container">
                                                <span class="material-symbols-outlined text-4xl text-outline-variant">shopping_bag</span>
                                            </div>
                                        @endif
                                        <button onclick="openQuickView({{ $product->id }})"
                                            class="absolute inset-0 flex items-center justify-center bg-black/0 group-hover:bg-black/10 transition-colors">
                                            <span class="opacity-0 group-hover:opacity-100 transition-opacity bg-white text-primary font-label-caps text-[10px] px-5 py-2 shadow-xl">Quick View</span>
                                        </button>
                                        @if($product->is_verified)
                                            <div class="absolute top-3 right-3 badge-verified">
                                                <span class="material-symbols-outlined text-secondary-fixed text-[11px]" style="font-variation-settings:'FILL' 1">verified</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-6 text-center">
                                        <span class="font-label-caps text-[10px] text-secondary tracking-widest uppercase mb-1 block">
                                            {{ $product->subcategory?->name ?? 'Maroquinerie' }}
                                        </span>
                                        <a href="{{ route('collection.product', $product) }}">
                                            <h3 class="font-body-lg font-semibold text-primary uppercase hover:text-secondary transition-colors">{{ $product->name }}</h3>
                                        </a>
                                        <p class="font-price-display text-price-display mt-1 text-primary">{{ $product->formatted_price }}</p>
                                    </div>
                                </div>
                        @if($pos === 5 || $loop->last)
                            </div> {{-- Fermer la grille 3 colonnes --}}
                        @endif
                    @endif
                @endforeach
            </div>

            <div class="mt-16 flex justify-center">
                {{ $products->withQueryString()->links() }}
            </div>
        @endif
    </section>

    {{-- ── SECTION BRAND STORY / SAVOIR-FAIRE ── --}}
    <section class="bg-surface-container-low py-section-gap overflow-hidden reveal">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop grid grid-cols-1 md:grid-cols-2 items-center gap-20">
            <div class="order-2 md:order-1">
                <span class="font-label-caps text-label-caps text-secondary mb-6 block uppercase tracking-[0.2em]">Savoir-Faire</span>
                <h2 class="font-display-lg text-headline-lg md:text-display-lg text-primary uppercase mb-8 leading-tight">L'Atelier de Cotonou</h2>
                <p class="font-body-lg text-on-surface-variant mb-10 leading-relaxed">
                    Chaque pièce de notre collection est le fruit d'une collaboration intime entre le designer et l'artisan. Dans notre atelier au cœur de Cotonou, nous utilisons exclusivement des cuirs sélectionnés pour leur durabilité et leur grain exceptionnel.
                </p>
                <div class="flex items-center gap-10 mb-12">
                    <div class="flex flex-col">
                        <span class="font-display-lg text-headline-lg text-primary">48h</span>
                        <span class="font-label-caps text-[10px] uppercase text-on-surface-variant">Main-d'œuvre moyenne</span>
                    </div>
                    <div class="w-px h-12 bg-outline-variant/30"></div>
                    <div class="flex flex-col">
                        <span class="font-display-lg text-headline-lg text-primary">100%</span>
                        <span class="font-label-caps text-[10px] uppercase text-on-surface-variant">Fait Main au Bénin</span>
                    </div>
                    <div class="w-px h-12 bg-outline-variant/30"></div>
                    <div class="flex flex-col">
                        <span class="font-display-lg text-headline-lg text-primary">{{ $products->total() }}</span>
                        <span class="font-label-caps text-[10px] uppercase text-on-surface-variant">Pièces au catalogue</span>
                    </div>
                </div>
                <a href="{{ route('artisan.onboarding.step1') }}"
                   class="border border-primary text-primary px-10 py-4 font-label-caps text-label-caps hover:bg-primary hover:text-on-primary transition-all duration-300 inline-block">
                    Rejoindre nos Artisans
                </a>
            </div>
            <div class="order-1 md:order-2 relative">
                <div class="w-full aspect-[4/5] bg-primary hairline-border flex items-center justify-center">
                    <div class="p-16 text-center">
                        <span class="material-symbols-outlined text-secondary-fixed text-6xl mb-6 block" style="font-variation-settings:'FILL' 1">workspace_premium</span>
                        <p class="font-body-lg text-white/80 italic leading-relaxed">"Chaque couture est une promesse, chaque pièce est une œuvre d'art portée."</p>
                        <div class="w-12 h-px bg-secondary-fixed mx-auto mt-6"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── NEWSLETTER ── --}}
    <section class="py-section-gap text-center px-margin-mobile max-w-2xl mx-auto reveal">
        <h3 class="font-display-lg text-headline-lg uppercase mb-4">Rejoignez l'Excellence</h3>
        <p class="font-body-md text-on-surface-variant mb-10 italic">Inscrivez-vous pour recevoir nos invitations aux ventes privées et découvrir nos nouvelles créations en avant-première.</p>
        <form class="flex flex-col md:flex-row gap-4 items-end">
            <div class="flex-grow w-full">
                <label class="block text-left font-label-caps text-[10px] uppercase mb-2">Votre Email</label>
                <input class="w-full bg-transparent border-0 border-b border-outline py-2 focus:ring-0 focus:border-secondary transition-colors font-body-md"
                       placeholder="email@votre-maison.com" type="email" />
            </div>
            <button class="bg-primary text-on-primary px-10 py-3 font-label-caps text-label-caps whitespace-nowrap" type="button">
                S'abonner
            </button>
        </form>
    </section>

</x-collection.layout>
