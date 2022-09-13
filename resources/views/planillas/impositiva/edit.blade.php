@extends('adminlte::page')

@section('title', 'Editar Impositiva')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Editar Impositiva</h3>
                </div>
                <form action="{{ route('impositiva.actualizar', $impositiva->id) }}" method="POST" class="create"
                    role="form" id="form_edit_impositiva">
                    @csrf
                    @method('PUT')
                    <div class="card-body row">
                        <x-input type="text" disabled=true name="trabajador" id="trabajador" label="Trabajador"
                            topclass="col-md-12 required" value="{{ $trabajador_cargo->nombre_completo }}" />

                        <x-input type="text" disabled=true name="item" id="item" label="Item"
                            topclass="col-md-2 required" value="{{ $trabajador_cargo->item }}" />

                        <x-input type="text" name="presentacion_desc" id="presentacion_desc" label="13% Formulario F110"
                            topclass="col-md-12 required" inputclass="decimales"
                            value="{{ old('presentacion_desc', $impositiva->presentacion_desc) }}" />

                        <x-input type="text" name="saldo_mes_anterior" id="saldo_mes_anterior" label="Saldo mes anterior"
                            topclass="col-md-6 required" inputclass="decimales"
                            value="{{ old('saldo_mes_anterior', $impositiva->saldo_mes_anterior) }}" />

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
