<?php

namespace App\Http\Controllers;

use App\Models\AsignacionCargo;
use App\Models\ConfHorasExtra;
use App\Models\PlanillaHorasExtra;
use App\Models\Tipo_Contrato;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanillaHorasExtraController extends Controller
{
    public function __construct()
    {
        $this->HorasExtra = new PlanillaHorasExtra();
    }
    public function consultar_horas_extra()
    {
        $tipo_contratos = Tipo_Contrato::where('estado', 'ACTIVO')->get();;
        return view('planillas.horas_extra.consultar', compact('tipo_contratos'));
    }

    public function lista_horas_extra(Request $request)
    {
        $request->validate([
            'mes' => 'required|numeric',
            'gestion' => 'required|numeric',
            'tipo_contrato' => 'required|numeric',
        ]);
        // $lista_horas_extra
        $mes = $request->mes;
        $gestion = $request->gestion;
        $tipo_contrato = $request->tipo_contrato;
        $lista_horas_extra = $this->HorasExtra->horas_extra_lista($mes, $gestion, $tipo_contrato);
        // return $lista_horas_extra;
        return view('planillas.horas_extra.lista', compact('mes', 'gestion', 'tipo_contrato', 'lista_horas_extra'));
    }

    public function create_horas_extra($mes, $gestion, $tipo_contrato)
    {
        // todos los trabajadores que no tengan una horas_extra registrada
        $trabajadores = AsignacionCargo::select(
            'asignacion_cargos.id as asignacion_cargo_id',
            DB::raw("CONCAT(trabajadors.nombre,' ',
            trabajadors.apellido_paterno,' ',
            trabajadors.apellido_materno)  AS nombre_completo"),
        )->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->where('asignacion_cargos.estado', 'HABILITADO')->get();
        // Configuraciones para registrar una hora extra
        $conf_horas_extras = ConfHorasExtra::select('id', 'tipo_hora_extra')
            ->where('estado', 'HABILITADO')->get();
        // return $trabajadores;
        return view('planillas.horas_extra.create', compact('mes', 'gestion', 'tipo_contrato', 'trabajadores', 'conf_horas_extras'));
    }

    public function registrar_horas_extra(Request $request)
    {

        $request->validate([
            'mes' => 'required|numeric',
            'gestion' => 'required|numeric',
            'tipo_contrato' => 'required|numeric',
            'trabajador' => 'required|numeric',
            'tipo_hora_extra' => 'required|numeric',
            'cantidad' => 'required|numeric',
        ]);
        $tipo_contrato_id = $request->tipo_contrato;
        $mes = $request->mes;
        $gestion = $request->gestion;
        $cargo_trabajador_id = $request->trabajador;
        $tipo_hora_extra_id = $request->tipo_hora_extra;
        $cantidad = $request->cantidad;

        $conf_horas_extra = ConfHorasExtra::find($tipo_hora_extra_id);

        $cargo_trabajador = DB::table('asignacion_cargos as ac')
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
        $calculo_horas = ($conf_horas_extra->factor_calculo * $cantidad) / 2;

        $monto = (($cargo_trabajador->salario_mensual / 30) / 8) * $calculo_horas * 2;

        $guadar_hora_extra = PlanillaHorasExtra::create([
            'mes' => $mes,
            'gestion' => $gestion,
            'tipo_contrato' => $tipo_contrato_id,
            'tipo_hora_extra' => $conf_horas_extra->tipo_hora_extra,
            'factor_calculo' => $conf_horas_extra->factor_calculo,
            'cantidad' => $cantidad,
            'monto' => $monto,
            'asignacion_cargo_id' => $cargo_trabajador->id_asignacion_cargo,
        ]);
        if ($guadar_hora_extra) {
            return redirect()->route(
                'horas_extra.lista',
                [
                    'tipo_contrato' => $tipo_contrato_id,
                    'mes' => $mes,
                    'gestion' => $gestion
                ]
            )->with('edit', 'Hora extra registrada exitosamente.');
        } else {
            return redirect()->route(
                'horas_extra.lista',
                [
                    'tipo_contrato' => $tipo_contrato_id,
                    'mes' => $mes,
                    'gestion' => $gestion
                ]
            )
                ->with('message', 'Error. No se registro hora extra.');
        }
    }


    public function editar_horas_extra($id)
    {
        $horas_extra = PlanillaHorasExtra::find($id);

        $cargo = AsignacionCargo::select('id', 'trabajador_id')
            ->find($horas_extra->asignacion_cargo_id);

        $trabajador = Trabajador::select(DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"))
            ->find($cargo->trabajador_id);
        return view('planillas.horas_extra.edit', compact('horas_extra', 'trabajador'));
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'factor_calculo' => 'required|numeric',
            'cantidad' => 'required|numeric',
        ]);
        $factor_calculo = $request->factor_calculo;
        $cantidad = $request->cantidad;
        $data = PlanillaHorasExtra::select(
            'id',
            'mes',
            'gestion',
            'tipo_contrato',
            'asignacion_cargo_id'
        )->find($id);


        $cargo_trabajador = DB::table('asignacion_cargos as ac')
            ->join('nomina_cargos as nc', 'nc.id', 'ac.nomina_cargo_id')
            ->join('cargos as c', 'c.id', 'nc.cargo_id')
            ->join('escala_salarials as es', 'es.id', 'nc.escala_salarial_id')
            ->where('ac.id', $data->asignacion_cargo_id)
            ->select(
                'ac.id as id_asignacion_cargo',
                'c.nombre as nombre_cargo',
                'es.salario_mensual as salario_mensual'
            )
            ->first();
        // Calculo para editar la cantidad de horas extras
        $calculo_horas = ($factor_calculo * $cantidad) / 2;
        $monto = (($cargo_trabajador->salario_mensual / 30) / 8) * $calculo_horas * 2;

        $data->cantidad = $cantidad;
        $data->monto = $monto;
        $horas_extra = $data->save();

        if ($horas_extra) {
            return redirect()->route('horas_extra.lista', [
                'tipo_contrato' => $data->tipo_contrato,
                'mes' => $data->mes,
                'gestion' => $data->gestion
            ])->with('edit', 'Horas extra modificada exitosamente.');
        }
        else{
            return redirect()->route('horas_extra.lista', [
                'tipo_contrato' => $data->tipo_contrato,
                'mes' => $data->mes,
                'gestion' => $data->gestion
            ])->with('edit', 'Error. no se modificó el registro de hora extra.');
        }
    }

    public function eliminar_horas_extra($id)
    {
        $horas_extra = PlanillaHorasExtra::findOrFail($id);
        $horas_extra->delete();
        return response()->json(['success' => true, 'message' => "Registro eliminado exitosamente."], 200);
    }
    public function planilla_pdf($mes, $gestion, $tipo_contrato){
        $horas_extras = DB::table('planilla_horas_extras as he')
        ->join('asignacion_cargos as ac','ac.id','he.asignacion_cargo_id')
        ->join('nomina_cargos as nc','nc.id','ac.nomina_cargo_id')
        ->join('trabajadors', 'trabajadors.id', 'ac.trabajador_id')
        ->join('cargos as c', 'c.id','nc.cargo_id')
        ->join('escala_salarials as es', 'es.id','nc.escala_salarial_id')
        ->select(DB::raw('SUM(he.monto) as total'),
                DB::raw('SUM(he.cantidad) as cantidad'),
                DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"),
                'he.asignacion_cargo_id as asignacion_cargo_id',
                'nc.item as item',
                'c.nombre as nombre_cargo',
                'es.salario_mensual as salario_mensual'
                )
        ->where([
            ['he.mes', '=', $mes],
            ['he.gestion', '=', $gestion],
            ['he.tipo_contrato', '=', $tipo_contrato],
            ['ac.estado', '=', 'HABILITADO'],
        ])
        ->groupBy('he.id','nombre_completo','nc.item','c.nombre','es.salario_mensual')
        ->orderBy('nc.item')
        ->get();
        // return $horas_extras;
        return response(view('planillas.horas_extra.pdf',compact('mes', 'gestion', 'tipo_contrato','horas_extras')))
        ->header('Content-Type', 'application/pdf');
    }
}
