<?php

namespace App\Http\Controllers\Artisan;

use App\Http\Controllers\Controller;
use App\Models\ArtisanApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ArtisanDashboardController extends Controller
{
    public function index()
    {
        $application = ArtisanApplication::where('user_id', Auth::id())->first();

        if (!$application) {
            return redirect()->route('artisan.onboarding.step1');
        }

        // Si la demande n'est pas encore approuvée, rediriger vers la page d'attente
        if ($application->status !== 'approved') {
            return redirect()->route('artisan.onboarding.waiting');
        }

        // Statistiques par défaut (la base n'a pas encore de modèles produits/commandes)
        $stats = [
            'products' => 0,
            'orders'   => 0,
            'views'    => 0,
            'revenue'  => 0,
        ];

        return view('artisan.dashboard', compact('application', 'stats'));
    }
}
