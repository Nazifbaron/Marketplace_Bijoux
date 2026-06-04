<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArtisanApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class AdminArtisanController extends Controller
{

    public function index(Request $request)
    {
        $status = $request->get('status', 'pending_review');

        $query = ArtisanApplication::with('user')
            ->orderBy('created_at', 'desc');

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $applications = $query->paginate(10);

        $counts = [
            'all'            => ArtisanApplication::count(),
            'pending_review' => ArtisanApplication::where('status', 'pending_review')->count(),
            'approved'       => ArtisanApplication::where('status', 'approved')->count(),
            'rejected'       => ArtisanApplication::where('status', 'rejected')->count(),
        ];

        return view('admin.artisans', compact('applications', 'status', 'counts'));
    }


    public function show(ArtisanApplication $application)
    {
        $application->load('user', 'reviewer');
        return view('admin.artisan-detail', compact('application'));
    }

    public function serveDocument(ArtisanApplication $application, string $type)
    {
        // Vérifier que le type demandé est valide (sécurité)
        if (!in_array($type, ['identity', 'certification'])) {
            abort(404, 'Type de document invalide.');
        }

        // Récupérer le chemin du fichier selon le type
        $filePath = match($type) {
            'identity'      => $application->id_document_path,
            'certification' => $application->certification_path,
        };

        // Si pas de fichier pour ce type
        if (!$filePath) {
            abort(404, 'Document non soumis par l\'artisan.');
        }

        // Vérifier que le fichier existe physiquement sur le disque
        if (!Storage::disk('private')->exists($filePath)) {
            abort(404, 'Fichier introuvable sur le serveur.');
        }

        // Déterminer le type MIME pour que le navigateur sache comment afficher
        // Storage::mimeType() lit le fichier et retourne ex: "image/jpeg" ou "application/pdf"
        $mimeType = Storage::disk('private')->mimeType($filePath);

        // Récupérer le contenu binaire du fichier
        $fileContent = Storage::disk('private')->get($filePath);

        // Construire un nom de fichier propre pour le téléchargement
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $filename  = "dossier-{$application->id}-{$type}.{$extension}";

        // Retourner le fichier avec les bons headers HTTP
        // 'inline' = s'afficher dans le navigateur (pas forcer le téléchargement)
        return response($fileContent, 200)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', "inline; filename=\"{$filename}\"")
            ->header('Cache-Control', 'private, no-store'); // Pas de mise en cache
    }

    public function approve(Request $request, ArtisanApplication $application)
    {
        if (!$application->isPendingReview()) {
            return back()->with('error', 'Ce dossier n\'est pas en attente de revue.');
        }

        $validated = $request->validate([
            'admin_notes' => ['nullable', 'string', 'max:1000'],
        ]);


        $application->update([
            'status'      => 'approved',
            'admin_notes' => $validated['admin_notes'] ?? null,
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        // TODO: Envoyer l'email de bienvenue à l'artisan
        /*
        try {
            Mail::to($application->user->email)
                ->send(new \App\Mail\ApplicationApproved($application));
        } catch (\Exception $e) {
            Log::error('Erreur email approbation: ' . $e->getMessage());
        }
        */

        return redirect()
            ->route('admin.artisans.index')
            ->with('success', "La demande de {$application->full_name} a été approuvée.");
    }


    public function reject(Request $request, ArtisanApplication $application)
    {
        if (!$application->isPendingReview()) {
            return back()->with('error', 'Ce dossier n\'est pas en attente de revue.');
        }

        $validated = $request->validate([
            'admin_notes' => ['required', 'string', 'min:10', 'max:1000'],
        ], [
            'admin_notes.required' => 'Veuillez indiquer la raison du rejet.',
            'admin_notes.min'      => 'La raison doit faire au moins 10 caractères.',
        ]);

        $application->update([
            'status'      => 'rejected',
            'admin_notes' => $validated['admin_notes'],
            'reviewed_by' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        // TODO: Envoyer l'email de notification de rejet
        /*
        try {
            Mail::to($application->user->email)
                ->send(new \App\Mail\ApplicationRejected($application));
        } catch (\Exception $e) {
            Log::error('Erreur email rejet: ' . $e->getMessage());
        }
        */

        return redirect()
            ->route('admin.artisans.index')
            ->with('success', "La demande de {$application->full_name} a été rejetée.");
    }
}
