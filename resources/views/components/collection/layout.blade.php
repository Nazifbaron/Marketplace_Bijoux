{{--
    LAYOUT : <x-collection.layout>
    =====================================================================
    Layout englobant partagé entre les pages bijoux, art, maroquinerie.

    Fournit : head complet, styles CSS partagés, header/drawer/footer.
    Chaque page injecte son contenu via {{ $slot }}.

    Paramètres :
      :active="bijoux"     → surligne le bon lien de navigation
      :title="..."         → titre <title> de la page
    =====================================================================
--}}
@props(['active' => null, 'title' => "L'Éclat du Bénin"])

<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ $title }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: { extend: {
                colors: {
                    "on-secondary-container":"#745c00","on-tertiary-fixed-variant":"#204f3c","on-tertiary-fixed":"#002114",
                    "on-secondary-fixed-variant":"#574500","on-surface":"#012F24 ","on-primary-container":"#858383",
                    "error":"#ba1a1a","background":"#faf9f6","primary-fixed-dim":"#c9c6c5","on-primary":"#ffffff",
                    "outline-variant":"#c4c7c7","on-error":"#ffffff","on-background":"#012F24 ","primary-fixed":"#e5e2e1",
                    "primary-container":"#1c1b1b","tertiary-fixed":"#bbeed3","surface-tint":"#5f5e5e",
                    "surface-container-lowest":"#ffffff","inverse-primary":"#c9c6c5","tertiary-fixed-dim":"#a0d1b8",
                    "on-tertiary-container":"#5e8e77","surface-container":"#efeeeb","surface-variant":"#e3e2e0",
                    "secondary":"#735c00","secondary-fixed":"#ffe088","on-primary-fixed-variant":"#474646",
                    "tertiary":"#012F24 ","surface-bright":"#faf9f6","on-secondary":"#ffffff",
                    "inverse-on-surface":"#f2f1ee","surface-container-low":"#f4f3f1","surface-container-highest":"#e3e2e0",
                    "on-tertiary":"#ffffff","primary":"#012F24 ","on-primary-fixed":"#1c1b1b","inverse-surface":"#2f312f",
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
        .luxury-line::after { content:''; display:block; width:0; height:1px; background:#735c00; transition:width 0.3s ease; }
        .luxury-line:hover::after { width:100%; }
        .museum-fade-in { animation:fadeIn 1.2s ease-out forwards; }
        @keyframes fadeIn { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
        .glass-nav { backdrop-filter:blur(20px); -webkit-backdrop-filter:blur(20px); }
        .hairline-border { border:1px solid rgba(116,120,120,0.15); }
        .image-zoom-container { overflow:hidden; }
        .image-zoom-container img { transition:transform 0.8s cubic-bezier(0.16,1,0.3,1); }
        .image-zoom-container:hover img { transform:scale(1.05); }
        /* Modal Quick View */
        #quick-view-modal { transition:opacity 0.25s ease; }
        #quick-view-modal.open { opacity:1; pointer-events:all; }
        /* Scroll reveal */
        .reveal { opacity:0; transform:translateY(28px); transition:opacity 0.7s ease, transform 0.7s ease; }
        .reveal.visible { opacity:1; transform:none; }
        body { min-height: max(884px, 100dvh); }
        /* Badge vérifié doré */
        .badge-verified { background:rgba(1,47,36,0.82); backdrop-filter:blur(8px); display:inline-flex; align-items:center; gap:5px; padding:3px 10px; }
        /* Filtres actifs */
        .filter-btn.active { color:#012F24 !important; border-bottom:2px solid #012F24; }
        .filter-btn { transition:color 0.2s; }
        /* Suppression scrollbar horizontal filtres */
        .no-scrollbar::-webkit-scrollbar { display:none; }
        .no-scrollbar { -ms-overflow-style:none; scrollbar-width:none; }
    </style>
</head>
<body class="bg-background text-on-surface font-body-md selection:bg-secondary-container">

    {{-- ── HEADER FIXE ── --}}
    <x-collection.header :active="$active" />

    {{-- ── DRAWER MOBILE ── --}}
    <div class="fixed inset-0 bg-black/40 z-[60] hidden opacity-0 transition-opacity duration-300" id="drawer-overlay" onclick="toggleDrawer()"></div>
    <aside class="fixed top-0 left-0 h-full w-80 bg-surface z-[70] -translate-x-full transition-transform duration-300 ease-in-out shadow-sm flex flex-col p-8" id="drawer">
        <div class="flex justify-between items-center mb-8">
            <span class="font-display-lg text-headline-md text-primary" style="font-family:'Playfair Display',serif">L'ÉCLAT DU BÉNIN</span>
            <span class="material-symbols-outlined cursor-pointer" onclick="toggleDrawer()">close</span>
        </div>
        <nav class="flex flex-col gap-1">
            @foreach(\App\Models\Category::orderBy('display_order')->get() as $cat)
                <a href="{{ route('collection.category', $cat) }}"
                   class="px-4 py-3 font-label-caps text-label-caps transition-all {{ ($active ?? '') === $cat->slug ? 'text-primary bg-secondary-container/20 font-semibold' : 'text-on-surface-variant hover:bg-surface-container-high' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </nav>
    </aside>

    {{-- ── CONTENU DE LA PAGE ── --}}
    <main class="pt-20">
        {{ $slot }}
    </main>

    {{-- ── MODAL QUICK VIEW ── --}}
    <div id="quick-view-modal"
         class="fixed inset-0 z-[90] bg-black/60 opacity-0 pointer-events-none flex items-center justify-center p-4 md:p-8"
         onclick="if(event.target===this) closeQuickView()">
        <div class="bg-surface w-full max-w-4xl max-h-[90vh] overflow-y-auto relative" id="quick-view-inner">
            <button onclick="closeQuickView()" class="absolute top-5 right-5 z-10 text-on-surface-variant hover:text-primary transition-colors">
                <span class="material-symbols-outlined text-[28px]">close</span>
            </button>
            {{-- Contenu injecté dynamiquement par JS --}}
            <div id="quick-view-content" class="flex flex-col md:flex-row min-h-[500px]">
                <div class="md:w-1/2 bg-surface-container-low flex items-center justify-center p-4">
                    <div class="w-8 h-8 border-2 border-secondary border-t-transparent rounded-full animate-spin"></div>
                </div>
                <div class="md:w-1/2 p-10">
                    <div class="h-4 w-24 bg-surface-container animate-pulse mb-4"></div>
                    <div class="h-8 w-full bg-surface-container animate-pulse mb-2"></div>
                    <div class="h-4 w-1/2 bg-surface-container animate-pulse"></div>
                </div>
            </div>
        </div>
    </div>

    <x-footer />

    <script>
    // ── DRAWER ──
    function toggleDrawer() {
        const drawer = document.getElementById('drawer');
        const overlay = document.getElementById('drawer-overlay');
        const isOpen = !drawer.classList.contains('-translate-x-full');
        if (isOpen) {
            drawer.classList.add('-translate-x-full');
            overlay.classList.add('hidden'); overlay.classList.remove('opacity-100');
        } else {
            drawer.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
            setTimeout(() => overlay.classList.add('opacity-100'), 10);
        }
    }

    // ── SCROLL REVEAL ──
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(e => { if(e.isIntersecting) { e.target.classList.add('visible'); revealObserver.unobserve(e.target); } });
    }, { threshold: 0.08 });
    document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

    // ── FILTRES SOUS-CATÉGORIES ──
    // Chaque page déclare ses propres boutons avec data-filter="slug"
    // Ce handler commun gère le surlignage actif + le filtrage visuel.
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-filter]');
        if (!btn) return;
        const slug = btn.dataset.filter;
        // Surlignage
        document.querySelectorAll('[data-filter]').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        // Filtrage des cartes produit
        document.querySelectorAll('[data-category]').forEach(card => {
            if (slug === 'all' || card.dataset.category === slug) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // ── TRI ──
    function sortProducts(criterion) {
        const grids = document.querySelectorAll('.product-grid');
        grids.forEach(grid => {
            const cards = [...grid.querySelectorAll('[data-price]')].filter(c => c.closest('.product-grid') === grid);
            cards.sort((a, b) => {
                const pa = parseFloat(a.dataset.price);
                const pb = parseFloat(b.dataset.price);
                if (criterion === 'price_asc') return pa - pb;
                if (criterion === 'price_desc') return pb - pa;
                if (criterion === 'newest') return parseInt(b.dataset.id||0) - parseInt(a.dataset.id||0);
                return 0;
            });
            cards.forEach(c => grid.appendChild(c));
        });
    }

    // ── QUICK VIEW ──
    function openQuickView(productId) {
        const modal = document.getElementById('quick-view-modal');
        const content = document.getElementById('quick-view-content');
        modal.classList.add('open');
        document.body.style.overflow = 'hidden';

        // Réinitialiser avec le loader
        content.innerHTML = `
            <div class="md:w-1/2 bg-surface-container-low flex items-center justify-center p-4 min-h-[300px]">
                <div class="w-8 h-8 border-2 border-secondary border-t-transparent rounded-full" style="animation:spin 0.8s linear infinite"></div>
            </div>
            <div class="md:w-1/2 p-10 space-y-4">
                <div class="h-3 w-20 bg-surface-container rounded" style="animation:pulse 1.5s infinite"></div>
                <div class="h-7 w-full bg-surface-container rounded" style="animation:pulse 1.5s infinite"></div>
                <div class="h-3 w-1/2 bg-surface-container rounded" style="animation:pulse 1.5s infinite"></div>
            </div>
        `;

        // Charger les données du produit
        fetch(`/api/produit/${productId}`, {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(p => renderQuickView(p))
        .catch(() => {
            content.innerHTML = `<div class="w-full p-12 text-center"><p class="text-on-surface-variant">Impossible de charger ce produit.</p></div>`;
        });
    }

    function renderQuickView(p) {
        const verified = p.is_verified
            ? `<div class="inline-flex items-center gap-1.5 bg-black/85 px-3 py-1 mb-4">
                   <span class="material-symbols-outlined text-secondary-fixed text-[14px]" style="font-variation-settings:'FILL' 1">verified</span>
                   <span class="font-label-caps text-[9px] text-secondary-fixed tracking-widest">AUTHENTICITÉ VÉRIFIÉE</span>
               </div><br>` : '';
        const badge = p.condition_label_text
            ? `<span class="inline-block bg-primary text-white font-label-caps text-[9px] px-3 py-1 mb-4">${p.condition_label_text}</span><br>` : '';
        document.getElementById('quick-view-content').innerHTML = `
            <div class="md:w-1/2 bg-surface-container-low overflow-hidden relative">
                <img src="${p.primary_image || ''}" class="w-full h-full object-cover min-h-[300px]" alt="${p.name}" />
                ${p.is_verified ? '<div class="absolute top-4 left-4"><div class="badge-verified"><span class="material-symbols-outlined text-secondary-fixed text-[13px]" style="font-variation-settings:\'FILL\' 1">verified</span><span class="font-label-caps text-[9px] text-secondary-fixed tracking-widest">VÉRIFIÉ</span></div></div>' : ''}
            </div>
            <div class="md:w-1/2 p-10 flex flex-col justify-between">
                <div>
                    <span class="font-label-caps text-[10px] text-secondary mb-3 block">${p.category_name || ''}</span>
                    ${badge}
                    <h2 class="font-display-lg text-headline-lg mb-3" style="font-family:'Playfair Display',serif">${p.name}</h2>
                    ${p.short_story ? `<p class="font-label-caps text-[10px] text-on-surface-variant mb-4 tracking-widest">${p.short_story}</p>` : ''}
                    <p class="font-price-display text-primary mb-6" style="font-size:24px;font-weight:600">${p.formatted_price}</p>
                    <div class="h-px w-full bg-outline-variant/30 mb-6"></div>
                    <p class="font-body-md text-on-surface-variant leading-relaxed mb-6">${p.description ? p.description.substring(0, 200) + (p.description.length > 200 ? '…' : '') : ''}</p>
                    ${p.stock_quantity === 0 ? '<p class="text-error font-label-caps text-[10px] mb-4">RUPTURE DE STOCK</p>' : `<p class="font-label-caps text-[10px] text-on-tertiary-container mb-6">${p.stock_quantity} PIÈCE(S) DISPONIBLE(S)</p>`}
                </div>
                <div class="space-y-3">
                    <a href="/collection/produit/${p.slug}"
                       class="block w-full bg-primary text-on-primary text-center py-4 font-label-caps text-label-caps tracking-widest hover:bg-on-surface-variant transition-all">
                        VOIR LA FICHE COMPLÈTE
                    </a>
                    <a href="/collection/produit/${p.slug}"
                       class="block w-full border border-primary text-primary text-center py-4 font-label-caps text-label-caps tracking-widest hover:bg-primary hover:text-white transition-all">
                        AJOUTER AU PANIER
                    </a>
                    ${p.vendor_id ? `<form action="/messagerie/contacter/${p.vendor_id}" method="POST" class="w-full">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name=csrf-token]').content}">
                        <input type="hidden" name="product_id" value="${p.id}">
                        <button type="submit" class="w-full border border-outline-variant text-on-surface-variant py-3 font-label-caps text-[10px] tracking-widest hover:border-secondary hover:text-secondary transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[14px]">chat_bubble</span> CONTACTER L'ARTISAN
                        </button>
                    </form>` : ''}
                </div>
            </div>
        `;
    }

    function closeQuickView() {
        document.getElementById('quick-view-modal').classList.remove('open');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', e => { if(e.key === 'Escape') closeQuickView(); });

    // ── SCROLL HORIZONTAL FILTRES (souris) ──
    const scrollContainers = document.querySelectorAll('.no-scrollbar');
    scrollContainers.forEach(sc => {
        sc.addEventListener('wheel', (evt) => { evt.preventDefault(); sc.scrollLeft += evt.deltaY; });
    });

    @keyframes spin { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }
    </script>
    <style>@keyframes spin { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }</style>

</body>
</html>
