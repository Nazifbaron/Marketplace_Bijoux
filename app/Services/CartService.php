<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;


class CartService
{
    private const SESSION_KEY = 'cart';


    /**
     * Retourne tous les items du panier sous forme de Collection
     */
    public function all(): Collection
    {
        return collect(session(self::SESSION_KEY, []));
    }

    /**
     * Nombre total d'articles (somme des quantités)
     */
    public function count(): int
    {
        return $this->all()->sum('quantity');
    }

    /**
     * Montant total en FCFA
     */
    public function total(): float
    {
        return $this->all()->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    /**
     * Montant total formaté "750.000 CFA"
     */
    public function formattedTotal(): string
    {
        return number_format($this->total(), 0, ',', '.') . ' CFA';
    }

    /**
     * True si le panier est vide
     */
    public function isEmpty(): bool
    {
        return $this->all()->isEmpty();
    }

    /**
     * Ajouter un produit au panier (ou augmenter sa quantité)
     *
     * @return array ['success' => bool, 'message' => string, 'item' => array]
     */
    public function add(int $productId, int $quantity = 1): array
    {
        $product = Product::published()
            ->with(['images', 'vendor'])
            ->find($productId);

        if (!$product) {
            return ['success' => false, 'message' => 'Produit introuvable ou non disponible.'];
        }

        if ($product->stock_quantity < 1) {
            return ['success' => false, 'message' => 'Ce produit est en rupture de stock.'];
        }

        $cart = session(self::SESSION_KEY, []);

        if (isset($cart[$productId])) {
            // Le produit est déjà dans le panier — augmenter la quantité
            $newQty = $cart[$productId]['quantity'] + $quantity;

            if ($newQty > $product->stock_quantity) {
                return [
                    'success' => false,
                    'message' => "Stock insuffisant. Maximum disponible : {$product->stock_quantity} pièce(s)."
                ];
            }

            $cart[$productId]['quantity'] = $newQty;
        } else {
            // Nouveau produit dans le panier
            if ($quantity > $product->stock_quantity) {
                $quantity = $product->stock_quantity;
            }

            $cart[$productId] = [
                'product_id'  => $product->id,
                'name'        => $product->name,
                'price'       => (float) $product->price,
                'quantity'    => $quantity,
                'image'       => $product->primary_image,
                'vendor_name' => $product->vendor?->shop_name ?? '',
                'slug'        => $product->slug,
                'max_qty'     => $product->stock_quantity,
            ];
        }

        session([self::SESSION_KEY => $cart]);

        return [
            'success'     => true,
            'message'     => "« {$product->name} » ajouté au panier.",
            'cart_count'  => $this->count(),
            'cart_total'  => $this->formattedTotal(),
            'item'        => $cart[$productId],
        ];
    }

    /**
     * Modifier la quantité d'un item
     */
    public function updateQuantity(int $productId, int $quantity): array
    {
        $cart = session(self::SESSION_KEY, []);

        if (!isset($cart[$productId])) {
            return ['success' => false, 'message' => 'Produit non trouvé dans le panier.'];
        }

        if ($quantity < 1) {
            return $this->remove($productId);
        }

        // Vérifier le stock actuel
        $product = Product::find($productId);
        if ($product && $quantity > $product->stock_quantity) {
            $quantity = $product->stock_quantity;
        }

        $cart[$productId]['quantity'] = $quantity;
        session([self::SESSION_KEY => $cart]);

        return [
            'success'        => true,
            'cart_count'     => $this->count(),
            'cart_total'     => $this->formattedTotal(),
            'item_subtotal'  => number_format($cart[$productId]['price'] * $quantity, 0, ',', '.') . ' CFA',
        ];
    }

    /**
     * Supprimer un produit du panier
     */
    public function remove(int $productId): array
    {
        $cart = session(self::SESSION_KEY, []);
        $name = $cart[$productId]['name'] ?? 'Produit';

        unset($cart[$productId]);
        session([self::SESSION_KEY => $cart]);

        return [
            'success'    => true,
            'message'    => "« {$name} » retiré du panier.",
            'cart_count' => $this->count(),
            'cart_total' => $this->formattedTotal(),
            'is_empty'   => $this->isEmpty(),
        ];
    }

    /**
     * Vider tout le panier
     */
    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    /**
     * Vérifier si un produit est déjà dans le panier
     */
    public function contains(int $productId): bool
    {
        return isset(session(self::SESSION_KEY, [])[$productId]);
    }

    /**
     * Résumé pour la vue (groupé par vendeur pour affichage)
     */
    public function groupedByVendor(): Collection
    {
        return $this->all()->groupBy('vendor_name');
    }
}
