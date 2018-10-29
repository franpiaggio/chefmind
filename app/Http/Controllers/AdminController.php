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
        // Verifico en cada método que sea admin
        $this->middleware('verifyadmin');
    }

    /**
     * Dashboard del admin
     *
     */
    public function index(Request $request){
        return view('admin.admin');
    }

    /**
     * Vista de usuarios
     */
    public function adminUsers(Request $request){
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
        // Guardo los datos del form
        $userData = $request->all();
        // Encripto la pass
        $userData['password'] = bcrypt($request->password);        
        // Actualiza todos los datos
        $user->update($userData);
        // Actualizo el rol
        $user->roles()->sync($role);
        // Vuelvo a la vista de usuarios
        return redirect('/admin/usuarios');
    }

    /**
     * Bannear a un usuario
     */
    public function ban(Request $request, $id){
        // todo: esto se puede optimizar con middlewares
        $user = User::findOrFail($id);
        if($user->user_state_id == 1){
            // Está baneado
            $user->user_state_id = 2;
        }else{
            // Desbaneado
            $user->user_state_id = 1;
        }
        $user->save();
        return back();
    }

    /**
     * Borrar a un usuario
     */
    public function delete(Request $request, $id){
        if( $id == Auth::user()->id ){
            return back();
        }
        $user = User::findOrFail($id);
        $user->delete();
        return back();
    }
}
