{{--
    COMPOSANT : DRAWER PANIER
    =====================================================================
    À inclure UNE SEULE FOIS dans x-layout.blade.php, juste avant </body>.

    Le drawer s'ouvre quand on clique sur l'icône panier dans la navbar.
    Il se met à jour sans rechargement via fetch() après chaque ajout/
    suppression/modification de quantité.

    Usage dans x-layout.blade.php :
      <x-cart-drawer />
    =====================================================================
--}}
@php
use App\Services\CartService;
$cart = app(CartService::class);
$items = $cart->all();
$total = $cart->formattedTotal();
$count = $cart->count();
@endphp

{{-- ── OVERLAY ── --}}
<div id="cart-overlay"
    class="fixed inset-0 bg-black/50 z-[80] hidden opacity-0 transition-opacity duration-300"
    onclick="closeCart()"></div>

{{-- ── DRAWER ── --}}
<aside id="cart-drawer"
    class="fixed top-0 right-0 h-full w-full sm:w-[420px] bg-surface z-[90] translate-x-full transition-transform duration-300 ease-in-out flex flex-col shadow-2xl"
    aria-label="Panier">

    {{-- En-tête --}}
    <div class="flex items-center justify-between px-7 py-6 border-b border-outline-variant/30 flex-shrink-0">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-primary">shopping_bag</span>
            <h2 class="font-bold text-primary uppercase tracking-widest text-sm" style="font-family:'Playfair Display',serif">
                Mon Panier
            </h2>
            <span id="drawer-count"
                class="bg-primary text-white text-[10px] font-bold w-5 h-5 rounded-full flex items-center justify-center {{ $count === 0 ? 'hidden' : '' }}">
                {{ $count }}
            </span>
        </div>
        <button onclick="closeCart()" class="text-on-surface-variant hover:text-primary transition-colors p-1">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>

    {{-- Corps — liste des items --}}
    <div class="flex-1 overflow-y-auto" id="cart-items-container">
        @if($items->isEmpty())
        @include('cart.partials.empty')
        @else
        @include('cart.partials.items', ['items' => $items])
        @endif
    </div>

    {{-- Pied — total + actions --}}
    <div id="cart-footer" class="{{ $items->isEmpty() ? 'hidden' : '' }} flex-shrink-0 border-t border-outline-variant/30">

        {{-- Résumé prix --}}
        <div class="px-7 py-5 space-y-2">
            <div class="flex justify-between items-center text-xs text-on-surface-variant font-semibold uppercase tracking-widest">
                <span>Sous-total</span>
                <span id="drawer-subtotal">{{ $total }}</span>
            </div>
            <div class="flex justify-between items-center text-xs text-on-surface-variant/60 uppercase tracking-widest">
                <span>Livraison</span>
                <span>Calculée à l'étape suivante</span>
            </div>
            <div class="flex justify-between items-center pt-2 border-t border-outline-variant/20">
                <span class="font-bold text-primary text-sm uppercase tracking-widest">Total</span>
                <span class="font-bold text-primary text-lg" id="drawer-total">{{ $total }}</span>
            </div>
        </div>

        {{-- CTAs --}}
        <div class="px-7 pb-7 space-y-3">
            @auth
            <a href="{{ route('cart.checkout') }}"
                class="flex items-center justify-center gap-2 w-full bg-primary text-white py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-primary/90 transition-all">
                <span class="material-symbols-outlined text-[16px]">lock</span>
                Commander — {{ $total }}
            </a>
            @else
            <a href="{{ route('login') }}?redirect={{ urlencode(route('cart.checkout')) }}"
                class="flex items-center justify-center gap-2 w-full bg-primary text-white py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-primary/90 transition-all">
                <span class="material-symbols-outlined text-[16px]">login</span>
                Se connecter pour commander
            </a>
            @endauth

            <a href="{{ route('cart.index') }}"
                class="flex items-center justify-center w-full border border-outline-variant text-on-surface-variant py-4 font-label-caps text-label-caps uppercase tracking-widest hover:border-primary hover:text-primary transition-all"
                onclick="closeCart()">
                Voir le panier complet
            </a>
        </div>
    </div>

</aside>

