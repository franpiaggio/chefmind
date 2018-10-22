<?php

namespace App\Http\Controllers;

use App\User;
use \App\Recipe;
use Carbon\Carbon;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateRecipeRequest;
use App\Http\Requests\EditRecipeRequest;

class RecetasController extends Controller
{
    /**
     * Verifica con Auth en algunos métodos
     */
    public function __construct(){
        $this->middleware('auth', ['only' => ['create', 'store', 'edit', 'update', 'userRecipes']]);
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
     * Vista de recetas del usuario
     * @return Response
     */
    public function userRecipes(){
        $recipes = User::find(Auth::user()->id)->recipes;
        return view('user.misRecetas', compact('recipes'));
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
        $categories = Category::all();
        return view('user.crearReceta', compact('categories'));
    }

    /**
     * Guarda una receta en la DB
     * @param CreateArticleRequest $request
     * @return Response
     */
    public function store(CreateRecipeRequest $request){
        // Creo una nueva receta con la info del formulario
        $this->createRecipe($request);
        // Vuelvo a ver las recetas
        return redirect('recetas');
    }

    /**
     * Devuelve la vista de edición de una receta
     * @param $id
     * @return Response
     */
    public function edit(EditRecipeRequest $request ,$id){
        // Receta seleccionada
        $recipe = Recipe::find($id);
        // Todas las categorias
        $categories = Category::all();
        // Devuelvo vista
        return view('user.editarReceta', compact('recipe', 'categories'));
    }

    /**
     * Edita una receta
     */
    public function update($id, CreateRecipeRequest $request){
        // Busca y si no encuentra arroja un error
        $recipe = Recipe::findOrfail($id);
        // Actualiza todos los datos
        $recipe->update($request->all());
        // Actualiza las categorias sin repetirlas
        $this->syncCategories( $recipe, $request->input('categories') );
        // Vuelvo a la vista de recetas
        return redirect('recetas');
    }

    private function createRecipe( CreateRecipeRequest $request ){
        $recipe = new Recipe($request->all());
        // Seteo la fecha
        $recipe['published_at'] = Carbon::now(); 
        // Guardo con el usuario la nueva receta
        Auth::user()->recipes()->save($recipe);
        // Guardo las categorias una vez creada la receta porque necesito que se genere un ID
        $this->syncCategories( $recipe, $request->input('categories') );
        return $recipe;
    }
    
    /**
     * Sincroniza receta con categorías en la base de dadtos
     * @param Recipe $recipe
     * @param array $categories
     */
    private function syncCategories(Recipe $recipe, array $categories){
        $recipe->categories()->sync($categories);
    }
}
