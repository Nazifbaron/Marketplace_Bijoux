<x-collection>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 mb-section-gap">

        {{-- ── GALERIE IMAGES ── --}}
        <div class="space-y-4">
            <div class="aspect-square bg-surface-container-low overflow-hidden relative">
                @if($product->images->isNotEmpty())
                    <img id="main-product-image" src="{{ $product->images->first()->url }}" class="w-full h-full object-cover" alt="{{ $product->name }}" />
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-6xl text-outline-variant">image</span>
                    </div>
                @endif

                @if($product->is_verified)
                    <div class="absolute top-4 left-4 bg-black/85 backdrop-blur-sm px-3 py-1.5 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[16px] text-secondary-fixed" style="font-variation-settings:'FILL' 1;">verified</span>
                        <span class="text-[10px] font-bold uppercase tracking-widest text-secondary-fixed">Produit Vérifié</span>
                    </div>
                @endif
            </div>

            @if($product->images->count() > 1)
                <div class="grid grid-cols-5 gap-3">
                    @foreach($product->images as $img)
                        <button onclick="document.getElementById('main-product-image').src = '{{ $img->url }}'"
                            class="aspect-square bg-surface-container-low overflow-hidden border-2 border-transparent hover:border-secondary transition-all">
                            <img src="{{ $img->url }}" class="w-full h-full object-cover" />
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- ── INFOS PRODUIT ── --}}
        <div class="flex flex-col">
            <p class="font-label-caps text-label-caps text-secondary mb-3">{{ strtoupper($product->category->name ?? '') }}</p>
            <h1 class="font-display-lg-mobile md:font-display-lg text-display-lg-mobile md:text-display-lg mb-4" style="font-size: 40px; line-height: 48px;">
                {{ $product->name }}
            </h1>

            @if($product->is_verified)
                <div class="inline-flex items-center gap-2 mb-4 px-3 py-1.5 bg-secondary-container/30 self-start">
                    <span class="material-symbols-outlined text-secondary text-[16px]" style="font-variation-settings:'FILL' 1;">verified</span>
                    <span class="text-[11px] font-semibold uppercase tracking-widest text-secondary">Authenticité vérifiée par notre comité</span>
                </div>
            @endif

            <p class="font-price-display text-price-display text-primary mb-8" style="font-size: 28px;">{{ $product->formatted_price }}</p>

            <div class="h-px w-full bg-outline-variant/30 mb-8"></div>

            <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed mb-8">{{ $product->description }}</p>

            {{-- ── VENDEUR ── --}}
            <div class="flex items-center gap-4 p-5 bg-surface-container-low mb-8">
                <div class="w-12 h-12 bg-primary flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-sm font-bold uppercase">{{ strtoupper(substr($product->vendor->shop_name ?? '', 0, 2)) }}</span>
                </div>
                <div class="flex-1">
                    <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Artisan</p>
                    <p class="font-semibold text-primary">{{ $product->vendor->shop_name }}</p>
                </div>
                @auth
                    @if(auth()->id() !== $product->vendor->user_id)
                        <form action="{{ route('chat.start', $product->vendor) }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="flex items-center gap-2 px-5 py-2.5 border border-primary text-primary text-xs font-semibold uppercase tracking-widest hover:bg-primary hover:text-white transition-all">
                                <span class="material-symbols-outlined text-[16px]">chat_bubble</span>
                                Contacter
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="flex items-center gap-2 px-5 py-2.5 border border-primary text-primary text-xs font-semibold uppercase tracking-widest hover:bg-primary hover:text-white transition-all">
                        <span class="material-symbols-outlined text-[16px]">chat_bubble</span>
                        Contacter
                    </a>
                @endauth
            </div>

            <div class="flex gap-4">
                <button class="flex-1 bg-primary text-white py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-on-surface-variant transition-all">
                    Ajouter au Panier
                </button>
            </div>

            <p class="text-[11px] text-on-surface-variant/60 mt-4">
                {{ $product->stock_quantity }} pièce(s) disponible(s) — Expédié depuis le Bénin
            </p>
        </div>
    </div>

    {{-- ── PRODUITS SIMILAIRES ── --}}
    @if($relatedProducts->isNotEmpty())
        <section class="pt-section-gap border-t border-outline-variant/20">
            <h2 class="font-headline-lg text-headline-lg mb-12">Vous pourriez aussi aimer</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-gutter gap-y-12">
                @foreach($relatedProducts as $related)
                    @include('collection.partials.product-card', ['product' => $related])
                @endforeach
            </div>
        </section>
    @endif
</x-collection>
