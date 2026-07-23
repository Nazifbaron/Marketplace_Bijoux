{{--
    resources/views/cart/drawer-content.blade.php
    =====================================================================
    Vue partielle retournée en AJAX par CartController::drawer()
    Rechargée après chaque modification de quantité dans le drawer.
    NE PAS mettre de layout ici — c'est du HTML partiel uniquement.
    =====================================================================
--}}

@if($items->isEmpty())
{{-- État vide --}}
<div class="flex flex-col items-center justify-center h-full px-8 text-center py-16">
    <div class="w-20 h-20 border border-dashed border-outline-variant flex items-center justify-center mb-6">
        <span class="material-symbols-outlined text-4xl text-outline-variant">shopping_bag</span>
    </div>
    <p class="font-bold text-primary text-sm uppercase tracking-widest mb-2"
        style="font-family:'Playfair Display',serif">
        Votre panier est vide
    </p>
    <p class="text-xs text-on-surface-variant leading-relaxed max-w-xs">
        Explorez nos collections pour y ajouter vos pièces de prestige artisanal.
    </p>
    <a href="{{ route('collection.index') }}"
        onclick="closeCart()"
        class="mt-8 inline-block bg-primary text-white px-8 py-3 font-label-caps text-[10px] tracking-widest uppercase hover:bg-primary/90 transition-all">
        Découvrir la Collection
    </a>
</div>

@else
{{-- Liste des items --}}
<div class="divide-y divide-outline-variant/20 p-4">
    @foreach($items as $productId => $item)
    <div class="flex gap-4 py-5"
        data-cart-item="{{ $productId }}"
        data-price="{{ $item['price'] }}"
        data-max="{{ $item['max_qty'] }}">

        {{-- Image --}}
        <a href="{{ route('collection.product', $item['slug']) }}"
            onclick="closeCart()"
            class="flex-shrink-0 w-20 h-20 bg-surface-container-low overflow-hidden block">
            @if($item['image'])
            <img src="{{ $item['image'] }}"
                class="w-full h-full object-cover"
                alt="{{ $item['name'] }}" />
            @else
            <div class="w-full h-full flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl text-outline-variant">image</span>
            </div>
            @endif
        </a>

        {{-- Infos --}}
        <div class="flex-1 min-w-0">
            @if($item['vendor_name'])
            <p class="text-[9px] font-semibold text-on-surface-variant uppercase tracking-widest mb-0.5">
                {{ $item['vendor_name'] }}
            </p>
            @endif

            <a href="{{ route('collection.product', $item['slug']) }}" onclick="closeCart()">
                <h4 class="text-sm font-semibold text-primary leading-tight hover:text-secondary transition-colors truncate"
                    style="font-family:'Playfair Display',serif">
                    {{ $item['name'] }}
                </h4>
            </a>

            <p class="text-sm font-bold text-primary mt-1">
                {{ number_format($item['price'], 0, ',', '.') }} CFA
            </p>

            {{-- Contrôles quantité + supprimer --}}
            <div class="flex items-center justify-between mt-3">

                {{-- +/- --}}
                <div class="flex items-center border border-outline-variant/50 h-8">
                    <button type="button"
                        class="drawer-btn-minus w-8 h-full flex items-center justify-center text-on-surface-variant hover:text-primary hover:bg-surface-container transition-all text-lg leading-none disabled:opacity-30 disabled:cursor-not-allowed"
                        {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                        −
                    </button>
                    <span class="drawer-qty w-8 h-full flex items-center justify-center text-sm font-semibold text-primary border-x border-outline-variant/50"
                        data-qty="{{ $item['quantity'] }}">
                        {{ $item['quantity'] }}
                    </span>
                    <button type="button"
                        class="drawer-btn-plus w-8 h-full flex items-center justify-center text-on-surface-variant hover:text-primary hover:bg-surface-container transition-all text-lg leading-none disabled:opacity-30 disabled:cursor-not-allowed"
                        {{ $item['quantity'] >= $item['max_qty'] ? 'disabled' : '' }}>
                        +
                    </button>
                </div>

                {{-- Sous-total + supprimer --}}
                <div class="flex items-center gap-3">
                    <span class="drawer-item-subtotal text-sm font-bold text-primary">
                        {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} CFA
                    </span>
                    <button type="button"
                        class="drawer-btn-remove text-on-surface-variant/50 hover:text-error transition-colors p-1"
                        title="Retirer">
                        <span class="material-symbols-outlined text-[16px]">delete_outline</span>
                    </button>
                </div>

            </div>
        </div>
    </div>
    @endforeach
</div>
@endif
