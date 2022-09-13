<?php

namespace App\Http\Controllers;

use App\Models\Trabajador;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TrabajadorController extends Controller
{
    public function index()
    {

        return view('trabajador.index');
    }
    public function listar()
    {
        $trabajador = Trabajador::orderBy('id', 'desc')->get();
        return datatables()->of($trabajador)
            ->addColumn('action', function ($trabajador) {
                $acciones = '<a title="Editar" href="trabajador/' . $trabajador->id . '/edit" class="btn  btn-warning btn-sm"><i class="fas fa-edit"></i></a>';
                $acciones .= '&nbsp;&nbsp;<a title="Eliminar" href="trabajador/' . $trabajador->id . '/delete" class="btn  btn-danger btn-sm"><i class="fas fa-trash"></i></a>';
                return $acciones;
            })->rawColumns(['action'])->make(true);
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            $viewCreate = view('trabajador.create');
            return response($viewCreate);
        }
    }

    public function mostrar(Trabajador $trabajador)
    {
        return view('trabajador.show', compact('trabajador'));
    }


    public function registrar(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'ci' => 'required',
            'nombre_trabajador' => 'required',
            'apellido_paterno' => 'required',
            'expedido' => 'required',
            'nro_asegurado' => 'required',
            'direccion' => 'required',
            'direccion' => 'required',
            'sexo' => 'required',
            'nacionalidad' => 'required',
            'fecha_nacimiento' => 'required',
            'antiguedad_anios' => 'required',
            'antiguedad_meses' => 'required',
            'antiguedad_dias' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => 'LLene todos los campos', 'values' => $validator->errors()->toArray()]);
        } else {
            $trabajador = new Trabajador();
            $trabajador->ci = $request->ci;
            $trabajador->complemento = $request->complemento == '' ? '' : $request->complemento;
            $trabajador->nombre = $request->nombre_trabajador;
            $trabajador->apellido_paterno = $request->apellido_paterno;
            $trabajador->apellido_materno = $request->apellido_materno ? $request->apellido_materno : '';
            $trabajador->expedido = $request->expedido;
            $trabajador->nro_asegurado = $request->nro_asegurado;
            $trabajador->direccion = $request->direccion;
            $trabajador->tipo_sangre = $request->tipo_sangre;
            $trabajador->celular = $request->celular;
            $trabajador->profesion = $request->profesion;
            $trabajador->telefono = $request->telefono;
            $trabajador->estado_civil = $request->estado_civil;
            $trabajador->sexo = $request->sexo;
            $trabajador->nacionalidad = $request->nacionalidad;
            $trabajador->fecha_nacimiento = $request->fecha_nacimiento;
            $trabajador->antiguedad_anios = $request->antiguedad_anios;
            $trabajador->antiguedad_meses = $request->antiguedad_meses;
            $trabajador->antiguedad_dias = $request->antiguedad_dias;
            $trabajador->estado_trabajador = 'HABILITADO';
            $now =  Carbon::now()->format('d-m-Y H:i:s');
            if ($request->hasFile('foto')) {
                $extension = $request->file('foto')->extension();
                // $folder=$request->id.' - '.$request->ci;
                $request->file('foto')->storeAs('private/avatars', $now . "." . $extension);
                $trabajador->foto = $now . '.' . $extension;
            } else {
                $trabajador->foto = '';
            }
            $query = $trabajador->save();
            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Algo salio Mal']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Nuevo trabajador registrado']);
            }
        }
    }

    public function edit(Trabajador $trabajador)
    {
        return view('trabajador.edit', compact('trabajador'));
    }

    public function update(Request $request, Trabajador $trabajador)
    {
        $validator = Validator::make($request->all(), [
            'ci' => 'required',
            'nombre_trabajador' => 'required',
            'apellido_paterno' => 'required',
            'expedido' => 'required',
            'nro_asegurado' => 'required',
            'direccion' => 'required',
            'direccion' => 'required',
            'sexo' => 'required',
            'nacionalidad' => 'required',
            'fecha_nacimiento' => 'required',
            'antiguedad_anios' => 'required',
            'antiguedad_meses' => 'required',
            'antiguedad_dias' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        } else {
            $trabajador->ci = $request->ci;
            $trabajador->complemento = $request->complemento == '' ? '' : $request->complemento;
            $trabajador->nombre = $request->nombre_trabajador;
            $trabajador->apellido_paterno = $request->apellido_paterno;
            $trabajador->apellido_materno = $request->apellido_materno ? $request->apellido_materno : '';
            $trabajador->expedido = $request->expedido;
            $trabajador->nro_asegurado = $request->nro_asegurado;
            $trabajador->direccion = $request->direccion;
            $trabajador->tipo_sangre = $request->tipo_sangre;
            $trabajador->celular = $request->celular;
            $trabajador->profesion = $request->profesion;
            $trabajador->telefono = $request->telefono;
            $trabajador->estado_civil = $request->estado_civil;
            $trabajador->sexo = $request->sexo;
            $trabajador->nacionalidad = $request->nacionalidad;
            $trabajador->fecha_nacimiento = $request->fecha_nacimiento;
            $trabajador->antiguedad_anios = $request->antiguedad_anios;
            $trabajador->antiguedad_meses = $request->antiguedad_meses;
            $trabajador->antiguedad_dias = $request->antiguedad_dias;
            $trabajador->estado_trabajador = $request->estado_trabajador != '' ? 'HABILITADO' : 'INHABILITADO';
            // return $request->estado_trabajador;
            if ($request->hasFile('foto')) {
                if ($trabajador->foto != '') {
                    Storage::disk('local')->delete('private/avatars/' . $trabajador->foto);
                }
                $now =  Carbon::now()->format('d-m-Y H:i:s');
                $extension = $request->file('foto')->extension();
                // $folder=$trabajador->id.' - '.$trabajador->ci;
                $request->file('foto')->storeAs('private/avatars', $now . "." . $extension);
                $trabajador->foto = $now . '.' . $extension;
            }
            $query = $trabajador->save();
            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Algo salio Mal']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Registro de trabajador modificado']);
            }
        }
    }
    // Visualizar la foto del perfil del trabajador
    public function view_avatar($id_bcrypt)
    {
        $id = decrypt($id_bcrypt);
        $trabajador = Trabajador::findOrFail($id);
        $avatar = $trabajador->foto;
        $path = 'private/avatars/' . $avatar;
        if (!Storage::exists($path)) {
            abort(404);
        }
        $file = Storage::get($path);
        $type = Storage::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    public function destroy($id)
    {
        $trabajador = Trabajador::find($id);

        $mensajeF = ($trabajador->formacion_academicas->count() > 0) ? 'Tiene documentos de formación académica relacionados.<br>' : '';
        $mensajeP = ($trabajador->documentos_personales->count() > 0) ? 'Tiene documentos personales relacionados.<br>' : '';
        $mensajeC = ($trabajador->cursos->count() > 0) ? 'Tiene documentos de cursos relacionados.<br>' : '';
        $mensajeExp = ($trabajador->exp_laborals->count() > 0) ? 'Tiene documentos de experiencia_laboral relacionados.<br>' : '';
        $mensajeM = ($trabajador->meritos->count() > 0) ? 'Tiene documentos de meritos relacionados.<br>' : '';
        $mensajeD = ($trabajador->demeritos->count() > 0) ? 'Tiene documentos de demeritos relacionados.<br>' : '';
        $mensajeAC = ($trabajador->asignacion_cargo->count() > 0) ? 'Tiene una asignacion de cargo relacionado.<br>' : '';
        if (
            $trabajador &&
            empty($mensajeF) &&
            empty($mensajeP) &&
            empty($mensajeC) &&
            empty($mensajeExp) &&
            empty($mensajeM) &&
            empty($mensajeD) &&
            empty($mensajeAC)
        ) {
            if ($trabajador->foto != '') {
                Storage::disk('local')->delete('private/avatars/' . $trabajador->foto);
            }
            $trabajador->delete();
            return response()->json(['success'=>true,
                'message'=>"Trabajador Con CI: $trabajador->ci eliminado exitosamente. "],200);
        }
        return response()->json(['success'=>false,
        'message'=>"El trabajador $trabajador->nombre con CI: $trabajador->ci no se pudo eliminar. <br>
         ".$mensajeF
          .$mensajeP
          .$mensajeC
          .$mensajeExp
          .$mensajeM
          .$mensajeD
          .$mensajeAC
        ],404);
    }
    public function pdf_ficha_personal($id){
        $trabajador = Trabajador::with(['formacion_academicas' => function($query){
            $query->select('id','nivel_formacion','institucion','titulo_formacion','lugar_formacion','fecha_emision','trabajador_id')
            ->where('nivel_formacion','PROFESIONAL');
        }])
        ->with(['asignacion_cargo' => function($query){
            $query->select('id','fecha_ingreso','observacion','trabajador_id','nomina_cargo_id','estado')
            ->where('estado','HABILITADO');
        }])
        ->findOrFail($id);
        $usuario =auth()->user()->roles[0]->name;
        // return $trabajador;
        return response(view('trabajador.print.ficha_personal',compact('trabajador','usuario')))
        ->header('Content-Type', 'application/pdf');
    }
}
