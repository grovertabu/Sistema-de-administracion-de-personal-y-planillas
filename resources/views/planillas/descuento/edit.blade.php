@extends('adminlte::page')

@section('title', 'Editar Descuento')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Editar Descuento</h3>
                </div>
                <form action="{{ route('descuento.actualizar', $descuento->id) }}" method="POST" class="create"
                    role="form" id="form_edit_aporte_laboral">
                    @csrf
                    @method('PUT')
                    <div class="card-body row">
                        <x-input type="text" disabled=true name="trabajador" id="trabajador" label="Trabajador"
                            topclass="col-md-12 required" value="{{ $trabajador_cargo->nombre_completo }}" />
                        <x-input type="text" disabled=true name="item" id="item" label="Item"
                            topclass="col-md-2 required" value="{{ $trabajador_cargo->item }}" />
                        <x-input type="text" disabled=true name="trabajador" id="trabajador" label="Cargo"
                            topclass="col-md-10 required" value="{{ $trabajador_cargo->nombre_cargo }}" />

                        <x-input type="text" readonly=true name="nombre_descuento" id="nombre_descuento" label="Tipo Aporte"
                            min="0" topclass="col-md-12 required"
                            value="{{ old('nombre_descuento', $descuento->nombre_descuento) }}" />

                        <x-input type="number" name="monto" id="monto" label="{{$descuento->nombre_descuento == 'FONDO SOCIAL'  ? 'Cantidad horas a descontar': 'Monto descuento' }}" min="0"
                            topclass="col-md-6 required"
                            value="{{ old('monto', $descuento->monto) }}" />
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
