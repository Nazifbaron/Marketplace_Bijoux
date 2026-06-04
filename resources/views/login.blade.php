<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion — L'Éclat du Bénin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-xl bg-white shadow-xl rounded-3xl overflow-hidden">
        <div class="p-10">
            <div class="mb-8">
                <h1 class="text-3xl font-semibold">Connexion</h1>
                <p class="mt-3 text-slate-600">Connectez-vous pour accéder à votre compte.</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <label class="block">
                    <span class="text-sm font-medium">Adresse email</span>
                    <input type="email" name="email" value="{{ old('email') }}" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 focus:border-slate-400 focus:outline-none" placeholder="email@example.com">
                </label>

                <label class="block">
                    <span class="text-sm font-medium">Mot de passe</span>
                    <input type="password" name="password" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 focus:border-slate-400 focus:outline-none" placeholder="Mot de passe">
                </label>

                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-500" />
                    Se souvenir de moi
                </label>

                <button type="submit" class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-white font-semibold hover:bg-slate-800 transition">Se connecter</button>
            </form>

            <p class="mt-6 text-sm text-slate-600">Pas encore de compte ? <a href="{{ route('register.show') }}" class="text-slate-900 font-semibold underline">S’inscrire</a></p>
        </div>
    </div>
</body>
</html>
