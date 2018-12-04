<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    public function getProfile(Request $request, $id){
        $user = User::findOrFail($id);
        if($request->buscar){
            $recipes = $user->recipes()->where('title', 'LIKE', '%'.$request->buscar.'%')->orderBy('created_at', 'desc')->paginate(4);
        }else{ 
            $recipes = $user->recipes()->orderBy('created_at', 'desc')->paginate(4);
        }
        return view('web.perfil', ['user'=>$user,'recipes'=>$recipes->appends(Input::except('page'))]);
    }
}
