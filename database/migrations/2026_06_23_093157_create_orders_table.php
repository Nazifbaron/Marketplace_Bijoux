<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique()
                  ->comment('Ex: ECL-2026-00001, affiché au client');
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');

            $table->decimal('total_amount', 12, 2);
            $table->enum('status', [
                'pending_payment', // En attente de paiement
                'paid',            // Payée
                'processing',      // En préparation
                'shipped',         // Expédiée
                'delivered',       // Livrée
                'cancelled',       // Annulée
            ])->default('pending_payment');

            $table->string('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_phone')->nullable();

            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained();
            $table->foreignId('artisan_application_id')->constrained('artisan_applications')
                  ->comment('Dénormalisé pour filtrer rapidement les commandes par vendeur');
            $table->string('product_name_snapshot')
                  ->comment('Copie du nom au moment de l\'achat, pour garder l\'historique même si le produit change');
            $table->decimal('unit_price', 12, 2);
            $table->integer('quantity')->default(1);
            // Statut PAR LIGNE : un vendeur peut expédier sa partie
            // indépendamment des autres vendeurs de la même commande
            $table->enum('item_status', [
                'pending',
                'confirmed',
                'shipped',
                'delivered',
                'cancelled',
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
