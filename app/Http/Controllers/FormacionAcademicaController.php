<?php

namespace App\Http\Controllers;

use App\Models\Formacion_academica;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Response;

class FormacionAcademicaController extends Controller
{
    public function listar(Request $request, $id)
    {
        if ($request->ajax()) {
            $formacion = Formacion_academica::where('trabajador_id', $id)->get();
            return DataTables::of($formacion)
                ->addColumn('action', function ($formacion) {

                    $buton_documento = '<button type="button"
                                id="ViewModalFormacion"
                                data-institucion="'.$formacion->institucion.'"
                                data-id="' . encrypt($formacion->id) . '"
                                title="Ver documento" class="btn btn-primary btn-xs">
                                Ver documento <i class="fas fa-file-pdf"></i></button> ';
                    $ver_documento = $formacion->file_formacion != '' ? $buton_documento : 'Sin Documento ';
                    $acciones = $ver_documento;
                    $acciones .= '&nbsp;&nbsp;<button type="button" title="Eliminar"
                    data-ruta="' . route('form_academica.delete',$formacion->id) . '"
                    data-table="table_formacion"
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
            'nivel_formacion' => 'required',
            'institucion' => 'required',
            'titulo_formacion' => 'required',
            'lugar_formacion' => 'required',
            'fecha_emision' => 'required',
            'trabajador_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => 'LLene todos los campos', 'values' => $validator->errors()->toArray()]);
        } else {
            $formacion_academica = (new Formacion_academica)->fill($data);
            $formacion_academica->created_by = auth()->user()->username;
            $now =  Carbon::now()->format('d-m-Y H:i:s');
            if ($request->hasFile('file_formacion')) {
                $trabajador = Trabajador::find($data['trabajador_id']);
                $carpeta = $trabajador->id;
                $extension = $request->file('file_formacion')->extension();
                $formacion_academica->file_formacion = $request->file('file_formacion')->storeAs('private/formacion_academica/' . $carpeta, $now . "." . $extension);
            } else {
                $formacion_academica->file_formacion = '';
            }
            $query = $formacion_academica->save();
            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Algo salio Mal']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Documento registrado']);
            }
        }
    }
    public function view_document($id_f)
    {
        $id = decrypt($id_f);
        $formacion_academica = Formacion_academica::find($id);
        $carpeta = $formacion_academica->trabajador_id;
        $path = $formacion_academica->file_formacion;
        // $path = 'private/formacion_academica/'.$carpeta.'/'.$file;
        if (!Storage::exists($path)) {
            abort(404);
        }
        $file = Storage::get($path);
        $type = Storage::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
        // $content = file_get_contents(storage_path('app/private/formacion_academica/'.$file));

        // return Response($content, 200, [
        //     'Content-Type' => 'application/pdf',
        //     'Content-Disposition' => "inline; filename=\"$file\""
        // ]);
    }

    public function delete($id)
    {
        $formacion_academica = Formacion_academica::find($id);
        if ($formacion_academica->file_formacion != '') {
            Storage::disk('local')->delete($formacion_academica->file_formacion);
        }
        $query = $formacion_academica->delete();
        if ($query) {
            return response()->json(['success' => true, 'message' => 'Documento eliminado exitosamente']);
        } else {
            return response()->json(['success' => false, 'message' => 'Algo salio Mal']);
        }
    }


}
