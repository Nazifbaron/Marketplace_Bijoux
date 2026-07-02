<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>LUXE MARQUETTE</title>
    {{-- CSRF Token pour les formulaires Laravel --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-tint": "#5f5e5e",
                        "surface-container-low": "#f4f3f1",
                        "surface-container": "#efeeeb",
                        "primary": "#012F24 ",
                        "surface-container-highest": "#e3e2e0",
                        "on-tertiary": "#ffffff",
                        "surface-container-high": "#e9e8e5",
                        "on-surface-variant": "#444748",
                        "secondary-fixed-dim": "#e9c349",
                        "outline": "#747878",
                        "surface-container-lowest": "#ffffff",
                        "on-background": "#012F24 ",
                        "background": "#faf9f6",
                        "on-surface": "#012F24 ",
                        "secondary-fixed": "#ffe088",
                        "secondary-container": "#fed65b",
                        "outline-variant": "#c4c7c7",
                        "inverse-surface": "#2f312f",
                        "error-container": "#ffdad6",
                        "surface-variant": "#e3e2e0",
                        "surface": "#faf9f6",
                        "primary-container": "#012F24",
                        "on-secondary": "#ffffff",
                        "on-primary-container": "#858383",
                        "secondary": "#735c00",
                        "error": "#ba1a1a",
                        "surface-bright": "#faf9f6",
                        "on-primary": "#ffffff",
                        "on-error": "#ffffff",
                    },
                    borderRadius: {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    spacing: {
                        "margin-desktop": "80px",
                        "container-max": "1280px",
                        "margin-tablet": "40px",
                        "gutter": "24px",
                        "margin-mobile": "20px"
                    },
                    fontFamily: {
                        "label-caps": ["Montserrat"],
                        "display-lg": ["Playfair Display"],
                        "body-md": ["Montserrat"],
                        "body-lg": ["Montserrat"],
                        "headline-md": ["Playfair Display"],
                        "headline-lg": ["Playfair Display"]
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
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }

        /* Floating Label — L'effet où le label monte quand on clique sur le champ */
        .float-label-group {
            position: relative;
        }

        .float-label-group input,
        .float-label-group select {
            width: 100%;
            background: transparent;
            border: none;
            border-bottom: 1px solid #c4c7c7;
            padding: 20px 0 8px 0;
            font-size: 16px;
            outline: none;
            transition: border-color 0.2s;
        }

        .float-label-group input:focus,
        .float-label-group select:focus {
            border-bottom-color: #735c00;
        }

        .float-label-group label {
            position: absolute;
            left: 0;
            top: 20px;
            font-size: 12px;
            letter-spacing: 0.1em;
            font-weight: 600;
            color: #444748;
            text-transform: uppercase;
            pointer-events: none;
            transition: all 0.2s ease;
        }

        /* Quand l'input est rempli OU en focus : label monte en haut */
        .float-label-group input:focus~label,
        .float-label-group input:not(:placeholder-shown)~label,
        .float-label-group select:focus~label,
        .float-label-group select:valid~label {
            top: 4px;
            font-size: 10px;
            color: #735c00;
        }

        /* Indicateur d'erreur sous les champs */
        .field-error {
            display: block;
            margin-top: 4px;
            font-size: 11px;
            color: #ba1a1a;
            font-family: 'Montserrat', sans-serif;
        }

        /* Animation d'entrée de la page */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
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
            animation-delay: 0.2s;
            opacity: 0;
        }

        .delay-3 {
            animation-delay: 0.3s;
            opacity: 0;
        }

        /* Indicateur de force du mot de passe */
        #strength-bar div {
            transition: width 0.4s ease;
        }
    </style>
</head>

