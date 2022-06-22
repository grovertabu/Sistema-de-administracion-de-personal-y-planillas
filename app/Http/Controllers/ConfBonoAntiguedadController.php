<?php

namespace App\Http\Controllers;

use App\Models\ConfBonoAntiguedad;
use Illuminate\Http\Request;

class ConfBonoAntiguedadController extends Controller
{
    public function index()
    {
        $conf_bono_antiguedads = ConfBonoAntiguedad::orderBy('id','asc')->get();
        $i=1;
        return view('conf_planillas.conf_bono_antiguedad.index',compact('conf_bono_antiguedads','i'));
    }

    public function create()
    {
        return view('conf_planillas.conf_bono_antiguedad.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'anio_i' =>'required',
            'anio_f' => 'required',
            'porcentaje' => 'required',
        ]);
        $data = $request->all();
        ConfBonoAntiguedad::create($data);
        return redirect()->route('conf_bono_antiguedad.index')->with('create',true);
    }

    public function edit($id)
    {
        $conf_bono_antiguedad=ConfBonoAntiguedad::find($id);
        return view('conf_planillas.conf_bono_antiguedad.edit',compact('conf_bono_antiguedad'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'anio_i' =>'required',
            'anio_f' => 'required',
            'porcentaje' => 'required',
        ]);
        $conf_bono_antiguedad=ConfBonoAntiguedad::find($id);
        $data = $request->all();
        $data['estado']=$request->estado=='on' ? 'HABILITADO':'INHABILITADO';
        $conf_bono_antiguedad->fill($data)->save();
        return redirect()->route('conf_bono_antiguedad.index')->with('edit',true);
    }

    public function destroy($id){

        $conf_bono_antiguedad=ConfBonoAntiguedad::findOrFail($id);
        $conf_bono_antiguedad->delete();
        return response()->json(['success'=>true, 'message'=>"configuración de bono de antiguedad eliminado exitosamente."],200);
    }
}
