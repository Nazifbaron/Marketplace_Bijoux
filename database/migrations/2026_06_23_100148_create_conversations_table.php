<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * MIGRATION : CONVERSATIONS & MESSAGES (Chat temps réel)
 * =====================================================================
 * Une "conversation" regroupe tous les messages entre UN acheteur
 * et UN vendeur (identifié par son artisan_application_id).
 * On peut optionnellement lier la conversation à un produit précis
 * (si le client a cliqué "Contacter le vendeur" depuis une fiche produit).
 *
 * Ces données seront diffusées en temps réel via Laravel Reverb
 * (voir le ChatController et l'event MessageSent plus bas).
 * =====================================================================
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('artisan_application_id')->constrained('artisan_applications')->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('set null')
                  ->comment('Produit qui a déclenché la conversation, optionnel');
            // Dénormalisation pour trier rapidement par "dernière activité"
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();
            // Un acheteur n'a qu'UNE conversation par vendeur (pas une par produit)
            $table->unique(['buyer_id', 'artisan_application_id']);
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade');
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->text('body');
            $table->string('attachment_path')->nullable()
                  ->comment('Photo jointe au message (ex: photo d\'un défaut produit)');

            $table->timestamp('read_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
        Schema::dropIfExists('conversations');
    }
};