{{-- ── SCRIPT GLOBAL DU PANIER ── --}}
<script>
    /**
     * MODULE PANIER — JavaScript global
     * =====================================
     * Toutes les fonctions panier sont définies ici une seule fois
     * et accessibles depuis n'importe quelle page.
     *
     * Fonctions publiques :
     *   openCart()                    → ouvrir le drawer
     *   closeCart()                   → fermer le drawer
     *   addToCart(productId, qty)     → ajouter un produit
     *   removeFromCart(productId)     → supprimer du panier
     *   updateCartQty(productId, qty) → changer la quantité
     */

    const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '';

    // Vérifier que le CSRF est bien récupéré
    if (!CSRF) {
        console.error('⚠️ Token CSRF non trouvé. Vérifiez que le meta tag csrf-token existe dans le <head>');
    }

    // ── DRAWER OPEN/CLOSE ──
    function openCart() {
        document.getElementById('cart-drawer').classList.remove('translate-x-full');
        const overlay = document.getElementById('cart-overlay');
        overlay.classList.remove('hidden');
        setTimeout(() => overlay.classList.add('opacity-100'), 10);
        document.body.style.overflow = 'hidden';
    }

    function closeCart() {
        document.getElementById('cart-drawer').classList.add('translate-x-full');
        const overlay = document.getElementById('cart-overlay');
        overlay.classList.remove('opacity-100');
        setTimeout(() => {
            overlay.classList.add('hidden');
        }, 300);
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeCart();
    });

    // ── AJOUTER AU PANIER ──
    async function addToCart(productId, quantity = 1, btn = null) {
        if (btn) {
            btn.disabled = true;
            const originalHTML = btn.innerHTML;
            btn.innerHTML = `<span class="material-symbols-outlined text-[18px]" style="animation:spin 0.8s linear infinite">progress_activity</span>`;

            try {
                const res = await fetch(`/panier/ajouter/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        quantity
                    }),
                });
                const data = await res.json();

                if (data.success) {
                    // Feedback visuel sur le bouton
                    btn.innerHTML = `<span class="material-symbols-outlined text-[18px]" style="font-variation-settings:'FILL' 1;color:#5e8e77">check_circle</span><span>Ajouté</span>`;
                    setTimeout(() => {
                        btn.innerHTML = originalHTML;
                        btn.disabled = false;
                    }, 2000);

                    // Mettre à jour le badge et le drawer
                    updateCartUI(data.cart_count, data.cart_total);
                    refreshDrawerItems();
                    openCart();
                    showCartToast(data.message, 'success');
                } else {
                    btn.innerHTML = originalHTML;
                    btn.disabled = false;
                    showCartToast(data.message || 'Erreur lors de l\'ajout au panier', 'error');
                }
            } catch (err) {
                console.error('Erreur addToCart:', err);
                btn.innerHTML = originalHTML;
                btn.disabled = false;
                showCartToast('Erreur réseau. Vérifiez votre connexion.', 'error');
            }
        }
    }

    // ── SUPPRIMER UN ITEM ──
    async function removeFromCart(productId) {
        const row = document.querySelector(`[data-cart-item="${productId}"]`);
        if (row) {
            row.style.opacity = '0.4';
            row.style.pointerEvents = 'none';
        }

        try {
            const res = await fetch(`/panier/retirer/${productId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': CSRF,
                    'Accept': 'application/json'
                },
            });

            if (!res.ok) {
                throw new Error(`HTTP ${res.status}: ${res.statusText}`);
            }

            const data = await res.json();

            if (data.success) {
                updateCartUI(data.cart_count, data.cart_total);
                refreshDrawerItems();
                if (data.is_empty) showEmptyState();
                showCartToast(data.message || 'Produit supprimé', 'success');
                // Si on est sur la page panier, recharger la ligne
                if (window.location.pathname === '/panier') {
                    if (row) row.remove();
                    if (data.is_empty) location.reload();
                }
            } else {
                if (row) {
                    row.style.opacity = '1';
                    row.style.pointerEvents = 'auto';
                }
                showCartToast(data.message || 'Erreur lors de la suppression', 'error');
            }
        } catch (err) {
            console.error('Erreur removeFromCart:', err);
            if (row) {
                row.style.opacity = '1';
                row.style.pointerEvents = 'auto';
            }
            showCartToast('Erreur lors de la suppression du produit', 'error');
        }
    }

    // ── MODIFIER LA QUANTITÉ ──
    async function updateCartQty(productId, quantity) {
        // Vérifier que la quantité est valide
        if (quantity < 1) {
            removeFromCart(productId);
            return;
        }

        try {
            const res = await fetch(`/panier/modifier/${productId}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': CSRF,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    quantity
                }),
            });

            if (!res.ok) {
                throw new Error(`HTTP ${res.status}: ${res.statusText}`);
            }

            const data = await res.json();

            if (data.success) {
                updateCartUI(data.cart_count, data.cart_total);

                // Mettre à jour le sous-total de la ligne
                const subtotalEl = document.querySelector(`[data-item-subtotal="${productId}"]`);
                if (subtotalEl) subtotalEl.textContent = data.item_subtotal;

                // Mettre à jour la quantité affichée
                const qtyEl = document.getElementById(`qty-${productId}`);
                if (qtyEl) qtyEl.textContent = quantity;

                // Mettre à jour l'affichage du total sur la page panier
                const pageTotalEl = document.getElementById('page-total');
                if (pageTotalEl) pageTotalEl.textContent = data.cart_total;

                // Mettre à jour le total et sous-total du drawer
                document.getElementById('drawer-total').textContent = data.cart_total;
                document.getElementById('drawer-subtotal').textContent = data.cart_total;

                // Rafraîchir les items du drawer via AJAX
                refreshDrawerItems();

                showCartToast(data.message || 'Quantité mise à jour', 'success');
            } else {
                showCartToast(data.message || 'Erreur lors de la mise à jour', 'error');
            }
        } catch (err) {
            console.error('Erreur updateCartQty:', err);
            showCartToast('Erreur lors de la mise à jour de la quantité', 'error');
        }
    }

    // ── HELPERS UI ──
    function updateCartUI(count, total) {
        // Badge navbar
        const badge = document.getElementById('cart-badge');
        if (badge) {
            badge.textContent = count;
            count > 0 ? badge.classList.remove('hidden') : badge.classList.add('hidden');
        }
        // Totaux drawer
        const drawerTotal = document.getElementById('drawer-total');
        const drawerSubtotal = document.getElementById('drawer-subtotal');
        const drawerCount = document.getElementById('drawer-count');
        if (drawerTotal) drawerTotal.textContent = total;
        if (drawerSubtotal) drawerSubtotal.textContent = total;
        if (drawerCount) {
            drawerCount.textContent = count;
            count > 0 ? drawerCount.classList.remove('hidden') : drawerCount.classList.add('hidden');
        }
    }

    async function refreshDrawerItems() {
        const container = document.getElementById('cart-items-container');
        const footer = document.getElementById('cart-footer');
        if (!container) return;

        const res = await fetch('/panier/drawer', {
            headers: {
                'Accept': 'text/html'
            }
        });
        const html = await res.text();
        container.innerHTML = html;

        // Mettre à jour le footer
        const cartCount = parseInt(document.getElementById('drawer-count')?.textContent || '0');
        if (footer) {
            cartCount > 0 ? footer.classList.remove('hidden') : footer.classList.add('hidden');
        }
    }

    function showEmptyState() {
        const container = document.getElementById('cart-items-container');
        const footer = document.getElementById('cart-footer');
        if (container) container.innerHTML = `
        <div class="flex flex-col items-center justify-center h-full px-8 text-center py-16">
            <div class="w-20 h-20 border border-dashed border-outline-variant flex items-center justify-center mb-6">
                <span class="material-symbols-outlined text-4xl text-outline-variant">shopping_bag</span>
            </div>
            <p class="font-bold text-primary text-sm uppercase tracking-widest mb-2">Votre panier est vide</p>
            <p class="text-xs text-on-surface-variant">Explorez nos collections pour y ajouter vos pièces de prestige.</p>
            <a href="/collection" onclick="closeCart()" class="mt-6 inline-block bg-primary text-white px-8 py-3 font-label-caps text-[10px] tracking-widest uppercase hover:bg-primary/90 transition-all">
                Découvrir la Collection
            </a>
        </div>`;
        if (footer) footer.classList.add('hidden');
    }

    // ── TOAST NOTIFICATION ──
    function showCartToast(message, type = 'success') {
        // Supprimer l'éventuel toast précédent
        document.getElementById('cart-toast')?.remove();

        const colors = {
            success: 'bg-[#012F24] text-white',
            error: 'bg-error text-white',
        };

        const toast = document.createElement('div');
        toast.id = 'cart-toast';
        toast.className = `fixed bottom-6 left-1/2 -translate-x-1/2 z-[100] px-6 py-3 ${colors[type]} shadow-2xl flex items-center gap-3 transition-all duration-300 opacity-0 translate-y-4`;
        toast.innerHTML = `
        <span class="material-symbols-outlined text-[18px]" style="font-variation-settings:'FILL' 1">
            ${type === 'success' ? 'check_circle' : 'error'}
        </span>
        <span class="font-label-caps text-[10px] tracking-widest">${message}</span>`;
        document.body.appendChild(toast);

        // Animation entrée
        setTimeout(() => {
            toast.classList.remove('opacity-0', 'translate-y-4');
        }, 50);
        // Disparaître après 3s
        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-y-4');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    window.openCart = openCart;
    window.closeCart = closeCart;
    window.addToCart = addToCart;
    window.removeFromCart = removeFromCart;
    window.updateCartQty = updateCartQty;
</script>

<style>
    @keyframes spin {
        from {
            transform: rotate(0deg)
        }

        to {
            transform: rotate(360deg)
        }
    }
</style>
