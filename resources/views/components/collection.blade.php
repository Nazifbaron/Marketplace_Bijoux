<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>L'Éclat du Bénin | La Collection Heritage</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&amp;family=Playfair+Display:wght@600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }

        .glass-nav {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .product-card-hover .quick-view {
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }

        .product-card-hover:hover .quick-view {
            opacity: 1;
            transform: translateY(0);
        }

        .line-input {
            border: none;
            border-bottom: 1px solid #747878;
            background: transparent;
            border-radius: 0;
        }

        .line-input:focus {
            outline: none;
            border-bottom: 1px solid #735c00;
            box-shadow: none;
        }
    </style>
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
                        "tertiary": "#000000",
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
                        "primary": "#000000",
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
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body class="bg-background text-on-background font-body-md">
    <!-- TopAppBar -->
    <nav class="fixed top-0 w-full z-50 bg-surface/70 backdrop-blur-xl border-b border-outline-variant/30 h-20 flex justify-between items-center px-margin-mobile md:px-margin-desktop">
        <!--<div class="flex items-center gap-4 cursor-pointer transition-transform duration-200 active:scale-95 text-primary">
            <span class="material-symbols-outlined">menu</span>
        </div>-->
        <h1 class="font-display-lg text-headline-md tracking-widest text-primary">L'ÉCLAT DU BÉNIN</h1>
        <div class="flex items-center gap-6">
            <div class="hidden md:flex gap-8 items-center">
                <a class="font-label-caps text-label-caps text-primary font-bold line-hover relative" href="/">HOME</a>
                <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-secondary transition-colors duration-300 line-hover relative" href="/collection">COLLECTIONS</a>
                <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-secondary transition-colors duration-300 line-hover relative" href="/artisan">ARTISANS</a>
            </div>
            <!--<span class="material-symbols-outlined text-primary cursor-pointer transition-transform duration-200 active:scale-95" data-icon="shopping_bag">shopping_bag</span>-->
        </div>
        <div class="flex items-center gap-6">
            <span class="material-symbols-outlined text-primary cursor-pointer transition-transform duration-200 active:scale-95">search</span>
            <span class="material-symbols-outlined text-primary cursor-pointer transition-transform duration-200 active:scale-95">shopping_bag</span>
        </div>
    </nav>
    <main class="pt-32 pb-section-gap max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
       {{$slot}}
    </main>
    <!-- Footer -->
    <footer class="bg-primary text-on-primary w-full py-section-gap border-t border-outline-variant/10">
        <div class="flex flex-col md:flex-row justify-between items-start px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto w-full gap-12">
            <div class="max-w-sm">
                <h4 class="font-display-lg text-headline-md text-on-primary mb-6">L'ÉCLAT DU BÉNIN</h4>
                <p class="font-body-md text-on-primary/70 mb-8">Valoriser le patrimoine artisanal béninois au rang de luxe mondial. Chaque pièce témoigne de l'âme de notre peuple.</p>
                <div class="flex gap-4">
                    <span class="material-symbols-outlined text-on-primary/70 cursor-pointer hover:text-secondary-fixed transition-colors">public</span>
                    <span class="material-symbols-outlined text-on-primary/70 cursor-pointer hover:text-secondary-fixed transition-colors">mail</span>
                    <span class="material-symbols-outlined text-on-primary/70 cursor-pointer hover:text-secondary-fixed transition-colors">share</span>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-12 w-full md:w-auto">
                <div class="flex flex-col gap-4">
                    <h5 class="font-label-caps text-label-caps text-secondary-fixed-dim">COLLECTION</h5>
                    <a class="text-on-primary/70 font-body-md hover:text-secondary-fixed transition-colors" href="#">Bijoux</a>
                    <a class="text-on-primary/70 font-body-md hover:text-secondary-fixed transition-colors" href="#">Maroquinerie</a>
                    <a class="text-on-primary/70 font-body-md hover:text-secondary-fixed transition-colors" href="#">Artisans</a>
                </div>
                <div class="flex flex-col gap-4">
                    <h5 class="font-label-caps text-label-caps text-secondary-fixed-dim">MAISON</h5>
                    <a class="text-on-primary/70 font-body-md hover:text-secondary-fixed transition-colors" href="#">Notre histoire</a>
                    <a class="text-on-primary/70 font-body-md hover:text-secondary-fixed transition-colors" href="#">Livraison</a>
                    <a class="text-on-primary/70 font-body-md hover:text-secondary-fixed transition-colors" href="#">Contact</a>
                </div>
                <div class="flex flex-col gap-4 col-span-2 md:col-span-1">
                    <h5 class="font-label-caps text-label-caps text-secondary-fixed-dim">NEWSLETTER</h5>
                    <div class="flex gap-2">
                        <input class="bg-transparent border-b border-on-primary/30 py-2 font-label-caps text-label-caps focus:border-secondary-fixed outline-none w-full" placeholder="YOUR EMAIL" type="email" />
                        <button class="material-symbols-outlined">east</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mt-20 pt-8 border-t border-on-primary/10 flex flex-col md:flex-row justify-center">
            <p class="font-body-md text-on-primary/50 text-sm">© 2026 L'Éclat du Bénin. Artisanal Excellence à Cotonou.</p>

        </div>
    </footer>
    <script>
        // Micro-interactions for scrolling
        let lastScrollTop = 0;
        const nav = document.querySelector('nav');

        window.addEventListener('scroll', () => {
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                nav.style.transform = 'translateY(-100%)';
            } else {
                nav.style.transform = 'translateY(0)';
            }
            lastScrollTop = scrollTop;

            if (scrollTop > 50) {
                nav.classList.add('glass-nav');
            } else {
                nav.classList.remove('glass-nav');
            }
        });

        // Simple filter button active state toggle
        const filterButtons = document.querySelectorAll('button.font-label-caps');
        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                filterButtons.forEach(b => {
                    b.classList.remove('bg-secondary', 'text-on-secondary');
                    b.classList.add('border-outline-variant', 'text-on-surface-variant');
                });
                btn.classList.add('bg-secondary', 'text-on-secondary');
                btn.classList.remove('border-outline-variant', 'text-on-surface-variant');
            });
        });
    </script>
</body>

</html>
