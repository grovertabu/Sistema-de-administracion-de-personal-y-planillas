<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUnidadOrg;
use App\Models\Estructura_Organizacional;
use App\Models\Unidad_organizacional;

class UnidadOrganizacionalController extends Controller
{
    public function index()
    {
        $unidad_organizacionals = Unidad_organizacional::orderBy('seccion', 'asc')->get();
        $i = 1;
        return view('unidad_organizacional.index', compact('unidad_organizacionals', 'i'));
    }

    public function create()
    {
        $estructura_organizacionales = Estructura_Organizacional::where('estado', 'ACTIVO')->get();
        return view('unidad_organizacional.create', compact('estructura_organizacionales'));
    }

    public function store(StoreUnidadOrg $request)
    {
        $data = $request->all();
        Unidad_organizacional::create($data);
        return redirect()->route('unidad_organizacional.index')->with('create', true);
    }

    public function edit($id)
    {
        $unidad_organizacional = Unidad_organizacional::find($id);
        $estructura_organizacionales = Estructura_Organizacional::where('estado', 'ACTIVO')->get();
        return view('unidad_organizacional.edit', compact('unidad_organizacional', 'estructura_organizacionales'));
    }

    public function update(StoreUnidadOrg $request, $id)
    {
        $un_organizacional = Unidad_organizacional::find($id);
        $data = $request->all();
        $data['estado'] = $request->estado == 'on' ? 'ACTIVO' : 'INACTIVO';
        $un_organizacional->fill($data)->save();
        return redirect()->route('unidad_organizacional.index')->with('edit', true);
    }

    public function destroy($id)
    {
        $un_organizacional = Unidad_organizacional::select('id','seccion')
        ->with(['nomina_cargos' => function($query){
            $query->select('id','unidad_organizacional_id');
        }])->findOrFail($id);
        $mensajeNominaCargos = ($un_organizacional->nomina_cargos->count() > 0) ? 'Tiene Nomina de cargos relacionados. ' : '';
        if($un_organizacional && empty($mensajeNominaCargos)){
            $un_organizacional->delete();
            return response()->json(['success'=>true,
                'message'=>"Unidad organizacional: $un_organizacional->seccion eliminado exitosamente. "],200);
        }
        return response()->json(['success'=>false,
                'message'=>"La unidad organizacional: $un_organizacional->seccion no se pudo eliminar. ".
                $mensajeNominaCargos],404);
    }
}
