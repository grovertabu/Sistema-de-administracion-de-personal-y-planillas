<?php

namespace App\Http\Controllers;

use App\Models\AsignacionCargo;
use App\Models\PlanillaSuplencia;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanillaSuplenciaController extends Controller
{
    public function __construct()
    {
        $this->Suplencia = new PlanillaSuplencia();
    }
    public function consultar_suplencia()
    {
        return view('planillas.suplencia.consultar');
    }

    public function lista_suplencia(Request $request)
    {
        $request->validate([
            'mes' => 'required|numeric',
            'gestion' => 'required|numeric',
            'tipo_contrato' => 'required|numeric',
        ]);
        // $lista_suplencia
        $mes = $request->mes;
        $gestion = $request->gestion;
        $tipo_contrato = $request->tipo_contrato;
        $lista_suplencia = $this->Suplencia->suplencia_lista($mes, $gestion, $tipo_contrato);
        // return $lista_suplencia;
        return view('planillas.suplencia.lista', compact('mes', 'gestion', 'tipo_contrato', 'lista_suplencia'));
    }

    public function create_suplencia($mes, $gestion, $tipo_contrato)
    {
        $trabajadores = AsignacionCargo::select(
            'asignacion_cargos.id as asignacion_cargo_id',
            DB::raw("CONCAT(trabajadors.nombre,' ',
            trabajadors.apellido_paterno,' ',
            trabajadors.apellido_materno)  AS nombre_completo"),
        )
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->where('asignacion_cargos.estado', 'HABILITADO')->get();

        $suplencias = DB::table('nomina_cargos as nc')
            ->join('cargos as c', 'c.id', 'nc.cargo_id')
            ->join('escala_salarials as es', 'es.id', 'nc.escala_salarial_id')
            ->select(
                'nc.item as item',
                'nc.id as id_cargo',
                'c.nombre as nombre_cargo',
                'es.salario_mensual as salario_mensual'
            )
            ->get();

        // return $suplencias;
        return view('planillas.suplencia.create', compact(
            'mes',
            'gestion',
            'tipo_contrato',
            'trabajadores',
            'suplencias'
        ));
    }

    public function registrar_suplencia(Request $request)
    {

        $request->validate([
            'mes' => 'required|numeric',
            'gestion' => 'required|numeric',
            'tipo_contrato' => 'required|numeric',
            'trabajador' => 'required|numeric',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'total_dias' => 'required|numeric|max:30|min:0',
            'id_cargo_suplencia' => 'required|numeric',
        ]);
        $tipo_contrato_id = $request->tipo_contrato;
        $mes = $request->mes;
        $gestion = $request->gestion;
        $cargo_trabajador_id = $request->trabajador;
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;
        $total_dias = $request->total_dias;
        $id_cargo_suplencia = $request->id_cargo_suplencia;


        $asignacion_cargo = DB::table('asignacion_cargos as ac')
            ->join('nomina_cargos as nc', 'nc.id', 'ac.nomina_cargo_id')
            ->join('cargos as c', 'c.id', 'nc.cargo_id')
            ->join('escala_salarials as es', 'es.id', 'nc.escala_salarial_id')
            ->where('ac.id', $cargo_trabajador_id)
            ->select(
                'ac.id as id_asignacion_cargo',
                'c.nombre as nombre_cargo',
                'es.salario_mensual as salario_mensual'
            )
            ->first();
        $nomina_cargo = DB::table('nomina_cargos as nc')
            ->join('cargos as c', 'c.id', 'nc.cargo_id')
            ->join('escala_salarials as es', 'es.id', 'nc.escala_salarial_id')
            ->where('c.id', $id_cargo_suplencia)
            ->select(
                'nc.id as id_cargo',
                'c.nombre as nombre_cargo',
                'es.salario_mensual as salario_mensual'
            )
            ->first();


        $monto = (($nomina_cargo->salario_mensual - $asignacion_cargo->salario_mensual) / 30) * $total_dias;

        $guadar_suplencia = PlanillaSuplencia::create([
            'mes' => $mes,
            'gestion' => $gestion,
            'tipo_contrato' => $tipo_contrato_id,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'cargo_suplencia' => $nomina_cargo->nombre_cargo,
            'salario_mensual' => $nomina_cargo->salario_mensual,
            'total_dias' => $total_dias,
            'monto' => $monto,
            'asignacion_cargo_id' => $cargo_trabajador_id,
        ]);
        if ($guadar_suplencia) {
            return redirect()->route(
                'suplencia.lista',
                [
                    'tipo_contrato' => $tipo_contrato_id,
                    'mes' => $mes,
                    'gestion' => $gestion
                ]
            )->with('edit', 'Suplencia registrada exitosamente.');
        } else {
            return redirect()->route(
                'suplencia.lista',
                [
                    'tipo_contrato' => $tipo_contrato_id,
                    'mes' => $mes,
                    'gestion' => $gestion
                ]
            )
                ->with('message', 'Error. No se registro Suplencia.');
        }
    }

    public function editar_suplencia($id)
    {
        $suplencia = PlanillaSuplencia::find($id);

        $cargo = AsignacionCargo::select('id', 'trabajador_id')
            ->find($suplencia->asignacion_cargo_id);

        $trabajador = Trabajador::select(DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"))
            ->find($cargo->trabajador_id);

        $suplencias = DB::table('nomina_cargos as nc')
            ->join('cargos as c', 'c.id', 'nc.cargo_id')
            ->join('escala_salarials as es', 'es.id', 'nc.escala_salarial_id')
            ->select(
                'nc.id as id_cargo',
                'c.nombre as nombre_cargo',
                'es.salario_mensual as salario_mensual'
            )
            ->get();
        return view('planillas.suplencia.edit', compact('suplencia', 'trabajador', 'suplencias'));
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'total_dias' => 'required|numeric|max:30|min:0',
            'id_cargo_suplencia' => 'required|numeric',
        ]);
        $total_dias = $request->total_dias;
        $id_cargo_suplencia = $request->id_cargo_suplencia;
        $dataSuplencia = PlanillaSuplencia::select(
            'id',
            'mes',
            'gestion',
            'tipo_contrato',
            'asignacion_cargo_id'
        )->find($id);

        $asignacion_cargo = DB::table('asignacion_cargos as ac')
            ->join('nomina_cargos as nc', 'nc.id', 'ac.nomina_cargo_id')
            ->join('cargos as c', 'c.id', 'nc.cargo_id')
            ->join('escala_salarials as es', 'es.id', 'nc.escala_salarial_id')
            ->where('ac.id', $dataSuplencia->asignacion_cargo_id)
            ->select(
                'ac.id as id_asignacion_cargo',
                'c.nombre as nombre_cargo',
                'es.salario_mensual as salario_mensual'
            )
            ->first();
        $nomina_cargo = DB::table('nomina_cargos as nc')
            ->join('cargos as c', 'c.id', 'nc.cargo_id')
            ->join('escala_salarials as es', 'es.id', 'nc.escala_salarial_id')
            ->where('c.id', $id_cargo_suplencia)
            ->select(
                'nc.id as id_cargo',
                'c.nombre as nombre_cargo',
                'es.salario_mensual as salario_mensual'
            )
            ->first();
        $monto = (($nomina_cargo->salario_mensual - $asignacion_cargo->salario_mensual) / 30) * $total_dias;

        $dataSuplencia->total_dias = $total_dias;
        $dataSuplencia->monto = $monto;
        $suplencia = $dataSuplencia->save();

        if ($suplencia) {
            return redirect()->route('suplencia.lista', [
                'tipo_contrato' => $dataSuplencia->tipo_contrato,
                'mes' => $dataSuplencia->mes,
                'gestion' => $dataSuplencia->gestion
            ])->with('edit', 'Suplencia modificada exitosamente.');
        } else {
            return redirect()->route('suplencia.lista', [
                'tipo_contrato' => $dataSuplencia->tipo_contrato,
                'mes' => $dataSuplencia->mes,
                'gestion' => $dataSuplencia->gestion
            ])->with('edit', 'Error. no se modificó el registro de hora extra.');
        }
    }

    public function eliminar_suplencia($id)
    {
        $suplencia = PlanillaSuplencia::findOrFail($id);
        $suplencia->delete();
        return response()->json(['success' => true, 'message' => "Registro eliminado exitosamente."], 200);
    }
    public function planilla_pdf($mes, $gestion, $tipo_contrato){
        $suplencias = DB::table('planilla_suplencias as su')
        ->join('asignacion_cargos as ac','ac.id','su.asignacion_cargo_id')
        ->join('nomina_cargos as nc','nc.id','ac.nomina_cargo_id')
        ->join('trabajadors', 'trabajadors.id', 'ac.trabajador_id')
        ->join('cargos as c', 'c.id','nc.cargo_id')
        ->join('escala_salarials as es', 'es.id','nc.escala_salarial_id')
        ->select(DB::raw('SUM(su.monto) as total'),
                DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"),
                'su.asignacion_cargo_id as asignacion_cargo_id',
                'nc.item as item',
                'c.nombre as nombre_cargo',
                'su.cargo_suplencia as cargo_suplencia',
                'su.salario_mensual as salario_mensual',
                'su.total_dias as total_dias',
                )
        ->where([
            ['su.mes', '=', $mes],
            ['su.gestion', '=', $gestion],
            ['su.tipo_contrato', '=', $tipo_contrato]
        ])
        ->groupBy('su.id','nombre_completo','nc.item','c.nombre','es.salario_mensual')
        ->orderBy('nc.item')
        ->get();
        // return $suplencias;
        return response(view('planillas.suplencia.pdf',compact('mes', 'gestion', 'tipo_contrato','suplencias')))
        ->header('Content-Type', 'application/pdf');
    }
}
