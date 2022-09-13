<?php

namespace App\Http\Controllers;

use App\Models\Merito;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class MeritoController extends Controller
{
    public function listar(Request $request, $id)
    {
        if ($request->ajax()) {
            $merito = Merito::select(
                'id',
                'detalle_merito',
                'fecha_merito',
                'file_merito'
            )->where('trabajador_id', $id)->get();


            return DataTables::of($merito)
                ->addColumn('action', function ($merito) {
                    $buton_documento='<button type="button"
                                id="ViewModalMerito"
                                data-id="' . encrypt($merito->id) . '"
                                title="Ver documento" class="btn btn-primary btn-xs">
                                Ver documento <i class="fas fa-file-pdf"></i></button> ';
                    $ver_documento= $merito->file_merito !='' ? $buton_documento : 'Sin Documento ';
                    $acciones = $ver_documento;
                    $acciones .= '&nbsp;&nbsp;<button type="button" title="Eliminar"
                    data-ruta="' . route('merito.delete',$merito->id) . '"
                    data-table="table_meritos"
                    class="btn btn-danger btn-sm" id="deleteDocumento"><i class="fas fa-trash"></i></button>';
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
            'detalle_merito' => 'required',
            'fecha_merito' => 'required',
            'trabajador_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'error' => 'LLene todos los campos',
                'values' => $validator->errors()->toArray()
            ]);
        } else {
            $merito = (new Merito)->fill($data);
            $now =  Carbon::now()->format('d-m-Y H:i:s');
            if ($request->hasFile('file_merito')) {
                $trabajador = Trabajador::find($data['trabajador_id']);
                $carpeta=$trabajador->id;
                $extension = $request->file('file_merito')->extension();
                $merito->file_merito = $request->file('file_merito')->storeAs('private/meritos/'.$carpeta, $now . "." . $extension);
            } else {
                $merito->file_merito = '';
            }
            $query = $merito->save();
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
        $merito=Merito::find($id);
        $carpeta = $merito->trabajador_id;
        $path=$merito->file_merito;
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
        $merito = Merito::find($id);
        if ($merito->file_merito != '') {
            Storage::disk('local')->delete($merito->file_merito);
        }
        $query = $merito->delete();
        if ($query) {
            return response()->json(['success' => true, 'message' => 'Documento eliminado exitosamente']);
        } else {
            return response()->json(['success' => false, 'message' => 'Algo salio Mal']);
        }
    }
}
