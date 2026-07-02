<x-collection.layout active="bijoux" title="Haute Joaillerie | L'Éclat du Bénin">

    {{--
        PAGE BIJOUX — DYNAMIQUE
        =====================================================================
        Design conservé : hero éditorial en 2 colonnes (texte + image),
        filtres sticky, grille uniforme 3 colonnes aspect 3/4, section
        newsletter "Cercle des Artisans".
        =====================================================================
    --}}

    {{-- ── HERO ÉDITORIAL ── --}}
    <section class="px-margin-mobile md:px-margin-desktop mb-24 max-w-container-max mx-auto pt-12 reveal">
        <div class="flex flex-col md:flex-row gap-12 items-end">
            <div class="w-full md:w-1/2">
                <span class="font-label-caps text-label-caps text-secondary mb-4 block">LES TRÉSORS DE COTONOU</span>
                <h2 class="font-display-lg text-display-lg-mobile md:text-display-lg text-primary leading-none mb-8">
                    {{ $category->hero_title ?? 'Haute Joaillerie' }}
                </h2>
                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-lg mb-8">
                    {{ $category->hero_description ?? "Découvrez l'artisanat béninois. Chaque pièce est un dialogue unique entre techniques ancestrales et luxe contemporain, forgé au cœur de nos ateliers côtiers." }}
                </p>
                <div class="flex gap-3 items-center">
                    <span class="material-symbols-outlined text-secondary text-sm" style="font-variation-settings:'FILL' 1">verified</span>
                    <span class="font-label-caps text-[10px] text-on-surface-variant">{{ $products->total() }} PIÈCE(S) DISPONIBLE(S)</span>
                </div>
            </div>
            <div class="w-full md:w-1/2 flex justify-end">
                <div class="relative w-full aspect-[4/5] bg-surface-container-low overflow-hidden">
                    @if($category->hero_image)
                        <img class="w-full h-full object-cover" src="{{ asset('storage/' . $category->hero_image) }}" alt="{{ $category->name }}" />
                    @else
                        <div class="w-full h-full bg-primary flex items-center justify-center">
                            <img class="w-full h-full object-cover" data-alt="A macro photograph of an intricate 24k gold necklace with traditional Beninese motifs, resting on an ivory silk background. The lighting is soft and golden, highlighting the handcrafted texture of the filigree. The aesthetic is high-end editorial, evoking a sense of heritage and extreme luxury through minimalist composition and rich contrast." src="{{ asset('images/bijoux/hero.png') }}" />
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ── FILTRES STICKY ── --}}
    <nav class="sticky top-20 z-40 bg-surface/90 backdrop-blur-md border-y border-outline-variant/10 py-6 mb-16">
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto flex flex-wrap justify-between items-center gap-4">
            <div class="flex gap-6 md:gap-8 overflow-x-auto no-scrollbar pb-1">
                <button data-filter="all" class="filter-btn active font-label-caps text-label-caps text-primary border-b-2 border-primary pb-1 whitespace-nowrap">
                    TOUTES LES COLLECTIONS
                </button>
                @foreach($subcategories as $sub)
                    <button data-filter="{{ $sub->slug }}" class="filter-btn font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors pb-1 whitespace-nowrap">
                        {{ strtoupper($sub->name) }}
                    </button>
                @endforeach
            </div>
            <div class="flex items-center gap-3 flex-shrink-0">
                <select onchange="sortProducts(this.value)" class="bg-transparent border-none font-label-caps text-[10px] text-on-surface-variant focus:ring-0 cursor-pointer">
                    <option value="">TRIER : IMPORTANCE</option>
                    <option value="price_desc">PRIX DÉCROISSANT</option>
                    <option value="price_asc">PRIX CROISSANT</option>
                    <option value="newest">NOUVEAUTÉS</option>
                </select>
            </div>
        </div>
    </nav>

    {{-- ── GRILLE PRODUITS 3 COLONNES ── --}}
    <section class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto mb-section-gap">

        @if($products->isEmpty())
            <div class="text-center py-24">
                <span class="material-symbols-outlined text-6xl text-outline-variant block mb-4">diamond</span>
                <p class="font-headline-md text-headline-md text-primary mb-2">Aucun bijou disponible pour le moment</p>
                <p class="font-body-md text-on-surface-variant">Nos artisans joailliers préparent de nouvelles créations.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-20 gap-x-gutter product-grid">
                @foreach($products as $product)
                    @php $img = $product->images->firstWhere('is_primary', true) ?? $product->images->first(); @endphp
                    <article class="group reveal"
                             data-category="{{ $product->subcategory?->slug ?? 'all' }}"
                             data-price="{{ $product->price }}"
                             data-id="{{ $product->id }}">

                        <div class="aspect-[3/4] bg-surface-container-low mb-6 overflow-hidden relative hairline-border">
                            @if($img)
                                <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                     src="{{ $img->url }}" alt="{{ $product->name }}" />
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-surface-container-low">
                                    <span class="material-symbols-outlined text-5xl text-outline-variant">diamond</span>
                                </div>
                            @endif

                            {{-- Overlay Quick View --}}
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <button onclick="openQuickView({{ $product->id }})"
                                    class="bg-primary text-on-primary px-8 py-3 font-label-caps text-label-caps tracking-widest active:scale-95 transition-transform shadow-xl">
                                    VIEW PIECE
                                </button>
                            </div>

                            {{-- Badge condition --}}
                            @if($product->condition_label_text)
                                <div class="absolute top-4 left-4">
                                    <span class="bg-primary text-white font-label-caps text-[9px] px-3 py-1">{{ $product->condition_label_text }}</span>
                                </div>
                            @endif

                            {{-- Badge vérifié --}}
                            @if($product->is_verified)
                                <div class="absolute top-4 right-4">
                                    <div class="badge-verified">
                                        <span class="material-symbols-outlined text-secondary-fixed text-[12px]" style="font-variation-settings:'FILL' 1">verified</span>
                                        <span class="font-label-caps text-[9px] text-secondary-fixed">VÉRIFIÉ</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <a href="{{ route('collection.product', $product) }}" class="block text-center px-4">
                            <span class="font-label-caps text-[10px] text-secondary tracking-[0.2em] mb-2 block uppercase">
                                {{ $product->short_story ?? ('Maison ' . ($product->vendor?->shop_name ?? '')) }}
                            </span>
                            <h3 class="font-headline-md text-headline-md text-primary mb-1 group-hover:text-secondary transition-colors">
                                {{ $product->name }}
                            </h3>
                            <p class="font-price-display text-price-display text-on-surface-variant">
                                {{ $product->formatted_price }}
                            </p>
                        </a>
                    </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-16 flex justify-center">
                {{ $products->withQueryString()->links() }}
            </div>
        @endif
    </section>

    {{-- ── SECTION NEWSLETTER CERCLE DES ARTISANS ── --}}
    <section class="mt-section-gap px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto mb-section-gap">
        <div class="bg-primary text-on-primary p-12 md:p-24 flex flex-col items-center text-center">
            <span class="font-label-caps text-label-caps text-secondary-fixed mb-6">LE CERCLE DES ARTISANS</span>
            <h2 class="font-display-lg text-headline-lg md:text-display-lg-mobile mb-8 max-w-2xl">Des créations sur mesure venues du cœur du Bénin</h2>
            <p class="font-body-lg text-body-lg text-on-primary/70 max-w-xl mb-12">
                Contactez nos maîtres artisans pour commander une pièce sur mesure qui racontera votre histoire unique à travers le prisme de l'excellence ouest-africaine.
            </p>
            <div class="w-full max-w-md flex flex-col md:flex-row gap-4">
                <input class="bg-transparent border-b border-on-primary/30 py-3 px-1 font-body-md text-on-primary focus:border-secondary outline-none transition-colors flex-grow"
                       placeholder="Your Email" type="email" />
                <button class="bg-on-primary text-primary px-10 py-3 font-label-caps text-label-caps hover:bg-secondary-fixed transition-colors whitespace-nowrap">
                    DEMANDE DE RENSEIGNEMENTS
                </button>
            </div>
        </div>
    </section>

</x-collection.layout>
