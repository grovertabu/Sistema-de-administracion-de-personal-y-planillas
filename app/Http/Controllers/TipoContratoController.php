<?php

namespace App\Http\Controllers;

use App\Models\Tipo_Contrato;
use Illuminate\Http\Request;

class TipoContratoController extends Controller
{
    public function index()
    {
        $tipo_contratos = Tipo_Contrato::orderBy('id','desc')->get();
        $i=1;
        return view('tipo_contrato.index',compact('tipo_contratos','i'));
    }

    public function create()
    {
        return view('tipo_contrato.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
        ]);
        $data = $request->all();
        Tipo_Contrato::create($data);
        return redirect()->route('tipo_contrato.index')->with('create',true);
    }

    public function edit($id)
    {
        $tipo_c=Tipo_Contrato::find($id);
        return view('tipo_contrato.edit',compact('tipo_c'));
    }

    public function update(Request $request,$id)
    {
        $tipo_c=Tipo_Contrato::find($id);
        $data = $request->all();
        $data['estado']=$request->estado=='on' ? 'ACTIVO':'INACTIVO';
        $tipo_c->fill($data)->save();
        return redirect()->route('tipo_contrato.index')->with('edit',true);
    }

    public function destroy($id){

        $tipo_contrato=Tipo_Contrato::select('id','nombre')->with(['nomina_cargos' => function($query){
            $query->select('id','tipo_contrato_id');
        }])
        ->findOrFail($id);
        $mensajeNominaCargos = ($tipo_contrato->nomina_cargos->count() > 0) ? 'Tiene registros relacionados' : '';
        if($tipo_contrato && empty($mensajeNominaCargos)){
            $tipo_contrato->delete();
            return response()->json(['success'=>true, 'message'=>"Tipo Contrato: $tipo_contrato->nombre eliminado exitosamente."],200);
        }
        return response()->json(['success'=>false, 'message'=>"El tipo de Contrato: $tipo_contrato->nombre no se pudo eliminar.". $mensajeNominaCargos],404);
     }
}
