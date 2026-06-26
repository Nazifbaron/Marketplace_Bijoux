<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ $category->name }} | L'Éclat du Bénin</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: { extend: {
                colors: {
                    "on-secondary-container":"#745c00","on-tertiary-fixed-variant":"#204f3c","on-tertiary-fixed":"#002114",
                    "on-secondary-fixed-variant":"#574500","on-surface":"#1a1c1a","on-primary-container":"#858383",
                    "error":"#ba1a1a","background":"#faf9f6","primary-fixed-dim":"#c9c6c5","on-primary":"#ffffff",
                    "outline-variant":"#c4c7c7","on-error":"#ffffff","on-background":"#1a1c1a","primary-fixed":"#e5e2e1",
                    "primary-container":"#1c1b1b","tertiary-fixed":"#bbeed3","surface-tint":"#5f5e5e",
                    "surface-container-lowest":"#ffffff","inverse-primary":"#c9c6c5","tertiary-fixed-dim":"#a0d1b8",
                    "on-tertiary-container":"#5e8e77","surface-container":"#efeeeb","surface-variant":"#e3e2e0",
                    "secondary":"#735c00","secondary-fixed":"#ffe088","on-primary-fixed-variant":"#474646",
                    "tertiary":"#000000","surface-bright":"#faf9f6","on-secondary":"#ffffff",
                    "inverse-on-surface":"#f2f1ee","surface-container-low":"#f4f3f1","surface-container-highest":"#e3e2e0",
                    "on-tertiary":"#ffffff","primary":"#000000","on-primary-fixed":"#1c1b1b","inverse-surface":"#2f312f",
                    "on-error-container":"#93000a","surface-dim":"#dbdad7","on-secondary-fixed":"#241a00",
                    "surface-container-high":"#e9e8e5","secondary-container":"#fed65b","tertiary-container":"#002114",
                    "outline":"#747878","on-surface-variant":"#444748","surface":"#faf9f6","error-container":"#ffdad6",
                    "secondary-fixed-dim":"#e9c349"
                },
                borderRadius: { "DEFAULT":"0.125rem","lg":"0.25rem","xl":"0.5rem","full":"0.75rem" },
                spacing: { "margin-desktop":"80px","gutter":"24px","container-max":"1280px","section-gap":"120px","margin-tablet":"40px","margin-mobile":"20px" },
                fontFamily: {
                    "headline-md":["Playfair Display"],"price-display":["Montserrat"],"headline-lg":["Playfair Display"],
                    "display-lg":["Playfair Display"],"display-lg-mobile":["Playfair Display"],"body-md":["Montserrat"],
                    "body-lg":["Montserrat"],"label-caps":["Montserrat"]
                },
                fontSize: {
                    "headline-md":["24px",{"lineHeight":"32px","fontWeight":"600"}],
                    "price-display":["20px",{"lineHeight":"24px","fontWeight":"500"}],
                    "headline-lg":["32px",{"lineHeight":"40px","fontWeight":"600"}],
                    "display-lg":["64px",{"lineHeight":"72px","letterSpacing":"-0.02em","fontWeight":"700"}],
                    "display-lg-mobile":["40px",{"lineHeight":"48px","letterSpacing":"-0.01em","fontWeight":"700"}],
                    "body-md":["16px",{"lineHeight":"24px","fontWeight":"400"}],
                    "body-lg":["18px",{"lineHeight":"28px","fontWeight":"400"}],
                    "label-caps":["12px",{"lineHeight":"16px","letterSpacing":"0.1em","fontWeight":"600"}]
                }
            }}
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .luxury-line::after { content: ''; display: block; width: 0; height: 1px; background: #735c00; transition: width 0.3s ease; }
        .luxury-line:hover::after { width: 100%; }
        .museum-fade-in { animation: fadeIn 1.2s ease-out forwards; }
        @keyframes fadeIn { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
        .glass-nav { backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }
        body { min-height: max(884px, 100dvh); }
    </style>
</head>

<body class="bg-background text-on-surface font-body-md selection:bg-secondary-container">

    <x-collection.header :active="$category->slug"></x-collection.header>

    <div class="fixed inset-0 bg-black/40 z-[60] hidden opacity-0 transition-opacity duration-300" id="drawer-overlay" onclick="toggleDrawer()"></div>
    <aside class="fixed top-0 left-0 h-full w-80 bg-surface z-[70] -translate-x-full transition-transform duration-300 ease-in-out shadow-sm flex flex-col gap-4 p-8" id="drawer">
        <div class="flex justify-between items-center mb-8">
            <span class="font-display-lg text-headline-md text-primary">L'ÉCLAT DU BÉNIN</span>
            <span class="material-symbols-outlined cursor-pointer" onclick="toggleDrawer()">close</span>
        </div>
        <nav class="flex flex-col gap-2">
            @foreach(\App\Models\Category::orderBy('display_order')->get() as $navCat)
                <a class="px-4 py-3 font-label-caps text-label-caps transition-all {{ $navCat->slug === $category->slug ? 'text-primary bg-secondary-container/20 font-semibold' : 'text-on-surface-variant hover:bg-surface-container-high' }}"
                   href="{{ route('collection.category', $navCat) }}">{{ $navCat->name }}</a>
            @endforeach
        </nav>
    </aside>

    <main class="pt-20">

        {{-- ── HERO DE LA CATÉGORIE (dynamique selon $category) ── --}}
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
                <h2 class="font-display-lg text-display-lg-mobile md:text-display-lg text-white mb-6">{{ $category->hero_title ?? $category->name }}</h2>
                <p class="font-body-lg text-white/90 mb-8 max-w-lg">
                    {{ $category->hero_description ?? 'Découvrez une sélection rigoureusement choisie, façonnée par les artisans les plus talentueux du Bénin.' }}
                </p>
            </div>
        </section>

        {{-- ── FILTRES PAR SOUS-CATÉGORIE (dynamiques) ── --}}
        <section class="py-12 bg-surface-container-low border-b border-outline-variant/10">
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex gap-8 overflow-x-auto pb-4 md:pb-0 w-full md:w-auto no-scrollbar">
                    <a href="{{ route('collection.category', $category) }}"
                       class="font-label-caps text-label-caps pb-1 whitespace-nowrap {{ !request('sub') ? 'text-primary border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary transition-colors' }}">
                        TOUTES LES PIÈCES
                    </a>
                    @foreach($subcategories as $sub)
                        <a href="{{ route('collection.category', [$category, 'sub' => $sub->slug]) }}"
                           class="font-label-caps text-label-caps pb-1 whitespace-nowrap {{ request('sub') === $sub->slug ? 'text-primary border-b-2 border-primary' : 'text-on-surface-variant hover:text-primary transition-colors' }}">
                            {{ strtoupper($sub->name) }}
                        </a>
                    @endforeach
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <span class="material-symbols-outlined text-secondary text-[16px]" style="font-variation-settings:'FILL' 1;">verified</span>
                    <span class="font-label-caps text-[10px] text-on-surface-variant uppercase tracking-widest">
                        {{ $products->total() }} pièce(s) — dont vérifiées par notre comité
                    </span>
                </div>
            </div>
        </section>

        {{-- ── GRILLE PRODUITS (connectée à la DB) ── --}}
        <section class="py-section-gap max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
            @if($products->isEmpty())
                <div class="text-center py-20">
                    <span class="material-symbols-outlined text-6xl text-outline-variant block mb-4">inventory_2</span>
                    <p class="font-headline-md text-headline-md text-primary mb-2">Aucune pièce disponible pour le moment</p>
                    <p class="font-body-md text-body-md text-on-surface-variant">Nos artisans travaillent à enrichir cette collection. Revenez bientôt.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-gutter gap-y-16">
                    @foreach($products as $product)
                        @include('collection.partials.product-card', ['product' => $product])
                    @endforeach
                </div>

                <div class="mt-16 flex justify-center">
                    {{ $products->links() }}
                </div>
            @endif
        </section>

        {{-- ── BANDEAU MÉCÉNAT (identique à l'original) ── --}}
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
                            <p class="text-white font-body-md italic">"Chaque pièce raconte une histoire transmise de génération en génération."</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <x-footer></x-footer>

    <script>
        function toggleDrawer() {
            const drawer = document.getElementById('drawer');
            const overlay = document.getElementById('drawer-overlay');
            const isOpen = !drawer.classList.contains('-translate-x-full');
            if (isOpen) {
                drawer.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                overlay.classList.remove('opacity-100');
            } else {
                drawer.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.add('opacity-100'), 10);
            }
        }
        const scrollContainer = document.querySelector('.no-scrollbar');
        if (scrollContainer) {
            scrollContainer.addEventListener('wheel', (evt) => {
                evt.preventDefault();
                scrollContainer.scrollLeft += evt.deltaY;
            });
        }
    </script>
</body>
</html>
