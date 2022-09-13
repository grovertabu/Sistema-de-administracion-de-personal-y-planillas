<?php

namespace App\Http\Controllers;

use App\Models\AsignacionCargo;
use App\Models\PlanillaFondoEmpleado;
use App\Models\Tipo_Contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanillaFondoEmpleadoController extends Controller
{
    public function __construct()
    {
        $this->FondoEmpleado = new PlanillaFondoEmpleado();
    }
    public function consultar_fondo_empleado()
    {
        $tipo_contratos = Tipo_Contrato::where('estado', 'ACTIVO')->get();;
        return view('planillas.fondo_empleado.consultar', compact('tipo_contratos'));
    }

    // metodo para la lista de los bonos de antiguedad
    public function lista_fondo_empleado(Request $request)
    {
        $request->validate([
            'mes' => 'required|numeric',
            'gestion' => 'required|numeric',
            'tipo_contrato' => 'required|numeric',
        ]);
        // $lista_fondo_empleado
        $mes = $request->mes;
        $gestion = $request->gestion;
        $tipo_contrato = $request->tipo_contrato;
        $lista_fondo_empleado = $this->FondoEmpleado->fondo_empleado_lista($mes, $gestion, $tipo_contrato);
        // return $lista_fondo_empleado;
        return view('planillas.fondo_empleado.lista', compact('mes', 'gestion', 'tipo_contrato', 'lista_fondo_empleado'));
    }

    public function create_all_planilla($mes, $gestion, $tipo_contrato)
    {
        return view('planillas.fondo_empleado.create_all', compact('mes', 'gestion', 'tipo_contrato'));
    }

    public function generar_planilla(Request $request)
    {
        $request->validate([
            'mes' => 'required',
            'gestion' => 'required',
            'tipo_contrato' => 'required|numeric',
            'porcentaje_fe' => 'required|numeric|min:0',
        ]);

        $tipo_contrato_id = $request->tipo_contrato;
        $mes = $request->mes;
        $gestion = $request->gestion;
        $porcentaje_fe = $request->porcentaje_fe;


        $verificar = DB::table('planilla_fondo_empleados')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato_id]
        ])->first();

        if (empty($verificar)) {
            $lista_contratos = AsignacionCargo::join('planilla_total_ganados', 'asignacion_cargos.id', 'planilla_total_ganados.asignacion_cargo_id')
                        ->where([
                            ['planilla_total_ganados.mes', '=', $mes],
                            ['planilla_total_ganados.gestion', '=', $gestion],
                            ['planilla_total_ganados.tipo_contrato', '=', $tipo_contrato_id],
                            ['asignacion_cargos.socio_fe', '=', 'SI']
                        ])->get();
                if ($lista_contratos->count() > 0) {
                    foreach ($lista_contratos as $contrato) {
                        $monto_fe = round(($contrato->total_ganado*$porcentaje_fe)/100,2);
                        $pago_deuda = 0;
                        $total_fe = $monto_fe + $pago_deuda;
                        PlanillaFondoEmpleado::create([
                            'mes' => $mes,
                            'gestion' => $gestion,
                            'tipo_contrato' => $tipo_contrato_id,
                            'porcentaje_fe' => $porcentaje_fe,
                            'total_ganado' => $contrato->total_ganado,
                            'monto_fe' => $monto_fe,
                            'pago_deuda' => $pago_deuda,
                            'total_fe' => $total_fe,
                            'asignacion_cargo_id' => $contrato->asignacion_cargo_id,
                        ]);
                    }
                    return redirect()->route(
                        'fondo_empleado.lista',
                        [
                            'tipo_contrato' => $tipo_contrato_id,
                            'mes' => $mes,
                            'gestion' => $gestion
                        ]
                    )->with('create', 'Planilla Fondo Empleados creado exitosamente');
                } else {
                    return redirect()->route(
                        'fondo_empleado.lista',
                        [
                            'tipo_contrato' => $tipo_contrato_id,
                            'mes' => $mes,
                            'gestion' => $gestion
                        ]
                    )
                        ->with('message', 'No existen registros para generar la planilla');
                }
        } else {
            return redirect()->route('fondo_empleado.lista', [
                'tipo_contrato' => $tipo_contrato_id,
                'mes' => $mes,
                'gestion' => $gestion
            ])->with('message', 'Error. Ya se tiene generada esa planilla para ese periodo');
        }
    }

    public function editar_fondo_empleado($id)
    {
        $fondo_empleado = PlanillaFondoEmpleado::find($id);

        $trabajador_cargo = AsignacionCargo::join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->join('cargos', 'cargos.id', 'nomina_cargos.cargo_id')
            ->join('trabajadors', 'trabajadors.id', 'asignacion_cargos.trabajador_id')
            ->select(
                DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"),
                'cargos.nombre as nombre_cargo',
                'nomina_cargos.item as item'
            )
            ->where('asignacion_cargos.id', $fondo_empleado->asignacion_cargo_id)->first();

        return view('planillas.fondo_empleado.edit', compact('fondo_empleado', 'trabajador_cargo'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'monto_fe' => 'required|numeric|min:0',
            'pago_deuda' => 'required|numeric|min:0',
        ]);
        $data = PlanillaFondoEmpleado::find($id);
        $monto_fe = $request->monto_fe;
        $pago_deuda = $request->pago_deuda;
        $total_fe = round(($monto_fe + $pago_deuda),2);
        $data->monto_fe = $monto_fe;
        $data->pago_deuda = $pago_deuda;
        $data->total_fe = $total_fe;
        $fondo_empleado = $data->save();
        if ($fondo_empleado) {
            return redirect()->route('fondo_empleado.lista', [
                'tipo_contrato' => $data->tipo_contrato,
                'mes' => $data->mes,
                'gestion' => $data->gestion
            ])->with('edit', 'Registro modificado exitosamente.');
        }
    }

    public function eliminar_fondo_empleado($id)
    {
        $fondo_empleado = PlanillaFondoEmpleado::find($id);
        $fondo_empleado->delete();
        return response()->json(['success' => true, 'message' => "Registro eliminado exitosamente."], 200);
    }

    public function eliminar_planilla($mes, $gestion, $tipo_contrato)
    {
        DB::table('planilla_fondo_empleados')->where([
            ['mes', '=', $mes],
            ['gestion', '=', $gestion],
            ['tipo_contrato', '=', $tipo_contrato],
        ])->delete();
        return response()->json(['success' => true, 'message' => "Planilla Otros descuentos eliminada exitosamente."], 200);
    }

    public function planilla_pdf($mes, $gestion, $tipo_contrato){

        $fondo_empleados = DB::table('planilla_fondo_empleados as fe')
        ->join('asignacion_cargos as ac','ac.id','fe.asignacion_cargo_id')
        ->join('nomina_cargos as nc','nc.id','ac.nomina_cargo_id')
        ->join('trabajadors', 'trabajadors.id', 'ac.trabajador_id')
        ->join('cargos as c', 'c.id','nc.cargo_id')
        ->join('escala_salarials as es', 'es.id','nc.escala_salarial_id')
        ->select(
                DB::raw("CONCAT(trabajadors.nombre,' ',trabajadors.apellido_paterno,' ',trabajadors.apellido_materno)  AS nombre_completo"),
                'fe.asignacion_cargo_id as asignacion_cargo_id',
                'nc.item as item',
                'c.nombre as nombre_cargo',
                'ac.sindicato as sindicalizado',
                'fe.porcentaje_fe as porcentaje_fe',
                'fe.total_ganado as total_ganado',
                'fe.monto_fe as monto_fe',
                'fe.pago_deuda as pago_deuda',
                'fe.total_fe as total_fe',
                )
        ->where([
            ['fe.mes', '=', $mes],
            ['fe.gestion', '=', $gestion],
            ['fe.tipo_contrato', '=', $tipo_contrato]
        ])
        ->orderBy('nc.item')
        ->get();
        // return $fondo_empleados->count();
        return response(view('planillas.fondo_empleado.pdf',compact('mes', 'gestion', 'tipo_contrato','fondo_empleados')))
        ->header('Content-Type', 'application/pdf');
    }
}
