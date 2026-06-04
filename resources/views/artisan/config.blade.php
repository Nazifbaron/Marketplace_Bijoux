<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>L'Éclat du Bénin — Configuration de Boutique</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode:"class",
            theme: { extend: {
                colors: {
                    "surface-container-low":"#f4f3f1","surface-container":"#efeeeb","primary":"#000000",
                    "surface-container-highest":"#e3e2e0","surface-container-high":"#e9e8e5",
                    "on-surface-variant":"#444748","secondary-fixed-dim":"#e9c349","outline":"#747878",
                    "surface-container-lowest":"#ffffff","background":"#faf9f6","on-surface":"#1a1c1a",
                    "secondary-fixed":"#ffe088","secondary-container":"#fed65b","outline-variant":"#c4c7c7",
                    "surface-variant":"#e3e2e0","surface":"#faf9f6","primary-container":"#1c1b1b",
                    "secondary":"#735c00","error":"#ba1a1a","on-primary":"#ffffff","on-error":"#ffffff",
                    "error-container":"#ffdad6","on-tertiary-container":"#5e8e77",
                },
                spacing: { "margin-desktop":"80px","container-max":"1280px","gutter":"24px","margin-mobile":"20px","section-gap":"120px" },
                fontFamily: { "label-caps":["Montserrat"],"display-lg":["Playfair Display"],"body-md":["Montserrat"],"body-lg":["Montserrat"],"headline-md":["Playfair Display"] },
                fontSize: {
                    "label-caps":["12px",{"lineHeight":"16px","letterSpacing":"0.1em","fontWeight":"600"}],
                    "body-md":["16px",{"lineHeight":"24px","fontWeight":"400"}],
                    "body-lg":["18px",{"lineHeight":"28px","fontWeight":"400"}],
                    "headline-md":["24px",{"lineHeight":"32px","fontWeight":"600"}],
                }
            }}
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24; }
        .field-error { display: block; margin-top: 4px; font-size: 11px; color: #ba1a1a; font-family: 'Montserrat', sans-serif; }

        /* Zone de drop pour les fichiers */
        .upload-zone {
            border: 1px dashed #c4c7c7;
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .upload-zone:hover, .upload-zone.drag-over {
            border-color: #735c00;
            background-color: #f4f3f1;
        }
        .upload-zone.uploaded {
            border-color: #5e8e77;
            background-color: #f0fff8;
            border-style: solid;
        }

        /* Compteur de caractères textarea */
        .char-counter { font-size: 11px; color: #747878; text-align: right; margin-top: 4px; }
        .char-counter.limit { color: #ba1a1a; }

        /* Animation d'entrée */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fadeUp 0.5s ease forwards; }

        /* Style du select */
        select {
            -webkit-appearance: none;
            appearance: none;
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body-md antialiased">

{{-- HEADER --}}
<header class="fixed top-0 w-full z-50 bg-surface/70 backdrop-blur-xl border-b border-outline-variant/30 px-gutter py-4 flex justify-between items-center">
    <div class="flex items-center gap-4">
        <span class="material-symbols-outlined text-primary cursor-pointer active:opacity-80">menu</span>
        <h1 class="font-headline-md text-headline-md font-bold text-primary uppercase tracking-widest">L'ÉCLAT DU BÉNIN</h1>
    </div>
    <span class="font-label-caps text-label-caps text-on-surface-variant uppercase tracking-widest hidden md:block">
        Étape 02 — Configuration Boutique
    </span>
</header>

<main class="min-h-screen pt-24 pb-20 px-margin-mobile md:px-margin-desktop">
    <div class="max-w-container-max mx-auto grid grid-cols-1 lg:grid-cols-12 gap-16">

        {{-- ===== COLONNE GAUCHE : Formulaire (7 colonnes) ===== --}}
        <div class="lg:col-span-7 animate-fade-up">

            {{-- Progression --}}
            <div class="mb-12">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <span class="font-label-caps text-label-caps text-secondary uppercase tracking-widest">Étape 2 sur 3</span>
                        <h2 class="font-headline-md text-headline-md text-primary mt-1">Configuration de Votre Boutique</h2>
                    </div>
                    <div class="flex gap-2">
                        <div class="w-8 h-1 bg-secondary"></div>   {{-- Étape 1 : complète --}}
                        <div class="w-8 h-1 bg-primary"></div>     {{-- Étape 2 : active --}}
                        <div class="w-8 h-1 bg-outline-variant/30"></div> {{-- Étape 3 --}}
                    </div>
                </div>
                {{-- Barre de progression --}}
                <div class="h-[2px] bg-surface-container-highest overflow-hidden">
                    <div class="h-full bg-secondary-fixed transition-all duration-1000" style="width: 66%"></div>
                </div>
            </div>

            {{-- Message d'erreur global --}}
            @if ($errors->any())
                <div class="mb-8 p-4 border-l-2 border-error bg-error-container/30">
                    <p class="font-label-caps text-label-caps text-error uppercase mb-2">Veuillez corriger les erreurs :</p>
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm text-error font-body-md">— {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{--
                FORMULAIRE ÉTAPE 2
                enctype="multipart/form-data" → OBLIGATOIRE pour l'upload de fichiers
            --}}
            <form
                action="{{ route('artisan.onboarding.step2.store') }}"
                method="POST"
                enctype="multipart/form-data"
                id="step2-form"
                class="space-y-12"
            >
                @csrf

                {{-- ── SECTION 1 : Identité de la Boutique ── --}}
                <section class="space-y-8">
                    <div class="border-b border-outline-variant/30 pb-4">
                        <h3 class="font-headline-md text-headline-md text-primary">Identité de la Boutique</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-1">Définissez l'identité de votre maison artisanale.</p>
                    </div>

                    {{-- Nom de la Boutique --}}
                    <div class="relative group">
                        <label class="block font-label-caps text-label-caps text-on-surface-variant uppercase mb-2 group-focus-within:text-secondary transition-colors">
                            Nom de la Boutique
                        </label>
                        <input
                            type="text"
                            name="shop_name"
                            value="{{ old('shop_name') }}"
                            placeholder="Ex: Maison Kossou — Bijoux du Royaume"
                            class="w-full bg-transparent border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all font-body-lg text-body-lg placeholder:text-outline-variant"
                        />
                        @error('shop_name')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Domaine Artisanal --}}
                    <div class="relative group">
                        <label class="block font-label-caps text-label-caps text-on-surface-variant uppercase mb-2 group-focus-within:text-secondary transition-colors">
                            Domaine Artisanal
                        </label>
                        <div class="relative">
                            <select
                                name="craft_type"
                                class="w-full bg-transparent border-0 border-b border-outline-variant py-3 px-0 pr-8 focus:ring-0 focus:border-secondary transition-all font-body-lg text-body-lg text-on-surface"
                            >
                                <option disabled value="" {{ old('craft_type') ? '' : 'selected' }}>Sélectionnez votre domaine...</option>
                                <option value="leather"   {{ old('craft_type') === 'leather'   ? 'selected' : '' }}>Maroquinerie de Prestige</option>
                                <option value="jewelry"   {{ old('craft_type') === 'jewelry'   ? 'selected' : '' }}>Bijoux en Bronze Fin</option>
                                <option value="textile"   {{ old('craft_type') === 'textile'   ? 'selected' : '' }}>Textiles Indigo Héritage</option>
                                <option value="sculpture" {{ old('craft_type') === 'sculpture' ? 'selected' : '' }}>Sculpture sur Bois Traditionnel</option>
                            </select>
                            <span class="material-symbols-outlined absolute right-0 bottom-3 pointer-events-none text-outline">expand_more</span>
                        </div>
                        @error('craft_type')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Histoire de la Maison --}}
                    <div class="relative group">
                        <label class="block font-label-caps text-label-caps text-on-surface-variant uppercase mb-2 group-focus-within:text-secondary transition-colors">
                            Histoire de la Maison
                        </label>
                        <textarea
                            name="shop_story"
                            id="shop-story"
                            rows="5"
                            maxlength="2000"
                            placeholder="Décrivez l'héritage, les techniques ancestrales et la philosophie derrière vos créations..."
                            class="w-full bg-transparent border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all font-body-lg text-body-lg placeholder:text-outline-variant resize-none"
                        >{{ old('shop_story') }}</textarea>
                        <div class="flex justify-between items-center mt-1">
                            @error('shop_story')
                                <span class="field-error">{{ $message }}</span>
                            @else
                                <span class="text-[10px] text-on-surface-variant/60">Minimum 50 caractères</span>
                            @enderror
                            <span class="char-counter" id="story-counter">0 / 2000</span>
                        </div>
                    </div>
                </section>

                {{-- ── SECTION 2 : Documents de Vérification ── --}}
                <section class="space-y-6">
                    <div class="border-b border-outline-variant/30 pb-4">
                        <h3 class="font-headline-md text-headline-md text-primary">Documents de Vérification</h3>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-1">Uploadez vos justificatifs pour valider votre statut d'artisan.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        {{-- Upload : Pièce d'Identité (OBLIGATOIRE) --}}
                        <div>
                            <label class="block font-label-caps text-label-caps text-on-surface-variant uppercase mb-4">
                                Pièce d'Identité <span class="text-error">*</span>
                            </label>

                            {{-- Zone de drop cachée reliée à un input file --}}
                            <div
                                class="upload-zone p-8 flex flex-col items-center justify-center text-center space-y-4 min-h-[200px]"
                                id="id-drop-zone"
                                onclick="document.getElementById('id_document').click()"
                            >
                                <span class="material-symbols-outlined text-4xl text-outline-variant" id="id-icon">picture_as_pdf</span>
                                <div>
                                    <p class="font-body-md font-semibold text-primary uppercase text-sm" id="id-label">Pièce d'Identité</p>
                                    <p class="font-label-caps text-[10px] text-on-surface-variant mt-1 uppercase" id="id-sublabel">PDF, JPG, PNG (Max 5MB)</p>
                                </div>
                                <p class="text-[11px] text-on-surface-variant/60">Cliquez ou glissez-déposez</p>
                            </div>

                            {{-- Input file caché --}}
                            <input
                                type="file"
                                id="id_document"
                                name="id_document"
                                accept=".pdf,.jpg,.jpeg,.png"
                                class="hidden"
                            />
                            @error('id_document')
                                <span class="field-error mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Upload : Certification Artisanale (OPTIONNEL) --}}
                        <div>
                            <label class="block font-label-caps text-label-caps text-on-surface-variant uppercase mb-4">
                                Certification Artisanale <span class="text-on-surface-variant/40 font-normal">(optionnel)</span>
                            </label>
                            <div
                                class="upload-zone p-8 flex flex-col items-center justify-center text-center space-y-4 min-h-[200px]"
                                id="cert-drop-zone"
                                onclick="document.getElementById('certification').click()"
                            >
                                <span class="material-symbols-outlined text-4xl text-outline-variant" id="cert-icon">verified_user</span>
                                <div>
                                    <p class="font-body-md font-semibold text-primary uppercase text-sm" id="cert-label">Certification Officielle</p>
                                    <p class="font-label-caps text-[10px] text-on-surface-variant mt-1 uppercase" id="cert-sublabel">Accréditation officielle</p>
                                </div>
                                <p class="text-[11px] text-on-surface-variant/60">Cliquez ou glissez-déposez</p>
                            </div>
                            <input type="file" id="certification" name="certification" accept=".pdf,.jpg,.jpeg,.png" class="hidden" />
                            @error('certification')
                                <span class="field-error mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </section>

                {{-- ── ACTIONS ── --}}
                <div class="flex items-center justify-between pt-8 border-t border-outline-variant/30">
                    <a href="{{ route('artisan.onboarding.step1') }}"
                       class="px-8 py-4 border border-outline-variant/50 text-on-surface-variant font-label-caps text-label-caps uppercase tracking-[0.15em] hover:bg-surface-container hover:text-primary transition-all">
                        Étape Précédente
                    </a>
                    <button
                        type="submit"
                        id="submit-btn-2"
                        class="px-12 py-4 bg-primary text-on-primary font-label-caps text-label-caps uppercase tracking-widest hover:bg-on-surface-variant transition-all shadow-sm flex items-center gap-3"
                    >
                        <span id="btn2-text">Confirmer &amp; Soumettre</span>
                        <span id="btn2-loader" class="hidden material-symbols-outlined text-[18px]" style="animation: spin 1s linear infinite;">progress_activity</span>
                        <span id="btn2-arrow" class="material-symbols-outlined text-[18px]">chevron_right</span>
                    </button>
                </div>

            </form>
        </div>

        {{-- ===== COLONNE DROITE : Visuel + Infos (5 colonnes) ===== --}}
        <div class="lg:col-span-5 space-y-12 hidden lg:block">
            <div class="sticky top-32">
                <div class="aspect-[4/5] w-full bg-surface-container-high relative overflow-hidden group">
                    <img class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105"
                         src="https://lh3.googleusercontent.com/aida-public/AB6AXuCavRsQEnj4ydZRUuKUdLbOQi1-DtW8tHanxeyYil37KhNa-wpR9-RsyHKb6xDQ_5fwe06inmYAGmL16T5WhxdFHcuhdshHW3V4SDII3pMZ7EKuwY1TtxmV0oiVh0V_tz7qmYxZDxUafjL_SjzB9EWkk0DPDZ2RdMPppFVu2y8CxfB30SyCWvvBJAEWPDYPExdO79vRe4_ydK1IlC4jkaX9WHDGHiqjNrN3MUoSUFTkvAstbaE3ixgLm1QoFOk15jmqEb7Z--frzQ"
                         alt="Heritage Craftsmanship" />
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/40 to-transparent flex flex-col justify-end p-10">
                        <span class="font-label-caps text-label-caps text-secondary-fixed uppercase tracking-widest">Heritage Excellence</span>
                        <h3 class="font-headline-md text-headline-md text-white mt-2 italic">"Crafting legacies, not just products."</h3>
                    </div>
                </div>

                <div class="mt-8 p-8 border border-outline-variant/30 space-y-6">
                    <h4 class="font-label-caps text-label-caps text-primary uppercase tracking-widest">Pourquoi ces documents ?</h4>
                    <div class="flex gap-4">
                        <span class="material-symbols-outlined text-secondary" style="font-variation-settings:'FILL' 1;">verified</span>
                        <div>
                            <p class="font-body-md text-body-md text-on-surface font-semibold">Excellence Vérifiée</p>
                            <p class="font-body-md text-body-md text-on-surface-variant mt-1">Nos clients premium valorisent l'authenticité. La vérification garantit votre légitimité.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <span class="material-symbols-outlined text-secondary" style="font-variation-settings:'FILL' 1;">shield_person</span>
                        <div>
                            <p class="font-body-md text-body-md text-on-surface font-semibold">Chiffrement Sécurisé</p>
                            <p class="font-body-md text-body-md text-on-surface-variant mt-1">Tous les documents sont chiffrés AES-256. Votre confidentialité est primordiale.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<footer class="w-full bg-surface-container-lowest border-t border-outline-variant/50">
    <div class="flex flex-col md:flex-row justify-between items-center px-margin-desktop py-12 w-full max-w-container-max mx-auto">
        <h2 class="font-headline-md text-headline-md text-primary mb-6 md:mb-0">L'ÉCLAT DU BÉNIN</h2>
        <p class="font-label-caps text-label-caps text-on-surface-variant/60 uppercase tracking-widest">© 2024 L'ÉCLAT DU BÉNIN. HERITAGE EXCELLENCE.</p>
    </div>
