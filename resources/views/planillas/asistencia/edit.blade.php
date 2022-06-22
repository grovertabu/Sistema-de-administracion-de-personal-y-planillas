@extends('adminlte::page')

@section('title', 'Editar Asistencia')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Editar asistencia</h3>
                </div>
                <form action="{{ route('asistencia.actualizar', $asistencia->id) }}" method="POST" class="create" role="form"
                    id="form_edit_asistencia">
                    @csrf
                    @method('PUT')
                    <div class="card-body row">
                        <x-input type="text" readonly=true  name="trabajador" id="trabajador" label="Trabajador"
                            topclass="col-md-12 required" value="{{ $trabajador->nombre_completo }}" />
                        {{-- Componente de Dias de asistencia --}}
                        <x-input type="number" readonly=true name="dias_laborales" id="dias_laborales" label="Días Laborables" min="1"
                            topclass="col-md-12 required" value="{{ old('dias_laborales', $asistencia->dias_laborales) }}" />
                        {{-- Componente de Dias de asistencia --}}
                        <x-input type="number" name="dias_asistencia" id="dias_asistencia" label="Días Asistencia" min="0"
                            topclass="col-md-12 required" value="{{ old('dias_asistencia', $asistencia->dias_asistencia) }}" />
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
