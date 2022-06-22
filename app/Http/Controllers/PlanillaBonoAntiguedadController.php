<?php

namespace App\Http\Controllers;

use App\Models\AsignacionCargo;
use App\Models\PlanillaBonoAntiguedad;
use App\Models\ConfBonoAntiguedad;
use App\Models\ConfImpositiva;
use App\Models\Tipo_Contrato;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Funciones;

class PlanillaBonoAntiguedadController extends Controller
{
    public function __construct()
    {
        $this->BonoAntiguedad = new PlanillaBonoAntiguedad();
    }
    public function consultar_bono_antiguedad()
    {
        $tipo_contratos = Tipo_Contrato::where('estado', 'ACTIVO')->get();;
        return view('planillas.bono_antiguedad.consultar', compact('tipo_contratos'));
    }

    // metodo para la lista de los bonos de antiguedad
    public function lista_bono_antiguedad(Request $request)
    {
        $request->validate([
            'mes' => 'required|numeric',
            'gestion' => 'required|numeric',
            'tipo_contrato' => 'required|numeric',
        ]);
        // $lista_bono_antiguedad
        $mes = $request->mes;
        $gestion = $request->gestion;
        $tipo_contrato = $request->tipo_contrato;
        $lista_bono_antiguedad = $this->BonoAntiguedad->bono_antiguedad_lista($mes, $gestion, $tipo_contrato);
        // return $lista_bono_antiguedad;
        return view('planillas.bono_antiguedad.lista', compact('mes', 'gestion', 'tipo_contrato', 'lista_bono_antiguedad'));
    }
    // formulario para la generacion de la planilla
    public function create_all_planilla($mes, $gestion, $tipo_contrato)
    {
        return view('planillas.bono_antiguedad.create_all', compact('mes', 'gestion', 'tipo_contrato'));
    }

