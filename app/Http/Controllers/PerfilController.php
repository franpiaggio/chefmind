<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

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
    public function index(){
        return view('user.miPerfil');
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
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email'
        ]);
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
        return back();
    }
}