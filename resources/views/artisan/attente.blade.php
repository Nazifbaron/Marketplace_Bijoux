<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>L'Éclat du Bénin — Candidature en Cours</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-container-low": "#f4f3f1",
                        "surface-container": "#efeeeb",
                        "primary": "#000000",
                        "surface-container-highest": "#e3e2e0",
                        "on-surface-variant": "#444748",
                        "secondary-fixed-dim": "#e9c349",
                        "outline": "#747878",
                        "surface-container-lowest": "#ffffff",
                        "background": "#faf9f6",
                        "on-surface": "#1a1c1a",
                        "secondary-fixed": "#ffe088",
                        "secondary-container": "#fed65b",
                        "outline-variant": "#c4c7c7",
                        "surface": "#faf9f6",
                        "secondary": "#735c00",
                        "error": "#ba1a1a",
                        "on-primary": "#ffffff",
                        "on-error": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-tertiary-container": "#5e8e77",
                    },
                    spacing: {
                        "margin-desktop": "80px",
                        "container-max": "1280px",
                        "gutter": "24px",
                        "margin-mobile": "20px",
                        "section-gap": "120px"
                    },
                    fontFamily: {
                        "label-caps": ["Montserrat"],
                        "display-lg": ["Playfair Display"],
                        "body-md": ["Montserrat"],
                        "body-lg": ["Montserrat"],
                        "headline-md": ["Playfair Display"],
                        "headline-lg": ["Playfair Display"],
                        "display-lg-mobile": ["Playfair Display"]
                    },
                    fontSize: {
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
                        }],
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }

        /* Animation du sceau */
        .seal-shimmer {
            background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.4) 50%, transparent 100%);
            background-size: 200% 200%;
            animation: shimmer 4s infinite linear;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% -200%
            }

            100% {
                background-position: 200% 200%
            }
        }

        /* Animation de pulsation pour le statut "pending" */
        @keyframes pulse-ring {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.05);
                opacity: 0.7;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .pulse-anim {
            animation: pulse-ring 2s ease-in-out infinite;
        }

        /* Animation d'entrée */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .animate-fade-up {
            animation: fadeUp 0.6s ease forwards;
        }

        .delay-1 {
            animation-delay: 0.1s;
            opacity: 0;
        }

        .delay-2 {
            animation-delay: 0.3s;
            opacity: 0;
        }

        .delay-3 {
            animation-delay: 0.5s;
            opacity: 0;
        }

        /* Timeline de progression du dossier */
        .timeline-step {
            position: relative;
            padding-left: 2.5rem;
        }

        .timeline-step::before {
            content: '';
            position: absolute;
            left: 0.75rem;
            top: 1.5rem;
            bottom: -0.5rem;
            width: 1px;
            background: #c4c7c7;
        }

        .timeline-step:last-child::before {
            display: none;
        }
    </style>
</head>

