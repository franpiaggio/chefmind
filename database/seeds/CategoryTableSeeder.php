<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Recipe;
use App\User;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();
        // Primera receta
        $recipe = Recipe::first();
        // Nueva categoria
        $category = new Category();
        $category->name = "Categoría 1";
        $category->img = "categoria.jpg";
        $category->active = 1;
        $category->user()->associate($user);
        $category->save();
        $category2 = new Category();
        $category2->name = "Categoría 2";
        $category2->img = "categoria.jpg";
        $category2->active = 0;
        $category2->user()->associate($user);
        $category2->save();
        // Asigno categoria a receta
        $recipe->categories()->attach($category);
        $recipe->categories()->attach($category2);
    }
}
