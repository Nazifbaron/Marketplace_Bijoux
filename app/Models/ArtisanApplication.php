<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**

 * @property int         $id
 * @property int         $user_id
 * @property string      $profile_type
 * @property string      $full_name
 * @property string|null $phone
 * @property string|null $shop_name
 * @property string|null $craft_type
 * @property string|null $shop_story
 * @property string|null $id_document_path
 * @property string|null $certification_path
 * @property string      $status
 * @property string|null $admin_notes
 * @property string      $onboarding_token
 */
class ArtisanApplication extends Model
{
    protected $fillable = [
        'user_id', 'profile_type', 'full_name', 'phone',
        'shop_name', 'craft_type', 'shop_story',
        'id_document_path', 'certification_path',
        'status', 'admin_notes', 'reviewed_by', 'reviewed_at',
        'onboarding_token',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (self $application) {
            $application->onboarding_token = Str::random(40);
        });
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    
    /** Tous les produits de ce vendeur */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /** Seulement les produits publiés et visibles publiquement */
    public function publishedProducts(): HasMany
    {
        return $this->products()->where('moderation_status', 'published');
    }

    /** Toutes les lignes de commande reçues par ce vendeur */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /** Conversations avec les acheteurs */
    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class);
    }

    // ----------------------------------------------------------------
    // HELPERS D'ÉTAT — Inscription
    // ----------------------------------------------------------------

    public function isPendingReview(): bool
    {
        return $this->status === 'pending_review';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function getCurrentStep(): int
    {
        return match($this->status) {
            'draft'          => 1,
            'pending_docs'   => 2,
            'pending_review',
            'approved',
            'rejected'       => 3,
            default          => 1,
        };
    }

    public function getProfileTypeLabelAttribute(): string
    {
        return match($this->profile_type) {
            'independent' => 'Artisan Indépendant',
            'house'       => 'Maison Artisanale',
            default       => 'Inconnu',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'draft'          => 'Brouillon',
            'pending_docs'   => 'Documents en cours',
            'pending_review' => 'En attente de revue',
            'approved'       => 'Approuvé',
            'rejected'       => 'Rejeté',
            default          => 'Inconnu',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'draft'          => 'gray',
            'pending_docs'   => 'blue',
            'pending_review' => 'yellow',
            'approved'       => 'green',
            'rejected'       => 'red',
            default          => 'gray',
        };
    }

    // ----------------------------------------------------------------
    // HELPERS STATISTIQUES — utilisés dans le dashboard vendeur
    // ----------------------------------------------------------------

    /** Revenu total encaissé (commandes livrées uniquement, toutes périodes) */
    public function getTotalRevenueAttribute(): float
    {
        return $this->orderItems()
            ->where('item_status', 'delivered')
            ->get()
            ->sum(fn($item) => $item->unit_price * $item->quantity);
    }

    /** Nombre de commandes en attente de traitement */
    public function getPendingOrdersCountAttribute(): int
    {
        return $this->orderItems()->where('item_status', 'pending')->count();
    }

    // ----------------------------------------------------------------
    // SCOPES
    // ----------------------------------------------------------------

    public function scopePendingReview($query)
    {
        return $query->where('status', 'pending_review');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
