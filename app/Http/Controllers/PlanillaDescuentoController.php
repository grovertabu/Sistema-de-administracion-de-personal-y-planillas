<?php

namespace App\Http\Controllers;

use App\Models\AsignacionCargo;
use App\Models\ConfDescuento;
use App\Models\PlanillaDescuento;
use App\Models\PlanillaTotalGanado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanillaDescuentoController extends Controller
{
    public function consultar_descuento()
    {
        // $tipo_contratos = Tipo_Contrato::where('estado', 'ACTIVO')->get();
        return view('planillas.descuento.consultar');
    }

    public function lista_descuento(Request $request)
    {
        $request->validate([
            'mes' => 'required|numeric',
            'gestion' => 'required|numeric',
            'tipo_contrato' => 'required|numeric',
        ]);
        // $lista_descuento
        $mes = $request->mes;
        $gestion = $request->gestion;
        $tipo_contrato = $request->tipo_contrato;
        $lista_descuento = AsignacionCargo::select(
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
            ->with(['planilla_descuentos' => function ($query)  use ($tipo_contrato, $mes, $gestion) {
                $query->select('id', 'mes', 'gestion', 'tipo_contrato', 'nombre_descuento', 'monto', 'asignacion_cargo_id')
                    ->where([
                        ['mes', '=', $mes],
                        ['gestion', '=', $gestion],
                        ['tipo_contrato', '=', $tipo_contrato]
                    ])->orderBy('nombre_descuento', 'asc');
            }])
            ->where('nomina_cargos.tipo_contrato_id', $tipo_contrato)
            ->whereHas('planilla_descuentos', function ($query) use ($tipo_contrato, $mes, $gestion) {
                $query->where([
                    ['mes', '=', $mes],
                    ['gestion', '=', $gestion],
                    ['tipo_contrato', '=', $tipo_contrato]
                ]);
            })
            ->orderBy('nomina_cargos.item', 'ASC')
            ->get();
        // return $lista_descuento;
        return view('planillas.descuento.lista', compact('mes', 'gestion', 'tipo_contrato', 'lista_descuento'));
    }

    // formulario para la generacion de la planilla
    public function create_all_planilla($mes, $gestion, $tipo_contrato)
    {
        return view('planillas.descuento.create_all', compact('mes', 'gestion', 'tipo_contrato'));
    }

    public function generar_planilla(Request $request)
    {
        // return $request;
        $request->validate([
            'mes' => 'required',
            'gestion' => 'required',
        ]);
        $tipo_contrato_id = $request->tipo_contrato;
        $mes = $request->mes;
        $gestion = $request->gestion;

        $verificar_descuento =  DB::table('planilla_descuentos')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato_id]
        ])->first();
        // si existe verificar->tipo_contrato imprima tipo contrato si no vacio ''
        $verificar_tipo_contrato = isset($verificar_descuento->tipo_contrato) ? $verificar_descuento->tipo_contrato : "";
        $verificar_mes = isset($verificar_descuento->mes) ? $verificar_descuento->mes : "";
        $verificar_gestion = isset($verificar_descuento->gestion) ? $verificar_descuento->gestion : "";
        if ($verificar_tipo_contrato != $tipo_contrato_id && $verificar_mes != $mes && $verificar_gestion != $gestion) {
            $lista_trabajadores = DB::table('asignacion_cargos as ac')
                ->join('trabajadors as t', 't.id', 'ac.trabajador_id')
                ->select(
                    'ac.id as id_asignacion_cargo',
                    'ac.estado as estado_asignacion',
                )->where([['ac.estado', '=', 'HABILITADO']])
                ->get();
            $monto = 0;
            foreach ($lista_trabajadores as $registro_ac) {
                $conf_descuentos = ConfDescuento::where('estado', 'HABILITADO')->get();
                foreach ($conf_descuentos as $c_descuento) {
                    PlanillaDescuento::create([
                        'mes' => $mes,
                        'gestion' => $gestion,
                        'tipo_contrato' => $tipo_contrato_id,
                        'nombre_descuento' => $c_descuento->nombre_descuento,
                        'monto' => $monto,
                        'asignacion_cargo_id' => $registro_ac->id_asignacion_cargo,
                    ]);
                }
            }

            return redirect()->route(
                'descuento.lista',
                [
                    'tipo_contrato' => $tipo_contrato_id,
                    'mes' => $mes,
                    'gestion' => $gestion
                ]
            )->with('create', 'Planilla Descuentos creado exitosamente.');
        } else {
            return redirect()->route('descuento.lista', [
                'tipo_contrato' => $tipo_contrato_id,
                'mes' => $mes,
                'gestion' => $gestion
            ])->with('message', 'Error. Ya se tiene generada la Planilla de Descuentos para ese periodo');
        }
    }

    public function editar_descuento($id)
    {
        $descuento = PlanillaDescuento::find($id);

        $trabajador_cargo = AsignacionCargo::join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->join('cargos', 'cargos.id', 'nomina_cargos.cargo_id')
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->select(
                DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"),
                'cargos.nombre as nombre_cargo',
                'nomina_cargos.item as item'
            )
            ->where('asignacion_cargos.id', $descuento->asignacion_cargo_id)->first();

        return view('planillas.descuento.edit', compact('descuento', 'trabajador_cargo'));
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'monto' => 'required|numeric|min:0',
        ]);
        $data = PlanillaDescuento::find($id);
        if($request->nombre_descuento == 'FONDO SOCIAL'){
            $total_ganado = PlanillaTotalGanado::where([
                ['mes', '=', $data->mes],
                ['gestion', '=', $data->gestion],
                ['tipo_contrato', '=', $data->tipo_contrato],
                ['asignacion_cargo_id', '=', $data->asignacion_cargo_id]
            ])->first();
            $cantidad_horas = $request->monto;
            $monto_descuento = round(($total_ganado->haber_mensual/240)*$cantidad_horas,2);
            $data->monto = $monto_descuento;

        }else{
            $monto_descuento = $request->monto;
            $data->monto = $monto_descuento;
        }
        $descuento = $data->save();
        if ($descuento) {
            return redirect()->route('descuento.lista', [
                'tipo_contrato' => $data->tipo_contrato,
                'mes' => $data->mes,
                'gestion' => $data->gestion
            ])->with('edit', 'Registro modificado exitosamente.');
        }
    }

    public function eliminar_planilla($mes, $gestion, $tipo_contrato)
    {
        DB::table('planilla_descuentos')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato],
        ])->delete();
        return response()->json(['success' => true, 'message' => "Planilla Descuentos eliminada exitosamente."], 200);
    }

    public function planilla_pdf($mes, $gestion, $tipo_contrato)
    {
        $registros_descuento = AsignacionCargo::select(
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
            ->with(['planilla_descuentos' => function ($query)  use ($tipo_contrato, $mes, $gestion) {
                $query->select('id', 'mes', 'gestion', 'tipo_contrato', 'nombre_descuento', 'monto', 'asignacion_cargo_id')
                    ->where([
                        ['mes', '=', $mes],
                        ['gestion', '=', $gestion],
                        ['tipo_contrato', '=', $tipo_contrato]
                    ])->orderBy('nombre_descuento', 'asc');
            }])
            ->where('nomina_cargos.tipo_contrato_id', $tipo_contrato)
            ->whereHas('planilla_descuentos', function ($query) use ($tipo_contrato, $mes, $gestion) {
                $query->where([
                    ['mes', '=', $mes],
                    ['gestion', '=', $gestion],
                    ['tipo_contrato', '=', $tipo_contrato]
                ]);
            })
            ->orderBy('nomina_cargos.item', 'ASC')
            ->get();

        $conf_descuentos = ConfDescuento::where([
            ['estado', '=', 'HABILITADO'],
        ])->get();

        return response(view(
            'planillas.descuento.pdf',
            compact(
                'mes',
                'gestion',
                'tipo_contrato',
                'registros_descuento',
                'conf_descuentos'
            )
        ))
            ->header('Content-Type', 'application/pdf');
    }
}
