<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // La creación de datos de roles debe ejecutarse primero
        $this->call(RoleTableSeeder::class);
        // Los usuarios necesitarán los roles previamente generados
        $this->call(UserTableSeeder::class);
        // Creo recetas de prueba con el usuario creado
        $this->call(RecipeTableSeeder::class);
        // Categorias de prueba
        $this->call(CategoryTableSeeder::class);
        // Ingredientes iniciales
        $this->call(IngredientTableSeeder::class);
    }
}
