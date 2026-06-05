<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>L'Éclat du Bénin | Rejoignez le Cercle des Maîtres</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&amp;family=Playfair+Display:wght@600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }

        .luxury-gradient {
            background: linear-gradient(to bottom, rgba(250, 249, 246, 0) 0%, rgba(250, 249, 246, 1) 100%);
        }

        .gold-shimmer:hover {
            box-shadow: 0 0 15px rgba(233, 195, 73, 0.3);
            border-color: #ffe088;
        }

        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-tint": "#5f5e5e",
                        "surface-container-low": "#f4f3f1",
                        "on-error-container": "#93000a",
                        "surface-container": "#efeeeb",
                        "primary": "#000000",
                        "primary-fixed": "#e5e2e1",
                        "surface-container-highest": "#e3e2e0",
                        "on-tertiary": "#ffffff",
                        "surface-container-high": "#e9e8e5",
                        "on-tertiary-container": "#5e8e77",
                        "on-surface-variant": "#444748",
                        "secondary-fixed-dim": "#e9c349",
                        "outline": "#747878",
                        "inverse-on-surface": "#f2f1ee",
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed-dim": "#c9c6c5",
                        "tertiary-fixed-dim": "#a0d1b8",
                        "on-tertiary-fixed-variant": "#204f3c",
                        "on-background": "#1a1c1a",
                        "background": "#faf9f6",
                        "surface-dim": "#dbdad7",
                        "on-secondary-container": "#745c00",
                        "on-surface": "#1a1c1a",
                        "secondary-fixed": "#ffe088",
                        "on-primary-fixed-variant": "#474646",
                        "inverse-primary": "#c9c6c5",
                        "tertiary-fixed": "#bbeed3",
                        "on-error": "#ffffff",
                        "tertiary": "#000000",
                        "tertiary-container": "#002114",
                        "secondary-container": "#fed65b",
                        "outline-variant": "#c4c7c7",
                        "on-tertiary-fixed": "#002114",
                        "inverse-surface": "#2f312f",
                        "error-container": "#ffdad6",
                        "surface-variant": "#e3e2e0",
                        "on-secondary-fixed": "#241a00",
                        "on-primary-fixed": "#1c1b1b",
                        "surface": "#faf9f6",
                        "primary-container": "#1c1b1b",
                        "on-secondary-fixed-variant": "#574500",
                        "on-secondary": "#ffffff",
                        "on-primary-container": "#858383",
                        "secondary": "#735c00",
                        "error": "#ba1a1a",
                        "surface-bright": "#faf9f6",
                        "on-primary": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "margin-desktop": "80px",
                        "container-max": "1280px",
                        "margin-tablet": "40px",
                        "gutter": "24px",
                        "margin-mobile": "20px",
                        "section-gap": "120px"
                    },
                    "fontFamily": {
                        "label-caps": ["Montserrat"],
                        "display-lg": ["Playfair Display"],
                        "price-display": ["Montserrat"],
                        "display-lg-mobile": ["Playfair Display"],
                        "body-md": ["Montserrat"],
                        "body-lg": ["Montserrat"],
                        "headline-md": ["Playfair Display"],
                        "headline-lg": ["Playfair Display"]
                    },
                    "fontSize": {
                        "label-caps": ["12px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.1em",
                            "fontWeight": "600"
                        }],
                        "display-lg": ["64px", {
                            "lineHeight": "72px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "price-display": ["20px", {
                            "lineHeight": "24px",
                            "fontWeight": "500"
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
                        "headline-md": ["24px", {
                            "lineHeight": "32px",
                            "fontWeight": "600"
                        }],
                        "headline-lg": ["32px", {
                            "lineHeight": "40px",
                            "fontWeight": "600"
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

<body class="bg-surface text-on-surface selection:bg-secondary-fixed/30 overflow-x-hidden">
    <!-- TopAppBar -->
    <header class="fixed top-0 w-full z-50 bg-surface/70 backdrop-blur-xl border-b border-outline-variant/30 flex justify-between items-center px-gutter py-4">
        <div class="flex items-center gap-4">
            <!--<span class="material-symbols-outlined text-primary cursor-pointer active:opacity-80 transition-opacity">menu</span>-->
        </div>
        <div class="hidden md:flex gap-8 items-center">
            <a class="font-label-caps text-label-caps text-primary font-bold line-hover relative" href="/">HOME</a>
            <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-secondary transition-colors duration-300 line-hover relative" href="/collection">COLLECTIONS</a>
            <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-secondary transition-colors duration-300 line-hover relative" href="/artisan">ARTISANS</a>
        </div>
        <div class="flex items-center gap-4">
            <span class="material-symbols-outlined text-primary cursor-pointer active:opacity-80 transition-opacity">account_circle</span>
        </div>
    </header>
    <!-- Hero Section -->
    <section class="relative h-[795px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover" data-alt="A master artisan in Benin working on intricate gold jewelry in a sun-drenched, high-end studio. The lighting is soft and cinematic, highlighting the dust particles in the air and the fine details of the craftsmanship. The color palette is dominated by ivory, rich gold, and deep blacks, reflecting a luxurious and editorial aesthetic. The mood is one of quiet intensity and professional mastery." src="https://lh3.googleusercontent.com/aida-public/AB6AXuB6X-3MGWOA3C2MAvO6cRh_8t0e_Is1V3XfpvhggPkwIXFoRZGYHXgVCIhwzoaybHCwLhx8Qzlz9X7QyQ_89d9C75bUUBtr8oUnhVBX3afp0TOZ7O9uQBIhDMJDWVKcbh-JTx3qiTs5pFGJDA-RkA8-KkOrm95vmMLJkjNpLYO1kxcDHgf00UiIgbbNt3b9-4fuCuSIi05_7qXoumUvO_ie4p9QFF66sfaeANobCp_tMgx2fxVmypNszMW7Hg4HTH3XwBgNZQir8A" />
            <div class="absolute inset-0 bg-black/40"></div>
            <div class="absolute inset-0 luxury-gradient"></div>
        </div>
        <div class="relative z-10 text-center px-margin-mobile md:px-margin-desktop max-w-4xl">
            <span class="font-label-caps text-label-caps text-secondary-fixed mb-6 block uppercase tracking-[0.3em]">Héritage &amp; Excellence</span>
            <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-surface mb-8">
                Rejoignez notre marketplace d’artisanat haut de gamme
            </h1>
            <p class="font-body-lg text-body-lg text-surface-container-low mb-12 max-w-2xl mx-auto">
                Exposez vos créations à une clientèle locale à la recherche de produits authentiques, raffinés et porteurs d’histoire.
            </p>
            <a href="{{ route('artisan.onboarding.step1') }}" class="bg-primary text-on-primary px-12 py-5 font-label-caps text-label-caps uppercase tracking-widest transition-all duration-300 hover:bg-on-surface-variant hover:shadow-xl active:scale-95">
                Créer ma boutique
            </a>
        </div>
    </section>
    <!-- Value Propositions (Bento Grid) -->
    <section class="py-section-gap px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
        <div class="text-center mb-24">
            <h2 class="font-headline-lg text-headline-lg text-primary mb-4">Pourquoi vendre sur notre plateforme ?</h2>
            <div class="h-px w-24 bg-secondary-fixed-dim mx-auto"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 h-auto md:h-[600px]">
            <!-- Global Visibility -->
            <div class="md:col-span-7 bg-surface-container-low p-12 flex flex-col justify-between border border-outline-variant/20 hover:border-secondary-fixed transition-colors duration-500 group">
                <div class="flex justify-between items-start">
                    <div class="bg-primary p-4 rounded-full">
                        <span class="material-symbols-outlined text-white" style="font-variation-settings: 'FILL' 1;">public</span>
                    </div>
                    <span class="font-display-lg text-surface-container-highest opacity-50">01</span>
                </div>
                <div>
                    <h3 class="font-headline-md text-headline-md mb-4">Visibilité </h3>
                    <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                        Faites découvrir votre travail au Bénin comme ailleurs grâce à une marketplace pensée pour valoriser les talents artisanaux.
                    </p>
                </div>
            </div>
            <!-- Luxury Logistics -->
            <div class="md:col-span-5 bg-primary p-12 flex flex-col justify-between text-on-primary group">
                <div class="flex justify-between items-start">
                    <span class="material-symbols-outlined text-secondary-fixed text-4xl">inventory_2</span>
                    <span class="font-display-lg text-on-primary-container opacity-30">02</span>
                </div>
                <div>
                    <h3 class="font-headline-md text-headline-md mb-4">Une vitrine haut de gamme</h3>
                    <p class="font-body-md text-body-md text-primary-fixed-dim leading-relaxed">
                        Présentez vos produits dans un univers visuel premium qui met en valeur la qualité de vos créations et renforce la confiance des acheteurs.
                    </p>
                </div>
            </div>
            <!-- Secure Payouts -->
            <div class="md:col-span-12 bg-surface-container-highest p-12 flex flex-col md:flex-row gap-12 items-center border border-outline-variant/20">
                <div class="md:w-1/3">
                    <span class="material-symbols-outlined text-secondary-fixed text-5xl mb-6">verified_user</span>
                    <h3 class="font-headline-md text-headline-md mb-4">Paiements sécurisés</h3>
                    <span class="font-label-caps text-label-caps text-on-surface-variant block mb-4">CONFIANCE &amp; TRANSPARENCE</span>
                </div>
                <div class="md:w-2/3">
                    <p class="font-body-lg text-body-lg text-on-surface-variant">
                        Notre système de paiement garantit que chaque vente est traitée avec une sécurité de niveau bancaire. Recevez vos fonds directement sur votre compte local, sans tracas ni délais imprévus. Nous protégeons la valeur de votre travail.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Atmospheric Feature Section (Asymmetric) -->
    <section class="py-section-gap bg-surface-container-low overflow-hidden">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row items-center gap-20">
            <div class="w-full md:w-1/2 relative">
                <div class="absolute -top-10 -left-10 w-40 h-40 border-l border-t border-secondary-fixed-dim"></div>
                <img class="w-full h-[600px] object-cover grayscale hover:grayscale-0 transition-all duration-700 shadow-2xl" data-alt="Close up shot of handcrafted Beninese leather goods being stitched by hand. The focus is on the needle and thread, with soft shallow depth of field. The lighting is warm and golden, accentuating the texture of the high-quality leather. The scene is shot in a minimalist studio with ivory walls and clean black accents, emphasizing artisanal luxury." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAx8trkr-MKR7dmv1Qdo8lVS2EktTVRYgVOZOsuqEGk393FbsKmN9ciTr4zhJ-lWteuXopIz8ek10S4Fpthssco7f6Z-HuFujIhrU-ZibGhwZV-CUaATEscrbuKuzJRuxln1YyLI6LJwC2fSI5kaO_BlCs1hGS51slCM7bd_ThQP-gCcVm9sM7sjpAssdDVkLTpUifS5z7g49B3370yhnVM3OP6URDZ4U0MsI7_3c4kKCaHso0KKJsjcLNvS2vfBmNeYR_PH95SA" />
            </div>
            <div class="w-full md:w-1/2">
                <span class="font-label-caps text-label-caps text-secondary-fixed mb-4 block">L'EXCLUSIVITÉ</span>
                <h2 class="font-display-lg-mobile md:font-headline-lg text-display-lg-mobile md:text-headline-lg mb-8">Plus qu'une boutique, une distinction.</h2>
                <div class="space-y-8">
                    <div class="flex gap-6">
                        <span class="material-symbols-outlined text-primary">auto_awesome</span>
                        <div>
                            <h4 class="font-body-lg font-bold mb-2">Une expérience sur mesure</h4>
                            <p class="font-body-md text-on-surface-variant">Seuls les artisans répondant à nos critères de haute excellence sont invités.</p>
                        </div>
                    </div>
                    <div class="flex gap-6">
                        <span class="material-symbols-outlined text-primary">diamond</span>
                        <div>
                            <h4 class="font-body-lg font-bold mb-2">Positionnement de marque</h4>
                            <p class="font-body-md text-on-surface-variant">Nous racontons votre histoire avec des photographies et du texte de qualité éditoriale.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Final CTA -->
    <section class="py-section-gap px-margin-mobile md:px-margin-desktop text-center bg-white border-y border-outline-variant/30">
        <div class="max-w-3xl mx-auto">
            <h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg mb-8">Prêt à ouvrir votre boutique ?</h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-12">
                Votre savoir-faire mérite une visibilité à la hauteur de votre talent. Rejoignez une marketplace qui valorise les créations artisanales haut de gamme.
            </p>
            <div class="flex flex-col md:flex-row justify-center gap-6">
                <a href="/inscription" class="bg-primary text-on-primary px-16 py-6 font-label-caps text-label-caps uppercase tracking-widest hover:bg-on-surface-variant transition-colors duration-300">
                    Créer ma boutique
                </a>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <x-footer />
    <script>
        // Micro-interactions for smooth scrolling or hover effects
        document.querySelectorAll('button').forEach(btn => {
            btn.addEventListener('mouseenter', () => {
                // Potential for adding subtle sound or haptic feedback triggers here
            });
        });

        // Simple Fade-in animation on scroll
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100');
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                }
            });
        }, observerOptions);

        document.querySelectorAll('section > div').forEach(el => {
            el.classList.add('transition-all', 'duration-1000', 'opacity-0', 'translate-y-10');
            observer.observe(el);
        });
    </script>
</body>

</html>
