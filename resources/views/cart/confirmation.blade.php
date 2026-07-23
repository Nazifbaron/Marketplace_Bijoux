{{-- resources/views/cart/confirmation.blade.php --}}
<x-layout title="Commande Confirmée | L'Éclat du Bénin">

    <div class="min-h-screen bg-background pt-28 pb-section-gap">
        <div class="max-w-3xl mx-auto px-[20px] md:px-[80px] text-center">

            {{-- Icône succès animée --}}
            <div class="w-24 h-24 bg-on-tertiary-container/10 rounded-full flex items-center justify-center mx-auto mb-8" style="animation:scaleIn 0.5s ease">
                <span class="material-symbols-outlined text-5xl text-on-tertiary-container" style="font-variation-settings:'FILL' 1">check_circle</span>
            </div>

            <p class="font-label-caps text-label-caps text-secondary tracking-widest mb-3">COMMANDE CONFIRMÉE</p>
            <h1 class="font-display-lg text-display-lg-mobile text-primary mb-4" style="font-family:'Playfair Display',serif">
                Merci pour votre commande
            </h1>
            <p class="font-body-lg text-on-surface-variant mb-2">
                Référence : <strong class="text-primary font-bold">{{ $order->order_number }}</strong>
            </p>
            <p class="font-body-md text-on-surface-variant/70 mb-12 max-w-lg mx-auto">
                Un email de confirmation a été envoyé à <strong>{{ auth()->user()->email }}</strong>.
                Le(s) vendeur(s) vous contacteront sous peu pour organiser la livraison.
            </p>

            {{-- Récapitulatif commande --}}
            <div class="bg-surface border border-outline-variant/30 p-8 text-left mb-8">
                <h2 class="font-bold text-primary uppercase tracking-widest text-xs mb-6 pb-4 border-b border-outline-variant/20"
                    style="font-family:'Playfair Display',serif">
                    Détail de la Commande
                </h2>

                <div class="space-y-5">
                    @foreach($order->items as $item)
                    <div class="flex items-center gap-4">
                        {{-- Image produit --}}
                        <div class="w-16 h-16 bg-surface-container-low flex-shrink-0 overflow-hidden">
                            @if($item->product?->primary_image)
                            <img src="{{ $item->product->primary_image }}"
                                class="w-full h-full object-cover"
                                alt="{{ $item->product_name_snapshot }}" />
                            @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-2xl text-outline-variant">image</span>
                            </div>
                            @endif
                        </div>

                        <div class="flex-1">
                            <p class="font-semibold text-primary text-sm" style="font-family:'Playfair Display',serif">
                                {{ $item->product_name_snapshot }}
                            </p>
                            <p class="text-xs text-on-surface-variant">Quantité : {{ $item->quantity }}</p>
                        </div>

                        <p class="font-bold text-primary text-sm flex-shrink-0">
                            {{ number_format($item->unit_price * $item->quantity, 0, ',', '.') }} CFA
                        </p>
                    </div>
                    @endforeach
                </div>

                <div class="border-t border-outline-variant/20 mt-6 pt-4 flex justify-between items-center">
                    <span class="font-bold text-primary uppercase tracking-widest text-sm">Total payé</span>
                    <span class="font-bold text-primary text-xl">{{ number_format($order->total_amount, 0, ',', '.') }} CFA</span>
                </div>
            </div>

            {{-- Prochaines étapes --}}
            <div class="bg-surface-container-low border border-outline-variant/20 p-7 text-left mb-10">
                <h3 class="font-bold text-primary uppercase tracking-widest text-xs mb-4">Prochaines Étapes</h3>
                <div class="space-y-3">
                    @foreach([
                    ['check', 'Commande enregistrée et paiement confirmé'],
                    ['mail', 'Email de confirmation envoyé à votre adresse'],
                    ['phone', 'Le(s) vendeur(s) vous contactent pour la livraison'],
                    ['local_shipping', 'Réception de votre commande'],
                    ] as $i => [$icon, $label])
                    <div class="flex items-center gap-3">
                        <div class="w-7 h-7 rounded-full flex items-center justify-center flex-shrink-0
                                {{ $i === 0 ? 'bg-on-tertiary-container text-white' : 'bg-surface-container text-on-surface-variant' }}">
                            <span class="material-symbols-outlined text-[14px]" style="{{ $i === 0 ? "font-variation-settings:'FILL' 1" : '' }}">{{ $icon }}</span>
                        </div>
                        <p class="text-sm {{ $i === 0 ? 'font-semibold text-primary' : 'text-on-surface-variant' }}">{{ $label }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('collection.index') }}"
                    class="inline-flex items-center justify-center gap-2 bg-primary text-white px-10 py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-primary/90 transition-all">
                    <span class="material-symbols-outlined text-[16px]">grid_view</span>
                    Continuer mes achats
                </a>
                @auth
                <a href="{{ route('chat.index') }}"
                    class="inline-flex items-center justify-center gap-2 border border-outline-variant text-on-surface-variant px-10 py-4 font-label-caps text-label-caps uppercase tracking-widest hover:border-primary hover:text-primary transition-all">
                    <span class="material-symbols-outlined text-[16px]">chat_bubble</span>
                    Contacter les Vendeurs
                </a>
                @endauth
            </div>

        </div>
    </div>

    <style>
        @keyframes scaleIn {
            from {
                transform: scale(0);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>

</x-layout>
