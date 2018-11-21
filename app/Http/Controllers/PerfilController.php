<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class PerfilController extends Controller{
    /**
     * Verifica con Auth en algunos métodos
     */
    public function __construct(){
        $this->middleware('auth', ['only' => ['index', 'editProfile', 'updateProfile']]);
    }
    /**
     * Vista de mi perfil
     */
    public function index(Request $request){
        if($request->buscar){
            $recipes = Auth::user()->recipes()->where('title', 'LIKE', '%'.$request->buscar.'%')->paginate(4);
        }else{ 
            $recipes = Auth::user()->recipes()->paginate(4);
        }
        return view('user.miPerfil', ['recipes'=>$recipes->appends(Input::except('page'))]);
    }

    /**
     * Vista de edición de perfil
     */
    public function editProfile(){
        return view('user.editarPerfil');
    }

    /**
     * Actualiza datos del perfil
     */
    public function updateProfile(Request $request){
        $user = Auth::user();
        $validatedData = $request->validate(
            [
                'name' => 'required|min:3',
                'email' => 'required|email'
            ],
            [
                'name.required' => 'El nombre es obligatorio',
                'name.min' => 'Debe tener al menos 3 caracteres',
                'email.required' => 'El email es obligatorio',
                'email.email' => 'Ingresar un formáto de mail válido'
            ]
        );
        // Usuario editado
        $edited = $request->all();
        if(is_null($request->image)){
            // Si no hay nada dejo la anterior
            $edited['image'] = $user->image;
        }else{
            if( file_exists( public_path().'/uploads/perfiles/'.$user->image)){
                // Borro la anterior
                File::delete(public_path().'/uploads/perfiles/'.$user->image);
            }
            // Obtengo el archivo
            $profilePic = $request->file('image');
            // Nombre por la fecha
            $filename = time().'.'.$profilePic->getClientOriginalExtension();
            // Lo asigno al object
            $edited['image'] = $filename;
            // La muevo a public
            $profilePic->move(public_path('/uploads/perfiles/'), $filename);
        }
        // Actualiza todos los datos
        // todo: Save() por algún motivo no actualiza, revisarlo
        $user->name = $edited['name'];
        $user->email = $edited['email'];
        $user->description = $edited['description'];
        $user->facebook = $edited['facebook'];
        $user->twitter = $edited['twitter'];
        $user->instagram = $edited['instagram'];
        $user->image = $edited['image'];
        $user->save();
        Session::flash('msg', "Perfil actualizado correctamente.");
        return back();
    }

    /**
     * Obtiene el perfil de un usuario
     */
    public function getUser($id){

    }
}