<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Recipe;
use App\Ingredient;

class HomeController extends Controller
{
    /**
     * Home de la web
     */
    public function index(Request $request){
        return view('web.home');
    }

    /**
     * Buscador
     */
    public function search(Request $request){
        $validatedData = $request->validate([
            'ingredients' => 'required'
        ]);
        // Nombres ingresados
        $names = $request->all()['ingredients'];
        // Obtengo los ingredientes
        $ingredients = Ingredient::whereIn('name', $names)->get();
        // Separo solo los ids para a consulta
        $ids = [];
        foreach($ingredients as $ingredient){
            $ids[] = $ingredient->id;  
        }
        // Busco las recetas que como mínimo tengan los ingredientes solicitados
        $recipes = Recipe::whereHas('ingredients', function($q) use($ids) {
            $q->whereIn('ingredient_id', $ids)
            ->groupBy('recipe_id')
            ->havingRaw('COUNT(DISTINCT ingredient_id) = '.count($ids));
        })->paginate(10);
        // Devuelvo la vista con las recetas paginadas
        return view('web.recetas', compact('recipes'));
    }
}
