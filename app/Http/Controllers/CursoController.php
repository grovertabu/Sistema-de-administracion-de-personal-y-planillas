<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Curso;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class CursoController extends Controller
{
    public function listar(Request $request, $id)
    {
        if ($request->ajax()) {
            $curso = Curso::select(
                'id',
                'nombre_curso',
                'institucion',
                'horas_academicas',
                'fecha_curso',
                'file_curso'
            )->where('trabajador_id', $id)->get();
            return DataTables::of($curso)
                ->addColumn('action', function ($curso) {
                    $buton_documento='<button type="button"
                                id="ViewModalCurso"
                                data-id="' . encrypt($curso->id) . '"
                                title="Ver documento" class="btn btn-primary btn-xs">
                                Ver documento <i class="fas fa-file-pdf"></i></button> ';
                    $ver_documento= $curso->file_curso !='' ? $buton_documento : 'Sin Documento ';
                    $acciones = $ver_documento;
                    $acciones .= '&nbsp;&nbsp;<button type="button" title="Eliminar"
                    data-ruta="' . route('curso.delete',$curso->id) . '"
                    data-table="table_cursos"
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
            'nombre_curso' => 'required',
            'institucion' => 'required',
            'horas_academicas' => 'required',
            'fecha_curso' => 'required',
            'trabajador_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'error' => 'LLene todos los campos',
                'values' => $validator->errors()->toArray()
            ]);
        } else {
            $curso = (new Curso())->fill($request->all());
            $now =  Carbon::now()->format('d-m-Y H:i:s');
            if ($request->hasFile('file_curso')) {
                $trabajador = Trabajador::find($data['trabajador_id']);
                $carpeta=$trabajador->id;
                $extension = $request->file('file_curso')->extension();
                $curso->file_curso = $request->file('file_curso')->storeAs('private/cursos/'.$carpeta, $now . "." . $extension);
            } else {
                $curso->file_curso = '';
            }
            $curso->created_by = Auth()->user()->username;
            $query = $curso->save();
            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Algo salio Mal']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Documento registrado']);
            }
        }
    }
    public function view_document($id_c)
    {
        $id = decrypt($id_c);
        $curso=Curso::find($id);
        $carpeta = $curso->trabajador_id;
        $path=$curso->file_curso;
        // $path = 'private/curso/'.$carpeta.'/'.$file;
        if(!Storage::exists($path)){
            abort(404);
        }
        $file = Storage::get($path);
        $type = Storage::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    public function delete($id)
    {
        $curso = Curso::find($id);
        if ($curso->file_curso != '') {
            Storage::disk('local')->delete($curso->file_curso);
        }
        $query = $curso->delete();
        if ($query) {
            return response()->json(['success' => true, 'message' => 'Documento eliminado exitosamente']);
        } else {
            return response()->json(['success' => false, 'message' => 'Algo salio Mal']);
        }
    }
}
