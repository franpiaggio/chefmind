<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if( Auth::check() ){
            $request->user()->authorizeRoles(['user', 'admin']);
        }
        return view('home');
    }
}
