<?php

namespace App\Http\Controllers;

use App\Models\AsignacionCargo;
use App\Models\NominaCargo;
use Illuminate\Support\Facades\Validator;
use App\Models\Trabajador;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AsignacionCargoController extends Controller
{
    public function __construct()
    {
        $this->AsignacionCargo = new AsignacionCargo();
    }
    public function lista_items(Request $request)
    {
        if ($request->ajax()) {
            // asignacion_cargo = $this->AsignacionCargo->getData(tipo_contrato)
            $asignacion_cargo = $this->AsignacionCargo->getData(1);
            return DataTables::of($asignacion_cargo)
                ->addColumn('item', function ($asignacion_cargo) {
                    return $asignacion_cargo->nomina_cargo->item;
                })
                ->addColumn('trabajador_ci', function ($asignacion_cargo) {
                    return $asignacion_cargo->trabajador->ci;
                })
                ->addColumn('trabajador_nombre', function ($asignacion_cargo) {
                    return mb_strtoupper($asignacion_cargo->trabajador->nombre . '<br>' .
                        $asignacion_cargo->trabajador->apellido_paterno . ' ' .
                        $asignacion_cargo->trabajador->apellido_materno);
                })
                ->addColumn('cargo', function ($asignacion_cargo) {
                    return strtoupper($asignacion_cargo->nomina_cargo->cargo->nombre);
                })
                ->addColumn('salario', function ($asignacion_cargo) {
                    return number_format($asignacion_cargo->nomina_cargo->escala_salarial->salario_mensual, 2, ",", ".");
                })
                ->rawColumns(['trabajador_nombre'])->make(true);
        }
        return view('asignacion_cargo.item.index');
    }
    // Por medio de una peticion ajar llama al la funcion del controlador Create para renderizar
    // la vista en un modal mandando los registros de los trabajadores y las nominas siempre y cuando cuenten una asignacion
    public function crear_item(Request $request)
    {
        if ($request->ajax()) {
            $trabajadores = Trabajador::select('id', 'ci', 'nombre', 'apellido_paterno', 'apellido_materno')
                ->where('estado_trabajador', 'HABILITADO')
                ->whereNotIn('id', function ($query) {
                    $query->select('trabajador_id')->from('asignacion_cargos')->where('estado', 'HABILITADO');
                })->get();
            $nomina_cargos = NominaCargo::where('estado', 'LIBRE')
                ->where('tipo_contrato_id', 1)
                ->whereNotIn('id', function ($query) {
                    $query->select('nomina_cargo_id')->from('asignacion_cargos')->where('estado', 'HABILITADO');
                })->get();
            $viewCreate = view('asignacion_cargo.item.create', compact('trabajadores', 'nomina_cargos'));
            return response($viewCreate);
        }
    }
    // Registrar la asignacion de un cargo
    public function registrar_item(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'trabajador_id' => 'required',
            'nomina_cargo_id' => 'required',
            'fecha_ingreso' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'error' => 'LLene todos los campos',
                'values' => $validator->errors()->toArray()
            ]);
        } else {
            // si ya esta dentro de la asignacion obtener la fecha de ingreso
            // $search_cargo = AsignacionCargo::where('trabajador_id', $data['trabajador_id'])
            //     ->orderBy('fecha_ingreso')->first();
            // if ($search_cargo->fecha_ingreso) {
            //     $data['fecha_nuevo_cargo'] = $data['fecha_ingreso'];
            //     $data['fecha_ingreso'] = $search_cargo->fecha_ingreso;
            // }
            $query = AsignacionCargo::create($data);
            $nomina_cargo_id = $data['nomina_cargo_id'];
            $nomina_cargo = NominaCargo::find($nomina_cargo_id);
            $nomina_cargo->estado = 'OCUPADO';
            $queryNomina = $nomina_cargo->save();

            if (!$query && $queryNomina) {
                return response()->json(['code' => 0, 'msg' => 'Algo salio Mal']);
            } else {

                return response()->json(['code' => 1, 'msg' => 'Nuevo Item registrado']);
            }
        }
    }
    // VIsta para modificar solo alguna informacion de la asignacion de un item
    public function editar_item(Request $request, $id)
    {
        if ($request->ajax()) {
            $item = AsignacionCargo::find($id);
            if ($item) {
                $viewEditarItem = view('asignacion_cargo.item.edit', compact('item'));
                return response($viewEditarItem);
            } else {
                return response(abort(404));
            }
        }
    }
    // Actualizar Un item
    public function actualizar_item(Request $request, $id)
    {

        $data = $request->all();
        $validator = Validator::make($data, [
            'fecha_ingreso' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'error' => 'LLene todos los campos',
                'values' => $validator->errors()->toArray()
            ]);
        } else {
            $query = AsignacionCargo::find($id)->update($data);
            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'No existe Item.']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Item Modificado.']);
            }
        }
    }

    public function form_cambiar_item(Request $request, $id)
    {
        if ($request->ajax()) {
            $item = AsignacionCargo::find($id);
            if ($item) {
                $nomina_cargos = NominaCargo::where('estado', 'LIBRE')
                    ->whereNotIn('id', function ($query) {
                        $query->select('nomina_cargo_id')->from('asignacion_cargos')->where('estado', 'HABILITADO');
                    })->get();
                $viewEditarItem = view('asignacion_cargo.item.change', compact('item', 'nomina_cargos'));
                return response($viewEditarItem);
            } else {
                return response(abort(404));
            }
        }
    }

    // Cambiar item
    public function cambiar_item(Request $request, $id)
    {
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'fecha_ingreso' => 'required',
                'fecha_conclusion' => 'required',
                'nomina_cargo_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'LLene todos los campos',
                    'values' => $validator->errors()->toArray()
                ]);
            } else {
                DB::beginTransaction();
                $itemAnterior = AsignacionCargo::find($id);
                $item_id = $itemAnterior->id;
                $old_nomina_cargo_id = $itemAnterior->nomina_cargo_id;
                $trabajador_id = $itemAnterior->trabajador_id;
                $itemAnterior->fecha_conclusion = $data['fecha_conclusion'];
                $itemAnterior->estado = 'INHABILITADO';
                $itemAnterior->save();
                // Cambiar a libre cargo anterior
                $cargoAnterior = NominaCargo::find($old_nomina_cargo_id);
                $cargoAnterior->estado = "LIBRE";
                $cargoAnterior->save();
                // crear nuevo item y cambiar el estado del nuevo cargo a OCUPADO
                // si ya esta dentro de la asignacion obtener la fecha de ingreso
                $search_cargo = AsignacionCargo::where('trabajador_id', $trabajador_id)
                ->orderBy('fecha_ingreso')->first();
                if ($search_cargo->fecha_ingreso) {
                    $data['fecha_nuevo_cargo'] = $data['fecha_ingreso'];
                    $data['fecha_ingreso'] = $search_cargo->fecha_ingreso;
                }
                $nuevoItem = AsignacionCargo::create([
                    'trabajador_id' => $trabajador_id,
                    'nomina_cargo_id' => (int)$data['nomina_cargo_id'],
                    'fecha_ingreso' => $data['fecha_ingreso'],
                    'fecha_nuevo_cargo' => $data['fecha_nuevo_cargo'],
                    'aporte_afp' => $data['aporte_afp'],
                    'sindicato' => $data['sindicato'],
                    'socio_fe' => $data['socio_fe'],
                    'estado' => 'HABILITADO',
                ]);
                $nuevoCargo = NominaCargo::find($data['nomina_cargo_id']);
                $nuevoCargo->estado = 'OCUPADO';
                $nuevoCargo->save();
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Item nro ' . $item_id . ' Modificado.',
                    'data' => $nuevoItem
                ], 200);
            }
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return response('Not Found', 404)->header('Content-Type', 'application/json');
        }
    }
    // DAR DE BAJA UN ITEM
    public function dar_baja_item(Request $request, $id)
    {
        if ($request->ajax()) {
            $item = AsignacionCargo::find($id);
            if ($item) {
                $viewCancelItem = view('asignacion_cargo.item.cancel', compact('item',));
                return response($viewCancelItem);
            } else {
                return response(abort(404));
            }
        }
    }

    // Cambiar item
    public function baja_item(Request $request, $id)
    {
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'fecha_conclusion' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'LLene los campos requeridos.',
                    'values' => $validator->errors()->toArray()
                ]);
            } else {
                DB::beginTransaction();
                $itemAnterior = AsignacionCargo::find($id);
                $item_id = $itemAnterior->id;
                $old_nomina_cargo_id = $itemAnterior->nomina_cargo_id;
                $trabajador_id = $itemAnterior->trabajador_id;
                $itemAnterior->fecha_conclusion = $data['fecha_conclusion'];
                $itemAnterior->motivo_baja = $data['motivo_baja'];
                $itemAnterior->estado = 'INHABILITADO';
                $itemAnterior->save();
                // Cambiar a libre cargo anterior
                $cargoAnterior = NominaCargo::find($old_nomina_cargo_id);
                $cargoAnterior->estado = "LIBRE";
                $cargoAnterior->save();
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Item nro ' . $item_id . ' dado de Baja.'
                ], 200);
            }
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return response('Not Found', 404)->header('Content-Type', 'application/json');
        }
    }
    // **********************CONSULTORES*******************************
    public function lista_Consultores(Request $request)
    {
        if ($request->ajax()) {
            // asignacion_cargo = $this->AsignacionCargo->getData(tipo_contrato)
            $asignacion_cargo = $this->AsignacionCargo->getData(2);
            return DataTables::of($asignacion_cargo)
                ->addColumn('trabajador_ci', function ($asignacion_cargo) {
                    return $asignacion_cargo->trabajador->ci;
                })
                ->addColumn('trabajador_nombre', function ($asignacion_cargo) {
                    return mb_strtoupper($asignacion_cargo->trabajador->nombre . '<br>' .
                        $asignacion_cargo->trabajador->apellido_paterno . ' ' .
                        $asignacion_cargo->trabajador->apellido_materno);
                })
                ->addColumn('cargo', function ($asignacion_cargo) {
                    return strtoupper($asignacion_cargo->nomina_cargo->cargo->nombre);
                })
                ->addColumn('salario', function ($asignacion_cargo) {
                    return number_format($asignacion_cargo->nomina_cargo->escala_salarial->salario_mensual, 2, ",", ".");
                })
                ->rawColumns(['trabajador_nombre'])->make(true);
        }
        return view('asignacion_cargo.consultor.index');
    }
    // Por medio de una peticion ajar llama al la funcion del controlador Create para renderizar
    // la vista en un modal mandando los registros de los trabajadores y las nominas siempre y cuando cuenten una asignacion
    public function crear_consultor(Request $request)
    {
        if ($request->ajax()) {
            $trabajadores = Trabajador::select('id', 'ci', 'nombre', 'apellido_paterno', 'apellido_materno')
                ->where('estado_trabajador', 'HABILITADO')
                ->whereNotIn('id', function ($query) {
                    $query->select('trabajador_id')->from('asignacion_cargos')->where('estado', 'HABILITADO');
                })->get();
            $nomina_cargos = NominaCargo::where('estado', 'LIBRE')
                ->where('tipo_contrato_id', 2)
                ->whereNotIn('id', function ($query) {
                    $query->select('nomina_cargo_id')->from('asignacion_cargos')->where('estado', 'HABILITADO');
                })->get();
            $viewCreate = view('asignacion_cargo.consultor.create', compact('trabajadores', 'nomina_cargos'));
            return response($viewCreate);
        }
    }
    // Registrar la asignacion de un cargo
    public function registrar_consultor(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'trabajador_id' => 'required',
            'nomina_cargo_id' => 'required',
            'fecha_ingreso' => 'required',
            'fecha_conclusion' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'error' => 'LLene todos los campos',
                'values' => $validator->errors()->toArray()
            ]);
        } else {
            $query = AsignacionCargo::create($data);
            $nomina_cargo_id = $data['nomina_cargo_id'];
            $nomina_cargo = NominaCargo::find($nomina_cargo_id);
            $nomina_cargo->estado = 'OCUPADO';
            $queryNomina = $nomina_cargo->save();
            if (!$query && $queryNomina) {
                return response()->json(['code' => 0, 'msg' => 'Algo salio Mal']);
            } else {

                return response()->json(['code' => 1, 'msg' => 'Nuevo Consultor registrado']);
            }
        }
    }
    // VIsta para modificar solo alguna informacion de la asignacion de un consultor
    public function editar_consultor(Request $request, $id)
    {
        if ($request->ajax()) {
            $consultor = AsignacionCargo::find($id);
            if ($consultor) {
                $viewEditarConsultor = view('asignacion_cargo.consultor.edit', compact('consultor'));
                return response($viewEditarConsultor);
            } else {
                return response(abort(404));
            }
        }
    }
    // Actualizar Un consultor
    public function actualizar_consultor(Request $request, $id)
    {

        $data = $request->all();
        $validator = Validator::make($data, [
            'fecha_ingreso' => 'required',
            'fecha_conclusion' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'error' => 'LLene todos los campos',
                'values' => $validator->errors()->toArray()
            ]);
        } else {
            $query = AsignacionCargo::find($id)->update($data);
            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'No existe consultor.']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Consultor Modificado.']);
            }
        }
    }

    public function form_cambiar_consultor(Request $request, $id)
    {
        if ($request->ajax()) {
            $consultor = AsignacionCargo::find($id);
            if ($consultor) {
                $nomina_cargos = NominaCargo::where('estado', 'LIBRE')
                    ->where('tipo_contrato_id', 2)
                    ->whereNotIn('id', function ($query) {
                        $query->select('nomina_cargo_id')->from('asignacion_cargos')->where('estado', 'HABILITADO');
                    })->get();
                $viewChangeConsultor = view('asignacion_cargo.consultor.change', compact('consultor', 'nomina_cargos'));
                return response($viewChangeConsultor);
            } else {
                return response(abort(404));
            }
        }
    }

    // Cambiar consultor
    public function cambiar_consultor(Request $request, $id)
    {
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'fecha_ingreso' => 'required',
                'fecha_conclusion' => 'required',
                'fecha_conclusion_antiguo' => 'required',
                'nomina_cargo_id' => 'required',
                'observacion' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'LLene todos los campos',
                    'values' => $validator->errors()->toArray()
                ]);
            } else {
                DB::beginTransaction();
                $consultorAnterior = AsignacionCargo::find($id);
                $consultor_id = $consultorAnterior->id;
                $old_nomina_cargo_id = $consultorAnterior->nomina_cargo_id;
                $trabajador_id = $consultorAnterior->trabajador_id;
                $consultorAnterior->fecha_conclusion = $data['fecha_conclusion_antiguo'];
                $consultorAnterior->estado = 'INHABILITADO';
                $consultorAnterior->save();
                // Cambiar a libre cargo anterior
                $cargoAnterior = NominaCargo::find($old_nomina_cargo_id);
                $cargoAnterior->estado = "LIBRE";
                $cargoAnterior->save();
                // crear nuevo consultor y cambiar el estado del nuevo cargo a OCUPADO
                $nuevoConsultor = AsignacionCargo::create([
                    'trabajador_id' => $trabajador_id,
                    'nomina_cargo_id' => (int)$data['nomina_cargo_id'],
                    'fecha_ingreso' => $data['fecha_ingreso'],
                    'fecha_conclusion' => $data['fecha_conclusion'],
                    'estado' => 'HABILITADO',
                ]);
                $nuevoCargo = NominaCargo::find($data['nomina_cargo_id']);
                $nuevoCargo->estado = 'OCUPADO';
                $nuevoCargo->save();
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Consultor nro ' . $consultor_id . ' Modificado.',
                    'data' => $nuevoConsultor
                ], 200);
            }
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return response('Not Found', 404)->header('Content-Type', 'application/json');
        }
    }
    // DAR DE BAJA UN Consultor
    public function dar_baja_consultor(Request $request, $id)
    {
        if ($request->ajax()) {
            $consultor = AsignacionCargo::find($id);
            if ($consultor) {
                $viewCancelConsultor = view('asignacion_cargo.consultor.cancel', compact('consultor',));
                return response($viewCancelConsultor);
            } else {
                return response(abort(404));
            }
        }
    }

    // Cambiar item
    public function baja_consultor(Request $request, $id)
    {
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'fecha_conclusion' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'LLene los campos requeridos.',
                    'values' => $validator->errors()->toArray()
                ]);
            } else {
                DB::beginTransaction();
                $consultorAnterior = AsignacionCargo::find($id);
                $consultor_id = $consultorAnterior->id;
                $old_nomina_cargo_id = $consultorAnterior->nomina_cargo_id;
                $consultorAnterior->fecha_conclusion = $data['fecha_conclusion'];
                $consultorAnterior->motivo_baja = $data['motivo_baja'];
                $consultorAnterior->estado = 'INHABILITADO';
                $consultorAnterior->save();
                // Cambiar a libre cargo anterior
                $cargoAnterior = NominaCargo::find($old_nomina_cargo_id);
                $cargoAnterior->estado = "LIBRE";
                $cargoAnterior->save();
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Consultor nro ' . $consultor_id . ' dado de Baja.'
                ], 200);
            }
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return response('Not Found', 404)->header('Content-Type', 'application/json');
        }
    }

    // **********************EVENTUALES*******************************
    public function lista_eventuales(Request $request)
    {
        if ($request->ajax()) {
            // asignacion_cargo = $this->AsignacionCargo->getData(tipo_contrato)
            $asignacion_cargo = $this->AsignacionCargo->getData(3);
            return DataTables::of($asignacion_cargo)
                ->addColumn('trabajador_ci', function ($asignacion_cargo) {
                    return $asignacion_cargo->trabajador->ci;
                })
                ->addColumn('trabajador_nombre', function ($asignacion_cargo) {
                    return mb_strtoupper($asignacion_cargo->trabajador->nombre . '<br>' .
                        $asignacion_cargo->trabajador->apellido_paterno . ' ' .
                        $asignacion_cargo->trabajador->apellido_materno);
                })
                ->addColumn('cargo', function ($asignacion_cargo) {
                    return strtoupper($asignacion_cargo->nomina_cargo->cargo->nombre);
                })
                ->addColumn('salario', function ($asignacion_cargo) {
                    return number_format($asignacion_cargo->nomina_cargo->escala_salarial->salario_mensual, 2, ",", ".");
                })
                ->rawColumns(['trabajador_nombre'])->make(true);
        }
        return view('asignacion_cargo.eventual.index');
    }
    // Por medio de una peticion ajar llama al la funcion del controlador Create para renderizar
    // la vista en un modal mandando los registros de los trabajadores y las nominas siempre y cuando cuenten una asignacion
    public function crear_eventual(Request $request)
    {
        if ($request->ajax()) {
            $trabajadores = Trabajador::select('id', 'ci', 'nombre', 'apellido_paterno', 'apellido_materno')
                ->where('estado_trabajador', 'HABILITADO')
                ->whereNotIn('id', function ($query) {
                    $query->select('trabajador_id')->from('asignacion_cargos')->where('estado', 'HABILITADO');
                })->get();
            $nomina_cargos = NominaCargo::where('estado', 'LIBRE')
                ->where('tipo_contrato_id', 3)
                ->whereNotIn('id', function ($query) {
                    $query->select('nomina_cargo_id')->from('asignacion_cargos')->where('estado', 'HABILITADO');
                })->get();
            $viewCreate = view('asignacion_cargo.eventual.create', compact('trabajadores', 'nomina_cargos'));
            return response($viewCreate);
        }
    }
    // Registrar la asignacion de un cargo
    public function registrar_eventual(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'trabajador_id' => 'required',
            'nomina_cargo_id' => 'required',
            'fecha_ingreso' => 'required',
            'fecha_conclusion' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'error' => 'LLene todos los campos',
                'values' => $validator->errors()->toArray()
            ]);
        } else {
            $query = AsignacionCargo::create($data);
            $nomina_cargo_id = $data['nomina_cargo_id'];
            $nomina_cargo = NominaCargo::find($nomina_cargo_id);
            $nomina_cargo->estado = 'OCUPADO';
            $queryNomina = $nomina_cargo->save();
            if (!$query && $queryNomina) {
                return response()->json(['code' => 0, 'msg' => 'Algo salio Mal']);
            } else {

                return response()->json(['code' => 1, 'msg' => 'Nuevo Eventual registrado']);
            }
        }
    }
    // VIsta para modificar solo alguna informacion de la asignacion de un Eventual
    public function editar_eventual(Request $request, $id)
    {
        if ($request->ajax()) {
            $eventual = AsignacionCargo::find($id);
            if ($eventual) {
                $viewEditarEventual = view('asignacion_cargo.eventual.edit', compact('eventual'));
                return response($viewEditarEventual);
            } else {
                return response(abort(404));
            }
        }
    }
    // Actualizar Un Eventual
    public function actualizar_eventual(Request $request, $id)
    {

        $data = $request->all();
        $validator = Validator::make($data, [
            'fecha_ingreso' => 'required',
            'fecha_conclusion' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 0,
                'error' => 'LLene todos los campos',
                'values' => $validator->errors()->toArray()
            ]);
        } else {
            $query = AsignacionCargo::find($id)->update($data);
            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'No existe Trabajador Eventual.']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Eventual Modificado.']);
            }
        }
    }

    public function form_cambiar_eventual(Request $request, $id)
    {
        if ($request->ajax()) {
            $eventual = AsignacionCargo::find($id);
            if ($eventual) {
                $nomina_cargos = NominaCargo::where('estado', 'LIBRE')
                    ->where('tipo_contrato_id', 3)
                    ->whereNotIn('id', function ($query) {
                        $query->select('nomina_cargo_id')->from('asignacion_cargos')->where('estado', 'HABILITADO');
                    })->get();
                $viewChangeEventual = view('asignacion_cargo.eventual.change', compact('eventual', 'nomina_cargos'));
                return response($viewChangeEventual);
            } else {
                return response(abort(404));
            }
        }
    }

    // Cambiar consultor
    public function cambiar_eventual(Request $request, $id)
    {
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'fecha_ingreso' => 'required',
                'fecha_conclusion' => 'required',
                'fecha_conclusion_antiguo' => 'required',
                'nomina_cargo_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'LLene todos los campos',
                    'values' => $validator->errors()->toArray()
                ]);
            } else {
                DB::beginTransaction();
                $eventualAnterior = AsignacionCargo::find($id);
                $eventual_id = $eventualAnterior->id;
                $old_nomina_cargo_id = $eventualAnterior->nomina_cargo_id;
                $trabajador_id = $eventualAnterior->trabajador_id;
                $eventualAnterior->fecha_conclusion = $data['fecha_conclusion_antiguo'];
                $eventualAnterior->estado = 'INHABILITADO';
                $eventualAnterior->save();
                // Cambiar a libre cargo anterior
                $cargoAnterior = NominaCargo::find($old_nomina_cargo_id);
                $cargoAnterior->estado = "LIBRE";
                $cargoAnterior->save();
                // crear nuevo eventual y cambiar el estado del nuevo cargo a OCUPADO
                $nuevoEventual = AsignacionCargo::create([
                    'trabajador_id' => $trabajador_id,
                    'nomina_cargo_id' => (int)$data['nomina_cargo_id'],
                    'fecha_ingreso' => $data['fecha_ingreso'],
                    'fecha_conclusion' => $data['fecha_conclusion'],
                    'estado' => 'HABILITADO',
                ]);
                $nuevoCargo = NominaCargo::find($data['nomina_cargo_id']);
                $nuevoCargo->estado = 'OCUPADO';
                $nuevoCargo->save();
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Eventual nro ' . $eventual_id . ' Modificado.',
                    'data' => $nuevoEventual
                ], 200);
            }
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return response('Not Found', 404)->header('Content-Type', 'application/json');
        }
    }
    // DAR DE BAJA UN Consultor
    public function dar_baja_eventual(Request $request, $id)
    {
        if ($request->ajax()) {
            $eventual = AsignacionCargo::find($id);
            if ($eventual) {
                $viewCancelConsultor = view('asignacion_cargo.eventual.cancel', compact('eventual',));
                return response($viewCancelConsultor);
            } else {
                return response(abort(404));
            }
        }
    }

    // Baja item
    public function baja_eventual(Request $request, $id)
    {
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'fecha_conclusion' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'LLene los campos requeridos.',
                    'values' => $validator->errors()->toArray()
                ]);
            } else {
                DB::beginTransaction();
                $eventualAnterior = AsignacionCargo::find($id);
                $eventual_id = $eventualAnterior->id;
                $old_nomina_cargo_id = $eventualAnterior->nomina_cargo_id;
                $eventualAnterior->fecha_conclusion = $data['fecha_conclusion'];
                $eventualAnterior->motivo_baja = $data['motivo_baja'];
                $eventualAnterior->estado = 'INHABILITADO';
                $eventualAnterior->save();
                // Cambiar a libre cargo anterior
                $cargoAnterior = NominaCargo::find($old_nomina_cargo_id);
                $cargoAnterior->estado = "LIBRE";
                $cargoAnterior->save();
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Eventual nro ' . $eventual_id . ' dado de Baja.'
                ], 200);
            }
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            return response('Not Found', 404)->header('Content-Type', 'application/json');
        }
    }


    // ************************************************************************************************

    public function pdf(Request $request)
    {
        $tipo_contrato_id = $request->tipo_contrato;
        $estado = $request->estado;
        $nombre_tipo = $request->nombre_tipo;
        $contratos = AsignacionCargo::select(
            'asignacion_cargos.id',
            'asignacion_cargos.fecha_ingreso',
            'asignacion_cargos.fecha_conclusion',
            'asignacion_cargos.aporte_afp',
            'asignacion_cargos.sindicato',
            'asignacion_cargos.socio_fe',
            'asignacion_cargos.motivo_baja',
            'asignacion_cargos.trabajador_id',
            'asignacion_cargos.nomina_cargo_id',
            'asignacion_cargos.estado'
        )
            ->join('nomina_cargos', 'nomina_cargos.id', 'asignacion_cargos.nomina_cargo_id')
            ->with(['trabajador' => function ($query) {
                $query->select('id', 'ci', 'nombre', 'apellido_paterno', 'apellido_materno');
            }])
            ->with([
                'nomina_cargo' => function ($query) {
                    $query->select('id', 'item', 'cargo_id', 'escala_salarial_id');
                },
                'nomina_cargo.cargo' => function ($query) {
                    $query->select('id', 'nombre');
                },
                'nomina_cargo.escala_salarial' => function ($query) {
                    $query->select('id', 'salario_mensual');
                },
            ])
            ->whereHas('nomina_cargo', function ($query) use ($tipo_contrato_id) {
                $query->where('tipo_contrato_id', '=', $tipo_contrato_id);
            })
            ->where('asignacion_cargos.estado', $estado)
            ->orderBy('nomina_cargos.item', 'ASC')
            ->get();
        return response(view('asignacion_cargo.print.pdf', compact('contratos', 'estado', 'tipo_contrato_id', 'nombre_tipo')))
            ->header('Content-Type', 'application/pdf');
    }
}
