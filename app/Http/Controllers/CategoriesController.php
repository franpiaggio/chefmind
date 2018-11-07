<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EditCategoryRequest;

class CategoriesController extends Controller{
    /**
     * Vista con listado de categorias
     */
    public function index(Request $request){
        $categories = Category::where('active', 1)->paginate(10);
        return view('web.categorias', compact('categories'));
    }
    /**
     * Muestra una categoria y sus recetas
     */
    public function show(Request $request, $id){
        $category = Category::findOrFail($id);
        $recipes = $category->recipes;
        return view('web.categoria', compact('category', 'recipes'));
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
