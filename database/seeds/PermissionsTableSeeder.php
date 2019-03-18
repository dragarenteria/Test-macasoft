<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Usuario']);
        Role::create(['name' => 'Vendedor']);

        $user = User::find(1);
        $user->assignRole('Administrador');

        $user = User::find(2);
        $user->assignRole('Usuario');
    }
}
