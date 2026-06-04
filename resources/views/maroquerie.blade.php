<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&amp;family=Playfair+Display:wght@400;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
        .backdrop-blur-xl {
            backdrop-filter: blur(24px);
        }

        .transition-colors {
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
        }

        .font-display-lg {
            font-family: 'Playfair Display', serif;
        }

        .font-label-caps {
            font-family: 'Montserrat', sans-serif;
            text-transform: uppercase;
        }

        .hairline-border {
            border: 1px solid rgba(116, 120, 120, 0.15);
        }

        .gold-border-hover:hover {
            border-color: #735c00;
        }

        .image-zoom-container {
            overflow: hidden;
        }

        .image-zoom-container img {
            transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .image-zoom-container:hover img {
            transform: scale(1.05);
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body class="bg-background text-on-background font-body-md selection:bg-secondary-container selection:text-on-secondary-container">
    <!-- TopAppBar -->
    <header class="fixed top-0 w-full z-50 bg-surface/70 backdrop-blur-xl border-b border-outline-variant/30 h-20 flex justify-between items-center px-margin-mobile md:px-margin-desktop">
        <div class="flex items-center gap-4">
            <span class="material-symbols-outlined text-primary cursor-pointer transition-transform duration-200 active:scale-95" data-icon="menu">menu</span>
        </div>
        <h1 class="font-display-lg text-headline-md tracking-widest text-primary">L'ÉCLAT DU BÉNIN</h1>
        <div class="flex items-center gap-6">
            <span class="material-symbols-outlined text-primary cursor-pointer transition-transform duration-200 active:scale-95 hidden md:block" data-icon="search">search</span>
            <span class="material-symbols-outlined text-primary cursor-pointer transition-transform duration-200 active:scale-95" data-icon="shopping_bag">shopping_bag</span>
        </div>
    </header>
    <main class="pt-20">
        <!-- Hero Section -->
        <section class="relative h-[618px] w-full flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img class="w-full h-full object-cover grayscale-[20%] contrast-[1.1]" data-alt="A high-end cinematic shot of a luxury leather satchel placed on a minimalist ivory stone plinth. The lighting is soft and directional, highlighting the rich grain of the hand-stitched tan leather. The environment is an expansive, minimalist gallery with high ceilings and soft shadows, evoking a sense of heritage and exclusivity in a modern light-mode setting. The color palette is dominated by warm ochre, ivory, and deep black accents." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBWEsARk7YUv9fLLg1kPZCwfPxhfzuFvPv_bu0BYrN13308Pru7RJwu5vknLRTlYBmz59UsEj2HxZ4W9hXVP4CTGVWiHDA8XA_4ZhgE_G4O1b72jmJmH8ppg8YdS-Pn6O5P4wPdjWDViMObM50G6HtoA-sV9hMGx6U3zbtn7CkeNaivb4mlgDu4jVkOZFFisqnVGwEFTK_KFzj2rzpFBVd4Rby2tHTXIrwMjKi16f-lY3O2mNlqJNt0zkOThGuBlezZVU3hvlSQFQ" />
                <div class="absolute inset-0 bg-primary/20"></div>
            </div>
            <div class="relative z-10 text-center px-margin-mobile">
                <span class="font-label-caps text-label-caps text-white mb-4 block tracking-[0.3em]">Héritage d'Excellence</span>
                <h2 class="font-display-lg text-display-lg-mobile md:text-display-lg text-white mb-6 uppercase">Maroquinerie</h2>
                <p class="font-body-lg text-white/90 max-w-2xl mx-auto italic">Des pièces uniques façonnées à la main par nos maîtres artisans de Cotonou, alliant tradition ancestrale et élégance contemporaine.</p>
            </div>
        </section>
        <!-- Category Filters -->
        <nav class="sticky top-20 z-40 bg-background/90 backdrop-blur-md border-b border-outline-variant/10">
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-6 flex flex-wrap justify-center gap-8 md:gap-16">
                <a class="font-label-caps text-label-caps text-primary border-b-2 border-primary pb-1" href="#">All Collections</a>
                <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors pb-1" href="#">Handbags</a>
                <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors pb-1" href="#">Travel</a>
                <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors pb-1" href="#">Accessories</a>
            </div>
        </nav>
        <!-- Product Grid Section -->
        <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-gutter">
                <!-- Large Featured Item -->
                <div class="md:col-span-8 group">
                    <div class="image-zoom-container relative aspect-[4/3] bg-surface-container-low hairline-border overflow-hidden">
                        <img class="w-full h-full object-cover" data-alt="A detailed close-up of the 'Dahomey Satchel', showing the intricate hand-stitching and the premium texture of the dark ebony leather. The bag features a subtle gold-toned brass clasp and is photographed in a bright, high-contrast studio environment. The background is a soft ivory gradient, maintaining a luxury boutique aesthetic with professional lighting that emphasizes the tactile quality of the leather." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAEPbC0F7jozYDEYeuO34tHfrRbpqZjO-AzfXaAOhxMk90-f1dtzVNfrpJmnYPUeK9-HVvZIpAjKazMLy-RbQAKtSr3xsvahXQ0E0cLecKhjcIkYWF5qckLPlDoQj_tPhCEiCuyLQnC1kG2Soum4uY4HoMWcdQ1bdkhs9QaiFzTv-Ek_Qg4JDb4mSqGDkLLGWmpoAmEy0gHsEiR4y2EmScszPRi08xRziCZVzrSD-mk7f2u4e9M9NtIprq-BG7uM2XkscO12whe6g" />
                        <button class="absolute bottom-6 left-1/2 -translate-x-1/2 bg-primary text-on-primary px-8 py-3 font-label-caps text-label-caps opacity-0 group-hover:opacity-100 transition-opacity duration-300">Quick View</button>
                    </div>
                    <div class="mt-8 text-center md:text-left flex justify-between items-end">
                        <div>
                            <span class="font-label-caps text-[10px] text-secondary tracking-widest uppercase mb-2 block">Atelier de Maroquinerie</span>
                            <h3 class="font-headline-md text-headline-md text-primary uppercase">Dahomey Satchel</h3>
                            <p class="font-body-md text-on-surface-variant mt-1">Hand-stitched full-grain calfskin with bronze hardware.</p>
                        </div>
                        <p class="font-price-display text-price-display text-primary">€1,450</p>
                    </div>
                </div>
                <!-- Small Grid Column -->
                <div class="md:col-span-4 flex flex-col gap-gutter">
                    <!-- Product 2 -->
                    <div class="group">
                        <div class="image-zoom-container relative aspect-[4/5] bg-surface-container-low hairline-border overflow-hidden">
                            <img class="w-full h-full object-cover" data-alt="A luxury leather clutch in a deep emerald green, styled against a minimalist cream-colored background. The product is framed by plenty of negative space to create an editorial feel. Soft, warm lighting casts gentle shadows, emphasizing the smooth surface of the premium leather. The overall aesthetic is one of understated luxury and sophisticated craftsmanship." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDN61m_AKi0VbtxgrbLfJI1hEHrZx49ZEs8ZQ5kYn57xk-hlPtEj76ZEWtYrfyT1zryvl-1hgJk9IN0aRpcZHBlWK30aCjMr156g7Mx_s6zADebB6ccQMGxNeQKupysKzkgKfDieNkBAfJtT-QJ0NbwMxFnSHeXv_6_ZTkJdZR3Y9V3TJHnSchyNFNJNyjxDGUV7z7md8-vunI6ooQYAkk1JSXyPus2pYQYtR_eZMvPs85FVh_fz_SmZhZwxMzSg6eXb3LuFoGdug" />
                        </div>
                        <div class="mt-6 text-center">
                            <span class="font-label-caps text-[10px] text-secondary tracking-widest uppercase mb-1 block">Atelier de Maroquinerie</span>
                            <h3 class="font-body-lg font-semibold text-primary uppercase">Nocturne Clutch</h3>
                            <p class="font-price-display text-price-display mt-1 text-primary">€890</p>
                        </div>
                    </div>
                </div>
                <!-- Three Column Row -->
                <div class="md:col-span-4 group mt-8">
                    <div class="image-zoom-container relative aspect-square bg-surface-container-low hairline-border overflow-hidden">
                        <img class="w-full h-full object-cover" data-alt="A luxury leather travel bag in a rich cognac brown, positioned on a polished dark wood surface in a bright, modern interior. The lighting is natural and airy, highlighting the bag's structural elegance and the quality of the Beninese artisanal stitching. The scene conveys a sense of high-end travel and heritage, using a palette of warm earth tones and clean ivory." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDp5h-eGe1GHZb-6HlCNrWCVGbiPnq11nu5AcCgzlp-BmIswQJQFfP_b5E9eloq-94fatdx8p1RVHQqqRE-kZzZTWWNXx7cT1bQ-Fn6J31K0rf_TBnIta34R2Yzwu75vfY8SPmR9nV8pUtkozzhSaF_5abLE2z-f1LLBtD9rGPmIWqHvnYOxnPJdlg0_AV_HYFQVZgmjSfwKOZzmI8rJ1wwSNdRUrAhPjRs-R7if68fQgRnOXZ1zp7Epu1CcVwBmlGKx4JPNYHLbA" />
                    </div>
                    <div class="mt-6 text-center">
                        <span class="font-label-caps text-[10px] text-secondary tracking-widest uppercase mb-1 block">Atelier de Maroquinerie</span>
                        <h3 class="font-body-lg font-semibold text-primary uppercase">Voyageur Weekender</h3>
                        <p class="font-price-display text-price-display mt-1 text-primary">€2,100</p>
                    </div>
                </div>
                <div class="md:col-span-4 group mt-8">
                    <div class="image-zoom-container relative aspect-square bg-surface-container-low hairline-border overflow-hidden">
                        <img class="w-full h-full object-cover" data-alt="A minimalist display of a luxury leather belt with a custom-designed gold buckle, laid out on a textured linen surface. The composition is clean and focused, using high-key lighting to emphasize the contrast between the deep black leather and the shimmering gold metal. The mood is exclusive and premium, typical of a high-end Beninese fashion boutique." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCN3UL4Kz2x61qPdzScwa8oI0DjWPVm0iG3lgGyYuzaWBrqT9fJrzzWIbisA4_EHeDmW8TSLRRXNKWF-5FJdIW4AIXaC9topa3MRav3GeSjPpD9PYqxvgMK3YnJk0TNkVwjxHWvaSf2EShuVrNXbMdK_1vjZ79LY2Fh84MBFCUuTPZ792WJW1CJcqfGLDGMOaVYd2oVOSIF9lpz1UW5ZaMxEhPKCkBRfYBNlIndNo1vBQib39PlmaCfxpivYsSdsLTDRxgobNwSlw" />
                    </div>
                    <div class="mt-6 text-center">
                        <span class="font-label-caps text-[10px] text-secondary tracking-widest uppercase mb-1 block">Atelier de Maroquinerie</span>
                        <h3 class="font-body-lg font-semibold text-primary uppercase">Signature Belt</h3>
                        <p class="font-price-display text-price-display mt-1 text-primary">€320</p>
                    </div>
                </div>
                <div class="md:col-span-4 group mt-8">
                    <div class="image-zoom-container relative aspect-square bg-surface-container-low hairline-border overflow-hidden">
                        <img class="w-full h-full object-cover" data-alt="A selection of small luxury leather accessories, including a cardholder and a passport cover, arranged artistically on a marble surface. The lighting is crisp and clear, creating a bright and prestigious atmosphere. The colors are sophisticated neutrals—black, tan, and ivory—underlining the 'Maroquinerie d'Exception' theme of artisanal excellence and modern luxury." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBaWNHOlZkfRq99JaqTBWIZu-eB2zhy9TqnSjvpPjJE2mgMmewCHuzh0BQeZAAn3a5_iZtNFwTloPZ_2yfLqBvpJI7Lv6ncTglwDqvyI_HDGHUlPUpNkG4bOmn3eoz2UHpYMfY6ybT2tNdCH-vHFU4dw6jZyQelSLNuzY5oEgCVqReEUFWNimvjiK2k1q6whnjNWbEPTuC6BTANqt0oG15Xzjw-VWIJM8db7L0z6QAODE5Axu_UaAaAB--F3h_5FGEks1EvJkyIrA" />
                    </div>
                    <div class="mt-6 text-center">
                        <span class="font-label-caps text-[10px] text-secondary tracking-widest uppercase mb-1 block">Atelier de Maroquinerie</span>
                        <h3 class="font-body-lg font-semibold text-primary uppercase">Essential Cardholder</h3>
                        <p class="font-price-display text-price-display mt-1 text-primary">€195</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Brand Story Section -->
        <section class="bg-surface-container-low py-section-gap overflow-hidden">
            <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop grid grid-cols-1 md:grid-cols-2 items-center gap-20">
                <div class="order-2 md:order-1">
                    <span class="font-label-caps text-label-caps text-secondary mb-6 block uppercase tracking-[0.2em]">Savoir-Faire</span>
                    <h2 class="font-display-lg text-headline-lg md:text-display-lg text-primary uppercase mb-8 leading-tight">L'Atelier de Cotonou</h2>
                    <p class="font-body-lg text-on-surface-variant mb-10 leading-relaxed">
                        Chaque pièce de notre collection est le fruit d'une collaboration intime entre le designer et l'artisan. Dans notre atelier au cœur de Cotonou, nous utilisons exclusivement des cuirs sélectionnés pour leur durabilité et leur grain exceptionnel, travaillés selon des techniques de couture sellier qui garantissent une longévité inégalée.
                    </p>
                    <div class="flex items-center gap-10">
                        <div class="flex flex-col">
                            <span class="font-display-lg text-headline-lg text-primary">48h</span>
                            <span class="font-label-caps text-[10px] uppercase">Main-d'œuvre moyenne</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-display-lg text-headline-lg text-primary">100%</span>
                            <span class="font-label-caps text-[10px] uppercase">Fait Main au Bénin</span>
                        </div>
                    </div>
                    <button class="mt-12 border border-primary text-primary px-10 py-4 font-label-caps text-label-caps hover:bg-primary hover:text-on-primary transition-all duration-300">Discover the Heritage</button>
                </div>
                <div class="order-1 md:order-2 relative">
                    <img class="w-full aspect-[4/5] object-cover hairline-border" data-alt="A moody, high-contrast photograph of an artisan's hands working on a piece of thick, dark leather. The workshop is lit by a single warm overhead light, creating dramatic shadows and highlighting the metallic glint of the sewing tools. The scene is professional and focused, emphasizing the tactile, human element of luxury maroquinerie production in a high-end Beninese context." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA6L_dy8iWPj0dfw_FQUFsd8tm_g35wAPdnN6Nvu-DL4MDfavJhZF19HU_si0O3L3ZhsoLTO-761FEqUa3V_Nc2zHHf2m3wPpoTIntLDBwIEPnkm9cq1R8_Ze9Xy2G5dkJ_VNFqlfe0e2_K881bJiAW2okMB2IMhBAxjk6pTKAPwZuTnLe6O6fFk6ZLoNKfvHv-ZSMkLQnnGn6wekTPhdykfmLmsWMmfjs0qunOuVNIVHBRwIrjl9q116ppySNVzgyWzXz-EHYqUw" />
                </div>
            </div>
        </section>
        <!-- Newsletter / Contact -->
        <section class="py-section-gap text-center px-margin-mobile max-w-2xl mx-auto">
            <h3 class="font-display-lg text-headline-lg uppercase mb-4">Rejoignez l'Excellence</h3>
            <p class="font-body-md text-on-surface-variant mb-10 italic">Inscrivez-vous pour recevoir nos invitations aux ventes privées et découvrir nos nouvelles créations en avant-première.</p>
            <form class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-grow w-full">
                    <label class="block text-left font-label-caps text-[10px] uppercase mb-2">Votre Email</label>
                    <input class="w-full bg-transparent border-0 border-b border-outline py-2 focus:ring-0 focus:border-secondary transition-colors font-body-md" placeholder="email@votre-maison.com" type="email" />
                </div>
                <button class="bg-primary text-on-primary px-10 py-3 font-label-caps text-label-caps whitespace-nowrap" type="submit">S'abonner</button>
            </form>
        </section>
    </main>
    <!-- Footer -->
    <footer class="bg-primary text-on-primary py-section-gap border-t border-outline-variant/10">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row justify-between items-start gap-12 md:gap-0">
            <div class="max-w-xs">
                <h2 class="font-display-lg text-headline-md text-on-primary mb-6">L'ÉCLAT DU BÉNIN</h2>
                <p class="font-body-md text-on-primary/70">La destination ultime pour le luxe artisanal béninois. Une curation rigoureuse du savoir-faire traditionnel au service de l'élégance moderne.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-x-12 gap-y-8">
                <div class="flex flex-col gap-3">
                    <span class="font-label-caps text-[11px] text-on-primary/50 uppercase tracking-widest mb-2">Collections</span>
                    <a class="font-body-md text-on-primary/70 hover:text-secondary-fixed transition-colors" href="#">Jewelry</a>
                    <a class="font-body-md text-on-primary/70 hover:text-secondary-fixed transition-colors" href="#">Maroquinerie</a>
                    <a class="font-body-md text-on-primary/70 hover:text-secondary-fixed transition-colors" href="#">Fine Arts</a>
                </div>
                <div class="flex flex-col gap-3">
                    <span class="font-label-caps text-[11px] text-on-primary/50 uppercase tracking-widest mb-2">La Maison</span>
                    <a class="font-body-md text-on-primary/70 hover:text-secondary-fixed transition-colors" href="#">Artisans</a>
                    <a class="font-body-md text-on-primary/70 hover:text-secondary-fixed transition-colors" href="#">Our Heritage</a>
                    <a class="font-body-md text-on-primary/70 hover:text-secondary-fixed transition-colors" href="#">Contact</a>
                </div>
                <div class="flex flex-col gap-3 col-span-2 md:col-span-1">
                    <span class="font-label-caps text-[11px] text-on-primary/50 uppercase tracking-widest mb-2">Follow Us</span>
                    <div class="flex gap-4">
                        <span class="material-symbols-outlined cursor-pointer hover:text-secondary-fixed transition-colors" data-icon="share">share</span>
                        <span class="material-symbols-outlined cursor-pointer hover:text-secondary-fixed transition-colors" data-icon="camera">camera</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop mt-20 pt-8 border-t border-on-primary/10 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="font-body-md text-on-primary/50 text-[12px]">© 2024 L'Éclat du Bénin. Artisanal Excellence from Cotonou.</p>
            <div class="flex gap-8">
                <a class="font-body-md text-on-primary/50 text-[12px] hover:text-on-primary transition-colors" href="#">Shipping</a>
                <a class="font-body-md text-on-primary/50 text-[12px] hover:text-on-primary transition-colors" href="#">Terms</a>
            </div>
        </div>
    </footer>
    <script>
        // Micro-interaction for the TopAppBar blur on scroll
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 20) {
                header.classList.add('shadow-sm');
                header.style.backgroundColor = 'rgba(250, 249, 246, 0.9)';
            } else {
                header.classList.remove('shadow-sm');
                header.style.backgroundColor = 'rgba(250, 249, 246, 0.7)';
            }
        });

        // Simple smooth scroll reveal effect
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                }
            });
        }, observerOptions);

        document.querySelectorAll('section').forEach(section => {
            section.classList.add('transition-all', 'duration-1000', 'opacity-0', 'translate-y-10');
            observer.observe(section);
        });
    </script>
</body>

</html>
