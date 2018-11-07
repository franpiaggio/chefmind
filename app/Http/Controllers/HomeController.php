<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Home de la web
     */
    public function index(Request $request){
        return view('web.home');
    }
}
