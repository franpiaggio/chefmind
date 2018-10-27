<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\UserState;

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
        // Obtengo los estados
        $state_active = UserState::where('name', 'active')->first();
        $state_banned = UserState::where('name', 'banned')->first();
        // Creo un nuevo usuario registrado
        $user = new User();
        $user->name = 'usuario';
        $user->email = 'usuario@usuario.com';
        $user->password = bcrypt('usuario');
        // Lo guardo, asigno un stado y asigno un rol user
        $state_active->users()->save($user);
        $user->roles()->attach($role_user);
        
        // Creo un nuevo usuario admin
        $user = new User();
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin');
        // Lo guardo, asigno un stado y asigno un rol admin
        $state_active->users()->save($user);
        $user->roles()->attach($role_admin);
       
        // Usuario baneado
        // Creo un nuevo usuario admin
        $user = new User();
        $user->name = 'usuario2';
        $user->email = 'usuario2@usuario2.com';
        $user->password = bcrypt('usuario2');
        // Lo guardo, asigno un stado y asigno un rol user
        $state_banned->users()->save($user);
        $user->roles()->attach($role_user);
        
    }
}
