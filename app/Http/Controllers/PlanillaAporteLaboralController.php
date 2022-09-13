<?php

namespace App\Http\Controllers;

use App\Models\AsignacionCargo;
use App\Models\ConfAporte;
use App\Models\PlanillaAporteLaboral;
use Funciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanillaAporteLaboralController extends Controller
{
    public function consultar_aporte_laboral()
    {
        // $tipo_contratos = Tipo_Contrato::where('estado', 'ACTIVO')->get();
        return view('planillas.aporte_laboral.consultar');
    }

    public function lista_aporte_laboral(Request $request)
    {
        $request->validate([
            'mes' => 'required|numeric',
            'gestion' => 'required|numeric',
            'tipo_contrato' => 'required|numeric',
        ]);
        // $lista_aporte_laboral
        $mes = $request->mes;
        $gestion = $request->gestion;
        $tipo_contrato = $request->tipo_contrato;
        $lista_aporte_laboral = AsignacionCargo::select(
            'asignacion_cargos.id',
            'trabajador_id',
            'nomina_cargo_id',
            'nomina_cargos.item as item',
            'asignacion_cargos.estado as estado_asignacion'
        )
            ->join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->with(['trabajador' => function ($query) {
                $query->select('id', DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"));
            }])
            ->with([
                'nomina_cargo' => function ($query) {
                    $query->select('id', 'item', 'cargo_id', 'escala_salarial_id')->orderBy('item', 'ASC');
                },
                'nomina_cargo.cargo' => function ($query) {
                    $query->select('id', 'nombre');
                }
            ])
            ->with(['planilla_aporte_laborals' => function ($query)  use ($tipo_contrato, $mes, $gestion) {
                $query->select('id', 'mes', 'gestion', 'tipo_contrato', 'tipo_aporte', 'porcentaje_aporte', 'monto_aporte', 'asignacion_cargo_id')
                    ->where([
                        ['mes', '=', $mes],
                        ['gestion', '=', $gestion],
                        ['tipo_contrato', '=', $tipo_contrato]
                    ])->orderBy('tipo_aporte','asc');
            }])
            ->with(['planilla_total_ganados' => function ($query)  use ($tipo_contrato, $mes, $gestion) {
                $query->select('id', 'mes', 'gestion', 'tipo_contrato', 'total_ganado', 'asignacion_cargo_id')
                    ->where([
                        ['mes', '=', $mes],
                        ['gestion', '=', $gestion],
                        ['tipo_contrato', '=', $tipo_contrato]
                    ]);
            }])
            ->where('nomina_cargos.tipo_contrato_id', $tipo_contrato)
            ->whereHas('planilla_aporte_laborals', function ($query) use ($tipo_contrato, $mes, $gestion) {
                $query->where([
                    ['mes', '=', $mes],
                    ['gestion', '=', $gestion],
                    ['tipo_contrato', '=', $tipo_contrato]
                ]);
            })
            ->orderBy('nomina_cargos.item', 'ASC')
            ->get();
        // return $lista_aporte_laboral;
        return view('planillas.aporte_laboral.lista', compact('mes', 'gestion', 'tipo_contrato', 'lista_aporte_laboral'));
    }

    // formulario para la generacion de la planilla
    public function create_all_planilla($mes, $gestion, $tipo_contrato)
    {
        return view('planillas.aporte_laboral.create_all', compact('mes', 'gestion', 'tipo_contrato'));
    }

    public function generar_planilla(Request $request)
    {
        // return $request;
        $request->validate([
            'mes' => 'required',
            'gestion' => 'required',
            'fecha_calculo' => 'required',
        ]);
        $tipo_contrato_id = $request->tipo_contrato;
        $mes = $request->mes;
        $gestion = $request->gestion;
        $fecha_calculo = $request->fecha_calculo;

        $verificar_total_ganado =  DB::table('planilla_total_ganados')
            ->join('asignacion_cargos as ac', 'ac.id', 'planilla_total_ganados.asignacion_cargo_id')
            ->where([
                ['mes', '=', $mes],
                ['gestion', '=', $gestion],
                ['tipo_contrato', '=', $tipo_contrato_id]
            ])->first();
        if (!empty($verificar_total_ganado)) {
            $verificar_aporte =  DB::table('planilla_aporte_laborals')->where([
                ['mes', '=', $mes],
                ['gestion', '=', $gestion],
                ['tipo_contrato', '=', $tipo_contrato_id]
            ])->first();
            // si existe verificar->tipo_contrato imprima tipo contrato si no vacio ''
            $verificar_tipo_contrato = isset($verificar_aporte->tipo_contrato) ? $verificar_aporte->tipo_contrato : "";
            $verificar_mes = isset($verificar_aporte->mes) ? $verificar_aporte->mes : "";
            $verificar_gestion = isset($verificar_aporte->gestion) ? $verificar_aporte->gestion : "";
            if ($verificar_tipo_contrato != $tipo_contrato_id && $verificar_mes != $mes && $verificar_gestion != $gestion) {
                $lista_trabajadores = DB::table('asignacion_cargos as ac')
                    ->join('trabajadors as t', 't.id', 'ac.trabajador_id')
                    ->select(
                        'ac.id as id_asignacion_cargo',
                        'ac.estado as estado_asignacion',
                        'ac.aporte_afp as aporte_afp',
                        't.fecha_nacimiento as fecha_nacimiento',
                    )
                    ->where([
                        ['ac.estado', '=', 'HABILITADO']
                    ])
                    ->get();

                foreach ($lista_trabajadores as $registro_ac) {
                    $registro_total_ganado =  DB::table('planilla_total_ganados')->where([
                        ['mes', '=', $mes],
                        ['gestion', '=', $gestion],
                        ['tipo_contrato', '=', $tipo_contrato_id],
                        ['asignacion_cargo_id', '=', $registro_ac->id_asignacion_cargo]
                    ])->first();
                    $total_ganado = $registro_total_ganado->total_ganado;
                    $conf_aportes = ConfAporte::where('estado', 'HABILITADO')->get();
                    foreach ($conf_aportes as $c_aporte) {
                        if ($total_ganado > 0) {
                            if ($c_aporte->rango_inicial >= 13000) {
                                if ($total_ganado >= $c_aporte->rango_inicial && $total_ganado <= $c_aporte->rango_final) {
                                    if ($c_aporte->tipo_aporte == 'COTIZACION MENSUAL' && $registro_ac->aporte_afp == 'NO') {
                                        $monto_aporte = 0;
                                        DB::table('planilla_aporte_laborals')->insert([
                                            'mes' => $mes,
                                            'gestion' => $gestion,
                                            'tipo_contrato' => $tipo_contrato_id,
                                            'tipo_aporte' => $c_aporte->tipo_aporte,
                                            'porcentaje_aporte' => $c_aporte->porcentaje_aporte,
                                            'monto_aporte' => $monto_aporte,
                                            'asignacion_cargo_id' => $registro_ac->id_asignacion_cargo,
                                        ]);
                                    } else {
                                        $monto_aporte = (($total_ganado - $c_aporte->rango_inicial) * $c_aporte->porcentaje_aporte) / 100;
                                        DB::table('planilla_aporte_laborals')->insert([
                                            'mes' => $mes,
                                            'gestion' => $gestion,
                                            'tipo_contrato' => $tipo_contrato_id,
                                            'tipo_aporte' => $c_aporte->tipo_aporte,
                                            'porcentaje_aporte' => $c_aporte->porcentaje_aporte,
                                            'monto_aporte' => $monto_aporte,
                                            'asignacion_cargo_id' => $registro_ac->id_asignacion_cargo,
                                        ]);
                                    }
                                } else {
                                    $monto_aporte = 0;
                                    DB::table('planilla_aporte_laborals')->insert([
                                        'mes' => $mes,
                                        'gestion' => $gestion,
                                        'tipo_contrato' => $tipo_contrato_id,
                                        'tipo_aporte' => $c_aporte->tipo_aporte,
                                        'porcentaje_aporte' => $c_aporte->porcentaje_aporte,
                                        'monto_aporte' => $monto_aporte,
                                        'asignacion_cargo_id' => $registro_ac->id_asignacion_cargo,
                                    ]);
                                }
                            } else {
                                if ($total_ganado >= $c_aporte->rango_inicial && $total_ganado <= $c_aporte->rango_final) {
                                    $anios = Funciones::calcular_edad($fecha_calculo, $registro_ac->fecha_nacimiento);
                                    if ($anios >= 65 && $c_aporte->tipo_aporte == 'PRIMA RIESGO COMUN') {
                                        $monto_aporte = 0;
                                        DB::table('planilla_aporte_laborals')->insert([
                                            'mes' => $mes,
                                            'gestion' => $gestion,
                                            'tipo_contrato' => $tipo_contrato_id,
                                            'tipo_aporte' => $c_aporte->tipo_aporte,
                                            'porcentaje_aporte' => $c_aporte->porcentaje_aporte,
                                            'monto_aporte' => $monto_aporte,
                                            'asignacion_cargo_id' => $registro_ac->id_asignacion_cargo,
                                        ]);
                                    } else {
                                        if ($c_aporte->tipo_aporte == 'COTIZACION MENSUAL' && $registro_ac->aporte_afp == 'NO') {
                                            $monto_aporte = 0;
                                            DB::table('planilla_aporte_laborals')->insert([
                                                'mes' => $mes,
                                                'gestion' => $gestion,
                                                'tipo_contrato' => $tipo_contrato_id,
                                                'tipo_aporte' => $c_aporte->tipo_aporte,
                                                'porcentaje_aporte' => $c_aporte->porcentaje_aporte,
                                                'monto_aporte' => $monto_aporte,
                                                'asignacion_cargo_id' => $registro_ac->id_asignacion_cargo,
                                            ]);
                                        } else {
                                            $monto_aporte = ($total_ganado * $c_aporte->porcentaje_aporte) / 100;
                                            DB::table('planilla_aporte_laborals')->insert([
                                                'mes' => $mes,
                                                'gestion' => $gestion,
                                                'tipo_contrato' => $tipo_contrato_id,
                                                'tipo_aporte' => $c_aporte->tipo_aporte,
                                                'porcentaje_aporte' => $c_aporte->porcentaje_aporte,
                                                'monto_aporte' => $monto_aporte,
                                                'asignacion_cargo_id' => $registro_ac->id_asignacion_cargo,
                                            ]);
                                        }
                                    }
                                }
                            }
                        } else {
                            $monto_aporte = 0;
                            DB::table('planilla_aporte_laborals')->insert([
                                'mes' => $mes,
                                'gestion' => $gestion,
                                'tipo_contrato' => $tipo_contrato_id,
                                'tipo_aporte' => $c_aporte->tipo_aporte,
                                'porcentaje_aporte' => $c_aporte->porcentaje_aporte,
                                'monto_aporte' => $monto_aporte,
                                'asignacion_cargo_id' => $registro_ac->id_asignacion_cargo,
                            ]);
                        }
                    }
                }

                return redirect()->route(
                    'aporte_laboral.lista',
                    [
                        'tipo_contrato' => $tipo_contrato_id,
                        'mes' => $mes,
                        'gestion' => $gestion
                    ]
                )->with('create', 'Planilla Aporte Laboral creado exitosamente.');
            } else {
                return redirect()->route('aporte_laboral.lista', [
                    'tipo_contrato' => $tipo_contrato_id,
                    'mes' => $mes,
                    'gestion' => $gestion
                ])->with('message', 'Error. Ya se tiene generada la planilla de Aportes laborales para ese periodo');
            }
        } else {
            return redirect()->route(
                'aporte_laboral.lista',
                [
                    'tipo_contrato' => $tipo_contrato_id,
                    'mes' => $mes,
                    'gestion' => $gestion
                ]
            )
                ->with('message', 'Error. tiene que generar las planillas de total ganado, antes de generar planilla de aporte laboral');
        }
    }

    public function editar_aporte_laboral($id)
    {
        $aporte_laboral = PlanillaAporteLaboral::find($id);

        $trabajador_cargo = AsignacionCargo::join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->join('cargos', 'cargos.id', 'nomina_cargos.cargo_id')
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->select(
                DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"),
                'cargos.nombre as nombre_cargo',
                'nomina_cargos.item as item'
            )
            ->where('asignacion_cargos.id', $aporte_laboral->asignacion_cargo_id)->first();

        return view('planillas.aporte_laboral.edit', compact('aporte_laboral', 'trabajador_cargo'));
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'monto_aporte' => 'required|numeric|min:0',
        ]);
        $data = PlanillaAporteLaboral::select('id', 'mes', 'gestion', 'tipo_contrato')->find($id);

        $monto_aporte_laboral = $request->monto_aporte;
        $data->monto_aporte = $monto_aporte_laboral;
        $aporte_laboral = $data->save();
        if ($aporte_laboral) {
            return redirect()->route('aporte_laboral.lista', [
                'tipo_contrato' => $data->tipo_contrato,
                'mes' => $data->mes,
                'gestion' => $data->gestion
            ])->with('edit', 'Registro modificado exitosamente.');
        }
    }

    public function eliminar_planilla($mes, $gestion, $tipo_contrato)
    {
        DB::table('planilla_aporte_laborals')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato],
        ])->delete();
        return response()->json(['success' => true, 'message' => "Planilla Aportes laborales eliminada exitosamente."], 200);
    }

    public function planilla_pdf($mes, $gestion, $tipo_contrato)
    {
        $registros_aporte_laboral = AsignacionCargo::select(
            'asignacion_cargos.id',
            'trabajador_id',
            'nomina_cargo_id',
            'nomina_cargos.item as item',
            'asignacion_cargos.estado as estado_asignacion'
        )
            ->join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->with(['trabajador' => function ($query) {
                $query->select('id', DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"));
            }])
            ->with([
                'nomina_cargo' => function ($query) {
                    $query->select('id', 'item', 'cargo_id', 'escala_salarial_id')->orderBy('item', 'ASC');
                },
                'nomina_cargo.cargo' => function ($query) {
                    $query->select('id', 'nombre');
                }
            ])
            ->with(['planilla_aporte_laborals' => function ($query)  use ($tipo_contrato, $mes, $gestion) {
                $query->select('id', 'mes', 'gestion', 'tipo_contrato', 'tipo_aporte', 'porcentaje_aporte', 'monto_aporte', 'asignacion_cargo_id')
                    ->where([
                        ['mes', '=', $mes],
                        ['gestion', '=', $gestion],
                        ['tipo_contrato', '=', $tipo_contrato]
                    ])->orderBy('tipo_aporte','asc');
            }])
            ->with(['planilla_total_ganados' => function ($query)  use ($tipo_contrato, $mes, $gestion) {
                $query->select('id', 'mes', 'gestion', 'tipo_contrato', 'total_ganado', 'asignacion_cargo_id')
                    ->where([
                        ['mes', '=', $mes],
                        ['gestion', '=', $gestion],
                        ['tipo_contrato', '=', $tipo_contrato]
                    ]);
            }])
            ->where('nomina_cargos.tipo_contrato_id', $tipo_contrato)
            ->whereHas('planilla_aporte_laborals', function ($query) use ($tipo_contrato, $mes, $gestion) {
                $query->where([
                    ['mes', '=', $mes],
                    ['gestion', '=', $gestion],
                    ['tipo_contrato', '=', $tipo_contrato]
                ]);
            })
            ->orderBy('nomina_cargos.item', 'ASC')
            ->get();

        $conf_aportes = ConfAporte::where([
            ['estado', '=', 'HABILITADO'],
            ['rango_inicial', '<=', 13000]
        ])->get();
        return response(view('planillas.aporte_laboral.pdf',
                        compact('mes',
                        'gestion',
                        'tipo_contrato',
                        'registros_aporte_laboral',
                        'conf_aportes'
                        )))
            ->header('Content-Type', 'application/pdf');
    }
}
