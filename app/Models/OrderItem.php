<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * MODEL : ORDER ITEM (une ligne produit, rattachée à un vendeur précis)
 * =====================================================================
 * C'est CETTE table que le vendeur consulte dans son dashboard
 * "Commandes" — il ne voit que ses propres lignes, jamais celles
 * des autres vendeurs même si elles appartiennent à la même commande.
 * =====================================================================
 */
class OrderItem extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'artisan_application_id',
        'product_name_snapshot', 'unit_price', 'quantity', 'item_status',
    ];

    protected $casts = ['unit_price' => 'decimal:2'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(ArtisanApplication::class, 'artisan_application_id');
    }

    public function getSubtotalAttribute(): float
    {
        return $this->unit_price * $this->quantity;
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->item_status) {
            'pending'   => 'En attente',
            'confirmed' => 'Confirmée',
            'shipped'   => 'Expédiée',
            'delivered' => 'Livrée',
            'cancelled' => 'Annulée',
            default     => $this->item_status,
        };
    }
}
