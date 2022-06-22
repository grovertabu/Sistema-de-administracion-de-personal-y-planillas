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
                    $acciones = '<button type="button"
                    id="ViewModalCurso"
                    data-id="' . encrypt($curso->id) . '"
                    title="Ver Documento del curso" class="btn btn-primary btn-xs">
                    Ver Documento <i class="fas fa-file-pdf"></i></button>';
                    $acciones .= '';
                    // $acciones .='<a title="Eliminar" href="/curso/'.$curso->id.'/delete" class="btn  btn-danger btn-sm btnEliminar" id="btnEliminar"><i class="fas fa-trash"></i></a>';
                    return $acciones;
                })->rawColumns(['action'])
                ->make(true);
        }
    }
    public function showModalPdf($id)
    {
        $html = 'ID: ' . $id;

        return response()->json(['html' => $html]);
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
        // $content = file_get_contents(storage_path('app/private/curso/'.$file));

        // return Response($content, 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => "inline; filename=\"$file\""
        // ]);
    }
}
