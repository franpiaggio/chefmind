<?php

use Illuminate\Database\Seeder;
use App\UserState;

class UserStateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new UserState();
        $role->name = 'active';
        $role->description = 'Usuario activo en el sistema.';
        $role->save();
        $role = new UserState();
        $role->name = 'banned';
        $role->description = 'Usuario baneado sin acceso al sistema.';
        $role->save();
    }
}
