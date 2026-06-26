<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Espace Vendeur') | L'Éclat du Bénin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: {
                    "primary":"#012F24 ","secondary":"#735c00","background":"#faf9f6",
                    "surface":"#ffffff","surface-container":"#efeeeb","surface-container-low":"#f4f3f1",
                    "surface-container-high":"#e9e8e5","surface-container-highest":"#e3e2e0",
                    "outline-variant":"#c4c7c7","on-surface-variant":"#444748","on-surface":"#1a1c1a",
                    "secondary-container":"#fed65b","secondary-fixed":"#ffe088",
                    "error":"#ba1a1a","error-container":"#ffdad6",
                    "on-tertiary-container":"#5e8e77","tertiary-container":"#002114",
                    "outline":"#747878","on-primary":"#ffffff",
                },
                fontFamily: { "sans":["Montserrat","sans-serif"], "serif":["Playfair Display","serif"] }
            }}
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24; }
        .nav-link { display: flex; align-items: center; gap: 12px; padding: 10px 16px; font-size: 13px; font-weight: 500; border-radius: 2px; transition: all 0.15s; color: rgba(255,255,255,0.55); }
        .nav-link:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.9); }
        .nav-link.active { background: rgba(255,255,255,0.1); color: #ffffff; }
        .nav-link .material-symbols-outlined { font-size: 20px; }
        .stat-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.06); }
        .badge-approved { background: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; display: inline-flex; align-items: center; gap: 4px; padding: 2px 10px; font-size: 10px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; }
        .badge-verified { background: #fff8e1; color: #735c00; border: 1px solid #e9c349; display: inline-flex; align-items: center; gap: 4px; padding: 2px 10px; font-size: 10px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; }
        .badge-pending  { background: #fff3e0; color: #92600a; border: 1px solid #ffcc80; display: inline-flex; align-items: center; gap: 4px; padding: 2px 10px; font-size: 10px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; }
        .badge-rejected { background: #ffdad6; color: #ba1a1a; border: 1px solid #ffb4ab; display: inline-flex; align-items: center; gap: 4px; padding: 2px 10px; font-size: 10px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; }
        .badge-draft    { background: #f0f0f0; color: #444748; border: 1px solid #c4c7c7; display: inline-flex; align-items: center; gap: 4px; padding: 2px 10px; font-size: 10px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; }
        @keyframes fadeUp { from{opacity:0;transform:translateY(16px)} to{opacity:1;transform:translateY(0)} }
        .fade-up { animation: fadeUp 0.4s ease forwards; }
        @keyframes spin { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }
        @yield('extra-styles')
    </style>
</head>
<body class="bg-background text-on-surface min-h-screen flex">

{{-- ================================================================
     SIDEBAR COMMUNE À TOUT L'ESPACE VENDEUR
     ================================================================ --}}
<aside class="fixed left-0 top-0 h-full w-64 bg-primary flex flex-col z-50">

    <div class="px-6 py-7 border-b border-white/10">
        <p class="text-[10px] font-semibold text-white/30 uppercase tracking-widest mb-1">Espace Artisan</p>
        <h1 class="text-white font-bold uppercase tracking-widest leading-tight" style="font-family:'Playfair Display',serif; font-size:15px;">
            L'ÉCLAT DU BÉNIN
        </h1>
    </div>

    @php
        $app = $application ?? \App\Models\ArtisanApplication::where('user_id', auth()->id())->first();
    @endphp

    <div class="px-6 py-5 border-b border-white/10">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-secondary-fixed flex items-center justify-center flex-shrink-0">
                <span class="text-primary text-sm font-bold uppercase">
                    {{ strtoupper(substr($app->shop_name ?? $app->full_name ?? 'AR', 0, 2)) }}
                </span>
            </div>
            <div class="min-w-0">
                <p class="text-white text-sm font-semibold truncate">{{ $app->shop_name ?? 'Ma Boutique' }}</p>
                <div class="flex items-center gap-1.5 mt-0.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-400 flex-shrink-0"></span>
                    <p class="text-[10px] text-white/50 uppercase tracking-widest">Boutique Active</p>
                </div>
            </div>
        </div>
    </div>

    <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">

        <p class="px-4 pt-2 pb-1 text-[10px] font-semibold text-white/25 uppercase tracking-widest">Principal</p>

        <a href="{{ route('artisan.dashboard') }}" class="nav-link {{ request()->routeIs('artisan.dashboard') ? 'active' : '' }}">
            <span class="material-symbols-outlined">dashboard</span>
            Tableau de Bord
        </a>

        <a href="{{ route('artisan.products.index') }}" class="nav-link {{ request()->routeIs('artisan.products.*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">inventory_2</span>
            Mes Produits
            @php $prodCount = $app->products()->count(); @endphp
            @if($prodCount > 0)
                <span class="ml-auto text-[10px] bg-white/10 px-2 py-0.5 rounded-full">{{ $prodCount }}</span>
            @endif
        </a>

        <a href="{{ route('artisan.orders.index') }}" class="nav-link {{ request()->routeIs('artisan.orders.*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">receipt_long</span>
            Commandes
            @php $pendingOrders = $app->orderItems()->where('item_status', 'pending')->count(); @endphp
            @if($pendingOrders > 0)
                <span class="ml-auto text-[10px] bg-secondary-fixed text-primary font-bold px-2 py-0.5 rounded-full">{{ $pendingOrders }}</span>
            @endif
        </a>

        <a href="{{ route('chat.index') }}" class="nav-link {{ request()->routeIs('chat.*') ? 'active' : '' }}">
            <span class="material-symbols-outlined">chat_bubble</span>
            Messagerie
            @php
                $unread = \App\Models\Conversation::where('artisan_application_id', $app->id)
                    ->get()->sum(fn($c) => $c->unreadCountFor(auth()->id()));
            @endphp
            @if($unread > 0)
                <span class="ml-auto text-[10px] bg-red-500 text-white font-bold px-2 py-0.5 rounded-full">{{ $unread }}</span>
            @endif
        </a>

        <a href="#" class="nav-link">
            <span class="material-symbols-outlined">bar_chart</span>
            Analytiques
        </a>

        <p class="px-4 pt-4 pb-1 text-[10px] font-semibold text-white/25 uppercase tracking-widest">Boutique</p>

        <a href="#" class="nav-link">
            <span class="material-symbols-outlined">storefront</span>
            Ma Boutique
        </a>

        <a href="#" class="nav-link">
            <span class="material-symbols-outlined">local_shipping</span>
            Livraison
        </a>

        <p class="px-4 pt-4 pb-1 text-[10px] font-semibold text-white/25 uppercase tracking-widest">Compte</p>

        <a href="#" class="nav-link">
            <span class="material-symbols-outlined">manage_accounts</span>
            Paramètres
        </a>
    </nav>

    <div class="px-3 py-4 border-t border-white/10">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link w-full text-left hover:bg-red-900/20 hover:text-red-300">
                <span class="material-symbols-outlined">logout</span>
                Se Déconnecter
            </button>
        </form>
    </div>

</aside>

<div class="ml-64 flex-1 flex flex-col min-h-screen">
    @yield('content')
</div>

@yield('extra-scripts')

</body>
</html>
