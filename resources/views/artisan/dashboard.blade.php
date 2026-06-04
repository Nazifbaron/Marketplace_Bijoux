<!DOCTYPE html>

<html class="light" lang="fr"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Artisan Dashboard - L'ÉCLAT DU BÉNIN</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&amp;family=Montserrat:wght@400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "surface-container-highest": "#e3e2e0",
                    "primary-fixed": "#e5e2e1",
                    "on-background": "#1a1c1a",
                    "on-primary-fixed-variant": "#474646",
                    "on-error-container": "#93000a",
                    "tertiary-fixed-dim": "#a0d1b8",
                    "surface-dim": "#dbdad7",
                    "on-secondary": "#ffffff",
                    "tertiary-container": "#002114",
                    "primary": "#000000",
                    "outline-variant": "#c4c7c7",
                    "secondary": "#735c00",
                    "tertiary-fixed": "#bbeed3",
                    "background": "#faf9f6",
                    "surface-tint": "#5f5e5e",
                    "on-secondary-fixed": "#241a00",
                    "error-container": "#ffdad6",
                    "on-primary-container": "#858383",
                    "on-surface-variant": "#444748",
                    "on-tertiary": "#ffffff",
                    "secondary-fixed-dim": "#e9c349",
                    "surface": "#faf9f6",
                    "secondary-container": "#fed65b",
                    "on-secondary-container": "#745c00",
                    "on-primary-fixed": "#1c1b1b",
                    "secondary-fixed": "#ffe088",
                    "surface-variant": "#e3e2e0",
                    "primary-fixed-dim": "#c9c6c5",
                    "surface-container-high": "#e9e8e5",
                    "on-secondary-fixed-variant": "#574500",
                    "surface-container-lowest": "#ffffff",
                    "on-tertiary-fixed": "#002114",
                    "surface-bright": "#faf9f6",
                    "outline": "#747878",
                    "on-surface": "#1a1c1a",
                    "surface-container-low": "#f4f3f1",
                    "on-tertiary-container": "#5e8e77",
                    "inverse-surface": "#2f312f",
                    "on-error": "#ffffff",
                    "tertiary": "#000000",
                    "inverse-on-surface": "#f2f1ee",
                    "primary-container": "#1c1b1b",
                    "surface-container": "#efeeeb",
                    "inverse-primary": "#c9c6c5",
                    "on-tertiary-fixed-variant": "#204f3c",
                    "on-primary": "#ffffff",
                    "error": "#ba1a1a"
            },
            "borderRadius": {
                    "DEFAULT": "0.125rem",
                    "lg": "0.25rem",
                    "xl": "0.5rem",
                    "full": "0.75rem"
            },
            "spacing": {
                    "gutter": "24px",
                    "margin-tablet": "40px",
                    "margin-desktop": "80px",
                    "margin-mobile": "20px",
                    "container-max": "1280px",
                    "section-gap": "120px"
            },
            "fontFamily": {
                    "display-lg-mobile": ["Playfair Display"],
                    "headline-lg": ["Playfair Display"],
                    "label-caps": ["Montserrat"],
                    "display-lg": ["Playfair Display"],
                    "price-display": ["Montserrat"],
                    "body-md": ["Montserrat"],
                    "headline-md": ["Playfair Display"],
                    "body-lg": ["Montserrat"]
            },
            "fontSize": {
                    "display-lg-mobile": ["40px", {"lineHeight": "48px", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                    "headline-lg": ["32px", {"lineHeight": "40px", "fontWeight": "600"}],
                    "label-caps": ["12px", {"lineHeight": "16px", "letterSpacing": "0.1em", "fontWeight": "600"}],
                    "display-lg": ["64px", {"lineHeight": "72px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                    "price-display": ["20px", {"lineHeight": "24px", "fontWeight": "500"}],
                    "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                    "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                    "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}]
            }
          },
        },
      }
    </script>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
        }
        .luxury-glass {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        .gold-shimmer {
            background: linear-gradient(90deg, #735c00 0%, #fed65b 50%, #735c00 100%);
            background-size: 200% auto;
            animation: shimmer 3s linear infinite;
        }
        @keyframes shimmer {
            to { background-position: 200% center; }
        }
        .asymmetric-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 24px;
        }
        @media (max-width: 1024px) {
            .asymmetric-grid { grid-template-columns: 1fr; }
        }
    </style>
<style>
    body {
      min-height: max(884px, 100dvh);
    }
  </style>
  </head>
<body class="bg-background text-on-background font-body-md min-h-screen">
<!-- TopAppBar -->
<header class="fixed top-0 w-full z-50 bg-surface/70 backdrop-blur-xl border-b border-outline-variant/30 px-gutter py-4 flex justify-between items-center">
<div class="flex items-center gap-4">
<button class="cursor-pointer transition-opacity active:opacity-80">
<span class="material-symbols-outlined text-primary">menu</span>
</button>
<h1 class="font-headline-md text-headline-md font-bold text-primary uppercase tracking-widest">L'ÉCLAT DU BÉNIN</h1>
</div>
<div class="flex items-center gap-6">
<span class="hidden md:block font-label-caps text-label-caps uppercase tracking-widest text-primary border-b border-primary">Dashboard</span>
<span class="hidden md:block font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant/80 hover:text-primary transition-colors duration-300 cursor-pointer">Boutique</span>
<button class="cursor-pointer transition-opacity active:opacity-80">
<span class="material-symbols-outlined text-primary">account_circle</span>
</button>
</div>
</header>
<!-- Sidebar / NavigationDrawer -->
<aside class="h-full w-80 fixed left-0 top-0 z-[60] bg-surface border-r border-outline-variant/20 shadow-sm hidden lg:flex flex-col py-8 pt-24">
<div class="px-6 mb-12 flex items-center gap-4">
<div class="w-12 h-12 rounded-full overflow-hidden border border-secondary/30">
<img alt="Artisan Portrait" class="w-full h-full object-cover" data-alt="Close-up portrait of a master Beninese artisan in a sun-drenched Cotonou studio. The lighting is warm and natural, casting soft shadows that highlight the craftsmanship and dignity in the artisan's expression. The background is a blurred ivory workshop setting, maintaining a luxury, high-end editorial feel with deep blacks and ivory tones." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD4hi2peHVHqAelsvDXmmMr-tWPSWlYBh59gMqemHmNDIkOo0oxSMEP1AXq9xH_6JBKWqeeaxgouty7A9C6HtL7WF_QG4hUlNP9dQuWB17S0Vk2xvTarcgA5LasuyJIOXY3bEMHlVmSZ-peRS46aWBMIN1ZJnPTRNUZNJ862JTw4vhyXlzz_-sBD5lxP9kPBLMHWCjkjwqOCjzpxiJljKTtH9O__0pa8qAcRqQSsduKkTp15s5_VbVn_OSg5-sbDCy-vMJmWMjWxA"/>
</div>
<div>
<h3 class="font-headline-md text-[18px] text-primary">Master Artisan</h3>
<p class="font-label-caps text-[10px] text-on-surface-variant">Cotonou, BJ</p>
</div>
</div>
<nav class="flex-1 space-y-1">
<div class="flex items-center gap-4 px-6 py-4 cursor-pointer bg-primary text-on-primary font-semibold">
<span class="material-symbols-outlined">dashboard</span>
<span class="font-body-md text-body-md">Dashboard</span>
</div>
<div class="flex items-center gap-4 px-6 py-4 cursor-pointer text-on-surface-variant hover:bg-surface-container-high transition-all duration-200">
<span class="material-symbols-outlined">storefront</span>
<span class="font-body-md text-body-md">My Boutique</span>
</div>
<div class="flex items-center gap-4 px-6 py-4 cursor-pointer text-on-surface-variant hover:bg-surface-container-high transition-all duration-200">
<span class="material-symbols-outlined">auto_awesome_motion</span>
<span class="font-body-md text-body-md">Product Gallery</span>
</div>
<div class="flex items-center gap-4 px-6 py-4 cursor-pointer text-on-surface-variant hover:bg-surface-container-high transition-all duration-200">
<span class="material-symbols-outlined">payments</span>
<span class="font-body-md text-body-md">Sales &amp; Analytics</span>
</div>
<div class="flex items-center gap-4 px-6 py-4 cursor-pointer text-on-surface-variant hover:bg-surface-container-high transition-all duration-200">
<span class="material-symbols-outlined">support_agent</span>
<span class="font-body-md text-body-md">Artisan Support</span>
</div>
</nav>
<div class="px-6 mt-auto">
<div class="p-4 bg-surface-container-low border border-outline-variant/30 rounded-lg">
<p class="font-label-caps text-[10px] text-secondary uppercase mb-2">Seller Status</p>
<p class="font-body-md font-bold text-primary">Premium Seller</p>
</div>
</div>
</aside>
<!-- Main Content Canvas -->
<main class="lg:ml-80 pt-32 pb-20 px-6 md:px-margin-desktop max-w-container-max mx-auto">
<!-- Header Section -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 gap-6">
<div>
<p class="font-label-caps text-label-caps text-secondary uppercase tracking-[0.2em] mb-2">Tableau de Bord</p>
<h2 class="font-display-lg text-[48px] leading-tight text-primary">Artisanal Excellence</h2>
</div>
<button class="bg-primary text-on-primary font-label-caps text-label-caps px-8 py-4 uppercase tracking-widest hover:bg-on-surface-variant transition-all duration-300 flex items-center gap-3">
<span class="material-symbols-outlined text-[20px]">add_circle</span>
                Add New Masterpiece
            </button>
</div>
<!-- KPI Bento Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
<div class="p-8 bg-surface-container-lowest border border-outline-variant/30 flex flex-col justify-between h-48 transition-transform hover:scale-[1.02]">
<div class="flex justify-between items-start">
<span class="material-symbols-outlined text-secondary">payments</span>
<span class="text-emerald-600 font-label-caps text-[10px]">+12.5%</span>
</div>
<div>
<p class="font-label-caps text-label-caps text-on-surface-variant uppercase mb-1">Net Sales</p>
<p class="font-price-display text-[28px] text-primary">1.250.000 FCFA</p>
</div>
</div>
<div class="p-8 bg-surface-container-lowest border border-outline-variant/30 flex flex-col justify-between h-48 transition-transform hover:scale-[1.02]">
<div class="flex justify-between items-start">
<span class="material-symbols-outlined text-secondary">shopping_bag</span>
<span class="text-emerald-600 font-label-caps text-[10px]">+4.2%</span>
</div>
<div>
<p class="font-label-caps text-label-caps text-on-surface-variant uppercase mb-1">Order Volume</p>
<p class="font-price-display text-[28px] text-primary">48 Orders</p>
</div>
</div>
<div class="p-8 bg-surface-container-lowest border border-outline-variant/30 flex flex-col justify-between h-48 transition-transform hover:scale-[1.02]">
<div class="flex justify-between items-start">
<span class="material-symbols-outlined text-secondary">visibility</span>
<span class="text-secondary font-label-caps text-[10px]">Stable</span>
</div>
<div>
<p class="font-label-caps text-label-caps text-on-surface-variant uppercase mb-1">Profile Views</p>
<p class="font-price-display text-[28px] text-primary">3,842</p>
</div>
</div>
</div>
<!-- Analytics & Links Asymmetric Layout -->
<div class="asymmetric-grid mb-section-gap">
<!-- Sales Trends Chart Container -->
<div class="bg-surface-container-lowest border border-outline-variant/30 p-8">
<div class="flex justify-between items-center mb-10">
<h3 class="font-headline-md text-headline-md text-primary">Sales Trends</h3>
<div class="flex gap-4">
<span class="font-label-caps text-[10px] text-primary underline cursor-pointer">WEEKLY</span>
<span class="font-label-caps text-[10px] text-on-surface-variant cursor-pointer">MONTHLY</span>
</div>
</div>
<!-- Visual Placeholder for a Luxury Chart -->
<div class="relative h-64 w-full flex items-end justify-between px-2 overflow-hidden">
<div class="absolute inset-0 opacity-10 pointer-events-none">
<div class="w-full h-full" style="background-image: radial-gradient(#735c00 1px, transparent 1px); background-size: 32px 32px;"></div>
</div>
<!-- Custom SVG Line Chart -->
<svg class="absolute bottom-0 left-0 w-full h-full" preserveaspectratio="none" viewbox="0 0 800 200">
<path d="M0,150 Q100,120 200,140 T400,80 T600,100 T800,40" fill="none" stroke="#735c00" stroke-width="2"></path>
<path d="M0,150 Q100,120 200,140 T400,80 T600,100 T800,40 L800,200 L0,200 Z" fill="url(#goldGradient)" opacity="0.05"></path>
<defs>
<lineargradient id="goldGradient" x1="0%" x2="0%" y1="0%" y2="100%">
<stop offset="0%" style="stop-color:#fed65b;stop-opacity:1"></stop>
<stop offset="100%" style="stop-color:#ffffff;stop-opacity:0"></stop>
</lineargradient>
</defs>
</svg>
<!-- Column bars for visual rhythm -->
<div class="w-1 bg-outline-variant/20 h-full"></div>
<div class="w-1 bg-outline-variant/20 h-full"></div>
<div class="w-1 bg-outline-variant/20 h-full"></div>
<div class="w-1 bg-outline-variant/20 h-full"></div>
<div class="w-1 bg-outline-variant/20 h-full"></div>
<div class="w-1 bg-outline-variant/20 h-full"></div>
<div class="w-1 bg-outline-variant/20 h-full"></div>
</div>
<div class="flex justify-between mt-4 text-on-surface-variant font-label-caps text-[10px]">
<span>MON</span><span>TUE</span><span>WED</span><span>THU</span><span>FRI</span><span>SAT</span><span>SUN</span>
</div>
</div>
<!-- Quick Links / Manage Boutique -->
<div class="space-y-6">
<div class="bg-primary text-on-primary p-8">
<h4 class="font-headline-md text-[18px] mb-6">Manage Boutique</h4>
<ul class="space-y-4">
<li class="flex items-center justify-between group cursor-pointer">
<span class="font-body-md text-sm">Update Collection</span>
<span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">chevron_right</span>
</li>
<li class="flex items-center justify-between group cursor-pointer border-t border-on-primary/20 pt-4">
<span class="font-body-md text-sm">Shipping Profiles</span>
<span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">chevron_right</span>
</li>
<li class="flex items-center justify-between group cursor-pointer border-t border-on-primary/20 pt-4">
<span class="font-body-md text-sm">Marketing Tools</span>
<span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">chevron_right</span>
</li>
<li class="flex items-center justify-between group cursor-pointer border-t border-on-primary/20 pt-4">
<span class="font-body-md text-sm">Review Center</span>
<span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">chevron_right</span>
</li>
</ul>
</div>
<div class="bg-secondary-container p-8 flex flex-col justify-center">
<p class="font-label-caps text-[10px] text-on-secondary-container uppercase mb-2">Need Expert Help?</p>
<h4 class="font-headline-md text-[18px] text-on-secondary-container mb-4">Artisan Concierge</h4>
<button class="border border-on-secondary-container text-on-secondary-container font-label-caps text-[10px] py-3 uppercase tracking-widest hover:bg-on-secondary-container hover:text-white transition-colors">Start Consultation</button>
</div>
</div>
</div>
<!-- Recent Orders List -->
<section>
<div class="flex justify-between items-center mb-8">
<h3 class="font-headline-md text-headline-md text-primary">Recent Acquisitions</h3>
<span class="font-label-caps text-label-caps text-secondary cursor-pointer hover:underline">VIEW ALL ORDERS</span>
</div>
<div class="space-y-4">
<!-- Order Row 1 -->
<div class="flex items-center justify-between p-4 bg-surface-container-lowest border border-outline-variant/30 hover:border-secondary transition-colors group">
<div class="flex items-center gap-6">
<div class="w-20 h-20 bg-surface-container overflow-hidden">
<img alt="Order Thumbnail" class="w-full h-full object-cover" data-alt="A high-end, luxury close-up of a handcrafted Beninese leather bag. The product is shot in a professional studio setting with dramatic side-lighting that emphasizes the texture of the grain. The color palette is rich earth tones, deep blacks, and subtle ivory highlights, reflecting a museum-gallery aesthetic for an elite marketplace." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAJsDrzZ_xEDElcnClrD_mrBmTRKDLEuygNWn9Bd-2w21HBk2U7sdCq32jKOxzbsjTjPRhUd8y_UR0a5wy69RTSYCbHJYGTXoRFcPv-UL7t4m7s3W2FGOEgeu1dcsrNtXuSsd5lhnNhBN6kn7XoGzoXXaJiUBRB52q_gmzs-NTf0tc5-Buo2N2DhxQUhnD8VIyTTDtoE0W9avhaDoYmBn7xanxfVhiPlzoMRq10fiXvDeZm4Gl1f8ednz-f0M4XRwfKAEl_-GJVGQ"/>
</div>
<div>
<p class="font-label-caps text-[10px] text-on-surface-variant uppercase mb-1">Order #B8921</p>
<h4 class="font-body-md font-bold text-primary">Royal Fon Leather Satchel</h4>
<p class="font-label-caps text-[10px] text-emerald-600 uppercase">Shipped to: Paris, FR</p>
</div>
</div>
<div class="text-right flex flex-col items-end gap-2">
<p class="font-price-display text-primary">245.000 FCFA</p>
<span class="px-3 py-1 bg-surface-container text-on-surface-variant font-label-caps text-[9px] uppercase tracking-wider">Completed</span>
</div>
</div>
<!-- Order Row 2 -->
<div class="flex items-center justify-between p-4 bg-surface-container-lowest border border-outline-variant/30 hover:border-secondary transition-colors group">
<div class="flex items-center gap-6">
<div class="w-20 h-20 bg-surface-container overflow-hidden">
<img alt="Order Thumbnail" class="w-full h-full object-cover" data-alt="Exquisite artisanal jewelry piece, a bronze and gold-leaf necklace displayed on a minimalist ivory bust. The lighting is soft and diffused, creating a serene and exclusive atmosphere. High-contrast deep blacks and warm gold tones dominate the frame, aligning with an editorial luxury fashion design system." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBxM3z5d8HUvr4vSTCVBYCxHHr2KZWGCaFch3xkm4BX4JRh_5HmPJSAdlEhtWuQ0QehvtWczHIptEjXFiAzuJJnklLgFelY1w-nJA4ts3E60WRpRXc0tb7ZzgsIHDh5XuXovMguVT8VnWc8IY9jswvl3T5D2nHSo8ZHsBkxw6kCcO3SYd91hLdwFQIe3VJbHuH7qO6uMJmsuwEHCKJbDC7XazExcQU-1IMODvPbJW43CxZXb-op2SyMXX0ZuLpj_ODVSTQAPxKdNw"/>
</div>
<div>
<p class="font-label-caps text-[10px] text-on-surface-variant uppercase mb-1">Order #B8920</p>
<h4 class="font-body-md font-bold text-primary">Dahomey Bronze Necklace</h4>
<p class="font-label-caps text-[10px] text-secondary uppercase">Processing: Lagos, NG</p>
</div>
</div>
<div class="text-right flex flex-col items-end gap-2">
<p class="font-price-display text-primary">180.000 FCFA</p>
<span class="px-3 py-1 bg-secondary-container text-on-secondary-container font-label-caps text-[9px] uppercase tracking-wider">In Progress</span>
</div>
</div>
<!-- Order Row 3 -->
<div class="flex items-center justify-between p-4 bg-surface-container-lowest border border-outline-variant/30 hover:border-secondary transition-colors group">
<div class="flex items-center gap-6">
<div class="w-20 h-20 bg-surface-container overflow-hidden">
<img alt="Order Thumbnail" class="w-full h-full object-cover" data-alt="Handcrafted ceramic vessel with traditional Beninese patterns, presented in a high-key minimalist setting. The vessel's matte black finish contrasts beautifully with the warm ivory background. Studio lighting highlights the intricate surface details and artisanal heritage, maintaining a clean, luxurious, and vivid visual narrative." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDjS0zIQeX9NcNqSPQ2H9L_oZbNY-UdqnC2DH0y2H64sdshR_XMewmM6iqXsYwJgQJvHBksmH2Ek9fOyyzlY5HicbAwFodNpIVtJAdGD-z1XVeLU_OMNzA2bWwfTVKtBC7AbdGlA-WOKxukI5lypSgLSWVQ3iMSmaA0lRLal83EH91vC5e-ciiwYF4mfCh2Mjj4JxxUKifiP64a3XDF8emMsCbW6OMHdmuqF1Hcwofx4sG85UOLWs5IQGSE-eymHzqtBMxuSFCT5g"/>
</div>
<div>
<p class="font-label-caps text-[10px] text-on-surface-variant uppercase mb-1">Order #B8919</p>
<h4 class="font-body-md font-bold text-primary">Abomey Pattern Ceramic</h4>
<p class="font-label-caps text-[10px] text-on-surface-variant uppercase">New: Cotonou, BJ</p>
</div>
</div>
<div class="text-right flex flex-col items-end gap-2">
<p class="font-price-display text-primary">95.000 FCFA</p>
<span class="px-3 py-1 bg-surface-variant text-on-surface-variant font-label-caps text-[9px] uppercase tracking-wider">Awaiting Pmt</span>
</div>
</div>
</div>
</section>
</main>
<!-- Footer -->
<footer class="w-full mt-section-gap border-t border-outline-variant/50 bg-surface-container-lowest">
<div class="flex flex-col md:flex-row justify-between items-center px-margin-desktop py-12 w-full max-w-container-max mx-auto">
<h1 class="font-headline-md text-headline-md text-primary mb-6 md:mb-0">L'ÉCLAT DU BÉNIN</h1>
<div class="flex flex-wrap gap-8 items-center justify-center mb-8 md:mb-0">
<span class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant/80 hover:text-primary transition-colors cursor-pointer">The Artisans</span>
<span class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant/80 hover:text-primary transition-colors cursor-pointer">Our Story</span>
<span class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant/80 hover:text-primary transition-colors cursor-pointer">Seller Terms</span>
<span class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant/80 hover:text-primary transition-colors cursor-pointer">Privacy</span>
</div>
<p class="font-label-caps text-label-caps uppercase tracking-widest text-on-surface-variant/60">© 2024 L'Éclat du Bénin. Heritage Excellence.</p>
</div>
</footer>
<!-- FAB (Suppressed for focused dashboard experience as per mandate) -->
<script>
        // Micro-interactions for chart responsiveness
        document.addEventListener('DOMContentLoaded', () => {
            const chartBars = document.querySelectorAll('.asymmetric-grid .w-1');
            chartBars.forEach((bar, index) => {
                const height = Math.floor(Math.random() * 60) + 20;
                bar.style.height = '0%';
                setTimeout(() => {
                    bar.style.transition = `height 1s cubic-bezier(0.4, 0, 0.2, 1) ${index * 0.1}s`;
                    bar.style.height = `${height}%`;
                }, 100);
            });
        });
    </script>
</body></html>
