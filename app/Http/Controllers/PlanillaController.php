<?php

namespace App\Http\Controllers;

use App\Models\NombrePlanilla;
use App\Models\NominaCargo;
use App\Models\Planilla;
use Funciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanillaController extends Controller
{
    public function lista_planilla(Request $request, $id)
    {

        $nombre_planilla = NombrePlanilla::find($id);
        $lista_planillas = Planilla::where('nombre_planilla_id', $nombre_planilla->id)
            ->orderBy('item')->get();

        $estado = Planilla::select('estado')->where([
            ['estado', 'APROBADO'],
            ['nombre_planilla_id', $nombre_planilla->id]
        ])->count();

        return view('planillas.general.lista', compact('nombre_planilla', 'lista_planillas', 'estado'));
    }

    public function crear_planilla($id)
    {
        $nombre_planilla = NombrePlanilla::find($id);
        return view('planillas.general.create_all', compact('nombre_planilla'));
    }

    public function generar_planilla(Request $request)
    {
        $tipo_contrato = 1;
        $mes = $request->mes;
        $gestion = $request->gestion;
        $nombre_planilla_id = $request->nombre_planilla_id;
        $impositiva = DB::table('planilla_impositivas as i')
            ->select('id')
            ->where([
                ['mes', '=', $mes],
                ['gestion', '=', $gestion],
                ['tipo_contrato', '=', $tipo_contrato],
            ])->get();
        if (!empty($impositiva)) {
            $verificar_planilla = DB::table('planillas')
                ->where([
                    ['nombre_planilla_id', '=', $nombre_planilla_id],
                ])->first();
            $verificar_np_id = isset($verificar_planilla->nombre_planilla_id) ? $verificar_planilla->nombre_planilla_id : "";

            if ($verificar_np_id != $nombre_planilla_id) {

                $lista_trabajadores = DB::table('asignacion_cargos as ac')
                    ->join('trabajadors as t', 't.id', 'ac.trabajador_id')
                    ->join('nomina_cargos as nc', 'nc.id', 'ac.nomina_cargo_id')
                    ->join('cargos as c', 'c.id', 'nc.cargo_id')
                    ->join('escala_salarials as es', 'es.id', 'nc.escala_salarial_id')
                    ->join('unidad_organizacionals as u', 'u.id', 'nc.unidad_organizacional_id')
                    ->select(
                        'ac.id as asignacion_cargo_id',
                        'ac.fecha_ingreso as fecha_ingreso',
                        'ac.aporte_afp as aporte_afp',
                        'ac.sindicato as sindicato',
                        'ac.socio_fe as socio_fe',
                        'ac.trabajador_id as ac_trabajador_id',
                        'ac.estado as ac_estado',
                        't.ci as ci',
                        't.nro_asegurado as nua',
                        't.complemento as complemento',
                        't.nro_asegurado as nro_asegurado',
                        't.nombre as nombre',
                        DB::raw("CONCAT(t.apellido_paterno,' ',t.apellido_materno)  AS apellidos"),
                        't.estado_trabajador as estado_trabajador',
                        'nc.item as item',
                        'c.nombre as nombre_cargo',
                        'es.nivel as nivel',
                        'es.salario_mensual as salario_mensual',
                        'u.seccion as seccion',

                    )
                    ->where([
                        ['ac.estado', '=', 'HABILITADO']
                    ])
                    ->get();
                foreach ($lista_trabajadores as $trabajador) {
                    $r_total_ganado = DB::table('planilla_total_ganados')
                        ->where([
                            ['asignacion_cargo_id', '=', $trabajador->asignacion_cargo_id],
                            ['mes', '=', $mes],
                            ['gestion', '=', $gestion],
                            ['tipo_contrato', '=', $tipo_contrato],
                        ])->first();

                    $aporte_laborals = DB::table('planilla_aporte_laborals')
                        ->where([
                            ['asignacion_cargo_id', '=', $trabajador->asignacion_cargo_id],
                            ['mes', '=', $mes],
                            ['gestion', '=', $gestion],
                            ['tipo_contrato', '=', $tipo_contrato],
                        ])->get();
                    $suma_ap = 0;
                    foreach ($aporte_laborals as $ap) {
                        if ($ap->tipo_aporte == 'COTIZACION MENSUAL') {
                            $categoria_individual = $ap->monto_aporte;
                        } elseif ($ap->tipo_aporte == 'PRIMA RIESGO COMUN') {
                            $prima_riesgo_comun = $ap->monto_aporte;
                        } elseif ($ap->tipo_aporte == 'COMISION AL ENTE ADMINISTRADOR') {
                            $comision_ente = $ap->monto_aporte;
                        } else {
                            $suma_ap = $ap->monto_aporte + $suma_ap;
                        }
                    }

                    $descuentos = DB::table('planilla_descuentos')
                        ->where([
                            ['asignacion_cargo_id', '=', $trabajador->asignacion_cargo_id],
                            ['mes', '=', $mes],
                            ['gestion', '=', $gestion],
                            ['tipo_contrato', '=', $tipo_contrato],
                        ])->get();
                    // dd($descuentos);
                    foreach ($descuentos as $desc) {
                        if ($desc->nombre_descuento == 'FONDO SOCIAL') {
                            $fondo_social = $desc->monto;
                        }
                        if ($desc->nombre_descuento == 'ENTIDADES FINANCIERAS') {
                            $entidades_financieras = $desc->monto;
                        }
                        if ($desc->nombre_descuento == 'RETENCION JUDICIAL') {
                            $retencion_judicial = $desc->monto;
                        }
                    }

                    $otro_descuento = DB::table('planilla_otro_descuentos')
                        ->where([
                            ['asignacion_cargo_id', '=', $trabajador->asignacion_cargo_id],
                            ['mes', '=', $mes],
                            ['gestion', '=', $gestion],
                            ['tipo_contrato', '=', $tipo_contrato],
                        ])->first();
                    $otros_descuentos = empty($otro_descuento) ? 0 : $otro_descuento->monto_od;
                    $otros_descuentos = $retencion_judicial + $otros_descuentos;

                    $fondo_empleado = DB::table('planilla_fondo_empleados')
                        ->where([
                            ['asignacion_cargo_id', '=', $trabajador->asignacion_cargo_id],
                            ['mes', '=', $mes],
                            ['gestion', '=', $gestion],
                            ['tipo_contrato', '=', $tipo_contrato],
                        ])->first();
                    $fondo_empleados = empty($fondo_empleado) ? 0 : $fondo_empleado->total_fe;

                    $impositiva = DB::table('planilla_impositivas')
                        ->where([
                            ['asignacion_cargo_id', '=', $trabajador->asignacion_cargo_id],
                            ['mes', '=', $mes],
                            ['gestion', '=', $gestion],
                            ['tipo_contrato', '=', $tipo_contrato],
                        ])->first();

                    $total_aporte_solidario = $suma_ap;

                    $item = $trabajador->item;
                    $complemento = $trabajador->complemento == '' ? '' : '-'.$trabajador->complemento;
                    $ci = $trabajador->ci.$complemento;
                    $nombre = $trabajador->nombre;
                    $apellidos = $trabajador->apellidos;
                    $cargo = $trabajador->nombre_cargo;
                    $fecha_ingreso = $trabajador->fecha_ingreso;
                    $dias_pagados = (int)$r_total_ganado->total_dias;
                    $haber_mensual = $r_total_ganado->haber_mensual;
                    $haber_basico = $r_total_ganado->haber_basico;
                    $bono_antiguedad = $r_total_ganado->bono_antiguedad;
                    $horas_extra = $r_total_ganado->horas_extra;
                    $suplencia = $r_total_ganado->suplencia;
                    $total_ganado = $r_total_ganado->total_ganado;

                    if($trabajador->sindicato == 'SI'){
                        $sindicato = $dias_pagados != 0 ? round((($haber_mensual * 1.5)/100),2) : 0;
                    }else{
                        $sindicato = 0;
                    }
                    $desc_rciva = $impositiva->retencion_pagar;

                    $total_descuentos = $sindicato + $categoria_individual + $prima_riesgo_comun + $comision_ente + $total_aporte_solidario + $desc_rciva + $otros_descuentos + $fondo_social + $fondo_empleados + $entidades_financieras;
			        $liquido_pagable = $total_ganado - $total_descuentos;
                    $liquido_pagable = $total_ganado - $total_descuentos;
                    $estado_planilla = 'GENERADO';
                    $fecha_generado = date('Y-m-d');
                    $nua = $trabajador->nua;

                    Planilla::create([
                        'mes' => $mes,
                        'gestion' => $gestion,
                        'tipo_contrato' => $tipo_contrato,
                        'item' => $item,
                        'ci' => $ci,
                        'nua' => $nua,
                        'nombres' => $nombre,
                        'apellidos' => $apellidos,
                        'cargo' => $cargo,
                        'fecha_ingreso' => $fecha_ingreso,
                        'dias_pagados' => $dias_pagados,
                        'haber_mensual' => $haber_mensual,
                        'haber_basico' => $haber_basico,
                        'bono_antiguedad' => $bono_antiguedad,
                        'horas_extra' => $horas_extra,
                        'suplencia' => $suplencia,
                        'total_ganado' => $total_ganado,
                        'sindicato' => $sindicato,
                        'categoria_individual' => $categoria_individual,
                        'prima_riesgo_comun' => $prima_riesgo_comun,
                        'comision_ente' => $comision_ente,
                        'total_aporte_solidario' => $total_aporte_solidario,
                        'desc_rciva' => $desc_rciva,
                        'otros_descuentos' => $otros_descuentos,
                        'fondo_social' => $fondo_social,
                        'fondo_empleados' => $fondo_empleados,
                        'entidades_financieras' => $entidades_financieras,
                        'total_descuentos' => $total_descuentos,
                        'liquido_pagable' => $liquido_pagable,
                        'estado' => $estado_planilla,
                        'fecha_aprobado' => $fecha_generado,
                        'nombre_planilla_id' => $nombre_planilla_id,
                    ]);
                }
                // return $lista_trabajadores;
                return redirect()->route('planilla.lista', [
                    'id' => $nombre_planilla_id,
                ])->with('create', 'Planilla de pagos creado exitosamente.');
            } else {
                return redirect()->route('planilla.lista', [
                    'id' => $nombre_planilla_id,
                ])->with('message', 'Error. Ya se tiene generada esa planilla de ese periodo');
            }
        } else {
            return redirect()->route('planilla.lista', [
                'id' => $nombre_planilla_id,
            ])->with('message', 'Error. tiene que generar todas las planillas previas del mes primero');
        }
    }

    public function eliminar_planilla($id)
    {
        $eliminar_planilla = DB::table('planillas')->where([
            ['nombre_planilla_id', '=',$id],
            ['estado', '!=','APROBADO'],
        ])->delete();
        if($eliminar_planilla){
            return response()->json(['success' => true, 'message' => "Planilla eliminada exitosamente."], 200);
        }
        else{
            return response()->json(['success' => false, 'message' => "Error. la planilla esta aprobada. Para eliminar debe desaprobarla"], 200);
        }
    }

    public function cambiar_estado($id,$estado)
    {
        $planilla_estado = Planilla::where([
            ['nombre_planilla_id', '=',$id],
        ])->update([
            'estado' => $estado
        ]);
        if($planilla_estado){
            return response()->json(['success' => true, 'message' => "Planilla ".$estado." exitosamente."], 200);
        }
        else{
            return response()->json(['success' => false, 'message' => "Error."], 200);
        }
    }

    public function lista_resumen(Request $request, $id)
    {
        $nombre_planilla = NombrePlanilla::find($id);
        $planilla = new Planilla();
        $resumen_total_planilla = $planilla->resumen_total_planilla($nombre_planilla);
        $total_secciones = $resumen_total_planilla['total_secciones'];
        $total_general = $resumen_total_planilla['total_general'];
        // return $total_general;
        return view('planillas.general.resumen', compact('nombre_planilla', 'total_secciones', 'total_general'));
    }

    public function resumen_pdf(Request $request, $id)
    {
        $nombre_planilla = NombrePlanilla::find($id);
        $planilla = new Planilla();
        $resumen_total_planilla = $planilla->resumen_total_planilla($nombre_planilla);
        $total_secciones = $resumen_total_planilla['total_secciones'];
        $total_general = $resumen_total_planilla['total_general'];
        // return $total_general;
        return response(view('planillas.general.pdf_resumen', compact('nombre_planilla', 'total_secciones', 'total_general')))
            ->header('Content-Type', 'application/pdf');
    }

    public function planilla_pdf(Request $request, $id)
    {
        $nombre_planilla = NombrePlanilla::find($id);
        $id_nombre_planilla = $nombre_planilla->id;
        $mes = $nombre_planilla->mes;
        $gestion = $nombre_planilla->gestion;
        $tipo_contrato = $nombre_planilla->tipo_contrato;

        $nomina_cargos = DB::table('nomina_cargos as nc')
            ->join('unidad_organizacionals as u', 'u.id', 'nc.unidad_organizacional_id')
            ->join('cargos as c', 'c.id', 'nc.cargo_id')
            ->select(
                'u.seccion',
                'nc.id as id_cargo',
                'c.nombre as nombre_cargo',
                'nc.item as item',
                'nc.estado as estado_cargo'
            )
            ->orderBy('nc.item')->get();
        // return $nomina_cargos->count();
        $consulta_asistencia = DB::table('planilla_asistencias')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato],
        ])->get();

        $ids_asistencias = $consulta_asistencia->pluck('asignacion_cargo_id')->toArray();

        // return gettype($ids_asistencias->toArray());
        foreach ($nomina_cargos as $cargo) {
            $cargo_id = $cargo->id_cargo;
            $search_cargo = DB::table('asignacion_cargos')
                ->join('planilla_asistencias', 'planilla_asistencias.asignacion_cargo_id', 'asignacion_cargos.id')
                ->where([
                    ['mes', '=', $mes],
                    ['gestion', '=', $gestion],
                    ['tipo_contrato', '=', $tipo_contrato],
                ])
                ->whereIn('asignacion_cargos.nomina_cargo_id', function ($query) use ($cargo_id) {
                    $query->select('id')->from('nomina_cargos')->where('id', $cargo_id);
                })->first();

            if (!empty($search_cargo)) {
                if (in_array($search_cargo->asignacion_cargo_id, $ids_asistencias)) { // && $cargo->estado_cargo == 'OCUPADO'
                    $planilla_pagos = DB::table('planillas')
                        ->where([
                            ['nombre_planilla_id', '=', $id_nombre_planilla],
                            ['item', '=', $cargo->item],
                        ])->first();
                    $cargo->datos = $planilla_pagos;
                    $horas_extra = DB::table('planilla_horas_extras as he')
                        ->join('asignacion_cargos as ac', 'ac.id', 'he.asignacion_cargo_id')
                        ->join('nomina_cargos as nc', 'nc.id', 'ac.nomina_cargo_id')
                        ->select('cantidad', 'monto')
                        ->where([
                            ['nc.item', '=', $planilla_pagos->item],
                            ['mes', '=', $mes],
                            ['gestion', '=', $gestion],
                            ['tipo_contrato', '=', $tipo_contrato],
                        ])->first();
                    $cargo->horas_extra = $horas_extra;
                } else {
                    $cargo->datos = [];
                }
            } else {
                $cargo->datos = [];
            }
        }
        // return $nomina_cargos;
        $collect = collect($nomina_cargos);
        $cargos = $collect->groupBy('seccion');
        // return $cargos;
        return response(view('planillas.general.pdf_planilla_pago', compact('nombre_planilla', 'cargos')))
            ->header('Content-Type', 'application/pdf');
    }

    public function papeletas_pdf($id)
    {
        $nombre_planilla = NombrePlanilla::find($id);
        $id_nombre_planilla = $nombre_planilla->id;
        $mes = $nombre_planilla->mes;
        $gestion = $nombre_planilla->gestion;
        $tipo_contrato = $nombre_planilla->tipo_contrato;

        $registros = DB::table('planillas as p')
            ->join('nomina_cargos as nc', 'nc.item', 'p.item')
            ->join('unidad_organizacionals as u', 'u.id', 'nc.unidad_organizacional_id')
            ->join('cargos as c', 'c.id', 'nc.cargo_id')
            ->join('asignacion_cargos as ac', 'ac.nomina_cargo_id', 'nc.id')
            ->join('planilla_bono_antiguedads as ba', 'ba.asignacion_cargo_id', 'ac.id')
            ->select(
                'p.*',
                'nc.estado as estado_nomina',
                'ac.id as id_asignacion_cargo',
                'u.seccion as seccion',
                'ba.porcentaje as porcentaje'
            )
            ->where([
                ['p.estado', 'APROBADO'],
                ['p.nombre_planilla_id', $nombre_planilla->id],
                ['ba.mes', '=', $mes],
                ['ba.gestion', '=', $gestion],
                ['ba.tipo_contrato', '=', $tipo_contrato],
            ])->get();

        foreach ($registros as $registro) {

            $horas_extra = DB::table('planilla_horas_extras as he')
                ->join('asignacion_cargos as ac', 'ac.id', 'he.asignacion_cargo_id')
                ->join('nomina_cargos as nc', 'nc.id', 'ac.nomina_cargo_id')
                ->where([
                    ['he.asignacion_cargo_id', '=', $registro->id_asignacion_cargo],
                    ['mes', '=', $mes],
                    ['gestion', '=', $gestion],
                    ['tipo_contrato', '=', $tipo_contrato],
                ])->get();
            $impositiva = DB::table('planilla_impositivas as i')
                ->join('asignacion_cargos as ac', 'ac.id', 'i.asignacion_cargo_id')
                ->join('nomina_cargos as nc', 'nc.id', 'ac.nomina_cargo_id')
                ->select('saldo_siguiente_mes')
                ->where([
                    ['i.asignacion_cargo_id', '=', $registro->id_asignacion_cargo],
                    ['mes', '=', $mes],
                    ['gestion', '=', $gestion],
                    ['tipo_contrato', '=', $tipo_contrato],
                ])->first();
            $ht_nocturna1  = 0;
            $ht_nocturna2 = 0;
            $ht_nocturna = 0;
            foreach ($horas_extra as $he) {
                if ($he->tipo_hora_extra == 'DE 14 A 22') {
                    $ht_nocturna1 = $he->monto;
                } elseif ($he->tipo_hora_extra == 'DE 22 A 06') {
                    $ht_nocturna2 = $he->monto;
                } elseif ($he->tipo_hora_extra == 'HORAS EXTRA NOCTURNO') {
                    $he_nocturno = $he->monto;
                } elseif ($he->tipo_hora_extra == 'HORAS EXTRA') {
                    $he = $he->monto;
                } elseif ($he->tipo_hora_extra == 'DOMINGOS') {
                    $he_domingos = $he->monto;
                }
            }

            $ht_nocturna = $ht_nocturna1 + $ht_nocturna2;
            if (empty($ht_nocturna)) {
                $ht_nocturna = 0;
            }
            if (empty($he_nocturno)) {
                $he_nocturno = 0;
            }
            if (empty($he)) {
                $he = 0;
            }
            if (empty($he_domingos)) {
                $he_domingos = 0;
            }

            $registro->ht_nocturna = $ht_nocturna;
            $registro->he_nocturno = $he_nocturno;
            $registro->he = $he;
            $registro->he_domingos = $he_domingos;
            $registro->p_saldo_siguiente_mes = $impositiva->saldo_siguiente_mes;
        }
        // return $registros;

        return response(view('planillas.general.pdf_papeleta_pago', compact('nombre_planilla', 'registros')))
            ->header('Content-Type', 'application/pdf');
    }
}
