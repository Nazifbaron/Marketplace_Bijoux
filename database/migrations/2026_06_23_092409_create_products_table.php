<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;




return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artisan_application_id')
                  ->constrained('artisan_applications')
                  ->onDelete('cascade')
                  ->comment('Le vendeur propriétaire du produit');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('subcategory_id')->nullable()->constrained();
            // --- Informations produit ---
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('short_story')->nullable()
                  ->comment('Histoire courte affichée sous le titre, ex: "Par Artisan Koffi Mensah"');
            $table->decimal('price', 12, 2)
                  ->comment('Prix en FCFA, ex: 750000.00');
            $table->integer('stock_quantity')->default(1);
            $table->enum('condition_label', ['handmade', 'limited_edition', 'made_to_order', 'none'])
                  ->default('none')
                  ->comment('Badge optionnel affiché sur la carte : HANDMADE, ÉDITION LIMITÉE...');
            // --- MODÉRATION (le produit est-il visible sur le site ?) ---
            $table->enum('moderation_status', ['draft', 'pending_review', 'published', 'rejected'])
                  ->default('draft')
                  ->comment('draft=brouillon vendeur | published=visible publiquement');
            $table->text('moderation_notes')->nullable();
            // --- VÉRIFICATION D'AUTHENTICITÉ (le badge façon Alibaba) ---
            $table->enum('verification_status', ['unverified', 'pending', 'verified', 'rejected'])
                  ->default('unverified')
                  ->comment('Statut du badge "Produit Vérifié"');
            $table->text('verification_notes')->nullable()
                  ->comment('Commentaire admin sur la vérification');
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('verified_at')->nullable();
            // --- Statistiques ---
            $table->unsignedInteger('views_count')->default(0);

            $table->timestamps();

            $table->index(['category_id', 'moderation_status']);
            $table->index('verification_status');
        });

        // --- Table des images produit (un produit a plusieurs photos) ---
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('path');
            $table->boolean('is_primary')->default(false)
                  ->comment('Image principale affichée sur les cartes produit');
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('products');
    }
};
