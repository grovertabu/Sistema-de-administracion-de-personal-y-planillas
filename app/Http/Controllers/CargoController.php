<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCargo;
use App\Models\Cargo;
use App\Models\Estructura_Organizacional;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CargoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $cargo = Cargo::orderBy('id')->get();
            return datatables()->of($cargo)
            ->addColumn('estructura_organizacional', function($cargo){
                return $cargo->estructura_organizacional->nombre. '[' . $cargo->estructura_organizacional->version . ']';
            })
            ->addColumn('action',function($cargo){
                $acciones='<a title="Editar" href="cargo/'.$cargo->id.'/edit" class="btn  btn-warning btn-sm"><i class="fas fa-edit"></i></a>';
                $acciones.='&nbsp;&nbsp;<button type="button" data-id="'.$cargo->id.'" class="btn btn-danger btn-sm" id="deleteCargo"><i class="fas fa-trash"></i></button>';
                return $acciones;
            })->rawColumns(['action','estructura_organizacional'])->make(true);
        }
        return view('cargo.index');
    }

    public function create()
    {
        $estructura_organizacionales = Estructura_Organizacional::where('estado', 'ACTIVO')->get();
        return view('cargo.create', compact('estructura_organizacionales'));
    }

    public function store(StoreCargo $request)
    {
        $data = $request->all();
        Cargo::create($data);
        return redirect()->route('cargo.index')->with('create',true);
    }

    public function edit(Cargo $cargo)
    {
        $estructura_organizacionales = Estructura_Organizacional::where('estado', 'ACTIVO')->get();
        return view('cargo.edit', compact('cargo', 'estructura_organizacionales'));
    }

    public function update(StoreCargo $request,Cargo $cargo)
    {

        $data = $request->all();
        $data['estado'] = $request->estado == 'on' ? 'ACTIVO' : 'INACTIVO';
        $cargo->fill($data)->save();
        return redirect()->route('cargo.index')->with('edit',true);
    }

    public function destroy($id){
        $cargo=Cargo::select('id','nombre')
        ->with(['nomina_cargos' => function($query){
            $query->select('id','cargo_id');
        }])->findOrFail($id);
        $mensajeNominaCargos = ($cargo->nomina_cargos->count() > 0) ? 'Tiene Nomina de cargos relacionados. ' : '';
        if($cargo && empty($mensajeNominaCargos)){
            $cargo->delete();
            return response()->json(['success'=>true,
                'message'=>"Cargo: $cargo->nombre eliminado exitosamente. "],200);
        }
        return response()->json(['success'=>false,
                'message'=>"El cargo: $cargo->nombre no se pudo eliminar. ".
                $mensajeNominaCargos],404);

     }
}
