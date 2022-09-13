<?php

namespace Database\Seeders;

use App\Models\Trabajador;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create(
            [
                'name' => 'Sistemas',
                'username' => 'admin',
                'password' => bcrypt('password'),
            ]
        )->assignRole('administrador');
        User::create(
            [
                'name'     => 'Administración de personal',
                'username'    => 'admin_rrhh',
                'password' =>  bcrypt('123456'),
                'tipo_user' => 'admin_rrhh',
            ]
        )->assignRole('admin_rrhh');

        // User::factory(5)->create();
    }
}