<body class="bg-background text-on-surface min-h-screen flex flex-col">

    {{-- ===== HEADER ===== --}}
    <header class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-xl border-b border-outline-variant/30 flex justify-between items-center px-gutter py-4">
       {{-- <div class="flex-1">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2">
                <span class="material-symbols-outlined text-primary cursor-pointer">arrow_back</span>
            </a>
        </div>--}}
        <div class="flex items-center gap-4">
            <a href="/">
                <img src="{{ asset('images/logo.jpeg')}}" alt="Logo" class="w-14 h-14 sm:w-20 sm:h-10 object-contain ">
            </a>
        </div>

        <div class="flex-1 flex justify-end">
            <a href="{{ route('login') }} " class="font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors">
                Se connecter
            </a>
        </div>
    </header>

    {{-- ===== CONTENU PRINCIPAL ===== --}}
    <main class="flex-grow flex items-center justify-center pt-32 pb-20 px-margin-mobile md:px-0">
        <div class="w-full max-w-[1000px] flex flex-col md:flex-row bg-white overflow-hidden shadow-sm">

            {{-- ---- CÔTÉ GAUCHE : Image ---- --}}
            <div class="hidden md:block md:w-5/12 relative">
                <img class="absolute inset-0 w-full h-full object-cover"
                    src="{{ asset('images/artisan-banner.png') }}"
                    alt="Artisanat béninois" />
                <div class="absolute inset-0 bg-black/25"></div>
                <div class="absolute bottom-12 left-8 right-8 text-white">
                    <h2 class="font-headline-lg text-headline-lg leading-tight mb-4">Rejoignez l'excellence.</h2>
                    <p class="font-body-md text-body-md opacity-90">Devenez un ambassadeur du savoir-faire béninois sur la scène mondiale.</p>
                </div>
            </div>

            {{-- ---- CÔTÉ DROIT : Formulaire ---- --}}
            <div class="w-full md:w-7/12 p-8 md:p-16 flex flex-col">

                {{-- Indicateur de progression --}}
                <div class="flex items-center justify-between mb-12 animate-fade-up delay-1">
                    <div class="flex flex-col">
                        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest">Étape 1 sur 3</span>
                        <h1 class="font-headline-md text-headline-md text-primary mt-1">Informations de Profil</h1>
                    </div>
                    {{-- Barres de progression visuelles --}}
                    <div class="flex gap-2">
                        <div class="w-8 h-1 bg-primary"></div> {{-- Étape 1 : active --}}
                        <div class="w-8 h-1 bg-outline-variant/30"></div> {{-- Étape 2 : inactive --}}
                        <div class="w-8 h-1 bg-outline-variant/30"></div> {{-- Étape 3 : inactive --}}
                    </div>
                </div>

                {{-- ── MESSAGE D'ERREUR GLOBAL (si le formulaire a échoué) ── --}}
                @if ($errors->any())
                <div class="mb-6 p-4 border-l-2 border-error bg-error-container/30 animate-fade-up">
                    <p class="font-label-caps text-label-caps text-error uppercase mb-2">Veuillez corriger les erreurs :</p>
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                        <li class="font-body-md text-body-md text-error text-sm">— {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- ── MESSAGE DE SUCCÈS ── --}}
                @if (session('success'))
                <div class="mb-6 p-4 border-l-2 border-secondary bg-secondary-container/30">
                    <p class="font-body-md text-body-md text-secondary">{{ session('success') }}</p>
                </div>
                @endif

                {{--
                FORMULAIRE PRINCIPAL
                action="{{ route('artisan.onboarding.step1.store') }}" → URL de traitement
                method="POST" → Envoi sécurisé
                @csrf → Token anti-falsification (obligatoire Laravel)
                --}}
                <form
                    action="{{ route('artisan.onboarding.step1.store') }}"
                    method="POST"
                    class="flex-grow space-y-10"
                    id="step1-form">
                    @csrf

                    {{-- ── SÉLECTION DU TYPE DE PROFIL ── --}}
                    <div class="space-y-4 animate-fade-up delay-2">
                        <p class="font-label-caps text-label-caps text-on-surface-variant uppercase">Type de Profil</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            {{-- Option 1: Artisan Indépendant --}}
                            <label class="relative group cursor-pointer">
                                <input
                                    type="radio"
                                    name="profile_type"
                                    value="independent"
                                    class="peer sr-only"
                                    {{ old('profile_type', 'independent') === 'independent' ? 'checked' : '' }} />
                                <div class="p-6 border border-outline-variant group-hover:border-primary peer-checked:border-primary peer-checked:bg-surface-container-low transition-all">
                                    <span class="material-symbols-outlined text-primary mb-2">person</span>
                                    <h3 class="font-body-md font-semibold text-primary block">Artisan Indépendant</h3>
                                    <p class="text-[12px] text-on-surface-variant leading-tight mt-1">Artiste individuel ou micro-entreprise.</p>
                                </div>
                            </label>

                            {{-- Option 2: Maison Artisanale --}}
                            <label class="relative group cursor-pointer">
                                <input
                                    type="radio"
                                    name="profile_type"
                                    value="house"
                                    class="peer sr-only"
                                    {{ old('profile_type') === 'house' ? 'checked' : '' }} />
                                <div class="p-6 border border-outline-variant group-hover:border-primary peer-checked:border-primary peer-checked:bg-surface-container-low transition-all">
                                    <span class="material-symbols-outlined text-primary mb-2">domain</span>
                                    <h3 class="font-body-md font-semibold text-primary block">Maison Artisanale</h3>
                                    <p class="text-[12px] text-on-surface-variant leading-tight mt-1">Atelier établi ou coopérative structurée.</p>
                                </div>
                            </label>

                        </div>
                        @error('profile_type')
                        <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- ── CHAMPS DE SAISIE ── --}}
                    <div class="space-y-8 animate-fade-up delay-3">

                        {{-- Nom Complet --}}
                        <div class="float-label-group">
                            <input
                                type="text"
                                id="fullname"
                                name="full_name"
                                placeholder=" "
                                value="{{ old('full_name') }}"
                                autocomplete="name"
                                class="{{ $errors->has('full_name') ? 'border-b-error' : '' }}" />
                            <label for="fullname">Nom Complet</label>
                            @error('full_name')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="float-label-group">
                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder=" "
                                value="{{ old('email') }}"
                                autocomplete="email" />
                            <label for="email">Adresse Email Professionnelle</label>
                            @error('email')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Téléphone --}}
                        <div class="float-label-group">
                            <input
                                type="tel"
                                id="phone"
                                name="phone"
                                placeholder=" "
                                value="{{ old('phone') }}"
                                autocomplete="tel" />
                            <label for="phone">Téléphone</label>
                            @error('phone')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Mot de passe --}}
                        <div class="float-label-group">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder=" "
                                autocomplete="new-password" />
                            <label for="password">Mot de Passe</label>
                            @error('password')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                            {{-- Indicateur de force du mot de passe --}}
                            <div id="strength-bar" class="mt-2 h-1 bg-outline-variant/20 overflow-hidden hidden">
                                <div id="strength-fill" class="h-full bg-error transition-all duration-500" style="width: 0%"></div>
                            </div>
                            <p id="strength-text" class="text-[10px] text-on-surface-variant mt-1 hidden"></p>
                        </div>

                        {{-- Confirmation mot de passe --}}
                        <div class="float-label-group">
                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder=" "
                                autocomplete="new-password" />
                            <label for="password_confirmation">Confirmer le Mot de Passe</label>
                            <span id="pwd-match-error" class="field-error hidden">Les mots de passe ne correspondent pas.</span>
                        </div>

                    </div>

                    {{-- ── ACTIONS ── --}}
                    <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-6">
                        <a href="#  "
                            class="order-2 md:order-1 font-label-caps text-label-caps text-on-surface-variant hover:text-primary transition-colors border-b border-transparent hover:border-primary pb-1">
                            Se Connecter au lieu de s'inscrire
                        </a>
                        <button
                            type="submit"
                            id="submit-btn"
                            class="order-1 md:order-2 w-full md:w-auto bg-primary text-on-primary px-12 py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-on-surface-variant transition-all flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span id="btn-text">Continuer</span>
                            <span id="btn-loader" class="hidden">
                                <span class="material-symbols-outlined text-[18px] animate-spin">progress_activity</span>
                            </span>
                            <span id="btn-arrow" class="material-symbols-outlined text-[18px]">chevron_right</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="w-full bg-primary border-t border-outline-variant/50 py-12 px-margin-desktop">
        <div class="max-w-container-max mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="font-headline-md text-headline-md text-on-tertiary font-bold">Luxe Maquette</div>
            <p class="font-label-caps text-on-tertiary text-on-surface-variant/60 uppercase tracking-widest">
                © 2026 Luxe Maquette. Heritage Excellence.
            </p>
        </div>
    </footer>

    <script>
        /**
         * JAVASCRIPT DE LA PAGE D'INSCRIPTION
         * =====================================
         * 3 fonctionnalités :
         * 1. Indicateur de force du mot de passe (rouge → vert selon la complexité)
         * 2. Vérification en temps réel de la correspondance des mots de passe
         * 3. Loader sur le bouton au moment de la soumission
         */

        // --- 1. FORCE DU MOT DE PASSE ---
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strength-bar');
        const strengthFill = document.getElementById('strength-fill');
        const strengthText = document.getElementById('strength-text');

        passwordInput.addEventListener('input', function() {
            const val = this.value;
            if (!val) {
                strengthBar.classList.add('hidden');
                strengthText.classList.add('hidden');
                return;
            }
            strengthBar.classList.remove('hidden');
            strengthText.classList.remove('hidden');

            // Calcul du score (0 à 4)
            let score = 0;
            if (val.length >= 8) score++; // Longueur suffisante
            if (/[A-Z]/.test(val)) score++; // Majuscule
            if (/[0-9]/.test(val)) score++; // Chiffre
            if (/[^A-Za-z0-9]/.test(val)) score++; // Caractère spécial

            // Mise à jour visuelle
            const levels = [{
                    pct: '25%',
                    color: '#ba1a1a',
                    label: 'Très faible'
                },
                {
                    pct: '50%',
                    color: '#e6a817',
                    label: 'Faible'
                },
                {
                    pct: '75%',
                    color: '#735c00',
                    label: 'Bon'
                },
                {
                    pct: '100%',
                    color: '#1a7a4a',
                    label: 'Excellent'
                },
            ];
            const level = levels[score - 1] || levels[0];
            strengthFill.style.width = level.pct;
            strengthFill.style.background = level.color;
            strengthText.textContent = `Force : ${level.label}`;
            strengthText.style.color = level.color;
        });

        // --- 2. CORRESPONDANCE DES MOTS DE PASSE ---
        const confirmInput = document.getElementById('password_confirmation');
        const matchError = document.getElementById('pwd-match-error');

        confirmInput.addEventListener('input', function() {
            if (this.value && this.value !== passwordInput.value) {
                matchError.classList.remove('hidden');
            } else {
                matchError.classList.add('hidden');
            }
        });

        // --- 3. LOADER AU SUBMIT ---
        const form = document.getElementById('step1-form');
        const submitBtn = document.getElementById('submit-btn');
        const btnText = document.getElementById('btn-text');
        const btnLoader = document.getElementById('btn-loader');
        const btnArrow = document.getElementById('btn-arrow');

        form.addEventListener('submit', function(e) {
            // Vérifier la correspondance avant soumission
            if (confirmInput.value !== passwordInput.value) {
                e.preventDefault();
                matchError.classList.remove('hidden');
                confirmInput.focus();
                return;
            }

            // Afficher le loader
            btnText.textContent = 'Envoi en cours...';
            btnArrow.classList.add('hidden');
            btnLoader.classList.remove('hidden');
            submitBtn.disabled = true;
        });
    </script>

</body>

</html>
