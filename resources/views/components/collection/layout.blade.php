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
                        "tertiary": "#012F24 ",
                        "surface-bright": "#faf9f6",
                        "on-secondary": "#ffffff",
                        "inverse-on-surface": "#f2f1ee",
                        "surface-container-low": "#f4f3f1",
                        "surface-container-highest": "#e3e2e0",
                        "on-tertiary": "#ffffff",
                        "primary": "#012F24 ",
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
    <x-collection.header></x-collection.header>
    <main class="pt-32 pb-section-gap">
        {{$slot}}
    </main>
    <!-- Footer -->
    <x-footer></x-footer>
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