</footer>

<script>
/**
 * JAVASCRIPT DE LA PAGE DE CONFIGURATION
 * =========================================
 * 1. Compteur de caractères pour le textarea
 * 2. Gestion des zones de drop (drag & drop + click)
 * 3. Loader sur le bouton de soumission
 */

// --- 1. COMPTEUR DE CARACTÈRES ---
const storyArea    = document.getElementById('shop-story');
const storyCounter = document.getElementById('story-counter');

function updateCounter() {
    const len = storyArea.value.length;
    storyCounter.textContent = `${len} / 2000`;
    storyCounter.classList.toggle('limit', len > 1900);
}
storyArea.addEventListener('input', updateCounter);
updateCounter(); // Initialiser au chargement (si old() est pré-rempli)

// --- 2. GESTION DES ZONES D'UPLOAD ---
/**
 * Configure une zone de drop pour un input file donné
 * @param {string} dropZoneId - ID de la div de drop
 * @param {string} inputId    - ID de l'input file
 * @param {string} iconId     - ID de l'icône à changer
 * @param {string} labelId    - ID du texte principal
 * @param {string} sublabelId - ID du sous-texte
 */
function setupDropZone(dropZoneId, inputId, iconId, labelId, sublabelId) {
    const zone      = document.getElementById(dropZoneId);
    const input     = document.getElementById(inputId);
    const icon      = document.getElementById(iconId);
    const label     = document.getElementById(labelId);
    const sublabel  = document.getElementById(sublabelId);

    // Quand l'utilisateur sélectionne un fichier via le sélecteur
    input.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            showUploadSuccess(this.files[0], zone, icon, label, sublabel);
        }
    });

    // Drag & Drop events
    zone.addEventListener('dragover', (e) => {
        e.preventDefault();
        zone.classList.add('drag-over');
    });

    zone.addEventListener('dragleave', () => {
        zone.classList.remove('drag-over');
    });

    zone.addEventListener('drop', (e) => {
        e.preventDefault();
        zone.classList.remove('drag-over');
        const file = e.dataTransfer.files[0];
        if (file) {
            // Passer le fichier à l'input (pour que le formulaire l'envoie)
            const dt = new DataTransfer();
            dt.items.add(file);
            input.files = dt.files;
            showUploadSuccess(file, zone, icon, label, sublabel);
        }
    });
}

