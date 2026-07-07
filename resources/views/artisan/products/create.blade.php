@extends('layouts.artisan')

@section('title', 'Ajouter un Produit')

@section('extra-styles')
    .upload-slot { border: 1px dashed #c4c7c7; transition: all 0.2s; cursor: pointer; aspect-ratio: 1; }
    .upload-slot:hover { border-color: #735c00; background: #f4f3f1; }
    .upload-slot.filled { border-style: solid; border-color: #5e8e77; }
    .upload-slot.primary-slot::before {
        content: 'PRINCIPALE'; position: absolute; top: 6px; left: 6px; background: #000;
        color: #fff; font-size: 8px; font-weight: 700; letter-spacing: 0.1em; padding: 2px 6px; z-index: 10;
    }
    .char-counter { font-size: 11px; color: #747878; text-align: right; }
    .char-counter.limit { color: #ba1a1a; }
@endsection

@section('content')

<header class="sticky top-0 z-40 bg-surface/80 backdrop-blur-xl border-b border-outline-variant/30 px-8 py-4 flex items-center justify-between">
    <div>
        <div class="flex items-center gap-2 text-xs text-on-surface-variant mb-1">
            <a href="{{ route('artisan.products.index') }}" class="hover:text-primary">Mes Produits</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-primary font-semibold">Nouveau Produit</span>
        </div>
        <h2 class="font-bold text-primary" style="font-family:'Playfair Display',serif; font-size:20px;">
            Ajouter un Nouveau Produit
        </h2>
    </div>
    <a href="{{ route('artisan.products.index') }}" class="flex items-center gap-2 text-on-surface-variant hover:text-primary text-xs font-semibold uppercase tracking-widest">
        <span class="material-symbols-outlined text-[16px]">close</span>
        Annuler
    </a>
</header>

<main class="flex-1 p-8">
    <div class="max-w-4xl mx-auto">

        {{-- Bandeau d'info sur le processus de validation --}}
        <div class="mb-8 p-5 bg-surface-container-low border-l-2 border-secondary flex items-start gap-4">
            <span class="material-symbols-outlined text-secondary text-2xl flex-shrink-0">info</span>
            <div>
                <p class="font-semibold text-primary text-sm">Comment fonctionne la publication ?</p>
                <p class="text-xs text-on-surface-variant mt-1 leading-relaxed">
                    Votre produit sera d'abord examiné par notre équipe (24h en moyenne) avant d'apparaître publiquement.
                    Une fois publié, vous pourrez demander le <strong>badge "Produit Vérifié"</strong> pour renforcer la confiance des acheteurs.
                </p>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 border-l-2 border-error bg-error-container/30">
                <p class="text-xs font-semibold text-error uppercase mb-2">Veuillez corriger les erreurs :</p>
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-xs text-error">— {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('artisan.products.store') }}" method="POST" enctype="multipart/form-data" id="product-form" class="space-y-10">
            @csrf

            {{-- ── SECTION : PHOTOS ── --}}
            <section class="bg-surface border border-outline-variant/30 p-7">
                <h3 class="font-bold text-primary uppercase tracking-widest text-xs mb-1">Photos du Produit</h3>
                <p class="text-xs text-on-surface-variant mb-6">La première photo sera l'image principale affichée sur les pages catégorie. Ajoutez jusqu'à 6 photos.</p>

                <div class="grid grid-cols-3 md:grid-cols-6 gap-4" id="upload-grid">
                    @for($i = 0; $i < 6; $i++)
                        <div class="upload-slot {{ $i === 0 ? 'primary-slot' : '' }} relative bg-surface-container-low flex items-center justify-center overflow-hidden"
                             data-slot="{{ $i }}" onclick="document.getElementById('file-input-{{ $i }}').click()">
                            <span class="material-symbols-outlined text-2xl text-outline-variant" id="slot-icon-{{ $i }}">add_photo_alternate</span>
                            <img class="hidden absolute inset-0 w-full h-full object-cover" id="slot-preview-{{ $i }}" />
                        </div>
                        <input type="file" id="file-input-{{ $i }}" name="images[]" accept="image/jpeg,image/png,image/webp" class="hidden image-input" data-slot="{{ $i }}" />
                    @endfor
                </div>
                <p class="text-[10px] text-on-surface-variant/60 mt-3">JPG, PNG ou WEBP. Maximum 4MB par photo.</p>
            </section>

            {{-- ── SECTION : INFOS PRODUIT ── --}}
            <section class="bg-surface border border-outline-variant/30 p-7 space-y-6">
                <h3 class="font-bold text-primary uppercase tracking-widest text-xs">Informations du Produit</h3>

                {{-- Nom --}}
                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Nom du Produit</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Ex: Grand Alligator « Ouidah »"
                        class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg" />
                </div>

                {{-- Catégorie + Sous-catégorie --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Catégorie</label>
                        <select name="category_id" id="category-select" class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary bg-transparent">
                            <option value="" disabled selected>Choisir une catégorie...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-[10px] text-on-surface-variant/60 mt-2">
                            Détermine sur quelle page votre produit apparaîtra (Bijoux, Maroquinerie, Art...).
                        </p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Sous-catégorie <span class="font-normal">(optionnel)</span></label>
                        <select name="subcategory_id" id="subcategory-select" class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary bg-transparent" disabled>
                            <option value="">Choisissez d'abord une catégorie</option>
                        </select>
                    </div>
                </div>

                {{-- Histoire courte --}}
                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">
                        Signature de l'Atelier <span class="font-normal">(optionnel)</span>
                    </label>
                    <input type="text" name="short_story" value="{{ old('short_story') }}" maxlength="200" placeholder='Ex: "Par Artisan Koffi Mensah"'
                        class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all" />
                    <p class="text-[10px] text-on-surface-variant/60 mt-2">Affiché sous le nom du produit sur les pages catégorie.</p>
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Description Complète</label>
                    <textarea name="description" id="description-area" rows="5" maxlength="3000" placeholder="Décrivez les matériaux, les techniques utilisées, l'inspiration..."
                        class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all resize-none">{{ old('description') }}</textarea>
                    <div class="flex justify-between mt-1">
                        <span class="text-[10px] text-on-surface-variant/60">Minimum 20 caractères</span>
                        <span class="char-counter" id="desc-counter">0 / 3000</span>
                    </div>
                </div>
            </section>

            {{-- ── SECTION : PRIX & STOCK ── --}}
            <section class="bg-surface border border-outline-variant/30 p-7 space-y-6">
                <h3 class="font-bold text-primary uppercase tracking-widest text-xs">Prix & Disponibilité</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Prix (FCFA)</label>
                        <input type="number" name="price" value="{{ old('price') }}" step="1000" placeholder="750000"
                            class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Quantité en Stock</label>
                        <input type="number" name="stock_quantity" value="{{ old('stock_quantity', 1) }}" min="0"
                            class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg" />
                    </div>
                </div>

                {{-- Badge optionnel --}}
                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-3">Badge d'Étiquette <span class="font-normal">(optionnel)</span></label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @foreach(['none' => 'Aucun', 'handmade' => 'Handmade', 'limited_edition' => 'Édition Limitée', 'made_to_order' => 'Sur Commande'] as $value => $label)
                            <label class="relative cursor-pointer">
                                <input type="radio" name="condition_label" value="{{ $value }}" class="peer sr-only" {{ old('condition_label', 'none') === $value ? 'checked' : '' }}>
                                <div class="text-center py-3 px-2 border border-outline-variant peer-checked:border-primary peer-checked:bg-surface-container-low text-xs font-semibold uppercase tracking-wide transition-all">
                                    {{ $label }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- ── ACTIONS ── --}}
            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('artisan.products.index') }}" class="px-8 py-4 border border-outline-variant/50 text-on-surface-variant text-xs font-semibold uppercase tracking-widest hover:bg-surface-container transition-all">
                    Annuler
                </a>
                <button type="submit" id="submit-btn" class="px-12 py-4 bg-primary text-white text-xs font-semibold uppercase tracking-widest hover:bg-on-surface-variant transition-all flex items-center gap-3">
                    <span id="btn-text">Soumettre pour Validation</span>
                    <span id="btn-loader" class="hidden material-symbols-outlined text-[16px]" style="animation: spin 1s linear infinite;">progress_activity</span>
                </button>
            </div>

        </form>
    </div>
</main>

@endsection

@section('extra-scripts')
<script>
/**
 * JS DU FORMULAIRE PRODUIT
 * ==========================
 * 1. Gestion des 6 slots d'upload avec prévisualisation
 * 2. Chargement dynamique des sous-catégories selon la catégorie choisie
 * 3. Compteur de caractères
 * 4. Loader au submit
 */

// --- 1. UPLOAD MULTI-IMAGE AVEC PRÉVISUALISATION ---
document.querySelectorAll('.image-input').forEach(input => {
    input.addEventListener('change', function() {
        const slot = this.dataset.slot;
        const file = this.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = (e) => {
            const slotEl    = document.querySelector(`.upload-slot[data-slot="${slot}"]`);
            const iconEl    = document.getElementById(`slot-icon-${slot}`);
            const previewEl = document.getElementById(`slot-preview-${slot}`);

            previewEl.src = e.target.result;
            previewEl.classList.remove('hidden');
            iconEl.classList.add('hidden');
            slotEl.classList.add('filled');
        };
        reader.readAsDataURL(file);
    });
});

// --- 2. SOUS-CATÉGORIES DYNAMIQUES ---
// Les données sont injectées depuis Blade en JSON (catégories + leurs sous-catégories)
const categoriesData = {!! $categories->keyBy('id')->map(fn($c) => $c->subcategories->map(fn($s) => ['id' => $s->id, 'name' => $s->name]))->toJson() !!};

document.getElementById('category-select').addEventListener('change', function() {
    const subSelect = document.getElementById('subcategory-select');
    const subs = categoriesData[this.value] || [];

    subSelect.innerHTML = '';

    if (subs.length === 0) {
        subSelect.innerHTML = '<option value="">Aucune sous-catégorie disponible</option>';
        subSelect.disabled = true;
        return;
    }

    subSelect.disabled = false;
    subSelect.innerHTML = '<option value="">Aucune (optionnel)</option>' +
        subs.map(s => `<option value="${s.id}">${s.name}</option>`).join('');
});

// --- 3. COMPTEUR DE CARACTÈRES ---
const descArea = document.getElementById('description-area');
const descCounter = document.getElementById('desc-counter');
function updateDescCounter() {
    const len = descArea.value.length;
    descCounter.textContent = `${len} / 3000`;
    descCounter.classList.toggle('limit', len > 2900);
}
descArea.addEventListener('input', updateDescCounter);
updateDescCounter();

// --- 4. LOADER AU SUBMIT ---
document.getElementById('product-form').addEventListener('submit', function() {
    document.getElementById('btn-text').textContent = 'Envoi en cours...';
    document.getElementById('btn-loader').classList.remove('hidden');
    document.getElementById('submit-btn').disabled = true;
});
</script>
@endsection
