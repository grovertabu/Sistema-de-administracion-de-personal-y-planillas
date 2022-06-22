<?php

namespace Database\Seeders;

use App\Models\Tipo_Contrato;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);;
        $this->call(TrabajadorsTableSeeder::class);
        $this->call(TipoContratoSeeder::class);
        $this->call(EstructuraOrganizacionalSeeder::class);
        $this->call(EscalaSalarialSeeder::class);
        $this->call(UnidadOrganizacionalSeeder::class);
        $this->call(CargoSeeder::class);
        $this->call(NominaCargoSeeder::class);
        $this->call(AsignacionCargoSeeder::class);
        $this->call(ConfBonoAntiguedadSeeder::class);
        $this->call(ConfImpositivaSeeder::class);
        $this->call(ConfHorasExtraSeeder::class);
    }
}
