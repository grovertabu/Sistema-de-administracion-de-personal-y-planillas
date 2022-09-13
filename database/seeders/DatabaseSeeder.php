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
        // $this->call(NominaCargoSeeder::class);
        $this->call(NominaCargosTableSeeder::class);
        $this->call(AsignacionCargosTableSeeder::class);
        $this->call(ConfBonoAntiguedadSeeder::class);
        $this->call(ConfImpositivaSeeder::class);
        $this->call(ConfHorasExtraSeeder::class);
        $this->call(ConfAportesTableSeeder::class);
        $this->call(ConfOtroDescuentosTableSeeder::class);
        $this->call(ConfDescuentosTableSeeder::class);
        $this->call(PlanillaHorasExtrasTableSeeder::class);
        $this->call(PlanillaSuplenciasTableSeeder::class);
        $this->call(PlanillaAsistenciasTableSeeder::class);
        $this->call(PlanillaBonoAntiguedadsTableSeeder::class);
        $this->call(PlanillaTotalGanadosTableSeeder::class);
        $this->call(PlanillaAporteLaboralsTableSeeder::class);
        $this->call(PlanillaRefrigeriosTableSeeder::class);
        $this->call(PlanillaImpositivasTableSeeder::class);
        $this->call(PlanillaOtroDescuentosTableSeeder::class);
        $this->call(PlanillaFondoEmpleadosTableSeeder::class);
        $this->call(PlanillaDescuentosTableSeeder::class);
        $this->call(NombrePlanillasTableSeeder::class);
        $this->call(PlanillasTableSeeder::class);
    }
}
