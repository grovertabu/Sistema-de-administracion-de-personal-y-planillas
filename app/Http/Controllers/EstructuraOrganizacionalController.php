<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEstructuraOrg;
use App\Models\Estructura_Organizacional;
use Illuminate\Http\Request;

class EstructuraOrganizacionalController extends Controller
{
    public function index()
    {
        $estructs = Estructura_Organizacional::orderBy('id', 'asc')->get();
        $i = 1;
        return view('estructura_org.index', compact('estructs', 'i'));
    }

    public function create()
    {
        return view('estructura_org.create');
    }

    public function store(StoreEstructuraOrg $request)
    {
        $data = $request->all();
        Estructura_Organizacional::create($data);
        return redirect()->route('estruct_org.index')->with('create', true);
    }

    public function edit($id)
    {
        $estructura_o = Estructura_Organizacional::find($id);
        return view('estructura_org.edit', compact('estructura_o'));
    }

    public function update(StoreEstructuraOrg $request, $id)
    {
        $estructura_o = Estructura_Organizacional::find($id);
        $data = $request->all();
        $data['estado'] = $request->estado == 'on' ? 'ACTIVO' : 'INACTIVO';
        $estructura_o->fill($data)->save();
        return redirect()->route('estruct_org.index')->with('edit', true);
    }

    public function destroy($id)
    {
        $estructura_org = Estructura_Organizacional::select('id','nombre','version')->findOrFail($id);
        $nombre_version = $estructura_org->nombre . '[' . $estructura_org->version . ']';
        $mensajeCargos = ($estructura_org->cargos->count() > 0) ? 'Tiene cargos relacionados. ' : '';
        $mensajeUnidadesOrganizacionales = ($estructura_org->unidades_organizacionales->count() > 0) ? 'Tiene unidades organizacionales relacionados. ' : '';
        $mensajeEscalasSalariales = ($estructura_org->escalas_salariales->count() > 0) ? 'Tiene escalas organizacionales relacionados. ' : '';
        if ($estructura_org && empty($mensajeCargos) && empty($mensajeUnidadesOrganizacionales) && empty($mensajeEscalasSalariales)) {
            $estructura_org->delete();
            return response()->json([
                'success' => true,
                'message' => "Estructura Organizacional : $nombre_version eliminado exitosamente. "
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => "La estructura organizacional: $nombre_version no se pudo eliminar. " .
                $mensajeCargos .
                $mensajeUnidadesOrganizacionales.
                $mensajeEscalasSalariales
        ], 404);
    }
}
