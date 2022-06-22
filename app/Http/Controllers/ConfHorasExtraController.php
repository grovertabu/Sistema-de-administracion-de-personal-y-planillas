<?php

namespace App\Http\Controllers;

use App\Models\ConfHorasExtra;
use Illuminate\Http\Request;

class ConfHorasExtraController extends Controller
{
    public function index()
    {
        $conf_horas_extras = ConfHorasExtra::orderBy('id','desc')->get();
        $i=1;
        return view('conf_planillas.conf_horas_extra.index',compact('conf_horas_extras','i'));
    }

    public function create()
    {
        return view('conf_planillas.conf_horas_extra.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_hora_extra'=>'required',
            'factor_calculo' => 'required',
        ]);
        $data = $request->all();
        ConfHorasExtra::create($data);
        return redirect()->route('conf_horas_extra.index')->with('create',true);
    }

    public function edit($id)
    {
        $conf_horas_extra=ConfHorasExtra::find($id);
        return view('conf_planillas.conf_horas_extra.edit',compact('conf_horas_extra'));
    }

    public function update(Request $request,$id)
    {
        $conf_horas_extra=ConfHorasExtra::find($id);
        $data = $request->all();
        $data['estado']=$request->estado=='on' ? 'HABILITADO':'INHABILITADO';
        $conf_horas_extra->fill($data)->save();
        return redirect()->route('conf_horas_extra.index')->with('edit',true);
    }

    public function destroy($id){

        $conf_horas_extra=ConfHorasExtra::findOrFail($id);
        $conf_horas_extra->delete();
        return response()->json(['success'=>true, 'message'=>"Hora Extra: $conf_horas_extra->descripcion eliminado exitosamente."],200);
    }
}
