@extends('adminlte::page')

@section('title', 'Editar Otro descuento')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Editar Fondo empleado</h3>
                </div>
                <form action="{{ route('fondo_empleado.actualizar', $fondo_empleado->id) }}" method="POST" class="create"
                    role="form" id="form_edit_fondo_empleado">
                    @csrf
                    @method('PUT')
                    <div class="card-body row">
                        <x-input type="text" disabled=true name="trabajador" id="trabajador" label="Trabajador"
                            topclass="col-md-12 required" value="{{ $trabajador_cargo->nombre_completo }}" />
                        <x-input type="text" disabled=true name="item" id="item" label="Item"
                            topclass="col-md-2 required" value="{{ $trabajador_cargo->item }}" />
                        <x-input type="text" disabled=true name="trabajador" id="trabajador" label="Cargo"
                            topclass="col-md-10 required" value="{{ $trabajador_cargo->nombre_cargo }}" />

                        <x-input type="text" name="porcentaje_fe" id="porcentaje_fe" label="Porcentaje F.E."
                            topclass="col-md-6 required" disabled="true"
                            value="{{$fondo_empleado->porcentaje_fe}} %" />
                        <x-input type="text" name="total_ganado" id="total_ganado" label="Total Ganado"
                            topclass="col-md-6 required" inputclass="decimales"
                            value="{{ old('total_ganado', $fondo_empleado->total_ganado) }}" />
                        {{-- Componente de monto de fondo_empleado --}}
                        <x-input type="text" name="monto_fe" id="monto_fe" label="Descuento F.E."
                            topclass="col-md-6 required" inputclass="decimales"
                            value="{{ old('monto_fe', $fondo_empleado->monto_fe) }}" />
                        <x-input type="text" name="pago_deuda" id="pago_deuda" label="Pago deuda"
                            topclass="col-md-6 required" inputclass="decimales"
                            value="{{ old('pago_deuda', $fondo_empleado->pago_deuda) }}" />
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <buttton class="btn btn-danger" onclick="javascript:window.history.back()"><i
                                        class="far fa-window-close"></i> Cancelar</buttton>
                            </div>
                            <x-dg-submit type="success" topclass="col-md-6" inputclass="float-right" label="Guardar" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop
@section('footer')
    <strong>{{ date('Y') }} || ELAPAS - SISTEMA DE RECURSOS HUMANOS </strong>
@stop
@section('js')
    <script></script>
@stop
