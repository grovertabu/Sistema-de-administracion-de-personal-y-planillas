<?php

namespace App\Http\Controllers;

use App\Models\ConfDescuento;
use Illuminate\Http\Request;

class ConfDescuentoController extends Controller
{
    public function index()
    {
        $conf_descuentos = ConfDescuento::orderBy('id','desc')->get();
        $i=1;
        return view('conf_planillas.conf_descuento.index',compact('conf_descuentos','i'));
    }

    public function create()
    {
        return view('conf_planillas.conf_descuento.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_descuento'=>'required',
        ]);
        $data = $request->all();
        ConfDescuento::create($data);
        return redirect()->route('conf_descuento.index')->with('create',true);
    }

    public function edit($id)
    {
        $conf_descuento=ConfDescuento::find($id);
        return view('conf_planillas.conf_descuento.edit',compact('conf_descuento'));
    }

    public function update(Request $request,$id)
    {
        $conf_descuento=ConfDescuento::find($id);
        $data = $request->all();
        $data['estado']=$request->estado=='on' ? 'HABILITADO':'INHABILITADO';
        $conf_descuento->fill($data)->save();
        return redirect()->route('conf_descuento.index')->with('edit',true);
    }

    public function destroy($id){

        $conf_descuento=ConfDescuento::findOrFail($id);
        $conf_descuento->delete();
        return response()->json(['success'=>true, 'message'=>"Descuento: $conf_descuento->nombre_descuento eliminado exitosamente."],200);
    }
}
