<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * CONTROLLER : PAGES CATÉGORIE PUBLIQUES
 * =====================================================================
 * Remplace les 4 fichiers statiques (collection, bijoux, art, maroquinerie)
 * par UNE seule logique dynamique pilotée par les `slug` de catégorie.
 *
 * URLS RÉSULTANTES :
 *   /collection              → tous les produits, toutes catégories
 *   /collection/bijoux       → seulement category.slug = 'bijoux'
 *   /collection/art          → seulement category.slug = 'art'
 *   /collection/maroquinerie → seulement category.slug = 'maroquinerie'
 *
 * RÈGLE D'AFFICHAGE PUBLIQUE :
 * Seuls les produits avec moderation_status = 'published' apparaissent.
 * Un produit en pending_review (en attente de validation admin) ou
 * rejected n'est JAMAIS visible ici, même si le vendeur l'a créé.
 * =====================================================================
 */
class CollectionController extends Controller
{
    /**
     * Page "Collection" — tous les produits de toutes catégories
     */
    public function index(Request $request)
    {
        $query = Product::published()->with(['category', 'images', 'vendor']);

        // Filtre optionnel par catégorie depuis les boutons de filtre
        // (?category=bijoux dans l'URL, géré aussi en JS sans rechargement)
        if ($categorySlug = $request->get('category')) {
            $query->inCategory($categorySlug);
        }

        $products   = $query->orderByDesc('created_at')->paginate(9);
        $categories = Category::orderBy('display_order')->get();

        return view('collection.index', compact('products', 'categories'));
    }

    /**
     * Page d'une catégorie précise (bijoux, art, maroquinerie...)
     *
     * Le paramètre {category} est résolu automatiquement par Laravel
     * grâce au Route Model Binding sur le champ `slug`
     * (voir routes/web.php : Route::get('/collection/{category:slug}'...))
     */
    public function show(Category $category, Request $request)
    {
        $query = $category->publishedProducts()->with(['images', 'vendor', 'subcategory']);

        // Filtre optionnel par sous-catégorie (Colliers, Bagues...)
        if ($subSlug = $request->get('sub')) {
            $query->whereHas('subcategory', fn($q) => $q->where('slug', $subSlug));
        }

        $products      = $query->orderByDesc('created_at')->paginate(9);
        $subcategories = $category->subcategories;

        return view('collection.category', compact('category', 'products', 'subcategories'));
    }

    /**
     * Fiche produit détaillée (accessible depuis "QUICK VIEW")
     */
    public function showProduct(Product $product)
    {
        // Sécurité : un produit non publié n'est pas accessible publiquement,
        // SAUF si c'est le vendeur lui-même qui prévisualise sa fiche
        $isOwner = auth()->check()
            && $product->vendor->user_id === auth()->id();

        if (!$product->isPublished() && !$isOwner) {
            abort(404);
        }

        $product->increment('views_count');
        $product->load(['images', 'vendor.user', 'category']);

        // Produits similaires (même catégorie, exclut le produit actuel)
        $relatedProducts = Product::published()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('images')
            ->limit(3)
            ->get();

        return view('collection.product-detail', compact('product', 'relatedProducts'));
    }

        /**
     * Page Bijoux — /bijoux
     */
    public function bijoux(Request $request)
    {
        $category = Category::where('slug', 'bijoux')->firstOrFail();

        $query = $category->publishedProducts()
            ->with(['images', 'vendor', 'subcategory'])
            ->orderByDesc('created_at');

        // Filtre sous-catégorie depuis l'URL (?sub=colliers)
        if ($sub = $request->get('sub')) {
            $query->whereHas('subcategory', fn($q) => $q->where('slug', $sub));
        }

        $products      = $query->paginate(12);
        $subcategories = $category->subcategories;

        return view('collection.bijoux', compact('category', 'products', 'subcategories'));
    }

    /**
     * Page Art & Décoration — /art
     */
    public function art(Request $request)
    {
        $category = Category::where('slug', 'art')->firstOrFail();

        $query = $category->publishedProducts()
            ->with(['images', 'vendor', 'subcategory'])
            ->orderByDesc('created_at');

        if ($sub = $request->get('sub')) {
            $query->whereHas('subcategory', fn($q) => $q->where('slug', $sub));
        }

        $products      = $query->paginate(9); // 9 pour la grille asymétrique
        $subcategories = $category->subcategories;

        return view('collection.art', compact('category', 'products', 'subcategories'));
    }

    /**
     * Page Maroquinerie — /maroquinerie
     */
    public function maroquinerie(Request $request)
    {
        $category = Category::where('slug', 'maroquinerie')->firstOrFail();

        $query = $category->publishedProducts()
            ->with(['images', 'vendor', 'subcategory'])
            ->orderByDesc('created_at');

        if ($sub = $request->get('sub')) {
            $query->whereHas('subcategory', fn($q) => $q->where('slug', $sub));
        }

        $products      = $query->paginate(9);
        $subcategories = $category->subcategories;

        return view('collection.maroquinerie', compact('category', 'products', 'subcategories'));
    }


    public function quickView(Product $product): JsonResponse
    {
        if (!$product->isPublished()) {
            abort(404);
        }

        $product->load(['images', 'category', 'vendor']);

        return response()->json([
            'id'                  => $product->id,
            'name'                => $product->name,
            'slug'                => $product->slug,
            'description'         => $product->description,
            'short_story'         => $product->short_story,
            'formatted_price'     => $product->formatted_price,
            'stock_quantity'      => $product->stock_quantity,
            'is_verified'         => $product->is_verified,
            'condition_label_text'=> $product->condition_label_text,
            'primary_image'       => $product->primary_image,
            'images'              => $product->images->map(fn($img) => ['url' => $img->url]),
            'category_name'       => $product->category->name ?? null,
            'vendor_id'           => $product->vendor?->id,
            'vendor_name'         => $product->vendor?->shop_name,
        ]);
    }
}

