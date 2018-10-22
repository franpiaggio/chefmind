<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Recipe;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Primera receta
        $recipe = Recipe::first();
        // Nueva categoria
        $category = new Category();
        $category->name = "Categoría 1";
        $category->save();
        $category2 = new Category();
        $category2->name = "Categoría 2";
        $category2->save();
        // Asigno categoria a receta
        $recipe->categories()->attach($category);
        $recipe->categories()->attach($category2);
    }
}
