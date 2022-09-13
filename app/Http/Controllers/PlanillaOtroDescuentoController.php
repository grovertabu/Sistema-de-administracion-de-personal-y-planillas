<?php

namespace App\Http\Controllers;

use App\Models\AsignacionCargo;
use App\Models\PlanillaOtroDescuento;
use App\Models\ConfOtroDescuento;
use App\Models\Tipo_Contrato;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Funciones;

class PlanillaOtroDescuentoController extends Controller
{
    public function __construct()
    {
        $this->OtroDescuento = new PlanillaOtroDescuento();
    }
    public function consultar_otro_descuento()
    {
        $tipo_contratos = Tipo_Contrato::where('estado', 'ACTIVO')->get();;
        return view('planillas.otro_descuento.consultar', compact('tipo_contratos'));
    }

    // metodo para la lista de los bonos de antiguedad
    public function lista_otro_descuento(Request $request)
    {
        $request->validate([
            'mes' => 'required|numeric',
            'gestion' => 'required|numeric',
            'tipo_contrato' => 'required|numeric',
        ]);
        // $lista_otro_descuento
        $mes = $request->mes;
        $gestion = $request->gestion;
        $tipo_contrato = $request->tipo_contrato;
        $lista_otro_descuento = $this->OtroDescuento->otro_descuento_lista($mes, $gestion, $tipo_contrato);
        // return $lista_otro_descuento;
        return view('planillas.otro_descuento.lista', compact('mes', 'gestion', 'tipo_contrato', 'lista_otro_descuento'));
    }

    // formulario para la generacion de la planilla
    public function create_all_planilla($mes, $gestion, $tipo_contrato)
    {
        $conf_otro_descuentos = ConfOtroDescuento::where('estado', 'HABILITADO')->get();
        return view('planillas.otro_descuento.create_all', compact('mes', 'gestion', 'tipo_contrato', 'conf_otro_descuentos'));
    }

