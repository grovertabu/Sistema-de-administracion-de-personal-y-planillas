<?php

namespace App\Http\Controllers;

use App\Models\DocumentoPersonal;
use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class DocumentoPersonalController extends Controller
{

    public function create(Request $request,$id)
    {

        if($request->ajax()){
            $documento_personal = DocumentoPersonal::where('trabajador_id',$id)->get();
            return datatables()->of($documento_personal)
            ->addColumn('action',function($documento_personal){
            // $acciones='<button type="button" name="delete" class="btnEliminar btn btn-danger btn-sm"> Eliminar </button>';
            $acciones='<a title="Eliminar" href="/documento_personal/'.$documento_personal->id.'/delete" class="btn  btn-danger btn-sm btnEliminar" id="btnEliminar"><i class="fas fa-trash"></i></a>';
            return $acciones;
            })->rawColumns(['action'])->make(true);
        }
        return view('documento_personal.create',compact('id'));
    }
    public function registrar(Request $request){

        $data=$request->all();
        $validator = Validator::make($data,[
            'detalle_documento'=>'required',
            'tipo_documento'=>'required',
            'fecha_registro'=>'required',
            'trabajador_id'=>'required',
        ]);
        if($validator->fails()){
            return response()->json(['code'=>0,'error'=>'LLene todos los campos','values'=>$validator->errors()->toArray()]);
        }else{
            $documento_personal = (new DocumentoPersonal)->fill($data);
            $now =  Carbon::now()->format('d-m-Y H:i:s');
            if($request->hasFile('file_documento')){
                $trabajador = Trabajador::find($data['trabajador_id']);
                $carpeta=$trabajador->id;
                $extension = $request->file('file_documento')->extension();
                $documento_personal->file_documento = $request->file('file_documento')->storeAs('private/documento_personal/'.$carpeta, $now . "." . $extension);
            }
            else{
                $documento_personal->file_documento='';
            }
            $query=$documento_personal->save();
            if(!$query){
                return response()->json(['code'=>0,'msg'=>'Algo salio Mal']);
            }else{
                return response()->json(['code'=>1,'msg'=>'Documento registrado']);
            }
        }
    }
    public function view_document($id_d)
    {
        $id = decrypt($id_d);
        $documento_personal=DocumentoPersonal::find($id);
        $carpeta = $documento_personal->trabajador_id;
        $path=$documento_personal->file_documento;
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
}
