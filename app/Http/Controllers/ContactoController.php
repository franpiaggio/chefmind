<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactoController extends Controller{
    /**
     * Sección de contacto
     */
    public function index(){
        return view('web.contacto');
    }

    public function send(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|email',
            'consulta' => 'required'
        ]);
        return back()->withErrors(['Muchas gracias, tu mensaje fué enviado correctamente.']);
    }
}
