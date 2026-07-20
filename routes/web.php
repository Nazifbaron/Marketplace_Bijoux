<?php

use App\Http\Controllers\Artisan\ArtisanOnboardingController;
use App\Http\Controllers\Artisan\ArtisanDashboardController;
use App\Http\Controllers\Artisan\ProductController;
use App\Http\Controllers\Artisan\OrderController as ArtisanOrderController;
use App\Http\Controllers\Admin\AdminArtisanController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Auth\AuthenticatedLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CollectionController;
use Illuminate\Support\Facades\Route;

/**
 * ROUTES V2 — AJOUTS PAR RAPPORT À LA VERSION PRÉCÉDENTE
 * =====================================================================
 * Ce fichier contient TOUTES les routes. Si tu avais déjà un web.php,
 * remplace-le entièrement par celui-ci (il inclut tout l'existant +
 * les nouveautés produits/commandes/chat/collections).
 * =====================================================================
 */

Route::get('/', function () {
    return view('accueil');
});
Route::view('/artisan', 'artisan');
Route::view('/collection', 'collection');
Route::view('/bijoux', 'bijoux');
Route::view('/art', 'art');
Route::view('/maroquinerie', 'maroquinerie');


// ====================================================================
// AUTH
// ====================================================================

Route::get('/register', [AuthenticatedLoginController::class, 'show'])->name('register');
Route::post('/register', [AuthenticatedLoginController::class, 'store'])->name('register.store');
Route::get('/login', [AuthenticatedLoginController::class, 'showLogin'])->middleware('guest')->name('login');
Route::post('/login', [AuthenticatedLoginController::class, 'login'])->middleware('guest')->name('login.submit');
Route::post('/logout', [AuthenticatedLoginController::class, 'logout'])->middleware('auth')->name('logout');

// ====================================================================
// ONBOARDING ARTISAN
// ====================================================================
Route::prefix('inscription')->name('artisan.onboarding.')->group(function () {

    Route::get('/became', [ArtisanOnboardingController::class, 'devenir'])->name('became');
    Route::get('/', [ArtisanOnboardingController::class, 'showStep1'])->name('step1');
    Route::post('/etape-1', [ArtisanOnboardingController::class, 'storeStep1'])->name('step1.store');
});

Route::prefix('inscription')->name('artisan.onboarding.')->middleware('auth')->group(function () {
    Route::get('/etape-2', [ArtisanOnboardingController::class, 'showStep2'])->name('step2');
    Route::post('/etape-2', [ArtisanOnboardingController::class, 'storeStep2'])->name('step2.store');
    Route::get('/attente', [ArtisanOnboardingController::class, 'showWaiting'])->name('waiting');
    Route::get('/statut', [ArtisanOnboardingController::class, 'checkStatus'])->name('check.status');
});

