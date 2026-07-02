<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * CONTROLLER : GESTION DES CATÉGORIES (Admin)
 * =====================================================================
 * L'admin peut :
 *   - Voir toutes les catégories
 *   - Créer une nouvelle catégorie (génère automatiquement une URL
 *     et une route — voir note ci-dessous)
 *   - Modifier le nom, description, image héro, ordre d'affichage
 *   - Ajouter / supprimer des sous-catégories (filtres dans la page)
 *   - Supprimer une catégorie (si elle n'a plus de produits)
 *
 * ⚠️  NOTE IMPORTANTE SUR LES ROUTES :
 * Quand l'admin crée une nouvelle catégorie avec slug "textile",
 * la page /textile n'existe pas automatiquement — il faut ajouter
 * manuellement la route dans web.php :
 *
 *   Route::get('/textile', [CollectionController::class, 'textile'])
 *        ->name('collection.textile');
 *
 * ET la méthode textile() dans CollectionController.
 *
 * Pour éviter ça, j'ai prévu une route générique à la fin de ce
 * fichier qui gère TOUTES les catégories dynamiquement sans
 * intervention manuelle — voir la section ROUTES ci-dessous.
 * =====================================================================
 */
class AdminCategoryController extends Controller
{
    /**
     * Liste toutes les catégories
     */
    public function index()
    {
        $categories = Category::withCount('products')
            ->orderBy('display_order')
            ->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Formulaire de création d'une nouvelle catégorie
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Enregistrer la nouvelle catégorie
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => ['required', 'string', 'min:2', 'max:80'],
            'hero_title'       => ['nullable', 'string', 'max:150'],
            'hero_description' => ['nullable', 'string', 'max:500'],
            'hero_image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'display_order'    => ['nullable', 'integer', 'min:0'],
            'subcategories'    => ['nullable', 'string'],
        ], [
            'name.required' => 'Le nom de la catégorie est obligatoire.',
            'hero_image.max' => 'L\'image ne doit pas dépasser 4MB.',
        ]);

        // Générer le slug à partir du nom (ex: "Textile Indigo" → "textile-indigo")
        $slug = Str::slug($validated['name']);

        // Vérifier que le slug n'existe pas déjà
        if (Category::where('slug', $slug)->exists()) {
            return back()->withErrors(['name' => 'Une catégorie avec ce nom existe déjà.'])->withInput();
        }

        // Upload de l'image héro si fournie
        $heroImagePath = null;
        if ($request->hasFile('hero_image')) {
            $heroImagePath = $request->file('hero_image')
                ->store("categories/{$slug}", 'public');
        }

        $category = Category::create([
            'name'             => $validated['name'],
            'slug'             => $slug,
            'hero_title'       => $validated['hero_title'] ?? $validated['name'],
            'hero_description' => $validated['hero_description'] ?? null,
            'hero_image'       => $heroImagePath,
            'display_order'    => $validated['display_order'] ?? Category::max('display_order') + 1,
        ]);

        // Créer les sous-catégories (saisies comme liste séparée par virgule)
        // Ex: "Colliers, Bagues, Bracelets"
        if (!empty($validated['subcategories'])) {
            $subs = array_filter(array_map('trim', explode(',', $validated['subcategories'])));
            foreach ($subs as $i => $subName) {
                Subcategory::create([
                    'category_id'   => $category->id,
                    'name'          => $subName,
                    'slug'          => Str::slug($subName),
                    'display_order' => $i,
                ]);
            }
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', "Catégorie « {$category->name} » créée. La page /collection/{$category->slug} est maintenant accessible.");
    }

    /**
     * Formulaire de modification d'une catégorie existante
     */
    public function edit(Category $category)
    {
        $category->load('subcategories');
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Mettre à jour une catégorie (nom, description, image héro, ordre)
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name'             => ['required', 'string', 'min:2', 'max:80'],
            'hero_title'       => ['nullable', 'string', 'max:150'],
            'hero_description' => ['nullable', 'string', 'max:500'],
            'hero_image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'display_order'    => ['nullable', 'integer', 'min:0'],
        ]);

        // Upload nouvelle image héro si fournie
        $heroImagePath = $category->hero_image; // Garder l'ancienne par défaut
        if ($request->hasFile('hero_image')) {
            // Supprimer l'ancienne image du disque
            if ($category->hero_image) {
                Storage::disk('public')->delete($category->hero_image);
            }
            $heroImagePath = $request->file('hero_image')
                ->store("categories/{$category->slug}", 'public');
        }

        $category->update([
            'name'             => $validated['name'],
            'hero_title'       => $validated['hero_title'] ?? $validated['name'],
            'hero_description' => $validated['hero_description'],
            'hero_image'       => $heroImagePath,
            'display_order'    => $validated['display_order'] ?? $category->display_order,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', "Catégorie « {$category->name} » mise à jour avec succès.");
    }

    /**
     * Ajouter une sous-catégorie à une catégorie existante
     */
    public function addSubcategory(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:60'],
        ]);

        Subcategory::create([
            'category_id'   => $category->id,
            'name'          => $validated['name'],
            'slug'          => Str::slug($validated['name']),
            'display_order' => $category->subcategories()->max('display_order') + 1,
        ]);

        return back()->with('success', "Sous-catégorie « {$validated['name']} » ajoutée.");
    }

    /**
     * Supprimer une sous-catégorie
     */
    public function destroySubcategory(Subcategory $subcategory)
    {
        $name = $subcategory->name;
        $subcategory->delete();
        return back()->with('success', "Sous-catégorie « {$name} » supprimée.");
    }

    /**
     * Supprimer une catégorie entière
     * Refusé si elle contient encore des produits
     */
    public function destroy(Category $category)
    {
        if ($category->products()->count() > 0) {
            return back()->with('error',
                "Impossible de supprimer « {$category->name} » : elle contient {$category->products()->count()} produit(s). Déplacez ou supprimez d'abord les produits."
            );
        }

        // Supprimer l'image héro du disque
        if ($category->hero_image) {
            Storage::disk('public')->delete($category->hero_image);
        }

        $name = $category->name;
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', "Catégorie « {$name} » supprimée.");
    }
}


