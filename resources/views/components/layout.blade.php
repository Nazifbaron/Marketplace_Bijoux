<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>L'ÉCLAT DU BÉNIN | Excellence Artisanale</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=Montserrat:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
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
                        "secondary": "#D9AF4B ",
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
                        "secondary-fixed": "#ffe088",
                        "gold": "#D4AF37"
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

        .hero-gradient {
            background: linear-gradient(to bottom, rgba(250, 249, 246, 0.4), rgb(236, 234, 228));
        }

        .line-hover::after {
            content: '';
            position: absolute;
            width: 0;
            height: 1px;
            bottom: -2px;
            left: 0;
            background-color: #D9AF4B ;
            transition: width 0.3s ease;
        }

        .line-hover:hover::after {
            width: 100%;
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Animations élégantes */
        @keyframes floatIn {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-60px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
            }
        }

        @keyframes pulse-subtle {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        /* Cartes avec effets premium */
        .card-luxury {
            position: relative;
            overflow: hidden;
            border-radius: 2px;
        }

        .card-luxury::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.6s ease;
            pointer-events: none;
        }

        .card-luxury:hover::before {
            opacity: 1;
        }

        /* Boutons améliorés */
        .btn-luxury {
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .btn-luxury::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-luxury:hover::before {
            width: 300px;
            height: 300px;
        }

        /* Lignes décoratives */
        .divider-gold {
            width: 40px;
            height: 2px;
            background: linear-gradient(90deg, transparent, #D9AF4B , transparent);
            margin: 16px 0;
        }

        .divider-gold-center {
            width: 60px;
            height: 1px;
            background: linear-gradient(90deg, transparent, #D9AF4B , transparent);
            margin: 0 auto 24px;
        }

        /* Badges animés */
        .badge-premium {
            display: inline-block;
            padding: 8px 16px;
            background: linear-gradient(135deg, rgba(115, 92, 0, 0.1), rgba(115, 92, 0, 0.05));
            border: 1px solid rgba(115, 92, 0, 0.2);
            border-radius: 24px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.08em;
            animation: pulse-subtle 3s ease-in-out infinite;
        }

        /* Texte avec gradient */
        .text-gradient {
            background: linear-gradient(135deg, #012F24 , #444748);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Inputs stylisés */
        .input-luxury {
            position: relative;
        }

        .input-luxury::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #D9AF4B , #D9AF4B );
            transition: width 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .input-luxury:focus-within::after {
            width: 100%;
        }

        /* Effet de scroll */
        .scroll-fade {
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
    </style>
    <style>
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>

<body class="bg-background text-on-background selection:bg-secondary-fixed selection:text-on-secondary-fixed">

    <!-- TopAppBar -->
    <x-header></x-header>
    <main class="pt-20">
        <!-- Hero Section -->
        {{$slot}}
    </main>
    <!-- Footer -->
    <x-footer></x-footer>
    <script>
        // Scroll Reveal Animation
        const observerOptions = {
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Smooth scroll implementation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>

</html>
