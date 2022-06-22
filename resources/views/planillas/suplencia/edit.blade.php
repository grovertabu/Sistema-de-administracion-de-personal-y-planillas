@extends('adminlte::page')

@section('title', 'Editar suplencia')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-10">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Editar suplencia</h3>
                </div>
                <form action="{{ route('suplencia.actualizar', $suplencia->id) }}" method="POST" class="create"
                    role="form" id="form_edit_suplencia">
                    @csrf
                    @method('PUT')
                    <div class="card-body row">
                        <x-input type="text" readonly=true name="trabajador" id="trabajador" label="Trabajador"
                            topclass="col-md-12 required" value="{{ $trabajador->nombre_completo }}" />

                        <x-dg-select2 id="id_cargo_suplencia" name="id_cargo_suplencia" label="Tipo de suplencia"
                            topclass="col-sm-12 required">
                            <option value="">-seleccione-</option>
                            @foreach ($suplencias as $sup)
                                <option value="{{ $sup->id_cargo }}"
                                    {{ $suplencia->cargo_suplencia == $sup->nombre_cargo ? 'selected' : '' }}>
                                    {{ $sup->nombre_cargo }}</option>
                            @endforeach
                        </x-dg-select2>
                        <x-input type="number" name="total_dias" id="total_dias" label="Total Días" min="0"
                            topclass="col-md-4 required" value="{{ old('total_dias', $suplencia->total_dias) }}" />
                        <x-input type="text" readonly=true name="fecha_inicio" id="fecha_inicio" label="Fecha Inicio"
                            topclass="col-md-4 required" value="{{ $suplencia->fecha_inicio->format('d-m-Y') }}" />

                        <x-input type="text" readonly=true name="fecha_fin" id="fecha_fin" label="Fecha Inicio"
                            topclass="col-md-4 required" value="{{ $suplencia->fecha_fin->format('d-m-Y') }}" />
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
    <script></script>
@stop
