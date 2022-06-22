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
        $role = Role::create(['name' => 'administrador']); // 1
        $role2 = Role::create(['name' => 'rrhh']); // 2
        $role3 = Role::create(['name' => 'trabajador']); //3
        $role4 = Role::create(['name' => 'rrhh_carlos']); //4
        $role5 = Role::create(['name' => 'rrhh_grover']); //3



        Permission::create(['name' => 'dash'])->syncRoles([$role, $role2, $role3,$role4,$role5]);

        Permission::create(['name' => 'users.index'])->syncRoles([$role]);
        Permission::create(['name' => 'users.edit'])->syncRoles([$role]);

        Permission::create(['name' => 'rrhh_carlos'])->syncRoles([$role4]);
        Permission::create(['name' => 'rrhh_grover'])->syncRoles([$role5]);
    }
}
