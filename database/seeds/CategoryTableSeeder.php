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
        // Asigno categoria a receta
        $recipe->categories()->attach($category);
    }
}
