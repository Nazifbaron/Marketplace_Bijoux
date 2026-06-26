<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Connexion | L'Éclat du Bénin</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = { theme: { extend: {
            colors: {
                "primary":"#000000","secondary":"#735c00","background":"#faf9f6","surface":"#ffffff",
                "outline-variant":"#c4c7c7","on-surface-variant":"#444748","on-surface":"#1a1c1a",
                "secondary-fixed":"#ffe088","error":"#ba1a1a","error-container":"#ffdad6","on-primary":"#ffffff",
            },
            fontFamily: { "label-caps":["Montserrat"], "display-lg-mobile":["Playfair Display"], "headline-md":["Playfair Display"], "body-md":["Montserrat"] },
            fontSize: {
                "label-caps":["12px",{"lineHeight":"16px","letterSpacing":"0.1em","fontWeight":"600"}],
                "display-lg-mobile":["40px",{"lineHeight":"48px","letterSpacing":"-0.01em","fontWeight":"700"}],
                "headline-md":["24px",{"lineHeight":"32px","fontWeight":"600"}],
                "body-md":["16px",{"lineHeight":"24px","fontWeight":"400"}],
            }
        }}}
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24; }
        .float-label-group { position: relative; }
        .float-label-group input { width: 100%; background: transparent; border: none; border-bottom: 1px solid #c4c7c7; padding: 20px 0 8px 0; font-size: 16px; outline: none; transition: border-color 0.2s; }
        .float-label-group input:focus { border-bottom-color: #735c00; }
        .float-label-group label { position: absolute; left: 0; top: 20px; font-size: 12px; letter-spacing: 0.1em; font-weight: 600; color: #444748; text-transform: uppercase; pointer-events: none; transition: all 0.2s ease; }
        .float-label-group input:focus ~ label, .float-label-group input:not(:placeholder-shown) ~ label { top: 4px; font-size: 10px; color: #735c00; }
        .field-error { display: block; margin-top: 4px; font-size: 11px; color: #ba1a1a; }
    </style>
</head>
<body class="bg-background text-on-surface min-h-screen flex flex-col">

<header class="w-full px-8 py-6 flex justify-center">
    <a href="{{ url('/') }}" class="font-headline-md text-headline-md font-bold text-primary uppercase tracking-widest">
        L'ÉCLAT DU BÉNIN
    </a>
</header>

<main class="flex-grow flex items-center justify-center px-6 pb-20">
    <div class="w-full max-w-md">

        <div class="text-center mb-10">
            <h1 class="font-display-lg-mobile text-display-lg-mobile text-primary mb-3">Bienvenue</h1>
            <p class="text-sm text-on-surface-variant">Connectez-vous pour accéder à votre espace</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 border-l-2 border-error bg-error-container/30">
                @foreach ($errors->all() as $error)
                    <p class="text-sm text-error">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if(session('info'))
            <div class="mb-6 p-4 bg-surface-container-low border-l-2 border-secondary">
                <p class="text-sm text-on-surface-variant">{{ session('info') }}</p>
            </div>
        @endif

        <form action="{{ route('login.submit') }}" method="POST" class="space-y-8" id="login-form">
            @csrf

            <div class="float-label-group">
                <input type="email" id="email" name="email" placeholder=" " value="{{ old('email') }}" autocomplete="email" />
                <label for="email">Adresse Email</label>
                @error('email')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="float-label-group">
                <input type="password" id="password" name="password" placeholder=" " autocomplete="current-password" />
                <label for="password">Mot de Passe</label>
                @error('password')
                    <span class="field-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 text-on-surface-variant cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded-none border-outline-variant text-primary focus:ring-0" />
                    Se souvenir de moi
                </label>
                <a href="#" class="text-secondary hover:text-primary transition-colors">Mot de passe oublié ?</a>
            </div>

            <button type="submit" id="submit-btn"
                class="w-full bg-primary text-on-primary py-4 font-label-caps text-label-caps uppercase tracking-widest hover:bg-on-surface-variant transition-all flex items-center justify-center gap-2">
                <span id="btn-text">Se Connecter</span>
                <span id="btn-loader" class="hidden material-symbols-outlined text-[18px]" style="animation: spin 1s linear infinite;">progress_activity</span>
            </button>
        </form>

        <p class="text-center text-sm text-on-surface-variant mt-8">
            Pas encore artisan partenaire ?
            <a href="{{ route('artisan.onboarding.step1') }}" class="text-secondary font-semibold hover:text-primary transition-colors">Rejoindre la maison</a>
        </p>
    </div>
</main>

<style>@keyframes spin { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }</style>
<script>
document.getElementById('login-form').addEventListener('submit', function() {
    document.getElementById('btn-text').textContent = 'Connexion...';
    document.getElementById('btn-loader').classList.remove('hidden');
    document.getElementById('submit-btn').disabled = true;
});
</script>

</body>
</html>