    // insertar todo los datos sumando la antiguedad actual en la empresa con los años de servicio actual
    public function generar_planilla(Request $request)
    {
        $request->validate([
            'mes' => 'required',
            'gestion' => 'required',
            'fecha_calculo' => 'required',
        ]);
        $tipo_contrato_id = $request->tipo_contrato;
        $mes = $request->mes;
        $gestion = $request->gestion;

        $verificar =  DB::table('planilla_bono_antiguedads')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato_id]
        ])->first();
        // si existe verificar->tipo_contrato imprima tipo contrato si no vacio ''
        $verificar_tipo_contrato = isset($verificar->tipo_contrato) ? $verificar->tipo_contrato : "";
        $verificar_mes = isset($verificar->mes) ? $verificar->mes : "";
        $verificar_gestion = isset($verificar->gestion) ? $verificar->gestion : "";
        if ($verificar_tipo_contrato != $tipo_contrato_id && $verificar_mes != $mes && $verificar_gestion != $gestion) {
            $lista_trabajadores = DB::table('asignacion_cargos as ac')
                ->join('trabajadors as t', 't.id', 'ac.trabajador_id')
                ->join('planilla_asistencias as a', 'a.asignacion_cargo_id', 'ac.id')
                ->select(
                    'ac.id as id_asignacion_cargo',
                    'ac.fecha_ingreso as fecha_ingreso',
                    'ac.estado as estado_asignacion',
                    DB::raw("CONCAT(t.nombre,' ',t.apellido_paterno,' ',t.apellido_materno)  AS nombre_completo"),
                    't.antiguedad_anios as antiguedad_anios',
                    't.antiguedad_meses as antiguedad_meses',
                    't.antiguedad_dias as antiguedad_dias',
                    'a.mes as mes',
                    'a.gestion as gestion',
                    'a.tipo_contrato as tipo_contrato',
                    'a.dias_asistencia as dias_asistencia',
                    'a.dias_laborales as dias_laborales',
                )
                ->where([
                    ['mes', '=', $mes],
                    ['gestion', '=', $gestion],
                    ['tipo_contrato', '=', $tipo_contrato_id],
                    ['ac.estado', '=', 'HABILITADO']
                ])
                ->get();

            // return $lista_trabajadores;
            if ($lista_trabajadores->count() > 0) {
                foreach ($lista_trabajadores as $contrato) {
                    // return $request->fecha_calculo . '-' . $contrato->fecha_ingreso;
                    if ($contrato->fecha_ingreso < $request->fecha_calculo) {
                        $antiguedad_actual = Funciones::antiguedad($contrato->fecha_ingreso, $request->fecha_calculo);
                        // dd($antiguedad_actual);
                    } else {
                        return redirect()->route(
                            'bono_antiguedad.lista',
                            [
                                'tipo_contrato' => $tipo_contrato_id,
                                'mes' => $mes,
                                'gestion' => $gestion
                            ]
                        )
                            ->with('message', 'Error.  incoherencia de fechas en el trabajador: ' . $contrato->nombre_completo);
                    }

                    $antiguedad_anterior = array($contrato->antiguedad_anios, $contrato->antiguedad_meses, $contrato->antiguedad_dias);

                    $antiguedad_final = Funciones::sumar_antiguedad($antiguedad_anterior, $antiguedad_actual);
                    if ($antiguedad_final[0] > 2) { //si el año del resultado es mayor a 2
                        // la antiguedad dependera de acuerdo a la siguiente configuracion dando su respectivo
                        // porcentaje de acuerdo en que rango configurativo pertenece
                        $conf_bono_antiguedads = ConfBonoAntiguedad::select(
                            'anio_i',
                            'anio_f',
                            'porcentaje',
                            'estado',
                        )->where('estado', 'HABILITADO')->get();
                        // configuracion para recuperar el salario minimo de acuerdo a las normas actuales (objeto)
                        $conf_impositiva = ConfImpositiva::select('salario_minimo')->where('estado', 'HABILITADO')->first();
                        foreach ($conf_bono_antiguedads as $c_bono) {
                            if ($antiguedad_final[0] >= $c_bono->anio_i && $antiguedad_final[0] <= $c_bono->anio_f) {
                                $monto_final = ((($conf_impositiva->salario_minimo * 3 * $c_bono->porcentaje) / 100) / $contrato->dias_laborales) * $contrato->dias_asistencia;
                                PlanillaBonoAntiguedad::create([
                                    'mes' => $mes,
                                    'gestion' => $gestion,
                                    'tipo_contrato' => $tipo_contrato_id,
                                    'anios_arrastre' => $contrato->antiguedad_anios,
                                    'meses_arrastre' => $contrato->antiguedad_meses,
                                    'dias_arrastre' => $contrato->antiguedad_dias,
                                    'fecha_ingreso' => $contrato->fecha_ingreso,
                                    'fecha_calculo' => $request->fecha_calculo,
                                    'anios_actual' => $antiguedad_final[0],
                                    'meses_actual' => $antiguedad_final[1],
                                    'dias_actual' => $antiguedad_final[2],
                                    'porcentaje' => $c_bono->porcentaje,
                                    'monto' => $monto_final,
                                    'asignacion_cargo_id' => $contrato->id_asignacion_cargo,
                                ]);
                            }
                        }
                    } else {
                        // al no tener mas de 2 años de antiguedad su bono llega a ser 0
                        PlanillaBonoAntiguedad::create([
                            'mes' => $mes,
                            'gestion' => $gestion,
                            'tipo_contrato' => $tipo_contrato_id,
                            'anios_arrastre' => $contrato->antiguedad_anios,
                            'meses_arrastre' => $contrato->antiguedad_meses,
                            'dias_arrastre' => $contrato->antiguedad_dias,
                            'fecha_ingreso' => $contrato->fecha_ingreso,
                            'fecha_calculo' => $request->fecha_calculo,
                            'anios_actual' => $antiguedad_final[0],
                            'meses_actual' => $antiguedad_final[1],
                            'dias_actual' => $antiguedad_final[2],
                            'porcentaje' => 0,
                            'monto' => 0,
                            'asignacion_cargo_id' => $contrato->id_asignacion_cargo,
                        ]);
                    }
                }
                return redirect()->route(
                    'bono_antiguedad.lista',
                    [
                        'tipo_contrato' => $tipo_contrato_id,
                        'mes' => $mes,
                        'gestion' => $gestion
                    ]
                )->with('create', 'Planilla Bono de antiguedad creado exitosamente.');
            } else {
                return redirect()->route(
                    'bono_antiguedad.lista',
                    [
                        'tipo_contrato' => $tipo_contrato_id,
                        'mes' => $mes,
                        'gestion' => $gestion
                    ]
                )
                    ->with('message', 'No existen registros para generar la planilla');
            }
        } else {
            return redirect()->route('bono_antiguedad.lista', [
                'tipo_contrato' => $tipo_contrato_id,
                'mes' => $mes,
                'gestion' => $gestion
            ])->with('message', 'Error. Ya se tiene generada la planilla de bono de antiguedad para ese periodo');
        }
    }

    public function editar_bono_antiguedad($id)
    {
        $bono_antiguedad = PlanillaBonoAntiguedad::find($id);

        $cargo = AsignacionCargo::select('id', 'trabajador_id')
            ->find($bono_antiguedad->asignacion_cargo_id);

        $trabajador = Trabajador::select(DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"))
            ->find($cargo->trabajador_id);
        return view('planillas.bono_antiguedad.edit', compact('bono_antiguedad', 'trabajador'));
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'monto' => 'required|numeric',
        ]);
        $data = PlanillaBonoAntiguedad::select('id', 'mes', 'gestion', 'tipo_contrato')->find($id);
        $data->monto = $request->monto;
        $bono_antiguedad = $data->save();
        if ($bono_antiguedad) {
            return redirect()->route('bono_antiguedad.lista', [
                'tipo_contrato' => $data->tipo_contrato,
                'mes' => $data->mes,
                'gestion' => $data->gestion
            ])->with('edit', 'Bono antiguedad modificada exitosamente.');
        }
    }

    public function create_bono_antiguedad($mes, $gestion, $tipo_contrato)
    {
        // todos los trabajadores que no tengan un bono de antiguedad registrado
        $trabajadores = AsignacionCargo::select(
            'asignacion_cargos.id as asignacion_cargo_id',
            DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"),
        )
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->where('asignacion_cargos.estado', 'HABILITADO')
            ->whereNotIn('asignacion_cargos.id', function ($query) use ($mes, $gestion, $tipo_contrato) {
                $query->select('planilla_bono_antiguedads.asignacion_cargo_id')
                    ->from('planilla_bono_antiguedads')->where([
                        ['mes', '=', $mes],
                        ['gestion', '=', $gestion],
                        ['tipo_contrato', '=', $tipo_contrato]
                    ]);
            })->get();
        // return $trabajadores;
        return view('planillas.bono_antiguedad.create', compact('mes', 'gestion', 'tipo_contrato', 'trabajadores'));
    }

    public function generar_bono_antiguedad(Request $request)
    {
        $request->validate([
            'mes' => 'required',
            'gestion' => 'required',
            'trabajador' => 'required',
            'fecha_calculo' => 'required',
        ]);
        $tipo_contrato_id = $request->tipo_contrato;
        $mes = $request->mes;
        $gestion = $request->gestion;
        $cargo_trabajador = $request->trabajador;

        $verificar =  DB::table('planilla_bono_antiguedads')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato_id],
            ['asignacion_cargo_id', '=', $cargo_trabajador]
        ])->first();

        // si existe verificar->tipo_contrato imprima tipo contrato si no vacio ''
        $verificar_tipo_contrato = isset($verificar->tipo_contrato) ? $verificar->tipo_contrato : "";
        $verificar_mes = isset($verificar->mes) ? $verificar->mes : "";
        $verificar_gestion = isset($verificar->gestion) ? $verificar->gestion : "";
        $verificar_asignacion_cargo_id = isset($verificar->asignacion_cargo_id) ? $verificar->asignacion_cargo_id : "";
        if ($verificar_tipo_contrato != $tipo_contrato_id && $verificar_mes != $mes && $verificar_gestion != $gestion && $verificar_asignacion_cargo_id != $cargo_trabajador) {
            $trabajador = DB::table('asignacion_cargos as ac')
                ->join('trabajadors as t', 't.id', 'ac.trabajador_id')
                ->join('planilla_asistencias as a', 'a.asignacion_cargo_id', 'ac.id')
                ->select(
                    'ac.id as id_asignacion_cargo',
                    'ac.fecha_ingreso as fecha_ingreso',
                    'ac.estado as estado_asignacion',
                    DB::raw("CONCAT(t.nombre,' ',t.apellido_paterno,' ',t.apellido_materno)  AS nombre_completo"),
                    't.antiguedad_anios as antiguedad_anios',
                    't.antiguedad_meses as antiguedad_meses',
                    't.antiguedad_dias as antiguedad_dias',
                    'a.mes as mes',
                    'a.gestion as gestion',
                    'a.tipo_contrato as tipo_contrato',
                    'a.dias_asistencia as dias_asistencia',
                    'a.dias_laborales as dias_laborales',
                )
                ->where([
                    ['mes', '=', $mes],
                    ['gestion', '=', $gestion],
                    ['tipo_contrato', '=', $tipo_contrato_id],
                    ['ac.estado', '=', 'HABILITADO'],
                    ['ac.id', '=', $cargo_trabajador]
                ])
                ->first();


            if (!empty($trabajador)) {
                // return $trabajador->fecha_ingreso . '-' . $request->fecha_calculo;
                if ($trabajador->fecha_ingreso < $request->fecha_calculo) {
                    $antiguedad_actual = Funciones::antiguedad($trabajador->fecha_ingreso, $request->fecha_calculo);
                    // dd($antiguedad_actual);
                } else {
                    return redirect()->route(
                        'bono_antiguedad.lista',
                        [
                            'tipo_contrato' => $tipo_contrato_id,
                            'mes' => $mes,
                            'gestion' => $gestion
                        ]
                    )
                        ->with('message', 'Error.  incoherencia de fechas en el trabajador: ' . $trabajador->nombre_completo);
                }

                $antiguedad_anterior = array($trabajador->antiguedad_anios, $trabajador->antiguedad_meses, $trabajador->antiguedad_dias);
                // dd($antiguedad_anterior);
                $antiguedad_final = Funciones::sumar_antiguedad($antiguedad_anterior, $antiguedad_actual);
                if ($antiguedad_final[0] > 2) { //si el año del resultado es mayor a 2
                    // la antiguedad dependera de acuerdo a la siguiente configuracion dando su respectivo
                    // porcentaje de acuerdo en que rango configurativo pertenece
                    $conf_bono_antiguedads = ConfBonoAntiguedad::select(
                        'anio_i',
                        'anio_f',
                        'porcentaje',
                        'estado',
                    )->where('estado', 'HABILITADO')->get();
                    // configuracion para recuperar el salario minimo de acuerdo a las normas actuales (objeto)
                    $conf_impositiva = ConfImpositiva::select('salario_minimo')->where('estado', 'HABILITADO')->first();
                    foreach ($conf_bono_antiguedads as $c_bono) {
                        if ($antiguedad_final[0] >= $c_bono->anio_i && $antiguedad_final[0] <= $c_bono->anio_f) {
                            $monto_final = ((($conf_impositiva->salario_minimo * 3 * $c_bono->porcentaje) / 100) / $trabajador->dias_laborales) * $trabajador->dias_asistencia;
                            PlanillaBonoAntiguedad::create([
                                'mes' => $mes,
                                'gestion' => $gestion,
                                'tipo_contrato' => $tipo_contrato_id,
                                'anios_arrastre' => $trabajador->antiguedad_anios,
                                'meses_arrastre' => $trabajador->antiguedad_meses,
                                'dias_arrastre' => $trabajador->antiguedad_dias,
                                'fecha_ingreso' => $trabajador->fecha_ingreso,
                                'fecha_calculo' => $request->fecha_calculo,
                                'anios_actual' => $antiguedad_final[0],
                                'meses_actual' => $antiguedad_final[1],
                                'dias_actual' => $antiguedad_final[2],
                                'porcentaje' => $c_bono->porcentaje,
                                'monto' => $monto_final,
                                'asignacion_cargo_id' => $trabajador->id_asignacion_cargo,
                            ]);
                        }
                    }
                } else {
                    // al no tener mas de 2 años de antiguedad su bono llega a ser 0
                    PlanillaBonoAntiguedad::create([
                        'mes' => $mes,
                        'gestion' => $gestion,
                        'tipo_contrato' => $tipo_contrato_id,
                        'anios_arrastre' => $trabajador->antiguedad_anios,
                        'meses_arrastre' => $trabajador->antiguedad_meses,
                        'dias_arrastre' => $trabajador->antiguedad_dias,
                        'fecha_ingreso' => $trabajador->fecha_ingreso,
                        'fecha_calculo' => $request->fecha_calculo,
                        'anios_actual' => $antiguedad_final[0],
                        'meses_actual' => $antiguedad_final[1],
                        'dias_actual' => $antiguedad_final[2],
                        'porcentaje' => 0,
                        'monto' => 0,
                        'asignacion_cargo_id' => $trabajador->id_asignacion_cargo,
                    ]);
                }
                return redirect()->route(
                    'bono_antiguedad.lista',
                    [
                        'tipo_contrato' => $tipo_contrato_id,
                        'mes' => $mes,
                        'gestion' => $gestion
                    ]
                )->with('create', 'Bono antiguedad creado exitosamente.');
            } else {
                return redirect()->route(
                    'bono_antiguedad.lista',
                    [
                        'tipo_contrato' => $tipo_contrato_id,
                        'mes' => $mes,
                        'gestion' => $gestion
                    ]
                )
                    ->with('message', 'El trabajador no tiene datos');
            }
        } else {
            return redirect()->route('bono_antiguedad.lista', [
                'tipo_contrato' => $tipo_contrato_id,
                'mes' => $mes,
                'gestion' => $gestion
            ])->with('message', 'Error. Ya se tiene generada planilla Bono de antiguedad para ese periodo');
        }
        return $request;
    }


    public function eliminar_bono_antiguedad($id)
    {
        $bono_antiguedad = PlanillaBonoAntiguedad::find($id);
        $bono_antiguedad->delete();
        return response()->json(['success' => true, 'message' => "Bono de antiguedad eliminado exitosamente."], 200);
    }

    public function eliminar_planilla($mes, $gestion, $tipo_contrato)
    {
         DB::table('planilla_bono_antiguedads')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato],
        ])->delete();
        return response()->json(['success' => true, 'message' => "Planilla Bono de Antiguedad eliminada exitosamente."], 200);
    }

    // CONTROLADOR PARA EL REPORTE DE BONO DE ANTIGUEDAD
    public function planilla_pdf($mes, $gestion, $tipo_contrato){
        $nomina_cargos = DB::table('nomina_cargos as nc')
        ->leftjoin('asignacion_cargos as ac', 'ac.nomina_cargo_id','nc.id')
        ->join('unidad_organizacionals as u','u.id','nc.unidad_organizacional_id')
        ->select(
                'u.seccion',
                'nc.item as item',
                'ac.estado as estado_asignacion',
                'nc.estado as estado_cargo')
        ->orderBy('nc.item')->get();
        foreach ($nomina_cargos as $cargo) {
            if($cargo->estado_asignacion == 'HABILITADO'){ // && $cargo->estado_cargo == 'OCUPADO'
                $bono_antiguedads = DB::table('nomina_cargos as nc')
                ->leftjoin('asignacion_cargos as ac', 'ac.nomina_cargo_id','nc.id')
                ->join('unidad_organizacionals as u','u.id','nc.unidad_organizacional_id')
                ->join('cargos as c','c.id','nc.cargo_id')
                ->join('trabajadors as t','t.id','ac.trabajador_id')
                ->join('planilla_bono_antiguedads as ba','ba.asignacion_cargo_id','ac.id')
                ->where([
                    ['ba.mes', '=', $mes],
                    ['ba.gestion', '=', $gestion],
                    ['ba.tipo_contrato', '=', $tipo_contrato],
                    ['nc.item', '=', $cargo->item],
                    ['u.seccion', '=', $cargo->seccion],
                ])
                ->select(
                    'nc.item as item',
                    DB::raw("CONCAT(t.nombre,' ',t.apellido_paterno,' ',t.apellido_materno)  AS nombre_completo"),
                    'c.nombre as cargo',
                    'ba.anios_arrastre',
                    'ba.meses_arrastre',
                    'ba.dias_arrastre',
                    'ba.fecha_ingreso',
                    'ba.fecha_calculo',
                    'ba.anios_actual',
                    'ba.meses_actual',
                    'ba.dias_actual',
                    'ba.porcentaje',
                    'ba.monto',
                )
                ->orderBy('nc.item')->first();

                // de esta manera agrego las Bonos de un trabajador al item respectivo
                $cargo->datos = $bono_antiguedads;
            }
        }
        // return $cargos;
        $collect = collect($nomina_cargos);
        $cargos = $collect->groupBy('seccion');
        // return $cargos;
        return response(view('planillas.bono_antiguedad.pdf_bono_antiguedads',compact('mes', 'gestion', 'tipo_contrato','cargos')))
        ->header('Content-Type', 'application/pdf');
    }

}
