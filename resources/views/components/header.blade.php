<nav class="fixed top-0 w-full z-50 bg-surface/70 backdrop-blur-xl border-b border-outline-variant/30 flex justify-between items-center px-margin-mobile md:px-margin-desktop h-20 w-full">
    <!--<div class="flex items-center gap-4">
            <span class="material-symbols-outlined text-primary cursor-pointer transition-transform duration-200 active:scale-95" data-icon="menu">menu</span>
        </div>-->
    <h1 class="font-display-lg text-headline-md tracking-widest text-primary">L'ÉCLAT DU BÉNIN</h1>
    <div class="flex items-center gap-6">
        <div class="hidden md:flex gap-8 items-center">
            <a class="font-label-caps text-label-caps text-primary font-bold line-hover relative" href="/">HOME</a>
            <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-secondary transition-colors duration-300 line-hover relative" href="/collection">COLLECTIONS</a>
            <a class="font-label-caps text-label-caps text-on-surface-variant hover:text-secondary transition-colors duration-300 line-hover relative" href="/artisan">ARTISANS</a>
        </div>
        <!--<span class="material-symbols-outlined text-primary cursor-pointer transition-transform duration-200 active:scale-95" data-icon="shopping_bag">shopping_bag</span>-->
    </div>
    @auth
    <div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Se déconnecter</button>
        </form>
    </div>
    @else
    <div class="flex items-center gap-4">
        <a href="{{ route('artisan.onboarding.became') }}" class="bg-gold text-black px-5 py-2 rounded-full font-semibold hover:opacity-90">
            Créer sa boutique
        </a>
    </div>
    @endauth
</nav>
