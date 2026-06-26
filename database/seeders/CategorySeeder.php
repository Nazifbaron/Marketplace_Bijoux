<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;

/**
 * SEEDER : CATEGORIES
 * =====================================================================
 * Exécute ce seeder UNE SEULE FOIS après la migration pour créer les
 * 4 catégories correspondant exactement aux 4 pages que tu m'as fournies.
 *
 * COMMANDE À LANCER :
 *   php artisan db:seed --class=CategorySeeder
 *
 * Les `slug` ci-dessous sont CRITIQUES : ils doivent rester exactement
 * "bijoux", "art", "maroquinerie" car c'est ce qui détermine l'URL
 * /collection/{slug} et le filtrage des produits par catégorie.
 * =====================================================================
 */
class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $bijoux = Category::create([
            'name'             => 'Bijoux',
            'slug'             => 'bijoux',
            'hero_title'       => 'Haute Joaillerie',
            'hero_description' => 'Des bijoux en bronze et en or façonnés selon la technique ancestrale de la cire perdue, héritage direct du Royaume du Dahomey.',
            'display_order'    => 1,
        ]);
        foreach (['Colliers', 'Bagues', 'Bracelets', 'Boucles d\'Oreilles'] as $i => $name) {
            Subcategory::create(['category_id' => $bijoux->id, 'name' => $name, 'slug' => \Illuminate\Support\Str::slug($name), 'display_order' => $i]);
        }

        $maroquinerie = Category::create([
            'name'             => 'Maroquinerie',
            'slug'             => 'maroquinerie',
            'hero_title'       => 'Maroquinerie de Prestige',
            'hero_description' => 'Des pièces en cuir d\'exception, travaillées à la main par les artisans les plus reconnus de Cotonou.',
            'display_order'    => 2,
        ]);
        foreach (['Sacs à Main', 'Portefeuilles', 'Ceintures', 'Chaussures'] as $i => $name) {
            Subcategory::create(['category_id' => $maroquinerie->id, 'name' => $name, 'slug' => \Illuminate\Support\Str::slug($name), 'display_order' => $i]);
        }

        $art = Category::create([
            'name'             => 'Art & Décoration',
            'slug'             => 'art',
            'hero_title'       => 'Art & Décoration',
            'hero_description' => 'Découvrez l\'âme du royaume du Dahomey à travers des objets d\'art confectionnés avec un savoir-faire exceptionnel.',
            'display_order'    => 3,
        ]);
        foreach (['Sculptures', 'Peintures', 'Décoration d\'Intérieur'] as $i => $name) {
            Subcategory::create(['category_id' => $art->id, 'name' => $name, 'slug' => \Illuminate\Support\Str::slug($name), 'display_order' => $i]);
        }

        // Note : pas de catégorie "Collection" — c'est la page qui agrège TOUTES les catégories,
        // pas une catégorie en elle-même (voir CollectionController::index)
    }
}
