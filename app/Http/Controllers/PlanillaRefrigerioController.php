<?php

namespace App\Http\Controllers;

use App\Models\AsignacionCargo;
use App\Models\PlanillaRefrigerio;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanillaRefrigerioController extends Controller
{
    public function __construct()
    {
        $this->Refrigerio = new PlanillaRefrigerio();
    }
    public function consultar_refrigerio()
    {
        return view('planillas.refrigerio.consultar');
    }

    public function lista_refrigerio(Request $request)
    {
        $request->validate([
            'mes' => 'required|numeric',
            'gestion' => 'required|numeric',
            'tipo_contrato' => 'required|numeric',
        ]);
        // $lista_refrigerio
        $mes = $request->mes;
        $gestion = $request->gestion;
        $tipo_contrato = $request->tipo_contrato;
        $lista_refrigerio = $this->Refrigerio->refrigerio_lista($mes, $gestion, $tipo_contrato);
        // return $lista_refrigerio;
        return view('planillas.refrigerio.lista', compact('mes', 'gestion', 'tipo_contrato', 'lista_refrigerio'));
    }

    public function create_all_planilla($mes, $gestion, $tipo_contrato)
    {
        return view('planillas.refrigerio.create_all', compact('mes', 'gestion', 'tipo_contrato'));
    }

    public function generar_planilla(Request $request)
    {
        $request->validate([
            'mes' => 'required',
            'gestion' => 'required',
            'dias_asistencia' => 'required|numeric|max:31|min:0',
            'dias_laborales' => 'required|numeric|max:31|min:0',
            'tipo_contrato' => 'required|numeric',
        ]);
        $tipo_contrato_id = $request->tipo_contrato;
        $mes = $request->mes;
        $gestion = $request->gestion;
        $dias_asistencia = $request->dias_asistencia;
        $otros = 0;
        $monto_refrigerio = PlanillaRefrigerio::CONF_REFRIGERIO['monto_refrigerio'];
        $total_refrigerio = $monto_refrigerio * $dias_asistencia;
        $verificar = DB::table('planilla_refrigerios')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato_id]
        ])->first();
        // si existe verificar->tipo_contrato imprima tipo contrato si no vacio ''
        $verificar_tipo_contrato = isset($verificar->tipo_contrato) ? $verificar->tipo_contrato : "";
        $verificar_mes = isset($verificar->mes) ? $verificar->mes : "";
        $verificar_gestion = isset($verificar->gestion) ? $verificar->gestion : "";
        if ($verificar_tipo_contrato != $tipo_contrato_id && $verificar_mes != $mes && $verificar_gestion != $gestion) {
            $lista_asignacion_cargos = AsignacionCargo::select('id', 'nomina_cargo_id', 'estado')
                ->with(['nomina_cargo:id,tipo_contrato_id'])
                ->whereHas('nomina_cargo', function ($query) use ($tipo_contrato_id) {
                    $query->where('tipo_contrato_id', '=', $tipo_contrato_id);
                })->where('estado', 'HABILITADO')->get();
            if ($lista_asignacion_cargos->count() > 0) {
                foreach ($lista_asignacion_cargos as $asignacion_cargo) {
                    PlanillaRefrigerio::create([
                        'mes' => $mes,
                        'gestion' => $gestion,
                        'tipo_contrato' => $tipo_contrato_id,
                        'dias_asistencia' => $dias_asistencia,
                        'dias_laborales' => $request->dias_laborales,
                        'monto_refrigerio' => $monto_refrigerio,
                        'otros' => $otros,
                        'total_refrigerio' => $total_refrigerio,
                        'asignacion_cargo_id' => $asignacion_cargo->id,
                    ]);
                }
                return redirect()->route('refrigerio.lista', ['tipo_contrato' => $tipo_contrato_id, 'mes' => $mes, 'gestion' => $gestion]);
            } else {
                return redirect()->route(
                    'refrigerio.lista',
                    [
                        'tipo_contrato' => $tipo_contrato_id,
                        'mes' => $mes,
                        'gestion' => $gestion
                    ]
                )
                    ->with('message', 'No existen registros para generar la planilla');
            }
        } else {
            return redirect()->route('refrigerio.lista', [
                'tipo_contrato' => $tipo_contrato_id,
                'mes' => $mes,
                'gestion' => $gestion
            ])->with('message', 'Error. Ya se tiene generada la planilla refrigerio para ese periodo');
        }
    }


    public function editar_refrigerio($id)
    {
        $refrigerio = PlanillaRefrigerio::find($id);

        $cargo = AsignacionCargo::select('id', 'trabajador_id')
            ->find($refrigerio->asignacion_cargo_id);

        $trabajador = Trabajador::select(DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"))
            ->find($cargo->trabajador_id);
        return view('planillas.refrigerio.edit', compact('refrigerio', 'trabajador'));
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'dias_asistencia' => 'required|numeric|max:' . $request->dias_laborales . '|min:0',
            'otros' => 'required|numeric|min:0',
        ]);
        $data = PlanillaRefrigerio::findOrFail($id);
        $data->dias_asistencia = $request->dias_asistencia;
        $data->otros = $request->otros;
        $data->total_refrigerio = ($request->dias_asistencia * $data->monto_refrigerio) + $request->otros;
        $refrigerio = $data->save();
        if ($refrigerio) {
            return redirect()->route('refrigerio.lista', [
                'tipo_contrato' => $data->tipo_contrato,
                'mes' => $data->mes,
                'gestion' => $data->gestion
            ])->with('edit', 'Refrigerio modificado exitosamente.');
        }
    }

    public function eliminar_planilla($mes, $gestion, $tipo_contrato)
    {
        DB::table('planilla_refrigerios')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato],
        ])->delete();
        return response()->json(['success' => true, 'message' => "Planilla Refrigerio eliminada exitosamente."], 200);
    }


    public function planilla_pdf($mes, $gestion, $tipo_contrato){
        $nomina_cargos = DB::table('nomina_cargos as nc')
        ->join('unidad_organizacionals as u','u.id','nc.unidad_organizacional_id')
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
                if (in_array($search_cargo->asignacion_cargo_id, $ids_asistencias)) {
                    $refrigerios = DB::table('nomina_cargos as nc')
                    ->leftjoin('asignacion_cargos as ac', 'ac.nomina_cargo_id','nc.id')
                    ->join('unidad_organizacionals as u','u.id','nc.unidad_organizacional_id')
                    ->join('cargos as c','c.id','nc.cargo_id')
                    ->join('trabajadors as t','t.id','ac.trabajador_id')
                    ->join('planilla_refrigerios as p_r','p_r.asignacion_cargo_id','ac.id')
                    ->where([
                        ['p_r.mes', '=', $mes],
                        ['p_r.gestion', '=', $gestion],
                        ['p_r.tipo_contrato', '=', $tipo_contrato],
                        ['nc.item', '=', $cargo->item],
                        ['u.seccion', '=', $cargo->seccion],
                    ])
                    ->select(
                        'nc.item as item',
                        DB::raw("CONCAT(t.nombre,' ',t.apellido_paterno,' ',t.apellido_materno)  AS nombre_completo"),
                        'c.nombre as cargo',
                        'p_r.mes as mes',
                        'p_r.gestion as gestion',
                        'p_r.tipo_contrato as tipo_contrato',
                        'p_r.dias_asistencia as dias_asistencia',
                        'p_r.dias_laborales as dias_laborales',
                        'p_r.monto_refrigerio as monto_refrigerio',
                        'p_r.otros as otros',
                        'p_r.total_refrigerio as total_refrigerio',
                    )
                    ->orderBy('nc.item')->first();
                    // de esta manera agrego los refrigerios de un trabajador al item respectivo
                    $cargo->datos = $refrigerios;
                }else {
                    $cargo->datos = [];
                }
            }else {
                $cargo->datos = [];
            }

        }
        // return $cargos;

        $collect = collect($nomina_cargos);
        $cargos = $collect->groupBy('seccion');
        return response(view('planillas.refrigerio.pdf',compact('mes', 'gestion', 'tipo_contrato','cargos')))
        ->header('Content-Type', 'application/pdf');
    }
}
