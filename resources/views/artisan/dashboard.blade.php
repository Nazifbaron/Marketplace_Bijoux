@extends('layouts.artisan')

@section('title', 'Tableau de Bord')

@section('extra-styles')
    .profile-fill { transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1); }
@endsection

@section('content')

<header class="sticky top-0 z-40 bg-surface/80 backdrop-blur-xl border-b border-outline-variant/30 px-8 py-4 flex items-center justify-between">
    <div>
        <h2 class="font-bold text-primary" style="font-family:'Playfair Display',serif; font-size:20px;">Tableau de Bord</h2>
        <p class="text-xs text-on-surface-variant mt-0.5">{{ now()->isoFormat('dddd D MMMM YYYY') }} — Bienvenue, {{ auth()->user()->name }}</p>
    </div>
    <div class="flex items-center gap-4">
        <span class="badge-approved">
            <span class="material-symbols-outlined text-[12px]" style="font-variation-settings:'FILL' 1;">verified</span>
            Boutique Approuvée
        </span>
        <a href="{{ route('artisan.products.create') }}" class="flex items-center gap-2 bg-primary text-white px-5 py-2.5 text-xs font-semibold uppercase tracking-widest hover:bg-on-surface-variant transition-all">
            <span class="material-symbols-outlined text-[16px]">add</span>
            Ajouter un Produit
        </a>
    </div>
</header>

