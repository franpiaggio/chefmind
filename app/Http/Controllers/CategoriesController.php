<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\EditCategoryRequest;

class CategoriesController extends Controller{
    /**
     * Vista con listado de categorias
     */
    public function index(Request $request){
        // Todas las categorías
        $categories = Category::where('active', 1)->get();
        // Si no hay nada seteado busco las últimas
        if(!$request->buscar && !$request->categoria){
            $recipes = Recipe::orderBy('created_at', 'desc')->paginate(6);
        }else if($request->buscar && !$request->categoria){
            // Si solo está seteada la búsqueda, hago una global
            $recipes = Recipe::where('title', 'LIKE', '%'.$request->buscar.'%')->paginate(6);
        }else if(!$request->buscar && $request->categoria){
            // Si solo está seteada la categoría busco todas
            $category = Category::where('name', $request->categoria)->first();
            $recipes = $category->recipes()->paginate(6);
        }else{
            // Sino busco por ambos parámetros
            $category = Category::where('name', $request->categoria)->first();
            $recipes = $category->recipes()->where('title', 'LIKE', '%'.$request->buscar.'%')->paginate(6);
        }
        return view('web.categorias', ['categories'=>$categories, 'recipes'=>$recipes->appends(Input::except('page'))]);
    }
    /**
     * Muestra una categoria y sus recetas
     */
    public function show(Request $request, $id){
        $category = Category::findOrFail($id);
        $recipes = $category->recipes;
        return view('web.categoria', ['categories'=>$categories, 'recipes'=>$recipes->appends(Input::except('page'))]);
    }

    /**
     * Guarda una categoría como inactiva, para que sea activada
     */
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $user = Auth::user();
        $cat = new Category();
        $cat->name = $request->name;
        $cat->active = 0;
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
        return back()->withErrors(['Muchas gracias, tu sugerencia será revisada en la brevedad']);
    }
}
