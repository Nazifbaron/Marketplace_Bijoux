@extends('layouts.artisan')

@section('title', 'Modifier ' . $product->name)

@section('extra-styles')
    .upload-slot { border: 1px dashed #c4c7c7; transition: all 0.2s; cursor: pointer; aspect-ratio: 1; }
    .upload-slot:hover { border-color: #735c00; background: #f4f3f1; }
    .upload-slot.filled { border-style: solid; border-color: #5e8e77; }
    .existing-image { position: relative; aspect-ratio: 1; overflow: hidden; }
    .existing-image .remove-btn {
        position: absolute; top: 6px; right: 6px; width: 22px; height: 22px; background: rgba(0,0,0,0.7);
        color: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 10;
    }
    .existing-image .primary-tag {
        position: absolute; top: 6px; left: 6px; background: #000; color: #fff; font-size: 8px;
        font-weight: 700; letter-spacing: 0.1em; padding: 2px 6px; z-index: 10;
    }
    .char-counter { font-size: 11px; color: #747878; text-align: right; }
@endsection

@section('content')

<header class="sticky top-0 z-40 bg-surface/80 backdrop-blur-xl border-b border-outline-variant/30 px-8 py-4 flex items-center justify-between">
    <div>
        <div class="flex items-center gap-2 text-xs text-on-surface-variant mb-1">
            <a href="{{ route('artisan.products.index') }}" class="hover:text-primary">Mes Produits</a>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="text-primary font-semibold truncate max-w-[200px]">{{ $product->name }}</span>
        </div>
        <h2 class="font-bold text-primary" style="font-family:'Playfair Display',serif; font-size:20px;">Modifier le Produit</h2>
    </div>
    <a href="{{ route('artisan.products.index') }}" class="flex items-center gap-2 text-on-surface-variant hover:text-primary text-xs font-semibold uppercase tracking-widest">
        <span class="material-symbols-outlined text-[16px]">close</span>
        Annuler
    </a>
</header>

<main class="flex-1 p-8">
    <div class="max-w-4xl mx-auto">

        @if($product->isPublished())
            <div class="mb-8 p-5 bg-surface-container-low border-l-2 border-secondary flex items-start gap-4">
                <span class="material-symbols-outlined text-secondary text-2xl flex-shrink-0">info</span>
                <p class="text-xs text-on-surface-variant leading-relaxed">
                    Ce produit est actuellement <strong>publié</strong>. Toute modification le remettra en attente de validation par notre équipe avant de réapparaître sur le site.
                </p>
            </div>
        @endif

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

        <form action="{{ route('artisan.products.update', $product) }}" method="POST" enctype="multipart/form-data" id="product-form" class="space-y-10">
            @csrf
            @method('PUT')

            {{-- ── PHOTOS EXISTANTES ── --}}
            <section class="bg-surface border border-outline-variant/30 p-7">
                <h3 class="font-bold text-primary uppercase tracking-widest text-xs mb-1">Photos Actuelles</h3>
                <p class="text-xs text-on-surface-variant mb-6">Cliquez sur la croix pour retirer une photo.</p>

                <div class="grid grid-cols-3 md:grid-cols-6 gap-4 mb-6" id="existing-images">
                    @foreach($product->images as $image)
                        <div class="existing-image bg-surface-container-low" data-image-id="{{ $image->id }}">
                            @if($image->is_primary)
                                <span class="primary-tag">PRINCIPALE</span>
                            @endif
                            <span class="remove-btn" onclick="removeExistingImage({{ $image->id }}, this)">
                                <span class="material-symbols-outlined text-[14px]">close</span>
                            </span>
                            <img src="{{ $image->url }}" class="w-full h-full object-cover" />
                        </div>
                    @endforeach
                </div>

                <h4 class="text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-3">Ajouter de Nouvelles Photos</h4>
                <div class="grid grid-cols-3 md:grid-cols-6 gap-4">
                    @for($i = 0; $i < 6; $i++)
                        <div class="upload-slot relative bg-surface-container-low flex items-center justify-center overflow-hidden"
                             data-slot="{{ $i }}" onclick="document.getElementById('file-input-{{ $i }}').click()">
                            <span class="material-symbols-outlined text-2xl text-outline-variant" id="slot-icon-{{ $i }}">add_photo_alternate</span>
                            <img class="hidden absolute inset-0 w-full h-full object-cover" id="slot-preview-{{ $i }}" />
                        </div>
                        <input type="file" id="file-input-{{ $i }}" name="images[]" accept="image/jpeg,image/png,image/webp" class="hidden image-input" data-slot="{{ $i }}" />
                    @endfor
                </div>
            </section>

            {{-- ── INFOS PRODUIT ── --}}
            <section class="bg-surface border border-outline-variant/30 p-7 space-y-6">
                <h3 class="font-bold text-primary uppercase tracking-widest text-xs">Informations du Produit</h3>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Nom du Produit</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}"
                        class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Catégorie</label>
                        <select name="category_id" id="category-select" class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary bg-transparent">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Sous-catégorie</label>
                        <select name="subcategory_id" id="subcategory-select" class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary bg-transparent">
                            <option value="">Aucune (optionnel)</option>
                            @foreach($categories->firstWhere('id', $product->category_id)?->subcategories ?? [] as $sub)
                                <option value="{{ $sub->id }}" {{ old('subcategory_id', $product->subcategory_id) == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Signature de l'Atelier</label>
                    <input type="text" name="short_story" value="{{ old('short_story', $product->short_story) }}" maxlength="200"
                        class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all" />
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Description Complète</label>
                    <textarea name="description" id="description-area" rows="5" maxlength="3000"
                        class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all resize-none">{{ old('description', $product->description) }}</textarea>
                    <div class="flex justify-end mt-1">
                        <span class="char-counter" id="desc-counter">0 / 3000</span>
                    </div>
                </div>
            </section>

            {{-- ── PRIX & STOCK ── --}}
            <section class="bg-surface border border-outline-variant/30 p-7 space-y-6">
                <h3 class="font-bold text-primary uppercase tracking-widest text-xs">Prix & Disponibilité</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Prix (FCFA)</label>
                        <input type="number" name="price" value="{{ old('price', $product->price) }}" min="100" step="1000"
                            class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg" />
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Quantité en Stock</label>
                        <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" min="0"
                            class="w-full border-0 border-b border-outline-variant py-3 px-0 focus:ring-0 focus:border-secondary transition-all text-lg" />
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-3">Badge d'Étiquette</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        @foreach(['none' => 'Aucun', 'handmade' => 'Handmade', 'limited_edition' => 'Édition Limitée', 'made_to_order' => 'Sur Commande'] as $value => $label)
                            <label class="relative cursor-pointer">
                                <input type="radio" name="condition_label" value="{{ $value }}" class="peer sr-only" {{ old('condition_label', $product->condition_label) === $value ? 'checked' : '' }}>
                                <div class="text-center py-3 px-2 border border-outline-variant peer-checked:border-primary peer-checked:bg-surface-container-low text-xs font-semibold uppercase tracking-wide transition-all">
                                    {{ $label }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                </div>
            </section>

            <div class="flex items-center justify-between pt-4">
                <a href="{{ route('artisan.products.index') }}" class="px-8 py-4 border border-outline-variant/50 text-on-surface-variant text-xs font-semibold uppercase tracking-widest hover:bg-surface-container transition-all">
                    Annuler
                </a>
                <button type="submit" id="submit-btn" class="px-12 py-4 bg-primary text-white text-xs font-semibold uppercase tracking-widest hover:bg-on-surface-variant transition-all flex items-center gap-3">
                    <span id="btn-text">Enregistrer les Modifications</span>
                    <span id="btn-loader" class="hidden material-symbols-outlined text-[16px]" style="animation: spin 1s linear infinite;">progress_activity</span>
                </button>
            </div>

        </form>
    </div>
</main>

@endsection

@section('extra-scripts')
<script>
// --- Upload nouvelles images (identique au formulaire de création) ---
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

// --- Sous-catégories dynamiques ---
const categoriesData = {!! $categories->keyBy('id')->map(fn($c) => $c->subcategories->map(fn($s) => ['id' => $s->id, 'name' => $s->name]))->toJson() !!};
document.getElementById('category-select').addEventListener('change', function() {
    const subSelect = document.getElementById('subcategory-select');
    const subs = categoriesData[this.value] || [];
    subSelect.innerHTML = '<option value="">Aucune (optionnel)</option>' + subs.map(s => `<option value="${s.id}">${s.name}</option>`).join('');
});

// --- Compteur de caractères ---
const descArea = document.getElementById('description-area');
const descCounter = document.getElementById('desc-counter');
function updateDescCounter() {
    descCounter.textContent = `${descArea.value.length} / 3000`;
}
descArea.addEventListener('input', updateDescCounter);
updateDescCounter();

// --- Suppression d'une image existante (AJAX) ---
function removeExistingImage(imageId, element) {
    if (!confirm('Retirer cette photo ?')) return;

    fetch(`/artisan/produits/image/${imageId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            element.closest('.existing-image').remove();
        }
    })
    .catch(() => alert('Erreur lors de la suppression. Réessayez.'));
}

// --- Loader au submit ---
document.getElementById('product-form').addEventListener('submit', function() {
    document.getElementById('btn-text').textContent = 'Enregistrement...';
    document.getElementById('btn-loader').classList.remove('hidden');
    document.getElementById('submit-btn').disabled = true;
});
</script>
@endsection
