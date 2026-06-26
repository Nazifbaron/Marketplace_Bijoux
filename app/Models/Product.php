<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 *
 * @property string $verification_status unverified|pending|verified|rejected
 * @property string $moderation_status   draft|pending_review|published|rejected
 */
class Product extends Model
{
    protected $fillable = [
        'artisan_application_id', 'category_id', 'subcategory_id',
        'name', 'slug', 'description', 'short_story', 'price',
        'stock_quantity', 'condition_label',
        'moderation_status', 'moderation_notes',
        'verification_status', 'verification_notes', 'verified_by', 'verified_at',
    ];

    protected $casts = [
        'price'       => 'decimal:2',
        'verified_at' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();

        // Génère automatiquement un slug unique à partir du nom
        static::creating(function (self $product) {
            $base = Str::slug($product->name);
            $slug = $base;
            $i = 1;
            while (static::where('slug', $slug)->exists()) {
                $slug = "{$base}-{$i}";
                $i++;
            }
            $product->slug = $slug;
        });
    }

    public function artisanApplication(): BelongsTo
    {
        return $this->belongsTo(ArtisanApplication::class);
    }

    /** Alias pratique : accéder directement au vendeur depuis $product->vendor */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(ArtisanApplication::class, 'artisan_application_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('display_order');
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // ----------------------------------------------------------------
    // ACCESSORS — Pratiques pour les vues Blade
    // ----------------------------------------------------------------

    /** Image principale, ou la première trouvée, ou null */
    public function getPrimaryImageAttribute(): ?string
    {
        $primary = $this->images->firstWhere('is_primary', true) ?? $this->images->first();
        return $primary ? asset('storage/' . $primary->path) : null;
    }

    /** Prix formaté à la française : "750.000 CFA" */
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 0, ',', '.') . ' CFA';
    }

    /** True si le produit a le badge doré "Produit Vérifié" */
    public function getIsVerifiedAttribute(): bool
    {
        return $this->verification_status === 'verified';
    }

    /** Label du badge optionnel à afficher (HANDMADE, ÉDITION LIMITÉE...) */
    public function getConditionLabelTextAttribute(): ?string
    {
        return match($this->condition_label) {
            'handmade'         => 'HANDMADE',
            'limited_edition'  => 'ÉDITION LIMITÉE',
            'made_to_order'    => 'SUR COMMANDE',
            default            => null,
        };
    }

    // ----------------------------------------------------------------
    // SCOPES — Utilisés par les controllers des pages catégorie
    // ----------------------------------------------------------------

    /** Seulement les produits visibles publiquement sur le site */
    public function scopePublished($query)
    {
        return $query->where('moderation_status', 'published');
    }

    /** Filtre par slug de catégorie (ex: 'bijoux', 'art', 'maroquinerie') */
    public function scopeInCategory($query, string $categorySlug)
    {
        return $query->whereHas('category', fn($q) => $q->where('slug', $categorySlug));
    }

    /** Filtre par sous-catégorie (ex: 'colliers', 'bagues') */
    public function scopeInSubcategory($query, string $subcategorySlug)
    {
        return $query->whereHas('subcategory', fn($q) => $q->where('slug', $subcategorySlug));
    }

    /** Seulement les produits avec le badge vérifié */
    public function scopeVerified($query)
    {
        return $query->where('verification_status', 'verified');
    }

    // ----------------------------------------------------------------
    // HELPERS D'ÉTAT
    // ----------------------------------------------------------------

    public function isPublished(): bool
    {
        return $this->moderation_status === 'published';
    }

    public function isPendingVerification(): bool
    {
        return $this->verification_status === 'pending';
    }

    public function canRequestVerification(): bool
    {
        return in_array($this->verification_status, ['unverified', 'rejected']);
    }
}
