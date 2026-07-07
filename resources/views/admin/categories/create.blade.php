{{-- resources/views/admin/categories/create.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Nouvelle Catégorie | Admin L'Éclat du Bénin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: {
            colors: {
                "primary":"#012F24","secondary":"#735c00","background":"#faf9f6","surface":"#ffffff",
                "surface-container":"#efeeeb","surface-container-low":"#f4f3f1","outline-variant":"#c4c7c7",
                "on-surface-variant":"#444748","on-surface":"#1a1c1a","secondary-container":"#fed65b",
                "secondary-fixed":"#ffe088","error":"#ba1a1a","error-container":"#ffdad6",
            },
            fontFamily: { "sans":["Montserrat","sans-serif"] }
        }}}
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24; }
        .upload-zone { border: 2px dashed #c4c7c7; transition: all 0.2s; cursor: pointer; }
        .upload-zone:hover { border-color: #012F24; background: #f4f3f1; }
        .upload-zone.has-file { border-style: solid; border-color: #5e8e77; background: #f0fff8; }
        .sub-tag { display: inline-flex; align-items: center; gap: 4px; background: #efeeeb; padding: 4px 10px; font-size: 11px; font-weight: 600; }
    </style>
</head>
<body class="bg-background text-on-surface min-h-screen">

{{-- Sidebar --}}
<aside class="fixed left-0 top-0 h-full w-64 bg-primary text-white z-50 flex flex-col">
    <div class="p-6 border-b border-white/10">
        <h1 class="font-bold text-sm uppercase tracking-widest" style="font-family:'Playfair Display',serif">L'ÉCLAT DU BÉNIN</h1>
        <p class="text-white/40 text-xs mt-1">Administration</p>
    </div>
    <nav class="flex-1 p-4 space-y-1">
        <a href="{{ route('admin.artisans.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-white/60 hover:text-white hover:bg-white/5 rounded transition-all">
            <span class="material-symbols-outlined text-[20px]">storefront</span> Artisans
        </a>
        <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm bg-white/10 text-white rounded">
            <span class="material-symbols-outlined text-[20px]">category</span> Catégories
        </a>
        <a href="{{ route('admin.products.moderation') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-white/60 hover:text-white hover:bg-white/5 rounded transition-all">
            <span class="material-symbols-outlined text-[20px]">inventory_2</span> Produits
        </a>
        <a href="{{ route('admin.products.verification') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-white/60 hover:text-white hover:bg-white/5 rounded transition-all">
            <span class="material-symbols-outlined text-[20px]">verified</span> Vérifications
        </a>
    </nav>
</aside>

<div class="ml-64">
    <header class="bg-surface border-b border-outline-variant/30 px-8 py-5 flex items-center gap-4 sticky top-0 z-40">
        <a href="{{ route('admin.categories.index') }}" class="text-on-surface-variant hover:text-primary transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="text-xl font-bold text-primary" style="font-family:'Playfair Display',serif">Nouvelle Catégorie</h2>
            <p class="text-sm text-on-surface-variant mt-0.5">Créez une nouvelle section de catalogue</p>
        </div>
    </header>

    <main class="p-8 max-w-3xl">

        @if ($errors->any())
            <div class="mb-6 p-4 border-l-2 border-error bg-error-container/30">
                <p class="text-xs font-semibold text-error uppercase mb-2">Corrigez les erreurs :</p>
                @foreach ($errors->all() as $error)
                    <p class="text-xs text-error">— {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8" id="cat-form">
            @csrf

            {{-- ── IMAGE HÉRO ── --}}
            <section class="bg-surface border border-outline-variant/30 p-7">
                <h3 class="font-bold text-primary uppercase tracking-widest text-xs mb-1">Image Héro</h3>
                <p class="text-xs text-on-surface-variant mb-5">
                    Affichée en fond plein écran en haut de la page de la catégorie.
                    Recommandé : 1920×1080px minimum, style éditorial sombre.
                </p>

                <div class="upload-zone p-10 flex flex-col items-center justify-center text-center"
                     id="hero-zone" onclick="document.getElementById('hero_image').click()">
                    <span class="material-symbols-outlined text-4xl text-outline-variant mb-3" id="hero-icon">add_photo_alternate</span>
                    <p class="font-bold text-xs text-primary uppercase tracking-widest" id="hero-label">Choisir une image</p>
                    <p class="text-[10px] text-on-surface-variant mt-1" id="hero-sublabel">JPG, PNG ou WEBP — Max 4MB</p>
                    <p class="text-[10px] text-on-surface-variant/60 mt-2">Cliquez ou glissez-déposez</p>
                </div>
                <input type="file" id="hero_image" name="hero_image" accept="image/jpeg,image/png,image/webp" class="hidden" />

                {{-- Prévisualisation --}}
                <div id="hero-preview-container" class="hidden mt-4 relative aspect-video overflow-hidden">
                    <img id="hero-preview" class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-primary/30 flex items-end p-4">
                        <p class="text-white text-xs font-semibold">Aperçu du héro</p>
                    </div>
                    <button type="button" onclick="clearHero()"
                        class="absolute top-3 right-3 bg-white/90 text-primary px-2 py-1 text-[10px] font-semibold uppercase hover:bg-white transition-all">
                        Changer
                    </button>
                </div>
            </section>

            {{-- ── INFORMATIONS DE BASE ── --}}
            <section class="bg-surface border border-outline-variant/30 p-7 space-y-6">
                <h3 class="font-bold text-primary uppercase tracking-widest text-xs">Informations</h3>

                {{-- Nom --}}
                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">
                        Nom de la Catégorie <span class="text-error">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           placeholder="Ex: Textile Indigo"
                           class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg bg-transparent"
                           id="name-input" />
                    {{-- Slug généré automatiquement --}}
                    <div class="flex items-center gap-2 mt-2">
                        <span class="text-[10px] text-on-surface-variant">URL générée :</span>
                        <code class="text-[10px] text-secondary bg-secondary-container/20 px-2 py-0.5" id="slug-preview">/collection/...</code>
                    </div>
                    @error('name')
                        <p class="text-xs text-error mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Titre héro (différent du nom de la catégorie) --}}
                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">
                        Titre affiché sur la page <span class="font-normal">(optionnel, sinon = nom)</span>
                    </label>
                    <input type="text" name="hero_title" value="{{ old('hero_title') }}"
                           placeholder='Ex: "Maîtrise du Tissu Indigo"'
                           class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all bg-transparent" />
                </div>

                {{-- Description héro --}}
                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">
                        Description de la page <span class="font-normal">(optionnel)</span>
                    </label>
                    <textarea name="hero_description" rows="3" maxlength="500"
                              placeholder="Présentez cette catégorie en 1 ou 2 phrases..."
                              class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all resize-none bg-transparent">{{ old('hero_description') }}</textarea>
                    <p class="text-[10px] text-on-surface-variant/60 text-right mt-1">Max 500 caractères</p>
                </div>

                {{-- Ordre d'affichage --}}
                <div class="w-48">
                    <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">
                        Ordre dans le menu
                    </label>
                    <input type="number" name="display_order" value="{{ old('display_order', \App\Models\Category::max('display_order') + 1) }}"
                           min="0" step="1"
                           class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all bg-transparent" />
                    <p class="text-[10px] text-on-surface-variant/60 mt-1">1 = premier dans le menu</p>
                </div>
            </section>

            {{-- ── SOUS-CATÉGORIES / FILTRES ── --}}
            <section class="bg-surface border border-outline-variant/30 p-7">
                <h3 class="font-bold text-primary uppercase tracking-widest text-xs mb-1">Filtres de Sous-Catégories</h3>
                <p class="text-xs text-on-surface-variant mb-5">
                    Ces filtres apparaîtront sous le héro pour permettre aux clients de trier les produits.
                    Saisissez les noms séparés par des virgules.
                </p>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">
                        Sous-catégories <span class="font-normal">(séparées par des virgules)</span>
                    </label>
                    <input type="text" name="subcategories" id="subcategories-input"
                           value="{{ old('subcategories') }}"
                           placeholder="Ex: Pagnes, Écharpes, Nappe de Cérémonie"
                           class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all bg-transparent" />
                </div>

                {{-- Prévisualisation des tags --}}
                <div id="tags-preview" class="flex flex-wrap gap-2 mt-4 hidden">
                    <p class="w-full text-[10px] text-on-surface-variant uppercase tracking-widest mb-1">Aperçu des filtres :</p>
                </div>
            </section>

            {{-- ── ACTIONS ── --}}
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.categories.index') }}"
                   class="px-8 py-4 border border-outline-variant/50 text-on-surface-variant text-xs font-semibold uppercase tracking-widest hover:bg-surface-container transition-all">
                    Annuler
                </a>
                <button type="submit" id="submit-btn"
                    class="px-12 py-4 bg-primary text-white text-xs font-semibold uppercase tracking-widest hover:bg-primary/90 transition-all flex items-center gap-3">
                    <span id="btn-text">Créer la Catégorie</span>
                    <span id="btn-loader" class="hidden material-symbols-outlined text-[16px]" style="animation:spin 1s linear infinite">progress_activity</span>
                </button>
            </div>

        </form>
    </main>
</div>

<style>@keyframes spin { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }</style>

<script>
// ── GÉNÉRATION DU SLUG EN TEMPS RÉEL ──
document.getElementById('name-input').addEventListener('input', function() {
    const slug = this.value
        .toLowerCase()
        .normalize('NFD').replace(/[\u0300-\u036f]/g, '') // supprimer accents
        .replace(/[^a-z0-9\s-]/g, '')
        .trim()
        .replace(/\s+/g, '-');
    document.getElementById('slug-preview').textContent = slug ? `/collection/${slug}` : '/collection/...';
});

// ── UPLOAD IMAGE HÉRO ──
document.getElementById('hero_image').addEventListener('change', function() {
    if (!this.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('hero-zone').classList.add('hidden');
        const container = document.getElementById('hero-preview-container');
        container.classList.remove('hidden');
        document.getElementById('hero-preview').src = e.target.result;

        // Marquer la zone comme remplie
        const zone = document.getElementById('hero-zone');
        zone.classList.add('has-file');
        document.getElementById('hero-icon').textContent = 'check_circle';
        document.getElementById('hero-icon').style.color = '#5e8e77';
        document.getElementById('hero-label').textContent = this.files[0].name;
        document.getElementById('hero-sublabel').textContent = (this.files[0].size / 1024 / 1024).toFixed(2) + ' MB';
    };
    reader.readAsDataURL(this.files[0]);
});

function clearHero() {
    document.getElementById('hero_image').value = '';
    document.getElementById('hero-preview-container').classList.add('hidden');
    document.getElementById('hero-zone').classList.remove('hidden');
    document.getElementById('hero-zone').classList.remove('has-file');
    document.getElementById('hero-icon').textContent = 'add_photo_alternate';
    document.getElementById('hero-icon').style.color = '';
    document.getElementById('hero-label').textContent = 'Choisir une image';
    document.getElementById('hero-sublabel').textContent = 'JPG, PNG ou WEBP — Max 4MB';
}

// ── PRÉVISUALISATION SOUS-CATÉGORIES EN TAGS ──
const subInput = document.getElementById('subcategories-input');
const tagsPreview = document.getElementById('tags-preview');

subInput.addEventListener('input', function() {
    const values = this.value.split(',').map(v => v.trim()).filter(v => v);
    if (values.length === 0) {
        tagsPreview.classList.add('hidden');
        return;
    }
    tagsPreview.classList.remove('hidden');
    // Garder seulement le label + les tags
    tagsPreview.innerHTML = '<p class="w-full text-[10px] text-on-surface-variant uppercase tracking-widest mb-1">Aperçu des filtres :</p>';
    values.forEach(v => {
        const tag = document.createElement('span');
        tag.className = 'sub-tag';
        tag.textContent = v;
        tagsPreview.appendChild(tag);
    });
});

// ── LOADER AU SUBMIT ──
document.getElementById('cat-form').addEventListener('submit', function() {
    document.getElementById('btn-text').textContent = 'Création en cours...';
    document.getElementById('btn-loader').classList.remove('hidden');
    document.getElementById('submit-btn').disabled = true;
});
</script>

</body>
</html>
