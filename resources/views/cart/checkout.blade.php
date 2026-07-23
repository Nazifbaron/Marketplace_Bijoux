{{-- resources/views/cart/checkout.blade.php --}}
<x-layout title="Commander | L'Éclat du Bénin">

    <div class="min-h-screen bg-background pt-28 pb-section-gap">
        <div class="max-w-[1440px] mx-auto px-[20px] md:px-[80px]">

            {{-- En-tête --}}
            <div class="mb-12">
                <div class="flex items-center gap-3 text-xs text-on-surface-variant mb-3">
                    <a href="{{ route('cart.index') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">shopping_bag</span>
                        Panier
                    </a>
                    <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                    <span class="text-primary font-semibold">Commander</span>
                    <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                    <span class="text-on-surface-variant/50">Confirmation</span>
                </div>
                <h1 class="font-display-lg text-headline-lg md:text-display-lg-mobile text-primary"
                    style="font-family:'Playfair Display',serif">
                    Finaliser la Commande
                </h1>
            </div>

            @if($errors->any())
            <div class="mb-6 p-4 border-l-2 border-error bg-error-container/30">
                @foreach($errors->all() as $error)
                <p class="text-xs text-error">— {{ $error }}</p>
                @endforeach
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                {{-- ══ FORMULAIRE (2/3) ══ --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Informations personnelles --}}
                    <section class="bg-surface border border-outline-variant/30 p-8">
                        <h2 class="font-bold text-primary uppercase tracking-widest text-xs mb-6 pb-4 border-b border-outline-variant/20"
                            style="font-family:'Playfair Display',serif">
                            Informations de Contact
                        </h2>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">
                                    Nom complet <span class="text-error">*</span>
                                </label>
                                <input type="text"
                                    id="full_name"
                                    value="{{ old('full_name', $user->name) }}"
                                    placeholder="Votre nom et prénom"
                                    class="w-full border-0 border-b border-outline-variant py-3 px-0 bg-transparent focus:ring-0 focus:border-secondary transition-all text-base" />
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">
                                    Téléphone <span class="text-error">*</span>
                                </label>
                                <div class="flex gap-3">
                                    <div class="flex items-center border-b border-outline-variant py-3 text-on-surface-variant text-sm gap-2 flex-shrink-0">
                                        <span class="text-base">🇧🇯</span>
                                        <span>+229</span>
                                    </div>
                                    <input type="tel"
                                        id="phone"
                                        value="{{ old('phone') }}"
                                        placeholder="97 00 00 00"
                                        class="flex-1 border-0 border-b border-outline-variant py-3 px-0 bg-transparent focus:ring-0 focus:border-secondary transition-all text-base" />
                                </div>
                                <p class="text-[10px] text-on-surface-variant/60 mt-1">
                                    Numéro utilisé pour la confirmation et la livraison
                                </p>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">
                                    Email
                                </label>
                                <input type="email"
                                    id="email"
                                    value="{{ $user->email }}"
                                    disabled
                                    class="w-full border-0 border-b border-outline-variant/30 py-3 px-0 bg-transparent text-on-surface-variant/60 text-base cursor-not-allowed" />
                                <p class="text-[10px] text-on-surface-variant/60 mt-1">
                                    La confirmation sera envoyée à cette adresse
                                </p>
                            </div>
                        </div>
                    </section>

                    {{-- Mode de livraison --}}
                    <section class="bg-surface border border-outline-variant/30 p-8">
                        <h2 class="font-bold text-primary uppercase tracking-widest text-xs mb-6 pb-4 border-b border-outline-variant/20"
                            style="font-family:'Playfair Display',serif">
                            Mode de Livraison
                        </h2>

                        <div class="space-y-3">
                            <label class="flex items-start gap-4 p-4 border border-primary bg-primary/5 cursor-pointer">
                                <input type="radio" name="delivery_mode" value="contact" checked class="mt-1 accent-primary" />
                                <div>
                                    <p class="font-semibold text-primary text-sm">Livraison sur contact</p>
                                    <p class="text-xs text-on-surface-variant mt-0.5">
                                        Le vendeur vous contacte directement au numéro fourni pour organiser la livraison.
                                    </p>
                                </div>
                            </label>
                        </div>

                        <div class="mt-4 p-4 bg-surface-container-low border-l-2 border-secondary flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary flex-shrink-0 mt-0.5" style="font-variation-settings:'FILL' 1">info</span>
                            <p class="text-xs text-on-surface-variant leading-relaxed">
                                Chaque vendeur vous contactera séparément pour coordonner la livraison de ses articles.
                                Les frais de livraison seront convenus directement avec lui.
                            </p>
                        </div>
                    </section>

                    {{-- Note optionnelle --}}
                    <section class="bg-surface border border-outline-variant/30 p-8">
                        <h2 class="font-bold text-primary uppercase tracking-widest text-xs mb-4"
                            style="font-family:'Playfair Display',serif">
                            Note pour les Vendeurs <span class="font-normal text-on-surface-variant">(optionnel)</span>
                        </h2>
                        <textarea id="order_note"
                            rows="3"
                            placeholder="Instructions spéciales, demandes particulières..."
                            class="w-full border border-outline-variant/50 px-4 py-3 bg-transparent text-sm focus:ring-0 focus:border-secondary transition-all resize-none">{{ old('order_note') }}</textarea>
                    </section>

                </div>

                {{-- ══ RÉCAPITULATIF + PAIEMENT (1/3) ══ --}}
                <div class="lg:col-span-1">
                    <div class="bg-surface border border-outline-variant/30 p-7 sticky top-28">

                        <h3 class="font-bold text-primary uppercase tracking-widest text-xs mb-6 pb-4 border-b border-outline-variant/20"
                            style="font-family:'Playfair Display',serif">
                            Récapitulatif
                        </h3>

                        {{-- Liste produits --}}
                        <div class="space-y-4 mb-6">
                            @foreach($items as $productId => $item)
                            <div class="flex gap-3">
                                {{-- Miniature --}}
                                <div class="w-14 h-14 bg-surface-container-low flex-shrink-0 overflow-hidden">
                                    @if($item['image'])
                                    <img src="{{ $item['image'] }}" class="w-full h-full object-cover" alt="{{ $item['name'] }}" />
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold text-primary leading-tight truncate" style="font-family:'Playfair Display',serif">
                                        {{ $item['name'] }}
                                    </p>
                                    @if($item['vendor_name'])
                                    <p class="text-[10px] text-on-surface-variant">{{ $item['vendor_name'] }}</p>
                                    @endif
                                    <div class="flex justify-between mt-1">
                                        <span class="text-[10px] text-on-surface-variant">Qté : {{ $item['quantity'] }}</span>
                                        <span class="text-xs font-bold text-primary">{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} CFA</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- Totaux --}}
                        <div class="border-t border-outline-variant/20 pt-4 space-y-2 mb-6">
                            <div class="flex justify-between text-xs text-on-surface-variant">
                                <span>Sous-total ({{ $items->sum('quantity') }} article(s))</span>
                                <span>{{ number_format($total, 0, ',', '.') }} CFA</span>
                            </div>
                            <div class="flex justify-between text-xs text-on-surface-variant/60">
                                <span>Livraison</span>
                                <span>À définir avec le vendeur</span>
                            </div>
                            <div class="flex justify-between items-center pt-3 border-t border-outline-variant/20">
                                <span class="font-bold text-primary text-sm uppercase tracking-widest">Total</span>
                                <span class="font-bold text-primary text-xl">{{ number_format($total, 0, ',', '.') }} CFA</span>
                            </div>
                        </div>

                        {{-- ══ BOUTON FEDAPAY ══ --}}
                        <button type="button"
                            id="pay-btn"
                            onclick="initFedaPay()"
                            class="w-full bg-primary text-white py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-primary/90 transition-all flex items-center justify-center gap-3 mb-4">
                            <span class="material-symbols-outlined text-[18px]">lock</span>
                            <span id="pay-btn-text">Payer — {{ number_format($total, 0, ',', '.') }} CFA</span>
                            <span id="pay-btn-loader" class="hidden material-symbols-outlined text-[16px]" style="animation:spin 1s linear infinite">progress_activity</span>
                        </button>

                        {{-- Sécurité --}}
                        <div class="flex items-center justify-center gap-2 mb-5">
                            <span class="material-symbols-outlined text-[14px] text-on-tertiary-container" style="font-variation-settings:'FILL' 1">lock</span>
                            <p class="text-[10px] text-on-surface-variant/70">Paiement sécurisé via FedaPay</p>
                        </div>

                        {{-- Moyens de paiement acceptés --}}
                        <div class="border-t border-outline-variant/20 pt-4">
                            <p class="text-[9px] text-on-surface-variant/60 uppercase tracking-widest mb-3 text-center">Moyens de paiement acceptés</p>
                            <div class="flex justify-center gap-3 flex-wrap">
                                @foreach(['MTN Mobile Money', 'Moov Money', 'Carte bancaire'] as $pm)
                                <span class="text-[9px] font-semibold bg-surface-container px-2 py-1 text-on-surface-variant uppercase tracking-wider">{{ $pm }}</span>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    {{--
    ════════════════════════════════════════════════════════════════
    FEDAPAY INTEGRATION
    ════════════════════════════════════════════════════════════════
    FedaPay fonctionne avec un widget JS qui ouvre une popup de
    paiement. L'utilisateur choisit son moyen de paiement
    (Mobile Money, carte...) sans quitter ta page.

    Quand le paiement est validé, FedaPay :
    1. Appelle le callback JS onComplete → on soumet la commande
    2. Envoie un webhook POST vers /webhook/fedapay → double vérif
    ════════════════════════════════════════════════════════════════
--}}
    <script src="https://cdn.fedapay.com/checkout.js?v=1.1.7"></script>

    <script>
        const TOTAL_AMOUNT = {
            {
                (int) $total
            }
        };
        const USER_EMAIL = @json($user -> email);
        const USER_NAME = @json($user -> name);
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;
        const CONFIRM_URL = @json(route('cart.order.place'));
        const FEDAPAY_KEY = @json(config('services.fedapay.public_key'));

        function initFedaPay() {
            // Valider le formulaire avant d'ouvrir FedaPay
            const fullName = document.getElementById('full_name').value.trim();
            const phone = document.getElementById('phone').value.trim();

            if (!fullName) {
                alert('Veuillez saisir votre nom complet.');
                document.getElementById('full_name').focus();
                return;
            }
            if (!phone) {
                alert('Veuillez saisir votre numéro de téléphone.');
                document.getElementById('phone').focus();
                return;
            }

            // Afficher le loader
            document.getElementById('pay-btn').disabled = true;
            document.getElementById('pay-btn-text').textContent = 'Ouverture du paiement...';
            document.getElementById('pay-btn-loader').classList.remove('hidden');

            /**
             * FedaPayCheckout.init() ouvre la popup de paiement.
             *
             * Paramètres clés :
             *   public_key : ta clé publique FedaPay (sandbox ou production)
             *   transaction.amount : montant en FCFA
             *   customer : pré-rempli avec les infos de l'utilisateur
             *   onComplete : appelé quand le paiement est terminé (succès ou échec)
             */
            FedaPayCheckout.init({
                public_key: FEDAPAY_KEY,
                transaction: {
                    amount: TOTAL_AMOUNT,
                    description: "Commande L'Éclat du Bénin",
                },
                customer: {
                    email: USER_EMAIL,
                    lastname: fullName.split(' ').slice(1).join(' ') || fullName,
                    firstname: fullName.split(' ')[0],
                    phone_number: {
                        number: phone,
                        country: 'BJ',
                    }
                },
                currency: {
                    iso: 'XOF'
                },

                onComplete: function(resp) {
                    if (resp.reason === FedaPayCheckout.TRANSACTION_APPROVED) {
                        // ── Paiement validé → soumettre la commande en DB ──
                        submitOrder(fullName, phone, resp.transaction.id);
                    } else {
                        // Paiement annulé ou échoué
                        resetPayBtn();
                        if (resp.reason === FedaPayCheckout.DIALOG_DISMISSED) {
                            // L'utilisateur a fermé la popup sans payer
                            showNotice('Paiement annulé. Vous pouvez réessayer quand vous voulez.', 'info');
                        } else {
                            showNotice('Le paiement a échoué. Veuillez réessayer ou choisir un autre moyen.', 'error');
                        }
                    }
                },

                onClose: function() {
                    resetPayBtn();
                }
            }).open();
        }

        async function submitOrder(fullName, phone, transactionId) {
            document.getElementById('pay-btn-text').textContent = 'Enregistrement de la commande...';

            try {
                const res = await fetch(CONFIRM_URL, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        full_name: fullName,
                        phone: phone,
                        order_note: document.getElementById('order_note')?.value ?? '',
                        transaction_id: transactionId,
                    }),
                });

                const data = await res.json();

                if (data.success && data.redirect) {
                    // Rediriger vers la page de confirmation
                    window.location.href = data.redirect;
                } else {
                    showNotice(data.message || 'Erreur lors de l\'enregistrement. Contactez le support.', 'error');
                    resetPayBtn();
                }
            } catch (err) {
                console.error(err);
                showNotice('Erreur réseau. Votre paiement a été effectué — contactez-nous avec la référence : ' + transactionId, 'error');
                resetPayBtn();
            }
        }

        function resetPayBtn() {
            const btn = document.getElementById('pay-btn');
            btn.disabled = false;
            document.getElementById('pay-btn-text').textContent = 'Payer — ' + TOTAL_AMOUNT.toLocaleString('fr-FR') + ' CFA';
            document.getElementById('pay-btn-loader').classList.add('hidden');
        }

        function showNotice(message, type) {
            const colors = {
                info: '#012F24',
                error: '#ba1a1a'
            };
            const existing = document.getElementById('checkout-notice');
            if (existing) existing.remove();

            const div = document.createElement('div');
            div.id = 'checkout-notice';
            div.style.cssText = `
        position:fixed; bottom:24px; left:50%; transform:translateX(-50%);
        background:${colors[type]}; color:#fff; padding:12px 24px;
        z-index:9999; font-size:12px; font-weight:600; letter-spacing:0.1em;
        text-transform:uppercase; max-width:90vw; text-align:center;
        box-shadow:0 8px 32px rgba(0,0,0,0.2);
    `;
            div.textContent = message;
            document.body.appendChild(div);
            setTimeout(() => div.remove(), 6000);
        }
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

</x-layout>
