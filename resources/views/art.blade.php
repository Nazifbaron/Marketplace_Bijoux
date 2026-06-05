<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Art &amp; Collectibles | L'Éclat du Bénin</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=Montserrat:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-secondary-container": "#745c00",
                        "on-tertiary-fixed-variant": "#204f3c",
                        "on-tertiary-fixed": "#002114",
                        "on-secondary-fixed-variant": "#574500",
                        "on-surface": "#1a1c1a",
                        "on-primary-container": "#858383",
                        "error": "#ba1a1a",
                        "background": "#faf9f6",
                        "primary-fixed-dim": "#c9c6c5",
                        "on-primary": "#ffffff",
                        "outline-variant": "#c4c7c7",
                        "on-error": "#ffffff",
                        "on-background": "#1a1c1a",
                        "primary-fixed": "#e5e2e1",
                        "primary-container": "#1c1b1b",
                        "tertiary-fixed": "#bbeed3",
                        "surface-tint": "#5f5e5e",
                        "surface-container-lowest": "#ffffff",
                        "inverse-primary": "#c9c6c5",
                        "tertiary-fixed-dim": "#a0d1b8",
                        "on-tertiary-container": "#5e8e77",
                        "surface-container": "#efeeeb",
                        "surface-variant": "#e3e2e0",
                        "secondary": "#735c00",
                        "secondary-fixed": "#ffe088",
                        "on-primary-fixed-variant": "#474646",
                        "tertiary": "#000000",
                        "surface-bright": "#faf9f6",
                        "on-secondary": "#ffffff",
                        "inverse-on-surface": "#f2f1ee",
                        "surface-container-low": "#f4f3f1",
                        "surface-container-highest": "#e3e2e0",
                        "on-tertiary": "#ffffff",
                        "primary": "#000000",
                        "on-primary-fixed": "#1c1b1b",
                        "inverse-surface": "#2f312f",
                        "on-error-container": "#93000a",
                        "surface-dim": "#dbdad7",
                        "on-secondary-fixed": "#241a00",
                        "surface-container-high": "#e9e8e5",
                        "secondary-container": "#fed65b",
                        "tertiary-container": "#002114",
                        "outline": "#747878",
                        "on-surface-variant": "#444748",
                        "surface": "#faf9f6",
                        "error-container": "#ffdad6",
                        "secondary-fixed-dim": "#e9c349"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "margin-desktop": "80px",
                        "gutter": "24px",
                        "container-max": "1280px",
                        "section-gap": "120px",
                        "margin-tablet": "40px",
                        "margin-mobile": "20px"
                    },
                    "fontFamily": {
                        "headline-md": ["Playfair Display"],
                        "price-display": ["Montserrat"],
                        "headline-lg": ["Playfair Display"],
                        "display-lg": ["Playfair Display"],
                        "display-lg-mobile": ["Playfair Display"],
                        "body-md": ["Montserrat"],
                        "body-lg": ["Montserrat"],
                        "label-caps": ["Montserrat"]
                    },
                    "fontSize": {
                        "headline-md": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "600"
                        }],
                        "price-display": ["20px", {
                            "lineHeight": "24px",
                            "fontWeight": "500"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "40px",
                            "fontWeight": "600"
                        }],
                        "display-lg": ["64px", {
                            "lineHeight": "72px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "display-lg-mobile": ["40px", {
                            "lineHeight": "48px",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "700"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "28px",
                            "fontWeight": "400"
                        }],
                        "label-caps": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.1em",
                            "fontWeight": "600"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .luxury-line::after {
            content: '';
            display: block;
            width: 0;
            height: 1px;
            background: #735c00;
            transition: width 0.3s ease;
        }

        .luxury-line:hover::after {
            width: 100%;
        }

        .museum-fade-in {
            animation: fadeIn 1.2s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .glass-nav {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body class="bg-background text-on-surface font-body-md selection:bg-secondary-container">
    <!-- TopAppBar -->
    <!--<header class="fixed top-0 w-full z-50 bg-surface/70 backdrop-blur-xl border-b border-outline-variant/30 h-20 flex justify-between items-center px-margin-mobile md:px-margin-desktop">
        <div class="flex items-center gap-4 cursor-pointer transition-transform duration-200 active:scale-95" onclick="toggleDrawer()">
            <span class="material-symbols-outlined text-primary">menu</span>
        </div>
        <h1 class="font-display-lg text-headline-md tracking-widest text-primary">L'ÉCLAT DU BÉNIN</h1>
        <div class="flex items-center gap-6">
            <span class="material-symbols-outlined text-primary cursor-pointer transition-transform duration-200 active:scale-95">search</span>
            <div class="relative cursor-pointer transition-transform duration-200 active:scale-95">
                <span class="material-symbols-outlined text-primary">shopping_bag</span>
                <span class="absolute -top-1 -right-1 bg-secondary text-[10px] text-on-secondary rounded-full w-4 h-4 flex items-center justify-center font-bold">2</span>
            </div>
        </div>
    </header>-->
    <x-collection.header active="art"></x-collection.header>
    <!-- Navigation Drawer (Overlay) -->
    <div class="fixed inset-0 bg-black/40 z-[60] hidden opacity-0 transition-opacity duration-300" id="drawer-overlay" onclick="toggleDrawer()"></div>
    <aside class="fixed top-0 left-0 h-full w-80 bg-surface z-[70] -translate-x-full transition-transform duration-300 ease-in-out shadow-sm flex flex-col gap-4 p-8" id="drawer">
        <div class="flex justify-between items-center mb-8">
            <span class="font-display-lg text-headline-md text-primary">L'ÉCLAT DU BÉNIN</span>
            <span class="material-symbols-outlined cursor-pointer" onclick="toggleDrawer()">close</span>
        </div>
        <nav class="flex flex-col gap-2">
            <a class="px-4 py-3 font-label-caps text-label-caps text-on-surface-variant hover:bg-surface-container-high transition-all" href="#">Jewelry</a>
            <a class="px-4 py-3 font-label-caps text-label-caps text-on-surface-variant hover:bg-surface-container-high transition-all" href="#">Leather Goods</a>
            <a class="px-4 py-3 font-label-caps text-label-caps text-primary bg-secondary-container/20 font-semibold" href="#">Art &amp; Collectibles</a>
            <a class="px-4 py-3 font-label-caps text-label-caps text-on-surface-variant hover:bg-surface-container-high transition-all" href="#">Fashion</a>
            <a class="px-4 py-3 font-label-caps text-label-caps text-on-surface-variant hover:bg-surface-container-high transition-all" href="#">Stade Artisans</a>
        </nav>
    </aside>
    <main class="pt-20">
        <!-- Hero Section: Museum Atmosphere -->
        <section class="relative h-[707px] w-full overflow-hidden flex items-center px-margin-mobile md:px-margin-desktop">
            <div class="absolute inset-0 z-0">
                <img class="w-full h-full object-cover grayscale-[20%] brightness-75" data-alt="A grand, minimalist museum gallery space in Cotonou featuring high ceilings and soft ivory lighting. Large-scale contemporary Beninese paintings and bronze sculptures are positioned with immense spatial breathing room. The atmosphere is quiet, prestigious, and filled with a sense of cultural reverence and artisanal luxury." src="{{asset('images/art/museum-gallery.png')}}"/>
            </div>
            <div class="relative z-10 max-w-2xl museum-fade-in">
                <span class="font-label-caps text-label-caps text-secondary-fixed mb-4 block tracking-[0.2em]">SÉLECTION DE PRODUITS</span>
                <h2 class="font-display-lg text-display-lg-mobile md:text-display-lg text-white mb-6">Art &amp; Décoration</h2>
                <p class="font-body-lg text-white/90 mb-8 max-w-lg">
                    Découvrez l'âme du royaume du Dahomey à travers des objets d'art confectionnés avec un savoir-faire exceptionnel. Chaque pièce est un dialogue entre techniques ancestrales et vision contemporaine.
                </p>
                <div class="flex gap-4">
                    <button class="bg-primary text-white font-label-caps text-label-caps px-8 py-4 hover:bg-primary/90 transition-colors">EXPLOREZ LES ARCHIVES</button>
                    <button class="border border-white/50 text-white font-label-caps text-label-caps px-8 py-4 backdrop-blur-sm hover:bg-white/10 transition-colors">L'HISTOIRE DE L'ARTISAN</button>
                </div>
            </div>
        </section>
        <!-- Gallery Filters -->
        <section class="py-12 bg-surface-container-low border-b border-outline-variant/10">
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex gap-8 overflow-x-auto pb-4 md:pb-0 w-full md:w-auto no-scrollbar">
                    <button class="font-label-caps text-label-caps text-primary border-b-2 border-primary pb-1 whitespace-nowrap">TOUTES LES ŒUVRES</button>
                    <button class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors pb-1 whitespace-nowrap">SCULPTURES</button>
                    <button class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors pb-1 whitespace-nowrap">PEINTURES</button>
                    <button class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors pb-1 whitespace-nowrap">DÉCORATION D'INTÉRIEUR</button>
                </div>
                <div class="flex items-center gap-4 w-full md:w-auto justify-end">
                    <span class="font-label-caps text-label-caps text-on-surface-variant">TRIER PAR:</span>
                    <select class="bg-transparent border-none font-label-caps text-label-caps text-primary focus:ring-0 cursor-pointer">
                        <option>IMPORTANCE</option>
                        <option>NOUVELLES ACQUISITIONS</option>
                        <option>PRIX : DU PLUS ÉLEVÉ AU PLUS BAS</option>
                    </select>
                </div>
            </div>
        </section>
        <!-- Main Product Grid: Asymmetric Layout -->
        <section class="py-section-gap max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-y-24 gap-x-gutter">
                <!-- Item 1: Large Featured Sculpture -->
                <div class="md:col-span-7 group cursor-pointer">
                    <div class="aspect-[4/5] overflow-hidden bg-surface-container relative mb-6">
                        <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="A masterful Beninese bronze sculpture of a royal leopard, showing intricate traditional lost-wax casting details. The piece is set against a clean, warm ivory backdrop with dramatic, high-contrast lighting that highlights the metallic sheen and artisanal texture. Professional museum photography style." src="{{ asset('images/art/leopard-of-dahomey.png') }}" />
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-500"></div>
                        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button class="bg-white text-primary font-label-caps text-label-caps px-6 py-3 shadow-xl">QUICK VIEW</button>
                        </div>
                    </div>
                    <div class="flex flex-col items-center text-center">
                        <span class="font-label-caps text-[10px] text-secondary mb-2">COUR ROYALE D'ABOMEY</span>
                        <h3 class="font-headline-md text-headline-md mb-2">Le Léopard du Dahomey</h3>
                        <p class="font-price-display text-price-display text-on-surface-variant mb-4">2.450F CFA</p>
                        <div class="w-12 h-[1px] bg-outline-variant/50"></div>
                    </div>
                </div>
                <!-- Item 2: Vertical Contemporary Piece -->
                <div class="md:col-span-5 md:pt-32 group cursor-pointer">
                    <div class="aspect-[2/3] overflow-hidden bg-surface-container relative mb-6">
                        <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="A contemporary carved wooden wall relief by a modern Cotonou artisan. The dark mahogany wood features geometric patterns inspired by Fon cosmology. Soft side lighting creates deep shadows and emphasizes the hand-carved textures. Minimalist luxury presentation." src="{{asset('images/art/table.png')}}" />
                        <div class="absolute top-6 left-6">
                            <span class="bg-primary text-white text-[10px] font-label-caps px-3 py-1">ÉDITION LIMITÉE</span>
                        </div>
                    </div>
                    <div class="flex flex-col items-start px-4">
                        <span class="font-label-caps text-[10px] text-on-tertiary-container mb-2">ACAJOU SCULPTÉ À LA MAIN</span>
                        <h3 class="font-headline-md text-headline-md mb-2">Échos ancestraux I</h3>
                        <p class="font-price-display text-price-display text-on-surface-variant mb-4">1.100F CFA</p>
                    </div>
                </div>
                <!-- Item 3: Wide Layout Painting -->
                <div class="md:col-span-12 group cursor-pointer pt-12">
                    <div class="flex flex-col md:flex-row gap-gutter bg-surface-container-low p-8 items-center">
                        <div class="w-full md:w-2/3 aspect-video overflow-hidden">
                            <img class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" data-alt="A large scale abstract oil painting by a Beninese contemporary artist. The canvas uses a palette of rich golds, deep ochres, and charcoal blacks. The brushwork is expressive and textured, conveying a sense of historical movement. Photographed in a high-end architectural interior." src="{{asset('images/art/tablo.png')}}" />
                        </div>
                        <div class="w-full md:w-1/3 flex flex-col justify-center py-8">
                            <span class="font-label-caps text-label-caps text-secondary mb-4">SÉRIE MASTERPIECE</span>
                            <h3 class="font-display-lg text-headline-lg mb-4">Terre cuite éclatante</h3>
                            <p class="font-body-md text-on-surface-variant mb-8">Une exploration immersive du sol qui a donné naissance à Cotonou, à travers des techniques mixtes et des pigments naturels.</p>
                            <p class="font-price-display text-headline-md mb-8">4.800F CFA</p>
                            <button class="w-full md:w-fit border border-primary text-primary font-label-caps text-label-caps px-12 py-4 hover:bg-primary hover:text-white transition-all duration-300">ACHETER CET ARTICLE</button>
                        </div>
                    </div>
                </div>
                <!-- Item 4: Grid Small Item -->
                <div class="md:col-span-4 group cursor-pointer">
                    <div class="aspect-square overflow-hidden bg-surface-container relative mb-6">
                        <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="A collection of small artisanal ceramic vessels in varying shades of ivory and charcoal. Each vessel has a unique, hand-pinched texture and subtle golden glaze along the rim. They are arranged on a minimalist stone plinth in a bright, modern studio." src="{{asset('images/art/ceramic.png')}}" />
                    </div>
                    <div class="flex flex-col items-center text-center">
                        <span class="font-label-caps text-[10px] text-on-surface-variant mb-2">ARTS DE LA CÉRAMIQUE</span>
                        <h3 class="font-headline-md text-headline-md mb-2">Série « Argile côtière »</h3>
                        <p class="font-price-display text-price-display text-on-surface-variant">320F CFA</p>
                    </div>
                </div>
                <!-- Item 5: Grid Small Item -->
                <div class="md:col-span-4 group cursor-pointer">
                    <div class="aspect-square overflow-hidden bg-surface-container relative mb-6">
                        <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="A portrait photograph of a traditional Beninese mask, hand-woven from raffia and adorned with cowrie shells. The lighting is soft and directional, casting long shadows that emphasize the organic fibers and the craftsmanship of the Porto-Novo region." src="{{asset('images/art/mask.png')}}" />
                    </div>
                    <div class="flex flex-col items-center text-center">
                        <span class="font-label-caps text-[10px] text-on-surface-variant mb-2">SCULPTURE TEXTILE</span>
                        <h3 class="font-headline-md text-headline-md mb-2">Le Gardien des secrets</h3>
                        <p class="font-price-display text-price-display text-on-surface-variant">890F CFA</p>
                    </div>
                </div>
                <!-- Item 6: Grid Small Item -->
                <div class="md:col-span-4 group cursor-pointer">
                    <div class="aspect-square overflow-hidden bg-surface-container relative mb-6 border border-outline-variant/20">
                        <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Modern geometric bronze bookends with a dark patina. The design is inspired by the architecture of the Royal Palaces of Abomey. They are displayed on a white marble shelf in a high-end luxury interior setting, reflecting a fusion of heritage and modern design." src="{{asset('images/art/card.png')}}" />
                    </div>
                    <div class="flex flex-col items-center text-center">
                        <span class="font-label-caps text-[10px] text-on-surface-variant mb-2">ACCESSOIRES DE DÉCORATION</span>
                        <h3 class="font-headline-md text-headline-md mb-2">Serre-livres « Palace Gates »</h3>
                        <p class="font-price-display text-price-display text-on-surface-variant">1.550F CFA</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Newsletter / Artisan Callout -->
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
                    <img class="w-full h-full object-cover opacity-80" data-alt="Close up of an artisan's hands working with molten bronze in a traditional foundry. Sparks fly in a dimly lit, atmospheric workshop. The photo captures the intense focus and ancestral skill required for Beninese lost-wax casting. Warm, fiery lighting tones." src="{{ asset('images/art/fer.png') }}" />
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="bg-white/10 backdrop-blur-md p-12 text-center max-w-sm border border-white/20">
                            <span class="material-symbols-outlined text-white text-5xl mb-4">workspace_premium</span>
                            <p class="text-white font-body-md italic">"Chaque coup de ciseau est une prière adressée aux ancêtres, qui perpétue une histoire commencée il y a des siècles."</p>
                            <p class="text-white/60 font-label-caps text-[10px] mt-4">— KOBA, MAÎTRE SCULPTEUR</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- Footer -->
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

        // Horizontal scroll animation for mobile categories
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
