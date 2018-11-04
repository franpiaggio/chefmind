<?php

use Illuminate\Database\Seeder;
use App\Recipe;
use App\User;
use Carbon\Carbon;

class RecipeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtengo el primer usuario
        $user = User::first();
        // Creo una receta de prueba
        $recipe = new Recipe();
        $recipe->title = "Receta de prueba";
        $recipe->body = "Esta es la descripción de la receta de prueba";
        $recipe->featured_image = 'prueba.jpg';
        $recipe->time = '1 hora';
        $recipe['published_at'] = Carbon::now(); 
        // Le asigno el primer usuario
        $user->recipes()->save($recipe);
    }
}
