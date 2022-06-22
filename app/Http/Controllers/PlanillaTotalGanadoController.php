<?php

namespace App\Http\Controllers;

use App\Models\AsignacionCargo;
use App\Models\Tipo_Contrato;
use App\Models\PlanillaTotalGanado;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanillaTotalGanadoController extends Controller
{
    public function __construct()
    {
        $this->TotalGanado = new PlanillaTotalGanado();
    }
    public function consultar_total_ganado()
    {
        // $tipo_contratos = Tipo_Contrato::where('estado', 'ACTIVO')->get();
        return view('planillas.total_ganado.consultar');
    }

    public function lista_total_ganado(Request $request)
    {
        $request->validate([
            'mes' => 'required|numeric',
            'gestion' => 'required|numeric',
            'tipo_contrato' => 'required|numeric',
        ]);
        // $lista_total_ganado
        $mes = $request->mes;
        $gestion = $request->gestion;
        $tipo_contrato = $request->tipo_contrato;
        $lista_total_ganado = $this->TotalGanado->total_ganado_lista($mes, $gestion, $tipo_contrato);
        // return $lista_total_ganado;
        return view('planillas.total_ganado.lista', compact('mes', 'gestion', 'tipo_contrato', 'lista_total_ganado'));
    }

    public function create_all_planilla($mes, $gestion, $tipo_contrato)
    {
        return view('planillas.total_ganado.create_all', compact('mes', 'gestion', 'tipo_contrato'));
    }

    public function generar_planilla(Request $request)
    {
        $request->validate([
            'mes' => 'required',
            'gestion' => 'required',
            'tipo_contrato' => 'required|numeric',
            'total_dias' => 'required|numeric|max:30|min:0',
        ]);
        $tipo_contrato_id = $request->tipo_contrato;
        $mes = $request->mes;
        $gestion = $request->gestion;

        $verificar = DB::table('planilla_total_ganados')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato_id]
        ])->first();
        // si existe verificar->tipo_contrato imprima tipo contrato si no vacio ''
        $verificar_tipo_contrato = isset($verificar->tipo_contrato) ? $verificar->tipo_contrato : "";
        $verificar_mes = isset($verificar->mes) ? $verificar->mes : "";
        $verificar_gestion = isset($verificar->gestion) ? $verificar->gestion : "";
        if ($verificar_tipo_contrato != $tipo_contrato_id && $verificar_mes != $mes && $verificar_gestion != $gestion) {
            $conditions = [
                ['mes', '=', $mes],
                ['gestion', '=', $gestion],
                ['tipo_contrato', '=', $tipo_contrato_id],
                ['ac.estado', '=', 'HABILITADO']
            ];
            $registros_asistencia = $this->TotalGanado->registros_asistencia($conditions);
            if ($registros_asistencia->count() > 0) {
                foreach ($registros_asistencia as $asistencia) {

                    $haber_mensual = $asistencia->salario_mensual;
                    $haber_basico = ($haber_mensual / $asistencia->dias_laborales) * $asistencia->dias_asistencia;

                    $monto_bono_antiguedad = DB::table('planilla_bono_antiguedads as ba')
                        ->where([
                            ['ba.mes', '=', $mes],
                            ['ba.gestion', '=', $gestion],
                            ['ba.tipo_contrato', '=', $tipo_contrato_id],
                            ['ba.asignacion_cargo_id', '=', $asistencia->asignacion_cargo_id]
                        ])->sum('ba.monto');

                    $total_horas_extras = DB::table('planilla_horas_extras as he')
                        ->where([
                            ['he.mes', '=', $mes],
                            ['he.gestion', '=', $gestion],
                            ['he.tipo_contrato', '=', $tipo_contrato_id],
                            ['he.asignacion_cargo_id', '=', $asistencia->asignacion_cargo_id]
                        ])->select(
                            DB::raw('SUM(he.monto) as total_monto'),
                            DB::raw('SUM(he.cantidad) as cantidad_horas')
                        )->first();
                    if (empty($total_horas_extras->total_monto)) {
                        $monto_horas_extra = 0;
                        $nro_horas_extra = 0;
                    } else {
                        $monto_horas_extra = $total_horas_extras->total_monto;
                        $nro_horas_extra = $total_horas_extras->cantidad_horas;
                    }

                    $total_suplencias = DB::table('planilla_suplencias as su')
                        ->where([
                            ['su.mes', '=', $mes],
                            ['su.gestion', '=', $gestion],
                            ['su.tipo_contrato', '=', $tipo_contrato_id],
                            ['su.asignacion_cargo_id', '=', $asistencia->asignacion_cargo_id]
                        ])->sum('su.monto');
                    if (empty($total_suplencias)) {
                        $monto_suplencia = 0;
                    } else {
                        $monto_suplencia = $total_suplencias;
                    }

                    $total_ganado = $haber_basico + $monto_bono_antiguedad + $monto_horas_extra + $monto_suplencia;

                    PlanillaTotalGanado::create([
                        'mes' => $mes,
                        'gestion' => $gestion,
                        'tipo_contrato' => $tipo_contrato_id,
                        'total_dias' => $request->total_dias,
                        'haber_mensual' => $haber_mensual,
                        'haber_basico' => $haber_basico,
                        'bono_antiguedad' => $monto_bono_antiguedad,
                        'horas_extra' => $nro_horas_extra,
                        'monto_horas_extra' => $monto_horas_extra,
                        'suplencia' => $monto_suplencia,
                        'total_ganado' => $total_ganado,
                        'asignacion_cargo_id' => $asistencia->asignacion_cargo_id,
                    ]);
                }
                return redirect()->route(
                    'total_ganado.lista',
                    [
                        'tipo_contrato' => $tipo_contrato_id,
                        'mes' => $mes,
                        'gestion' => $gestion
                    ]
                )->with('create', 'Planilla Total ganado creado exitosamente.');
            } else {
                return redirect()->route(
                    'total_ganado.lista',
                    [
                        'tipo_contrato' => $tipo_contrato_id,
                        'mes' => $mes,
                        'gestion' => $gestion
                    ]
                )
                    ->with('message', 'No existen datos para generar la planilla');
            }
        } else {
            return redirect()->route('total_ganado.lista', [
                'tipo_contrato' => $tipo_contrato_id,
                'mes' => $mes,
                'gestion' => $gestion
            ])->with('message', 'Error. Ya se tiene generada la Planilla Total Ganado para ese periodo');
        }
    }
    public function editar_total_ganado($id)
    {
        $total_ganado = PlanillaTotalGanado::find($id);

        $trabajador_cargo = AsignacionCargo::join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->join('cargos', 'cargos.id', 'nomina_cargos.cargo_id')
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->select(
                DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"),
                'cargos.nombre as nombre_cargo',
                'nomina_cargos.item as item'
            )
            ->where('asignacion_cargos.id', $total_ganado->asignacion_cargo_id)->first();

        return view('planillas.total_ganado.edit', compact('total_ganado', 'trabajador_cargo'));
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'total_dias' => 'required|numeric|max:30|min:0',
            'haber_basico' => 'required|numeric|min:0',
        ]);
        $data = PlanillaTotalGanado::select('id', 'mes', 'gestion', 'tipo_contrato')->find($id);


        $monto_total_ganado = $request->haber_basico + $data->bono_antiguedad + $data->monto_horas_extra + $data->suplencia;
        $data->total_dias = $request->total_dias;
        $data->total_ganado = $monto_total_ganado;
        $total_ganado = $data->save();
        if ($total_ganado) {
            return redirect()->route('total_ganado.lista', [
                'tipo_contrato' => $data->tipo_contrato,
                'mes' => $data->mes,
                'gestion' => $data->gestion
            ])->with('edit', 'Registro modificado exitosamente.');
        }
    }

    public function eliminar_total_ganado($id)
    {
        $total_ganado = PlanillaTotalGanado::find($id);
        $total_ganado->delete();
        return response()->json(['success' => true, 'message' => "Registro Total Ganado eliminado exitosamente."], 200);
    }

    public function eliminar_planilla($mes, $gestion, $tipo_contrato)
    {
        DB::table('planilla_total_ganados')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato],
        ])->delete();
        return response()->json(['success' => true, 'message' => "Planilla Total ganado eliminada exitosamente."], 200);
    }

    public function create_total_ganado($mes, $gestion, $tipo_contrato)
    {
        // todos los trabajadores que no tengan una registro de totoal ganado
        $trabajadores = AsignacionCargo::select(
            'asignacion_cargos.id as asignacion_cargo_id',
            DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"),
        )
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->where('asignacion_cargos.estado', 'HABILITADO')
            ->whereNotIn('asignacion_cargos.id', function ($query) use ($mes, $gestion, $tipo_contrato) {
                $query->select('planilla_total_ganados.asignacion_cargo_id')
                    ->from('planilla_total_ganados')->where([
                        ['mes', '=', $mes],
                        ['gestion', '=', $gestion],
                        ['tipo_contrato', '=', $tipo_contrato]
                    ]);
            })->get();
        // return $trabajadores;
        return view('planillas.total_ganado.create', compact('mes', 'gestion', 'tipo_contrato', 'trabajadores'));
    }
    public function generar_total_ganado(Request $request)
    {
        $request->validate([
            'mes' => 'required',
            'gestion' => 'required',
            'trabajador' => 'required',
        ]);
        $tipo_contrato_id = $request->tipo_contrato;
        $mes = $request->mes;
        $gestion = $request->gestion;
        $cargo_trabajador = $request->trabajador;

        $verificar = DB::table('planilla_total_ganados')->where([
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
        $verificar_asignacion_cargo_id = isset($verificar->asignacion_cargo_id) ? $verificar->asignacion_cargo_id : "";
        if ($verificar_tipo_contrato != $tipo_contrato_id && $verificar_mes != $mes && $verificar_gestion != $gestion && $verificar_asignacion_cargo_id != $cargo_trabajador) {
            $conditions = [
                ['mes', '=', $mes],
                ['gestion', '=', $gestion],
                ['tipo_contrato', '=', $tipo_contrato_id],
                ['ac.estado', '=', 'HABILITADO'],
                ['ac.id', '=', $cargo_trabajador]
            ];
            $registros_asistencia = $this->TotalGanado->registros_asistencia($conditions);
            if ($registros_asistencia->count() > 0) {
                foreach ($registros_asistencia as $asistencia) {

                    $haber_mensual = $asistencia->salario_mensual;
                    $haber_basico = ($haber_mensual / $asistencia->dias_laborales) * $asistencia->dias_asistencia;

                    $monto_bono_antiguedad = DB::table('planilla_bono_antiguedads as ba')
                        ->where([
                            ['ba.mes', '=', $mes],
                            ['ba.gestion', '=', $gestion],
                            ['ba.tipo_contrato', '=', $tipo_contrato_id],
                            ['ba.asignacion_cargo_id', '=', $asistencia->asignacion_cargo_id]
                        ])->sum('ba.monto');

                    $total_horas_extras = DB::table('planilla_horas_extras as he')
                        ->where([
                            ['he.mes', '=', $mes],
                            ['he.gestion', '=', $gestion],
                            ['he.tipo_contrato', '=', $tipo_contrato_id],
                            ['he.asignacion_cargo_id', '=', $asistencia->asignacion_cargo_id]
                        ])->select(
                            DB::raw('SUM(he.monto) as total_monto'),
                            DB::raw('SUM(he.cantidad) as cantidad_horas')
                        )->first();
                    if (empty($total_horas_extras->total_monto)) {
                        $monto_horas_extra = 0;
                        $nro_horas_extra = 0;
                    } else {
                        $monto_horas_extra = $total_horas_extras->total_monto;
                        $nro_horas_extra = $total_horas_extras->cantidad_horas;
                    }

                    $total_suplencias = DB::table('planilla_suplencias as su')
                        ->where([
                            ['su.mes', '=', $mes],
                            ['su.gestion', '=', $gestion],
                            ['su.tipo_contrato', '=', $tipo_contrato_id],
                            ['su.asignacion_cargo_id', '=', $asistencia->asignacion_cargo_id]
                        ])->sum('su.monto');
                    if (empty($total_suplencias)) {
                        $monto_suplencia = 0;
                    } else {
                        $monto_suplencia = $total_suplencias;
                    }

                    $total_ganado = $haber_basico + $monto_bono_antiguedad + $monto_horas_extra + $monto_suplencia;

                    PlanillaTotalGanado::create([
                        'mes' => $mes,
                        'gestion' => $gestion,
                        'tipo_contrato' => $tipo_contrato_id,
                        'total_dias' => $asistencia->dias_asistencia,
                        'haber_mensual' => $haber_mensual,
                        'haber_basico' => $haber_basico,
                        'bono_antiguedad' => $monto_bono_antiguedad,
                        'horas_extra' => $nro_horas_extra,
                        'monto_horas_extra' => $monto_horas_extra,
                        'suplencia' => $monto_suplencia,
                        'total_ganado' => $total_ganado,
                        'asignacion_cargo_id' => $asistencia->asignacion_cargo_id,
                    ]);
                }
                return redirect()->route(
                    'total_ganado.lista',
                    [
                        'tipo_contrato' => $tipo_contrato_id,
                        'mes' => $mes,
                        'gestion' => $gestion
                    ]
                )->with('create', 'Total ganado creado exitosamente.');
            } else {
                return redirect()->route(
                    'total_ganado.lista',
                    [
                        'tipo_contrato' => $tipo_contrato_id,
                        'mes' => $mes,
                        'gestion' => $gestion
                    ]
                )
                    ->with('message', 'No existen datos para generar la planilla');
            }
        } else {
            return redirect()->route('total_ganado.lista', [
                'tipo_contrato' => $tipo_contrato_id,
                'mes' => $mes,
                'gestion' => $gestion
            ])->with('message', 'Error. Ya se tiene generada el total ganado para ese periodo');
        }
    }



    public function planilla_pdf($mes, $gestion, $tipo_contrato)
    {
        $nomina_cargos = DB::table('nomina_cargos as nc')
            ->leftjoin('asignacion_cargos as ac', 'ac.nomina_cargo_id', 'nc.id')
            ->join('unidad_organizacionals as u', 'u.id', 'nc.unidad_organizacional_id')
            ->join('cargos as c', 'c.id', 'nc.cargo_id')
            ->select(
                'u.seccion',
                'c.nombre as nombre_cargo',
                'nc.item as item',
                'ac.estado as estado_asignacion'
            )
            ->orderBy('nc.item')->get();
        foreach ($nomina_cargos as $cargo) {
            if ($cargo->estado_asignacion == 'HABILITADO') {
                $total_ganados = DB::table('nomina_cargos as nc')
                    ->leftjoin('asignacion_cargos as ac', 'ac.nomina_cargo_id', 'nc.id')
                    ->join('unidad_organizacionals as u', 'u.id', 'nc.unidad_organizacional_id')
                    ->join('cargos as c', 'c.id', 'nc.cargo_id')
                    ->join('trabajadors as t', 't.id', 'ac.trabajador_id')
                    ->join('planilla_total_ganados as tg', 'tg.asignacion_cargo_id', 'ac.id')
                    ->where([
                        ['tg.mes', '=', $mes],
                        ['tg.gestion', '=', $gestion],
                        ['tg.tipo_contrato', '=', $tipo_contrato],
                        ['nc.item', '=', $cargo->item],
                        ['u.seccion', '=', $cargo->seccion],
                    ])
                    ->select(
                        'nc.item as item',
                        DB::raw("CONCAT(t.nombre,' ',t.apellido_paterno,' ',t.apellido_materno)  AS nombre_completo"),
                        'c.nombre as cargo',
                        'tg.mes as mes',
                        'tg.gestion as gestion',
                        'tg.tipo_contrato as tipo_contrato',
                        'tg.total_dias as total_dias',
                        'tg.haber_mensual as haber_mensual',
                        'tg.haber_basico as haber_basico',
                        'tg.bono_antiguedad as bono_antiguedad',
                        'tg.horas_extra as horas_extra',
                        'tg.monto_horas_extra as monto_horas_extra',
                        'tg.suplencia as suplencia',
                        'tg.total_ganado as total_ganado',
                    )
                    ->orderBy('nc.item')->first();
                // de esta manera agrego las total_ganados de un trabajador al item respectivo
                $cargo->datos = $total_ganados;
            }
        }
        // return $cargos;

        $collect = collect($nomina_cargos);
        $cargos = $collect->groupBy('seccion');
        return response(view('planillas.total_ganado.pdf', compact('mes', 'gestion', 'tipo_contrato', 'cargos')))
            ->header('Content-Type', 'application/pdf');
    }
}
