<?php

namespace App\Http\Controllers;

use App\Models\ConfImpositiva;
use Illuminate\Http\Request;

class ConfImpositivaController extends Controller
{
    public function index()
    {
        $conf_impositivas = ConfImpositiva::orderBy('id','desc')->get();
        $i=1;
        return view('conf_planillas.conf_impositiva.index',compact('conf_impositivas','i'));
    }

    public function create()
    {
        return view('conf_planillas.conf_impositiva.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'salario_minimo' =>'required',
            'cantidad_salario_minimo' => 'required',
            'porcentaje_impositiva' => 'required',
        ]);
        $data = $request->all();
        ConfImpositiva::create($data);
        return redirect()->route('conf_impositiva.index')->with('create',true);
    }

    public function edit($id)
    {
        $conf_impositiva=ConfImpositiva::find($id);
        return view('conf_planillas.conf_impositiva.edit',compact('conf_impositiva'));
    }

    public function update(Request $request,$id)
    {
        $conf_impositiva=ConfImpositiva::find($id);
        $data = $request->all();
        $data['estado']=$request->estado=='on' ? 'HABILITADO':'INHABILITADO';
        $conf_impositiva->fill($data)->save();
        return redirect()->route('conf_impositiva.index')->with('edit',true);
    }

    public function destroy($id){

        $conf_impositiva=ConfImpositiva::findOrFail($id);
        $conf_impositiva->delete();
        return response()->json(['success'=>true, 'message'=>"Impositiva:".formatMoney($conf_impositiva->salario_minimo)." eliminado exitosamente."],200);
    }
}
