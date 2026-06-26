{{--
    COMPOSANT : CARTE PRODUIT (réutilisable)
    =====================================================================
    Utilisé sur TOUTES les pages publiques (collection, bijoux, art,
    maroquinerie). Affiche le badge "Vérifié" en doré si le produit
    a passé la vérification d'authenticité — exactement comme demandé,
    façon Alibaba.

    Usage : @include('collection.partials.product-card', ['product' => $product])
    =====================================================================
--}}
<div class="group relative">
    <a href="{{ route('collection.product', $product) }}" class="block">
        <div class="aspect-[4/5] overflow-hidden bg-surface-container relative">
            @if($product->primary_image)
                <img src="{{ $product->primary_image }}" alt="{{ $product->name }}"
                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
            @else
                <div class="w-full h-full flex items-center justify-center bg-surface-container-low">
                    <span class="material-symbols-outlined text-4xl text-outline-variant">image</span>
                </div>
            @endif

            {{-- Badge Vérifié (façon Alibaba) — coin supérieur gauche, doré --}}
            @if($product->is_verified)
                <div class="absolute top-3 left-3 bg-black/85 backdrop-blur-sm px-2.5 py-1 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[13px] text-secondary-fixed" style="font-variation-settings:'FILL' 1;">verified</span>
                    <span class="text-[9px] font-bold uppercase tracking-widest text-secondary-fixed">Vérifié</span>
                </div>
            @endif

            {{-- Badge condition (Handmade, Édition Limitée...) — coin supérieur droit --}}
            @if($product->condition_label_text)
                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2.5 py-1">
                    <span class="text-[9px] font-bold uppercase tracking-widest text-primary">{{ $product->condition_label_text }}</span>
                </div>
            @endif

            {{-- Overlay "Vue Rapide" au survol --}}
            <div class="absolute inset-0 bg-primary/0 group-hover:bg-primary/10 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                <span class="bg-white text-primary text-[10px] font-bold uppercase tracking-widest px-4 py-2">Vue Rapide</span>
            </div>
        </div>

        <div class="pt-4">
            @if($product->short_story)
                <p class="text-[10px] text-on-surface-variant uppercase tracking-widest mb-1">{{ $product->short_story }}</p>
            @endif
            <h3 class="font-headline-md text-headline-md mb-1 group-hover:text-secondary transition-colors" style="font-size: 18px; line-height: 24px;">
                {{ $product->name }}
            </h3>
            <p class="font-price-display text-price-display text-primary">{{ $product->formatted_price }}</p>
        </div>
    </a>
</div>
