<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dossier {{ $application->full_name }} | Admin L'Éclat du Bénin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = { theme: { extend: {
            colors: {
                "primary":"#000000","secondary":"#735c00","background":"#faf9f6","surface":"#ffffff",
                "surface-container":"#efeeeb","surface-container-low":"#f4f3f1","outline-variant":"#c4c7c7",
                "on-surface-variant":"#444748","on-surface":"#1a1c1a","secondary-container":"#fed65b",
                "secondary-fixed":"#ffe088","error":"#ba1a1a","error-container":"#ffdad6","outline":"#747878",
                "on-tertiary-container":"#5e8e77",
            },
            fontFamily: { "sans":["Montserrat","sans-serif"] }
        }}}
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24; }
        .badge { display: inline-flex; align-items: center; gap: 4px; padding: 2px 10px; font-size: 10px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase; }
        .badge-pending  { background: #fff8e1; color: #735c00; border: 1px solid #ffe088; }
        .badge-approved { background: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; }
        .badge-rejected { background: #ffdad6; color: #ba1a1a; border: 1px solid #ffb4ab; }
        .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 100; display: flex; align-items: center; justify-content: center; padding: 20px; }
        .modal-overlay.hidden { display: none; }
        .viewer-frame { width: 100%; height: 480px; border: 0; }
    </style>
</head>
<body class="bg-background text-on-surface min-h-screen">

<header class="bg-primary text-white px-8 py-5 flex items-center justify-between sticky top-0 z-40">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.artisans.index') }}" class="text-white/70 hover:text-white">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h1 class="font-bold text-sm uppercase tracking-widest">Dossier de Candidature</h1>
            <p class="text-white/40 text-xs mt-0.5">L'ÉCLAT DU BÉNIN — Administration</p>
        </div>
    </div>
    @if($application->status === 'pending_review')
        <span class="badge badge-pending">En attente</span>
    @elseif($application->status === 'approved')
        <span class="badge badge-approved">Approuvé</span>
    @elseif($application->status === 'rejected')
        <span class="badge badge-rejected">Rejeté</span>
    @endif
</header>

<main class="max-w-5xl mx-auto p-8">

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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ── COLONNE GAUCHE : Infos ── --}}
        <div class="lg:col-span-1 space-y-5">

            <div class="bg-surface border border-outline-variant/30 p-6">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-12 h-12 bg-primary flex items-center justify-center flex-shrink-0">
                        <span class="text-white text-sm font-bold uppercase">{{ strtoupper(substr($application->full_name, 0, 2)) }}</span>
                    </div>
                    <div>
                        <p class="font-semibold text-primary">{{ $application->full_name }}</p>
                        <p class="text-xs text-on-surface-variant">{{ $application->user->email }}</p>
                    </div>
                </div>

                <div class="space-y-3 border-t border-outline-variant/20 pt-4">
                    <div>
                        <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Téléphone</p>
                        <p class="text-sm text-primary">{{ $application->phone ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Type de profil</p>
                        <p class="text-sm text-primary">{{ $application->profile_type_label }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Soumis le</p>
                        <p class="text-sm text-primary">{{ $application->updated_at->format('d/m/Y à H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-surface border border-outline-variant/30 p-6">
                <p class="text-[10px] text-secondary font-semibold uppercase tracking-widest mb-3 border-b border-outline-variant/30 pb-2">Boutique</p>
                <div class="space-y-3">
                    <div>
                        <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Nom de la boutique</p>
                        <p class="text-sm font-semibold text-primary">{{ $application->shop_name ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Domaine</p>
                        <p class="text-sm text-primary">{{ $application->craft_type ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-on-surface-variant uppercase tracking-widest block mb-1">Histoire</p>
                        <p class="text-sm text-on-surface-variant leading-relaxed">{{ $application->shop_story ?? 'Aucune description fournie.' }}</p>
                    </div>
                </div>
            </div>

            @if($application->status === 'pending_review')
                <div class="flex gap-2">
                    <button onclick="openApproveModal()" class="flex-1 py-3 bg-green-700 text-white text-xs font-semibold uppercase tracking-widest hover:bg-green-800 transition-all">
                        Approuver
                    </button>
                    <button onclick="openRejectModal()" class="flex-1 py-3 border border-error text-error text-xs font-semibold uppercase tracking-widest hover:bg-error-container/30 transition-all">
                        Rejeter
                    </button>
                </div>
            @elseif($application->admin_notes)
                <div class="bg-surface border border-outline-variant/30 p-5">
                    <p class="text-[10px] text-on-surface-variant uppercase tracking-widest mb-2">Note de l'administrateur</p>
                    <p class="text-sm text-on-surface-variant leading-relaxed">{{ $application->admin_notes }}</p>
                    @if($application->reviewer)
                        <p class="text-[11px] text-on-surface-variant/60 mt-3">Par {{ $application->reviewer->name }} le {{ $application->reviewed_at?->format('d/m/Y à H:i') }}</p>
                    @endif
                </div>
            @endif
        </div>

        {{-- ── COLONNE DROITE : Documents ── --}}
        <div class="lg:col-span-2 space-y-5">

            <div class="bg-surface border border-outline-variant/30">
                <div class="flex items-center justify-between px-6 py-4 border-b border-outline-variant/20">
                    <h3 class="font-bold text-primary uppercase tracking-widest text-xs">Pièce d'Identité</h3>
                    @if($application->id_document_path)
                        <a href="{{ route('admin.artisans.document', [$application, 'identity']) }}" target="_blank" class="text-[10px] text-secondary font-semibold uppercase tracking-widest hover:text-primary">
                            Ouvrir dans un onglet →
                        </a>
                    @endif
                </div>
                @if($application->id_document_path)
                    <iframe src="{{ route('admin.artisans.document', [$application, 'identity']) }}" class="viewer-frame"></iframe>
                @else
                    <div class="py-16 text-center">
                        <span class="material-symbols-outlined text-4xl text-outline-variant block mb-3">description_off</span>
                        <p class="text-sm text-on-surface-variant">Aucun document soumis.</p>
                    </div>
                @endif
            </div>

            <div class="bg-surface border border-outline-variant/30">
                <div class="flex items-center justify-between px-6 py-4 border-b border-outline-variant/20">
                    <h3 class="font-bold text-primary uppercase tracking-widest text-xs">Certification Artisanale</h3>
                    @if($application->certification_path)
                        <a href="{{ route('admin.artisans.document', [$application, 'certification']) }}" target="_blank" class="text-[10px] text-secondary font-semibold uppercase tracking-widest hover:text-primary">
                            Ouvrir dans un onglet →
                        </a>
                    @endif
                </div>
                @if($application->certification_path)
                    <iframe src="{{ route('admin.artisans.document', [$application, 'certification']) }}" class="viewer-frame"></iframe>
                @else
                    <div class="py-16 text-center">
                        <span class="material-symbols-outlined text-4xl text-outline-variant block mb-3">description_off</span>
                        <p class="text-sm text-on-surface-variant">Document optionnel non fourni.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</main>

{{-- Modale Approuver --}}
<div class="modal-overlay hidden" id="approve-modal">
    <div class="bg-surface w-full max-w-md p-8">
        <div class="text-center mb-6">
            <span class="material-symbols-outlined text-5xl text-green-600 block mb-4" style="font-variation-settings:'FILL' 1;">check_circle</span>
            <h3 class="text-lg font-bold text-primary">Approuver {{ $application->full_name }}</h3>
        </div>
        <form method="POST" action="{{ route('admin.artisans.approve', $application) }}">
            @csrf
            <div class="mb-6">
                <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Message de bienvenue (optionnel)</label>
                <textarea name="admin_notes" rows="3" class="w-full border border-outline-variant px-4 py-3 text-sm focus:outline-none focus:border-secondary resize-none"></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeModal('approve-modal')" class="flex-1 py-3 border border-outline-variant text-sm text-on-surface-variant">Annuler</button>
                <button type="submit" class="flex-1 py-3 bg-green-700 text-white text-sm font-semibold uppercase tracking-widest hover:bg-green-800 transition-all">Confirmer</button>
            </div>
        </form>
    </div>
</div>

{{-- Modale Rejeter --}}
<div class="modal-overlay hidden" id="reject-modal">
    <div class="bg-surface w-full max-w-md p-8">
        <div class="text-center mb-6">
            <span class="material-symbols-outlined text-5xl text-error block mb-4">cancel</span>
            <h3 class="text-lg font-bold text-primary">Rejeter {{ $application->full_name }}</h3>
        </div>
        <form method="POST" action="{{ route('admin.artisans.reject', $application) }}">
            @csrf
            <div class="mb-6">
                <label class="block text-xs font-semibold text-on-surface-variant uppercase tracking-widest mb-2">Motif du rejet <span class="text-error">*</span></label>
                <textarea name="admin_notes" rows="4" required class="w-full border border-outline-variant px-4 py-3 text-sm focus:outline-none focus:border-error resize-none"></textarea>
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="closeModal('reject-modal')" class="flex-1 py-3 border border-outline-variant text-sm text-on-surface-variant">Annuler</button>
                <button type="submit" class="flex-1 py-3 bg-error text-white text-sm font-semibold uppercase tracking-widest hover:bg-red-800 transition-all">Confirmer le refus</button>
            </div>
        </form>
    </div>
</div>

<script>
function openApproveModal() { document.getElementById('approve-modal').classList.remove('hidden'); }
function openRejectModal() { document.getElementById('reject-modal').classList.remove('hidden'); }
function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
</script>

</body>
</html>
