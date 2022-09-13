<?php

namespace App\Http\Controllers;

use App\Models\AsignacionCargo;
use App\Models\PlanillaAsistencia;
use App\Models\Tipo_Contrato;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanillaAsistenciaController extends Controller
{
    public function __construct()
    {
        $this->Asistencia = new PlanillaAsistencia();
    }
    public function consultar_asistencia()
    {
        $tipo_contratos = Tipo_Contrato::where('estado', 'ACTIVO')->get();;
        return view('planillas.asistencia.consultar', compact('tipo_contratos'));
    }

    public function lista_asistencia(Request $request)
    {
        $request->validate([
            'mes' => 'required|numeric',
            'gestion' => 'required|numeric',
            'tipo_contrato' => 'required|numeric',
        ]);
        // $lista_asistencia
        $mes = $request->mes;
        $gestion = $request->gestion;
        $tipo_contrato = $request->tipo_contrato;
        $lista_asistencia = $this->Asistencia->asistencia_lista($mes, $gestion, $tipo_contrato);
        // return $lista_asistencia;
        return view('planillas.asistencia.lista', compact('mes', 'gestion', 'tipo_contrato', 'lista_asistencia'));
    }

    public function create_all_planilla($mes, $gestion, $tipo_contrato)
    {
        return view('planillas.asistencia.create_all', compact('mes', 'gestion', 'tipo_contrato'));
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

        $verificar = DB::table('planilla_asistencias')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato_id]
        ])->first();
        // si existe verificar->tipo_contrato imprima tipo contrato si no vacio ''
        $verificar_tipo_contrato = isset($verificar->tipo_contrato) ? $verificar->tipo_contrato : "";
        $verificar_mes = isset($verificar->mes) ? $verificar->mes : "";
        $verificar_gestion = isset($verificar->gestion) ? $verificar->gestion : "";
        if ($verificar_tipo_contrato != $tipo_contrato_id && $verificar_mes != $mes && $verificar_gestion != $gestion) {
            $lista_contratos = AsignacionCargo::select('id', 'nomina_cargo_id', 'estado')->with(['nomina_cargo:id,tipo_contrato_id'])
                ->whereHas('nomina_cargo', function ($query) use ($tipo_contrato_id) {
                    $query->where('tipo_contrato_id', '=', $tipo_contrato_id);
                })->where('estado', 'HABILITADO')
                ->get();
            if ($lista_contratos->count() > 0) {
                foreach ($lista_contratos as $contrato) {
                    PlanillaAsistencia::create([
                        'mes' => $mes,
                        'gestion' => $gestion,
                        'dias_asistencia' => $request->dias_asistencia,
                        'dias_laborales' => $request->dias_laborales,
                        'tipo_contrato' => $tipo_contrato_id,
                        'asignacion_cargo_id' => $contrato->id,
                    ]);
                }
                return redirect()->route('asistencia.lista', ['tipo_contrato' => $tipo_contrato_id, 'mes' => $mes, 'gestion' => $gestion]);
            } else {
                return redirect()->route(
                    'asistencia.lista',
                    [
                        'tipo_contrato' => $tipo_contrato_id,
                        'mes' => $mes,
                        'gestion' => $gestion
                    ]
                )
                    ->with('message', 'No existen registros para generar la planilla');
            }
        } else {
            return redirect()->route('asistencia.lista', [
                'tipo_contrato' => $tipo_contrato_id,
                'mes' => $mes,
                'gestion' => $gestion
            ])->with('message', 'Error. Ya se tiene generada la asistencia para ese periodo');
        }
    }
    public function editar_asistencia($id)
    {
        $asistencia = PlanillaAsistencia::find($id);

        $trabajador = AsignacionCargo::join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->join('cargos', 'cargos.id', 'nomina_cargos.cargo_id')
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->select(
                DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"),
                'cargos.nombre as nombre_cargo',
                'nomina_cargos.item as item'
            )
            ->where('asignacion_cargos.id', $asistencia->asignacion_cargo_id)->first();
        return view('planillas.asistencia.edit', compact('asistencia', 'trabajador'));
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'dias_asistencia' => 'required|numeric|max:' . $request->dias_laborales . '|min:0',
        ]);
        $data = PlanillaAsistencia::select('id', 'mes', 'gestion', 'tipo_contrato')->find($id);
        $data->dias_asistencia = $request->dias_asistencia;
        $data->observacion = trim($request->observacion);
        $asistencia = $data->save();
        if ($asistencia) {
            return redirect()->route('asistencia.lista', [
                'tipo_contrato' => $data->tipo_contrato,
                'mes' => $data->mes,
                'gestion' => $data->gestion
            ])->with('edit', 'Asistencia modificada exitosamente.');
        }
    }

    public function create_asistencia($mes, $gestion, $tipo_contrato)
    {
        // todos los trabajadores que no tengan una asistencia registrada
        $trabajadores = AsignacionCargo::select(
            'asignacion_cargos.id as asignacion_cargo_id',
            DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"),
        )
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->where('asignacion_cargos.estado', 'HABILITADO')
            ->whereNotIn('asignacion_cargos.id', function ($query) use ($mes, $gestion, $tipo_contrato) {
                $query->select('planilla_asistencias.asignacion_cargo_id')
                    ->from('planilla_asistencias')->where([
                        ['mes', '=', $mes],
                        ['gestion', '=', $gestion],
                        ['tipo_contrato', '=', $tipo_contrato]
                    ]);
            })->get();
        // return $trabajadores;
        return view('planillas.asistencia.create', compact('mes', 'gestion', 'tipo_contrato', 'trabajadores'));
    }
    public function generar_asistencia(Request $request)
    {

        $dias_asistencia = isset($request->dias_asistencia) ? $request->dias_asistencia : 30;
        $request->validate([
            'mes' => 'required',
            'gestion' => 'required',
            'trabajador' => 'required',
            'dias_laborales' => 'required|numeric|max:' . $dias_asistencia . '|min:1',
        ]);
        $tipo_contrato_id = $request->tipo_contrato;
        $mes = $request->mes;
        $gestion = $request->gestion;
        $cargo_trabajador = $request->trabajador;

        $verificar = DB::table('planilla_asistencias')->where([
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
            PlanillaAsistencia::create([
                'mes' => $mes,
                'gestion' => $gestion,
                'dias_asistencia' => $request->dias_asistencia,
                'dias_laborales' => $request->dias_laborales,
                'tipo_contrato' => $tipo_contrato_id,
                'asignacion_cargo_id' => $cargo_trabajador,
            ]);
            return redirect()->route(
                'asistencia.lista',
                [
                    'tipo_contrato' => $tipo_contrato_id,
                    'mes' => $mes,
                    'gestion' => $gestion
                ]
            )->with('edit', 'Asistencia creado exitosamente.');
        } else {
            return redirect()->route('asistencia.lista', [
                'tipo_contrato' => $tipo_contrato_id,
                'mes' => $mes,
                'gestion' => $gestion
            ])->with('message', 'Error. Ya se tiene generada la asistencia para ese periodo');
        }
    }


    public function eliminar_asistencia($id)
    {
        $asistencia = PlanillaAsistencia::find($id);
        $asistencia->delete();
        return response()->json(['success' => true, 'message' => "Asistencia eliminada exitosamente."], 200);
    }

    public function eliminar_planilla($mes, $gestion, $tipo_contrato)
    {
        $planilla_asistencia = DB::table('planilla_asistencias')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato],
        ])->delete();
        return response()->json(['success' => true, 'message' => "Planilla Asistencia eliminada exitosamente."], 200);
    }

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
                if (in_array($search_cargo->asignacion_cargo_id, $ids_asistencias)) {
                    $asistencias = DB::table('nomina_cargos as nc')
                        ->leftjoin('asignacion_cargos as ac', 'ac.nomina_cargo_id', 'nc.id')
                        ->join('unidad_organizacionals as u', 'u.id', 'nc.unidad_organizacional_id')
                        ->join('cargos as c', 'c.id', 'nc.cargo_id')
                        ->join('trabajadors as t', 't.id', 'ac.trabajador_id')
                        ->join('planilla_asistencias as a', 'a.asignacion_cargo_id', 'ac.id')
                        ->where([
                            ['a.mes', '=', $mes],
                            ['a.gestion', '=', $gestion],
                            ['a.tipo_contrato', '=', $tipo_contrato],
                            ['nc.item', '=', $cargo->item],
                            ['u.seccion', '=', $cargo->seccion],
                        ])
                        ->select(
                            'nc.item as item',
                            DB::raw("CONCAT(t.nombre,' ',t.apellido_paterno,' ',t.apellido_materno)  AS nombre_completo"),
                            'c.nombre as cargo',
                            'a.mes as mes',
                            'a.gestion as gestion',
                            'a.tipo_contrato as tipo_contrato',
                            'a.dias_asistencia as dias_asistencia',
                            'a.dias_laborales as dias_laborales',
                        )
                        ->orderBy('nc.item')->first();
                    // de esta manera agrego las asistencias de un trabajador al item respectivo
                    $cargo->datos = $asistencias;
                } else {
                    $cargo->datos = [];
                }
            } else {
                $cargo->datos = [];
            }
        }
        $collect = collect($nomina_cargos);
        $cargos = $collect->groupBy('seccion');
        return response(view('planillas.asistencia.pdf_asistencias', compact('mes', 'gestion', 'tipo_contrato', 'cargos')))
            ->header('Content-Type', 'application/pdf');
    }
}
