{{--
    COMPOSANT LAYOUT : <x-collection>...</x-collection>
    =====================================================================
    Layout englobant utilisé par les pages qui n'ont PAS de hero plein
    écran (contrairement aux pages catégorie bijoux/art/maroquinerie qui
    ont leur propre structure complète avec hero immersif).

    Utilisé par :
      - collection/index.blade.php (page "Toute la Collection")
      - collection/product-detail.blade.php (fiche produit)

    Le contenu placé entre les balises <x-collection> ... </x-collection>
    est injecté à la place de {{ $slot }} ci-dessous, à l'intérieur
    d'un conteneur centré avec le padding standard du design system.
    =====================================================================
--}}
<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ $title ?? "Collection | L'Éclat du Bénin" }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: { extend: {
                colors: {
                    "on-secondary-container":"#745c00","on-tertiary-fixed-variant":"#204f3c","on-tertiary-fixed":"#002114",
                    "on-secondary-fixed-variant":"#574500","on-surface":"#1a1c1a","on-primary-container":"#858383",
                    "error":"#ba1a1a","background":"#faf9f6","primary-fixed-dim":"#c9c6c5","on-primary":"#ffffff",
                    "outline-variant":"#c4c7c7","on-error":"#ffffff","on-background":"#1a1c1a","primary-fixed":"#e5e2e1",
                    "primary-container":"#1c1b1b","tertiary-fixed":"#bbeed3","surface-tint":"#5f5e5e",
                    "surface-container-lowest":"#ffffff","inverse-primary":"#c9c6c5","tertiary-fixed-dim":"#a0d1b8",
                    "on-tertiary-container":"#5e8e77","surface-container":"#efeeeb","surface-variant":"#e3e2e0",
                    "secondary":"#735c00","secondary-fixed":"#ffe088","on-primary-fixed-variant":"#474646",
                    "tertiary":"#000000","surface-bright":"#faf9f6","on-secondary":"#ffffff",
                    "inverse-on-surface":"#f2f1ee","surface-container-low":"#f4f3f1","surface-container-highest":"#e3e2e0",
                    "on-tertiary":"#ffffff","primary":"#000000","on-primary-fixed":"#1c1b1b","inverse-surface":"#2f312f",
                    "on-error-container":"#93000a","surface-dim":"#dbdad7","on-secondary-fixed":"#241a00",
                    "surface-container-high":"#e9e8e5","secondary-container":"#fed65b","tertiary-container":"#002114",
                    "outline":"#747878","on-surface-variant":"#444748","surface":"#faf9f6","error-container":"#ffdad6",
                    "secondary-fixed-dim":"#e9c349"
                },
                borderRadius: { "DEFAULT":"0.125rem","lg":"0.25rem","xl":"0.5rem","full":"0.75rem" },
                spacing: { "margin-desktop":"80px","gutter":"24px","container-max":"1280px","section-gap":"120px","margin-tablet":"40px","margin-mobile":"20px" },
                fontFamily: {
                    "headline-md":["Playfair Display"],"price-display":["Montserrat"],"headline-lg":["Playfair Display"],
                    "display-lg":["Playfair Display"],"display-lg-mobile":["Playfair Display"],"body-md":["Montserrat"],
                    "body-lg":["Montserrat"],"label-caps":["Montserrat"]
                },
                fontSize: {
                    "headline-md":["24px",{"lineHeight":"32px","fontWeight":"600"}],
                    "price-display":["20px",{"lineHeight":"24px","fontWeight":"500"}],
                    "headline-lg":["32px",{"lineHeight":"40px","fontWeight":"600"}],
                    "display-lg":["64px",{"lineHeight":"72px","letterSpacing":"-0.02em","fontWeight":"700"}],
                    "display-lg-mobile":["40px",{"lineHeight":"48px","letterSpacing":"-0.01em","fontWeight":"700"}],
                    "body-md":["16px",{"lineHeight":"24px","fontWeight":"400"}],
                    "body-lg":["18px",{"lineHeight":"28px","fontWeight":"400"}],
                    "label-caps":["12px",{"lineHeight":"16px","letterSpacing":"0.1em","fontWeight":"600"}]
                }
            }}
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .luxury-line::after { content: ''; display: block; width: 0; height: 1px; background: #735c00; transition: width 0.3s ease; }
        .luxury-line:hover::after { width: 100%; }
        .product-card-hover { transition: transform 0.3s ease; }
        .product-card-hover .quick-view { opacity: 0; transition: opacity 0.3s ease; }
        .product-card-hover:hover .quick-view { opacity: 1; }
        .glass-nav { backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); }
        body { min-height: max(884px, 100dvh); }
    </style>
</head>
<body class="bg-background text-on-surface font-body-md selection:bg-secondary-container">

    <x-collection.header :active="$active ?? null" />

    {{-- Drawer mobile (identique aux pages catégorie pour cohérence de navigation) --}}
    <div class="fixed inset-0 bg-black/40 z-[60] hidden opacity-0 transition-opacity duration-300" id="drawer-overlay" onclick="toggleDrawer()"></div>
    <aside class="fixed top-0 left-0 h-full w-80 bg-surface z-[70] -translate-x-full transition-transform duration-300 ease-in-out shadow-sm flex flex-col gap-4 p-8" id="drawer">
        <div class="flex justify-between items-center mb-8">
            <span class="font-display-lg text-headline-md text-primary">L'ÉCLAT DU BÉNIN</span>
            <span class="material-symbols-outlined cursor-pointer" onclick="toggleDrawer()">close</span>
        </div>
        <nav class="flex flex-col gap-2">
            <a class="px-4 py-3 font-label-caps text-label-caps text-on-surface-variant hover:bg-surface-container-high transition-all" href="{{ route('collection.index') }}">Toute la Collection</a>
            @foreach(\App\Models\Category::orderBy('display_order')->get() as $navCat)
                <a class="px-4 py-3 font-label-caps text-label-caps text-on-surface-variant hover:bg-surface-container-high transition-all" href="{{ route('collection.category', $navCat) }}">{{ $navCat->name }}</a>
            @endforeach
        </nav>
    </aside>

    {{-- Conteneur principal : le contenu de la page s'injecte ici --}}
    <main class="pt-32 pb-section-gap max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        {{ $slot }}
    </main>

    <x-footer />

    <script>
        function toggleDrawer() {
            const drawer = document.getElementById('drawer');
            const overlay = document.getElementById('drawer-overlay');
            const isOpen = !drawer.classList.contains('-translate-x-full');
            if (isOpen) {
                drawer.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                overlay.classList.remove('opacity-100');
            } else {
                drawer.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                setTimeout(() => overlay.classList.add('opacity-100'), 10);
            }
        }
    </script>
</body>
</html>
