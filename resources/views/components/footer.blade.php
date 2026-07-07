{{--
    COMPOSANT : <x-footer />
    =====================================================================
    Pied de page commun à toutes les pages publiques du site
    (collection, bijoux, art, maroquinerie, fiche produit...).
    =====================================================================
--}}
<footer class="bg-primary border-t border-white/10 pt-section-gap pb-12">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">

            {{-- Colonne marque --}}
            <div class="md:col-span-2">
                <h2 class="font-display-lg text-headline-lg text-white mb-4">Luxe Maquette</h2>
                <p class="font-body-md text-white/60 max-w-sm leading-relaxed">
                    Une place de marché de prestige dédiée aux fournisseurs béninois.
                    Chaque pièce raconte une histoire transmise de génération en génération.
                </p>
                <div class="flex gap-4 mt-6">
                    <a href="#" class="w-10 h-10 border border-white/20 flex items-center justify-center text-white/70 hover:text-white hover:border-white/50 transition-all">
                        <span class="material-symbols-outlined text-[18px]">photo_camera</span>
                    </a>
                    <a href="#" class="w-10 h-10 border border-white/20 flex items-center justify-center text-white/70 hover:text-white hover:border-white/50 transition-all">
                        <span class="material-symbols-outlined text-[18px]">facebook</span>
                    </a>
                    <a href="#" class="w-10 h-10 border border-white/20 flex items-center justify-center text-white/70 hover:text-white hover:border-white/50 transition-all">
                        <span class="material-symbols-outlined text-[18px]">mail</span>
                    </a>
                </div>
            </div>

            {{-- Colonne navigation --}}
            <div>
                <p class="font-label-caps text-label-caps text-secondary-fixed mb-5">COLLECTIONS</p>
                <nav class="flex flex-col gap-3">
                    <a href="{{ route('collection.index') }}" class="font-body-md text-white/70 hover:text-white transition-colors">Toute la Collection</a>
                    @foreach(\App\Models\Category::orderBy('display_order')->get() as $cat)
                        <a href="{{ route('collection.category', $cat) }}" class="font-body-md text-white/70 hover:text-white transition-colors">{{ $cat->name }}</a>
                    @endforeach
                </nav>
            </div>

            {{-- Colonne entreprise --}}
            <div>
                <p class="font-label-caps text-label-caps text-secondary-fixed mb-5">L'ENTREPRISE</p>
                <nav class="flex flex-col gap-3">
                    <a href="#" class="font-body-md text-white/70 hover:text-white transition-colors">Notre Histoire</a>
                    <a href="{{ route('artisan.onboarding.step1') }}" class="font-body-md text-white/70 hover:text-white transition-colors">Devenir Artisan Partenaire</a>
                    <a href="#" class="font-body-md text-white/70 hover:text-white transition-colors">Conditions Vendeur</a>
                    <a href="#" class="font-body-md text-white/70 hover:text-white transition-colors">Confidentialité</a>
                </nav>
            </div>

        </div>

        <div class="h-px w-full bg-white/10 mb-8"></div>

        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="font-label-caps text-[10px] text-white uppercase tracking-widest">
                © {{ date('Y') }} Luxe Maquette. Heritage Excellence.
            </p>
            <p class="font-label-caps text-[10px] text-white uppercase tracking-widest">
                Conçu à Cotonou, Bénin
            </p>
        </div>

    </div>
</footer>
