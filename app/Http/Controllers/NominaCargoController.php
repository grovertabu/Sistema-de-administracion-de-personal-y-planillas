<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Escala_salarial;
use App\Models\NominaCargo;
use App\Models\Tipo_Contrato;
use App\Models\Unidad_organizacional;
use Illuminate\Http\Request;

class NominaCargoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $nomina_cargo = NominaCargo::orderBy('item')->get();
            return datatables()->of($nomina_cargo)
                ->addColumn('unidad_organizacional', function ($nomina_cargo) {
                    return $nomina_cargo->item;
                })
                ->addColumn('unidad_organizacional', function ($nomina_cargo) {
                    return $nomina_cargo->unidad_organizacional->seccion;
                })
                ->addColumn('cargo', function ($nomina_cargo) {
                    return strtoupper($nomina_cargo->cargo->nombre);
                })
                ->addColumn('escala_salarial_nivel', function ($nomina_cargo) {
                    return $nomina_cargo->escala_salarial->nivel;
                })
                ->addColumn('escala_salarial_salario_mensual', function ($nomina_cargo) {
                    return number_format($nomina_cargo->escala_salarial->salario_mensual, 2, ",", ".");
                })
                ->addColumn('tipo_contrato', function ($nomina_cargo) {
                    return $nomina_cargo->tipo_contrato->nombre;
                })
                ->addColumn('action', function ($nomina_cargo) {
                    // $acciones = '<a title="Editar" href="nomina-cargos/' . $nomina_cargo->id . '/edit" class="btn  btn-warning btn-sm"><i class="fas fa-edit"></i></a>';
                    $acciones = '&nbsp;&nbsp;<button type="button" data-id="'.$nomina_cargo->id.'"
                    class="btn btn-danger btn-sm" title="Eliminar"
                    id="deleteNominaCargo">
                    <i class="fas fa-trash"></i>
                    </button>';
                    return $acciones;
                })->rawColumns(['action'])->make(true);
        }
        return view('nomina_cargo.index');
    }

    public function create()
    {
        $tipo_contratos = Tipo_Contrato::where('estado', 'ACTIVO')->get();
        $unidades_organizacionales = Unidad_organizacional::where('estado', 'ACTIVO')->get();
        $cargos = Cargo::where('estado', 'ACTIVO')->get();
        $escalas_salariales = Escala_salarial::where('estado', 'ACTIVO')->get();
        return view('nomina_cargo.create', compact( 'tipo_contratos',
                                                    'unidades_organizacionales',
                                                    'cargos',
                                                    'escalas_salariales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_contrato_id'=>'required',
            'unidad_organizacional_id'=>'required',
            'cargo_id'=>'required',
            'escala_salarial_id'=>'required',
        ]);
        $data = $request->all();
        NominaCargo::create($data);
        return redirect()->route('nomina_cargo.index')->with('create', true);
    }

    public function edit(NominaCargo $nomina_cargo)
    {

        $tipo_contratos = Tipo_Contrato::where('estado', 'ACTIVO')->get();
        $unidades_organizacionales = Unidad_organizacional::where('estado', 'ACTIVO')->get();
        $cargos = Cargo::where('estado', 'ACTIVO')->get();
        $escalas_salariales = Escala_salarial::where('estado', 'ACTIVO')->get();
        return view('nomina_cargo.edit',
                    compact('nomina_cargo',
                        'tipo_contratos',
                        'unidades_organizacionales',
                        'cargos',
                        'escalas_salariales'));
    }

    public function update(Request $request, NominaCargo $nomina_cargo)
    {
        $request->validate([
            'tipo_contrato_id'=>'required',
            'unidad_organizacional_id'=>'required',
            'cargo_id'=>'required',
            'escala_salarial_id'=>'required',
        ]);
        $data = $request->all();
        if($data['tipo_contrato_id']!=1){
            $data['item']=null;
        }
        $nomina_cargo->fill($data)->save();
        return redirect()->route('nomina_cargo.index')->with('edit',true);
        // return  $request;
    }

    public function destroy($id)
    {
        $nomina_cargo = NominaCargo::select('id','item')
        ->with(['asignacion_cargo' => function($query){
            $query->select('id','nomina_cargo_id');
        }])->findOrFail($id);
        $mensajeNominaCargo = ($nomina_cargo->asignacion_cargo->count() > 0) ? 'Tiene Asignacion cargo relacionado.</b> ' : '';
        if ($nomina_cargo && empty($mensajeNominaCargo)) {
            $nomina_cargo->delete();
            return response()->json(['success'=>true,
                'message'=>"<b>Cargo: $nomina_cargo->id eliminado exitosamente.</b> "],200);
        }
        return response()->json(['success'=>false,
                'message'=>"<b>El cargo: $nomina_cargo->id no se pudo eliminar. ".
                $mensajeNominaCargo],200);

    }
    public function existItem(Request $request)
    {
        $item = $request->item;
        $conditions = [];
        array_push($conditions, ['item', '=', $item]);
        array_push($conditions, ['estado', '<>', 'INHABILITADO']);
        $nomina_cargo = NominaCargo::where($conditions)->first();
        if($nomina_cargo){
            return response(['success'=>true,
                        'data'=>$nomina_cargo,
                        'message'=>'El item: '.$nomina_cargo->item.' ya existe'],200);
        }
        else{
            return response(['success'=>false],200);
        }
    }
}