<body class="bg-background text-on-surface" style="min-height: max(884px, 100dvh)">

    {{-- HEADER --}}
    <header class="fixed top-0 w-full z-50 bg-surface/70 backdrop-blur-xl border-b border-outline-variant/30 flex justify-between items-center px-gutter py-4">
        <div class="flex items-center gap-4">
            <span class="material-symbols-outlined text-primary cursor-pointer">menu</span>
            <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase tracking-widest">L'ÉCLAT DU BÉNIN</h1>
        </div>
        <div>
            <span class="material-symbols-outlined text-primary cursor-pointer">account_circle</span>
        </div>
    </header>

    <main class="min-h-screen flex flex-col items-center justify-center pt-24 px-margin-mobile md:px-margin-desktop">

        {{-- BARRE DE PROGRESSION --}}
        <div class="w-full max-w-md mb-12 animate-fade-up delay-1">
            <div class="flex justify-between items-end mb-4">
                <span class="font-label-caps text-label-caps uppercase text-primary">Candidature</span>
                <span class="font-label-caps text-label-caps uppercase text-secondary">Étape 3 sur 3</span>
            </div>
            <div class="h-[2px] w-full bg-surface-container-highest overflow-hidden">
                <div class="h-full bg-secondary-fixed transition-all duration-1000 ease-out" id="progress-bar" style="width: 0%"></div>
            </div>
            <p class="mt-4 font-label-caps text-label-caps text-on-surface-variant/70 text-center tracking-widest">
                EXAMEN FINAL D'AUTHENTICITÉ
            </p>
        </div>

        {{-- CONTENU PRINCIPAL --}}
        <section class="max-w-container-max mx-auto grid grid-cols-1 lg:grid-cols-12 gap-16 items-start w-full">

            {{-- ===== VISUEL GAUCHE ===== --}}
            <div class="lg:col-span-7 relative group animate-fade-up delay-2">
                <div class="aspect-[4/5] md:aspect-[16/10] overflow-hidden bg-surface-container relative">
                    <img
                        alt="Heritage Craftsmanship"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCGPjUQ67I54mSX7b9geQK_HwBssfT44I-eNRMvdPF6G9FJxVfR0lu_2_vMpDqtts5LBTJSiSczqhQGkE4gfPMeOOmJ_cP50mjUS5rxfJ7X5Wkhfkj_0aHv6gR5qaXUZRdAVB4LCxS0cWbtdH7TKKOXvEVHtoXTHmMf2HNah9R6cTK0G0jdTAwqeJOLks4CEQGmnkVPYL2hUqGK6V1ESLzWjUc13Ph49XwAK3YtT1GteoZ4G1mApN01hzLGVT8Eyj1lFUwzEXqQYQ" />
                    {{-- Overlay du sceau --}}
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div class="{{ $application->status === 'pending_review' ? 'pulse-anim' : '' }} w-48 h-48 rounded-full border border-secondary-fixed/40 backdrop-blur-sm flex items-center justify-center relative overflow-hidden bg-white/5">
                            <div class="seal-shimmer absolute inset-0"></div>
                            <div class="text-center p-6 border border-secondary-fixed/20 rounded-full w-40 h-40 flex flex-col items-center justify-center">
                                {{-- Icône selon le statut --}}
                                @if($application->status === 'approved')
                                <span class="material-symbols-outlined text-on-tertiary-container text-4xl mb-2" style="font-variation-settings:'FILL' 1;">check_circle</span>
                                <span class="font-label-caps text-label-caps text-on-tertiary-container leading-none text-center">APPROUVÉ</span>
                                @elseif($application->status === 'rejected')
                                <span class="material-symbols-outlined text-error text-4xl mb-2" style="font-variation-settings:'FILL' 1;">cancel</span>
                                <span class="font-label-caps text-label-caps text-error leading-none text-center">REFUSÉ</span>
                                @else
                                <span class="material-symbols-outlined text-secondary text-4xl mb-2" style="font-variation-settings:'FILL' 1;">verified</span>
                                <span class="font-label-caps text-label-caps text-secondary leading-none">COMMITTEE<br />SEAL</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="absolute -bottom-4 -right-4 w-full h-full border border-secondary-fixed/20 -z-10"></div>
            </div>

            {{-- ===== CONTENU DROITE ===== --}}
            <div class="lg:col-span-5 flex flex-col space-y-8 animate-fade-up delay-3">

                {{-- ── CONTENU SELON LE STATUT ── --}}
                @if($application->status === 'approved')
                {{-- ✅ APPROUVÉ --}}
                <div>
                    <span class="font-label-caps text-label-caps text-on-tertiary-container mb-4 block">FÉLICITATIONS</span>
                    <h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary mb-6">
                        Bienvenue dans l'excellence
                    </h2>
                    <div class="w-16 h-1 bg-on-tertiary-container mb-8"></div>
                </div>
                <p class="font-body-lg text-body-lg text-on-surface leading-relaxed">
                    Votre candidature a été acceptée par le Comité du Patrimoine.
                    Votre boutique <strong class="text-primary">{{ $application->shop_name }}</strong> est maintenant active sur L'Éclat du Bénin.
                </p>
                @if($application->admin_notes)
                <div class="p-6 bg-surface-container-low border-l-2 border-on-tertiary-container">
                    <p class="font-label-caps text-[10px] text-on-surface-variant mb-2 uppercase">Message du Comité</p>
                    <p class="font-body-md text-body-md italic text-on-surface-variant">{{ $application->admin_notes }}</p>
                </div>
                @endif
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ route('dashboard') }}"
                        class="bg-primary text-on-primary px-8 py-4 font-label-caps text-label-caps uppercase tracking-widest transition-all hover:bg-on-surface-variant active:scale-95 shadow-sm text-center">
                        Accéder à ma Boutique
                    </a>
                </div>

                @elseif($application->status === 'rejected')
                {{-- ❌ REJETÉ --}}
                <div>
                    <span class="font-label-caps text-label-caps text-error mb-4 block">CANDIDATURE NON RETENUE</span>
                    <h2 class="font-display-lg-mobile text-display-lg-mobile text-primary mb-6">Dossier non accepté</h2>
                    <div class="w-16 h-1 bg-error mb-8"></div>
                </div>
                <p class="font-body-lg text-body-lg text-on-surface leading-relaxed">
                    Après examen, votre dossier n'a pas pu être accepté en l'état.
                </p>
                @if($application->admin_notes)
                <div class="p-6 bg-error-container/40 border-l-2 border-error">
                    <p class="font-label-caps text-[10px] text-error mb-2 uppercase">Motif du refus</p>
                    <p class="font-body-md text-body-md text-on-surface">{{ $application->admin_notes }}</p>
                </div>
                @endif
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Vous pouvez corriger votre dossier et soumettre une nouvelle candidature, ou contacter notre équipe pour plus d'informations.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ route('artisan.onboarding.step1') }}"
                        class="bg-primary text-on-primary px-8 py-4 font-label-caps text-label-caps uppercase tracking-widest transition-all hover:bg-on-surface-variant active:scale-95 shadow-sm text-center">
                        Nouvelle Candidature
                    </a>
                    <button class="border border-secondary text-secondary px-8 py-4 font-label-caps text-label-caps uppercase tracking-widest transition-all hover:bg-secondary/5 active:scale-95 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">support_agent</span>
                        Support Concierge
                    </button>
                </div>

                @else
                {{-- ⏳ EN ATTENTE (statut par défaut) --}}
                <div>
                    <span class="font-label-caps text-label-caps text-secondary mb-4 block">CONFIRMATION DE DÉPÔT</span>
                    <h2 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg text-primary mb-6">
                        Candidature en cours de revue
                    </h2>
                    <div class="w-16 h-1 bg-secondary mb-8"></div>
                </div>

                {{-- Résumé du dossier soumis --}}
                <div class="p-6 bg-surface-container-low border border-outline-variant/30 space-y-3">
                    <p class="font-label-caps text-[10px] text-on-surface-variant uppercase mb-3">Récapitulatif de votre dossier</p>
                    <div class="flex justify-between">
                        <span class="font-label-caps text-label-caps text-on-surface-variant/70">Artisan</span>
                        <span class="font-body-md text-body-md font-semibold text-primary">{{ $application->full_name }}</span>
                    </div>
                    @if($application->shop_name)
                    <div class="flex justify-between">
                        <span class="font-label-caps text-label-caps text-on-surface-variant/70">Boutique</span>
                        <span class="font-body-md text-body-md font-semibold text-primary">{{ $application->shop_name }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="font-label-caps text-label-caps text-on-surface-variant/70">Type</span>
                        <span class="font-body-md text-body-md text-primary">{{ $application->profile_type_label }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-label-caps text-label-caps text-on-surface-variant/70">Soumis le</span>
                        <span class="font-body-md text-body-md text-primary">{{ $application->updated_at->format('d/m/Y à H:i') }}</span>
                    </div>
                </div>

                <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                    Le <span class="font-semibold text-primary">Comité du Patrimoine de L'Éclat du Bénin</span> examine actuellement votre dossier.
                    Ce processus rigoureux garantit l'authenticité et la qualité de chaque artisan sur notre plateforme.
                </p>

                <div class="p-6 bg-surface-container-low border-l-2 border-secondary">
                    <p class="font-body-md text-body-md italic text-on-surface-variant">
                        "L'excellence n'est pas un acte, c'est une habitude qui demande du temps et de la dévotion."
                    </p>
                </div>

                {{-- Timeline --}}
                <div class="space-y-4">
                    <p class="font-label-caps text-[10px] text-on-surface-variant uppercase">Étapes du processus</p>
                    <div class="timeline-step pb-4">
                        <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-white text-[14px]" style="font-variation-settings:'FILL' 1;">check</span>
                        </div>
                        <p class="font-body-md text-body-md font-semibold text-primary">Dossier soumis</p>
                        <p class="text-[12px] text-on-surface-variant">Reçu le {{ $application->updated_at->format('d/m/Y') }}</p>
                    </div>
                    <div class="timeline-step pb-4">
                        <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-secondary flex items-center justify-center pulse-anim">
                            <span class="material-symbols-outlined text-white text-[14px]">schedule</span>
                        </div>
                        <p class="font-body-md text-body-md font-semibold text-secondary">Examen en cours</p>
                        <p class="text-[12px] text-on-surface-variant">Délai estimé : 48 à 72h ouvrées</p>
                    </div>
                    <div class="timeline-step">
                        <div class="absolute left-0 top-1 w-6 h-6 rounded-full bg-outline-variant flex items-center justify-center">
                            <span class="material-symbols-outlined text-white text-[14px]">stars</span>
                        </div>
                        <p class="font-body-md text-body-md text-on-surface-variant/60">Décision du Comité</p>
                        <p class="text-[12px] text-on-surface-variant/40">Notification par email</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ url('/') }}"
                        class="bg-primary text-on-primary px-8 py-4 font-label-caps text-label-caps uppercase tracking-widest transition-all hover:bg-on-surface-variant active:scale-95 shadow-sm text-center">
                        Retour à l'Accueil
                    </a>
                    <button class="border border-secondary text-secondary px-8 py-4 font-label-caps text-label-caps uppercase tracking-widest transition-all hover:bg-secondary/5 active:scale-95 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">support_agent</span>
                        Support Concierge
                    </button>
                </div>

                <p class="font-label-caps text-[10px] text-on-surface-variant/60 tracking-tighter">
                    Délai d'examen estimé : 48 à 72 heures ouvrées. Vous recevrez une notification par e-mail à
                    <strong>{{ auth()->user()->email ?? '' }}</strong>
                </p>
                @endif

            </div>
        </section>
    </main>

    {{-- FOOTER --}}
    <footer class="w-full mt-section-gap border-t border-outline-variant/50 bg-surface-container-lowest py-12">
        <div class="max-w-container-max mx-auto px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-8">
            <h2 class="font-headline-md text-headline-md text-primary font-bold">L'ÉCLAT DU BÉNIN</h2>
            <nav class="flex flex-wrap gap-8 items-center justify-center">
                <a class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant/80 hover:text-primary transition-colors" href="#">The Artisans</a>
                <a class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant/80 hover:text-primary transition-colors" href="#">Our Story</a>
                <a class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant/80 hover:text-primary transition-colors" href="#">Seller Terms</a>
                <a class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant/80 hover:text-primary transition-colors" href="#">Privacy</a>
            </nav>
            <p class="font-label-caps text-label-caps text-on-surface-variant/60">© 2024 L'ÉCLAT DU BÉNIN.</p>
        </div>
    </footer>

    <script>
        // Animation de la barre de progression au chargement
        document.addEventListener('DOMContentLoaded', () => {
            const bar = document.getElementById('progress-bar');
            setTimeout(() => {
                bar.style.width = '100%';
            }, 500);
        });
    </script>

</body>

</html>
