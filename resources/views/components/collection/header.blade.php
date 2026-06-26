{{--
    COMPOSANT : <x-collection.header :active="..." />
    =====================================================================
    Header fixe utilisé sur toutes les pages catégorie (bijoux, art,
    maroquinerie). Le paramètre `active` reçoit le slug de la catégorie
    courante pour surligner le bon lien de menu.

    Usage : <x-collection.header active="bijoux" />
            <x-collection.header /> (sans surlignage actif)
    =====================================================================
--}}
@props(['active' => null])

@php
    // On récupère les catégories depuis la DB pour construire le menu
    // dynamiquement (au lieu de liens en dur comme dans les fichiers originaux)
    $navCategories = \App\Models\Category::orderBy('display_order')->get();
@endphp

<header class="fixed top-0 w-full z-50 bg-surface/70 backdrop-blur-xl border-b border-outline-variant/30 h-20 flex justify-between items-center px-margin-mobile md:px-margin-desktop glass-nav">

    {{-- Bouton menu mobile / drawer --}}
    <div class="flex items-center gap-4 cursor-pointer transition-transform duration-200 active:scale-95" onclick="toggleDrawer()">
        <span class="material-symbols-outlined text-primary">menu</span>
    </div>

    {{-- Logo --}}
    <a href="{{ route('collection.index') }}" class="font-display-lg text-headline-md tracking-widest text-primary">
        L'ÉCLAT DU BÉNIN
    </a>

    {{-- Navigation desktop --}}
    <nav class="hidden lg:flex items-center gap-10">
        <a href="{{ route('collection.index') }}"
           class="font-label-caps text-label-caps luxury-line {{ !$active ? 'text-primary font-semibold' : 'text-on-surface-variant hover:text-primary transition-colors' }}">
            TOUTE LA COLLECTION
        </a>
        @foreach($navCategories as $cat)
            <a href="{{ route('collection.category', $cat) }}"
               class="font-label-caps text-label-caps luxury-line {{ $active === $cat->slug ? 'text-primary font-semibold' : 'text-on-surface-variant hover:text-primary transition-colors' }}">
                {{ strtoupper($cat->name) }}
            </a>
        @endforeach
    </nav>

    {{-- Actions à droite : recherche, compte, panier --}}
    <div class="flex items-center gap-6">
        <span class="material-symbols-outlined text-primary cursor-pointer transition-transform duration-200 active:scale-95 hidden md:inline">search</span>

        @auth
            @php
                $isVendor = \App\Models\ArtisanApplication::where('user_id', auth()->id())->where('status', 'approved')->exists();
            @endphp
            <a href="{{ $isVendor ? route('artisan.dashboard') : route('chat.index') }}" class="text-primary cursor-pointer transition-transform duration-200 active:scale-95">
                <span class="material-symbols-outlined">account_circle</span>
            </a>
        @else
            <a href="{{ route('login') }}" class="text-primary cursor-pointer transition-transform duration-200 active:scale-95">
                <span class="material-symbols-outlined">account_circle</span>
            </a>
        @endauth

        <div class="relative cursor-pointer transition-transform duration-200 active:scale-95">
            <span class="material-symbols-outlined text-primary">shopping_bag</span>
            {{-- Le compteur du panier sera branché quand le module panier sera implémenté --}}
        </div>
    </div>
</header>
