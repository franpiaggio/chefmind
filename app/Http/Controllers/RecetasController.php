<?php

namespace App\Http\Controllers;

use Request;
use \App\Recipe;
use Carbon\Carbon;
use App\Http\Requests\CreateRecipeRequest;

class RecetasController extends Controller
{
    /**
     * Verifica con Auth en algunos métodos
     */
    public function __construct(){
        $this->middleware('auth', ['only' => ['create', 'store']]);
    }

    /**
     * Vista general de recetas
     * Lista todas
     * @return Response
     */
    public function index(){
        $recipes = Recipe::latest()->get();
        return view('web.recetas', compact('recipes'));
    }

    /**
     * Vista particular de recetas
     * Muestra una sola si existe, sino tira 404
     * @return Response
     */
    public function show($id){
        $recipe = Recipe::findOrFail($id);
        return view('web.receta', compact('recipe'));
    }

    /**
     * Vista de creación de una receta
     * @return Response
     */
    public function create(){
        return view('user.crearReceta');
    }

    /**
     * Guarda una receta en la DB
     * @param CreateArticleRequest $request
     * @return Response
     */
    public function store(CreateRecipeRequest $request){
        // Obtengo todo lo que viene de la Request
        $input = $request->all();
        // Seteo la fecha
        $input['published_at'] = Carbon::now(); 
        // Guardo en DB la nueva receta
        Recipe::create($input);
        // Vuelvo a ver las recetas
        return redirect('recetas');
    }

    /**
     * Edita una receta
     */
    public function edit(){
        
    }
}