    public function generar_planilla(Request $request)
    {
        $request->validate([
            'mes' => 'required',
            'gestion' => 'required',
            'tipo_contrato' => 'required|numeric',
            'conf_otro_descuento_id' => 'required',
            'a_quienes' => 'required',
            'de_donde' => 'required',
        ]);

        $tipo_contrato_id = $request->tipo_contrato;
        $mes = $request->mes;
        $gestion = $request->gestion;
        $a_quienes = $request->a_quienes;
        $de_donde = $request->de_donde;
        $conf_otro_descuento = ConfOtroDescuento::where('id', $request->conf_otro_descuento_id)->first();
        $factor_calculo = $conf_otro_descuento->factor_calculado;
        $verificar = DB::table('planilla_otro_descuentos')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato_id],
            ['descripcion', '=', $conf_otro_descuento->descripcion]
        ])->first();
        $verificar_total_ganado = DB::table('planilla_total_ganados')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato_id]
        ])->get();
        if (empty($verificar)) {
            if (!empty($verificar_total_ganado)) {
                if ($a_quienes == 1) {
                    //
                    $lista_contratos = AsignacionCargo::join('planilla_total_ganados', 'asignacion_cargos.id', 'planilla_total_ganados.asignacion_cargo_id')
                        ->where([
                            ['planilla_total_ganados.mes', '=', $mes],
                            ['planilla_total_ganados.gestion', '=', $gestion],
                            ['planilla_total_ganados.tipo_contrato', '=', $tipo_contrato_id],
                            ['asignacion_cargos.sindicato', '=', 'SI']
                        ])->get();
                } else {
                    if ($a_quienes == 0) {
                        //
                        $lista_contratos = AsignacionCargo::select(
                            'asignacion_cargos.id as asignacion_cargo_id',
                            'asignacion_cargos.sindicato',
                            'asignacion_cargos.estado as estado_asignacion',
                            'planilla_total_ganados.mes',
                            'planilla_total_ganados.gestion',
                            'planilla_total_ganados.tipo_contrato',
                            'planilla_total_ganados.total_ganado',
                            'planilla_total_ganados.haber_basico',
                        )
                            ->join('planilla_total_ganados', 'asignacion_cargos.id', 'planilla_total_ganados.asignacion_cargo_id')
                            ->where([
                                ['planilla_total_ganados.mes', '=', $mes],
                                ['planilla_total_ganados.gestion', '=', $gestion],
                                ['planilla_total_ganados.tipo_contrato', '=', $tipo_contrato_id],
                            ])->get();
                    } else {
                        if ($a_quienes == 2) {
                            $lista_contratos = AsignacionCargo::select(
                                'asignacion_cargos.id as asignacion_cargo_id',
                                'asignacion_cargos.sindicato',
                                'asignacion_cargos.estado as estado_asignacion',
                                'planilla_total_ganados.mes',
                                'planilla_total_ganados.gestion',
                                'planilla_total_ganados.tipo_contrato',
                                'planilla_total_ganados.total_ganado',
                                'planilla_total_ganados.haber_basico',
                            )
                                ->join('planilla_total_ganados', 'asignacion_cargos.id', 'planilla_total_ganados.asignacion_cargo_id')
                                ->where([
                                    ['planilla_total_ganados.mes', '=', $mes],
                                    ['planilla_total_ganados.gestion', '=', $gestion],
                                    ['planilla_total_ganados.tipo_contrato', '=', $tipo_contrato_id],
                                    ['asignacion_cargos.sindicato', '=', 'NO']
                                ])->get();
                        }
                    }
                }
                if ($lista_contratos->count() > 0) {
                    foreach ($lista_contratos as $contrato) {
                        $monto_od = 0;
                        if ($de_donde == 1) {
                            eval("\$monto_od = \$contrato->total_ganado$factor_calculo;");
                            PlanillaOtroDescuento::create([
                                'mes' => $mes,
                                'gestion' => $gestion,
                                'tipo_contrato' => $tipo_contrato_id,
                                'descripcion' => $conf_otro_descuento->descripcion,
                                'factor_calculo' => $conf_otro_descuento->factor_calculado,
                                'monto_od' => round($monto_od, 2),
                                'asignacion_cargo_id' => $contrato->asignacion_cargo_id,
                            ]);
                        } else {
                            eval("\$monto_od = \$contrato->haber_basico$factor_calculo;");
                            PlanillaOtroDescuento::create([
                                'mes' => $mes,
                                'gestion' => $gestion,
                                'tipo_contrato' => $tipo_contrato_id,
                                'descripcion' => $conf_otro_descuento->descripcion,
                                'factor_calculo' => $conf_otro_descuento->factor_calculado,
                                'monto_od' => round($monto_od, 2),
                                'asignacion_cargo_id' => $contrato->asignacion_cargo_id,
                            ]);
                        }
                    }
                    return redirect()->route(
                        'otro_descuento.lista',
                        [
                            'tipo_contrato' => $tipo_contrato_id,
                            'mes' => $mes,
                            'gestion' => $gestion
                        ]
                    )->with('create', 'Planilla Otros descuentos creado exitosamente');
                } else {
                    return redirect()->route(
                        'otro_descuento.lista',
                        [
                            'tipo_contrato' => $tipo_contrato_id,
                            'mes' => $mes,
                            'gestion' => $gestion
                        ]
                    )
                        ->with('message', 'No existen registros para generar la planilla');
                }
            } else {
                return redirect()->route(
                    'otro_descuento.lista',
                    [
                        'tipo_contrato' => $tipo_contrato_id,
                        'mes' => $mes,
                        'gestion' => $gestion
                    ]
                )
                    ->with('message', ' No se puede generar otros descuentos falta planilla Total Ganado');
            }
        } else {
            return redirect()->route('otro_descuento.lista', [
                'tipo_contrato' => $tipo_contrato_id,
                'mes' => $mes,
                'gestion' => $gestion
            ])->with('message', 'Error. Ya se tiene generada esa planilla para ese periodo');
        }
    }

    public function editar_otro_descuento($id)
    {
        $otro_descuento = PlanillaOtroDescuento::find($id);

        $trabajador_cargo = AsignacionCargo::join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->join('cargos', 'cargos.id', 'nomina_cargos.cargo_id')
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->select(
                DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"),
                'cargos.nombre as nombre_cargo',
                'nomina_cargos.item as item'
            )
            ->where('asignacion_cargos.id', $otro_descuento->asignacion_cargo_id)->first();

        return view('planillas.otro_descuento.edit', compact('otro_descuento', 'trabajador_cargo'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'monto_od' => 'required|numeric|min:0',
        ]);
        $data = PlanillaOtroDescuento::find($id);

        $data->monto_od = $request->monto_od;
        $otro_descuento = $data->save();
        if ($otro_descuento) {
            return redirect()->route('otro_descuento.lista', [
                'tipo_contrato' => $data->tipo_contrato,
                'mes' => $data->mes,
                'gestion' => $data->gestion
            ])->with('edit', 'Registro modificado exitosamente.');
        }
    }

    public function create_otro_descuento($mes, $gestion, $tipo_contrato)
    {
        // todos los trabajadores que no tengan una registro en la planilla
        $trabajadores = AsignacionCargo::select(
            'asignacion_cargos.id as asignacion_cargo_id',
            'nomina_cargos.item as item',
            DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"),
        )
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->where('asignacion_cargos.estado', 'HABILITADO')
            ->get();

        $conf_otro_descuentos = ConfOtroDescuento::where('estado', 'HABILITADO')->get();
        // return $trabajadores;
        return view('planillas.otro_descuento.create', compact('mes', 'gestion', 'tipo_contrato', 'trabajadores','conf_otro_descuentos'));
    }



    public function generar_otro_descuento(Request $request)
    {
        $request->validate([
            'mes' => 'required',
            'gestion' => 'required',
            'tipo_contrato' => 'required|numeric',
            'trabajador' => 'required',
            'conf_otro_descuento_id' => 'required',
            'de_donde' => 'required',
        ]);

        $tipo_contrato_id = $request->tipo_contrato;
        $trabajador_id = $request->trabajador;
        $mes = $request->mes;
        $gestion = $request->gestion;
        $de_donde = $request->de_donde;
        $conf_otro_descuento = ConfOtroDescuento::where('id', $request->conf_otro_descuento_id)->first();
        $factor_calculo = $conf_otro_descuento->factor_calculado;

        $verificar = DB::table('planilla_otro_descuentos')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato_id],
            ['asignacion_cargo_id', '=', $trabajador_id],
            ['descripcion', '=', $conf_otro_descuento->descripcion]
        ])->first();

        if (empty($verificar)) {
            $registro_tg = DB::table('planilla_total_ganados')->where([
                ['mes', '=', $mes],
                ['gestion', '=', $gestion],
                ['tipo_contrato', '=', $tipo_contrato_id],
                ['asignacion_cargo_id', '=', $trabajador_id]
            ])->first();

            $monto_od = 0;
            if ($de_donde == 1) {
                eval("\$monto_od = \$registro_tg->total_ganado$factor_calculo;");
                PlanillaOtroDescuento::create([
                    'mes' => $mes,
                    'gestion' => $gestion,
                    'tipo_contrato' => $tipo_contrato_id,
                    'descripcion' => $conf_otro_descuento->descripcion,
                    'factor_calculo' => $conf_otro_descuento->factor_calculado,
                    'monto_od' => round($monto_od, 2),
                    'asignacion_cargo_id' => $trabajador_id,
                ]);
            } else {
                eval("\$monto_od = \$registro_tg->haber_basico$factor_calculo;");
                PlanillaOtroDescuento::create([
                    'mes' => $mes,
                    'gestion' => $gestion,
                    'tipo_contrato' => $tipo_contrato_id,
                    'descripcion' => $conf_otro_descuento->descripcion,
                    'factor_calculo' => $conf_otro_descuento->factor_calculado,
                    'monto_od' => round($monto_od, 2),
                    'asignacion_cargo_id' => $trabajador_id,
                ]);
            }
            return redirect()->route(
                'otro_descuento.lista',
                [
                    'tipo_contrato' => $tipo_contrato_id,
                    'mes' => $mes,
                    'gestion' => $gestion
                ]
            )->with('edit', 'Descuento creado exitosamente.');
        } else {
            return redirect()->route('otro_descuento.lista', [
                'tipo_contrato' => $tipo_contrato_id,
                'mes' => $mes,
                'gestion' => $gestion
            ])->with('message', 'Error. Ya se tiene generada un descuento con la misma descripcion de ese periodo');
        }
    }

    public function eliminar_otro_descuento($id)
    {
        $otro_descuento = PlanillaOtroDescuento::find($id);
        $otro_descuento->delete();
        return response()->json(['success' => true, 'message' => "Registro eliminado exitosamente."], 200);
    }

    public function eliminar_planilla($mes, $gestion, $tipo_contrato)
    {
        DB::table('planilla_otro_descuentos')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato],
        ])->delete();
        return response()->json(['success' => true, 'message' => "Planilla Otros descuentos eliminada exitosamente."], 200);
    }

    public function planilla_pdf($mes, $gestion, $tipo_contrato){

        $otro_descuentos = DB::table('planilla_otro_descuentos as od')
        ->join('asignacion_cargos as ac','ac.id','od.asignacion_cargo_id')
        ->join('nomina_cargos as nc','nc.id','ac.nomina_cargo_id')
        ->join('trabajadors', 'trabajadors.id', 'ac.trabajador_id')
        ->join('cargos as c', 'c.id','nc.cargo_id')
        ->join('escala_salarials as es', 'es.id','nc.escala_salarial_id')
        ->join('planilla_total_ganados as tg', 'tg.asignacion_cargo_id','ac.id')
        ->select(
                DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"),
                'od.asignacion_cargo_id as asignacion_cargo_id',
                'nc.item as item',
                'c.nombre as nombre_cargo',
                'tg.haber_basico as haber_basico',
                'tg.total_ganado as total_ganado',
                'ac.sindicato as sindicalizado',
                'od.descripcion as od_descripcion',
                'od.monto_od as od_monto',
                )
        ->where([
            ['od.mes', '=', $mes],
            ['od.gestion', '=', $gestion],
            ['od.tipo_contrato', '=', $tipo_contrato],
            ['tg.mes', '=', $mes],
            ['tg.gestion', '=', $gestion],
            ['tg.tipo_contrato', '=', $tipo_contrato]
        ])
        ->orderBy('nc.item')
        ->get();
        // return $otro_descuentos->count();
        return response(view('planillas.otro_descuento.pdf',compact('mes', 'gestion', 'tipo_contrato','otro_descuentos')))
        ->header('Content-Type', 'application/pdf');
    }
}
