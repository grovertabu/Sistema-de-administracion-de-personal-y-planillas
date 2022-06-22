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
            'fecha_ingreso'     => '1999-01-06',
            'aporte_afp'        => 'NO',
            'sindicato'         => 'NO',
            'socio_fe'          => 'SI',
            'trabajador_id'     => 2,
            'nomina_cargo_id'   => 2,
            'estado'            => 'HABILITADO',
        ]);
        AsignacionCargo::create([
            'fecha_ingreso'     => '2005-07-11',
            'aporte_afp'        => 'SI',
            'sindicato'         => 'NO',
            'socio_fe'          => 'SI',
            'trabajador_id'     => 3,
            'nomina_cargo_id'   => 3,
            'estado'            => 'HABILITADO',
        ]);
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2014-05-23',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 4,
                'nomina_cargo_id'   => 4,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2014-01-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 5,
                'nomina_cargo_id'   => 5,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-05-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 6,
                'nomina_cargo_id'   => 6,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1992-01-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 7,
                'nomina_cargo_id'   => 7,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-08-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 8,
                'nomina_cargo_id'   => 9,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2009-04-22',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 10,
                'nomina_cargo_id'   => 11,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1987-10-12',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 11,
                'nomina_cargo_id'   => 12,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2011-02-09',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 12,
                'nomina_cargo_id'   => 14,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2017-08-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 13,
                'nomina_cargo_id'   => 15,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-08-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 15,
                'nomina_cargo_id'   => 17,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2001-01-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 16,
                'nomina_cargo_id'   => 19,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1991-10-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 17,
                'nomina_cargo_id'   => 20,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2001-07-11',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 22,
                'nomina_cargo_id'   => 26,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2001-12-17',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 23,
                'nomina_cargo_id'   => 27,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2002-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 24,
                'nomina_cargo_id'   => 28,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2002-02-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 25,
                'nomina_cargo_id'   => 29,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1995-05-15',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 28,
                'nomina_cargo_id'   => 32,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1999-02-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 29,
                'nomina_cargo_id'   => 33,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2008-09-08',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 30,
                'nomina_cargo_id'   => 34,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 32,
                'nomina_cargo_id'   => 36,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2019-06-24',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 34,
                'nomina_cargo_id'   => 38,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-01-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 35,
                'nomina_cargo_id'   => 39,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-02-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 36,
                'nomina_cargo_id'   => 40,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-02-14',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 37,
                'nomina_cargo_id'   => 41,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2010-02-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 38,
                'nomina_cargo_id'   => 42,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2018-09-25',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 40,
                'nomina_cargo_id'   => 44,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-26',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 41,
                'nomina_cargo_id'   => 45,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 42,
                'nomina_cargo_id'   => 47,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 43,
                'nomina_cargo_id'   => 48,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1999-04-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 45,
                'nomina_cargo_id'   => 50,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2018-09-25',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 46,
                'nomina_cargo_id'   => 52,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2006-02-20',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 50,
                'nomina_cargo_id'   => 57,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-05-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 52,
                'nomina_cargo_id'   => 59,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1998-01-12',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 53,
                'nomina_cargo_id'   => 60,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-02-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 54,
                'nomina_cargo_id'   => 61,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-01-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 55,
                'nomina_cargo_id'   => 62,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1988-12-19',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 56,
                'nomina_cargo_id'   => 63,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-06-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 57,
                'nomina_cargo_id'   => 64,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1986-11-01',
                'aporte_afp'        => 'NO',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 58,
                'nomina_cargo_id'   => 65,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1997-09-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 59,
                'nomina_cargo_id'   => 66,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1988-01-11',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 60,
                'nomina_cargo_id'   => 67,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1985-09-12',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 61,
                'nomina_cargo_id'   => 68,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2000-04-18',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 62,
                'nomina_cargo_id'   => 69,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1999-04-07',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 63,
                'nomina_cargo_id'   => 70,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-05-22',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 65,
                'nomina_cargo_id'   => 72,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2000-06-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 66,
                'nomina_cargo_id'   => 73,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 68,
                'nomina_cargo_id'   => 75,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2011-04-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 69,
                'nomina_cargo_id'   => 76,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-04-21',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 70,
                'nomina_cargo_id'   => 77,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-05-23',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 71,
                'nomina_cargo_id'   => 78,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 74,
                'nomina_cargo_id'   => 81,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-26',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 75,
                'nomina_cargo_id'   => 82,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1987-09-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 76,
                'nomina_cargo_id'   => 83,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2005-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 77,
                'nomina_cargo_id'   => 84,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2008-04-25',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 79,
                'nomina_cargo_id'   => 86,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2012-09-04',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 80,
                'nomina_cargo_id'   => 87,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2011-04-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 82,
                'nomina_cargo_id'   => 89,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2000-09-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 83,
                'nomina_cargo_id'   => 90,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-02-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 84,
                'nomina_cargo_id'   => 91,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2011-02-09',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 86,
                'nomina_cargo_id'   => 93,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1986-09-22',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 89,
                'nomina_cargo_id'   => 98,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-02-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 90,
                'nomina_cargo_id'   => 99,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1989-07-10',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 91,
                'nomina_cargo_id'   => 100,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-26',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 92,
                'nomina_cargo_id'   => 101,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2010-08-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 93,
                'nomina_cargo_id'   => 102,
                'estado'            => 'HABILITADO',
            ]
        );



        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1988-05-09',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 94,
                'nomina_cargo_id'   => 103,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-08-12',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 95,
                'nomina_cargo_id'   => 104,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-10-15',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 96,
                'nomina_cargo_id'   => 105,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1980-01-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 99,
                'nomina_cargo_id'   => 108,
                'estado'            => 'HABILITADO',
            ]
        );

        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2011-04-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 103,
                'nomina_cargo_id'   => 112,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2005-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 104,
                'nomina_cargo_id'   => 113,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2001-04-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 105,
                'nomina_cargo_id'   => 114,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2019-02-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 108,
                'nomina_cargo_id'   => 117,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2019-02-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 116,
                'nomina_cargo_id'   => 125,
                'estado'            => 'HABILITADO',
            ]
        );

        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2001-05-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 117,
                'nomina_cargo_id'   => 126,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2000-05-08',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 118,
                'nomina_cargo_id'   => 127,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2001-04-03',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 119,
                'nomina_cargo_id'   => 129,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1996-04-03',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 120,
                'nomina_cargo_id'   => 131,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1995-09-04',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 121,
                'nomina_cargo_id'   => 133,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-08-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 122,
                'nomina_cargo_id'   => 134,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2010-08-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 123,
                'nomina_cargo_id'   => 135,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1993-05-03',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 126,
                'nomina_cargo_id'   => 138,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1987-04-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 130,
                'nomina_cargo_id'   => 144,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1988-02-17',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 133,
                'nomina_cargo_id'   => 147,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1986-09-15',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 134,
                'nomina_cargo_id'   => 148,
                'estado'            => 'HABILITADO',
            ]
        );

        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1975-07-16',
                'aporte_afp'        => 'NO',
                'sindicato'         => 'NO',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 135,
                'nomina_cargo_id'   => 149,
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
                'trabajador_id'     => 136,
                'nomina_cargo_id'   => 150,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1999-03-15',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 137,
                'nomina_cargo_id'   => 151,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2005-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 138,
                'nomina_cargo_id'   => 152,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1987-05-04',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 141,
                'nomina_cargo_id'   => 155,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2019-07-29',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 145,
                'nomina_cargo_id'   => 163,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1996-06-10',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 146,
                'nomina_cargo_id'   => 164,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1992-01-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 147,
                'nomina_cargo_id'   => 165,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1989-03-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 148,
                'nomina_cargo_id'   => 166,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1989-03-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 150,
                'nomina_cargo_id'   => 168,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1989-02-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 151,
                'nomina_cargo_id'   => 169,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1986-04-04',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 152,
                'nomina_cargo_id'   => 170,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1993-04-19',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 153,
                'nomina_cargo_id'   => 171,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-05-22',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 154,
                'nomina_cargo_id'   => 172,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2000-05-09',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 155,
                'nomina_cargo_id'   => 173,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1998-07-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 156,
                'nomina_cargo_id'   => 174,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-02-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 157,
                'nomina_cargo_id'   => 175,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-03-11',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 158,
                'nomina_cargo_id'   => 176,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1998-04-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 159,
                'nomina_cargo_id'   => 177,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2004-11-09',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 161,
                'nomina_cargo_id'   => 179,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 162,
                'nomina_cargo_id'   => 180,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2000-07-10',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 164,
                'nomina_cargo_id'   => 182,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1999-09-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 166,
                'nomina_cargo_id'   => 184,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1988-02-17',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 167,
                'nomina_cargo_id'   => 185,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-26',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 168,
                'nomina_cargo_id'   => 187,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-26',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 170,
                'nomina_cargo_id'   => 189,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1993-01-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 171,
                'nomina_cargo_id'   => 190,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1998-06-08',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 172,
                'nomina_cargo_id'   => 191,
                'estado'            => 'HABILITADO',
            ]
        );

        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1999-02-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 173,
                'nomina_cargo_id'   => 192,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1987-02-03',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 174,
                'nomina_cargo_id'   => 193,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1988-01-22',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 175,
                'nomina_cargo_id'   => 194,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2000-06-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 176,
                'nomina_cargo_id'   => 196,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-08-19',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 14,
                'nomina_cargo_id'   => 22,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2005-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 72,
                'nomina_cargo_id'   => 128,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2013-05-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 144,
                'nomina_cargo_id'   => 132,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2020-01-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 178,
                'nomina_cargo_id'   => 46,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2020-01-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 179,
                'nomina_cargo_id'   => 51,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-10-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 107,
                'nomina_cargo_id'   => 79,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-09-03',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 87,
                'nomina_cargo_id'   => 156,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2009-09-22',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 44,
                'nomina_cargo_id'   => 35,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2020-10-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 180,
                'nomina_cargo_id'   => 162,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-02-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 181,
                'nomina_cargo_id'   => 13,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-02-08',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 183,
                'nomina_cargo_id'   => 124,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-02-08',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 182,
                'nomina_cargo_id'   => 119,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-02-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 184,
                'nomina_cargo_id'   => 54,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2011-12-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 85,
                'nomina_cargo_id'   => 178,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2006-04-24',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 101,
                'nomina_cargo_id'   => 181,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-04-07',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 185,
                'nomina_cargo_id'   => 18,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1993-08-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 139,
                'nomina_cargo_id'   => 139,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1994-04-15',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 125,
                'nomina_cargo_id'   => 10,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2003-08-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 106,
                'nomina_cargo_id'   => 107,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2011-12-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 88,
                'nomina_cargo_id'   => 116,
                'estado'            => 'HABILITADO',//111
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2012-09-04',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 81,
                'nomina_cargo_id'   => 110,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-26',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 129,
                'nomina_cargo_id'   => 140,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-02-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 19,
                'nomina_cargo_id'   => 141,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2006-03-13',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 33,
                'nomina_cargo_id'   => 31,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-05-03',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 186,
                'nomina_cargo_id'   => 56,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1985-05-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 128,
                'nomina_cargo_id'   => 153,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1985-06-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 73,
                'nomina_cargo_id'   => 58,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2014-07-09',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 111,
                'nomina_cargo_id'   => 92,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2010-08-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 102,
                'nomina_cargo_id'   => 74,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-06-22',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 187,
                'nomina_cargo_id'   => 16,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-06-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 188,
                'nomina_cargo_id'   => 49,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-06-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 189,
                'nomina_cargo_id'   => 130,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2012-09-06',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 39,
                'nomina_cargo_id'   => 37,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2014-08-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 113,
                'nomina_cargo_id'   => 94,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2015-09-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 109,
                'nomina_cargo_id'   => 96,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2014-07-08',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 110,
                'nomina_cargo_id'   => 115,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-08-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 190,
                'nomina_cargo_id'   => 120,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-08-02',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 191,
                'nomina_cargo_id'   => 121,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2012-09-04',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 112,
                'nomina_cargo_id'   => 24,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-26',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 100,
                'nomina_cargo_id'   => 80,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2012-10-22',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 115,
                'nomina_cargo_id'   => 111,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-11-08',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 193,
                'nomina_cargo_id'   => 143,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2007-03-26',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 78,
                'nomina_cargo_id'   => 23,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-12-08',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 195,
                'nomina_cargo_id'   => 122,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-12-15',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 194,
                'nomina_cargo_id'   => 43,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2021-12-15',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 196,
                'nomina_cargo_id'   => 142,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2004-04-23',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 18,
                'nomina_cargo_id'   => 154,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '1999-05-05',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 140,
                'nomina_cargo_id'   => 195,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2016-12-07',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 114,
                'nomina_cargo_id'   => 109,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2000-04-18',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 165,
                'nomina_cargo_id'   => 167,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2010-08-16',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'SI',
                'socio_fe'          => 'SI',
                'trabajador_id'     => 143,
                'nomina_cargo_id'   => 188,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2005-06-01',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 48,
                'nomina_cargo_id'   => 53,
                'estado'            => 'HABILITADO',
            ]
        );
        AsignacionCargo::create(
            [
                'fecha_ingreso'     => '2022-01-07',
                'aporte_afp'        => 'SI',
                'sindicato'         => 'NO',
                'socio_fe'          => 'NO',
                'trabajador_id'     => 197,
                'nomina_cargo_id'   => 136,
                'estado'            => 'HABILITADO',
            ]
        );


    }
}
