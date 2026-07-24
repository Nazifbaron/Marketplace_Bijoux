<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ArtisanApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthenticatedLoginController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'min:3', 'max:100'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
        ], [
            'name.required'      => 'Le nom est obligatoire.',
            'email.required'     => 'L\'email est obligatoire.',
            'email.email'        => 'L\'adresse email n\'est pas valide.',
            'email.unique'       => 'Cette adresse email est déjà utilisée.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.min'       => 'Le mot de passe doit faire au moins 6 caractères.',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => User::ROLE_CUSTOMER,
        ]);

        Auth::login($user);

        // Nouveau client → page d'accueil directement
        return redirect('/')
            ->with('success', 'Bienvenue sur L\'Éclat du Bénin !');
    }

    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectAfterLogin();
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required'    => 'L\'adresse email est obligatoire.',
            'email.email'       => 'L\'adresse email n\'est pas valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Identifiants incorrects. Vérifiez votre email et mot de passe.']);
        }

        $request->session()->regenerate();

        

        // ── REDIRECTION INTELLIGENTE ──
        // Priorité 1 : champ hidden redirect (vient du bouton "Se connecter pour commander")
        $redirect = $request->input('redirect');

        // Priorité 2 : url.intended sauvegardée par middleware auth (vient de /commander direct)
        if (!$redirect) {
            $redirect = session()->pull('url.intended');
        }

        // Vérifier que c'est une URL locale valide (sécurité anti open-redirect)
        if ($redirect) {
    return redirect($redirect);
}

        return $this->redirectAfterLogin();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Vous avez été déconnecté.');
    }

    /**
     * LOGIQUE DE REDIRECTION APRÈS CONNEXION
     * ==========================================
     * Ordre de priorité :
     *   1. Admin          → dashboard admin
     *   2. Artisan approuvé → dashboard vendeur
     *   3. Artisan en cours d'inscription → reprendre où il en était
     *   4. Client acheteur → page d'accueil (ou panier si c'est ce qui l'a amené)
     */
    public function redirectAfterLogin()
    {
        $user = Auth::user();

        // ── 1. ADMIN ──
        $isAdmin = method_exists($user, 'isAdmin')
            ? $user->isAdmin()
            : ($user->role ?? null) === User::ROLE_ADMIN;

        if ($isAdmin) {
            return redirect()->route('admin.artisans.index');
        }

        // ── 2. CHERCHER UNE CANDIDATURE ARTISAN ──
        $application = ArtisanApplication::where('user_id', $user->id)->first();

        // ── 3. PAS DE CANDIDATURE → client acheteur normal ──
        // On l'envoie sur la page d'accueil, pas vers l'inscription vendeur.
        // S'il veut devenir vendeur, il cliquera sur "Créer sa boutique" dans le menu.
        if (!$application) {
            return redirect('/')
                ->with('success', "Bon retour, {$user->name} !");
        }



        // ── 4. A UNE CANDIDATURE → rediriger selon le statut ──
        return match ($application->status) {

            // Inscription incomplète → reprendre à l'étape 2
            'draft',
            'pending_docs'   => redirect()->route('artisan.onboarding.step2')
                ->with('info', 'Finalisez la configuration de votre boutique.'),

            // Dossier soumis ou rejeté → page d'attente/résultat
            'pending_review',
            'rejected'       => redirect()->route('artisan.onboarding.waiting'),

            // Artisan approuvé → dashboard vendeur
            'approved'       => redirect()->route('artisan.dashboard')
                ->with('welcome', "Bienvenue {$user->name} ! Votre boutique est active."),

            // Cas par défaut inattendu
            default          => redirect('/'),
        };
    }
}
