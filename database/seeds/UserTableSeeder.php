<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        // Obtengo los roles de la db
        $role_user = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();
        // Creo un nuevo usuario registrado
        $user = new User();
        $user->name = 'usuario';
        $user->email = 'usuario@usuario.com';
        $user->password = bcrypt('usuario');
        // Lo guardo y asigno un rol user
        $user->save();
        $user->roles()->attach($role_user);
        // Creo un nuevo usuario admin
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin');
        // Lo guardo y asigno un rol admin
        $user->save();
        $user->roles()->attach($role_admin);
    }
}
