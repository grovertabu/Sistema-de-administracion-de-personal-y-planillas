@extends('adminlte::page')

@section('title', 'Editar Aporte Laboral')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Editar Aporte Laboral</h3>
                </div>
                <form action="{{ route('aporte_laboral.actualizar', $aporte_laboral->id) }}" method="POST" class="create"
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

                        <x-input type="text" readonly=true name="tipo_aporte" id="tipo_aporte" label="Tipo Aporte"
                            min="0" topclass="col-md-12 required"
                            value="{{ old('tipo_aporte', $aporte_laboral->tipo_aporte) }}" />

                        <x-input type="number" readonly=true name="porcentaje_aporte" id="porcentaje_aporte" label="Porcentaje aporte" min="0"
                            topclass="col-md-6 required"
                            value="{{ old('porcentaje_aporte', $aporte_laboral->porcentaje_aporte) }}" />

                        <x-input type="number" name="monto_aporte" id="monto_aporte" label="Monto aporte" min="0"
                            topclass="col-md-6 required"
                            value="{{ old('monto_aporte', $aporte_laboral->monto_aporte) }}" />
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
