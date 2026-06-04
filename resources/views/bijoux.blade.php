<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Haute Joaillerie | L'Éclat du Bénin</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&amp;family=Montserrat:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet" />
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
        .backdrop-blur-xl {
            backdrop-filter: blur(24px);
        }

        .transition-all {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-gold-glow:hover {
            box-shadow: 0 0 20px rgba(115, 92, 0, 0.1);
        }

        body {
            background-color: #faf9f6;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body class="font-body-md text-on-surface">
    <!-- TopAppBar -->
    <header class="fixed top-0 w-full z-50 border-b border-outline-variant/30 bg-surface/70 backdrop-blur-xl">
        <div class="flex justify-between items-center px-margin-mobile md:px-margin-desktop h-20 w-full">
            <button class="cursor-pointer transition-transform duration-200 active:scale-95 text-primary">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <h1 class="font-display-lg text-headline-md tracking-widest text-primary">L'ÉCLAT DU BÉNIN</h1>
            <div class="flex items-center gap-6">
                <button class="hidden md:flex font-label-caps text-label-caps tracking-widest text-primary hover:text-secondary transition-colors">ACCOUNT</button>
                <button class="cursor-pointer transition-transform duration-200 active:scale-95 text-primary">
                    <span class="material-symbols-outlined">shopping_bag</span>
                </button>
            </div>
        </div>
    </header>
    <main class="pt-32 pb-section-gap">
        <!-- Hero Section -->
        <section class="px-margin-mobile md:px-margin-desktop mb-24 max-w-container-max mx-auto">
            <div class="flex flex-col md:flex-row gap-12 items-end">
                <div class="w-full md:w-1/2">
                    <span class="font-label-caps text-label-caps text-secondary mb-4 block">LES TRÉSORS DE COTONOU</span>
                    <h2 class="font-display-lg text-display-lg-mobile md:text-display-lg text-primary leading-none mb-8">Haute Joaillerie</h2>
                    <p class="font-body-lg text-body-lg text-on-surface-variant max-w-lg mb-8">
                        Experience the zenith of Beninese craftsmanship. Each piece is a unique dialogue between ancestral techniques and contemporary luxury, forged in the heart of our coastal workshops.
                    </p>
                </div>
                <div class="w-full md:w-1/2 flex justify-end">
                    <div class="relative w-full aspect-[4/5] bg-surface-container-low overflow-hidden">
                        <img class="w-full h-full object-cover" data-alt="A macro photograph of an intricate 24k gold necklace with traditional Beninese motifs, resting on an ivory silk background. The lighting is soft and golden, highlighting the handcrafted texture of the filigree. The aesthetic is high-end editorial, evoking a sense of heritage and extreme luxury through minimalist composition and rich contrast." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAwZ9HC6EnU9ikFTcbEG1uJ92M01KeIyyp1IkR8YsORXwKJRvM1KgbOLdd80g1P4wThVW4-AnC7L1UvcnJVgP8wSLasNIUrNRoCjaVVvWVaXy5cY3vvrQKxC80vNMpXVwxOgNS-H654HTxVCp7d-jy9vxb0ZAxe6ih2EYFyeg6If3sQrTbRdeuE2GKfGO2HFvpWvoKiYiZf3he0B0x7HtZqFhsoO9IPJWl8fMAD7PfHOoYn5GO8CaZrLuoXaoNrIAkUZAJD3YF2ow" />
                    </div>
                </div>
            </div>
        </section>
        <!-- Category Filters -->
        <nav class="sticky top-20 z-40 bg-surface/90 backdrop-blur-md border-y border-outline-variant/10 py-6 mb-16">
            <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto flex flex-wrap justify-between items-center gap-4">
                <div class="flex gap-8">
                    <button class="font-label-caps text-label-caps text-primary border-b-2 border-primary pb-1">ALL COLLECTIONS</button>
                    <button class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors pb-1">NECKLACES</button>
                    <button class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors pb-1">RINGS</button>
                    <button class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors pb-1">EARRINGS</button>
                </div>
                <div class="flex items-center gap-2">
                    <span class="font-label-caps text-label-caps text-on-surface-variant">SORT BY:</span>
                    <button class="font-label-caps text-label-caps text-primary flex items-center gap-1">
                        FEATURED <span class="material-symbols-outlined text-sm">expand_more</span>
                    </button>
                </div>
            </div>
        </nav>
        <!-- Product Grid -->
        <section class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-20 gap-x-gutter">
            <!-- Product Item 1 -->
            <article class="group">
                <div class="aspect-[3/4] bg-surface-container-low mb-6 overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Close-up of a royal gold torque necklace featuring embossed traditional iconography of the Fon people. The piece is displayed in a bright museum-like setting with soft directional light hitting the gold surfaces. The background is a clean, ivory-toned plaster wall that adds a tactile yet minimalist feel to the luxury jewelry presentation." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD5ZWigUu6KWezYDfgF5luw9bhFlID9TPPpBw6NcuTa_mutZcSdK03hZs2Pfbu6umch375oMCxnVRxu2rYqVkAY0HBnCoucS-rkqug7PzOJF5iMcmNlQtyUnWG0N5bZzEv9a1M1FaWUEG6uBoqBTWiBKUCk-UzmB8qNYDpLNYIXFnBz0g9XXlPQafZ7DTc-LGF-RQnS5jRs2h06mWzr1uwqGHp_P2FSQn4Cky_YqJNbgyPvt6XiM6npAhViduRCuKWWCm6w5LtQQw" />
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <button class="bg-primary text-on-primary px-8 py-3 font-label-caps text-label-caps tracking-widest active:scale-95 transition-transform">VIEW PIECE</button>
                    </div>
                </div>
                <div class="text-center px-4">
                    <span class="font-label-caps text-[10px] text-secondary tracking-[0.2em] mb-2 block uppercase">Master Artisan: Koffi Adande</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">The Royal Ouidah Torque</h3>
                    <p class="font-price-display text-price-display text-on-surface-variant">1.450.000 FCFA</p>
                </div>
            </article>
            <!-- Product Item 2 -->
            <article class="group">
                <div class="aspect-[3/4] bg-surface-container-low mb-6 overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="A handcrafted gold cuff bracelet with a complex geometric texture inspired by Beninese tapestry. It rests on a textured stone surface under bright, clear daylight, creating sharp elegant shadows. The color palette is dominated by warm golds and cool off-white tones, adhering to the high-contrast editorial luxury style." src="https://lh3.googleusercontent.com/aida-public/AB6AXuB_VIJkSrFGpMfm3lehlhVgvIcPpnmwrcdBIk8yykLqmvw5KcECU6TCFpq4jjYBZZEysWHy9nZ_nUhZmIgvMAnYdYZul6AiSJdx2N7VSqD0s-Zq-h1RcL4o1m6aTzGcWzoMqX8tIXhd40kuU92w9ppgmY-D1BMEF6z9j7BS48P60qH5coEh0uBJpCwWMX7dsdf8M5eM9G0pERhn1E9xJUNFJHx3vZ3ut6AcRFxjXnFvw5h3YcqLmUBNZmyAhUkDxKc35FcIO8P45Q" />
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <button class="bg-primary text-on-primary px-8 py-3 font-label-caps text-label-caps tracking-widest active:scale-95 transition-transform">VIEW PIECE</button>
                    </div>
                </div>
                <div class="text-center px-4">
                    <span class="font-label-caps text-[10px] text-secondary tracking-[0.2em] mb-2 block uppercase">Master Artisan: Sika Lawson</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">Geometric Heritage Cuff</h3>
                    <p class="font-price-display text-price-display text-on-surface-variant">890.000 FCFA</p>
                </div>
            </article>
            <!-- Product Item 3 -->
            <article class="group">
                <div class="aspect-[3/4] bg-surface-container-low mb-6 overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Dangling statement earrings featuring polished black onyx and fine gold filigree. The earrings are captured in mid-air against a soft ivory gradient background. The lighting is dramatic, high-contrast, creating a shimmering effect on the gold details. The image feels like a page from a premium fashion magazine, emphasizing elegance and cultural depth." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAs9qg7tgwGT3yRvLhgviJp0WCfEZ4IeY1jCYwceNqjYmdGolEMKESKQvFY6Igqq-KU3Eg8Pe45my52S3w0hT-JDFuL-psKYpWQyUl5IRsooeDLIJZoPsQIZONoYRmoVWaESqv_2J96wzoQH6j52j58VHuMEYuSUaDVnM-ttaRL5YHoqAlv5cfEt-f5i5JapHaufiuOVzW-F0_a7_wO-Xh3Iln7zu4lStzLN3UJ83VtriVbggDe7bc2bDo8oP7QOahvxA7U0uypIA" />
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <button class="bg-primary text-on-primary px-8 py-3 font-label-caps text-label-caps tracking-widest active:scale-95 transition-transform">VIEW PIECE</button>
                    </div>
                </div>
                <div class="text-center px-4">
                    <span class="font-label-caps text-[10px] text-secondary tracking-[0.2em] mb-2 block uppercase">Master Artisan: Bakare Ibrahim</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">Onyx Night Drop Earrings</h3>
                    <p class="font-price-display text-price-display text-on-surface-variant">520.000 FCFA</p>
                </div>
            </article>
            <!-- Product Item 4 -->
            <article class="group">
                <div class="aspect-[3/4] bg-surface-container-low mb-6 overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="A statement cocktail ring with a large emerald cut gemstone set in a heavy gold band with hand-carved relief work. The ring is worn by a model with a dark skin tone, emphasizing the contrast between the rich gold and the skin. The setting is minimal, with soft light creating a luxury boutique atmosphere. Warm ivory and deep gold tones dominate." src="https://lh3.googleusercontent.com/aida-public/AB6AXuA4QjWyKv2I6gCTM8mSrTAjNhhUh9z_IGUEgEm9l19WJvBXKZmmy4Zje-EHqYVVCehwaFjE8D9DDXJWdGhJ9H_qyWf9MJMkWOyfk_8Yw511iGrQ6KQgyhw2Yyz_tXYHPz179czTVrf80vRJWJpXSoMNQD_ov_s4YzJfTIusczWiNBLVYWoIYC6i9ooRiUdZy8dRTJ_qLUCXM9IyT9o_Owv4MzBmN_tc5GPr2v4cQwTq6pgPHJIQy33WVEuKLP4LRe-6XeaP7XnI7Q" />
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <button class="bg-primary text-on-primary px-8 py-3 font-label-caps text-label-caps tracking-widest active:scale-95 transition-transform">VIEW PIECE</button>
                    </div>
                </div>
                <div class="text-center px-4">
                    <span class="font-label-caps text-[10px] text-secondary tracking-[0.2em] mb-2 block uppercase">Master Artisan: Koffi Adande</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">Dahomey Emerald Signet</h3>
                    <p class="font-price-display text-price-display text-on-surface-variant">2.100.000 FCFA</p>
                </div>
            </article>
            <!-- Product Item 5 -->
            <article class="group">
                <div class="aspect-[3/4] bg-surface-container-low mb-6 overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="Layered gold necklaces of varying lengths with artisanal pendants representing Beninese cultural symbols. The jewelry is neatly arranged on an off-white linen cloth. The aesthetic is clean, sophisticated, and focused on material quality. Lighting is bright and airy, typical of a luxury lifestyle brand." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkllUgVynw-3ns7vGmPcWHWnmTUk6VqbFmJb-YVxh8A7tDJxstg0YXNOGBO8jrIRHnQmI02h9c2QnTZHNfefx3kzBoc-NXNb8A0fKhZybKH-TKitLsbyBVq8zFH5syZAPE5FySBBuYfZ2dYcxvQX_iqTWlZTl7Iea41K3_L5XKeYLBPPKJ48pQbu2_jvfeQbFwnV6uycSM4k3ZzPTZThyat4O-hUxtZy8KqaTo3dmbkUlBk3ibG_Mxt_BYZ37klQpuEbGSKID88g" />
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <button class="bg-primary text-on-primary px-8 py-3 font-label-caps text-label-caps tracking-widest active:scale-95 transition-transform">VIEW PIECE</button>
                    </div>
                </div>
                <div class="text-center px-4">
                    <span class="font-label-caps text-[10px] text-secondary tracking-[0.2em] mb-2 block uppercase">Master Artisan: Sika Lawson</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">Trinity of the Coast Pendants</h3>
                    <p class="font-price-display text-price-display text-on-surface-variant">680.000 FCFA</p>
                </div>
            </article>
            <!-- Product Item 6 -->
            <article class="group">
                <div class="aspect-[3/4] bg-surface-container-low mb-6 overflow-hidden relative">
                    <img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" data-alt="A collection of delicate gold rings with tiny precious stone accents, arranged artistically inside a minimalist ceramic dish. The color palette features ivory, warm cream, and brilliant gold. The image is captured with a shallow depth of field, highlighting the fine detail of the metalwork. It exudes a feeling of refined luxury and artisanal precision." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAmKQ-c8QuFRlHh7cA1TNvto5Kr9gzP3pNqis3gHe8Sq38sWTmcfh4CQ6CQD0-ASJCWFAa25V4lUv8u0B2HGGhwmS-qx_MCRWDHl8oze0doGQK4V5-lv_ga_j7mhlo-lW-EbRulu0NDCIJhMgr6ZrIICMeqCl1o6BFN9ppyv7FDrNLYXwbPeq2QuJsM2bjCUTWIyJVE-bIDISj9IORtFDJtyB1P2rfOkDxoxnlnXymeprWXWiKJWH4Cp_Ety_e5lDAChBAZqqsyVA" />
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <button class="bg-primary text-on-primary px-8 py-3 font-label-caps text-label-caps tracking-widest active:scale-95 transition-transform">VIEW PIECE</button>
                    </div>
                </div>
                <div class="text-center px-4">
                    <span class="font-label-caps text-[10px] text-secondary tracking-[0.2em] mb-2 block uppercase">Master Artisan: Bakare Ibrahim</span>
                    <h3 class="font-headline-md text-headline-md text-primary mb-1">The Artisanal Stacking Set</h3>
                    <p class="font-price-display text-price-display text-on-surface-variant">450.000 FCFA</p>
                </div>
            </article>
        </section>
        <!-- Newsletter / Heritage Section -->
        <section class="mt-section-gap px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto">
            <div class="bg-primary text-on-primary p-12 md:p-24 flex flex-col items-center text-center">
                <span class="font-label-caps text-label-caps text-secondary-fixed mb-6">THE ARTISAN'S CIRCLE</span>
                <h2 class="font-display-lg text-headline-lg md:text-display-lg-mobile lg:text-headline-lg mb-8 max-w-2xl">Bespoke Creations from the Heart of Benin</h2>
                <p class="font-body-lg text-body-lg text-on-primary/70 max-w-xl mb-12">
                    Connect with our master artisans for a commissioned piece that tells your unique story through the lens of West African excellence.
                </p>
                <div class="w-full max-w-md flex flex-col md:flex-row gap-4">
                    <input class="bg-transparent border-b border-on-primary/30 py-3 px-1 font-body-md text-on-primary focus:border-secondary outline-none transition-colors flex-grow" placeholder="Your Email" type="email" />
                    <button class="bg-on-primary text-primary px-10 py-3 font-label-caps text-label-caps hover:bg-secondary-fixed transition-colors">INQUIRE</button>
                </div>
            </div>
        </section>
    </main>
    <!-- Footer -->
    <footer class="bg-primary w-full py-section-gap border-t border-outline-variant/10">
        <div class="flex flex-col md:flex-row justify-between items-start px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto gap-12">
            <div class="max-w-xs">
                <h2 class="font-display-lg text-headline-md text-on-primary mb-6">L'ÉCLAT DU BÉNIN</h2>
                <p class="text-on-primary/60 font-body-md">Celebrating the legacy of Beninese artisans through a curated platform of luxury craftsmanship and artisanal heritage.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-12 md:gap-24">
                <div class="flex flex-col gap-4">
                    <span class="font-label-caps text-label-caps text-on-primary tracking-widest mb-2">EXPLORE</span>
                    <a class="text-on-primary/70 hover:text-secondary-fixed transition-colors text-body-md" href="#">Jewelry</a>
                    <a class="text-on-primary/70 hover:text-secondary-fixed transition-colors text-body-md" href="#">Leather Goods</a>
                    <a class="text-on-primary/70 hover:text-secondary-fixed transition-colors text-body-md" href="#">Artisans</a>
                </div>
                <div class="flex flex-col gap-4">
                    <span class="font-label-caps text-label-caps text-on-primary tracking-widest mb-2">HERITAGE</span>
                    <a class="text-on-primary/70 hover:text-secondary-fixed transition-colors text-body-md" href="#">Our Story</a>
                    <a class="text-on-primary/70 hover:text-secondary-fixed transition-colors text-body-md" href="#">Craftsmanship</a>
                    <a class="text-on-primary/70 hover:text-secondary-fixed transition-colors text-body-md" href="#">Cotonou Studio</a>
                </div>
                <div class="flex flex-col gap-4">
                    <span class="font-label-caps text-label-caps text-on-primary tracking-widest mb-2">SUPPORT</span>
                    <a class="text-on-primary/70 hover:text-secondary-fixed transition-colors text-body-md" href="#">Shipping</a>
                    <a class="text-on-primary/70 hover:text-secondary-fixed transition-colors text-body-md" href="#">Returns</a>
                    <a class="text-on-primary/70 hover:text-secondary-fixed transition-colors text-body-md" href="#">Contact</a>
                </div>
            </div>
        </div>
        <div class="px-margin-mobile md:px-margin-desktop max-w-container-max mx-auto mt-20 pt-8 border-t border-on-primary/10">
            <p class="text-on-primary/50 text-label-caps font-label-caps">© 2024 L'Éclat du Bénin. Artisanal Excellence from Cotonou.</p>
        </div>
    </footer>
    <script>
        // Simple scroll effect for TopAppBar
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.classList.add('shadow-sm');
                header.classList.replace('bg-surface/70', 'bg-surface/90');
            } else {
                header.classList.remove('shadow-sm');
                header.classList.replace('bg-surface/90', 'bg-surface/70');
            }
        });

        // Hover interactions for product cards
        document.querySelectorAll('article').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.classList.add('hover-gold-glow');
            });
            card.addEventListener('mouseleave', () => {
                card.classList.remove('hover-gold-glow');
            });
        });
    </script>
</body>

</html>
