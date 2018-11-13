<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Recipe;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\EditCategoryRequest;

class AdminController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        // Verifico antes que nada que esté autenticado
        $this->middleware('auth');
        // Verifico en cada método que sea admin
        $this->middleware('verifyadmin');
    }

    /**
     * Dashboard del admin
     *
     */
    public function index(Request $request){
        return view('admin.admin');
    }

    
    /**
     * Lista todas las recetas para el admin
     */
    public function listRecipes(Request $request){
        return view('admin.recipes', ['recipes' => Recipe::paginate(10)]);
    }

    /**
     * Busca una receta
     */
    public function searchRecipe(Request $request){
        return view('admin.recipes', ['recipes' => Recipe::where('title', 'LIKE', '%'.$request->search.'%')->paginate(10)]);
    }

    /**
     * Vista de categorías
     */
    public function adminCats(Request $request){
        return view('admin.categories', ['categories' => Category::paginate(10)]);
    }

    /**
     * Vista de nueva categoría
     */
    public function newCat(Request $request){
        return view('admin.newCategory');
    }

    /**
     * Vista de edición de categoría
     */
    public function editCat(Request $request, $id){
        return view('admin.categoryEdit', ["cat" => Category::find($id)]);
    }

    /**
     * Crea una nueva categoría
     */
    public function createCat(EditCategoryRequest $request){
        $user = Auth::user();
        $cat = new Category();
        $cat->name = $request->name;
        $cat->active = 1;
        $cat->user()->associate($user);
        if($request->img) {
            // Obtengo el archivo
            $image = $request->file('img');
            // Nombre por la fecha
            $filename = time().'.'.$image->getClientOriginalExtension();
            // Lo asigno al object
            $cat->img = $filename;
            // La muevo a public
            $image->move(public_path('/uploads/categorias/'), $filename);
        }
        $cat->save();
        return redirect('/admin/categorias');
    }
    /**
     * Activa o desactiva una categoría
     */
    public function activateCats(Request $request, $id){
        $cat = Category::findOrFail($id);
        if($cat->active){
            $cat->active = 0;
        }else{
            $cat->active = 1;
        }
        $cat->save();
        return back();
    }

    /**
     * Actualiza una categoría
     */
    public function updateCat(EditCategoryRequest $request, $id){
        // Busca y si no encuentra arroja un error
        $cat = Category::findOrfail($id);
        // Categoría editada
        $edited = $request->all();
        if(is_null($request->img)){
            // Si no hay nada dejo la anterior
            $edited['featured_image'] = $cat->img;
        }else{
            if( file_exists( public_path().'/uploads/categorias/'.$cat->img )){
                // Borro la anterior
                File::delete(public_path().'/uploads/categorias/'.$cat->img);
            }
            // Obtengo el archivo
            $featured = $request->file('img');
            // Nombre por la fecha
            $filename = time().'.'.$featured->getClientOriginalExtension();
            // Lo asigno al object
            $edited['img'] = $filename;
            // La muevo a public
            $featured->move(public_path('/uploads/categorias/'), $filename);
        }
        // Actualiza todos los datos
        $cat->update($edited);
        return back();
    }

    /**
     * Borra una categoria
     */
    public function deleteCat(Request $request, $id){
        $cat = Category::findOrFail($id);
        $recetas = $cat->recipes;
        if($recetas->first()){ 
            forEach($recetas as $receta){
                $receta->categories()->detach($cat->id);
                $cat->delete();
            }
        }else{
            $cat->delete();
        }
        return back();
    }

    /**
     * Vista de usuarios
     */
    public function adminUsers(Request $request){
        return view('admin.users', ['users' => User::paginate(10)]);
    }

    /**
     * Vista de edición
     */
    public function editUser(Request $request, $id){
        return view('admin.userEdit', ["user" => User::find($id), "roles" => Role::all() ]);
    }

    /**
     * Edición de usuario
     */
    public function update(Request $request, $id){
        // Busca y si no encuentra arroja un error
        $user = User::findOrfail($id);
        $role = Role::findOrfail($request->input('role'));
        // Guardo los datos del form
        $userData = $request->all();
        // Encripto la pass
        $userData['password'] = bcrypt($request->password);        
        // Actualiza todos los datos
        $user->update($userData);
        // Actualizo el rol
        $user->roles()->sync($role);
        // Vuelvo a la vista de usuarios
        return redirect('/admin/usuarios');
    }

    /**
     * Bannear a un usuario
     */
    public function ban(Request $request, $id){
        // todo: esto se puede optimizar con middlewares
        $user = User::findOrFail($id);
        if($user->user_state_id == 1){
            // Está baneado
            $user->user_state_id = 2;
        }else{
            // Desbaneado
            $user->user_state_id = 1;
        }
        $user->save();
        return back();
    }

    /**
     * Borrar a un usuario
     */
    public function delete(Request $request, $id){
        if( $id == Auth::user()->id ){
            return back();
        }
        $user = User::findOrFail($id);
        $user->delete();
        return back();
    }

    /**
     * Borra una receta
     */
    public function deleteRecipe($id){
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();
        return back();
    }
}
