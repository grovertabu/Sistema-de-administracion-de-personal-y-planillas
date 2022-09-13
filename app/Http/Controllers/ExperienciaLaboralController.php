<?php

namespace App\Http\Controllers;

use App\Models\Experiencia_laboral;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class ExperienciaLaboralController extends Controller
{
    public function listar(Request $request, $id)
    {
        if ($request->ajax()) {
            $exp_laboral = Experiencia_laboral::select(
                'id',
                'nombre_entidad',
                'cargo_laboral',
                'funcion_laboral',
                'fecha_inicio',
                'fecha_fin',
                'file_exp_laboral'
            )->where('trabajador_id', $id)->get();

            return DataTables::of($exp_laboral)
                ->addColumn('action', function ($exp_laboral) {
                    $ver_documento=$exp_laboral->file_exp_laboral!=''?'<button type="button"
                    id="ViewModalExpLaboral"
                    data-id="' . encrypt($exp_laboral->id) . '"
                    title="Ver documento" class="btn btn-primary btn-xs">
                    Ver Documento <i class="fas fa-file-pdf"></i></button>':'Sin documento';
                    $acciones = $ver_documento;
                    $acciones .= '&nbsp;&nbsp;<button type="button" title="Eliminar"
                    data-ruta="' . route('exp_laboral.delete',$exp_laboral->id) . '"
                    data-table="table_exp_laboral"
                    class="btn btn-danger btn-sm" id="deleteDocumento"><i class="fas fa-trash"></i></button>';
                    return $acciones;
                })->rawColumns(['action'])
                ->make(true);
        }
    }

    public function registrar(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'nombre_entidad' => 'required',
            'cargo_laboral' => 'required',
            'funcion_laboral' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'trabajador_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'error' => 'LLene todos los campos',
                'values' => $validator->errors()->toArray()
            ]);
        } else {
            $exp_laboral = (new Experiencia_laboral)->fill($data);
            $now =  Carbon::now()->format('d-m-Y H:i:s');
            if ($request->hasFile('file_exp_laboral')) {
                $trabajador = Trabajador::find($data['trabajador_id']);
                $carpeta=$trabajador->id;
                $extension = $request->file('file_exp_laboral')->extension();
                $exp_laboral->file_exp_laboral = $request->file('file_exp_laboral')->storeAs('private/ExperienciaLaboral/'.$carpeta, $now . "." . $extension);
            } else {
                $exp_laboral->file_exp_laboral = '';
            }
            $query = $exp_laboral->save();
            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Algo salio Mal']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Documento registrado']);
            }
        }
    }
    public function view_document($id_d)
    {
        $id = decrypt($id_d);
        $exp_laboral=Experiencia_laboral::find($id);
        $carpeta = $exp_laboral->trabajador_id;
        $path=$exp_laboral->file_exp_laboral;
        if(!Storage::exists($path)){
            abort(404);
        }
        $content = file_get_contents(storage_path('app/'.$path));
        return Response($content, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => "inline; filename=\"$path\"",
            'Content-Transfer-Encoding' => 'binary',
            'Accept-Ranges' => 'bytes'
        ]);
    }

    public function delete($id)
    {
        $exp_laboral = Experiencia_laboral::find($id);
        if ($exp_laboral->file_exp_laboral != '') {
            Storage::disk('local')->delete($exp_laboral->file_exp_laboral);
        }
        $query = $exp_laboral->delete();
        if ($query) {
            return response()->json(['success' => true, 'message' => 'Documento eliminado exitosamente']);
        } else {
            return response()->json(['success' => false, 'message' => 'Algo salio Mal']);
        }
    }
}
