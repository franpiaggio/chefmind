<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        dd($request);
    }
}
