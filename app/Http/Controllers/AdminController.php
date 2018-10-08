<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Verifico antes que nada que esté autenticado
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        // Ejemplo para validar solo admins
        if( Auth::check() ){
            $request->user()->authorizeRoles(['admin']);
        }
        return view('admin.admin');
    }
}
