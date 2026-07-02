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
            'name' => ['required', 'string', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(6)],
        ], [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L’email est obligatoire.',
            'email.email' => 'L’adresse email n’est pas valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.min' => 'Le mot de passe doit faire au moins 6 caractères.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => User::ROLE_CUSTOMER,
        ]);

        Auth::login($user);

        return redirect('/')
            ->with('success', 'Votre compte client a bien été créé.');
    }

    public function showLogin()
    {

        if (Auth::check()) {
            return $this->redirectAfterLogin();
        }

        return view('auth.login');
    }

    /**
     * Traite la soumission du formulaire de connexion
     */
    public function login(Request $request)
    {
        // Validation des champs
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required'    => 'L\'adresse email est obligatoire.',
            'email.email' => 'L’adresse email n’est pas valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {

            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Identifiants incorrects. Vérifiez votre email et mot de passe.']);
        }

        $request->session()->regenerate();



        return $this->redirectAfterLogin();
    }

    /**
     * Déconnexion
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Vous avez été déconnecté.');
    }

    public function redirectAfterLogin()
    {
        $user = Auth::user();
        // Si l'utilisateur est admin, priorité au dashboard admin
        if (method_exists($user, 'isAdmin') ? $user->isAdmin() : ($user->role ?? null) === \App\Models\User::ROLE_ADMIN) {
            return redirect()->route('admin.artisans.index');
        }

        // ── 2. Chercher la demande artisan de cet utilisateur ──
        $application = ArtisanApplication::where('user_id', $user->id)->first();

        // ── 3. Pas encore de demande → aller s'inscrire ──
        if (!$application) {
            return redirect()->route('artisan.onboarding.step1')
                ->with('info', 'Commencez votre candidature pour rejoindre L\'Éclat du Bénin.');
        }

        // ── 4. Rediriger selon le statut de la demande ──
        return match ($application->status) {

            // Inscription incomplète : retourner à l'étape 2
            'draft',
            'pending_docs'   => redirect()->route('artisan.onboarding.step2')
                ->with('info', 'Finalisez la configuration de votre boutique.'),

            // Dossier approuvé : accéder au dashboard ✅
            'approved'       => redirect()->route('artisan.dashboard')
                ->with('welcome', "Bienvenue {$user->name} ! Votre boutique est active."),

            // En attente ou rejeté : page d'attente/résultat
            'pending_review',
            'rejected'       => redirect()->route('artisan.onboarding.waiting'),

            // Cas par défaut
            default          => redirect()->route('artisan.onboarding.step1'),
        };
    }
}
