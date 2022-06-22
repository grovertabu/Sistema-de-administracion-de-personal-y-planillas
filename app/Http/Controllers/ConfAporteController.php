<?php

namespace App\Http\Controllers;

use App\Models\ConfAporte;
use Illuminate\Http\Request;

class ConfAporteController extends Controller
{
    public function index()
    {
        $conf_aportes = ConfAporte::orderBy('id','desc')->get();
        $i=1;
        return view('conf_planillas.conf_aporte.index',compact('conf_aportes','i'));
    }

    public function create()
    {
        return view('conf_planillas.conf_aporte.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_aporte'=>'required',
            'rango_inicial' => 'required',
            'rango_final' => 'required',
            'porcentaje_aporte' => 'required',
        ]);
        $data = $request->all();
        ConfAporte::create($data);
        return redirect()->route('conf_aporte.index')->with('create',true);
    }

    public function edit($id)
    {
        $conf_aporte=ConfAporte::find($id);
        return view('conf_planillas.conf_aporte.edit',compact('conf_aporte'));
    }

    public function update(Request $request,$id)
    {
        $conf_aporte=ConfAporte::find($id);
        $data = $request->all();
        $data['estado']=$request->estado=='on' ? 'HABILITADO':'INHABILITADO';
        $conf_aporte->fill($data)->save();
        return redirect()->route('conf_aporte.index')->with('edit',true);
    }

    public function destroy($id){

        $conf_aporte=ConfAporte::findOrFail($id);
        $conf_aporte->delete();
        return response()->json(['success'=>true, 'message'=>"Tipo Aporte: $conf_aporte->tipo_aporte eliminado exitosamente."],200);
    }
}
