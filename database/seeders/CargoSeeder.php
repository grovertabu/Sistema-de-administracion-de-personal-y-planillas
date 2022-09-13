<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cargo::create([
            'nombre'                       => mb_strtoupper('Gerente General'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Auditor Interno'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Jefe de Planificacion y Proyectos'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Tecnico de Planificacion'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Tecnico de Proyectos'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Topógrafo'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Encargado ODECO'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Asesor Juridico'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Auxiliar de Asesoria Juridica'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Secretaria Gerencia General'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Relacionador Publico y Gestion Publica'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Chofer'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Jefe de Sistemas Informaticos'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Programador y Analista de Sistemas'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Gerente Tecnico'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Ayudante Tecnico'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Tecnico de Operación y Mantenimiento'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Electromecanico'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Secretaria Gerencia Tecnica'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Chofer'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Chofer Equipo Pesado'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Tecnico de Catastro Redes'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Auxiliar Catastro Redes'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Mantenimiento de Valvulas'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Operador de Valvulas'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Jefe Captacion y Aduccion'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Chofer'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Capataz La Toma'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Capataz Cancha Cancha'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Capataz Socapampa'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Capataz Ruffo'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Capataz Cajamarca'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);

        Cargo::create([
            'nombre'                       => mb_strtoupper('Albañil Cajamarca'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Albañil La Toma'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Albañil Cancha Cancha'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Albañil Socapampa'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Albañil Ruffo'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon Socapampa'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon La Toma'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon Cajamarca'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon Socapampa'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon La Toma'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon Ruffo'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon Socapampa'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon La Toma'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon Socapampa'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon Cancha Cancha'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon Cajamarca'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon Ruffo'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon Ruffo'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon Cancha Cancha'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon Ruffo'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Jefe Planta Potabilizadora'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Tecnico de Planta Potabilizadora'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Tecnico de Planta Potabilizadora'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Tecnico de Planta Potabilizadora'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Tecnico de Planta Potabilizadora'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Operador Planta Potabilizadora'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Operador Planta Potabilizadora'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Operador Planta Potabilizadora'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Operador Planta Potabilizadora'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Jefe Control de Calidad'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Tecnico de Laboratorio'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Tecnico de Laboratorio'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Jefe Red de Agua'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Inspector Red de Agua'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Inspector Red de Agua'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Chofer Cisterna'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Chofer Cisterna'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Chofer Cisterna'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon Sistema Bombeo'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon Sistema Bombeo'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon Sistema Bombeo'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Inspector Red de Agua'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Plomero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Jefe Red de Alcantarillado'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Inspector Red de Alcantarillado'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Inspector Red de Alcantarillado'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Albañil'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Albañil'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Albañil'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Albañil'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Albañil'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Albañil'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Albañil'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Albañil'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);

        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peon'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);


        Cargo::create([
            'nombre'                       => mb_strtoupper('Jefe Planta de Tratamiento de Aguas Residuales'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Tecnico Laboratorio'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Operador PTAR'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Operador PTAR'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Operador PTAR'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Operador PTAR'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Operador PTAR'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Operador PTAR'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Operador PTAR'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Operador PTAR'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Gerente Administrativo y Financiero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Secretaria Gerencia Adm. y Financiero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Chofer'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Jefe Financiero Contable'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Tecnico de Presupuestos'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Responsable de Tesoreria y Credito Publico'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);

        Cargo::create([
            'nombre'                       => mb_strtoupper('Auxiliar de Contabilidad'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Auxiliar de Contabilidad'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Cajero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Cajero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Cajero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Cajero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Cajero'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Jefe Administrativo y de Personal'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Habilitado Pagador'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Mecanico'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Ayudante Mecanico'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Responsable de Adquisiciones'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Auxiliar de Adquisiciones'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);

        Cargo::create([
            'nombre'                       => mb_strtoupper('Responsable de Almacen'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Responsable de Activos Fijos'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Archivo Biblioteca'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Portero Oficina Central'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Portero Oficina Central'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Portero Edificio Pockonas'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Portero Planta Potabilizadora'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Portero PTAR'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Gerente Comercial'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Secretaria'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Chofer'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Jefe Medicion y Facturacion'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Inspector de Reclamos'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Inspector de Inconsistencias'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Inspector de Inconsistencias'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Responsable de Lecturas'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Responsable de Lecturas'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Lecturador Cortador'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Lecturador Cortador'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Lecturador Cortador'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Lecturador Cortador'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Lecturador Cortador'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Lecturador Cortador'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Lecturador Cortador'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Lecturador Cortador'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Lecturador Cortador'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Lecturador Cortador'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Lecturador Cortador'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Lecturador Cortador'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Lecturador Cortador'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Jefe Servicios al Clientes y Control Mora'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Responsable de Cortes'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Reconexiones'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Lecturador Cortador'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Lecturador Cortador'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Lecturador Cortador'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Catastro de Usuarios'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Auxiliar de Catastro'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Auxiliar de Catastro'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Tramites e Instalaciones'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Informacion y Atencion al Cliente'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Clinica de Medidores'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Auxiliar Clinica de Medidores'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);
        Cargo::create([
            'nombre'                       => mb_strtoupper('Peón'),
            'estructura_organizacional_id' => '1',
            'estado'                       => 'ACTIVO',
        ]);

        // Cargo::create([
        //     'nombre'                       => mb_strtoupper('SOPORTE DE SISTEMAS'),
        //     'estructura_organizacional_id' => '1',
        //     'estado'                       => 'ACTIVO',
        // ]);
    }
}
