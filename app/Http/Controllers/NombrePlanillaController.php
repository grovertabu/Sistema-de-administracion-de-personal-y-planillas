<?php

namespace App\Http\Controllers;

use App\Models\NombrePlanilla;
use Illuminate\Http\Request;

class NombrePlanillaController extends Controller
{
    public function index()
    {
        $lista_planillas = NombrePlanilla::orderBy('id', 'desc')->get();
        $i = 1;
        return view('planillas.nombre_planilla.lista', compact('lista_planillas', 'i'));
    }

    public function create()
    {
        return view('planillas.nombre_planilla.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mes' => 'required',
            'gestion' => 'required',
            'nombre_planilla' => 'required',
            'fecha_creacion' => 'required',
        ]);
        $data = $request->all();
        NombrePlanilla::create($data);
        return redirect()->route('nombre_planilla.index')->with('create', true);
    }

    public function destroy($id)
    {
        $nombre_planilla = NombrePlanilla::find($id);

        $query = $nombre_planilla->delete();
        if ($query) {
            return response()->json(['success' => true, 'message' => 'Planilla eliminado exitosamente']);
        } else {
            return response()->json(['success' => false, 'message' => 'Algo salio Mal']);
        }
    }
}
