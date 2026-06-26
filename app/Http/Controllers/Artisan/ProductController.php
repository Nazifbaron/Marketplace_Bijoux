<?php

namespace App\Http\Controllers\Artisan;

use App\Http\Controllers\Controller;
use App\Models\ArtisanApplication;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{

    public function index(Request $request)
    {
        $application = $this->vendorApplication();

        $query = $application->products()
            ->with(['category', 'images'])
            ->orderBy('created_at', 'desc');


        if ($filter = $request->get('filter')) {
            match($filter) {
                'published' => $query->where('moderation_status', 'published'),
                'pending'   => $query->where('moderation_status', 'pending_review'),
                'verified'  => $query->where('verification_status', 'verified'),
                default     => null,
            };
        }

        $products = $query->paginate(12);

        $counts = [
            'all'       => $application->products()->count(),
            'published' => $application->products()->where('moderation_status', 'published')->count(),
            'pending'   => $application->products()->where('moderation_status', 'pending_review')->count(),
            'verified'  => $application->products()->where('verification_status', 'verified')->count(),
        ];

        return view('artisan.products.index', compact('products', 'counts', 'filter'));
    }

    
    public function create()
    {
        $categories = Category::with('subcategories')->orderBy('display_order')->get();
        return view('artisan.products.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $application = $this->vendorApplication();

        $validated = $request->validate([
            'category_id'      => ['required', 'exists:categories,id'],
            'subcategory_id'   => ['nullable', 'exists:subcategories,id'],
            'name'             => ['required', 'string', 'min:3', 'max:150'],
            'description'      => ['required', 'string', 'min:20', 'max:3000'],
            'short_story'      => ['nullable', 'string', 'max:200'],
            'price'            => ['required', 'numeric', 'min:100'],
            'stock_quantity'   => ['required', 'integer', 'min:0'],
            'condition_label'  => ['nullable', 'in:handmade,limited_edition,made_to_order,none'],
            'images'           => ['required', 'array', 'min:1', 'max:6'],
            'images.*'         => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'], // 4MB/image
        ], [
            'name.required'        => 'Le nom du produit est obligatoire.',
            'description.min'      => 'La description doit faire au moins 20 caractères.',
            'price.required'       => 'Le prix est obligatoire.',
            'price.min'             => 'Le prix doit être supérieur à 100 FCFA.',
            'images.required'      => 'Ajoutez au moins une photo de votre produit.',
            'images.max'            => 'Maximum 6 photos par produit.',
            'images.*.max'          => 'Chaque image doit faire moins de 4MB.',
        ]);

        $product = DB::transaction(function () use ($validated, $application, $request) {

            // 1. Créer le produit
            $product = Product::create([
                'artisan_application_id' => $application->id,
                'category_id'            => $validated['category_id'],
                'subcategory_id'         => $validated['subcategory_id'] ?? null,
                'name'                   => $validated['name'],
                'description'            => $validated['description'],
                'short_story'            => $validated['short_story'] ?? null,
                'price'                  => $validated['price'],
                'stock_quantity'         => $validated['stock_quantity'],
                'condition_label'        => $validated['condition_label'] ?? 'none',
                // Statuts par défaut (le coeur de la logique métier) :
                'moderation_status'      => 'pending_review', // doit être validé par l'admin
                'verification_status'    => 'unverified',     // pas de badge tant que pas demandé
            ]);

            // 2. Uploader chaque image et la lier au produit
            foreach ($request->file('images') as $index => $imageFile) {
                $path = $imageFile->store("products/{$product->id}", 'public');

                ProductImage::create([
                    'product_id'    => $product->id,
                    'path'          => $path,
                    'is_primary'    => $index === 0, // La première photo devient l'image principale
                    'display_order' => $index,
                ]);
            }

            return $product;
        });

        return redirect()
            ->route('artisan.products.index')
            ->with('success', "« {$product->name} » a été soumis avec succès. Il sera visible après validation par notre équipe (généralement sous 24h).");
    }


    public function edit(Product $product)
    {
        $this->authorizeProduct($product);
        $categories = Category::with('subcategories')->orderBy('display_order')->get();
        return view('artisan.products.edit', compact('product', 'categories'));
    }


    public function update(Request $request, Product $product)
    {
        $this->authorizeProduct($product);

        $validated = $request->validate([
            'category_id'      => ['required', 'exists:categories,id'],
            'subcategory_id'   => ['nullable', 'exists:subcategories,id'],
            'name'             => ['required', 'string', 'min:3', 'max:150'],
            'description'      => ['required', 'string', 'min:20', 'max:3000'],
            'short_story'      => ['nullable', 'string', 'max:200'],
            'price'            => ['required', 'numeric', 'min:100'],
            'stock_quantity'   => ['required', 'integer', 'min:0'],
            'condition_label'  => ['nullable', 'in:handmade,limited_edition,made_to_order,none'],
            'images'           => ['nullable', 'array', 'max:6'],
            'images.*'         => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        DB::transaction(function () use ($validated, $product, $request) {

            $wasPublished = $product->isPublished();

            $product->update([
                'category_id'      => $validated['category_id'],
                'subcategory_id'   => $validated['subcategory_id'] ?? null,
                'name'             => $validated['name'],
                'description'      => $validated['description'],
                'short_story'      => $validated['short_story'] ?? null,
                'price'            => $validated['price'],
                'stock_quantity'   => $validated['stock_quantity'],
                'condition_label'  => $validated['condition_label'] ?? 'none',
                // Si le produit était publié, le repasser en attente de revue
                'moderation_status' => $wasPublished ? 'pending_review' : $product->moderation_status,
            ]);
            // Ajouter les nouvelles images si fournies (s'ajoutent aux existantes)
            if ($request->hasFile('images')) {
                $existingCount = $product->images()->count();
                foreach ($request->file('images') as $index => $imageFile) {
                    $path = $imageFile->store("products/{$product->id}", 'public');
                    ProductImage::create([
                        'product_id'    => $product->id,
                        'path'          => $path,
                        'is_primary'    => $existingCount === 0 && $index === 0,
                        'display_order' => $existingCount + $index,
                    ]);
                }
            }
        });

        return redirect()
            ->route('artisan.products.index')
            ->with('success', 'Produit mis à jour. ' . ($product->wasChanged('moderation_status') ? 'Il repasse en revue avant publication.' : ''));
    }


    public function destroy(Product $product)
    {
        $this->authorizeProduct($product);

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $name = $product->name;
        $product->delete();

        return redirect()
            ->route('artisan.products.index')
            ->with('success', "« {$name} » a été supprimé.");
    }


    public function destroyImage(ProductImage $image)
    {
        $this->authorizeProduct($image->product);

        Storage::disk('public')->delete($image->path);
        $wasPrimary = $image->is_primary;
        $productId  = $image->product_id;
        $image->delete();


        if ($wasPrimary) {
            $next = ProductImage::where('product_id', $productId)->orderBy('display_order')->first();
            $next?->update(['is_primary' => true]);
        }

        return response()->json(['success' => true]);
    }

    public function requestVerification(Product $product)
    {
        $this->authorizeProduct($product);

        if (!$product->isPublished()) {
            return back()->with('error', 'Seuls les produits publiés peuvent être soumis à vérification.');
        }

        if (!$product->canRequestVerification()) {
            return back()->with('error', 'Une demande de vérification est déjà en cours ou validée pour ce produit.');
        }

        $product->update(['verification_status' => 'pending']);

        return back()->with('success', "Demande de vérification envoyée pour « {$product->name} ». Notre équipe examinera l'authenticité sous 3 à 5 jours ouvrés.");
    }

    private function vendorApplication(): ArtisanApplication
    {
        return ArtisanApplication::where('user_id', Auth::id())->firstOrFail();
    }

    private function authorizeProduct(Product $product): void
    {
        $application = $this->vendorApplication();
        if ($product->artisan_application_id !== $application->id) {
            abort(403, 'Ce produit ne vous appartient pas.');
        }
    }
}
