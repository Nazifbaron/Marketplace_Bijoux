<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Luxe Maquette | L'Art de Vivre &amp; Luxury Assets</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&amp;family=Montserrat:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
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
                        "section-gap": "140px",
                        "gutter": "32px",
                        "margin-desktop": "80px",
                        "container-max": "1440px"
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
                        "display-lg": ["72px", {
                            "lineHeight": "1",
                            "letterSpacing": "-0.03em",
                            "fontWeight": "900"
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
                        "headline-lg": ["40px", {
                            "lineHeight": "48px",
                            "fontWeight": "700"
                        }],
                        "label-caps": ["11px", {
                            "lineHeight": "16px",
                            "letterSpacing": "0.15em",
                            "fontWeight": "700"
                        }],
                        "headline-md": ["28px", {
                            "lineHeight": "36px",
                            "fontWeight": "600"
                        }],
                        "display-lg-mobile": ["48px", {
                            "lineHeight": "56px",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "800"
                        }]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 200, 'GRAD' 0, 'opsz' 24;
        }

        .hero-overlay {
            background: linear-gradient(to right, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0) 60%);
        }

        .line-hover::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: -4px;
            left: 0;
            background-color: #735c00;
            transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .line-hover:hover::after {
            width: 100%;
        }

        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        .editorial-spacing {
            letter-spacing: 0.2em;
        }

        .img-zoom-container:hover img {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-background text-on-background selection:bg-secondary-fixed selection:text-on-secondary-fixed antialiased">
    <!-- TopAppBar -->
    <x-header></x-header>
    <main>
        <!-- Immersive Hero Section -->
        {{ $slot }}
    </main>
    <!-- Footer -->
    <x-footer></x-footer>
    <script>
        // Scroll Reveal Animation
        const observerOptions = {
            threshold: 0.1,
            rootMargin: "0px 0px -50px 0px"
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        
    </script>
<x-cart-drawer />
</body>

</html>
