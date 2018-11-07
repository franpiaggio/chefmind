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
}
