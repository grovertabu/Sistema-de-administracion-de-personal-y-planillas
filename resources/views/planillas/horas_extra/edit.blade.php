@extends('adminlte::page')

@section('title', 'Editar Horas extras')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Editar Horas extras</h3>
                </div>
                <form action="{{ route('horas_extra.actualizar', $horas_extra->id) }}" method="POST" class="create" role="form"
                    id="form_edit_horas_extra">
                    @csrf
                    @method('PUT')
                    <div class="card-body row">
                        <input type="hidden" name="factor_calculo" id="factor_calculo" value="{{ $horas_extra->factor_calculo }}">
                        <x-input type="text" readonly=true  name="trabajador" id="trabajador" label="Trabajador"
                            topclass="col-md-12 required" value="{{ $trabajador->nombre_completo }}" />
                        {{-- Componente de Dias de horas_extra --}}
                        <x-input type="text" readonly=true name="tipo_hora_extra" id="tipo_hora_extra" label="Tipo de hora extra"
                            topclass="col-md-12 required" value="{{ old('tipo_hora_extra', $horas_extra->tipo_hora_extra) }}" />
                        {{-- Componente de Dias de horas_extra --}}
                        <x-input type="number" name="cantidad" id="cantidad" label="Cantidad Horas" min="0"
                            topclass="col-md-12 required" value="{{ old('cantidad', $horas_extra->cantidad) }}" />
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <buttton class="btn btn-danger" onclick="javascript:window.history.back()"><i
                                        class="far fa-window-close"></i> Cancelar</buttton>
                            </div>
                            <x-dg-submit type="success" topclass="col-md-6" inputclass="float-right"
                                label="Guardar" />
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
    <script>
    </script>
@stop