/**
 * ════════════════════════════════════════════════════════════════════
 * ROUTES À AJOUTER dans routes/web.php
 * ════════════════════════════════════════════════════════════════════
 *
 * SOLUTION GÉNÉRIQUE — une seule route gère TOUTES les catégories,
 * même celles créées après le déploiement. L'admin crée "textile"
 * et la page /collection/textile fonctionne immédiatement.
 *
 * Remplace tes routes spécifiques bijoux/art/maroquerie par ceci :
 *
 * // Routes catégories spécifiques (optionnel, pour les 3 originales)
 * Route::get('/bijoux',      [CollectionController::class, 'bijoux'])->name('collection.bijoux');
 * Route::get('/art',         [CollectionController::class, 'art'])->name('collection.art');
 * Route::get('/maroquerie',  [CollectionController::class, 'maroquerie'])->name('collection.maroquerie');
 *
 * // ⭐ Route générique pour toutes les catégories créées par l'admin
 * // DOIT être déclarée APRÈS les routes spécifiques pour éviter les conflits
 * Route::get('/collection/{category:slug}', [CollectionController::class, 'category'])
 *      ->name('collection.category');
 *
 * // Routes admin catégories
 * Route::prefix('admin/categories')->name('admin.categories.')->middleware(['auth','admin'])->group(function() {
 *     Route::get('/',                        [AdminCategoryController::class, 'index'])->name('index');
 *     Route::get('/creer',                   [AdminCategoryController::class, 'create'])->name('create');
 *     Route::post('/',                       [AdminCategoryController::class, 'store'])->name('store');
 *     Route::get('/{category}/modifier',     [AdminCategoryController::class, 'edit'])->name('edit');
 *     Route::put('/{category}',              [AdminCategoryController::class, 'update'])->name('update');
 *     Route::delete('/{category}',           [AdminCategoryController::class, 'destroy'])->name('destroy');
 *     Route::post('/{category}/sous-categorie',         [AdminCategoryController::class, 'addSubcategory'])->name('subcategory.add');
 *     Route::delete('/sous-categorie/{subcategory}',    [AdminCategoryController::class, 'destroySubcategory'])->name('subcategory.destroy');
 * });
 * ════════════════════════════════════════════════════════════════════
 */
