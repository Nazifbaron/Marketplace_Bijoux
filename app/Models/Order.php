<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * MODEL : ORDER (Commande globale, peut concerner plusieurs vendeurs)
 */
class Order extends Model
{
    protected $fillable = [
        'order_number', 'buyer_id', 'total_amount', 'status',
        'shipping_address', 'shipping_city', 'shipping_phone',
    ];

    protected $casts = ['total_amount' => 'decimal:2'];

    protected static function boot(): void
    {
        parent::boot();

        // Génère un numéro de commande lisible : ECL-2024-000042
        static::creating(function (self $order) {
            $year  = now()->year;
            $count = static::whereYear('created_at', $year)->count() + 1;
            $order->order_number = sprintf('ECL-%d-%05d', $year, $count);
        });
    }

    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /** Items appartenant à un vendeur précis (pour filtrer dans son dashboard) */
    public function itemsForVendor($artisanApplicationId)
    {
        return $this->items()->where('artisan_application_id', $artisanApplicationId);
    }
}
