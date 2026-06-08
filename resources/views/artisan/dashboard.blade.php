<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $application->shop_name }} — Tableau de Bord | L'Éclat du Bénin</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: {
                    "primary":"#000000","secondary":"#735c00","background":"#faf9f6",
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

        /* Sidebar active link */
        .nav-link { display: flex; align-items: center; gap: 12px; padding: 10px 16px; font-size: 13px; font-weight: 500; border-radius: 2px; transition: all 0.15s; color: rgba(255,255,255,0.55); }
        .nav-link:hover { background: rgba(255,255,255,0.06); color: rgba(255,255,255,0.9); }
        .nav-link.active { background: rgba(255,255,255,0.1); color: #ffffff; }
        .nav-link .material-symbols-outlined { font-size: 20px; }

        /* Carte stat avec hover animé */
        .stat-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.06); }

        /* Badge approuvé */
        .badge-approved { background: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; display: inline-flex; align-items: center; gap: 4px; padding: 2px 10px; font-size: 10px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; }

        /* Animation entrée */
        @keyframes fadeUp { from{opacity:0;transform:translateY(16px)} to{opacity:1;transform:translateY(0)} }
        .fade-up { animation: fadeUp 0.4s ease forwards; }
        .delay-1 { animation-delay: 0.05s; opacity: 0; }
        .delay-2 { animation-delay: 0.1s; opacity: 0; }
        .delay-3 { animation-delay: 0.15s; opacity: 0; }
        .delay-4 { animation-delay: 0.2s; opacity: 0; }

        /* Shimmer pour les zones vides */
        .empty-shimmer {
            background: linear-gradient(90deg, #f4f3f1 25%, #eae9e6 50%, #f4f3f1 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }
        @keyframes shimmer { 0%{background-position:200% 0} 100%{background-position:-200% 0} }

        /* Barre de complétion du profil */
        .profile-fill { transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1); }
    </style>
</head>
<body class="bg-background text-on-surface min-h-screen flex">

{{-- ================================================================
     SIDEBAR
     ================================================================ --}}
<aside class="fixed left-0 top-0 h-full w-64 bg-primary flex flex-col z-50" id="sidebar">

    {{-- Logo --}}
    <div class="px-6 py-7 border-b border-white/10">
        <p class="text-[10px] font-semibold text-white/30 uppercase tracking-widest mb-1">Espace Artisan</p>
        <h1 class="text-white font-bold uppercase tracking-widest leading-tight" style="font-family:'Playfair Display',serif; font-size:15px;">
            L'ÉCLAT DU BÉNIN
        </h1>
    </div>

    {{-- Profil boutique --}}
    <div class="px-6 py-5 border-b border-white/10">
        <div class="flex items-center gap-3">
            {{-- Avatar initiales --}}
            <div class="w-10 h-10 bg-secondary-fixed flex items-center justify-center flex-shrink-0">
                <span class="text-primary text-sm font-bold uppercase">
                    {{ strtoupper(substr($application->shop_name ?? $application->full_name, 0, 2)) }}
                </span>
            </div>
            <div class="min-w-0">
                <p class="text-white text-sm font-semibold truncate">{{ $application->shop_name }}</p>
                <div class="flex items-center gap-1.5 mt-0.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-400 flex-shrink-0"></span>
                    <p class="text-[10px] text-white/50 uppercase tracking-widest">Boutique Active</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">

        <p class="px-4 pt-2 pb-1 text-[10px] font-semibold text-white/25 uppercase tracking-widest">Principal</p>

        <a href="{{ route('artisan.dashboard') }}" class="nav-link active">
            <span class="material-symbols-outlined">dashboard</span>
            Tableau de Bord
        </a>

        <a href="#" class="nav-link">
            <span class="material-symbols-outlined">inventory_2</span>
            Mes Produits
            <span class="ml-auto text-[10px] bg-white/10 px-2 py-0.5 rounded-full">{{ $stats['products'] }}</span>
        </a>

        <a href="#" class="nav-link">
            <span class="material-symbols-outlined">receipt_long</span>
            Commandes
            <span class="ml-auto text-[10px] bg-white/10 px-2 py-0.5 rounded-full">{{ $stats['orders'] }}</span>
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
            <span class="material-symbols-outlined">photo_library</span>
            Galerie
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

        <a href="#" class="nav-link">
            <span class="material-symbols-outlined">help_outline</span>
            Aide & Support
        </a>
    </nav>

    {{-- Déconnexion --}}
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

{{-- ================================================================
     CONTENU PRINCIPAL
     ================================================================ --}}
<div class="ml-64 flex-1 flex flex-col min-h-screen">

    {{-- TOPBAR --}}
    <header class="sticky top-0 z-40 bg-surface/80 backdrop-blur-xl border-b border-outline-variant/30 px-8 py-4 flex items-center justify-between">
        <div>
            <h2 class="font-bold text-primary" style="font-family:'Playfair Display',serif; font-size:20px;">
                Tableau de Bord
            </h2>
            <p class="text-xs text-on-surface-variant mt-0.5">
                {{ now()->isoFormat('dddd D MMMM YYYY') }} — Bienvenue, {{ auth()->user()->name }}
            </p>
        </div>
        <div class="flex items-center gap-4">
            {{-- Statut boutique --}}
            <span class="badge-approved">
                <span class="material-symbols-outlined text-[12px]" style="font-variation-settings:'FILL' 1;">verified</span>
                Boutique Approuvée
            </span>
            {{-- Bouton principal --}}
            <a href="#"
               class="flex items-center gap-2 bg-primary text-white px-5 py-2.5 text-xs font-semibold uppercase tracking-widest hover:bg-on-surface-variant transition-all">
                <span class="material-symbols-outlined text-[16px]">add</span>
                Ajouter un Produit
            </a>
        </div>
    </header>

    <main class="flex-1 p-8 space-y-8">

        {{-- ── MESSAGE DE BIENVENUE (flash, s'affiche une seule fois) ── --}}
        @if(session('welcome'))
            <div class="fade-up p-5 border-l-4 border-on-tertiary-container bg-white flex items-start gap-4" id="welcome-banner">
                <span class="material-symbols-outlined text-on-tertiary-container text-3xl flex-shrink-0" style="font-variation-settings:'FILL' 1;">celebration</span>
                <div class="flex-1">
                    <p class="font-semibold text-primary">{{ session('welcome') }}</p>
                    <p class="text-sm text-on-surface-variant mt-1">
                        Votre boutique <strong>{{ $application->shop_name }}</strong> est maintenant visible sur L'Éclat du Bénin.
                        Commencez par ajouter vos premiers produits.
                    </p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-on-surface-variant hover:text-primary flex-shrink-0">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        @endif

        {{-- ── SECTION 1 : CARTES DE STATISTIQUES ── --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">

            {{-- Produits --}}
            <div class="stat-card bg-surface border border-outline-variant/30 p-6 fade-up delay-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 bg-surface-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-secondary">inventory_2</span>
                    </div>
                    <span class="text-[10px] text-on-surface-variant/50 uppercase tracking-widest">Ce mois</span>
                </div>
                <p class="text-3xl font-bold text-primary">{{ $stats['products'] }}</p>
                <p class="text-xs text-on-surface-variant uppercase tracking-widest mt-1">Produits publiés</p>
                @if($stats['products'] === 0)
                    <p class="text-[10px] text-secondary mt-3 font-semibold">→ Ajoutez votre 1er produit</p>
                @endif
            </div>

            {{-- Vues --}}
            <div class="stat-card bg-surface border border-outline-variant/30 p-6 fade-up delay-2">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 bg-surface-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-secondary">visibility</span>
                    </div>
                    <span class="text-[10px] text-on-surface-variant/50 uppercase tracking-widest">Ce mois</span>
                </div>
                <p class="text-3xl font-bold text-primary">{{ number_format($stats['views']) }}</p>
                <p class="text-xs text-on-surface-variant uppercase tracking-widest mt-1">Vues de la boutique</p>
            </div>

            {{-- Commandes --}}
            <div class="stat-card bg-surface border border-outline-variant/30 p-6 fade-up delay-3">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 bg-surface-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-secondary">receipt_long</span>
                    </div>
                    <span class="text-[10px] text-on-surface-variant/50 uppercase tracking-widest">En cours</span>
                </div>
                <p class="text-3xl font-bold text-primary">{{ $stats['orders'] }}</p>
                <p class="text-xs text-on-surface-variant uppercase tracking-widest mt-1">Commandes reçues</p>
            </div>

            {{-- Revenus --}}
            <div class="stat-card bg-primary p-6 fade-up delay-4">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-10 h-10 bg-white/10 flex items-center justify-center">
                        <span class="material-symbols-outlined text-secondary-fixed">payments</span>
                    </div>
                    <span class="text-[10px] text-white/40 uppercase tracking-widest">Ce mois</span>
                </div>
                <p class="text-3xl font-bold text-white">{{ number_format($stats['revenue']) }}</p>
                <p class="text-xs text-white/60 uppercase tracking-widest mt-1">Revenus (FCFA)</p>
            </div>

        </div>

        {{-- ── SECTION 2 : CONTENU PRINCIPAL (2 colonnes) ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- COLONNE LARGE : Premiers pas (quand boutique vide) --}}
            <div class="lg:col-span-2 space-y-5 fade-up delay-2">

                {{-- Carte "Démarrer" --}}
                <div class="bg-surface border border-outline-variant/30 overflow-hidden">
                    <div class="px-6 pt-6 pb-4 border-b border-outline-variant/20">
                        <h3 class="font-bold text-primary uppercase tracking-widest text-xs">Premiers Pas</h3>
                        <p class="text-sm text-on-surface-variant mt-1">Complétez ces étapes pour maximiser votre visibilité sur la plateforme.</p>
                    </div>

                    <div class="divide-y divide-outline-variant/20">

                        {{-- Étape 1 : Compte créé ✅ --}}
                        <div class="flex items-center gap-5 px-6 py-4">
                            <div class="w-8 h-8 bg-on-tertiary-container/15 flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-on-tertiary-container text-[18px]" style="font-variation-settings:'FILL' 1;">check_circle</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-primary">Compte & Boutique créés</p>
                                <p class="text-xs text-on-surface-variant mt-0.5">Inscription complète et validée par le Comité.</p>
                            </div>
                            <span class="text-[10px] font-semibold text-on-tertiary-container uppercase tracking-widest">Complété</span>
                        </div>

                        {{-- Étape 2 : Ajouter produit --}}
                        <div class="flex items-center gap-5 px-6 py-4 bg-secondary-fixed/10">
                            <div class="w-8 h-8 bg-secondary-container flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-secondary text-[18px]">inventory_2</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-primary">Ajoutez votre premier produit</p>
                                <p class="text-xs text-on-surface-variant mt-0.5">Photos, description, prix — votre vitrine commence ici.</p>
                            </div>
                            <a href="#" class="text-[10px] font-semibold text-secondary uppercase tracking-widest border-b border-secondary hover:text-primary hover:border-primary transition-colors whitespace-nowrap">
                                Commencer →
                            </a>
                        </div>

                        {{-- Étape 3 : Photo de couverture --}}
                        <div class="flex items-center gap-5 px-6 py-4 opacity-60">
                            <div class="w-8 h-8 bg-surface-container flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-outline text-[18px]">add_photo_alternate</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-primary">Photo de couverture de la boutique</p>
                                <p class="text-xs text-on-surface-variant mt-0.5">Une image éditoriale qui représente votre univers artisanal.</p>
                            </div>
                            <span class="text-[10px] text-on-surface-variant/50 uppercase tracking-widest">À faire</span>
                        </div>

                        {{-- Étape 4 : Coordonnées bancaires --}}
                        <div class="flex items-center gap-5 px-6 py-4 opacity-60">
                            <div class="w-8 h-8 bg-surface-container flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-outline text-[18px]">account_balance</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-primary">Coordonnées de paiement</p>
                                <p class="text-xs text-on-surface-variant mt-0.5">Mobile money ou virement bancaire pour recevoir vos revenus.</p>
                            </div>
                            <span class="text-[10px] text-on-surface-variant/50 uppercase tracking-widest">À faire</span>
                        </div>

                    </div>
                </div>

                {{-- Zone produits (vide pour l'instant) --}}
                <div class="bg-surface border border-outline-variant/30">
                    <div class="flex items-center justify-between px-6 pt-5 pb-4 border-b border-outline-variant/20">
                        <h3 class="font-bold text-primary uppercase tracking-widest text-xs">Mes Produits</h3>
                        <a href="#" class="text-[10px] text-secondary font-semibold uppercase tracking-widest hover:text-primary transition-colors">
                            Voir tout →
                        </a>
                    </div>

                    {{-- État vide --}}
                    <div class="py-16 flex flex-col items-center justify-center text-center px-8">
                        <div class="w-16 h-16 border border-dashed border-outline-variant flex items-center justify-center mb-5">
                            <span class="material-symbols-outlined text-3xl text-outline-variant">inventory_2</span>
                        </div>
                        <p class="font-semibold text-primary text-sm uppercase tracking-widest mb-2">Aucun produit pour l'instant</p>
                        <p class="text-xs text-on-surface-variant max-w-xs leading-relaxed mb-6">
                            Votre boutique est prête à recevoir vos créations artisanales. Présentez vos pièces uniques à notre clientèle de prestige.
                        </p>
                        <a href="#"
                           class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 text-xs font-semibold uppercase tracking-widest hover:bg-on-surface-variant transition-all">
                            <span class="material-symbols-outlined text-[16px]">add</span>
                            Ajouter mon premier produit
                        </a>
                    </div>
                </div>

            </div>

            {{-- COLONNE DROITE : Infos boutique + complétion profil --}}
            <div class="space-y-5 fade-up delay-3">

                {{-- Carte boutique --}}
                <div class="bg-surface border border-outline-variant/30 overflow-hidden">
                    <div class="h-24 bg-primary relative overflow-hidden">
                        <div class="absolute inset-0 opacity-10" style="background: repeating-linear-gradient(45deg, #735c00, #735c00 1px, transparent 1px, transparent 10px);"></div>
                        <div class="absolute bottom-4 left-5">
                            <span class="text-[10px] font-semibold text-secondary-fixed uppercase tracking-widest">Boutique Vérifiée</span>
                        </div>
                    </div>
                    <div class="px-5 pb-5">
                        <div class="flex items-end justify-between -mt-5 mb-4">
                            <div class="w-12 h-12 bg-secondary-fixed flex items-center justify-center border-2 border-surface">
                                <span class="text-primary text-base font-bold uppercase">
                                    {{ strtoupper(substr($application->shop_name ?? '', 0, 2)) }}
                                </span>
                            </div>
                            <a href="#" class="text-[10px] text-secondary font-semibold uppercase tracking-widest border-b border-secondary hover:text-primary hover:border-primary transition-colors">
                                Modifier
                            </a>
                        </div>
                        <h4 class="font-bold text-primary" style="font-family:'Playfair Display',serif;">
                            {{ $application->shop_name }}
                        </h4>
                        <p class="text-xs text-on-surface-variant mt-1">
                            {{ ucfirst($application->craft_type ?? 'Artisanat') }}
                        </p>
                        <p class="text-xs text-on-surface-variant mt-3 leading-relaxed line-clamp-3">
                            {{ $application->shop_story }}
                        </p>
                    </div>
                </div>

                {{-- Complétion du profil --}}
                <div class="bg-surface border border-outline-variant/30 p-5">
                    <div class="flex items-center justify-between mb-3">
                        <h4 class="text-xs font-bold text-primary uppercase tracking-widest">Profil Complété</h4>
                        <span class="text-xs font-bold text-secondary" id="completion-pct">25%</span>
                    </div>
                    <div class="h-1.5 bg-surface-container-highest overflow-hidden mb-4">
                        <div class="h-full bg-secondary profile-fill" style="width: 0%" id="completion-bar"></div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex items-center gap-2 text-xs">
                            <span class="material-symbols-outlined text-[14px] text-on-tertiary-container" style="font-variation-settings:'FILL' 1;">check_circle</span>
                            <span class="text-on-surface-variant">Informations de profil</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs">
                            <span class="material-symbols-outlined text-[14px] text-on-tertiary-container" style="font-variation-settings:'FILL' 1;">check_circle</span>
                            <span class="text-on-surface-variant">Configuration de boutique</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs opacity-50">
                            <span class="material-symbols-outlined text-[14px] text-outline">radio_button_unchecked</span>
                            <span class="text-on-surface-variant">Premier produit ajouté</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs opacity-50">
                            <span class="material-symbols-outlined text-[14px] text-outline">radio_button_unchecked</span>
                            <span class="text-on-surface-variant">Photo de couverture</span>
                        </div>
                    </div>
                </div>

                {{-- Infos pratiques --}}
                <div class="bg-surface border border-outline-variant/30 p-5 space-y-4">
                    <h4 class="text-xs font-bold text-primary uppercase tracking-widest">Informations</h4>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-[16px] text-secondary flex-shrink-0 mt-0.5">email</span>
                            <div>
                                <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Email</p>
                                <p class="text-xs text-primary font-semibold">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-[16px] text-secondary flex-shrink-0 mt-0.5">phone</span>
                            <div>
                                <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Téléphone</p>
                                <p class="text-xs text-primary font-semibold">{{ $application->phone ?? '—' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-[16px] text-secondary flex-shrink-0 mt-0.5">calendar_today</span>
                            <div>
                                <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Membre depuis</p>
                                <p class="text-xs text-primary font-semibold">{{ $application->reviewed_at?->format('d/m/Y') ?? $application->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-[16px] text-secondary flex-shrink-0 mt-0.5">category</span>
                            <div>
                                <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Domaine</p>
                                <p class="text-xs text-primary font-semibold">{{ $application->profile_type_label }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>

    {{-- Footer --}}
    <footer class="border-t border-outline-variant/30 px-8 py-4 flex items-center justify-between">
        <p class="text-[10px] text-on-surface-variant/50 uppercase tracking-widest">
            © 2024 L'Éclat du Bénin — Espace Artisan
        </p>
        <a href="#" class="text-[10px] text-on-surface-variant/50 hover:text-primary transition-colors uppercase tracking-widest">
            Aide & Support
        </a>
    </footer>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Animer la barre de complétion du profil (25% = 2 étapes sur 4)
    setTimeout(() => {
        document.getElementById('completion-bar').style.width = '25%';
    }, 600);
});
</script>

</body>
</html>
