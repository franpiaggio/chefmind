<?php

namespace App\Http\Controllers;

use App\User;
use \App\Recipe;
use App\Category;
use Carbon\Carbon;
use App\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\EditRecipeRequest;
use App\Http\Requests\CreateRecipeRequest;

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
        $recipes = Recipe::latest()->paginate(10);
        return view('web.recetas', compact('recipes'));
    }

    /**
     * Vista de recetas del usuario
     * @return Response
     */
    public function userRecipes(){
        $recipes = User::find(Auth::user()->id)->recipes()->paginate(10);
        return view('user.misRecetas', compact('recipes'));
    }

    /**
     * Vista particular de recetas
     * Muestra una sola si existe, sino tira 404
     * @return Response
     */
    public function show($id){
        $recipe = Recipe::findOrFail($id);
        // Si está en un formato JSON lo parseo para devolver un HTML, sino devuelvo el texto
        if(json_decode($recipe->body)){
            $quill = new \DBlackborough\Quill\Render($recipe->body, 'HTML');
            $recipe->body = $quill->render();
        }
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
    public function update($id, Request $request){
        $validatedData = $request->validate([
            'title' => 'required|min:3',
            'body' => 'required',
        ]);
        // Busca y si no encuentra arroja un error
        $recipe = Recipe::findOrfail($id);
        // Receta editada
        $edited = $request->all();
        // Chequeo la imagen destacada
        if(is_null($request->featured_image)){
            // Si no hay nada dejo la anterior
            $edited['featured_image'] = $recipe->featured_image;
        }else if( file_exists( public_path().'/uploads/featured/'.$recipe->_featured_image) ){
            // Borro la anterior
            File::delete(public_path().'/uploads/featured/'.$recipe->featured_image);
            // Obtengo el archivo
            $featured = $request->file('featured_image');
            // Nombre por la fecha
            $filename = time().'.'.$featured->getClientOriginalExtension();
            // Lo asigno al object
            $edited['featured_image'] = $filename;
            // La muevo a public
            $featured->move(public_path('/uploads/featured/'), $filename);
        };
        // Actualiza todos los datos
        $recipe->update($edited);
        // Actualiza las categorias sin repetirlas
        $this->syncCategories( $recipe, $request->input('categories') );
        // Actualiza los ingredientes
        $this->syncIngredients( $recipe, $request->input('ingredients') );
        // Vuelvo a la vista de recetas
        return redirect('recetas');
    }

    /**
     * Borra la reseta enviada
     */
    public function delete(EditRecipeRequest $request, $id){
        // Busco la receta
        $recipe = Recipe::findOrFail($id);
        // Guardo la ruta de la imagen
        $featured = $recipe->featured_image;
        // Borro la receta de la db
        $recipe->delete();
        // Si existía el archivo lo borro
        if( file_exists( public_path().'/uploads/featured/'.$featured) ){
            // Borro la anterior
            File::delete(public_path().'/uploads/featured/'.$recipe->featured_image);
        }
        // Vuelvo a la vista
        return back()->withErrors(['Borrado correctamente']);;
    }

    private function createRecipe( CreateRecipeRequest $request ){
        $recipe = new Recipe($request->all());
        // La imagen es obligatoria, pero igual chequeo si está
        if($recipe['featured_image']) {
            // Obtengo el archivo
            $featured = $request->file('featured_image');
            // Nombre por la fecha
            $filename = time().'.'.$featured->getClientOriginalExtension();
            // Lo asigno al object
            $recipe['featured_image'] = $filename;
            // La muevo a public
            $featured->move(public_path('/uploads/featured/'), $filename);
        }
        // Seteo la fecha
        $recipe['published_at'] = Carbon::now(); 
        // Guardo con el usuario la nueva receta
        Auth::user()->recipes()->save($recipe);
        // Guardo las categorias una vez creada la receta porque necesito que se genere un ID
        $this->syncCategories( $recipe, $request->input('categories') );
        // Guardo los ingredientes
        $this->syncIngredients( $recipe, $request->input('ingredients') );
        return $recipe;
    }
    
    /**
     * Sincroniza receta con categorías en la base de dadtos
     * @param Recipe $recipe
     * @param array $categories
     */
    private function syncCategories(Recipe $recipe, $categories){
        // Si existe
        if($categories){
            // Sincroniza
            $recipe->categories()->sync($categories);
        }else{
            // Si llegan vacias es porque borró todas las categorías, entonces sincronizo vacio
            $categories = [];
            $recipe->categories()->sync($categories);
        }
    }

    /**
     * Sincroniza receta con ingredientes en la base de datos
     * @param Recipe $recipe
     * @param array $ingredients
     */
    private function syncIngredients(Recipe $recipe, $ingredients){
        if($ingredients){
            // Array de ids
            $ingredientsIds = [];
            forEach($ingredients as $ingredient){
                // Si existe lo guarda, sino lo crea
                $current = Ingredient::firstOrCreate( ["name" => $ingredient] );
                // Push al array
                $ingredientsIds[] = $current->id;             
            }
            // Sinc de todos los ingredientes agregados 
            $recipe->ingredients()->sync($ingredientsIds);
        }else{
            // Si no llegan ingredientes es porque los borró todos
            $ingredientsIds = [];
            $recipe->ingredients()->sync($ingredientsIds);
        }
    }
}
