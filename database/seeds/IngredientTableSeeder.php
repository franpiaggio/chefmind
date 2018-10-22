<?php

use Illuminate\Database\Seeder;
use App\Ingredient;
use App\Recipe;
class IngredientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ingredientes base
        $ingredients = ["Papa", "Batata", "Cebolla", "Huevo", "Sal", "Pimienta", "Pollo", "Asado", "Entraña", "Lechuga", "Tomate"];
        // Primera receta
        $recipe = Recipe::first();
        // Recorro ingredientes, los creo y asocio a la primera receta
        foreach ($ingredients as $ingredient) {
            $newIngredient = new Ingredient();
            $newIngredient->name = $ingredient;
            $newIngredient->save();
            // Asigno Ingrediente a receta
            $recipe->ingredients()->attach($newIngredient);
        }
    }
}
