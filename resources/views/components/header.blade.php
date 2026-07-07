{{--
    COMPOSANT : <x-navbar />
    =====================================================================
    Navbar fixe premium harmonisée avec le logo LM (vert #012F24 / or).
    - Logo image à gauche
    - Navigation centrale (desktop)
    - Recherche + Panier + Compte à droite
    - Drawer mobile complet
    - Panier avec badge compteur dynamique
    - Barre de recherche expansible au clic
    =====================================================================
--}}

@php
    // Catégories pour le méga-menu dynamique
    $navCategories = \App\Models\Category::orderBy('display_order')->get();

    // Compteur panier depuis la session
    $cartCount = session('cart') ? count(session('cart')) : 0;

    // Détecter la page active
    $currentPath = request()->path();
@endphp

{{-- ══════════════════════════════════════════════════════════════
     OVERLAY RECHERCHE (fond sombre derrière la barre de recherche)
     ══════════════════════════════════════════════════════════════ --}}
<div id="search-overlay"
     class="fixed inset-0 bg-black/40 z-[45] hidden opacity-0 transition-opacity duration-300"
     onclick="closeSearch()"></div>

{{-- ══════════════════════════════════════════════════════════════
     NAVBAR PRINCIPALE
     ══════════════════════════════════════════════════════════════ --}}
<nav class="fixed top-0 w-full z-50 transition-all duration-500"
     id="main-nav"
     style="background: rgba(1,47,36,0.0); backdrop-filter: blur(0px);">

    {{-- Bordure dorée subtile en bas --}}
    <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#c9a227]/30 to-transparent"></div>

    <div class="max-w-[1440px] mx-auto flex items-center justify-between h-20 px-5 md:px-[80px]">

        {{-- ── LOGO ── --}}
        <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center group">
            <img src="{{ asset('images/logo.jpeg') }}"
                 alt="L'Éclat du Bénin"
                 class="h-12 w-auto object-contain transition-all duration-300 group-hover:scale-105"
                 id="nav-logo" />
        </a>

        {{-- ── NAVIGATION DESKTOP ── --}}
        <div class="hidden lg:flex items-center gap-10" id="nav-links">

            <a href="{{ url('/') }}"
               class="nav-link font-label-caps text-label-caps tracking-widest transition-colors duration-300 relative
                      {{ $currentPath === '/' ? 'text-[#c9a227]' : 'text-white/90 hover:text-[#c9a227]' }}">
                HOME
                @if($currentPath === '/')
                    <span class="absolute -bottom-1 left-0 w-full h-px bg-[#c9a227]"></span>
                @endif
            </a>

            {{-- COLLECTIONS — avec méga-menu dropdown --}}
            <div class="relative group" id="collections-menu">
                <button class="nav-link font-label-caps text-label-caps tracking-widest transition-colors duration-300 flex items-center gap-1
                               {{ str_starts_with($currentPath, 'collection') || str_starts_with($currentPath, 'bijoux') || str_starts_with($currentPath, 'art') || str_starts_with($currentPath, 'maroquerie') ? 'text-[#c9a227]' : 'text-white/90 hover:text-[#c9a227]' }}">
                    COLLECTIONS
                    <span class="material-symbols-outlined text-[14px] transition-transform duration-200 group-hover:rotate-180">expand_more</span>
                </button>

                {{-- Dropdown --}}
                <div class="absolute top-full left-1/2 -translate-x-1/2 mt-2 w-56 bg-[#012F24]/95 backdrop-blur-xl border border-[#c9a227]/20 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 translate-y-2 group-hover:translate-y-0 shadow-2xl">
                    <div class="p-2">
                        <a href="{{ route('collection.index') }}"
                           class="flex items-center gap-3 px-4 py-3 text-white/80 hover:text-[#c9a227] hover:bg-white/5 transition-all duration-200 font-label-caps text-[10px] tracking-widest group/item">
                            <span class="material-symbols-outlined text-[14px] text-[#c9a227]/60 group-hover/item:text-[#c9a227]">grid_view</span>
                            TOUTE LA COLLECTION
                        </a>
                        <div class="h-px bg-[#c9a227]/10 mx-4 my-1"></div>
                        @foreach($navCategories as $cat)
                            <a href="{{ route('collection.category', ['category' => $cat->slug]) }}"
                               class="flex items-center gap-3 px-4 py-3 text-white/80 hover:text-[#c9a227] hover:bg-white/5 transition-all duration-200 font-label-caps text-[10px] tracking-widest group/item">
                                <span class="material-symbols-outlined text-[14px] text-[#c9a227]/60 group-hover/item:text-[#c9a227]">arrow_forward</span>
                                {{ strtoupper($cat->name) }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <a href="#"
               class="nav-link font-label-caps text-label-caps tracking-widest transition-colors duration-300
                      {{ str_starts_with($currentPath, 'artisan') ? 'text-[#c9a227]' : 'text-white/90 hover:text-[#c9a227]' }} relative">
                ARTISANS
                @if(str_starts_with($currentPath, 'artisan'))
                    <span class="absolute -bottom-1 left-0 w-full h-px bg-[#c9a227]"></span>
                @endif
            </a>

        </div>

        {{-- ── ACTIONS DROITE ── --}}
        <div class="flex items-center gap-2 md:gap-4">

            {{-- Recherche --}}
            <button onclick="toggleSearch()"
                id="search-btn"
                class="w-9 h-9 flex items-center justify-center text-white/80 hover:text-[#c9a227] transition-colors duration-300 rounded"
                aria-label="Rechercher">
                <span class="material-symbols-outlined text-[22px]">search</span>
            </button>

            {{-- Panier avec badge --}}
            <button onclick="openCart()"
                class="relative w-9 h-9 flex items-center justify-center text-white/80 hover:text-[#c9a227] transition-colors duration-300"
                aria-label="Panier">
                <span class="material-symbols-outlined text-[22px]">shopping_bag</span>
                {{-- Badge compteur --}}
                @if($cartCount > 0)
                    <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-[#c9a227] text-[#012F24] text-[9px] font-bold rounded-full flex items-center justify-center" id="cart-badge">
                        {{ $cartCount }}
                    </span>
                @else
                    <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-[#c9a227] text-[#012F24] text-[9px] font-bold rounded-full items-center justify-center hidden" id="cart-badge">0</span>
                @endif
            </button>

            {{-- Compte utilisateur --}}
            @auth
                @php $isVendor = \App\Models\ArtisanApplication::where('user_id', auth()->id())->where('status', 'approved')->exists(); @endphp
                <div class="relative group">
                    <button class="w-9 h-9 flex items-center justify-center text-white/80 hover:text-[#c9a227] transition-colors duration-300">
                        <span class="material-symbols-outlined text-[22px]">account_circle</span>
                    </button>
                    <div class="absolute right-0 top-full mt-2 w-48 bg-[#012F24]/95 backdrop-blur-xl border border-[#c9a227]/20 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 shadow-2xl">
                        <div class="p-2">
                            <p class="px-4 py-2 text-[10px] text-white/40 font-label-caps tracking-widest border-b border-[#c9a227]/10">
                                {{ auth()->user()->name }}
                            </p>
                            @if($isVendor)
                                <a href="{{ route('artisan.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-white/80 hover:text-[#c9a227] hover:bg-white/5 transition-all font-label-caps text-[10px] tracking-widest">
                                    <span class="material-symbols-outlined text-[14px]">storefront</span> MON ESPACE
                                </a>
                            @endif
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
                <a href="{{ route('artisan.onboarding.became') }}"
                   class="hidden md:flex items-center gap-1.5 border border-[#c9a227]/60 text-[#c9a227] px-4 py-2 font-label-caps text-[10px] tracking-widest hover:bg-[#c9a227] hover:text-[#012F24] transition-all duration-300">
                    <span class="material-symbols-outlined text-[14px]">storefront</span>
                    CRÉER SA BOUTIQUE
                </a>
                <a href="{{ route('login') }}"
                   class="w-9 h-9 flex items-center justify-center text-white/80 hover:text-[#c9a227] transition-colors duration-300 md:hidden">
                    <span class="material-symbols-outlined text-[22px]">account_circle</span>
                </a>
            @endauth

            {{-- Hamburger mobile --}}
            <button class="lg:hidden w-9 h-9 flex items-center justify-center text-white/80 hover:text-[#c9a227] transition-colors" onclick="toggleMobileMenu()">
                <span class="material-symbols-outlined text-[22px]" id="hamburger-icon">menu</span>
            </button>

        </div>
    </div>

    {{-- ── BARRE DE RECHERCHE EXPANSIBLE ── --}}
    <div id="search-bar"
         class="absolute top-full left-0 right-0 bg-[#012F24]/95 backdrop-blur-xl border-b border-[#c9a227]/20 overflow-hidden max-h-0 transition-all duration-300 ease-in-out">
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
            {{-- Suggestions rapides --}}
            <div class="flex flex-wrap gap-2 mt-3">
                <span class="text-[9px] text-white/40 font-label-caps tracking-widest self-center">TENDANCES :</span>
                @foreach($navCategories->take(4) as $cat)
                    <a href="{{ route('collection.category', ['category' => $cat->slug]) }}"
                       class="text-[9px] text-[#c9a227]/80 font-label-caps tracking-widest hover:text-[#c9a227] transition-colors px-2 py-1 border border-[#c9a227]/20 hover:border-[#c9a227]/50">
                        {{ strtoupper($cat->name) }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

</nav>

{{-- ══════════════════════════════════════════════════════════════
     MENU MOBILE DRAWER
     ══════════════════════════════════════════════════════════════ --}}
<div class="fixed inset-0 bg-black/60 z-[60] hidden opacity-0 transition-opacity duration-300 lg:hidden"
     id="mobile-overlay" onclick="toggleMobileMenu()"></div>

<aside class="fixed top-0 right-0 h-full w-[280px] bg-[#012F24] z-[70] translate-x-full transition-transform duration-300 ease-in-out flex flex-col lg:hidden shadow-2xl"
       id="mobile-menu">

    <div class="flex items-center justify-between p-6 border-b border-[#c9a227]/20">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="h-9 w-auto" />
        <button onclick="toggleMobileMenu()" class="text-white/60 hover:text-white">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto p-4">
        <p class="font-label-caps text-[9px] text-[#c9a227]/50 tracking-[0.2em] mb-3 px-4">NAVIGATION</p>

        <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-3.5 font-label-caps text-[11px] tracking-widest text-white/80 hover:text-[#c9a227] hover:bg-white/5 transition-all rounded">
            <span class="material-symbols-outlined text-[16px]">home</span> HOME
        </a>
        <a href="{{ route('collection.index') }}" class="flex items-center gap-3 px-4 py-3.5 font-label-caps text-[11px] tracking-widest text-white/80 hover:text-[#c9a227] hover:bg-white/5 transition-all rounded">
            <span class="material-symbols-outlined text-[16px]">grid_view</span> TOUTE LA COLLECTION
        </a>

        <div class="px-4 py-2">
            <div class="h-px bg-[#c9a227]/10"></div>
        </div>
        <p class="font-label-caps text-[9px] text-[#c9a227]/50 tracking-[0.2em] mb-2 px-4 mt-2">COLLECTIONS</p>

        @foreach($navCategories as $cat)
            <a href="{{ route('collection.category', ['category' => $cat->slug]) }}"
               class="flex items-center gap-3 px-4 py-3 font-label-caps text-[10px] tracking-widest text-white/70 hover:text-[#c9a227] hover:bg-white/5 transition-all rounded">
                <span class="w-1 h-1 bg-[#c9a227]/50 rounded-full"></span>
                {{ strtoupper($cat->name) }}
            </a>
        @endforeach

        <div class="px-4 py-2 mt-2">
            <div class="h-px bg-[#c9a227]/10"></div>
        </div>

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

{{-- ══════════════════════════════════════════════════════════════
     SCRIPTS NAVBAR
     ══════════════════════════════════════════════════════════════ --}}
<script>
/**
 * NAVBAR — comportements
 * ========================
 * 1. Scroll : la navbar devient opaque au défilement (transparent sur hero)
 * 2. Recherche : expand/collapse avec animation
 * 3. Menu mobile : drawer depuis la droite
 * 4. Panier : compteur mis à jour dynamiquement
 */

const mainNav = document.getElementById('main-nav');

// ── 1. EFFET DE SCROLL (transparent → opaque) ──
// Sur le hero : navbar transparente. Après 80px : fond vert foncé
window.addEventListener('scroll', () => {
    const scrolled = window.scrollY > 80;
    mainNav.style.background = scrolled
        ? 'rgba(1,47,36,0.95)'
        : 'rgba(1,47,36,0.0)';
    mainNav.style.backdropFilter = scrolled ? 'blur(20px)' : 'blur(0px)';
    mainNav.style.borderBottom = scrolled ? '1px solid rgba(201,162,39,0.2)' : 'none';
});

// Initialiser selon la position de scroll actuelle
if (window.scrollY > 80) {
    mainNav.style.background = 'rgba(1,47,36,0.95)';
    mainNav.style.backdropFilter = 'blur(20px)';
}

// ── 2. BARRE DE RECHERCHE ──
let searchOpen = false;

function toggleSearch() {
    searchOpen ? closeSearch() : openSearch();
}

function openSearch() {
    searchOpen = true;
    const bar = document.getElementById('search-bar');
    const overlay = document.getElementById('search-overlay');
    bar.style.maxHeight = '160px';
    overlay.classList.remove('hidden');
    setTimeout(() => overlay.classList.add('opacity-100'), 10);
    setTimeout(() => document.getElementById('search-input').focus(), 200);
    mainNav.style.background = 'rgba(1,47,36,0.98)';
    mainNav.style.backdropFilter = 'blur(20px)';
}

function closeSearch() {
    searchOpen = false;
    const bar = document.getElementById('search-bar');
    const overlay = document.getElementById('search-overlay');
    bar.style.maxHeight = '0';
    overlay.classList.remove('opacity-100');
    setTimeout(() => overlay.classList.add('hidden'), 300);
}

// ── 3. MENU MOBILE ──
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

// ── 4. PANIER — mise à jour du badge ──
function updateCartBadge(count) {
    const badge = document.getElementById('cart-badge');
    if (!badge) return;
    if (count > 0) {
        badge.textContent = count;
        badge.classList.remove('hidden');
        badge.classList.add('flex');
    } else {
        badge.classList.add('hidden');
        badge.classList.remove('flex');
    }
}

// Fonction ouvrir panier (à relier quand le module panier sera prêt)
function openCart() {
    // TODO : ouvrir le drawer panier
    // Pour l'instant, rediriger vers la page panier si elle existe
    console.log('Panier ouvert');
}

// Touche Escape pour fermer recherche
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        closeSearch();
        const menu = document.getElementById('mobile-menu');
        if (!menu.classList.contains('translate-x-full')) toggleMobileMenu();
    }
});
</script>
