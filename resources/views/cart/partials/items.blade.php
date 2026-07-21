{{-- resources/views/cart/partials/items.blade.php --}}
{{-- Utilisé par le drawer ET par refreshDrawerItems() (fetch AJAX) --}}
<div class="divide-y divide-outline-variant/20 p-4">
    @foreach($items as $productId => $item)
        <div class="flex gap-4 py-5 transition-opacity duration-200"
             data-cart-item="{{ $productId }}">

            {{-- Image produit --}}
            <a href="{{ route('collection.product', $item['slug']) }}" onclick="closeCart()"
               class="flex-shrink-0 w-20 h-20 bg-surface-container-low overflow-hidden block">
                @if($item['image'])
                    <img src="{{ $item['image'] }}" class="w-full h-full object-cover" alt="{{ $item['name'] }}" />
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

                {{-- Contrôles quantité --}}
                <div class="flex items-center justify-between mt-3">
                    <div class="flex items-center border border-outline-variant/50 h-8">
                        <button onclick="updateCartQty({{ $productId }}, {{ $item['quantity'] - 1 }})"
                            class="w-8 h-full flex items-center justify-center text-on-surface-variant hover:text-primary hover:bg-surface-container transition-all text-lg leading-none"
                            {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                            −
                        </button>
                        <span class="w-8 h-full flex items-center justify-center text-sm font-semibold text-primary border-x border-outline-variant/50" id="qty-{{ $productId }}">
                            {{ $item['quantity'] }}
                        </span>
                        <button onclick="updateCartQty({{ $productId }}, {{ $item['quantity'] + 1 }})"
                            class="w-8 h-full flex items-center justify-center text-on-surface-variant hover:text-primary hover:bg-surface-container transition-all text-lg leading-none"
                            {{ $item['quantity'] >= $item['max_qty'] ? 'disabled' : '' }}>
                            +
                        </button>
                    </div>

                    {{-- Sous-total + bouton supprimer --}}
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-bold text-primary" data-item-subtotal="{{ $productId }}">
                            {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} CFA
                        </span>
                        <button onclick="removeFromCart({{ $productId }})"
                            class="text-on-surface-variant/50 hover:text-error transition-colors p-1"
                            title="Retirer du panier">
                            <span class="material-symbols-outlined text-[16px]">delete_outline</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
