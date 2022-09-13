<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol_sistemas = Role::create(['name' => 'administrador']);
        $rol_rrhh = Role::create(['name' => 'admin_rrhh']); //3

        //permisos globales
        Permission::create(['name' => 'dash'])->syncRoles([$rol_sistemas,$rol_rrhh]);

        //permisos para sistemas
        Permission::create(['name' => 'users.index'])->syncRoles([$rol_sistemas]);
        Permission::create(['name' => 'users.edit'])->syncRoles([$rol_sistemas]);

        //permisos para recursos humanos
        Permission::create(['name' => 'admin_rrhh'])->syncRoles([$rol_rrhh]);
    }
}
