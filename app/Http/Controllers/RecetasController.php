<?php

namespace App\Http\Controllers;

use App\User;
use \App\Recipe;
use App\Category;
use Carbon\Carbon;
use App\Ingredient;
use App\Image;
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
        $this->middleware('auth', [
            'only' => [
                'create', 'store', 'edit', 'update', 'userRecipes', 
                'likeReceta', 'deleteImg', 'storeGallery'
            ]
        ]);
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
     * Vista de recetas del usuario
     * @return Response
     */
    public function userFavs(){
        $recipes = Auth::user()->favorites(Recipe::class)->get();
        return view('user.misFavoritos', compact('recipes'));
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
        $categories = Category::all()->where('active', 1);
        return view('user.crearReceta', compact('categories'));
    }

    /**
     * Vista de creación de galerías de fotos
     */
    public function createGallery($id){
        $recipe = Recipe::findOrFail($id);
        if(Auth::user()->id != $recipe->user->id){
            return back();
        }
        return view('user.crearGaleria', compact('recipe'));
    }

    /**
     * Guarda una receta en la DB
     * @param CreateArticleRequest $request
     * @return Response
     */
    public function store(CreateRecipeRequest $request){
        // Creo una nueva receta con la info del formulario
        $recipe = $this->createRecipe($request);
        // Envío a la creación de galerías
        return redirect('recetas/'.$recipe->id.'/crear-galeria');
    }

    /**
     * Guarda las imágenes en las receta asignada
     */
    public function storeGallery(Request $request, $id){
        $this->validate($request, [
            'images.*' => 'mimes:jpeg,png,jpg,gif,svg'
        ]);
        $recipe = Recipe::findOrFail($id);
        if($request->images){
            foreach($request->images as $image){
                $newImage = new Image();
                $filename = time().'-'.$image->getClientOriginalName(); 
                $image->move(public_path('/uploads/imagenes/'), $filename);
                $newImage['name'] = $filename;
                $newImage->recipe()->associate($recipe);
                $newImage->save();                
            }
        }
        return back();
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
            'images.*' => 'mimes:jpeg,png,jpg,gif,svg'
        ]);
        // Busca y si no encuentra arroja un error
        $recipe = Recipe::findOrfail($id);
        // Receta editada
        $edited = $request->all();
        // Chequeo la imagen destacada
        if(is_null($request->featured_image)){
            // Si no hay nada dejo la anterior
            $edited['featured_image'] = $recipe->featured_image;
        }else if( file_exists( public_path().'/uploads/featured/'.$recipe->featured_image) ){
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

    /**
     * Crea y valida una nueva receta
     */
    private function createRecipe( CreateRecipeRequest $request ){
        // Validado de las múltiples imágenes, lo demás se valida con la request
        $this->validate($request, [
            'images.*' => 'mimes:jpeg,png,jpg,gif,svg'
        ]);
        // Instancio nueva receta
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
        // Si hay archivos los itero, guardo y relaciono
        if($request->images){
            foreach($request->images as $image){
                $newImage = new Image();
                $filename = time().'-'.$image->getClientOriginalName(); 
                $image->move(public_path('/uploads/imagenes/'), $filename);
                $newImage['name'] = $filename;
                $newImage->recipe()->associate($recipe);
                $newImage->save();                
            }
        }
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

    /**
     * Da like a una receta
     *
     * @return \Illuminate\Http\Response
     */
    public function likeReceta(Request $request){
        $recipe = Recipe::find($request->id);
        $response = auth()->user()->toggleLike($recipe);
        return response()->json(['success'=>$response]);
    }

    /**
     * Agrega como favorita una receta a un usuario
     */
    public function favReceta(Request $request){
        $recipe = Recipe::find($request->id);
        $response = auth()->user()->toggleFavorite($recipe);
        return response()->json(['success' => $response]);
    }

    /**
     * Borra una imagen
     */
    public function deleteImg(Request $request){
        $image = Image::findOrFail($request->id);
        if( file_exists( public_path().'/uploads/imagenes/'.$image->name) ){
            File::delete(public_path().'/uploads/imagenes/'.$image->name);
            $image->delete();
            return response()->json(['success']);
        }
    }
}
