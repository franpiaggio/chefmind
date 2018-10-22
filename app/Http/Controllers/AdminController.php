<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
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
     * Dashboard del admin
     *
     */
    public function index(Request $request){
        // Ejemplo para validar solo admins
        if( Auth::check() ){
            $request->user()->authorizeRoles(['admin']);
        }
        return view('admin.admin');
    }

    /**
     * Vista de usuarios
     */
    public function adminUsers(Request $request){
        if( Auth::check() ){
            $request->user()->authorizeRoles(['admin']);
        }
        return view('admin.users', ['users' => User::paginate(5)]);
    }

    /**
     * Vista de edición
     */
    public function editUser(Request $request, $id){
        return view('admin.userEdit', ["user" => User::find($id), "roles" => Role::all() ]);
    }

    /**
     * Edición de usuario
     */
    public function update(Request $request, $id){
        // Busca y si no encuentra arroja un error
        $user = User::findOrfail($id);
        $role = Role::findOrfail($request->input('role'));
        // Actualiza todos los datos
        $user->update($request->all());
        // Actualizo el rol
        $user->roles()->sync($role);
        // Vuelvo a la vista de usuarios
        return redirect('/admin/usuarios');
    }
}
