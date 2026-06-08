<?php

namespace App\Http\Controllers\Artisan;

use App\Http\Controllers\Controller;
use App\Models\ArtisanApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;


class ArtisanOnboardingController extends Controller
{

    public function devenir()
    {
        return view('artisan.devenir');
    }

    public function showStep1()
    {
        // Si l'utilisateur est connecté et a déjà une demande
        if (Auth::check()) {
            $existing = ArtisanApplication::where('user_id', Auth::id())->first();

            if ($existing) {
                return $this->redirectToCurrentStep($existing);
            }
        }

        return view('artisan.register');
    }


    public function storeStep1(Request $request)
    {

        $validated = $request->validate([
            'profile_type' => ['required', 'in:independent,house'],
            'full_name'    => ['required', 'string', 'min:3', 'max:100'],
            'email'        => ['required', 'email', 'unique:users,email'],
            'phone'        => ['required', 'string', 'min:8', 'max:20'],
            'password'     => ['required', 'confirmed', Password::min(6)],
            // 'password_confirmation' est vérifié par 'confirmed' automatiquement
        ], [
            'full_name.required' => 'Le nom complet est obligatoire.',
            'email.unique'       => 'Cette adresse email est déjà utilisée.',
            'email.email'        => 'L\'adresse email n\'est pas valide.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.min'       => 'Le mot de passe doit faire au moins 6 caractères.',
        ]);

        DB::transaction(function () use ($validated) {

            $user = User::create([
                'name'     => $validated['full_name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role'     => User::ROLE_SELLER,
            ]);

            $application = ArtisanApplication::create([
                'user_id'      => $user->id,
                'profile_type' => $validated['profile_type'],
                'full_name'    => $validated['full_name'],
                'phone'        => $validated['phone'],
                'status'       => 'draft', // Étape 1 complète
            ]);

            Auth::login($user);

            session(['application_id' => $application->id]);
        });

        return redirect()
            ->route('artisan.onboarding.step2')
            ->with('success', 'Profil créé avec succès !');
    }


    public function showStep2()
    {
        $application = $this->getApplicationOrFail();

        if (!$application) {
            return redirect()->route('artisan.onboarding.step1')
                ->with('error', 'Veuillez d\'abord compléter l\'étape 1.');
        }

        if ($application->status === 'pending_review') {
            return redirect()->route('artisan.onboarding.waiting');
        }

        return view('artisan.config', compact('application'));
    }


    public function storeStep2(Request $request)
    {
        $application = $this->getApplicationOrFail();

        if (!$application) {
            return redirect()->route('artisan.onboarding.step1');
        }

        // --- VALIDATION ---
        $validated = $request->validate([
            'shop_name'       => ['required', 'string', 'min:2', 'max:100'],
            'craft_type'      => ['required', 'in:leather,jewelry,textile,sculpture'],
            'shop_story'      => ['required', 'string', 'min:50', 'max:2000'],
            'id_document'     => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'], // 5MB max
            'certification'   => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
        ], [
            'shop_name.required'    => 'Le nom de votre boutique est obligatoire.',
            'craft_type.required'   => 'Veuillez sélectionner votre domaine artisanal.',
            'shop_story.required'   => 'L\'histoire de votre maison est obligatoire.',
            'shop_story.min'        => 'L\'histoire doit faire au moins 50 caractères.',
            'id_document.required'  => 'Votre pièce d\'identité est obligatoire.',
            'id_document.mimes'     => 'Format accepté : PDF, JPG, PNG.',
            'id_document.max'       => 'Le fichier ne doit pas dépasser 5MB.',
        ]);

        // --- UPLOAD DES FICHIERS ---
        // Les fichiers sont stockés dans storage/app/private/artisan-docs/
        // Ils sont inaccessibles publiquement (sécurité des documents)
        $idDocumentPath    = null;
        $certificationPath = null;

        if ($request->hasFile('id_document')) {
            // store() génère un nom unique et retourne le chemin
            $idDocumentPath = $request->file('id_document')
                ->store("artisan-docs/{$application->id}/identity", 'private');
        }

        if ($request->hasFile('certification')) {
            $certificationPath = $request->file('certification')
                ->store("artisan-docs/{$application->id}/certification", 'private');
        }

        // --- MISE À JOUR DE LA DEMANDE ---
        $application->update([
            'shop_name'          => $validated['shop_name'],
            'craft_type'         => $validated['craft_type'],
            'shop_story'         => $validated['shop_story'],
            'id_document_path'   => $idDocumentPath,
            'certification_path' => $certificationPath,
            'status'             => 'pending_review', // ← Dossier soumis !
        ]);

        // --- NOTIFICATION ADMIN ---
        // Envoyer un email à l'admin pour lui dire qu'un nouveau dossier est là
        // (Décommente quand tu as configuré MAIL_* dans .env)
        /*
        try {
            Mail::to(config('mail.admin_address', 'admin@eclat-benin.com'))
                ->send(new \App\Mail\NewApplicationReceived($application));
        } catch (\Exception $e) {
            Log::error('Erreur envoi email admin: ' . $e->getMessage());
            // On ne bloque pas l'utilisateur si l'email échoue
        }
        */

        // Vider la session (plus besoin de l'application_id)
        session()->forget('application_id');

        return redirect()->route('artisan.onboarding.waiting')
            ->with('success', 'Votre dossier a été soumis avec succès !');
    }


    public function showWaiting()
    {
        $application = ArtisanApplication::where('user_id', Auth::id())->first();


        if (!$application) {
            return redirect()->route('artisan.onboarding.step1');
        }

        return view('artisan.attente', compact('application'));
    }

     public function checkStatus()
    {
        $application = ArtisanApplication::where('user_id', Auth::id())->first();

        if (!$application) {
            return response()->json(['status' => 'none', 'redirect' => null]);
        }

        $redirect = null;

        if ($application->isApproved()) {
            $redirect = route('artisan.dashboard');
        }

        return response()->json([
            'status'   => $application->status,
            'redirect' => $redirect,
        ]);
    }

    private function getApplicationOrFail(): ?ArtisanApplication
    {

        if ($applicationId = session('application_id')) {
            return ArtisanApplication::find($applicationId);
        }

        if (Auth::check()) {
            return ArtisanApplication::where('user_id', Auth::id())->first();
        }

        return null;
    }


    private function redirectToCurrentStep(ArtisanApplication $application)
    {
        return match($application->status) {
            'draft'          => redirect()->route('artisan.onboarding.step2'),
            'pending_docs'   => redirect()->route('artisan.onboarding.step2'),
            'pending_review',
            'approved',
            'rejected'       => redirect()->route('artisan.onboarding.waiting'),
            default          => redirect()->route('artisan.onboarding.step1'),
        };
    }

   /* public function dashboard()
    {
        $application = ArtisanApplication::where('user_id', Auth::id())->first();

        if (!$application || $application->status !== 'approved') {
            return redirect()->route('artisan.onboarding.waiting');
        }

        return view('artisan.dashboard', compact('application'));
    }*/
}
