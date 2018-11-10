<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;

class IngredientsController extends Controller{
    /**
     * Obtiene ingredientes en base a un nombre
     */
    public function getByName(Request $request){
        if( empty($request->ingredient) ){
            $ingredient = '';
        }else{
            $ingredient = $request->ingredient;
        }
        return Ingredient::where('name', 'LIKE', '%'.$ingredient.'%')->get();
    }
}
