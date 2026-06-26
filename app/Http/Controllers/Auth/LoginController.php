<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            return redirect('/');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'L’email est obligatoire.',
            'email.email' => 'L’adresse email n’est pas valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Identifiants invalides.'])->onlyInput('email');
        }

        $request->session()->regenerate();

        // Redirection spécifique pour les administrateurs
        $user = Auth::user();
        if (method_exists($user, 'isAdmin') ? $user->isAdmin() : ($user->role ?? null) === \App\Models\User::ROLE_ADMIN) {
            return redirect()->intended(route('admin.artisans.index'));
        }

        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Vous êtes bien déconnecté.');
    }
}
