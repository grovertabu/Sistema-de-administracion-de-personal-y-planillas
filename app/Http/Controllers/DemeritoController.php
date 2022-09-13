<?php

namespace App\Http\Controllers;

use App\Models\Demerito;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class DemeritoController extends Controller
{
    public function listar(Request $request, $id)
    {
        if ($request->ajax()) {
            $demerito = Demerito::select(
                'id',
                'detalle_demerito',
                'fecha_demerito',
                'file_demerito'
            )->where('trabajador_id', $id)->get();


            return DataTables::of($demerito)
                ->addColumn('action', function ($demerito) {
                    $buton_documento='<button type="button"
                                id="ViewModalDemerito"
                                data-id="' . encrypt($demerito->id) . '"
                                title="Ver documento" class="btn btn-primary btn-xs">
                                Ver documento <i class="fas fa-file-pdf"></i></button> ';
                    $ver_documento= $demerito->file_demerito !='' ? $buton_documento : 'Sin Documento ';
                    $acciones = $ver_documento;
                    $acciones .= '&nbsp;&nbsp;<button type="button" title="Eliminar"
                    data-ruta="' . route('demerito.delete',$demerito->id) . '"
                    data-table="table_demeritos"
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
            'detalle_demerito' => 'required',
            'fecha_demerito' => 'required',
            'trabajador_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'error' => 'LLene todos los campos',
                'values' => $validator->errors()->toArray()
            ]);
        } else {
            $demerito = (new Demerito)->fill($data);
            $now =  Carbon::now()->format('d-m-Y H:i:s');
            if ($request->hasFile('file_demerito')) {
                $trabajador = Trabajador::find($data['trabajador_id']);
                $carpeta=$trabajador->id;
                $extension = $request->file('file_demerito')->extension();
                $demerito->file_demerito = $request->file('file_demerito')->storeAs('private/demeritos/'.$carpeta, $now . "." . $extension);
            } else {
                $demerito->file_demerito = '';
            }
            $query = $demerito->save();
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
        $demerito=Demerito::find($id);
        $carpeta = $demerito->trabajador_id;
        $path=$demerito->file_demerito;
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
        $demerito = Demerito::find($id);
        if ($demerito->file_demerito != '') {
            Storage::disk('local')->delete($demerito->file_demerito);
        }
        $query = $demerito->delete();
        if ($query) {
            return response()->json(['success' => true, 'message' => 'Documento eliminado exitosamente']);
        } else {
            return response()->json(['success' => false, 'message' => 'Algo salio Mal']);
        }
    }
}
