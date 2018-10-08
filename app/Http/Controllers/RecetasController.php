<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Recipe;

class RecetasController extends Controller
{
    public function index(){
        $recipes = Recipe::all();
        return view('web.recetas')->with('recipes', $recipes);
    }

    public function show($id){
        $recipe = Recipe::findOrFail($id);
        return view('web.receta')->with('recipe', $recipe);
    }
}
