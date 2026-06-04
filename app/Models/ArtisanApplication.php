<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;


class ArtisanApplication extends Model
{

    protected $fillable = [
        'user_id',
        'profile_type',
        'full_name',
        'phone',
        'shop_name',
        'craft_type',
        'shop_story',
        'id_document_path',
        'certification_path',
        'status',
        'admin_notes',
        'reviewed_by',
        'reviewed_at',
        'onboarding_token',
    ];

    // Conversion automatique des types
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

    
    public function scopePendingReview($query)
    {
        return $query->where('status', 'pending_review');
    }

    /** Filtre les demandes approuvées */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}