<main class="flex-1 p-8 space-y-8">

    @if(session('welcome'))
        <div class="fade-up p-5 border-l-4 border-on-tertiary-container bg-white flex items-start gap-4">
            <span class="material-symbols-outlined text-on-tertiary-container text-3xl flex-shrink-0" style="font-variation-settings:'FILL' 1;">celebration</span>
            <div class="flex-1">
                <p class="font-semibold text-primary">{{ session('welcome') }}</p>
                <p class="text-sm text-on-surface-variant mt-1">Votre boutique <strong>{{ $application->shop_name }}</strong> est active. Commencez par ajouter vos premiers produits.</p>
            </div>
        </div>
    @endif

    {{-- ── STATISTIQUES RÉELLES ── --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">

        <div class="stat-card bg-surface border border-outline-variant/30 p-6 fade-up">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-surface-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-secondary">inventory_2</span>
                </div>
                @if($stats['products_pending'] > 0)
                    <span class="text-[10px] text-secondary uppercase tracking-widest">{{ $stats['products_pending'] }} en revue</span>
                @endif
            </div>
            <p class="text-3xl font-bold text-primary">{{ $stats['products'] }}</p>
            <p class="text-xs text-on-surface-variant uppercase tracking-widest mt-1">Produits au total</p>
            <p class="text-[11px] text-on-tertiary-container mt-2">{{ $stats['products_published'] }} publié(s) · {{ $stats['products_verified'] }} vérifié(s)</p>
        </div>

        <div class="stat-card bg-surface border border-outline-variant/30 p-6 fade-up">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-surface-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-secondary">visibility</span>
                </div>
            </div>
            <p class="text-3xl font-bold text-primary">{{ number_format($stats['views']) }}</p>
            <p class="text-xs text-on-surface-variant uppercase tracking-widest mt-1">Vues cumulées</p>
        </div>

        <div class="stat-card bg-surface border border-outline-variant/30 p-6 fade-up">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 bg-surface-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-secondary">receipt_long</span>
                </div>
                @if($stats['orders_pending'] > 0)
                    <span class="text-[10px] bg-secondary-fixed text-primary font-bold px-2 py-0.5 rounded-full">{{ $stats['orders_pending'] }}</span>
                @endif
            </div>
            <p class="text-3xl font-bold text-primary">{{ $stats['orders'] }}</p>
            <p class="text-xs text-on-surface-variant uppercase tracking-widest mt-1">Commandes reçues</p>
        </div>

        <div class="stat-card bg-primary p-6 fade-up">
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- COLONNE PRINCIPALE --}}
        <div class="lg:col-span-2 space-y-5 fade-up">

            {{-- Produits récents --}}
            <div class="bg-surface border border-outline-variant/30">
                <div class="flex items-center justify-between px-6 pt-5 pb-4 border-b border-outline-variant/20">
                    <h3 class="font-bold text-primary uppercase tracking-widest text-xs">Produits Récents</h3>
                    <a href="{{ route('artisan.products.index') }}" class="text-[10px] text-secondary font-semibold uppercase tracking-widest hover:text-primary transition-colors">Voir tout →</a>
                </div>

                @if($recentProducts->isEmpty())
                    <div class="py-16 flex flex-col items-center justify-center text-center px-8">
                        <div class="w-16 h-16 border border-dashed border-outline-variant flex items-center justify-center mb-5">
                            <span class="material-symbols-outlined text-3xl text-outline-variant">inventory_2</span>
                        </div>
                        <p class="font-semibold text-primary text-sm uppercase tracking-widest mb-2">Aucun produit pour l'instant</p>
                        <p class="text-xs text-on-surface-variant max-w-xs leading-relaxed mb-6">Présentez vos pièces uniques à notre clientèle de prestige.</p>
                        <a href="{{ route('artisan.products.create') }}" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 text-xs font-semibold uppercase tracking-widest hover:bg-on-surface-variant transition-all">
                            <span class="material-symbols-outlined text-[16px]">add</span> Ajouter mon premier produit
                        </a>
                    </div>
                @else
                    <div class="divide-y divide-outline-variant/20">
                        @foreach($recentProducts as $p)
                            <div class="flex items-center gap-4 px-6 py-4">
                                @php $img = $p->images->first(); @endphp
                                @if($img)
                                    <img src="{{ $img->url }}" class="w-12 h-12 object-cover flex-shrink-0" />
                                @else
                                    <div class="w-12 h-12 bg-surface-container flex items-center justify-center flex-shrink-0">
                                        <span class="material-symbols-outlined text-outline-variant text-[18px]">image</span>
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-primary truncate">{{ $p->name }}</p>
                                    <p class="text-xs text-on-surface-variant">{{ $p->formatted_price }}</p>
                                </div>
                                @if($p->moderation_status === 'published')
                                    <span class="badge-approved">Publié</span>
                                @elseif($p->moderation_status === 'pending_review')
                                    <span class="badge-pending">En revue</span>
                                @else
                                    <span class="badge-rejected">Rejeté</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Commandes récentes --}}
            <div class="bg-surface border border-outline-variant/30">
                <div class="flex items-center justify-between px-6 pt-5 pb-4 border-b border-outline-variant/20">
                    <h3 class="font-bold text-primary uppercase tracking-widest text-xs">Commandes Récentes</h3>
                    <a href="{{ route('artisan.orders.index') }}" class="text-[10px] text-secondary font-semibold uppercase tracking-widest hover:text-primary transition-colors">Voir tout →</a>
                </div>
                @if($recentOrders->isEmpty())
                    <div class="py-12 text-center">
                        <p class="text-xs text-on-surface-variant">Aucune commande pour l'instant.</p>
                    </div>
                @else
                    <div class="divide-y divide-outline-variant/20">
                        @foreach($recentOrders as $item)
                            <div class="flex items-center justify-between px-6 py-4">
                                <div>
                                    <p class="text-sm font-semibold text-primary">{{ $item->product_name_snapshot }}</p>
                                    <p class="text-xs text-on-surface-variant">{{ $item->order->buyer->name }} · {{ $item->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="text-sm font-semibold text-secondary">{{ number_format($item->subtotal, 0, ',', '.') }} CFA</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        {{-- COLONNE LATÉRALE --}}
        <div class="space-y-5 fade-up">

            {{-- Messages récents --}}
            <div class="bg-surface border border-outline-variant/30 p-5">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-xs font-bold text-primary uppercase tracking-widest">Messagerie</h4>
                    <a href="{{ route('chat.index') }}" class="text-[10px] text-secondary font-semibold uppercase tracking-widest">Tout voir</a>
                </div>
                @if($recentConversations->isEmpty())
                    <p class="text-xs text-on-surface-variant">Aucune conversation pour l'instant.</p>
                @else
                    <div class="space-y-3">
                        @foreach($recentConversations as $conv)
                            <a href="{{ route('chat.show', $conv) }}" class="flex items-center gap-3 hover:bg-surface-container-low p-2 -mx-2 transition-colors">
                                <div class="w-8 h-8 bg-primary flex items-center justify-center flex-shrink-0">
                                    <span class="text-white text-[10px] font-bold uppercase">{{ strtoupper(substr($conv->buyer->name, 0, 2)) }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold text-primary truncate">{{ $conv->buyer->name }}</p>
                                    <p class="text-[11px] text-on-surface-variant truncate">{{ $conv->latestMessage->body ?? '' }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Complétion profil --}}
            <div class="bg-surface border border-outline-variant/30 p-5">
                <div class="flex items-center justify-between mb-3">
                    <h4 class="text-xs font-bold text-primary uppercase tracking-widest">Profil Complété</h4>
                    <span class="text-xs font-bold text-secondary">{{ $completionPct }}%</span>
                </div>
                <div class="h-1.5 bg-surface-container-highest overflow-hidden mb-4">
                    <div class="h-full bg-secondary profile-fill" style="width: 0%" id="completion-bar" data-pct="{{ $completionPct }}"></div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-xs">
                        <span class="material-symbols-outlined text-[14px] text-on-tertiary-container" style="font-variation-settings:'FILL' 1;">check_circle</span>
                        <span class="text-on-surface-variant">Boutique configurée</span>
                    </div>
                    <div class="flex items-center gap-2 text-xs {{ $stats['products'] > 0 ? '' : 'opacity-50' }}">
                        <span class="material-symbols-outlined text-[14px] {{ $stats['products'] > 0 ? 'text-on-tertiary-container' : 'text-outline' }}" style="{{ $stats['products'] > 0 ? "font-variation-settings:'FILL' 1;" : '' }}">
                            {{ $stats['products'] > 0 ? 'check_circle' : 'radio_button_unchecked' }}
                        </span>
                        <span class="text-on-surface-variant">Premier produit ajouté</span>
                    </div>
                </div>
            </div>

            {{-- Infos --}}
            <div class="bg-surface border border-outline-variant/30 p-5 space-y-4">
                <h4 class="text-xs font-bold text-primary uppercase tracking-widest">Informations</h4>
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-[16px] text-secondary flex-shrink-0 mt-0.5">email</span>
                    <div>
                        <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Email</p>
                        <p class="text-xs text-primary font-semibold">{{ auth()->user()->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection

@section('extra-scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const bar = document.getElementById('completion-bar');
    setTimeout(() => { bar.style.width = bar.dataset.pct + '%'; }, 600);
});
</script>
@endsection
