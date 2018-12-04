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
        $recipe->textpreview = "Ideal para hacer pruebas";
        $recipe->body = '{"ops":[{"insert":"Descripción de la receta\n\nPasos a seguir:\n\nPaso 1"},{"attributes":{"list":"ordered"},"insert":"\n"},{"insert":"Paso 2"},{"attributes":{"list":"ordered"},"insert":"\n"},{"insert":"Paso 3"},{"attributes":{"list":"ordered"},"insert":"\n"}]}';
        $recipe->featured_image = 'prueba.jpg';
        $recipe->difficulty = 'Media';
        $recipe->quantity = 2;
        $recipe->time = '1 hora';
        $recipe['published_at'] = Carbon::now(); 
        // Le asigno el primer usuario
        $user->recipes()->save($recipe);
    }
}
