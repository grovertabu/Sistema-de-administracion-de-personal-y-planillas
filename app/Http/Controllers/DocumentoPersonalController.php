<?php

namespace App\Http\Controllers;

use App\Models\DocumentoPersonal;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Response;

class DocumentoPersonalController extends Controller
{
    public function listar(Request $request, $id)
    {
        if ($request->ajax()) {
            $documento_personal = DocumentoPersonal::where('trabajador_id', $id)->get();
            return DataTables::of($documento_personal)
                ->addColumn('action', function ($documento_personal) {
                    $buton_documento='<button type="button"
                                id="ViewModalDocumentoPersonal"
                                data-id="' . encrypt($documento_personal->id) . '"
                                title="Ver documento" class="btn btn-primary btn-xs">
                                Ver documento <i class="fas fa-file-pdf"></i></button> ';
                    $ver_documento= $documento_personal->file_documento !='' ? $buton_documento : 'Sin Documento ';
                    $acciones = $ver_documento;
                    $acciones .= '&nbsp;&nbsp;<button type="button" title="Eliminar"
                    data-ruta="' . route('documento_personal.delete',$documento_personal->id) . '"
                    data-table="table_documento_personals"
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
            'detalle_documento' => 'required',
            'fecha_registro' => 'required',
            'tipo_documento' => 'required',
            'trabajador_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'error' => 'LLene todos los campos',
                'values' => $validator->errors()->toArray()
            ]);
        } else {
            $documento_personal = (new DocumentoPersonal())->fill($request->all());
            $now = Carbon::now()->format('d-m-Y H:i:s');
            if ($request->hasFile('file_documento')) {
                $trabajador = Trabajador::find($data['trabajador_id']);
                $carpeta = $trabajador->id;
                $extension = $request->file('file_documento')->extension();
                $documento_personal->file_documento = $request->file('file_documento')->storeAs('private/documentos/' . $carpeta, $now . "." . $extension);
            } else {
                $documento_personal->file_documento = '';
            }
            $documento_personal->created_by = Auth()->user()->username;
            $query = $documento_personal->save();
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
        $documento_personal = DocumentoPersonal::find($id);
        $carpeta = $documento_personal->trabajador_id;
        $path = $documento_personal->file_documento;
        // $path = 'private/curso/'.$carpeta.'/'.$file;
        if (!Storage::exists($path)) {
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

    public function delete($id)
    {
        $documento_personal = DocumentoPersonal::find($id);
        if ($documento_personal->file_documento != '') {
            Storage::disk('local')->delete($documento_personal->file_documento);
        }
        $query = $documento_personal->delete();
        if ($query) {
            return response()->json(['success' => true, 'message' => 'Documento eliminado exitosamente']);
        } else {
            return response()->json(['success' => false, 'message' => 'Algo salio Mal']);
        }
    }
}
