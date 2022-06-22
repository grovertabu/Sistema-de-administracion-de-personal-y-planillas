<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEscalaSalarial;
use App\Models\Escala_salarial;
use App\Models\Estructura_Organizacional;


class EscalaSalarialController extends Controller
{
    public function index()
    {
        $escala_salarials = Escala_salarial::orderBy('nivel', 'asc')->get();
        $i = 1;
        return view('escala_salarial.index', compact('escala_salarials', 'i'));
    }

    public function create()
    {
        $estructura_organizacionales=Estructura_Organizacional::where('estado','ACTIVO')->get();
        return view('escala_salarial.create',compact('estructura_organizacionales'));
    }

    public function store(StoreEscalaSalarial $request)
    {
        $data = $request->all();
        Escala_salarial::create($data);
        return redirect()->route('escala_salarial.index')->with('create', true);
    }

    public function edit($id)
    {
        $escala_salarial = Escala_salarial::find($id);
        $estructura_organizacionales=Estructura_Organizacional::where('estado','ACTIVO')->get();
        return view('escala_salarial.edit', compact('escala_salarial','estructura_organizacionales'));
    }

    public function update(StoreEscalaSalarial $request, $id)
    {
        $esc_salarial = Escala_salarial::find($id);
        $data = $request->all();
        $data['estado'] = $request->estado == 'on' ? 'ACTIVO' : 'INACTIVO';
        $esc_salarial->fill($data)->save();
        return redirect()->route('escala_salarial.index')->with('edit', true);
    }

    public function destroy($id)
    {
        $esc_salarial = Escala_salarial::select('id','nivel')
        ->with(['nomina_cargos' => function($query){
            $query->select('id','escala_salarial_id');
        }])->findOrFail($id);
        $mensajeNominaCargos = ($esc_salarial->nomina_cargos->count() > 0) ? 'Tiene Nomina de cargos relacionados. ' : '';
        if($esc_salarial && empty($mensajeNominaCargos)){
            $esc_salarial->delete();
            return response()->json(['success'=>true,
                'message'=>"Escala Salarial: $esc_salarial->nivel eliminado exitosamente. "],200);
        }
        return response()->json(['success'=>false,
                'message'=>"La escala salarial: $esc_salarial->nivel no se pudo eliminar. ".
                $mensajeNominaCargos],404);
    }
}
