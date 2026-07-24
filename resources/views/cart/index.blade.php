{{-- resources/views/cart/index.blade.php --}}
<x-layout title="Mon Panier | L'Éclat du Bénin">
<div class="min-h-screen bg-background pt-28 pb-section-gap">
<div class="max-w-[1440px] mx-auto px-[20px] md:px-[80px]">

    <div class="mb-12">
        <p class="font-label-caps text-label-caps text-secondary editorial-spacing mb-2 block">VOTRE SÉLECTION</p>
        <h1 class="font-display-lg text-headline-lg md:text-display-lg-mobile text-primary" style="font-family:'Playfair Display',serif">
            Mon Panier
        </h1>
        @if(!$items->isEmpty())
            <p class="font-body-md text-on-surface-variant mt-2" id="items-count">
                {{ $items->sum('quantity') }} article(s) sélectionné(s)
            </p>
        @endif
    </div>

    @if($items->isEmpty())
        <div class="flex flex-col items-center justify-center py-24 text-center">
            <div class="w-24 h-24 border border-dashed border-outline-variant flex items-center justify-center mb-8">
                <span class="material-symbols-outlined text-5xl text-outline-variant">shopping_bag</span>
            </div>
            <h2 class="font-headline-md text-headline-md text-primary mb-4" style="font-family:'Playfair Display',serif">
                Votre panier est vide
            </h2>
            <p class="font-body-md text-on-surface-variant max-w-md leading-relaxed mb-8">
                Vous n'avez encore rien sélectionné. Explorez nos collections pour découvrir des pièces d'exception.
            </p>
            <a href="{{ route('collection.index') }}"
               class="inline-flex items-center gap-2 bg-primary text-white px-10 py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-primary/90 transition-all">
                <span class="material-symbols-outlined text-[16px]">grid_view</span>
                Explorer la Collection
            </a>
        </div>

    @else
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 flex items-center gap-3">
                <span class="material-symbols-outlined text-green-600" style="font-variation-settings:'FILL' 1">check_circle</span>
                <p class="text-sm text-green-800">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- ── COLONNE ITEMS (2/3) ── --}}
            <div class="lg:col-span-2">

                <div class="hidden md:grid grid-cols-12 gap-4 pb-3 border-b border-outline-variant/30 mb-1">
                    <div class="col-span-6 font-label-caps text-[9px] text-on-surface-variant uppercase tracking-widest">Article</div>
                    <div class="col-span-3 font-label-caps text-[9px] text-on-surface-variant uppercase tracking-widest text-center">Quantité</div>
                    <div class="col-span-2 font-label-caps text-[9px] text-on-surface-variant uppercase tracking-widest text-right">Total</div>
                    <div class="col-span-1"></div>
                </div>

                <div class="divide-y divide-outline-variant/20" id="cart-lines">
                    @foreach($items as $productId => $item)
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 py-7 items-center transition-opacity duration-200"
                             data-cart-item="{{ $productId }}"
                             data-price="{{ $item['price'] }}"
                             data-max="{{ $item['max_qty'] }}">

                            {{-- Image + infos --}}
                            <div class="md:col-span-6 flex gap-5">
                                <a href="{{ route('collection.product', $item['slug']) }}"
                                   class="flex-shrink-0 w-24 h-24 bg-surface-container-low overflow-hidden block group">
                                    @if($item['image'])
                                        <img src="{{ $item['image'] }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" alt="{{ $item['name'] }}" />
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="material-symbols-outlined text-3xl text-outline-variant">image</span>
                                        </div>
                                    @endif
                                </a>
                                <div class="flex flex-col justify-center">
                                    @if($item['vendor_name'])
                                        <p class="font-label-caps text-[9px] text-secondary tracking-widest mb-1">{{ strtoupper($item['vendor_name']) }}</p>
                                    @endif
                                    <a href="{{ route('collection.product', $item['slug']) }}">
                                        <h3 class="font-semibold text-primary text-base hover:text-secondary transition-colors leading-tight" style="font-family:'Playfair Display',serif">
                                            {{ $item['name'] }}
                                        </h3>
                                    </a>
                                    <p class="font-body-md text-on-surface-variant text-sm mt-1">
                                        {{ number_format($item['price'], 0, ',', '.') }} CFA / pièce
                                    </p>
                                </div>
                            </div>

                            {{-- Quantité — valeur lue depuis data-qty, pas hardcodée --}}
                            <div class="md:col-span-3 flex justify-start md:justify-center">
                                <div class="flex items-center border border-outline-variant/50 h-10">
                                    <button type="button"
                                        class="btn-minus w-10 h-full flex items-center justify-center text-on-surface-variant hover:text-primary hover:bg-surface-container transition-all text-xl leading-none disabled:opacity-30 disabled:cursor-not-allowed">
                                        −
                                    </button>
                                    <span class="qty-display w-10 h-full flex items-center justify-center text-sm font-semibold text-primary border-x border-outline-variant/50"
                                          data-qty="{{ $item['quantity'] }}">
                                        {{ $item['quantity'] }}
                                    </span>
                                    <button type="button"
                                        class="btn-plus w-10 h-full flex items-center justify-center text-on-surface-variant hover:text-primary hover:bg-surface-container transition-all text-xl leading-none disabled:opacity-30 disabled:cursor-not-allowed">
                                        +
                                    </button>
                                </div>
                            </div>

                            {{-- Sous-total --}}
                            <div class="md:col-span-2 text-left md:text-right">
                                <span class="item-subtotal font-bold text-primary">
                                    {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} CFA
                                </span>
                            </div>

                            {{-- Supprimer --}}
                            <div class="md:col-span-1 flex justify-start md:justify-end">
                                <button type="button" class="btn-remove text-on-surface-variant/40 hover:text-error transition-colors p-1" title="Retirer du panier">
                                    <span class="material-symbols-outlined text-[20px]">delete_outline</span>
                                </button>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-outline-variant/30 mt-4">
                    <a href="{{ route('collection.index') }}"
                       class="flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors font-label-caps text-[10px] uppercase tracking-widest">
                        <span class="material-symbols-outlined text-[16px]">arrow_back</span>
                        Continuer mes achats
                    </a>
                    <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Vider tout le panier ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-on-surface-variant/50 hover:text-error transition-colors font-label-caps text-[9px] uppercase tracking-widest flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">delete_sweep</span>
                            Vider le panier
                        </button>
                    </form>
                </div>
            </div>

            {{-- ── RÉCAPITULATIF (1/3) ── --}}
            <div class="lg:col-span-1">
                <div class="bg-surface border border-outline-variant/30 p-7 sticky top-28" id="recap-box">
                    <h3 class="font-bold text-primary uppercase tracking-widest text-xs mb-6 pb-4 border-b border-outline-variant/20" style="font-family:'Playfair Display',serif">
                        Récapitulatif
                    </h3>

                    {{-- Liste recap — mise à jour dynamiquement --}}
                    <div class="space-y-3 mb-6" id="recap-lines">
                        @foreach($items as $productId => $item)
                            <div class="flex justify-between items-start" data-recap-item="{{ $productId }}">
                                <span class="text-xs text-on-surface-variant leading-tight max-w-[160px] recap-name">
                                    {{ $item['name'] }}
                                    <span class="recap-qty text-on-surface-variant/60">{{ $item['quantity'] > 1 ? '× ' . $item['quantity'] : '' }}</span>
                                </span>
                                <span class="text-xs font-semibold text-primary flex-shrink-0 ml-3 recap-subtotal">
                                    {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} CFA
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-outline-variant/20 pt-4 space-y-2 mb-6">
                        <div class="flex justify-between text-xs text-on-surface-variant">
                            <span>Sous-total</span>
                            <span id="page-subtotal">{{ number_format($total, 0, ',', '.') }} CFA</span>
                        </div>
                        <div class="flex justify-between text-xs text-on-surface-variant/60">
                            <span>Livraison</span>
                            <span>À calculer</span>
                        </div>
                        <div class="flex justify-between items-center pt-2 border-t border-outline-variant/20">
                            <span class="font-bold text-primary text-sm uppercase tracking-widest">Total estimé</span>
                            <span class="font-bold text-primary text-lg" id="page-total">{{ number_format($total, 0, ',', '.') }} CFA</span>
                        </div>
                    </div>

                    @auth
                        <a href="{{ route('cart.checkout') }}"
                           class="flex items-center justify-center gap-2 w-full bg-primary text-white py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-primary/90 transition-all mb-3">
                            <span class="material-symbols-outlined text-[16px]">lock</span>
                            Passer la Commande
                        </a>
                    @else

                        <a href="{{ route('login') }}?redirect={{ urlencode(route('cart.checkout')) }}"
                           class="flex items-center justify-center gap-2 w-full bg-primary text-white py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-primary/90 transition-all mb-3">
                            <span class="material-symbols-outlined text-[16px]">login</span>
                            Se connecter pour commander
                        </a>
                        <p class="text-center text-[10px] text-on-surface-variant/60">
                            Ou <a href="{{ route('artisan.onboarding.step1') }}" class="text-secondary hover:underline">créez un compte</a>
                        </p>
                    @endauth

                    <div class="mt-6 pt-4 border-t border-outline-variant/20 space-y-2">
                        @foreach([['shield','Paiement 100% sécurisé'],['verified','Authenticité garantie'],['local_shipping','Livraison en Afrique & monde']] as $g)
                            <div class="flex items-center gap-2 text-[10px] text-on-surface-variant/70">
                                <span class="material-symbols-outlined text-[14px] text-secondary" style="font-variation-settings:'FILL' 1">{{ $g[0] }}</span>
                                {{ $g[1] }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    @endif

</div>
</div>

<script>
/**
 * PANIER — Gestion dynamique des quantités et du récapitulatif
 *
 * Principe :
 * - Chaque ligne a data-cart-item="{id}", data-price="{prix}", data-max="{stock}"
 * - La quantité actuelle est lue depuis data-qty sur .qty-display
 * - Les boutons +/- lisent et mettent à jour data-qty directement
 * - Le récapitulatif et le total se recalculent à chaque changement
 * - L'appel AJAX met à jour le serveur (session)
 */

const CSRF = document.querySelector('meta[name="csrf-token"]').content;

// ── Initialiser chaque ligne au chargement ──
document.querySelectorAll('[data-cart-item]').forEach(function(row) {
    initRow(row);
});

function initRow(row) {
    const productId = row.dataset.cartItem;
    const price     = parseFloat(row.dataset.price);
    const maxQty    = parseInt(row.dataset.max);
    const qtyEl     = row.querySelector('.qty-display');
    const btnMinus  = row.querySelector('.btn-minus');
    const btnPlus   = row.querySelector('.btn-plus');
    const btnRemove = row.querySelector('.btn-remove');

    // Mettre à jour l'état initial des boutons
    refreshButtons(qtyEl, btnMinus, btnPlus, maxQty);

    // ── Bouton − ──
    btnMinus.addEventListener('click', async function() {
        const current = parseInt(qtyEl.dataset.qty);
        if (current <= 1) return;
        await changeQty(productId, current - 1, price, maxQty, row, qtyEl, btnMinus, btnPlus);
    });

    // ── Bouton + ──
    btnPlus.addEventListener('click', async function() {
        const current = parseInt(qtyEl.dataset.qty);
        if (current >= maxQty) return;
        await changeQty(productId, current + 1, price, maxQty, row, qtyEl, btnMinus, btnPlus);
    });

    // ── Bouton Supprimer ──
    btnRemove.addEventListener('click', async function() {
        row.style.opacity = '0.4';
        row.style.pointerEvents = 'none';

        try {
            const res  = await fetch('/panier/retirer/' + productId, {
                method:  'DELETE',
                headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
            });
            const data = await res.json();

            if (data.success) {
                row.remove();
                // Supprimer la ligne du récap
                const recapLine = document.querySelector('[data-recap-item="' + productId + '"]');
                if (recapLine) recapLine.remove();
                // Mettre à jour le total global
                updateGlobalTotal();
                updateCartBadge(data.cart_count);
                // Si panier vide, recharger pour afficher l'état vide
                if (data.is_empty) location.reload();
            }
        } catch(e) {
            row.style.opacity = '1';
            row.style.pointerEvents = 'auto';
        }
    });
}

async function changeQty(productId, newQty, price, maxQty, row, qtyEl, btnMinus, btnPlus) {
    // Désactiver les boutons pendant la requête
    btnMinus.disabled = true;
    btnPlus.disabled  = true;

    try {
        const res  = await fetch('/panier/modifier/' + productId, {
            method:  'PATCH',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json', 'Content-Type': 'application/json' },
            body:    JSON.stringify({ quantity: newQty })
        });
        const data = await res.json();

        if (data.success) {
            // 1. Mettre à jour data-qty et l'affichage
            qtyEl.dataset.qty  = newQty;
            qtyEl.textContent  = newQty;

            // 2. Mettre à jour le sous-total de la ligne
            const subtotalEl = row.querySelector('.item-subtotal');
            const subtotal   = price * newQty;
            subtotalEl.textContent = formatPrice(subtotal) + ' CFA';

            // 3. Mettre à jour le récap
            const recapLine = document.querySelector('[data-recap-item="' + productId + '"]');
            if (recapLine) {
                recapLine.querySelector('.recap-qty').textContent = newQty > 1 ? '× ' + newQty : '';
                recapLine.querySelector('.recap-subtotal').textContent = formatPrice(subtotal) + ' CFA';
            }

            // 4. Recalculer le total global depuis le DOM
            updateGlobalTotal();

            // 5. Mettre à jour le badge navbar
            updateCartBadge(data.cart_count);

            // 6. Réactiver les boutons avec les bons états
            refreshButtons(qtyEl, btnMinus, btnPlus, maxQty);
        }
    } catch(e) {
        console.error('Erreur modification quantité:', e);
    } finally {
        // Toujours réactiver même en cas d'erreur
        refreshButtons(qtyEl, btnMinus, btnPlus, maxQty);
    }
}

function refreshButtons(qtyEl, btnMinus, btnPlus, maxQty) {
    const qty = parseInt(qtyEl.dataset.qty);
    btnMinus.disabled = qty <= 1;
    btnPlus.disabled  = qty >= maxQty;
}

function updateGlobalTotal() {
    // Recalcule le total depuis tous les sous-totaux présents dans le DOM
    let total = 0;
    document.querySelectorAll('[data-cart-item]').forEach(function(row) {
        const price = parseFloat(row.dataset.price);
        const qty   = parseInt(row.querySelector('.qty-display').dataset.qty);
        total += price * qty;
    });

    const formatted = formatPrice(total) + ' CFA';
    const totalEl    = document.getElementById('page-total');
    const subtotalEl = document.getElementById('page-subtotal');
    if (totalEl)    totalEl.textContent    = formatted;
    if (subtotalEl) subtotalEl.textContent = formatted;
}

function updateCartBadge(count) {
    const badge = document.getElementById('cart-badge');
    if (!badge) return;
    badge.textContent = count;
    count > 0 ? badge.classList.remove('hidden') : badge.classList.add('hidden');
}

function formatPrice(value) {
    // Format français : séparateur de milliers = point
    return Math.round(value).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
</script>

</x-layout>

