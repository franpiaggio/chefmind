<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Recipe;

class RecetasController extends Controller
{
    /**
     * Verifica con Auth en algunos métodos
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create']]);
    }

    /**
     * Vista general de recetas
     * Lista todas
     */
    public function index(){
        $recipes = Recipe::all();
        return view('web.recetas')->with('recipes', $recipes);
    }

    /**
     * Vista particular de recetas
     * Muestra una sola si existe, sino tira 404
     */
    public function show($id){
        $recipe = Recipe::findOrFail($id);
        return view('web.receta')->with('recipe', $recipe);
    }

    /**
     * Creación de una receta
     */
    public function create(){
        return view('user.crearReceta');
    }
}
