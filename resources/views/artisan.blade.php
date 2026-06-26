<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&amp;family=Playfair+Display:wght@400;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-secondary-fixed": "#241a00",
                        "on-error-container": "#93000a",
                        "on-secondary-fixed-variant": "#574500",
                        "on-secondary": "#ffffff",
                        "on-background": "#1a1c1a",
                        "background": "#faf9f6",
                        "error": "#ba1a1a",
                        "tertiary": "#012F24 ",
                        "surface-container-low": "#f4f3f1",
                        "secondary-fixed-dim": "#e9c349",
                        "surface-container-high": "#e9e8e5",
                        "inverse-surface": "#2f312f",
                        "on-secondary-container": "#745c00",
                        "on-primary-container": "#858383",
                        "on-primary-fixed": "#1c1b1b",
                        "outline-variant": "#c4c7c7",
                        "on-tertiary": "#ffffff",
                        "tertiary-container": "#002114",
                        "on-surface": "#1a1c1a",
                        "surface-container-highest": "#e3e2e0",
                        "on-tertiary-container": "#5e8e77",
                        "error-container": "#ffdad6",
                        "outline": "#747878",
                        "surface-bright": "#faf9f6",
                        "surface": "#faf9f6",
                        "primary-fixed": "#e5e2e1",
                        "primary-container": "#1c1b1b",
                        "surface-container-lowest": "#ffffff",
                        "on-error": "#ffffff",
                        "inverse-primary": "#c9c6c5",
                        "on-primary": "#ffffff",
                        "surface-tint": "#5f5e5e",
                        "surface-container": "#efeeeb",
                        "tertiary-fixed-dim": "#a0d1b8",
                        "secondary": "#735c00",
                        "on-primary-fixed-variant": "#474646",
                        "secondary-container": "#fed65b",
                        "primary": "#012F24 ",
                        "surface-dim": "#dbdad7",
                        "on-tertiary-fixed": "#002114",
                        "inverse-on-surface": "#f2f1ee",
                        "on-tertiary-fixed-variant": "#204f3c",
                        "primary-fixed-dim": "#c9c6c5",
                        "on-surface-variant": "#444748",
                        "surface-variant": "#e3e2e0",
                        "tertiary-fixed": "#bbeed3",
                        "secondary-fixed": "#ffe088"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "margin-tablet": "40px",
                        "margin-mobile": "20px",
                        "section-gap": "120px",
                        "gutter": "24px",
                        "margin-desktop": "80px",
                        "container-max": "1280px"
                    },
                    "fontFamily": {
                        "display-lg": ["Playfair Display"],
                        "body-lg": ["Montserrat"],
                        "price-display": ["Montserrat"],
                        "body-md": ["Montserrat"],
                        "headline-lg": ["Playfair Display"],
                        "label-caps": ["Montserrat"],
                        "headline-md": ["Playfair Display"],
                        "display-lg-mobile": ["Playfair Display"]
                    },
                    "fontSize": {
                        "display-lg": ["64px", {
                            "lineHeight": "72px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "body-lg": ["18px", {
                            "lineHeight": "28px",
                            "fontWeight": "400"
                        }],
                        "price-display": ["20px", {
                            "lineHeight": "24px",
                            "fontWeight": "500"
                        }],
                        "body-md": ["16px", {
                            "lineHeight": "24px",
                            "fontWeight": "400"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "40px",
                            "fontWeight": "600"
                        }],
                        "label-caps": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.1em",
                            "fontWeight": "600"
                        }],
                        "headline-md": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "600"
                        }],
                        "display-lg-mobile": ["40px", {
                            "lineHeight": "48px",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "700"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }

        .glass-nav {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .vendor-card:hover .quick-view-btn {
            opacity: 1;
            transform: translateY(0);
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #faf9f6;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #735c00;
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body class="bg-background text-on-background font-body-md selection:bg-secondary-container">
    <!-- TopAppBar -->
    <header class="fixed top-0 w-full z-50 bg-surface/70 backdrop-blur-xl border-b border-outline-variant/30 h-20 flex justify-between items-center px-margin-mobile md:px-margin-desktop">
        <div class="flex items-center gap-4 cursor-pointer transition-transform duration-200 active:scale-95" id="menu-trigger">
            <span class="material-symbols-outlined text-primary">menu</span>
        </div>
        <h1 class="font-display-lg text-headline-md tracking-widest text-primary">L'ÉCLAT DU BÉNIN</h1>
        <div class="flex items-center gap-4 cursor-pointer transition-transform duration-200 active:scale-95">
            <span class="material-symbols-outlined text-primary">shopping_bag</span>
        </div>
    </header>
    <!-- NavigationDrawer (Mobile/Slide-out) -->
    <div class="fixed inset-0 z-[60] hidden" id="drawer">
        <div class="absolute inset-0 bg-black/20 backdrop-blur-sm" id="drawer-overlay"></div>
        <nav class="absolute left-0 h-full w-80 bg-surface shadow-sm flex flex-col gap-4 p-8 transition-transform duration-300 ease-in-out">
            <div class="flex justify-between items-center mb-8">
                <span class="font-display-lg text-headline-md text-primary">L'ÉCLAT DU BÉNIN</span>
                <span class="material-symbols-outlined cursor-pointer" id="close-drawer">close</span>
            </div>
            <a class="flex items-center gap-4 p-3 text-on-surface-variant hover:bg-surface-container-high transition-all" href="#">
                <span class="material-symbols-outlined">diamond</span>
                <span class="font-label-caps text-label-caps">Jewelry</span>
            </a>
            <a class="flex items-center gap-4 p-3 text-on-surface-variant hover:bg-surface-container-high transition-all" href="#">
                <span class="material-symbols-outlined">shopping_bag</span>
                <span class="font-label-caps text-label-caps">Leather Goods</span>
            </a>
            <a class="flex items-center gap-4 p-3 text-on-surface-variant hover:bg-surface-container-high transition-all" href="#">
                <span class="material-symbols-outlined">palette</span>
                <span class="font-label-caps text-label-caps">Art &amp; Collectibles</span>
            </a>
            <a class="flex items-center gap-4 p-3 text-on-surface-variant hover:bg-surface-container-high transition-all" href="#">
                <span class="material-symbols-outlined">apparel</span>
                <span class="font-label-caps text-label-caps">Fashion</span>
            </a>
            <a class="flex items-center gap-4 p-3 text-primary bg-secondary-container/20 font-semibold transition-all" href="#">
                <span class="material-symbols-outlined">storefront</span>
                <span class="font-label-caps text-label-caps">Stade Artisans</span>
            </a>
        </nav>
    </div>
    <main class="pt-32 pb-section-gap max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <!-- Hero Section -->
        <div class="mb-section-gap text-center max-w-3xl mx-auto">
            <p class="font-label-caps text-label-caps text-secondary mb-4 tracking-widest">ARTISANAL EXCELLENCE</p>
            <h2 class="font-display-lg text-display-lg-mobile md:text-display-lg text-primary mb-6">Les Maîtres du Stade</h2>
            <div class="w-24 h-px bg-secondary-fixed-dim mx-auto mb-8"></div>
            <p class="font-body-lg text-body-lg text-on-surface-variant">
                Découvrez la sélection d'artisans de renom installés au sein de l'emblématique Stade de l'Amitié Mathieu Kérékou. Chaque atelier incarne un héritage fait de précision, d'âme et de savoir-faire béninois.
            </p>
        </div>
        <!-- Filter Chips -->
        <div class="flex flex-wrap justify-center gap-4 mb-16">
            <button class="px-6 py-2 border border-primary bg-primary text-on-primary font-label-caps text-label-caps transition-all">Tous les  Artisans</button>
            <!--<button class="px-6 py-2 border border-outline-variant hover:border-secondary text-on-surface-variant font-label-caps text-label-caps transition-all">Jewelry</button>
            <button class="px-6 py-2 border border-outline-variant hover:border-secondary text-on-surface-variant font-label-caps text-label-caps transition-all">Leather</button>
            <button class="px-6 py-2 border border-outline-variant hover:border-secondary text-on-surface-variant font-label-caps text-label-caps transition-all">Sculpture</button>
            <button class="px-6 py-2 border border-outline-variant hover:border-secondary text-on-surface-variant font-label-caps text-label-caps transition-all">Textiles</button>-->
        </div>
        <!-- Vendor Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-gutter gap-y-20">
            <!-- Vendor 1 -->
            <article class="vendor-card group cursor-pointer">
                <div class="relative aspect-[4/5] overflow-hidden bg-surface-container mb-6">
                    <img alt="Bijouterie Royale Workshop" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="A high-end artisan jewelry workshop in Cotonou, featuring delicate gold-working tools and semi-precious stones scattered on a dark wooden workbench. Soft sunlight filters through a colonial-style window, illuminating floating dust motes and the intricate details of a half-finished gold filigree necklace. The atmosphere is quiet, prestigious, and deeply focused on craftsmanship." src="{{ asset('images/artisans/collier.png')}}" />
                    <div class="quick-view-btn absolute bottom-0 left-0 w-full p-6 opacity-0 translate-y-4 transition-all duration-300">
                        <button class="w-full bg-primary text-on-primary py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-on-primary-fixed transition-colors">Entrez dans l'atelier</button>
                    </div>
                </div>
                <div class="text-center">
                    <span class="font-label-caps text-label-caps text-secondary mb-2 block">GOLD &amp; DIAMONDS</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">Bijouterie Royale</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant">Gate 4, Galerie du Sud</p>
                </div>
            </article>

            <!-- Vendor 2 -->
            <article class="vendor-card group cursor-pointer md:mt-24">
                <div class="relative aspect-[4/5] overflow-hidden bg-surface-container mb-6">
                    <img alt="Cuir du Bénin Studio" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="A luxury leather studio interior with rolls of rich, vegetable-tanned terracotta and mahogany leather stacked neatly against a minimalist white wall. A master artisan’s hands are seen stitching a premium handbag with golden thread under a warm spotlight. The scene captures the high-contrast elegance of deep leather tones against a pristine ivory background, conveying timeless luxury." src="{{ asset('images/artisans/art.png')}}" />
                    <div class="quick-view-btn absolute bottom-0 left-0 w-full p-6 opacity-0 translate-y-4 transition-all duration-300">
                        <button class="w-full bg-primary text-on-primary py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-on-primary-fixed transition-colors">Entrez dans l'atelier</button>
                    </div>
                </div>
                <div class="text-center">
                    <span class="font-label-caps text-label-caps text-secondary mb-2 block">MASTER LEATHERWORKS</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">Cuir du Bénin</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant">Atelier 12, West Wing</p>
                </div>
            </article>
            <!-- Vendor 3 -->
            <article class="vendor-card group cursor-pointer">
                <div class="relative aspect-[4/5] overflow-hidden bg-surface-container mb-6">
                    <img alt="Sculptures de l'Amitié" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="A museum-like gallery space showcasing contemporary Beninese bronze sculptures on tall white pedestals. The lighting is dramatic and directional, creating long, soft shadows. The sculptures are intricate, depicting traditional figures with a modern minimalist twist. The palette is dominated by deep bronze, white, and subtle gold accents on the display bases." src="{{ asset('images/artisans/deco.png')}}" />
                    <div class="quick-view-btn absolute bottom-0 left-0 w-full p-6 opacity-0 translate-y-4 transition-all duration-300">
                        <button class="w-full bg-primary text-on-primary py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-on-primary-fixed transition-colors">Entrez dans l'atelier</button>
                    </div>
                </div>
                <div class="text-center">
                    <span class="font-label-caps text-label-caps text-secondary mb-2 block">BRONZE ARTISTRY</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">Sculptures de l'Amitié</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant">Central Court, Space B</p>
                </div>
            </article>
            <!-- Vendor 4 -->
            <article class="vendor-card group cursor-pointer">
                <div class="relative aspect-[4/5] overflow-hidden bg-surface-container mb-6">
                    <img alt="Atelier Tissage Royal" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Close-up of a traditional loom with vibrant indigo and gold threads being woven into a complex geometric pattern. The morning light emphasizes the rich texture of the hand-spun cotton. The composition is artistic and macro-focused, celebrating the intersection of ancient technique and high-end fashion aesthetics in a bright, airy environment." src="{{ asset('images/artisans/tissu.png')}}" />
                    <div class="quick-view-btn absolute bottom-0 left-0 w-full p-6 opacity-0 translate-y-4 transition-all duration-300">
                        <button class="w-full bg-primary text-on-primary py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-on-primary-fixed transition-colors">Entrez dans l'atelier</button>
                    </div>
                </div>
                <div class="text-center">
                    <span class="font-label-caps text-label-caps text-secondary mb-2 block">HERITAGE WEAVING</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">Tissage Royal</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant">Gate 2, Upper Level</p>
                </div>
            </article>
            <!-- Vendor 5 -->
            <article class="vendor-card group cursor-pointer md:mt-24">
                <div class="relative aspect-[4/5] overflow-hidden bg-surface-container mb-6">
                    <img alt="Maison de la Céramique" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="A minimalist pottery studio with rows of unglazed ivory ceramic vessels resting on raw concrete shelves. A single terracotta vase sits on a potter's wheel in the center, catching a sliver of warm light. The aesthetic is clean, Zen-like, and sophisticated, focusing on form and the natural beauty of the earth-toned materials." src="{{asset('images/artisans/vasse.png')}}" />
                    <div class="quick-view-btn absolute bottom-0 left-0 w-full p-6 opacity-0 translate-y-4 transition-all duration-300">
                        <button class="w-full bg-primary text-on-primary py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-on-primary-fixed transition-colors">Entrez dans l'atelier</button>
                    </div>
                </div>
                <div class="text-center">
                    <span class="font-label-caps text-label-caps text-secondary mb-2 block">FINE CERAMICS</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">Maison de la Céramique</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant">Galerie d'Art, Box 15</p>
                </div>
            </article>
            <!-- Vendor 6 -->
            <article class="vendor-card group cursor-pointer">
                <div class="relative aspect-[4/5] overflow-hidden bg-surface-container mb-6">
                    <img alt="L'Art du Fer" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="An artistic forge where glowing red iron is being shaped into an elegant ornamental gate. Sparks fly in slow motion against a dark, moody background. The scene is industrial yet luxurious, highlighting the raw power of fire and the delicate precision of the blacksmith's art, punctuated by the amber glow of the furnace." src="{{ asset('images/artisans/fer.png') }}" />
                    <div class="quick-view-btn absolute bottom-0 left-0 w-full p-6 opacity-0 translate-y-4 transition-all duration-300">
                        <button class="w-full bg-primary text-on-primary py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-on-primary-fixed transition-colors">Entrez dans l'atelier</button>
                    </div>
                </div>
                <div class="text-center">
                    <span class="font-label-caps text-label-caps text-secondary mb-2 block">METAL ARTISTRY</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">L'Art du Fer</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant">Exterior Workshop D, South Gate</p>
                </div>
            </article>
        </div>
    </main>
    <!-- Footer -->
    <x-footer />
    <script>
        const menuTrigger = document.getElementById('menu-trigger');
        const closeDrawer = document.getElementById('close-drawer');
        const drawer = document.getElementById('drawer');
        const drawerOverlay = document.getElementById('drawer-overlay');
        const nav = drawer.querySelector('nav');

        function openMenu() {
            drawer.classList.remove('hidden');
            setTimeout(() => {
                nav.style.transform = 'translateX(0)';
            }, 10);
        }

        function closeMenu() {
            nav.style.transform = 'translateX(-100%)';
            setTimeout(() => {
                drawer.classList.add('hidden');
            }, 300);
        }

        menuTrigger.addEventListener('click', openMenu);
        closeDrawer.addEventListener('click', closeMenu);
        drawerOverlay.addEventListener('click', closeMenu);

        // Header Scroll Effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 20) {
                header.classList.add('glass-nav');
                header.classList.add('shadow-sm');
            } else {
                header.classList.remove('glass-nav');
                header.classList.remove('shadow-sm');
            }
        });
    </script>
</body>

</html>
