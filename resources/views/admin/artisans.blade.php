<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin — Gestion des Artisans | L'Éclat du Bénin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            theme: { extend: {
                colors: {
                    "primary":"#000000","secondary":"#735c00","background":"#faf9f6",
                    "surface":"#ffffff","surface-container":"#efeeeb","surface-container-low":"#f4f3f1",
                    "outline-variant":"#c4c7c7","on-surface-variant":"#444748","on-surface":"#1a1c1a",
                    "secondary-container":"#fed65b","secondary-fixed":"#ffe088","on-secondary":"#ffffff",
                    "error":"#ba1a1a","error-container":"#ffdad6","on-tertiary-container":"#5e8e77",
                    "outline":"#747878",
                },
                fontFamily: { "sans":["Montserrat","sans-serif"] }
            }}
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24; }

        /* Badge de statut */
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 2px 10px; font-size: 10px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; border-radius: 2px; }
        .badge-pending  { background: #fff8e1; color: #735c00; border: 1px solid #ffe088; }
        .badge-approved { background: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; }
        .badge-rejected { background: #ffdad6; color: #ba1a1a; border: 1px solid #ffb4ab; }
        .badge-draft    { background: #f0f0f0; color: #444748; border: 1px solid #c4c7c7; }

        /* Modale */
        .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 100; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .modal-overlay.hidden { display: none; }

        @keyframes slideIn { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
        .modal-box { animation: slideIn 0.2s ease; }
    </style>
</head>
<body class="bg-background text-on-surface min-h-screen">

{{-- ===== SIDEBAR ADMIN ===== --}}
<aside class="fixed left-0 top-0 h-full w-64 bg-primary text-white z-50 flex flex-col">
    <div class="p-6 border-b border-white/10">
        <h1 class="font-bold text-sm uppercase tracking-widest leading-tight">L'ÉCLAT DU BÉNIN</h1>
        <p class="text-white/40 text-xs mt-1 tracking-widest uppercase">Administration</p>
    </div>
    <nav class="flex-1 p-4 space-y-1">
        <a href="{{ route('admin.artisans.index') }}"
           class="flex items-center gap-3 px-4 py-3 text-sm font-medium {{ request()->routeIs('admin.artisans.*') ? 'bg-white/10 text-white' : 'text-white/60 hover:text-white hover:bg-white/5' }} transition-all">
            <span class="material-symbols-outlined text-[20px]">storefront</span>
            Artisans
            @if(($counts['pending_review'] ?? 0) > 0)
                <span class="ml-auto bg-secondary-container text-secondary text-[10px] font-bold px-2 py-0.5 rounded-full">
                    {{ $counts['pending_review'] }}
                </span>
            @endif
        </a>
        <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-white/60 hover:text-white hover:bg-white/5 transition-all">
            <span class="material-symbols-outlined text-[20px]">people</span>
            Utilisateurs
        </a>
        <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-white/60 hover:text-white hover:bg-white/5 transition-all">
            <span class="material-symbols-outlined text-[20px]">analytics</span>
            Statistiques
        </a>
        <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-white/60 hover:text-white hover:bg-white/5 transition-all">
            <span class="material-symbols-outlined text-[20px]">settings</span>
            Paramètres
        </a>
    </nav>
    <div class="p-4 border-t border-white/10">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-white/10 rounded-full flex items-center justify-center">
                <span class="material-symbols-outlined text-[18px]">person</span>
            </div>
            <div>
                <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                <p class="text-xs text-white/40">Administrateur</p>
            </div>
        </div>
    </div>
</aside>

{{-- ===== CONTENU PRINCIPAL ===== --}}
<div class="ml-64">

    {{-- ─── TOPBAR ─── --}}
    <header class="bg-surface border-b border-outline-variant/30 px-8 py-5 flex items-center justify-between sticky top-0 z-40">
        <div>
            <h2 class="text-xl font-bold text-primary font-serif">Gestion des Artisans</h2>
            <p class="text-sm text-on-surface-variant mt-0.5">Examinez et traitez les demandes d'adhésion</p>
        </div>
        <div class="flex items-center gap-4">
            <span class="text-sm text-on-surface-variant">{{ now()->format('d/m/Y') }}</span>
        </div>
    </header>

    <main class="p-8">

        {{-- ─── MESSAGES FLASH ─── --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 flex items-center gap-3">
                <span class="material-symbols-outlined text-green-600" style="font-variation-settings:'FILL' 1;">check_circle</span>
                <p class="text-sm text-green-800">{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 flex items-center gap-3">
                <span class="material-symbols-outlined text-red-600">error</span>
                <p class="text-sm text-red-800">{{ session('error') }}</p>
            </div>
        @endif

        {{-- ─── CARTES DE STATISTIQUES ─── --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-surface p-6 border border-outline-variant/30">
                <p class="text-xs text-on-surface-variant uppercase tracking-widest">Total</p>
                <p class="text-3xl font-bold text-primary mt-2">{{ $counts['all'] }}</p>
            </div>
            <div class="bg-surface p-6 border border-outline-variant/30">
                <p class="text-xs text-secondary uppercase tracking-widest">En attente</p>
                <p class="text-3xl font-bold text-secondary mt-2">{{ $counts['pending_review'] }}</p>
            </div>
            <div class="bg-surface p-6 border border-outline-variant/30">
                <p class="text-xs text-green-700 uppercase tracking-widest">Approuvés</p>
                <p class="text-3xl font-bold text-green-700 mt-2">{{ $counts['approved'] }}</p>
            </div>
            <div class="bg-surface p-6 border border-outline-variant/30">
                <p class="text-xs text-error uppercase tracking-widest">Refusés</p>
                <p class="text-3xl font-bold text-error mt-2">{{ $counts['rejected'] }}</p>
            </div>
        </div>

        {{-- ─── ONGLETS DE FILTRE ─── --}}
        <div class="flex gap-1 mb-6 border-b border-outline-variant/30">
            @foreach([
                ['value' => 'pending_review', 'label' => 'En attente', 'count' => $counts['pending_review']],
                ['value' => 'approved',       'label' => 'Approuvés',  'count' => $counts['approved']],
                ['value' => 'rejected',       'label' => 'Refusés',    'count' => $counts['rejected']],
                ['value' => 'all',            'label' => 'Tous',       'count' => $counts['all']],
            ] as $tab)
                <a href="{{ route('admin.artisans.index', ['status' => $tab['value']]) }}"
                   class="px-6 py-3 text-sm font-medium transition-all {{ $status === $tab['value'] ? 'border-b-2 border-primary text-primary' : 'text-on-surface-variant hover:text-primary' }}">
                    {{ $tab['label'] }}
                    <span class="ml-2 text-xs bg-surface-container px-2 py-0.5 rounded-full">{{ $tab['count'] }}</span>
                </a>
            @endforeach
        </div>

        {{-- ─── TABLEAU DES DEMANDES ─── --}}
        <div class="bg-surface border border-outline-variant/30 overflow-hidden">

            @if($applications->isEmpty())
                <div class="py-20 text-center">
                    <span class="material-symbols-outlined text-6xl text-outline-variant block mb-4">inbox</span>
                    <p class="text-on-surface-variant">Aucune demande dans cette catégorie.</p>
                </div>
            @else
                <table class="w-full">
                    <thead class="bg-surface-container border-b border-outline-variant/30">
                        <tr>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">#</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Artisan</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Boutique</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Type</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Soumis le</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Statut</th>
                            <th class="text-center px-6 py-4 text-xs font-semibold text-on-surface-variant uppercase tracking-widest">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/20">
                        @foreach($applications as $app)
                        <tr class="hover:bg-surface-container/40 transition-colors">
                            <td class="px-6 py-4 text-sm text-on-surface-variant">#{{ $app->id }}</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-sm text-primary">{{ $app->full_name }}</p>
                                    <p class="text-xs text-on-surface-variant">{{ $app->user->email }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-on-surface">
                                {{ $app->shop_name ?? '—' }}
                            </td>
                            <td class="px-6 py-4 text-xs text-on-surface-variant">
                                {{ $app->profile_type_label }}
                            </td>
                            <td class="px-6 py-4 text-sm text-on-surface-variant">
                                {{ $app->updated_at->format('d/m/Y') }}<br>
                                <span class="text-xs text-on-surface-variant/60">{{ $app->updated_at->format('H:i') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($app->status === 'pending_review')
                                    <span class="badge badge-pending">
                                        <span class="material-symbols-outlined text-[12px]">schedule</span> En attente
                                    </span>
                                @elseif($app->status === 'approved')
                                    <span class="badge badge-approved">
                                        <span class="material-symbols-outlined text-[12px]" style="font-variation-settings:'FILL' 1;">check_circle</span> Approuvé
                                    </span>
                                @elseif($app->status === 'rejected')
                                    <span class="badge badge-rejected">
                                        <span class="material-symbols-outlined text-[12px]">cancel</span> Refusé
                                    </span>
                                @else
                                    <span class="badge badge-draft">Brouillon</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                            {{-- Voir le détail --}}
                                    <button
                                        onclick="openDetailModal({{ json_encode([
                                            'id'              => $app->id,
                                            'name'            => $app->full_name,
                                            'email'           => $app->user->email,
                                            'phone'           => $app->phone,
                                            'type'            => $app->profile_type_label,
                                            'date'            => $app->updated_at->format('d/m/Y à H:i'),
                                            'shop'            => $app->shop_name,
                                            'craft'           => $app->craft_type,
                                            'story'           => $app->shop_story,
                                            'status'          => $app->status,
                                            'hasIdentity'     => !empty($app->id_document_path),
                                            'hasCertification'=> !empty($app->certification_path),
                                        ]) }})"
                                        class="p-2 text-on-surface-variant hover:text-primary hover:bg-surface-container transition-all"
                                        title="Voir le dossier complet"
                                    >
                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                    </button>

                                    @if($app->isPendingReview())
                                        {{-- Approuver --}}
                                        <button
                                            onclick="openApproveModal({{ $app->id }}, '{{ addslashes($app->full_name) }}')"
                                            class="p-2 text-green-600 hover:bg-green-50 transition-all"
                                            title="Approuver"
                                        >
                                            <span class="material-symbols-outlined text-[20px]">check_circle</span>
                                        </button>

                                        {{-- Rejeter --}}
                                        <button
                                            onclick="openRejectModal({{ $app->id }}, '{{ addslashes($app->full_name) }}')"
                                            class="p-2 text-error hover:bg-error-container/40 transition-all"
                                            title="Rejeter"
                                        >
                                            <span class="material-symbols-outlined text-[20px]">cancel</span>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                @if($applications->hasPages())
                    <div class="px-6 py-4 border-t border-outline-variant/30">
                        {{ $applications->appends(['status' => $status])->links() }}
                    </div>
                @endif
            @endif
        </div>

    </main>
</div>

{{-- ================================================================
     MODALE : DOSSIER COMPLET AVEC VIEWER DE DOCUMENTS
     Grande modale plein écran divisée en 2 colonnes :
     - Gauche  : informations du dossier
     - Droite  : viewer de documents (image ou PDF inline)
     ================================================================ --}}
<div class="modal-overlay hidden" id="detail-modal" style="align-items: flex-start; padding: 24px;">
    <div class="modal-box bg-surface w-full flex flex-col" style="max-width: 1100px; max-height: calc(100vh - 48px); overflow: hidden;">

        {{-- ── EN-TÊTE DE LA MODALE ── --}}
        <div class="flex items-center justify-between px-8 py-5 border-b border-outline-variant/30 flex-shrink-0">
            <div class="flex items-center gap-4">
                {{-- Avatar initiales --}}
                <div class="w-10 h-10 bg-primary flex items-center justify-center flex-shrink-0">
                    <span class="text-white text-sm font-bold uppercase" id="detail-initials">—</span>
                </div>
                <div>
                    <h3 class="font-bold text-primary" style="font-family:'Playfair Display',serif; font-size:18px;" id="detail-name">—</h3>
                    <div class="flex items-center gap-3 mt-0.5">
                        <span class="text-xs text-on-surface-variant" id="detail-email">—</span>
                        <span id="detail-status-badge">—</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                {{-- Boutons d'action rapide DANS la modale --}}
                <button id="modal-approve-btn"
                    onclick="triggerApproveFromDetail()"
                    class="hidden items-center gap-2 px-4 py-2 bg-green-700 text-white text-xs font-semibold uppercase tracking-widest hover:bg-green-800 transition-all">
                    <span class="material-symbols-outlined text-[16px]" style="font-variation-settings:'FILL' 1;">check_circle</span>
                    Approuver
                </button>
                <button id="modal-reject-btn"
                    onclick="triggerRejectFromDetail()"
                    class="hidden items-center gap-2 px-4 py-2 bg-error text-white text-xs font-semibold uppercase tracking-widest hover:bg-red-800 transition-all">
                    <span class="material-symbols-outlined text-[16px]">cancel</span>
                    Rejeter
                </button>
                <button onclick="closeModal('detail-modal')" class="p-2 text-on-surface-variant hover:text-primary hover:bg-surface-container transition-all">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
        </div>

        {{-- ── CORPS : 2 COLONNES ── --}}
        <div class="flex flex-1 overflow-hidden">

            {{-- COLONNE GAUCHE : Informations du dossier --}}
            <div class="w-80 flex-shrink-0 border-r border-outline-variant/30 overflow-y-auto p-6 space-y-6">

                {{-- Section : Identité --}}
                <div>
                    <p class="text-[10px] font-semibold uppercase tracking-widest text-secondary mb-3 border-b border-outline-variant/30 pb-2">
                        Informations Personnelles
                    </p>
                    <div class="space-y-3">
                        <div>
                            <span class="text-[10px] text-on-surface-variant uppercase tracking-widest block">Nom complet</span>
                            <span class="text-sm font-semibold text-primary" id="info-name">—</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-on-surface-variant uppercase tracking-widest block">Email</span>
                            <span class="text-sm text-on-surface" id="info-email">—</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-on-surface-variant uppercase tracking-widest block">Téléphone</span>
                            <span class="text-sm text-on-surface" id="info-phone">—</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-on-surface-variant uppercase tracking-widest block">Type de profil</span>
                            <span class="text-sm text-on-surface" id="info-type">—</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-on-surface-variant uppercase tracking-widest block">Date de soumission</span>
                            <span class="text-sm text-on-surface" id="info-date">—</span>
                        </div>
                    </div>
                </div>

                {{-- Section : Boutique --}}
                <div>
                    <p class="text-[10px] font-semibold uppercase tracking-widest text-secondary mb-3 border-b border-outline-variant/30 pb-2">
                        Boutique
                    </p>
                    <div class="space-y-3">
                        <div>
                            <span class="text-[10px] text-on-surface-variant uppercase tracking-widest block">Nom de la boutique</span>
                            <span class="text-sm font-semibold text-primary" id="info-shop">—</span>
                        </div>
                        <div>
                            <span class="text-[10px] text-on-surface-variant uppercase tracking-widest block">Domaine artisanal</span>
                            <span class="text-sm text-on-surface" id="info-craft">—</span>
                        </div>
                    </div>
                </div>

                {{-- Section : Histoire --}}
                <div>
                    <p class="text-[10px] font-semibold uppercase tracking-widest text-secondary mb-3 border-b border-outline-variant/30 pb-2">
                        Histoire de la Maison
                    </p>
                    <p class="text-sm text-on-surface-variant leading-relaxed" id="info-story">—</p>
                </div>

                {{-- Section : Documents (liste de navigation) --}}
                <div>
                    <p class="text-[10px] font-semibold uppercase tracking-widest text-secondary mb-3 border-b border-outline-variant/30 pb-2">
                        Documents Soumis
                    </p>
                    <div class="space-y-2">
                        {{-- Bouton document identité --}}
                        <button
                            id="doc-btn-identity"
                            onclick="loadDocument('identity')"
                            class="w-full flex items-center gap-3 px-3 py-3 border border-outline-variant/30 hover:border-secondary hover:bg-surface-container-low transition-all text-left group"
                        >
                            <span class="material-symbols-outlined text-[20px] text-outline group-hover:text-secondary transition-colors" id="doc-icon-identity">picture_as_pdf</span>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-primary uppercase tracking-widest">Pièce d'Identité</p>
                                <p class="text-[10px] text-on-surface-variant mt-0.5" id="doc-status-identity">Chargement...</p>
                            </div>
                            <span class="material-symbols-outlined text-[16px] text-outline-variant group-hover:text-secondary transition-colors">chevron_right</span>
                        </button>

                        {{-- Bouton document certification --}}
                        <button
                            id="doc-btn-certification"
                            onclick="loadDocument('certification')"
                            class="w-full flex items-center gap-3 px-3 py-3 border border-outline-variant/30 hover:border-secondary hover:bg-surface-container-low transition-all text-left group"
                        >
                            <span class="material-symbols-outlined text-[20px] text-outline group-hover:text-secondary transition-colors" id="doc-icon-certification">verified_user</span>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-primary uppercase tracking-widest">Certification</p>
                                <p class="text-[10px] text-on-surface-variant mt-0.5" id="doc-status-certification">Chargement...</p>
                            </div>
                            <span class="material-symbols-outlined text-[16px] text-outline-variant group-hover:text-secondary transition-colors">chevron_right</span>
                        </button>
                    </div>
                </div>

            </div>

            {{-- COLONNE DROITE : Viewer de document --}}
            <div class="flex-1 flex flex-col overflow-hidden bg-surface-container/40">

                {{-- Barre d'outils du viewer --}}
                <div class="flex items-center justify-between px-6 py-3 bg-surface border-b border-outline-variant/30 flex-shrink-0">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-secondary" id="viewer-icon">description</span>
                        <span class="text-xs font-semibold text-primary uppercase tracking-widest" id="viewer-title">Sélectionnez un document</span>
                    </div>
                    <div class="flex items-center gap-2">
                        {{-- Ouvrir dans un nouvel onglet --}}
                        <a
                            id="viewer-open-btn"
                            href="#"
                            target="_blank"
                            class="hidden items-center gap-1.5 px-3 py-1.5 border border-outline-variant text-xs text-on-surface-variant hover:text-primary hover:border-primary transition-all"
                        >
                            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
                            Ouvrir dans un onglet
                        </a>
                        {{-- Télécharger --}}
                        <a
                            id="viewer-download-btn"
                            href="#"
                            download
                            class="hidden items-center gap-1.5 px-3 py-1.5 bg-primary text-white text-xs font-semibold uppercase tracking-widest hover:bg-on-surface-variant transition-all"
                        >
                            <span class="material-symbols-outlined text-[14px]">download</span>
                            Télécharger
                        </a>
                    </div>
                </div>

                {{-- Zone d'affichage du document --}}
                <div class="flex-1 overflow-hidden relative" id="viewer-area">

                    {{-- État initial : invitation à choisir un document --}}
                    <div id="viewer-placeholder" class="absolute inset-0 flex flex-col items-center justify-center text-center p-8">
                        <div class="w-20 h-20 border border-dashed border-outline-variant flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-4xl text-outline-variant">folder_open</span>
                        </div>
                        <p class="text-sm font-semibold text-primary uppercase tracking-widest mb-2">Aucun document sélectionné</p>
                        <p class="text-xs text-on-surface-variant">Cliquez sur un document dans la liste de gauche pour le visualiser ici.</p>
                    </div>

                    {{-- État chargement --}}
                    <div id="viewer-loading" class="hidden absolute inset-0 flex flex-col items-center justify-center">
                        <div class="w-8 h-8 border-2 border-secondary border-t-transparent rounded-full mb-4" style="animation: spin 0.8s linear infinite;"></div>
                        <p class="text-xs text-on-surface-variant uppercase tracking-widest">Chargement du document...</p>
                    </div>

                    {{-- Erreur --}}
                    <div id="viewer-error" class="hidden absolute inset-0 flex flex-col items-center justify-center text-center p-8">
                        <span class="material-symbols-outlined text-4xl text-error mb-4">error_outline</span>
                        <p class="text-sm font-semibold text-error uppercase tracking-widest mb-2">Document introuvable</p>
                        <p class="text-xs text-on-surface-variant" id="viewer-error-msg">Ce document n'a pas été soumis par l'artisan.</p>
                    </div>

                    {{-- Image viewer --}}
                    <div id="viewer-image-container" class="hidden absolute inset-0 overflow-auto flex items-center justify-center p-4">
                        <img
                            id="viewer-image"
                            src=""
                            alt="Document"
                            class="max-w-full max-h-full object-contain shadow-lg"
                            style="image-rendering: high-quality;"
                        />
                    </div>

                    {{-- PDF viewer (iframe) --}}
                    <iframe
                        id="viewer-pdf"
                        src=""
                        class="hidden absolute inset-0 w-full h-full border-0"
                        title="Visualisation PDF"
                    ></iframe>

                </div>

                {{-- Barre de bas : filigrane sécurité --}}
                <div class="px-6 py-2 bg-surface border-t border-outline-variant/20 flex items-center gap-2 flex-shrink-0">
                    <span class="material-symbols-outlined text-[14px] text-on-surface-variant/40" style="font-variation-settings:'FILL' 1;">lock</span>
                    <p class="text-[10px] text-on-surface-variant/40 uppercase tracking-widest">
                        Document confidentiel — Accès réservé aux administrateurs — L'Éclat du Bénin
                    </p>
                </div>

            </div>
        </div>

    </div>
</div>

{{-- ================================================================
     MODALE : APPROUVER
     ================================================================ --}}
<div class="modal-overlay hidden" id="approve-modal">
    <div class="modal-box bg-surface w-full max-w-md p-8">
        <div class="text-center mb-6">
            <span class="material-symbols-outlined text-5xl text-green-600 block mb-4" style="font-variation-settings:'FILL' 1;">check_circle</span>
            <h3 class="text-lg font-bold text-primary">Approuver la candidature</h3>
            <p class="text-sm text-on-surface-variant mt-2">
                Vous allez approuver la demande de <strong id="approve-name">—</strong>.
            </p>
        </div>

        {{--
            Le formulaire d'approbation utilise POST vers la route d'approbation.
            L'ID est dynamiquement injecté dans l'action via JavaScript.
        --}}
        <form method="POST" id="approve-form">
            @csrf
            <div class="mb-6">
                <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">
                    Message de bienvenue <span class="font-normal">(optionnel)</span>
                </label>
                <textarea
                    name="admin_notes"
                    rows="3"
                    placeholder="Félicitations ! Votre maison artisanale est maintenant..."
                    class="w-full border border-outline-variant px-4 py-3 text-sm focus:outline-none focus:border-secondary resize-none"
                ></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeModal('approve-modal')"
                    class="flex-1 py-3 border border-outline-variant text-sm text-on-surface-variant hover:text-primary transition-all">
                    Annuler
                </button>
                <button type="submit"
                    class="flex-1 py-3 bg-green-700 text-white text-sm font-semibold uppercase tracking-widest hover:bg-green-800 transition-all">
                    Confirmer l'approbation
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ================================================================
     MODALE : REJETER
     ================================================================ --}}
<div class="modal-overlay hidden" id="reject-modal">
    <div class="modal-box bg-surface w-full max-w-md p-8">
        <div class="text-center mb-6">
            <span class="material-symbols-outlined text-5xl text-error block mb-4">cancel</span>
            <h3 class="text-lg font-bold text-primary">Rejeter la candidature</h3>
            <p class="text-sm text-on-surface-variant mt-2">
                Vous allez refuser la demande de <strong id="reject-name">—</strong>.
            </p>
        </div>

        <form method="POST" id="reject-form">
            @csrf
            <div class="mb-6">
                <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">
                    Motif du refus <span class="text-error">*</span>
                </label>
                <textarea
                    name="admin_notes"
                    rows="4"
                    required
                    placeholder="Expliquez la raison du refus (documents manquants, critères non remplis...)"
                    class="w-full border border-outline-variant px-4 py-3 text-sm focus:outline-none focus:border-error resize-none"
                    id="reject-notes"
                ></textarea>
                <p class="text-xs text-on-surface-variant mt-1">Ce message sera communiqué à l'artisan.</p>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeModal('reject-modal')"
                    class="flex-1 py-3 border border-outline-variant text-sm text-on-surface-variant hover:text-primary transition-all">
                    Annuler
                </button>
                <button type="submit"
                    class="flex-1 py-3 bg-error text-white text-sm font-semibold uppercase tracking-widest hover:bg-red-800 transition-all">
                    Confirmer le refus
                </button>
            </div>
        </form>
    </div>
</div>

<script>
/**
 * JAVASCRIPT DU PANNEAU ADMIN — VERSION AVEC VIEWER DE DOCUMENTS
 * ================================================================
 *
 * COMMENT ÇA MARCHE :
 *
 * 1. openDetailModal() est appelée depuis le bouton "Voir" du tableau.
 *    Elle reçoit toutes les données de l'artisan en paramètre
 *    (encodées en JSON par Blade côté serveur) et les injecte
 *    dans la modale.
 *
 * 2. loadDocument(type) est appelée quand l'admin clique sur
 *    "Pièce d'Identité" ou "Certification" dans la colonne gauche.
 *    Elle construit l'URL sécurisée via la route admin.artisans.document,
 *    puis :
 *      - Si c'est une image → affiche dans une balise <img>
 *      - Si c'est un PDF    → charge dans une <iframe>
 *      - Si pas de document → affiche l'état d'erreur
 *
 * 3. triggerApproveFromDetail() / triggerRejectFromDetail() permettent
 *    d'approuver/rejeter directement depuis la grande modale de dossier,
 *    sans avoir à la fermer d'abord.
 */

// Variables globales pour l'artisan actuellement affiché
let currentAppId     = null;
let currentAppName   = null;
let currentAppStatus = null;
let hasIdentity      = false;
let hasCertification = false;

// ─── OUVRIR LA MODALE DE DOSSIER ───────────────────────────────────────────

/**
 * Appelée depuis le bouton "Voir" dans le tableau.
 * Reçoit un objet JSON avec toutes les données de l'artisan.
 *
 * @param {Object} data - Les données de l'artisan (voir l'appel dans le tableau)
 */
function openDetailModal(data) {
    // Mémoriser l'artisan courant pour les actions d'approbation/rejet
    currentAppId     = data.id;
    currentAppName   = data.name;
    currentAppStatus = data.status;
    hasIdentity      = data.hasIdentity;
    hasCertification = data.hasCertification;

    // ── Remplir l'en-tête ──
    const initials = data.name.split(' ').map(w => w[0]).join('').substring(0, 2).toUpperCase();
    document.getElementById('detail-initials').textContent = initials;
    document.getElementById('detail-name').textContent     = data.name;
    document.getElementById('detail-email').textContent    = data.email;

    // Badge de statut dans l'en-tête
    const statusBadgeEl = document.getElementById('detail-status-badge');
    const statusMap = {
        'pending_review': '<span class="badge badge-pending">En attente</span>',
        'approved':       '<span class="badge badge-approved">Approuvé</span>',
        'rejected':       '<span class="badge badge-rejected">Refusé</span>',
        'draft':          '<span class="badge badge-draft">Brouillon</span>',
    };
    statusBadgeEl.innerHTML = statusMap[data.status] || '';

    // ── Remplir la colonne gauche ──
    document.getElementById('info-name').textContent  = data.name;
    document.getElementById('info-email').textContent = data.email;
    document.getElementById('info-phone').textContent = data.phone  || '—';
    document.getElementById('info-type').textContent  = data.type   || '—';
    document.getElementById('info-date').textContent  = data.date   || '—';
    document.getElementById('info-shop').textContent  = data.shop   || '—';
    document.getElementById('info-craft').textContent = data.craft  || '—';
    document.getElementById('info-story').textContent = data.story  || 'Aucune description fournie.';

    // ── État des boutons de documents ──
    updateDocButton('identity',      hasIdentity);
    updateDocButton('certification', hasCertification);

    // ── Afficher/masquer les boutons Approuver/Rejeter ──
    const approveBtn = document.getElementById('modal-approve-btn');
    const rejectBtn  = document.getElementById('modal-reject-btn');
    if (data.status === 'pending_review') {
        approveBtn.classList.remove('hidden');
        approveBtn.classList.add('flex');
        rejectBtn.classList.remove('hidden');
        rejectBtn.classList.add('flex');
    } else {
        approveBtn.classList.add('hidden');
        rejectBtn.classList.add('hidden');
    }

    // ── Réinitialiser le viewer ──
    resetViewer();

    // ── Ouvrir la modale ──
    document.getElementById('detail-modal').classList.remove('hidden');

    // Auto-charger la pièce d'identité si elle existe
    if (hasIdentity) {
        setTimeout(() => loadDocument('identity'), 300);
    }
}

/**
 * Met à jour l'apparence d'un bouton de document selon qu'il existe ou non
 */
function updateDocButton(type, exists) {
    const statusEl = document.getElementById(`doc-status-${type}`);
    const iconEl   = document.getElementById(`doc-icon-${type}`);
    const btn      = document.getElementById(`doc-btn-${type}`);

    if (exists) {
        statusEl.textContent  = 'Document disponible — Cliquez pour visualiser';
        statusEl.style.color  = '#5e8e77';
        iconEl.style.color    = '#5e8e77';
        btn.style.opacity     = '1';
        btn.style.cursor      = 'pointer';
    } else {
        statusEl.textContent  = 'Non soumis par l\'artisan';
        statusEl.style.color  = '#ba1a1a';
        iconEl.style.color    = '#ba1a1a';
        btn.style.opacity     = '0.5';
        btn.style.cursor      = 'not-allowed';
    }
}

// ─── CHARGER UN DOCUMENT DANS LE VIEWER ────────────────────────────────────

/**
 * Charge et affiche un document dans la colonne droite de la modale.
 *
 * @param {string} type - 'identity' ou 'certification'
 */
function loadDocument(type) {
    // Vérifier que le document existe
    const exists = type === 'identity' ? hasIdentity : hasCertification;
    if (!exists) return;

    // Construire l'URL de la route sécurisée
    // Route : GET /admin/artisans/{id}/document/{type}
    const url = `/admin/artisans/${currentAppId}/document/${type}`;

    // Mettre à jour le titre du viewer
    const titles = {
        identity:      { label: 'Pièce d\'Identité', icon: 'picture_as_pdf' },
        certification: { label: 'Certification Artisanale', icon: 'verified_user' },
    };
    document.getElementById('viewer-title').textContent     = titles[type].label;
    document.getElementById('viewer-icon').textContent      = titles[type].icon;

    // Afficher le loader, masquer le reste
    showViewerState('loading');

    // Surligner le bouton actif dans la liste
    ['identity', 'certification'].forEach(t => {
        const btn = document.getElementById(`doc-btn-${t}`);
        btn.classList.toggle('border-secondary', t === type);
        btn.classList.toggle('bg-surface-container-low', t === type);
    });

    // ── STRATÉGIE DE CHARGEMENT ──
    // On ne sait pas si c'est une image ou un PDF avant de charger.
    // On fait d'abord un HEAD request pour récupérer le Content-Type,
    // puis on affiche dans le bon composant.

    fetch(url, { method: 'HEAD', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }
            const contentType = response.headers.get('Content-Type') || '';
            displayDocument(url, contentType);
        })
        .catch(err => {
            console.error('Erreur chargement document:', err);
            showViewerState('error');
            document.getElementById('viewer-error-msg').textContent =
                'Impossible de charger ce document. Vérifiez que le fichier existe sur le serveur.';
        });
}

/**
 * Affiche le document dans le bon composant selon son type MIME
 */
function displayDocument(url, contentType) {
    // Configurer les boutons d'action (ouvrir + télécharger)
    const openBtn     = document.getElementById('viewer-open-btn');
    const downloadBtn = document.getElementById('viewer-download-btn');
    openBtn.href     = url;
    downloadBtn.href = url;
    openBtn.classList.remove('hidden');
    openBtn.classList.add('flex');
    downloadBtn.classList.remove('hidden');
    downloadBtn.classList.add('flex');

    if (contentType.includes('image/')) {
        // ── C'est une image : afficher dans <img> ──
        const img = document.getElementById('viewer-image');
        img.onload = () => showViewerState('image');
        img.onerror = () => {
            showViewerState('error');
            document.getElementById('viewer-error-msg').textContent = 'Impossible d\'afficher cette image.';
        };
        img.src = url; // Déclenche le chargement

    } else if (contentType.includes('application/pdf')) {
        // ── C'est un PDF : afficher dans <iframe> ──
        const iframe = document.getElementById('viewer-pdf');
        // Ajouter #toolbar=1 pour afficher les contrôles PDF natifs du navigateur
        iframe.src = `${url}#toolbar=1&navpanes=0`;
        iframe.onload = () => showViewerState('pdf');
        showViewerState('pdf'); // Afficher directement (iframe.onload peut ne pas se déclencher)

    } else {
        // Type non supporté pour l'aperçu → proposer le téléchargement
        showViewerState('error');
        document.getElementById('viewer-error-msg').textContent =
            'Ce format ne peut pas être prévisualisé. Utilisez le bouton "Télécharger" ci-dessus.';
    }
}

/**
 * Gère l'affichage des différents états du viewer
 * @param {string} state - 'placeholder' | 'loading' | 'error' | 'image' | 'pdf'
 */
function showViewerState(state) {
    const elements = {
        placeholder: document.getElementById('viewer-placeholder'),
        loading:     document.getElementById('viewer-loading'),
        error:       document.getElementById('viewer-error'),
        image:       document.getElementById('viewer-image-container'),
        pdf:         document.getElementById('viewer-pdf'),
    };

    // Masquer tout
    Object.values(elements).forEach(el => {
        if (el) el.classList.add('hidden');
    });

    // Afficher seulement l'état demandé
    if (elements[state]) {
        elements[state].classList.remove('hidden');
    }
}

function resetViewer() {
    showViewerState('placeholder');
    document.getElementById('viewer-title').textContent = 'Sélectionnez un document';
    document.getElementById('viewer-open-btn').classList.add('hidden');
    document.getElementById('viewer-download-btn').classList.add('hidden');
    document.getElementById('viewer-image').src = '';
    document.getElementById('viewer-pdf').src   = '';
}

// ─── ACTIONS DEPUIS LA MODALE DE DOSSIER ───────────────────────────────────

function triggerApproveFromDetail() {
    closeModal('detail-modal');
    openApproveModal(currentAppId, currentAppName);
}

function triggerRejectFromDetail() {
    closeModal('detail-modal');
    openRejectModal(currentAppId, currentAppName);
}

// ─── MODALES APPROUVER / REJETER ───────────────────────────────────────────

function openApproveModal(id, name) {
    document.getElementById('approve-name').textContent = name;
    document.getElementById('approve-form').action      = `/admin/artisans/${id}/approve`;
    document.getElementById('approve-modal').classList.remove('hidden');
}

function openRejectModal(id, name) {
    document.getElementById('reject-name').textContent = name;
    document.getElementById('reject-form').action      = `/admin/artisans/${id}/reject`;
    document.getElementById('reject-modal').classList.remove('hidden');
    setTimeout(() => document.getElementById('reject-notes').focus(), 100);
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    // Nettoyer le viewer PDF pour stopper le chargement
    if (modalId === 'detail-modal') {
        document.getElementById('viewer-pdf').src = '';
    }
}

// Fermer en cliquant sur l'overlay
document.querySelectorAll('.modal-overlay').forEach(overlay => {
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) {
            const id = overlay.id;
            closeModal(id);
        }
    });
});

// Fermer avec Escape
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        document.querySelectorAll('.modal-overlay:not(.hidden)').forEach(m => closeModal(m.id));
    }
});
</script>

<style>
@keyframes spin { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }
</style>

</body>
</html>
