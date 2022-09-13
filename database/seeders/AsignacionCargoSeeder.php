<?php

namespace Database\Seeders;

use App\Models\AsignacionCargo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsignacionCargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AsignacionCargo::create([
            'fecha_ingreso'     => '2018-12-20',
            'fecha_conclusion'     => '2022-03-08',
            'aporte_afp'        => 'SI',
            'sindicato'         => 'NO',
            'socio_fe'          => 'NO',
            'nomina_cargo_id'   => 1,
            'trabajador_id'     => 1,
            'estado'            => 'HABILITADO',
        ]);//1
        AsignacionCargo::create([
            'fecha_ingreso'     => '1999-01-06',
            'aporte_afp'        => 'NO',
            'sindicato'         => 'NO',
            'socio_fe'          => 'SI',
            'nomina_cargo_id'   => 2,
            'trabajador_id'     => 2,
            'estado'            => 'HABILITADO',
        ]);
        AsignacionCargo::create([
            'fecha_ingreso'     => '2005-07-11',
            'aporte_afp'        => 'SI',
            'sindicato'         => 'NO',
            'socio_fe'          => 'SI',
            'nomina_cargo_id'   => 3,
            'trabajador_id'     => 3,
            'estado'            => 'HABILITADO',
        ]);
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2014-05-23',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 4,
                'trabajador_id'     => 4,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2014-01-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 5,
                'trabajador_id'     => 5,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-05-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 6,
                'trabajador_id'     => 6,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1992-01-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 7,
                'trabajador_id'     => 7,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-08-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 9,
                'trabajador_id'     => 8,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2009-04-22',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 11,
                'trabajador_id'     => 10,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1987-10-12',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 12,
                'trabajador_id'     => 11,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2011-02-09',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 14,
                'trabajador_id'     => 12,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2017-08-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 15,
                'trabajador_id'     => 13,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-08-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 17,
                'trabajador_id'     => 15,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2001-01-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 19,
                'trabajador_id'     => 16,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1991-10-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 20,
                'trabajador_id'     => 17,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2001-07-11',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 26,
                'trabajador_id'     => 22,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2001-12-17',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 27,
                'trabajador_id'     => 23,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2002-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 28,
                'trabajador_id'     => 24,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2002-02-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 29,
                'trabajador_id'     => 25,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 30,
                'trabajador_id'     => 32,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1995-05-15',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 32,
                'trabajador_id'     => 28,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1999-02-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 33,
                'trabajador_id'     => 29,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2008-09-08',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 34,
                'trabajador_id'     => 30,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-10-01',
                'fecha_conclusion'  => '2022-05-31',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 36,
                'trabajador_id'     => 32,
                'estado'            => 'INHABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2019-06-24',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 38,
                'trabajador_id'     => 34,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-01-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 39,
                'trabajador_id'     => 35,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-02-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 40,
                'trabajador_id'     => 36,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-02-14',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 41,
                'trabajador_id'     => 37,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2010-02-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 42,
                'trabajador_id'     => 38,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2018-09-25',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 44,
                'trabajador_id'     => 40,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-26',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 45,
                'trabajador_id'     => 41,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 47,
                'trabajador_id'     => 42,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 48,
                'trabajador_id'     => 43,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1999-04-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 50,
                'trabajador_id'     => 45,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2018-09-25',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 52,
                'trabajador_id'     => 46,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2006-02-20',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 57,
                'trabajador_id'     => 50,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-05-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 59,
                'trabajador_id'     => 52,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1998-01-12',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 60,
                'trabajador_id'     => 53,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-02-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 61,
                'trabajador_id'     => 54,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-01-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 62,
                'trabajador_id'     => 55,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1988-12-19',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 63,
                'trabajador_id'     => 56,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-06-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 64,
                'trabajador_id'     => 57,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1986-11-01',
                'aporte_afp'        => 'NO',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 65,
                'trabajador_id'     => 58,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1997-09-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 66,
                'trabajador_id'     => 59,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1988-01-11',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 67,
                'trabajador_id'     => 60,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1985-09-12',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 68,
                'trabajador_id'     => 61,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2000-04-18',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 69,
                'trabajador_id'     => 62,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1999-04-07',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 70,
                'trabajador_id'     => 63,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-05-22',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 72,
                'trabajador_id'     => 65,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2000-06-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 73,
                'trabajador_id'     => 66,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 75,
                'trabajador_id'     => 68,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2011-04-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 76,
                'trabajador_id'     => 69,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-04-21',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 77,
                'trabajador_id'     => 70,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-05-23',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 78,
                'trabajador_id'     => 71,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 81,
                'trabajador_id'     => 74,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-26',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 82,
                'trabajador_id'     => 75,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1987-09-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 83,
                'trabajador_id'     => 76,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2005-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 84,
                'trabajador_id'     => 77,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2008-04-25',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 86,
                'trabajador_id'     => 79,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2012-09-04',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 87,
                'trabajador_id'     => 80,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2011-04-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 89,
                'trabajador_id'     => 82,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2000-09-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 90,
                'trabajador_id'     => 83,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-02-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 91,
                'trabajador_id'     => 84,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2011-02-09',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 93,
                'trabajador_id'     => 86,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1986-09-22',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 98,
                'trabajador_id'     => 89,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-02-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 99,
                'trabajador_id'     => 90,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1989-07-10',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 100,
                'trabajador_id'     => 91,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-26',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 101,
                'trabajador_id'     => 92,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2010-08-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 102,
                'trabajador_id'     => 93,
                'estado'            => 'HABILITADO',
            ]
        );



        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1988-05-09',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 103,
                'trabajador_id'     => 94,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-08-12',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 104,
                'trabajador_id'     => 95,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-10-15',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 105,
                'trabajador_id'     => 96,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1980-01-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 108,
                'trabajador_id'     => 99,
                'estado'            => 'HABILITADO',
            ]
        );

        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2011-04-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 112,
                'trabajador_id'     => 103,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2005-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 113,
                'trabajador_id'     => 104,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2001-04-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 114,
                'trabajador_id'     => 105,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2019-02-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 85,
                'trabajador_id'     => 116,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2019-02-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 88,
                'trabajador_id'     => 108,
                'estado'            => 'HABILITADO',
            ]
        );

        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2001-05-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 126,
                'trabajador_id'     => 117,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2000-05-08',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 127,
                'trabajador_id'     => 118,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2001-04-03',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 129,
                'trabajador_id'     => 119,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1996-04-03',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 131,
                'trabajador_id'     => 120,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1995-09-04',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 133,
                'trabajador_id'     => 121,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-08-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 134,
                'trabajador_id'     => 122,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2010-08-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 135,
                'trabajador_id'     => 123,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1993-05-03',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 138,
                'trabajador_id'     => 126,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1987-04-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 144,
                'trabajador_id'     => 130,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1988-02-17',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 147,
                'trabajador_id'     => 133,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1986-09-15',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 148,
                'trabajador_id'     => 134,
                'estado'            => 'HABILITADO',
            ]
        );

        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1975-07-16',
                'aporte_afp'        => 'NO',
                'sindicato'         => 'NO',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 149,
                'trabajador_id'     => 135,
                'estado'            => 'HABILITADO',
            ]
        );
        //
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1989-12-07',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 150,
                'trabajador_id'     => 136,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1999-03-15',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 151,
                'trabajador_id'     => 137,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2005-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 152,
                'trabajador_id'     => 138,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1987-05-04',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 155,
                'trabajador_id'     => 141,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2019-07-29',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 163,
                'trabajador_id'     => 145,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1996-06-10',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 164,
                'trabajador_id'     => 146,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1992-01-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 165,
                'trabajador_id'     => 147,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1989-03-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 166,
                'trabajador_id'     => 148,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1989-03-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 168,
                'trabajador_id'     => 150,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1989-02-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 169,
                'trabajador_id'     => 151,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1986-04-04',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 170,
                'trabajador_id'     => 152,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1993-04-19',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 171,
                'trabajador_id'     => 153,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-05-22',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 172,
                'trabajador_id'     => 154,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2000-05-09',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 173,
                'trabajador_id'     => 155,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1998-07-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 174,
                'trabajador_id'     => 156,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-02-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 175,
                'trabajador_id'     => 157,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-03-11',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 176,
                'trabajador_id'     => 158,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1998-04-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 177,
                'trabajador_id'     => 159,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2004-11-09',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 179,
                'trabajador_id'     => 161,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 180,
                'trabajador_id'     => 162,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2000-07-10',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 182,
                'trabajador_id'     => 164,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1999-09-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 184,
                'trabajador_id'     => 166,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1988-02-17',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 185,
                'trabajador_id'     => 167,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-26',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 187,
                'trabajador_id'     => 168,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-26',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 189,
                'trabajador_id'     => 170,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1993-01-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 190,
                'trabajador_id'     => 171,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1998-06-08',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 191,
                'trabajador_id'     => 172,
                'estado'            => 'HABILITADO',
            ]
        );

        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1999-02-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 192,
                'trabajador_id'     => 173,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1987-02-03',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 193,
                'trabajador_id'     => 174,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1988-01-22',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 194,
                'trabajador_id'     => 175,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2000-06-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 196,
                'trabajador_id'     => 176,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-08-19',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 22,
                'trabajador_id'     => 14,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2005-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 128,
                'trabajador_id'     => 72,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-05-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 132,
                'trabajador_id'     => 144,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2020-01-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 46,
                'trabajador_id'     => 178,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2020-01-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 51,
                'trabajador_id'     => 179,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-10-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 79,
                'trabajador_id'     => 107,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-09-03',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 156,
                'trabajador_id'     => 87,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2009-09-22',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 35,
                'trabajador_id'     => 44,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2020-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 162,
                'trabajador_id'     => 180,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-02-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 13,
                'trabajador_id'     => 181,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-02-08',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 124,
                'trabajador_id'     => 183,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-02-08',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 119,
                'trabajador_id'     => 182,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-02-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 54,
                'trabajador_id'     => 184,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2011-12-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 178,
                'trabajador_id'     => 85,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2006-04-24',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 181,
                'trabajador_id'     => 101,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-04-07',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 18,
                'trabajador_id'     => 185,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1993-08-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 139,
                'trabajador_id'     => 139,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1994-04-15',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 10,
                'trabajador_id'     => 125,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-08-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 107,
                'trabajador_id'     => 106,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2011-12-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 116,
                'trabajador_id'     => 88,
                'estado'            => 'HABILITADO',//111
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2012-09-04',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 110,
                'trabajador_id'     => 81,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-26',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 140,
                'trabajador_id'     => 129,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-02-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 141,
                'trabajador_id'     => 19,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2006-03-13',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 31,
                'trabajador_id'     => 33,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-05-03',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 56,
                'trabajador_id'     => 186,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1985-05-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 153,
                'trabajador_id'     => 128,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1985-06-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 58,
                'trabajador_id'     => 73,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2014-07-09',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 92,
                'trabajador_id'     => 111,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2010-08-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 74,
                'trabajador_id'     => 102,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-06-22',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 16,
                'trabajador_id'     => 187,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-06-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 49,
                'trabajador_id'     => 188,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-06-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 130,
                'trabajador_id'     => 189,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2012-09-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 37,
                'trabajador_id'     => 39,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2014-08-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 94,
                'trabajador_id'     => 113,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2015-09-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 96,
                'trabajador_id'     => 109,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2014-07-08',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 115,
                'trabajador_id'     => 110,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-08-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 120,
                'trabajador_id'     => 190,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-08-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 121,
                'trabajador_id'     => 191,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2012-09-04',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 24,
                'trabajador_id'     => 112,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-26',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 80,
                'trabajador_id'     => 100,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2012-10-22',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 111,
                'trabajador_id'     => 115,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-11-08',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 143,
                'trabajador_id'     => 193,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-26',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 23,
                'trabajador_id'     => 78,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-12-08',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 122,
                'trabajador_id'     => 195,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-12-15',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 43,
                'trabajador_id'     => 194,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-12-15',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 142,
                'trabajador_id'     => 196,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2004-04-23',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 154,
                'trabajador_id'     => 18,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1999-05-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 195,
                'trabajador_id'     => 140,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2016-12-07',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 109,
                'trabajador_id'     => 114,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2000-04-18',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 167,
                'trabajador_id'     => 165,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2010-08-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'nomina_cargo_id'   => 188,
                'trabajador_id'     => 143,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2005-06-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 53,
                'trabajador_id'     => 48,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2022-01-07',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'nomina_cargo_id'   => 136,
                'trabajador_id'     => 197,
                'estado'            => 'HABILITADO',
            ]
        );


    }
}
