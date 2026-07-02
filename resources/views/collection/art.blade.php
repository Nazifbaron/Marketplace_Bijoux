<x-collection.layout active="art" title="Art & Décoration | L'Éclat du Bénin">

    {{-- ── HERO ── --}}
    <section class="relative h-[707px] w-full overflow-hidden flex items-center px-margin-mobile md:px-margin-desktop">
        <div class="absolute inset-0 z-0">
            @if($category->hero_image)
                <img class="w-full h-full object-cover grayscale-[20%] brightness-75" src="{{ asset('storage/' . $category->hero_image) }}" alt="{{ $category->name }}" />
            @else
                <div class="w-full h-full bg-primary"></div>
            @endif
        </div>
        <div class="relative z-10 max-w-2xl museum-fade-in">
            <span class="font-label-caps text-label-caps text-secondary-fixed mb-4 block tracking-[0.2em]">SÉLECTION DE PRODUITS</span>
            <h2 class="font-display-lg text-display-lg-mobile md:text-display-lg text-white mb-6">{{ $category->hero_title ?? 'Art &amp; Décoration' }}</h2>
            <p class="font-body-lg text-white/90 mb-8 max-w-lg">
                {{ $category->hero_description ?? "Découvrez l'âme du royaume du Dahomey à travers des objets d'art confectionnés avec un savoir-faire exceptionnel." }}
            </p>
            <div class="flex gap-4">
                <button class="bg-primary text-white font-label-caps text-label-caps px-8 py-4 hover:bg-primary/90 transition-colors">EXPLOREZ LES ARCHIVES</button>
                <button class="border border-white/50 text-white font-label-caps text-label-caps px-8 py-4 backdrop-blur-sm hover:bg-white/10 transition-colors">L'HISTOIRE DE L'ARTISAN</button>
            </div>
        </div>
    </section>

    {{-- ── FILTRES SOUS-CATÉGORIES ── --}}
    <section class="py-12 bg-surface-container-low border-b border-outline-variant/10 sticky top-20 z-40">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-8">

            <div class="flex gap-8 overflow-x-auto pb-4 md:pb-0 w-full md:w-auto no-scrollbar">
                <button data-filter="all" class="filter-btn active font-label-caps text-label-caps text-primary border-b-2 border-primary pb-1 whitespace-nowrap">TOUTES LES ŒUVRES</button>
                @foreach($subcategories as $sub)
                    <button data-filter="{{ $sub->slug }}" class="filter-btn font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors pb-1 whitespace-nowrap">
                        {{ strtoupper($sub->name) }}
                    </button>
                @endforeach
            </div>

            <div class="flex items-center gap-4 w-full md:w-auto justify-end">
                <span class="font-label-caps text-label-caps text-on-surface-variant whitespace-nowrap">TRIER PAR :</span>
                <select onchange="sortProducts(this.value)" class="bg-transparent border-none font-label-caps text-label-caps text-primary focus:ring-0 cursor-pointer text-sm">
                    <option value="">IMPORTANCE</option>
                    <option value="newest">NOUVELLES ACQUISITIONS</option>
                    <option value="price_desc">PRIX : DU PLUS ÉLEVÉ</option>
                    <option value="price_asc">PRIX : DU PLUS BAS</option>
                </select>
                <span class="font-label-caps text-[10px] text-on-surface-variant/60 ml-4 whitespace-nowrap">{{ $products->total() }} PIÈCE(S)</span>
            </div>
        </div>
    </section>

    {{-- ── GRILLE ASYMÉTRIQUE ── --}}
    <section class="py-section-gap max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">

        @if($products->isEmpty())
            <div class="text-center py-24">
                <span class="material-symbols-outlined text-6xl text-outline-variant block mb-4">inventory_2</span>
                <p class="font-headline-md text-headline-md text-primary mb-2">Aucune œuvre disponible pour le moment</p>
                <p class="font-body-md text-on-surface-variant">Nos artisans enrichissent cette collection. Revenez bientôt.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-12 gap-y-24 gap-x-gutter product-grid" id="art-grid">
                @foreach($products as $product)
                    @php
                        $pos = $loop->index % 9; // cycle sur 9 positions
                        // Largeur de la carte selon sa position dans le cycle
                        $col = match(true) {
                            $pos === 0 => 'md:col-span-7',
                            $pos === 1 => 'md:col-span-5 md:pt-32',
                            $pos === 2 => 'md:col-span-12',
                            $pos === 3 => 'md:col-span-8',
                            $pos === 4 => 'md:col-span-4 md:pt-12',
                            in_array($pos, [5,6,7]) => 'md:col-span-4',
                            $pos === 8 => 'md:col-span-12',
                            default    => 'md:col-span-6',
                        };
                        $isWide  = $pos === 2 || $pos === 8;
                        $isLarge = $pos === 0 || $pos === 3;
                        $img     = $product->images->firstWhere('is_primary', true) ?? $product->images->first();
                    @endphp

                    <div class="{{ $col }} group cursor-pointer reveal"
                         data-category="{{ $product->subcategory?->slug ?? 'all' }}"
                         data-price="{{ $product->price }}"
                         data-id="{{ $product->id }}">

                        @if($isWide)
                            {{-- Layout éditorial pleine largeur (comme "Terre cuite éclatante") --}}
                            <div class="flex flex-col md:flex-row gap-gutter bg-surface-container-low p-8 items-center">
                                <div class="w-full md:w-2/3 aspect-video overflow-hidden">
                                    @if($img)
                                        <img class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
                                             src="{{ $img->url }}" alt="{{ $product->name }}" />
                                    @else
                                        <div class="w-full h-full bg-surface-container flex items-center justify-center">
                                            <span class="material-symbols-outlined text-4xl text-outline-variant">image</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="w-full md:w-1/3 flex flex-col justify-center py-8">
                                    <span class="font-label-caps text-label-caps text-secondary mb-4">
                                        {{ strtoupper($product->subcategory?->name ?? $product->category->name) }}
                                    </span>
                                    @if($product->is_verified)
                                        <div class="badge-verified mb-3 self-start">
                                            <span class="material-symbols-outlined text-secondary-fixed text-[12px]" style="font-variation-settings:'FILL' 1">verified</span>
                                            <span class="font-label-caps text-[9px] text-secondary-fixed tracking-widest">AUTHENTICITÉ VÉRIFIÉE</span>
                                        </div>
                                    @endif
                                    <h3 class="font-display-lg text-headline-lg mb-4">{{ $product->name }}</h3>
                                    @if($product->short_story)
                                        <p class="font-label-caps text-[10px] text-on-surface-variant mb-3 tracking-widest">{{ $product->short_story }}</p>
                                    @endif
                                    <p class="font-body-md text-on-surface-variant mb-8 leading-relaxed line-clamp-3">{{ $product->description }}</p>
                                    <p class="font-price-display text-headline-md mb-8">{{ $product->formatted_price }}</p>
                                    <div class="flex gap-3">
                                        <button onclick="openQuickView({{ $product->id }})"
                                            class="flex-1 border border-primary text-primary font-label-caps text-label-caps px-8 py-4 hover:bg-primary hover:text-white transition-all duration-300">
                                            QUICK VIEW
                                        </button>
                                        <a href="{{ route('collection.product', $product) }}"
                                           class="px-6 py-4 bg-surface-container text-on-surface-variant font-label-caps text-label-caps hover:bg-surface-container-high transition-all">
                                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        @else
                            {{-- Layout standard (grande ou petite carte) --}}
                            <div class="{{ $isLarge ? 'aspect-[4/5]' : 'aspect-square' }} overflow-hidden bg-surface-container relative mb-6">
                                @if($img)
                                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                         src="{{ $img->url }}" alt="{{ $product->name }}" />
                                @else
                                    <div class="w-full h-full bg-surface-container-low flex items-center justify-center">
                                        <span class="material-symbols-outlined text-4xl text-outline-variant">image</span>
                                    </div>
                                @endif

                                {{-- Overlay hover avec Quick View --}}
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500"></div>
                                <button onclick="openQuickView({{ $product->id }})"
                                    class="absolute bottom-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-white text-primary font-label-caps text-label-caps px-6 py-3 shadow-xl whitespace-nowrap">
                                    QUICK VIEW
                                </button>

                                {{-- Badges superposés --}}
                                <div class="absolute top-4 left-4 flex flex-col gap-2">
                                    @if($product->condition_label_text)
                                        <span class="bg-primary text-white font-label-caps text-[9px] px-3 py-1">{{ $product->condition_label_text }}</span>
                                    @endif
                                    @if($product->is_verified)
                                        <div class="badge-verified">
                                            <span class="material-symbols-outlined text-secondary-fixed text-[12px]" style="font-variation-settings:'FILL' 1">verified</span>
                                            <span class="font-label-caps text-[9px] text-secondary-fixed tracking-widest">VÉRIFIÉ</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <a href="{{ route('collection.product', $product) }}" class="block {{ in_array($pos, [0,1]) ? 'text-center' : 'text-center' }}">
                                <span class="font-label-caps text-[10px] text-secondary mb-2 block tracking-widest">
                                    {{ strtoupper($product->subcategory?->name ?? $product->category->name) }}
                                </span>
                                @if($product->short_story)
                                    <span class="font-label-caps text-[10px] text-on-tertiary-container mb-2 block">{{ strtoupper($product->short_story) }}</span>
                                @endif
                                <h3 class="font-headline-md text-headline-md mb-2 hover:text-secondary transition-colors">{{ $product->name }}</h3>
                                <p class="font-price-display text-price-display text-on-surface-variant mb-4">{{ $product->formatted_price }}</p>
                                <div class="w-12 h-[1px] bg-outline-variant/50 mx-auto"></div>
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-16 flex justify-center">
                {{ $products->withQueryString()->links() }}
            </div>
        @endif
    </section>

    {{-- ── SECTION NEWSLETTER (identique à l'original) ── --}}
    <section class="bg-primary py-section-gap">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="font-display-lg text-headline-lg text-white mb-6">Devenez mécène du patrimoine béninois</h2>
                <p class="font-body-lg text-white/70 mb-8">Rejoignez notre cercle privé pour recevoir des invitations aux avant-premières d'expositions numériques et des interviews exclusives d'artisans en direct de Cotonou.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <input class="flex-grow bg-transparent border-b border-white/30 text-white font-label-caps focus:border-white focus:ring-0 placeholder:text-white/40 py-4 uppercase" placeholder="YOUR EMAIL ADDRESS" type="email" />
                    <button class="bg-white text-primary font-label-caps text-label-caps px-12 py-4 hover:bg-secondary-container transition-colors">S'ABONNER</button>
                </div>
            </div>
            <div class="relative aspect-square md:aspect-auto md:h-[500px]">
                <div class="absolute inset-0 flex items-center justify-center bg-white/5">
                    <div class="bg-white/10 backdrop-blur-md p-12 text-center max-w-sm border border-white/20">
                        <span class="material-symbols-outlined text-white text-5xl mb-4">workspace_premium</span>
                        <p class="text-white font-body-md italic">"Chaque coup de ciseau est une prière adressée aux ancêtres, qui perpétue une histoire commencée il y a des siècles."</p>
                        <p class="text-white/60 font-label-caps text-[10px] mt-4">— KOBA, MAÎTRE SCULPTEUR</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-collection.layout>
