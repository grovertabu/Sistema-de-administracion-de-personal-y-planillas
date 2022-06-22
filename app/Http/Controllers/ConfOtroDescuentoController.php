<?php

namespace App\Http\Controllers;

use App\Models\ConfOtroDescuento;
use Illuminate\Http\Request;

class ConfOtroDescuentoController extends Controller
{
    public function index()
    {
        $conf_otros_descuentos = ConfOtroDescuento::orderBy('id','desc')->get();
        $i=1;
        return view('conf_planillas.conf_otro_descuento.index',compact('conf_otros_descuentos','i'));
    }

    public function create()
    {
        return view('conf_planillas.conf_otro_descuento.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion'=>'required',
            'factor_calculado' => 'required',
        ]);
        $data = $request->all();
        ConfOtroDescuento::create($data);
        return redirect()->route('conf_otro_descuento.index')->with('create',true);
    }

    public function edit($id)
    {
        $conf_otro_descuento=ConfOtroDescuento::find($id);
        return view('conf_planillas.conf_otro_descuento.edit',compact('conf_otro_descuento'));
    }

    public function update(Request $request,$id)
    {
        $conf_otro_descuento=ConfOtroDescuento::find($id);
        $data = $request->all();
        $data['estado']=$request->estado=='on' ? 'HABILITADO':'INHABILITADO';
        $conf_otro_descuento->fill($data)->save();
        return redirect()->route('conf_otro_descuento.index')->with('edit',true);
    }

    public function destroy($id){

        $conf_otro_descuento=ConfOtroDescuento::findOrFail($id);
        $conf_otro_descuento->delete();
        return response()->json(['success'=>true, 'message'=>"Otro descuento: $conf_otro_descuento->descripcion eliminado exitosamente."],200);
    }
}
