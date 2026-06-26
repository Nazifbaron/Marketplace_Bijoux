<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'hero_title', 'hero_description', 'hero_image', 'display_order',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class)->orderBy('display_order');
    }

    /** Seulement les produits visibles publiquement */
    public function publishedProducts(): HasMany
    {
        return $this->products()->where('moderation_status', 'published');
    }
}
