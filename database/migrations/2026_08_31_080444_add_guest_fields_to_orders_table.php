<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Rendre buyer_id nullable (invités n'ont pas de compte)
            $table->foreignId('buyer_id')->nullable()->change();

            // Infos de l'invité
            $table->string('buyer_name')->nullable()->after('buyer_id');
            $table->string('buyer_email')->nullable()->after('buyer_name');

            // Token unique pour accéder à la confirmation sans connexion
            $table->string('guest_token')->nullable()->after('buyer_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
