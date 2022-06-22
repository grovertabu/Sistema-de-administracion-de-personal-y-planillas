@extends('adminlte::page')

@section('title', 'Editar Total Ganado')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Editar total ganado</h3>
                </div>
                <form action="{{ route('total_ganado.actualizar', $total_ganado->id) }}" method="POST" class="create"
                    role="form" id="form_edit_total_ganado">
                    @csrf
                    @method('PUT')
                    <div class="card-body row">
                        <x-input type="text" disabled=true name="trabajador" id="trabajador" label="Trabajador"
                            topclass="col-md-12 required" value="{{ $trabajador_cargo->nombre_completo }}" />
                        <x-input type="text" disabled=true name="item" id="item" label="Item"
                            topclass="col-md-2 required" value="{{ $trabajador_cargo->item }}" />
                        <x-input type="text" disabled=true name="trabajador" id="trabajador" label="Cargo"
                            topclass="col-md-10 required" value="{{ $trabajador_cargo->nombre_cargo }}" />
                        {{-- Componente de Dias de total_ganado --}}
                        <x-input type="number" readonly=true name="total_dias" id="total_dias" label="Días trabajados"
                            min="0" topclass="col-md-12 required"
                            value="{{ old('total_dias', $total_ganado->total_dias) }}" />
                        {{-- Componente de haber basico --}}
                        <x-input type="number" name="haber_basico" id="haber_basico" label="Haber básico" min="0"
                            topclass="col-md-12 required"
                            value="{{ old('haber_basico', $total_ganado->haber_basico) }}" />
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
