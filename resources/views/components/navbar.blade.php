{{--
    COMPOSANT : <x-navbar />
    Méga-menu dropdown pour les catégories
    - Navbar transparente sur hero, opaque au scroll
    - Bouton COLLECTIONS ouvre un panneau pleine largeur
    - Catégories organisées en colonnes (max 6 par colonne)
    - Logo + recherche + panier + compte
--}}

@php
    $navCategories = \App\Models\Category::orderBy('display_order')->get();
    $cartCount     = session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0;
    $currentPath   = request()->path();

    // Découper les catégories en colonnes de 6 max
    $columns = $navCategories->chunk(6);
@endphp

{{-- Overlay recherche --}}
<div id="search-overlay"
     class="fixed inset-0 bg-black/40 z-[45] hidden opacity-0 transition-opacity duration-300"
     onclick="closeSearch()"></div>

{{-- ══════════════════════════════════════════════════════════════
     NAVBAR
     ══════════════════════════════════════════════════════════════ --}}
<nav class="fixed top-0 w-full z-50 transition-all duration-500"
     id="main-nav">

    {{-- Bordure dorée subtile --}}
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#c9a227]/30 to-transparent"></div>

    <div class="max-w-[1440px] mx-auto flex items-center justify-between h-20 px-5 md:px-[80px]">

        {{-- Logo --}}
        <a href="{{ url('/') }}" class="flex-shrink-0 group">
            <img src="{{ asset('images/logo.jpeg') }}"
                 alt="L'Éclat du Bénin"
                 class="h-12 w-auto object-contain transition-all duration-300 group-hover:scale-105" />
        </a>

        {{-- Navigation desktop --}}
        <div class="hidden lg:flex items-center gap-10">

            <a href="{{ url('/') }}"
               class="nav-link font-label-caps text-label-caps tracking-widest transition-colors duration-300 relative
                      {{ $currentPath === '/' ? 'text-[#c9a227]' : 'text-white/90 hover:text-[#c9a227]' }}">
                HOME
                @if($currentPath === '/')
                    <span class="absolute -bottom-1 left-0 w-full h-px bg-[#c9a227]"></span>
                @endif
            </a>

            {{-- ── BOUTON COLLECTIONS avec méga-menu ── --}}
            <div class="relative" id="mega-trigger">
                <button id="mega-btn"
                        onclick="toggleMegaMenu()"
                        class="nav-link font-label-caps text-label-caps tracking-widest transition-colors duration-300 flex items-center gap-1.5
                               {{ str_starts_with($currentPath, 'collection') || str_starts_with($currentPath, 'bijoux') || str_starts_with($currentPath, 'art') || str_starts_with($currentPath, 'maroquerie') ? 'text-[#c9a227]' : 'text-white/90 hover:text-[#c9a227]' }}">
                    COLLECTIONS
                    <span class="material-symbols-outlined text-[16px] transition-transform duration-300" id="mega-chevron">expand_more</span>
                </button>
            </div>

            <a href="#"
               class="nav-link font-label-caps text-label-caps tracking-widest transition-colors duration-300
                      text-white/90 hover:text-[#c9a227]">
                ARTISANS
            </a>
        </div>

        {{-- Actions droite --}}
        <div class="flex items-center gap-2 md:gap-4">

            {{-- Recherche --}}
            <button onclick="toggleSearch()"
                    class="w-9 h-9 flex items-center justify-center text-white/80 hover:text-[#c9a227] transition-colors"
                    aria-label="Rechercher">
                <span class="material-symbols-outlined text-[22px]">search</span>
            </button>

            {{-- Panier --}}
            <button onclick="openCart()"
                    class="relative w-9 h-9 flex items-center justify-center text-white/80 hover:text-[#c9a227] transition-colors"
                    aria-label="Panier">
                <span class="material-symbols-outlined text-[22px]">shopping_bag</span>
                <span id="cart-badge"
                      class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-[#c9a227] text-[#012F24] text-[9px] font-bold rounded-full items-center justify-center {{ $cartCount > 0 ? 'flex' : 'hidden' }}">
                    {{ $cartCount }}
                </span>
            </button>

            {{-- Compte --}}
            @auth
                @php $isVendor = \App\Models\ArtisanApplication::where('user_id', auth()->id())->where('status','approved')->exists(); @endphp
                <div class="relative group">
                    <button class="w-9 h-9 flex items-center justify-center text-white/80 hover:text-[#c9a227] transition-colors">
                        <span class="material-symbols-outlined text-[22px]">account_circle</span>
                    </button>
                    <div class="absolute right-0 top-full mt-2 w-48 bg-[#012F24]/95 backdrop-blur-xl border border-[#c9a227]/20 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 shadow-2xl">
                        <div class="p-2">
                            <p class="px-4 py-2 text-[10px] text-white/40 font-label-caps tracking-widest border-b border-[#c9a227]/10 truncate">
                                {{ auth()->user()->name }}
                            </p>
                            @if($isVendor)
                                <a href="{{ route('artisan.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-white/80 hover:text-[#c9a227] hover:bg-white/5 transition-all font-label-caps text-[10px] tracking-widest">
                                    <span class="material-symbols-outlined text-[14px]">storefront</span> MON ESPACE
                                </a>
                            @endif
                            <a href="{{ route('cart.index') }}" class="flex items-center gap-3 px-4 py-3 text-white/80 hover:text-[#c9a227] hover:bg-white/5 transition-all font-label-caps text-[10px] tracking-widest">
                                <span class="material-symbols-outlined text-[14px]">shopping_bag</span> MON PANIER
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-white/80 hover:text-red-400 hover:bg-white/5 transition-all font-label-caps text-[10px] tracking-widest text-left">
                                    <span class="material-symbols-outlined text-[14px]">logout</span> SE DÉCONNECTER
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('artisan.onboarding.step1') }}"
                   class="hidden md:flex items-center gap-1.5 border border-[#c9a227]/60 text-[#c9a227] px-4 py-2 font-label-caps text-[10px] tracking-widest hover:bg-[#c9a227] hover:text-[#012F24] transition-all duration-300">
                    <span class="material-symbols-outlined text-[14px]">storefront</span>
                    CRÉER SA BOUTIQUE
                </a>
                <a href="{{ route('login') }}"
                   class="w-9 h-9 flex items-center justify-center text-white/80 hover:text-[#c9a227] transition-colors md:hidden">
                    <span class="material-symbols-outlined text-[22px]">account_circle</span>
                </a>
            @endauth

            {{-- Hamburger mobile --}}
            <button class="lg:hidden w-9 h-9 flex items-center justify-center text-white/80 hover:text-[#c9a227] transition-colors"
                    onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined text-[22px]" id="hamburger-icon">menu</span>
            </button>
        </div>
    </div>

    {{-- ══════════════════════════════════════════════════════════════
         MÉGA-MENU DROPDOWN — pleine largeur
         ══════════════════════════════════════════════════════════════ --}}
    <div id="mega-menu"
         class="absolute top-full left-0 right-0 bg-[#012F24]/97 backdrop-blur-xl border-t border-[#c9a227]/15 border-b border-b-[#c9a227]/10
                max-h-0 overflow-hidden transition-all duration-300 ease-in-out opacity-0"
         style="transition: max-height 0.35s ease, opacity 0.25s ease;">

        <div class="max-w-[1440px] mx-auto px-5 md:px-[80px] py-10">

            <div class="grid gap-10" style="grid-template-columns: 200px 1fr;">

                {{-- Colonne gauche : titre + CTA --}}
                <div class="border-r border-[#c9a227]/15 pr-10 flex flex-col justify-between">
                    <div>
                        <p class="font-label-caps text-[9px] text-[#c9a227]/60 tracking-[0.25em] mb-3">NOS UNIVERS</p>
                        <h3 class="text-white font-bold text-xl leading-tight mb-4"
                            style="font-family:'Playfair Display',serif">
                            L'Excellence<br/>Artisanale
                        </h3>
                        <p class="text-white/50 text-xs leading-relaxed">
                            {{ $navCategories->count() }} collection{{ $navCategories->count() > 1 ? 's' : '' }} disponible{{ $navCategories->count() > 1 ? 's' : '' }}
                        </p>
                    </div>

                    <div class="mt-8 space-y-2">
                        <a href="{{ route('collection.index') }}"
                           onclick="closeMegaMenu()"
                           class="flex items-center gap-2 text-[#c9a227] font-label-caps text-[10px] tracking-widest hover:gap-3 transition-all duration-200">
                            <span class="material-symbols-outlined text-[14px]">grid_view</span>
                            TOUT VOIR
                        </a>
                    </div>
                </div>

                {{-- Colonnes droite : catégories en grille --}}
                <div class="grid gap-x-8 gap-y-1"
                     style="grid-template-columns: repeat({{ min($columns->count(), 5) }}, 1fr);">

                    @foreach($columns as $colIndex => $column)
                        <div class="flex flex-col gap-1">
                            @foreach($column as $cat)
                                @php
                                    try {
                                        $catUrl = route('collection.' . $cat->slug);
                                    } catch(\Exception $e) {
                                        $catUrl = route('collection.category', $cat);
                                    }
                                @endphp
                                <a href="{{ $catUrl }}"
                                   onclick="closeMegaMenu()"
                                   class="group flex items-center justify-between py-2.5 border-b border-white/5 hover:border-[#c9a227]/30 transition-all duration-200">
                                    <div class="flex items-center gap-3">
                                        {{-- Miniature image de la catégorie --}}
                                        <div class="w-8 h-8 overflow-hidden flex-shrink-0 bg-white/5">
                                            @if($cat->hero_image)
                                                <img src="{{ asset('storage/' . $cat->hero_image) }}"
                                                     class="w-full h-full object-cover opacity-70 group-hover:opacity-100 transition-opacity"
                                                     alt="{{ $cat->name }}" />
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <span class="material-symbols-outlined text-[14px] text-[#c9a227]/40">category</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-label-caps text-[10px] tracking-widest text-white/70 group-hover:text-[#c9a227] transition-colors duration-200">
                                                {{ strtoupper($cat->name) }}
                                            </p>
                                            @if($cat->products_count ?? false)
                                                <p class="text-[9px] text-white/30 mt-0.5">{{ $cat->products_count }} pièce(s)</p>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="material-symbols-outlined text-[12px] text-[#c9a227]/0 group-hover:text-[#c9a227]/70 transition-all duration-200 -translate-x-1 group-hover:translate-x-0">
                                        arrow_forward
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    {{-- Barre de recherche --}}
    <div id="search-bar"
         class="absolute top-full left-0 right-0 bg-[#012F24]/97 backdrop-blur-xl border-b border-[#c9a227]/20 overflow-hidden max-h-0 transition-all duration-300 ease-in-out">
        <div class="max-w-2xl mx-auto px-5 py-5">
            <form action="{{ route('collection.index') }}" method="GET" class="relative flex items-center">
                <span class="material-symbols-outlined text-[#c9a227]/70 absolute left-4 text-[20px]">search</span>
                <input type="text" name="q"
                       id="search-input"
                       placeholder="Rechercher une pièce, un artisan..."
                       class="w-full bg-white/5 border border-[#c9a227]/30 text-white placeholder:text-white/40
                              pl-12 pr-12 py-3.5 font-label-caps text-[11px] tracking-widest
                              focus:ring-0 focus:border-[#c9a227]/60 transition-colors" />
                <button type="button" onclick="closeSearch()"
                        class="absolute right-4 text-white/50 hover:text-white transition-colors">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </form>
            <div class="flex flex-wrap gap-2 mt-3">
                <span class="text-[9px] text-white/40 font-label-caps tracking-widest self-center">TENDANCES :</span>
                @foreach($navCategories->take(4) as $cat)
                    @php
                        try { $catUrl = route('collection.' . $cat->slug); }
                        catch(\Exception $e) { $catUrl = route('collection.category', $cat); }
                    @endphp
                    <a href="{{ $catUrl }}"
                       class="text-[9px] text-[#c9a227]/80 font-label-caps tracking-widest hover:text-[#c9a227] transition-colors px-2 py-1 border border-[#c9a227]/20 hover:border-[#c9a227]/50">
                        {{ strtoupper($cat->name) }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

</nav>

{{-- ══════════════════════════════════════════════════════════════
     OVERLAY MÉGA-MENU (fond sombre derrière)
     ══════════════════════════════════════════════════════════════ --}}
<div id="mega-overlay"
     class="fixed inset-0 bg-black/30 z-[45] hidden opacity-0 transition-opacity duration-300 top-20"
     onclick="closeMegaMenu()"></div>

{{-- ══════════════════════════════════════════════════════════════
     MENU MOBILE DRAWER
     ══════════════════════════════════════════════════════════════ --}}
<div class="fixed inset-0 bg-black/60 z-[60] hidden opacity-0 transition-opacity duration-300 lg:hidden"
     id="mobile-overlay" onclick="toggleMobileMenu()"></div>

<aside class="fixed top-0 right-0 h-full w-[300px] bg-[#012F24] z-[70] translate-x-full transition-transform duration-300 ease-in-out flex flex-col lg:hidden shadow-2xl"
       id="mobile-menu">

    <div class="flex items-center justify-between p-6 border-b border-[#c9a227]/20">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="h-9 w-auto" />
        <button onclick="toggleMobileMenu()" class="text-white/60 hover:text-white">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto p-4">
        <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-3.5 font-label-caps text-[11px] tracking-widest text-white/80 hover:text-[#c9a227] hover:bg-white/5 transition-all rounded">
            <span class="material-symbols-outlined text-[16px]">home</span> HOME
        </a>
        <a href="{{ route('collection.index') }}" class="flex items-center gap-3 px-4 py-3.5 font-label-caps text-[11px] tracking-widest text-white/80 hover:text-[#c9a227] hover:bg-white/5 transition-all rounded">
            <span class="material-symbols-outlined text-[16px]">grid_view</span> TOUTE LA COLLECTION
        </a>

        <div class="px-4 py-2"><div class="h-px bg-[#c9a227]/10"></div></div>
        <p class="font-label-caps text-[9px] text-[#c9a227]/50 tracking-[0.2em] mb-2 px-4">COLLECTIONS</p>

        {{-- Toutes les catégories dans le mobile menu avec scroll --}}
        <div class="space-y-0.5 max-h-64 overflow-y-auto">
            @foreach($navCategories as $cat)
                @php
                    try { $catUrl = route('collection.' . $cat->slug); }
                    catch(\Exception $e) { $catUrl = route('collection.category', $cat); }
                @endphp
                <a href="{{ $catUrl }}"
                   class="flex items-center gap-3 px-4 py-3 font-label-caps text-[10px] tracking-widest text-white/70 hover:text-[#c9a227] hover:bg-white/5 transition-all rounded">
                    @if($cat->hero_image)
                        <img src="{{ asset('storage/' . $cat->hero_image) }}" class="w-5 h-5 object-cover flex-shrink-0" />
                    @else
                        <span class="w-1.5 h-1.5 bg-[#c9a227]/50 rounded-full flex-shrink-0"></span>
                    @endif
                    {{ strtoupper($cat->name) }}
                </a>
            @endforeach
        </div>

        <div class="px-4 py-2 mt-2"><div class="h-px bg-[#c9a227]/10"></div></div>
        <a href="#" class="flex items-center gap-3 px-4 py-3.5 font-label-caps text-[11px] tracking-widest text-white/80 hover:text-[#c9a227] hover:bg-white/5 transition-all rounded mt-2">
            <span class="material-symbols-outlined text-[16px]">brush</span> ARTISANS
        </a>
    </nav>

    <div class="p-4 border-t border-[#c9a227]/20 space-y-2">
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-3 border border-white/20 text-white/70 font-label-caps text-[10px] tracking-widest hover:border-red-400 hover:text-red-400 transition-all">
                    <span class="material-symbols-outlined text-[14px]">logout</span> SE DÉCONNECTER
                </button>
            </form>
        @else
            <a href="{{ route('artisan.onboarding.step1') }}"
               class="flex items-center justify-center gap-2 py-3 bg-[#c9a227] text-[#012F24] font-label-caps text-[10px] tracking-widest hover:bg-[#e9c349] transition-all">
                <span class="material-symbols-outlined text-[14px]">storefront</span> CRÉER SA BOUTIQUE
            </a>
            <a href="{{ route('login') }}"
               class="flex items-center justify-center gap-2 py-3 border border-[#c9a227]/40 text-[#c9a227] font-label-caps text-[10px] tracking-widest hover:bg-white/5 transition-all">
                SE CONNECTER
            </a>
        @endauth
    </div>
</aside>

<script>
const mainNav = document.getElementById('main-nav');
let megaOpen  = false;
let searchOpen = false;

// ── SCROLL : navbar transparente → opaque ──
function updateNavStyle() {
    const scrolled    = window.scrollY > 80;
    const anyPanelOpen = megaOpen || searchOpen;

    if (scrolled || anyPanelOpen) {
        mainNav.style.background     = 'rgba(1,47,36,0.97)';
        mainNav.style.backdropFilter = 'blur(20px)';
        mainNav.style.borderBottom   = '1px solid rgba(201,162,39,0.15)';
    } else {
        mainNav.style.background     = 'rgba(1,47,36,0.0)';
        mainNav.style.backdropFilter = 'blur(0px)';
        mainNav.style.borderBottom   = 'none';
    }
}

window.addEventListener('scroll', updateNavStyle);
updateNavStyle();

// ── MÉGA-MENU ──
function toggleMegaMenu() {
    megaOpen ? closeMegaMenu() : openMegaMenu();
}

function openMegaMenu() {
    megaOpen = true;
    const menu    = document.getElementById('mega-menu');
    const chevron = document.getElementById('mega-chevron');
    const overlay = document.getElementById('mega-overlay');

    menu.style.maxHeight = '600px';
    menu.style.opacity   = '1';
    chevron.style.transform = 'rotate(180deg)';
    overlay.classList.remove('hidden');
    setTimeout(() => overlay.classList.add('opacity-100'), 10);

    // Fermer la recherche si ouverte
    if (searchOpen) closeSearch();
    updateNavStyle();
}

function closeMegaMenu() {
    megaOpen = false;
    const menu    = document.getElementById('mega-menu');
    const chevron = document.getElementById('mega-chevron');
    const overlay = document.getElementById('mega-overlay');

    menu.style.maxHeight = '0';
    menu.style.opacity   = '0';
    chevron.style.transform = 'rotate(0deg)';
    overlay.classList.remove('opacity-100');
    setTimeout(() => overlay.classList.add('hidden'), 300);
    updateNavStyle();
}

// ── RECHERCHE ──
function toggleSearch() {
    searchOpen ? closeSearch() : openSearch();
}

function openSearch() {
    searchOpen = true;
    const bar     = document.getElementById('search-bar');
    const overlay = document.getElementById('search-overlay');
    bar.style.maxHeight = '160px';
    overlay.classList.remove('hidden');
    setTimeout(() => overlay.classList.add('opacity-100'), 10);
    setTimeout(() => document.getElementById('search-input').focus(), 200);
    if (megaOpen) closeMegaMenu();
    updateNavStyle();
}

function closeSearch() {
    searchOpen = false;
    const bar     = document.getElementById('search-bar');
    const overlay = document.getElementById('search-overlay');
    bar.style.maxHeight = '0';
    overlay.classList.remove('opacity-100');
    setTimeout(() => overlay.classList.add('hidden'), 300);
    updateNavStyle();
}

// ── MENU MOBILE ──
function toggleMobileMenu() {
    const menu    = document.getElementById('mobile-menu');
    const overlay = document.getElementById('mobile-overlay');
    const icon    = document.getElementById('hamburger-icon');
    const isOpen  = !menu.classList.contains('translate-x-full');

    if (isOpen) {
        menu.classList.add('translate-x-full');
        overlay.classList.remove('opacity-100');
        overlay.classList.add('hidden');
        icon.textContent = 'menu';
    } else {
        menu.classList.remove('translate-x-full');
        overlay.classList.remove('hidden');
        setTimeout(() => overlay.classList.add('opacity-100'), 10);
        icon.textContent = 'close';
    }
}

// Échap pour tout fermer
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        closeMegaMenu();
        closeSearch();
    }
});

// Badge panier
function updateCartBadge(count) {
    const badge = document.getElementById('cart-badge');
    if (!badge) return;
    badge.textContent = count;
    count > 0 ? badge.classList.remove('hidden') : badge.classList.add('hidden');
}

function openCart() {
    // Ouvre le drawer panier
    const drawer  = document.getElementById('cart-drawer');
    const overlay = document.getElementById('cart-overlay');
    if (drawer) {
        drawer.classList.remove('translate-x-full');
        overlay?.classList.remove('hidden');
        setTimeout(() => overlay?.classList.add('opacity-100'), 10);
        document.body.style.overflow = 'hidden';
    }
}
</script>
