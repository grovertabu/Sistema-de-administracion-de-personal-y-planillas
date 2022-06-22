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
                'name' => 'Admin',
                'username' => 'admin',
                'password' => bcrypt('password'),
            ]
        )->assignRole('administrador');
        User::create(
            [
                'name'     => 'Recursos Humanos',
                'username'    => 'rrhh',
                'password' =>  bcrypt('password'),
                'tipo_user' => 'rrhh',
            ]
        )->assignRole('rrhh');
        User::create(
            [
                'name'     => 'Carlos Vasquez',
                'username'    => 'carlosv',
                'password' =>  bcrypt('password'),
                'tipo_user' => 'rrhh',
            ]
        )->assignRole('rrhh_carlos');
        User::create(
            [
                'name'     => 'Grover Taboada',
                'username'    => 'grovert',
                'password' =>  bcrypt('password'),
                'tipo_user' => 'rrhh',
            ]
        )->assignRole('rrhh_grover');

        User::factory(5)->create();
    }
}
