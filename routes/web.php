<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Artisan\ArtisanOnboardingController;
use App\Http\Controllers\Admin\AdminArtisanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/', function () {
    return view('accueil');
});
Route::view('/artisan', 'artisan');
Route::view('/collection', 'collection');
Route::view('/detail', 'detail');
Route::view('/bijoux', 'bijoux');
Route::view('/art', 'art');
Route::view('/maroquerie', 'maroquerie');
Route::view('/config', 'config');
Route::view('/attente', 'attente');
Route::view('/dashboard', 'artisan.dashboard');
Route::view('/ajout', 'artisan.ajout');

Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');



Route::prefix('inscription')->name('artisan.onboarding.')->group(function () {

    Route::get('/became', [ArtisanOnboardingController::class, 'devenir'])->name('became');
    // ÉTAPE 1 : Formulaire d'inscription
    Route::get('/', [ArtisanOnboardingController::class, 'showStep1'])->name('step1');
    Route::post('/etape-1', [ArtisanOnboardingController::class, 'storeStep1'])->name('step1.store');

});

Route::prefix('inscription')->name('artisan.onboarding.')->middleware('auth')->group(function () {

    // ÉTAPE 2 : Configuration de la boutique
    Route::get('/etape-2', [ArtisanOnboardingController::class, 'showStep2'])->name('step2');
    Route::post('/etape-2', [ArtisanOnboardingController::class, 'storeStep2'])->name('step2.store');
    // ÉTAPE 3 : Page d'attente
    Route::get('/attente', [ArtisanOnboardingController::class, 'showWaiting'])->name('waiting');
   // Route::get('/dashboard', [ArtisanOnboardingController::class, 'dashboard'])
      //  ->name('dashboard');

    //Route::get('/add',[ArtisanOnboardingController::class, 'addProduct'])
        //->name('addProduct');
    
    });

Route::prefix('admin')->name('admin.artisans.')->middleware(['auth', 'admin'])->group(function () {

    // Liste des demandes (avec filtre ?status=pending_review)
    Route::get('/artisans', [AdminArtisanController::class, 'index'])
        ->name('index');

    // Détail d'une demande
    Route::get('/artisans/{application}', [AdminArtisanController::class, 'show'])
        ->name('show');


    // ── NOUVEAU : Servir un document privé (identité ou certification) ──
    // URL exemple : /admin/artisans/12/document/identity
    Route::get('/artisans/{application}/document/{type}', [AdminArtisanController::class, 'serveDocument'])
        ->name('document')
        ->where('type', 'identity|certification'); // Seuls ces 2 types sont acceptés

    // Approuver une demande
    Route::post('/artisans/{application}/approve', [AdminArtisanController::class, 'approve'])
        ->name('approve');

    // Rejeter une demande
    Route::post('/artisans/{application}/reject', [AdminArtisanController::class, 'reject'])
        ->name('reject');

});
