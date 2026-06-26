<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');                  // "Haute Joaillerie"
            $table->string('slug')->unique();         // "bijoux"
            $table->string('hero_title')->nullable(); // Titre affiché en haut de la page catégorie
            $table->text('hero_description')->nullable();
            $table->string('hero_image')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });

        // Table pivot pour les sous-catégories de filtre (Colliers, Bagues, etc.)
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');   // "Colliers"
            $table->string('slug');   // "colliers"
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subcategories');
        Schema::dropIfExists('categories');
    }
};