function showUploadSuccess(file, zone, icon, label, sublabel) {
    // Changer l'apparence de la zone
    zone.classList.add('uploaded');
    icon.textContent = 'check_circle';
    icon.style.color = '#5e8e77';

    // Afficher le nom du fichier (tronqué si trop long)
    const name = file.name.length > 30 ? file.name.substring(0, 27) + '...' : file.name;
    label.textContent = name;

    // Taille du fichier
    const size = (file.size / 1024 / 1024).toFixed(2);
    sublabel.textContent = `${size} MB — Fichier reçu`;
    sublabel.style.color = '#5e8e77';
}

// Initialiser les deux zones d'upload
setupDropZone('id-drop-zone',   'id_document',  'id-icon',   'id-label',   'id-sublabel');
setupDropZone('cert-drop-zone', 'certification', 'cert-icon', 'cert-label', 'cert-sublabel');

// --- 3. LOADER BOUTON SUBMIT ---
const form2     = document.getElementById('step2-form');
const btn2      = document.getElementById('submit-btn-2');
const btn2text  = document.getElementById('btn2-text');
const btn2loader = document.getElementById('btn2-loader');
const btn2arrow = document.getElementById('btn2-arrow');

form2.addEventListener('submit', function() {
    btn2text.textContent = 'Envoi en cours...';
    btn2arrow.classList.add('hidden');
    btn2loader.classList.remove('hidden');
    btn2.disabled = true;
});
</script>

<style>
@keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
</style>

</body>
</html>