// ====================================================================
// ESPACE VENDEUR (dashboard, produits, commandes)
// ====================================================================
Route::prefix('artisan')->name('artisan.')->middleware('auth')->group(function () {

    Route::get('/dashboard', [ArtisanDashboardController::class, 'index'])->name('dashboard');

    // ── PRODUITS ──
    Route::get('/produits',              [ProductController::class, 'index'])->name('products.index');
    Route::get('/produits/nouveau',      [ProductController::class, 'create'])->name('products.create');
    Route::post('/produits',             [ProductController::class, 'store'])->name('products.store');
    Route::get('/produits/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/produits/{product}',    [ProductController::class, 'update'])->name('products.update');
    Route::delete('/produits/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::delete('/produits/image/{image}', [ProductController::class, 'destroyImage'])->name('products.images.destroy');
    Route::post('/produits/{product}/demander-verification', [ProductController::class, 'requestVerification'])->name('products.request-verification');

    // ── COMMANDES ──
    Route::get('/commandes', [ArtisanOrderController::class, 'index'])->name('orders.index');
    Route::patch('/commandes/{item}/statut', [ArtisanOrderController::class, 'updateStatus'])->name('orders.update-status');

});

// ====================================================================
// CHAT (partagé acheteur / vendeur)
// ====================================================================
Route::middleware('auth')->prefix('messagerie')->name('chat.')->group(function () {
    Route::get('/', [ChatController::class, 'index'])->name('index');
    Route::get('/{conversation}', [ChatController::class, 'show'])->name('show');
    Route::post('/{conversation}/envoyer', [ChatController::class, 'send'])->name('send');
    Route::post('/contacter/{vendor}', [ChatController::class, 'startWithVendor'])->name('start');
});

// ====================================================================
// PAGES PUBLIQUES — COLLECTION (remplace les 4 fichiers statiques)
// ====================================================================
Route::get('/collection', [CollectionController::class, 'index'])->name('collection.index');
Route::get('/collection/produit/{product:slug}', [CollectionController::class, 'showProduct'])->name('collection.product');
Route::get('/collection/{category:slug}', [CollectionController::class, 'show'])->name('collection.category');
Route::get('/produit/{product:slug}', [CollectionController::class, 'quickView']);
Route::get('/bijoux', [CollectionController::class, 'bijoux'])->name('collection.bijoux');
Route::get('/art', [CollectionController::class, 'art'])->name('collection.art');
Route::get('/maroquinerie', [CollectionController::class, 'maroquinerie'])->name('collection.maroquinerie');

// ====================================================================
// ADMIN
// ====================================================================
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::name('admin.artisans.')->group(function () {
        Route::get('/artisans', [AdminArtisanController::class, 'index'])->name('index');
        Route::get('/artisans/{application}', [AdminArtisanController::class, 'show'])->name('show');
        Route::get('/artisans/{application}/document/{type}', [AdminArtisanController::class, 'serveDocument'])
            ->name('document')->where('type', 'identity|certification');
        Route::post('/artisans/{application}/approve', [AdminArtisanController::class, 'approve'])->name('approve');
        Route::post('/artisans/{application}/reject', [AdminArtisanController::class, 'reject'])->name('reject');
    });

    // ── Modération produits (publier / rejeter une fiche) ──
    Route::name('admin.products.')->prefix('produits')->group(function () {
        Route::get('/moderation', [AdminProductController::class, 'moderationQueue'])->name('moderation');
        Route::get('/verification', [AdminProductController::class, 'verificationQueue'])->name('verification');
        Route::post('/{product}/publier', [AdminProductController::class, 'publish'])->name('publish');
        Route::post('/{product}/rejeter', [AdminProductController::class, 'rejectModeration'])->name('reject');
        Route::post('/{product}/verifier', [AdminProductController::class, 'approveVerification'])->name('verify.approve');
        Route::post('/{product}/refuser-verification', [AdminProductController::class, 'rejectVerification'])->name('verify.reject');
    });

});

// Routes admin catégories
Route::prefix('admin/categories')->name('admin.categories.')->middleware(['auth','admin'])->group(function() {
    Route::get('/',                        [AdminCategoryController::class, 'index'])->name('index');
    Route::get('/creer',                   [AdminCategoryController::class, 'create'])->name('create');
    Route::post('/',                       [AdminCategoryController::class, 'store'])->name('store');
    Route::get('/{category}/modifier',     [AdminCategoryController::class, 'edit'])->name('edit');
    Route::put('/{category}',              [AdminCategoryController::class, 'update'])->name('update');
    Route::delete('/{category}',           [AdminCategoryController::class, 'destroy'])->name('destroy');
    Route::post('/{category}/sous-categorie',         [AdminCategoryController::class, 'addSubcategory'])->name('subcategory.add');
    Route::delete('/sous-categorie/{subcategory}',    [AdminCategoryController::class, 'destroySubcategory'])->name('subcategory.destroy');
});

// Panier
 Route::post('/panier/ajouter/{product}',         [CartController::class, 'add'])->name('cart.add');
 Route::patch('/panier/modifier/{productId}',      [CartController::class, 'update'])->name('cart.update');
 Route::delete('/panier/retirer/{productId}',      [CartController::class, 'remove'])->name('cart.remove');
 Route::get('/panier',                             [CartController::class, 'index'])->name('cart.index');
 Route::delete('/panier/vider',                    [CartController::class, 'clear'])->name('cart.clear');
 Route::get('/panier/drawer',                      [CartController::class, 'drawer'])->name('cart.drawer');

// Checkout
 Route::get('/commander',           [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
 Route::post('/commander/confirmer',[CartController::class, 'placeOrder'])->name('cart.order.place')->middleware('auth');
 Route::get('/commande/{order}/confirmation', [CartController::class, 'confirmation'])->name('cart.order.confirmation')->middleware('auth');

