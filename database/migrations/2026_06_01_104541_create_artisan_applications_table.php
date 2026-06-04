<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artisan_applications', function (Blueprint $table) {

            $table->id();
            // --- Lien vers l'utilisateur (créé à l'étape 1) ---
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // --- ÉTAPE 1 : Informations de Profil ---
            $table->enum('profile_type', ['independent', 'house'])
                  ->default('independent')
                  ->comment('independent = Artisan Indépendant | house = Maison Artisanale');
            $table->string('full_name');
            $table->string('phone')->nullable();
            // --- ÉTAPE 2 : Configuration de la Boutique ---
            $table->string('shop_name')->nullable()
                  ->comment('Nom officiel de la boutique');
            $table->string('craft_type')->nullable()
                  ->comment('Catégorie artisanale (leather, jewelry, textile, sculpture)');
            $table->text('shop_story')->nullable()
                  ->comment('Histoire et philosophie de la maison');
            $table->string('id_document_path')->nullable()
                  ->comment('Chemin vers le fichier pièce d\'identité uploadé');
            $table->string('certification_path')->nullable()
                  ->comment('Chemin vers le fichier certification artisanale');
            // --- STATUT du dossier ---
            $table->enum('status', [
                'draft',          // Étape 1 complétée, étape 2 non commencée
                'pending_docs',   // Étape 2 en cours
                'pending_review', // Dossier soumis, en attente admin
                'approved',       // Admin a approuvé
                'rejected',       // Admin a refusé
            ])->default('draft');
            // --- Commentaire admin (raison d'approbation ou rejet) ---
            $table->text('admin_notes')->nullable();
            $table->foreignId('reviewed_by')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null')
                  ->comment('ID de l\'admin qui a traité le dossier');
            $table->timestamp('reviewed_at')->nullable();

            // --- Token unique pour identifier la session d'inscription ---
            $table->string('onboarding_token')->unique()
                  ->comment('Token URL-safe pour reprendre l\'inscription sans login');

            // --- Timestamps Laravel (created_at, updated_at) ---
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artisan_applications');
    }
};
