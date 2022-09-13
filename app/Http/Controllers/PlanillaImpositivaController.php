<?php

namespace App\Http\Controllers;

use App\Models\AsignacionCargo;
use App\Models\ConfImpositiva;
use App\Models\PlanillaImpositiva;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanillaImpositivaController extends Controller
{
    public function __construct()
    {
        $this->Impositiva = new PlanillaImpositiva();
    }
    public function consultar_impositiva()
    {
        return view('planillas.impositiva.consultar');
    }

    public function lista_impositiva(Request $request)
    {
        $request->validate([
            'mes' => 'required|numeric',
            'gestion' => 'required|numeric',
            'tipo_contrato' => 'required|numeric',
        ]);
        // $lista_impositiva
        $mes = $request->mes;
        $gestion = $request->gestion;
        $tipo_contrato = $request->tipo_contrato;
        $lista_impositiva = $this->Impositiva->impositiva_lista($mes, $gestion, $tipo_contrato);
        // return $lista_impositiva;
        return view('planillas.impositiva.lista', compact('mes', 'gestion', 'tipo_contrato', 'lista_impositiva'));
    }
    public function create_all_planilla($mes, $gestion, $tipo_contrato)
    {
        return view('planillas.impositiva.create_all', compact('mes', 'gestion', 'tipo_contrato'));
    }

    public function generar_planilla(Request $request)
    {
        $request->validate([
            'mes' => 'required',
            'gestion' => 'required',
            'tipo_contrato' => 'required|numeric',
            'ufv_actual' => 'required|numeric|min:0',
            'ufv_pasado' => 'required|numeric|min:0',
        ]);
        $tipo_contrato_id = $request->tipo_contrato;
        $mes = $request->mes;
        $gestion = $request->gestion;
        $ufv_actual = $request->ufv_actual;
        $ufv_pasado = $request->ufv_pasado;

        $verificar_tg = DB::table('planilla_total_ganados as ptg')
            ->join('asignacion_cargos as ac', 'ac.id', 'ptg.asignacion_cargo_id')
            ->join('planilla_aporte_laborals as pal', 'ac.id', 'pal.asignacion_cargo_id')
            ->join('planilla_refrigerios as pr', 'ac.id', 'pr.asignacion_cargo_id')
            ->where([
                ['ptg.mes', '=', $mes],
                ['ptg.gestion', '=', $gestion],
                ['ptg.tipo_contrato', '=', $tipo_contrato_id]
            ])->first();
        if ($ufv_actual != $ufv_pasado) {
            if (!empty($verificar_tg)) {
                $verificar_impo = DB::table('planilla_impositivas')->where([
                    ['mes', '=', $mes],
                    ['gestion', '=', $gestion],
                    ['tipo_contrato', '=', $tipo_contrato_id]
                ])->first();
                // si existe verificar->tipo_contrato imprima tipo contrato si no vacio ''
                $verificar_tipo_contrato = isset($verificar_impo->tipo_contrato) ? $verificar_impo->tipo_contrato : "";
                $verificar_mes = isset($verificar_impo->mes) ? $verificar_impo->mes : "";
                $verificar_gestion = isset($verificar_impo->gestion) ? $verificar_impo->gestion : "";
                if ($verificar_tipo_contrato != $tipo_contrato_id && $verificar_mes != $mes && $verificar_gestion != $gestion) {
                    $lista_asignacion_cargos = AsignacionCargo::select('id', 'nomina_cargo_id', 'estado')
                        ->with(['nomina_cargo:id,tipo_contrato_id'])
                        ->whereHas('nomina_cargo', function ($query) use ($tipo_contrato_id) {
                            $query->where('tipo_contrato_id', '=', $tipo_contrato_id);
                        })->where('estado', 'HABILITADO')->get();
                    if ($lista_asignacion_cargos->count() > 0) {
                        foreach ($lista_asignacion_cargos as $asignacion_cargo) {
                            $registro_tg = DB::table('planilla_total_ganados')->where([
                                ['asignacion_cargo_id', '=', $asignacion_cargo->id],
                                ['mes', '=', $mes],
                                ['gestion', '=', $gestion],
                                ['tipo_contrato', '=', $tipo_contrato_id]
                            ])->first();
                            $total_ganado = $registro_tg->total_ganado;
                            if ($mes == 1) {
                                $mes_anterior = 12;
                                $anio_anterior = $gestion - 1;
                            } else {
                                $mes_anterior = $mes - 1;
                                $anio_anterior = $gestion;
                            }

                            $registro_ref = DB::table('planilla_refrigerios')->where([
                                ['asignacion_cargo_id', '=', $asignacion_cargo->id],
                                ['mes', '=', $mes],
                                ['gestion', '=', $gestion],
                                ['tipo_contrato', '=', $tipo_contrato_id]
                            ])->first();

                            $registro_imp = DB::table('planilla_impositivas')->where([
                                ['asignacion_cargo_id', '=', $asignacion_cargo->id],
                                ['mes', '=', $mes_anterior],
                                ['gestion', '=', $anio_anterior],
                                ['tipo_contrato', '=', $tipo_contrato_id]
                            ])->first();

                            $aporte_laboral = DB::table('planilla_aporte_laborals')->where([
                                ['asignacion_cargo_id', '=', $asignacion_cargo->id],
                                ['mes', '=', $mes],
                                ['gestion', '=', $gestion],
                                ['tipo_contrato', '=', $tipo_contrato_id]
                            ])->sum('monto_aporte');


                            $refrigerio = $registro_ref->total_refrigerio;
                            $sueldo_neto = ($total_ganado - $aporte_laboral) + $refrigerio;
                            $conf_impositiva = ConfImpositiva::where('estado', 'HABILITADO')->first();
                            $minimo_no_imponible = $conf_impositiva->salario_minimo * $conf_impositiva->cantidad_salario_minimo;
                            // dd($minimo_no_imponible);

                            if ($sueldo_neto > $minimo_no_imponible) {
                                $base_imponible = $sueldo_neto - $minimo_no_imponible;
                            } else {
                                $base_imponible = 0;
                            }

                            $impuesto_bi = ($base_imponible * $conf_impositiva->porcentaje_impositiva) / 100;

                            $presentacion_desc = 0;

                            $impuesto_mn = ($minimo_no_imponible * $conf_impositiva->porcentaje_impositiva) / 100;

                            if ($impuesto_bi <= $impuesto_mn) {
                                $impuesto_bi = 0;
                                $impuesto_mn = 0;
                            }

                            $saldo_dependiente = $presentacion_desc + $impuesto_mn;

                            $saldo_fisco = $impuesto_bi;

                            $saldo_mes_anterior = $registro_imp->saldo_siguiente_mes;
                            $actualizacion = ($saldo_mes_anterior * $ufv_actual / $ufv_pasado) - $saldo_mes_anterior;
                            $saldo_total_mes_anterior = $saldo_mes_anterior + $actualizacion;
                            $saldo_total_dependiente = $saldo_dependiente + $saldo_total_mes_anterior;
                            $saldo_utilizado = $saldo_fisco;
                            if ($saldo_total_dependiente >= $saldo_fisco) {
                                $retencion_pagar = 0;
                            } else {
                                $retencion_pagar = $saldo_fisco - $saldo_total_dependiente;
                            }
                            if ($saldo_total_dependiente > $saldo_fisco) {
                                $saldo_siguiente_mes = $saldo_total_dependiente - $saldo_fisco;
                            } else {
                                $saldo_siguiente_mes = 0;
                            }
                            PlanillaImpositiva::create([
                                'mes' => $mes,
                                'gestion' => $gestion,
                                'tipo_contrato' => $tipo_contrato_id,
                                'ufv_actual' => $ufv_actual,
                                'ufv_pasado' => $request->ufv_pasado,
                                'total_ganado' => $total_ganado,
                                'aportes_laborales' => $aporte_laboral,
                                'sueldo_neto' => $sueldo_neto,
                                'minimo_no_imponible' => $minimo_no_imponible,
                                'base_imponible' => $base_imponible,
                                'impuesto_bi' => $impuesto_bi,
                                'presentacion_desc' => $presentacion_desc,
                                'impuesto_mn' => $impuesto_mn,
                                'saldo_dependiente' => $saldo_dependiente,
                                'saldo_fisco' => $saldo_fisco,
                                'saldo_mes_anterior' => $saldo_mes_anterior,
                                'actualizacion' => $actualizacion,
                                'saldo_total_mes_anterior' => $saldo_total_mes_anterior,
                                'saldo_total_dependiente' => $saldo_total_dependiente,
                                'saldo_utilizado' => $saldo_utilizado,
                                'retencion_pagar' => $retencion_pagar,
                                'saldo_siguiente_mes' => $saldo_siguiente_mes,
                                'asignacion_cargo_id' => $asignacion_cargo->id,
                            ]);
                        }
                        return redirect()->route('impositiva.lista', ['tipo_contrato' => $tipo_contrato_id, 'mes' => $mes, 'gestion' => $gestion]);
                    } else {
                        return redirect()->route(
                            'impositiva.lista',
                            [
                                'tipo_contrato' => $tipo_contrato_id,
                                'mes' => $mes,
                                'gestion' => $gestion
                            ]
                        )
                            ->with('message', 'No existen registros para generar la planilla');
                    }
                } else {
                    return redirect()->route('impositiva.lista', [
                        'tipo_contrato' => $tipo_contrato_id,
                        'mes' => $mes,
                        'gestion' => $gestion
                    ])->with('message', 'Error. Ya se tiene generada la planilla impositiva para ese periodo');
                }
            } else {
                return redirect()->route('impositiva.lista', [
                    'tipo_contrato' => $tipo_contrato_id,
                    'mes' => $mes,
                    'gestion' => $gestion
                ])->with('message', 'Error. tiene que generar las planillas de total ganado y aportes laborales primero');
            }
        } else {
            return redirect()->route('impositiva.lista', [
                'tipo_contrato' => $tipo_contrato_id,
                'mes' => $mes,
                'gestion' => $gestion
            ])->with('message', 'Error. UFV pasado no debe ser mayor o igual al UFV actual');
        }
    }

    public function editar_impositiva($id)
    {
        $impositiva = PlanillaImpositiva::find($id);

        $cargo = AsignacionCargo::select('id', 'trabajador_id')
            ->find($impositiva->asignacion_cargo_id);

            $trabajador_cargo = AsignacionCargo::join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->join('cargos', 'cargos.id', 'nomina_cargos.cargo_id')
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->select(
                DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"),
                'cargos.nombre as nombre_cargo',
                'nomina_cargos.item as item'
            )
            ->where('asignacion_cargos.id', $impositiva->asignacion_cargo_id)->first();

        return view('planillas.impositiva.edit', compact('impositiva', 'trabajador_cargo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'presentacion_desc' => 'required|numeric',
            'saldo_mes_anterior' => 'required|numeric',
        ]);
        $data = PlanillaImpositiva::find($id);
        $facturas_p = $request->presentacion_desc;
        $saldo_mes_anterior = $request->saldo_mes_anterior;
        $presentacion_desc = $facturas_p;
        $saldo_dependiente = $presentacion_desc + $data->impuesto_mn;
        $actualizacion = (($saldo_mes_anterior * $data->ufv_actual) / $data->ufv_pasado) - $saldo_mes_anterior;
        $saldo_total_mes_anterior = $saldo_mes_anterior + $actualizacion;
        $saldo_total_dependiente = $saldo_dependiente + $saldo_total_mes_anterior;
        $saldo_utilizado = $data->saldo_utilizado;
        if ($saldo_total_dependiente >= $data->saldo_fisco) {
            $retencion_pagar = 0;
        } else {
            $retencion_pagar = round(($data->saldo_fisco - $saldo_total_dependiente), 0);
        }
        if ($saldo_total_dependiente > $data->saldo_fisco) {
            $saldo_siguiente_mes = $saldo_total_dependiente - $data->saldo_fisco;
        } else {
            $saldo_siguiente_mes = 0;
        }

        $data->presentacion_desc = $presentacion_desc;
        $data->saldo_mes_anterior = $saldo_mes_anterior;
        $data->saldo_dependiente = $saldo_dependiente;
        $data->actualizacion = $actualizacion;
        $data->saldo_total_mes_anterior = $saldo_total_mes_anterior;
        $data->saldo_total_dependiente = $saldo_total_dependiente;
        $data->saldo_utilizado = $saldo_utilizado;
        $data->retencion_pagar = round($retencion_pagar,0);
        $data->saldo_siguiente_mes = $saldo_siguiente_mes;
        $impositiva = $data->save();
        if ($impositiva) {
            return redirect()->route('impositiva.lista', [
                'tipo_contrato' => $data->tipo_contrato,
                'mes' => $data->mes,
                'gestion' => $data->gestion
            ])->with('edit', 'Impositiva modificada exitosamente.');
        }
    }

    public function eliminar_planilla($mes, $gestion, $tipo_contrato)
    {
        DB::table('planilla_impositivas')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato],
        ])->delete();
        return response()->json(['success' => true, 'message' => "Planilla Impositiva eliminada exitosamente."], 200);
    }
    // CONTROLADOR PARA EL REPORTE DE BONO DE ANTIGUEDAD
    public function planilla_pdf($mes, $gestion, $tipo_contrato)
    {
        $nomina_cargos = DB::table('nomina_cargos as nc')
            ->join('unidad_organizacionals as u', 'u.id', 'nc.unidad_organizacional_id')
            ->join('cargos as c', 'c.id', 'nc.cargo_id')
            ->select(
                'nc.id as id_cargo',
                'u.seccion',
                'c.nombre as nombre_cargo',
                'nc.item as item',
                'nc.estado as estado_cargo'
            )
            ->orderBy('nc.item')->get();

        $asistencias = DB::table('planilla_asistencias')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato],
        ])->get();

        $ids_asistencias = $asistencias->pluck('asignacion_cargo_id')->toArray();
        // return gettype($ids_asistencias->toArray());
        foreach ($nomina_cargos as $cargo) {
            $cargo_id = $cargo->id_cargo;
            $search_cargo = DB::table('asignacion_cargos')
            ->join('planilla_asistencias', 'planilla_asistencias.asignacion_cargo_id','asignacion_cargos.id')
            ->where([
                ['mes', '=', $mes],
                ['gestion', '=', $gestion],
                ['tipo_contrato', '=', $tipo_contrato],
            ])
            ->whereIn('asignacion_cargos.nomina_cargo_id', function ($query) use ($cargo_id)  {
                $query->select('id')->from('nomina_cargos')->where('id', $cargo_id);
            })->first();

            if(!empty($search_cargo)){
                if (in_array($search_cargo->asignacion_cargo_id, $ids_asistencias)) { // && $cargo->estado_cargo == 'OCUPADO'
                    $impositivas = DB::table('nomina_cargos as nc')
                        ->leftjoin('asignacion_cargos as ac', 'ac.nomina_cargo_id', 'nc.id')
                        ->join('unidad_organizacionals as u', 'u.id', 'nc.unidad_organizacional_id')
                        ->join('cargos as c', 'c.id', 'nc.cargo_id')
                        ->join('trabajadors as t', 't.id', 'ac.trabajador_id')
                        ->join('planilla_impositivas as imp', 'imp.asignacion_cargo_id', 'ac.id')
                        ->join('planilla_refrigerios as ref', 'ref.asignacion_cargo_id', 'ac.id')
                        ->where([
                            ['imp.mes', '=', $mes],
                            ['imp.gestion', '=', $gestion],
                            ['imp.tipo_contrato', '=', $tipo_contrato],
                            ['ref.mes', '=', $mes],
                            ['ref.gestion', '=', $gestion],
                            ['ref.tipo_contrato', '=', $tipo_contrato],
                            ['nc.item', '=', $cargo->item],
                            ['u.seccion', '=', $cargo->seccion],
                        ])
                        ->select(
                            'nc.item as item',
                            DB::raw("CONCAT(t.nombre,' ',t.apellido_paterno,' ',t.apellido_materno)  AS nombre_completo"),
                            'c.nombre as cargo',
                            'imp.*',
                            'ref.*'
                        )
                        ->orderBy('nc.item')->first();

                    // de esta manera agrego las Bonos de un trabajador al item respectivo
                    $cargo->datos = $impositivas;
                } else {
                    $cargo->datos = [];
                }
            }else {
                $cargo->datos = [];
            }
        }

        // return $nomina_cargos;
        $collect = collect($nomina_cargos);
        $cargos = $collect->groupBy('seccion');
        // return $cargos;
        return response(view('planillas.impositiva.pdf', compact('mes', 'gestion', 'tipo_contrato', 'cargos')))
            ->header('Content-Type', 'application/pdf');
    }
}
