{{-- resources/views/admin/categories/edit.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Modifier {{ $category->name }} | Admin</title>
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
                "on-tertiary-container":"#5e8e77",
            },
            fontFamily: { "sans":["Montserrat","sans-serif"] }
        }}}
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24; }
        .upload-zone { border: 2px dashed #c4c7c7; transition: all 0.2s; cursor: pointer; }
        .upload-zone:hover { border-color: #012F24; background: #f4f3f1; }
        .upload-zone.has-file { border-style: solid; border-color: #5e8e77; }
        .modal-overlay { position:fixed;inset:0;background:rgba(0,0,0,0.5);z-index:100;display:flex;align-items:center;justify-content:center;padding:20px; }
        .modal-overlay.hidden { display:none; }
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
    <header class="bg-surface border-b border-outline-variant/30 px-8 py-5 flex items-center justify-between sticky top-0 z-40">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.categories.index') }}" class="text-on-surface-variant hover:text-primary transition-colors">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <h2 class="text-xl font-bold text-primary" style="font-family:'Playfair Display',serif">
                    Modifier : {{ $category->name }}
                </h2>
                <p class="text-sm text-on-surface-variant mt-0.5">
                    Page publique : <a href="/collection/{{ $category->slug }}" target="_blank"
                        class="text-secondary hover:underline">/collection/{{ $category->slug }}</a>
                </p>
            </div>
        </div>
        <a href="/collection/{{ $category->slug }}" target="_blank"
           class="flex items-center gap-2 border border-outline-variant text-on-surface-variant px-4 py-2 text-xs font-semibold uppercase tracking-widest hover:text-primary hover:border-primary transition-all">
            <span class="material-symbols-outlined text-[16px]">open_in_new</span>
            Voir la page
        </a>
    </header>

    <main class="p-8">

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 flex items-center gap-3">
                <span class="material-symbols-outlined text-green-600" style="font-variation-settings:'FILL' 1">check_circle</span>
                <p class="text-sm text-green-800">{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 flex items-center gap-3">
                <span class="material-symbols-outlined text-red-600">error</span>
                <p class="text-sm text-red-800">{{ session('error') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 border-l-2 border-error bg-error-container/30">
                @foreach ($errors->all() as $error)
                    <p class="text-xs text-error">— {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ══ COLONNE PRINCIPALE : Infos + Héro ══ --}}
            <div class="lg:col-span-2 space-y-6">

                <form action="{{ route('admin.categories.update', $category) }}" method="POST"
                      enctype="multipart/form-data" id="cat-form">
                    @csrf
                    @method('PUT')

                    {{-- Image héro actuelle --}}
                    <section class="bg-surface border border-outline-variant/30 p-7">
                        <h3 class="font-bold text-primary uppercase tracking-widest text-xs mb-4">Image Héro</h3>

                        @if($category->hero_image)
                            <div class="relative aspect-video overflow-hidden mb-4">
                                <img src="{{ asset('storage/' . $category->hero_image) }}"
                                     class="w-full h-full object-cover" id="current-hero" />
                                <div class="absolute inset-0 bg-primary/20 flex items-end p-4">
                                    <span class="text-white text-xs font-semibold">Image actuelle</span>
                                </div>
                            </div>
                            <p class="text-xs text-on-surface-variant mb-4">
                                Pour changer l'image, uploadez-en une nouvelle ci-dessous. Laissez vide pour conserver l'actuelle.
                            </p>
                        @else
                            <div class="mb-4 p-4 bg-surface-container-low border border-outline-variant/30 text-center">
                                <span class="material-symbols-outlined text-3xl text-outline-variant block mb-2">image</span>
                                <p class="text-xs text-on-surface-variant">Aucune image héro définie</p>
                            </div>
                        @endif

                        {{-- Zone upload --}}
                        <div class="upload-zone p-6 flex items-center gap-4"
                             id="hero-zone" onclick="document.getElementById('hero_image').click()">
                            <span class="material-symbols-outlined text-3xl text-outline-variant" id="hero-icon">add_photo_alternate</span>
                            <div>
                                <p class="text-xs font-semibold text-primary uppercase tracking-widest" id="hero-label">
                                    {{ $category->hero_image ? 'Remplacer l\'image' : 'Ajouter une image' }}
                                </p>
                                <p class="text-[10px] text-on-surface-variant mt-0.5">JPG, PNG ou WEBP — Max 4MB — Recommandé : 1920×1080px</p>
                            </div>
                        </div>
                        <input type="file" id="hero_image" name="hero_image" accept="image/jpeg,image/png,image/webp" class="hidden" />

                        {{-- Prévisualisation de la nouvelle image --}}
                        <div id="new-preview-container" class="hidden mt-4 relative aspect-video overflow-hidden">
                            <img id="new-preview" class="w-full h-full object-cover" />
                            <div class="absolute inset-0 bg-primary/20 flex items-end p-4">
                                <span class="text-white text-xs font-semibold">Nouvelle image</span>
                            </div>
                            <button type="button" onclick="clearNewHero()"
                                class="absolute top-3 right-3 bg-white/90 text-primary px-2 py-1 text-[10px] font-semibold uppercase">
                                Annuler
                            </button>
                        </div>
                    </section>

                    {{-- Infos de base --}}
                    <section class="bg-surface border border-outline-variant/30 p-7 space-y-6">
                        <h3 class="font-bold text-primary uppercase tracking-widest text-xs">Informations</h3>

                        <div>
                            <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Nom <span class="text-error">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $category->name) }}"
                                   class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg bg-transparent" />
                            <p class="text-[10px] text-on-surface-variant mt-1">
                                ⚠️ Le slug URL <code class="bg-surface-container px-1">/collection/{{ $category->slug }}</code> ne change pas quand vous modifiez le nom.
                            </p>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Titre affiché sur la page</label>
                            <input type="text" name="hero_title" value="{{ old('hero_title', $category->hero_title) }}"
                                   class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all bg-transparent" />
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Description de la page</label>
                            <textarea name="hero_description" rows="3" maxlength="500"
                                      class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all resize-none bg-transparent">{{ old('hero_description', $category->hero_description) }}</textarea>
                        </div>

                        <div class="w-48">
                            <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Ordre dans le menu</label>
                            <input type="number" name="display_order" value="{{ old('display_order', $category->display_order) }}"
                                   min="0" step="1"
                                   class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all bg-transparent" />
                        </div>
                    </section>

                    {{-- Actions --}}
                    <div class="flex items-center justify-between">
                        <a href="{{ route('admin.categories.index') }}"
                           class="px-8 py-4 border border-outline-variant/50 text-on-surface-variant text-xs font-semibold uppercase tracking-widest hover:bg-surface-container transition-all">
                            Annuler
                        </a>
                        <button type="submit" id="submit-btn"
                            class="px-12 py-4 bg-primary text-white text-xs font-semibold uppercase tracking-widest hover:bg-primary/90 transition-all flex items-center gap-3">
                            <span id="btn-text">Enregistrer</span>
                            <span id="btn-loader" class="hidden material-symbols-outlined text-[16px]" style="animation:spin 1s linear infinite">progress_activity</span>
                        </button>
                    </div>

                </form>
            </div>

            {{-- ══ COLONNE DROITE : Sous-catégories ══ --}}
            <div class="space-y-5">
                <section class="bg-surface border border-outline-variant/30 p-6">
                    <div class="flex items-center justify-between mb-5">
                        <h3 class="font-bold text-primary uppercase tracking-widest text-xs">Filtres</h3>
                        <span class="text-[10px] text-on-surface-variant/60">{{ $category->subcategories->count() }} filtre(s)</span>
                    </div>

                    {{-- Liste des sous-catégories existantes --}}
                    @if($category->subcategories->count() > 0)
                        <div class="space-y-2 mb-5">
                            @foreach($category->subcategories->sortBy('display_order') as $sub)
                                <div class="flex items-center justify-between bg-surface-container-low px-3 py-2">
                                    <div>
                                        <span class="text-sm font-medium text-primary">{{ $sub->name }}</span>
                                        <span class="text-[10px] text-on-surface-variant ml-2">/{{ $sub->slug }}</span>
                                    </div>
                                    <form action="{{ route('admin.categories.subcategory.destroy', $sub) }}"
                                          method="POST"
                                          onsubmit="return confirm('Supprimer le filtre « {{ $sub->name }} » ?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-error/60 hover:text-error transition-colors p-1">
                                            <span class="material-symbols-outlined text-[16px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-on-surface-variant/60 italic mb-4">Aucun filtre — les clients voient tous les produits sans filtre.</p>
                    @endif

                    {{-- Ajouter une sous-catégorie --}}
                    <div class="border-t border-outline-variant/20 pt-4">
                        <p class="text-[10px] text-on-surface-variant uppercase tracking-widest mb-3">Ajouter un filtre</p>
                        <form action="{{ route('admin.categories.subcategory.add', $category) }}" method="POST"
                              class="flex gap-2">
                            @csrf
                            <input type="text" name="name"
                                   placeholder="Ex: Nattes de Sol"
                                   class="flex-1 border border-outline-variant px-3 py-2 text-sm focus:ring-0 focus:border-primary bg-transparent" />
                            <button type="submit"
                                class="px-4 py-2 bg-primary text-white text-[11px] font-semibold uppercase tracking-widest hover:bg-primary/90 transition-all">
                                Ajouter
                            </button>
                        </form>
                    </div>
                </section>

                {{-- Stats rapides --}}
                <section class="bg-surface border border-outline-variant/30 p-6">
                    <h3 class="font-bold text-primary uppercase tracking-widest text-xs mb-4">Statistiques</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Produits totaux</span>
                            <span class="text-sm font-bold text-primary">{{ $category->products()->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Publiés</span>
                            <span class="text-sm font-bold text-on-tertiary-container">{{ $category->products()->where('moderation_status','published')->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">En attente</span>
                            <span class="text-sm font-bold text-secondary">{{ $category->products()->where('moderation_status','pending_review')->count() }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-xs text-on-surface-variant">Vérifiés (badge)</span>
                            <span class="text-sm font-bold text-secondary">{{ $category->products()->where('verification_status','verified')->count() }}</span>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
</div>

<style>@keyframes spin { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }</style>

<script>
// Upload image héro
document.getElementById('hero_image').addEventListener('change', function() {
    if (!this.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('new-preview-container').classList.remove('hidden');
        document.getElementById('new-preview').src = e.target.result;
        const zone = document.getElementById('hero-zone');
        zone.classList.add('has-file');
        document.getElementById('hero-icon').textContent = 'check_circle';
        document.getElementById('hero-icon').style.color = '#5e8e77';
        document.getElementById('hero-label').textContent = this.files[0].name;
    };
    reader.readAsDataURL(this.files[0]);
});

function clearNewHero() {
    document.getElementById('hero_image').value = '';
    document.getElementById('new-preview-container').classList.add('hidden');
    document.getElementById('hero-zone').classList.remove('has-file');
    document.getElementById('hero-icon').textContent = 'add_photo_alternate';
    document.getElementById('hero-icon').style.color = '';
    document.getElementById('hero-label').textContent = "{{ $category->hero_image ? 'Remplacer l\'image' : 'Ajouter une image' }}";
}

// Loader submit
document.getElementById('cat-form').addEventListener('submit', function() {
    document.getElementById('btn-text').textContent = 'Enregistrement...';
    document.getElementById('btn-loader').classList.remove('hidden');
    document.getElementById('submit-btn').disabled = true;
});
</script>

</body>
</html>
