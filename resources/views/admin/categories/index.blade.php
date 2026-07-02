{{-- resources/views/admin/categories/index.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Catégories | Admin L'Éclat du Bénin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: {
            colors: {
                "primary":"#012F24","secondary":"#735c00","background":"#faf9f6","surface":"#ffffff",
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
    </style>
</head>
<body class="bg-background text-on-surface min-h-screen">

{{-- Sidebar --}}
<aside class="fixed left-0 top-0 h-full w-64 bg-primary text-white z-50 flex flex-col">
    <div class="p-6 border-b border-white/10">
        <h1 class="font-bold text-sm uppercase tracking-widest" style="font-family:'Playfair Display',serif">L'ÉCLAT DU BÉNIN</h1>
        <p class="text-white/40 text-xs mt-1 tracking-widest uppercase">Administration</p>
    </div>
    <nav class="flex-1 p-4 space-y-1">
        <a href="{{ route('admin.artisans.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-white/60 hover:text-white hover:bg-white/5 transition-all rounded">
            <span class="material-symbols-outlined text-[20px]">storefront</span> Artisans
        </a>
        <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium bg-white/10 text-white rounded">
            <span class="material-symbols-outlined text-[20px]">category</span> Catégories
        </a>
        <a href="{{ route('admin.products.moderation') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-white/60 hover:text-white hover:bg-white/5 transition-all rounded">
            <span class="material-symbols-outlined text-[20px]">inventory_2</span> Produits
        </a>
        <a href="{{ route('admin.products.verification') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-white/60 hover:text-white hover:bg-white/5 transition-all rounded">
            <span class="material-symbols-outlined text-[20px]">verified</span> Vérifications
        </a>
    </nav>
</aside>

<div class="ml-64">
    <header class="bg-surface border-b border-outline-variant/30 px-8 py-5 flex items-center justify-between sticky top-0 z-40">
        <div>
            <h2 class="text-xl font-bold text-primary" style="font-family:'Playfair Display',serif">Gestion des Catégories</h2>
            <p class="text-sm text-on-surface-variant mt-0.5">Organisez la structure du catalogue public</p>
        </div>
        <a href="{{ route('admin.categories.create') }}"
           class="flex items-center gap-2 bg-primary text-white px-5 py-2.5 text-xs font-semibold uppercase tracking-widest hover:bg-primary/90 transition-all">
            <span class="material-symbols-outlined text-[16px]">add</span>
            Nouvelle Catégorie
        </a>
    </header>

    <main class="p-8">

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 flex items-start gap-3">
                <span class="material-symbols-outlined text-green-600 flex-shrink-0" style="font-variation-settings:'FILL' 1">check_circle</span>
                <p class="text-sm text-green-800">{{ session('success') }}</p>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 flex items-start gap-3">
                <span class="material-symbols-outlined text-red-600 flex-shrink-0">error</span>
                <p class="text-sm text-red-800">{{ session('error') }}</p>
            </div>
        @endif

        {{-- Explication de la route générique --}}
        <div class="mb-6 p-4 bg-surface-container-low border-l-2 border-secondary flex items-start gap-3">
            <span class="material-symbols-outlined text-secondary flex-shrink-0 mt-0.5">info</span>
            <div class="text-xs text-on-surface-variant leading-relaxed">
                <strong class="text-primary">Comment les nouvelles catégories sont accessibles :</strong>
                Si vous avez la route générique <code class="bg-surface-container px-1">/collection/{slug}</code> dans web.php,
                toute nouvelle catégorie créée ici est automatiquement accessible sur <code class="bg-surface-container px-1">/collection/{slug}</code>.
                <br>Si vous utilisez des routes spécifiques par slug, vous devrez ajouter la route manuellement dans web.php.
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse($categories as $cat)
                <div class="bg-surface border border-outline-variant/30 overflow-hidden">

                    {{-- Image héro --}}
                    <div class="aspect-[3/1] bg-surface-container relative overflow-hidden">
                        @if($cat->hero_image)
                            <img src="{{ asset('storage/' . $cat->hero_image) }}"
                                 class="w-full h-full object-cover" alt="{{ $cat->name }}" />
                            <div class="absolute inset-0 bg-primary/30"></div>
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-primary/10">
                                <span class="material-symbols-outlined text-4xl text-primary/30">image</span>
                            </div>
                        @endif

                        <div class="absolute bottom-3 left-4">
                            <h3 class="text-white font-bold text-sm" style="font-family:'Playfair Display',serif;
                                text-shadow:0 1px 3px rgba(0,0,0,0.6)">
                                {{ $cat->name }}
                            </h3>
                        </div>

                        <div class="absolute top-2 right-2">
                            <span class="bg-white/90 text-primary text-[10px] font-bold px-2 py-0.5">
                                /{{ $cat->slug }}
                            </span>
                        </div>
                    </div>

                    <div class="p-5">
                        {{-- Stats --}}
                        <div class="flex gap-6 mb-4">
                            <div class="text-center">
                                <p class="text-xl font-bold text-primary">{{ $cat->products_count }}</p>
                                <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Produits</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xl font-bold text-primary">{{ $cat->subcategories->count() }}</p>
                                <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Filtres</p>
                            </div>
                            <div class="text-center">
                                <p class="text-xl font-bold text-primary">#{{ $cat->display_order }}</p>
                                <p class="text-[10px] text-on-surface-variant uppercase tracking-widest">Ordre</p>
                            </div>
                        </div>

                        {{-- Sous-catégories --}}
                        @if($cat->subcategories->count() > 0)
                            <div class="flex flex-wrap gap-1 mb-4">
                                @foreach($cat->subcategories as $sub)
                                    <span class="bg-surface-container text-on-surface-variant text-[10px] px-2 py-0.5 font-semibold">
                                        {{ $sub->name }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-[11px] text-on-surface-variant/50 mb-4 italic">Aucun filtre de sous-catégorie</p>
                        @endif

                        {{-- Actions --}}
                        <div class="flex gap-2 pt-3 border-t border-outline-variant/20">
                            <a href="{{ route('admin.categories.edit', $cat) }}"
                               class="flex-1 text-center py-2 border border-outline-variant text-xs font-semibold uppercase tracking-widest text-on-surface-variant hover:text-primary hover:border-primary transition-all">
                                Modifier
                            </a>
                            <a href="/collection/{{ $cat->slug }}" target="_blank"
                               class="px-3 py-2 border border-outline-variant text-on-surface-variant hover:text-primary hover:border-primary transition-all"
                               title="Voir la page publique">
                                <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                            </a>
                            @if($cat->products_count === 0)
                                <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST"
                                      onsubmit="return confirm('Supprimer définitivement la catégorie « {{ $cat->name }} » ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="px-3 py-2 border border-error/30 text-error hover:bg-error-container/30 transition-all" title="Supprimer">
                                        <span class="material-symbols-outlined text-[16px]">delete</span>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full bg-surface border border-outline-variant/30 py-20 text-center">
                    <span class="material-symbols-outlined text-6xl text-outline-variant block mb-4">category</span>
                    <p class="text-sm text-on-surface-variant">Aucune catégorie créée.</p>
                    <a href="{{ route('admin.categories.create') }}" class="inline-block mt-4 bg-primary text-white px-6 py-3 text-xs font-semibold uppercase tracking-widest">
                        Créer la première catégorie
                    </a>
                </div>
            @endforelse
        </div>
    </main>
</div>

</body>
</html>
