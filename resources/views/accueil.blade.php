{{-- resources/views/home.blade.php --}}
<x-layout title="L'Éclat du Bénin — Heritage Excellence">

    {{-- ══════════════════════════════════════════════════════════════
         SECTION HERO
         ══════════════════════════════════════════════════════════════ --}}
    <section class="relative h-screen flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img alt="Luxury Lifestyle"
                 class="w-full h-full object-cover scale-105"
                 src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkTtVV0LV90i1thkZo0EPHYoRYyUkTDJ5b7LCbbj_GdsrNoI99q5XxoxHHW1DDstZh2tyVItDwi-fT673yquIYoLatWGUN316Wk96i5rK_opVcnbRKq-gidTI0MISJFOw0Kp2R2WI0iA3dEGT6qpVLIbTL5wH0TYzBw0ZiW6n6VoEOwlz6YUbNXY2S7uesUFBpGL9Ge4m9owGaoxDJtLCRCpurRN_tTRFwJRRmtQpV3T-TbqTTeRQ9p2FCw1E6uIEJUrjOhsynlQ" />
            <div class="absolute inset-0 hero-overlay"></div>
            <div class="absolute inset-0 bg-black/20"></div>
        </div>

        <div class="relative z-10 px-margin-mobile md:px-margin-desktop w-full max-w-5xl">
            <p class="font-label-caps text-label-caps text-secondary-fixed tracking-[0.4em] mb-8 reveal uppercase editorial-spacing">
                L'Exceptionnel au Quotidien
            </p>
            <h2 class="font-display-lg text-display-lg-mobile md:text-display-lg text-white mb-10 leading-[0.95] reveal">
                L'ART DE VIVRE <br />
                <span class="text-secondary-fixed">SANS COMPROMIS.</span>
            </h2>
            <p class="font-body-lg text-white/80 max-w-xl mb-12 reveal leading-relaxed">
                Découvrez une sélection exclusive, où l'héritage rencontre l'excellence de la haute facture mondiale.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 reveal">
                <a href="{{ route('collection.index') }}"
                   class="bg-white text-primary px-12 py-5 font-label-caps text-label-caps uppercase tracking-widest hover:bg-secondary-fixed transition-colors duration-500 shadow-2xl text-center">
                    Acquérir l'Éclat
                </a>
                <a href="{{ route('artisan.onboarding.step1') }}"
                   class="border border-white/40 backdrop-blur-md text-white px-12 py-5 font-label-caps text-label-caps uppercase tracking-widest hover:bg-white/10 transition-colors duration-500 text-center">
                    Présenter une Œuvre
                </a>
            </div>
        </div>

        {{-- Scroll indicator --}}
        <div class="absolute bottom-10 left-[80px] hidden lg:flex items-center gap-4 text-white/40 reveal">
            <span class="text-[10px] font-label-caps tracking-widest">SCROLL TO DISCOVER</span>
            <div class="w-px h-12 bg-gradient-to-b from-white/40 to-transparent"></div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════════════════
         SECTION CATÉGORIES — 100% DYNAMIQUE
         ══════════════════════════════════════════════════════════════
         Chaque catégorie créée par l'admin dans le panneau d'admin
         apparaît ici automatiquement avec son image héro.

         Disposition automatique :
         - 1 catégorie       → pleine largeur
         - 2 catégories      → 2 colonnes égales
         - 3 catégories      → 3 colonnes
         - 4 catégories      → 3 cols (1ère = lg:col-span-2) + 2 cols
         - 5+ catégories     → grille 3 cols, dernier = lg:col-span-2
         ══════════════════════════════════════════════════════════════ --}}
    <section class="px-margin-mobile md:px-margin-desktop py-section-gap max-w-[1440px] mx-auto">

        <div class="text-center mb-24 reveal">
            <span class="font-label-caps text-label-caps text-secondary editorial-spacing mb-4 block">LES DOMAINES</span>
            <h3 class="font-display-lg text-headline-lg md:text-display-lg-mobile text-primary">Le Portfolio de Prestige</h3>
        </div>

        @php
            $categories = \App\Models\Category::withCount(['products' => function($q) {
                $q->where('moderation_status', 'published');
            }])->orderBy('display_order')->get();
            $count = $categories->count();
        @endphp

        @if($categories->isEmpty())
            {{-- Aucune catégorie : afficher les cartes statiques de la maquette --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-gutter gap-y-20">
                @foreach([
                    ['title' => 'Haute Joaillerie', 'sub' => 'Or 24 carats & Gemmes Rares', 'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAtAlkPnt0Q0kvcxMSdH8xjsE8bV7P7HMco7GAikDqazPHX-S2rBTvaYJMgwhIt_rQPU8do03cWkBpSpRk7JsTR2cGwqHwr5sQiHy86tLjVmwBDdTvf9GKm_2HZCXmxHL_wXK8ybpAdLjj9QFb6MuEZtaBomJ4ZgcHXVTpRC7xiQhTZfwtdmR5gDzp6hIrfRMy5R0IVAZAMvkx18oDZ4v4A3CqP3KukOephfASD6fOq6owDuYojESycArxt1UopLKsxNJyJGA42fw', 'route' => null],
                    ['title' => 'Maroquinerie',     'sub' => 'Cuirs Précieux & Façon Main', 'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBXSjMJZRG_0EayKShKS3CjiXtWROP8luhOb_eoqOe3Ooy28KnGqPyJsJ5Ya__sPk02KeBBBX59r53xM0LZQ-mOtcqX5DLPEx6RYRE83HjnXD_rNm275HE6N6hrMT1a1foPiJ5zPVV3mKJkyNJO3dp0IRKUEMVKabAibfF-snWfYsp4TN3sD9GDJnsfNItKDzJrD48oa9xW2uP-aDozm36fKI6e4djhJuHVmaCJrKQJMKHr4v4Mq0xFoHAtlayhf9EV71WY4PTn4A', 'route' => null],
                    ['title' => 'Art & Décoration', 'sub' => 'Objets de Curiosité & Patrimoine', 'img' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuAAVwWa7Gb-ta5HPbl1Jg5ioE-smscDAGeQT_rh2jH8RDii8atrwo-eFN4nL6xHIV9iZx1yg2r8YdkKxjt8du86ux56B4r9n319JAZmEjBAvkG8zEwt6-PBRCQdpFaJWwuBprajFeocb3AeCPeRKN2JwRUGWTdo2GHs3rhhHeNr0KjEOJOTh8lYZLOtBnfUEK9khqvZD5WNq6NwS5ib0wQ0sQPAkv7iyue_hC_KC-SWLDayMy6awjVqLYvjdKr5h0fnfSlcxiP08w', 'route' => null],
                ] as $i => $cat)
                    <div class="group cursor-pointer reveal" style="transition-delay: {{ ($i + 1) * 100 }}ms">
                        <div class="aspect-[4/5] overflow-hidden mb-8 bg-surface-container-low relative img-zoom-container">
                            <img class="w-full h-full object-cover transition-transform duration-1000"
                                 src="{{ $cat['img'] }}" alt="{{ $cat['title'] }}" />
                            <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-colors duration-500"></div>
                        </div>
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-display-lg text-headline-md mb-2">{{ $cat['title'] }}</h4>
                                <p class="font-body-md text-on-surface-variant/80 text-sm italic">{{ $cat['sub'] }}</p>
                            </div>
                            <span class="material-symbols-outlined text-secondary opacity-0 group-hover:opacity-100 transition-opacity -translate-x-2.5 group-hover:translate-x-0 duration-300">north_east</span>
                        </div>
                    </div>
                @endforeach
            </div>

        @else
            {{-- ── Catégories depuis la DB ── --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-gutter gap-y-20">
                @foreach($categories as $i => $cat)
                    @php
                        // La dernière catégorie prend 2 colonnes si le total est impair
                        $isLast = $loop->last;
                        $isWide = $isLast && ($count % 3 !== 0) && $count > 3;
                        // Image : utiliser hero_image si disponible, sinon une des images produits
                        $heroUrl = $cat->hero_image
                            ? asset('storage/' . $cat->hero_image)
                            : optional($cat->products()->published()->with('images')->first()?->primary_image);
                        // Route vers la catégorie
                        try {
                            $catRoute = route('collection.category', ['category' => $cat->slug]);
                        } catch(\Exception $e) {
                            $catRoute = route('collection.category', $cat);
                        }
                    @endphp

                    <div class="{{ $isWide ? 'lg:col-span-2' : '' }} group cursor-pointer reveal"
                         style="transition-delay: {{ (($i % 3) + 1) * 100 }}ms">
                        <a href="{{ $catRoute }}" class="block">

                            {{-- Image --}}
                            <div class="{{ $isWide ? 'aspect-[16/9]' : 'aspect-[4/5]' }} overflow-hidden mb-8 bg-surface-container-low relative img-zoom-container">
                                @if($heroUrl)
                                    <img class="w-full h-full object-cover transition-transform duration-1000"
                                         src="{{ $heroUrl }}" alt="{{ $cat->name }}" />
                                @else
                                    {{-- Placeholder élégant si pas d'image --}}
                                    <div class="w-full h-full bg-primary flex flex-col items-center justify-center gap-4">
                                        <span class="material-symbols-outlined text-6xl text-[#c9a227]/40">category</span>
                                        <p class="font-label-caps text-[10px] text-[#c9a227]/60 tracking-widest uppercase">{{ $cat->name }}</p>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-colors duration-500"></div>

                                {{-- Badge nombre de produits --}}
                                @if($cat->products_count > 0)
                                    <div class="absolute bottom-4 right-4 bg-[#012F24]/80 backdrop-blur-sm px-3 py-1.5">
                                        <span class="font-label-caps text-[9px] text-[#c9a227] tracking-widest">
                                            {{ $cat->products_count }} PIÈCE{{ $cat->products_count > 1 ? 'S' : '' }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- Infos texte --}}
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-display-lg text-headline-md mb-2 group-hover:text-secondary transition-colors duration-300">
                                        {{ $cat->name }}
                                    </h4>
                                    <p class="font-body-md text-on-surface-variant/80 text-sm italic">
                                        {{ $cat->hero_description
                                            ? \Illuminate\Support\Str::limit($cat->hero_description, 50)
                                            : ($cat->products_count > 0 ? $cat->products_count . ' pièce(s) disponible(s)' : 'Bientôt disponible') }}
                                    </p>
                                </div>
                                <span class="material-symbols-outlined text-secondary opacity-0 group-hover:opacity-100 transition-all duration-300 -translate-x-2.5 group-hover:translate-x-0">
                                    north_east
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

    </section>

    {{-- ══════════════════════════════════════════════════════════════
         SECTION NEWSLETTER / CERCLE PRIVÉ
         ══════════════════════════════════════════════════════════════ --}}
    <section class="py-section-gap px-margin-mobile text-center max-w-4xl mx-auto reveal">
        <div class="bg-surface-container-low p-16 md:p-24 relative overflow-hidden border border-outline-variant/30">
            <h3 class="font-display-lg text-headline-lg text-primary mb-8 leading-tight">
                Rejoignez le Cercle Privé
            </h3>
            <p class="font-body-lg text-on-surface-variant mb-12 max-w-2xl mx-auto">
                Soyez le premier informé de nos ventes privées, de nos nouvelles acquisitions et des récits exclusifs de notre Maison.
            </p>
            <div class="flex flex-col sm:flex-row gap-0 border border-primary/20 max-w-lg mx-auto overflow-hidden">
                <input class="flex-1 bg-white border-0 text-primary focus:ring-0 font-body-md py-5 px-8 outline-none"
                       placeholder="votre@email.com" type="email" />
                <button class="bg-primary text-on-primary px-10 py-5 font-label-caps text-label-caps tracking-widest uppercase hover:bg-on-primary-fixed-variant transition-all shrink-0">
                    S'INSCRIRE
                </button>
            </div>
            <p class="mt-8 font-label-caps text-[9px] text-on-surface-variant/60 tracking-widest uppercase">
                Discrétion &amp; Confidentialité Garanties
            </p>
        </div>
    </section>

</x-layout>
