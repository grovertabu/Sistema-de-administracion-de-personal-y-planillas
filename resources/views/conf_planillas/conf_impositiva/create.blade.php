@extends('adminlte::page')

@section('title', 'Nueva configuración de Impositiva')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Nueva Configuración de Impositiva</h3>
                </div>
                <form action="{{ route('conf_impositiva.store') }}" method="POST" class="create"
                    role="form" id="form_conf_impositiva">
                    @csrf
                    <div class="card-body row">
                        <x-dg-input type="number" name="salario_minimo" id="salario_minimo" label="Salario Minimo" topclass="col-md-12 required"
                            value="{{ old('salario_minimo') }}" />
                        <x-dg-input type="number" name="cantidad_salario_minimo" id="cantidad_salario_minimo" label="Cantidad Salario minimo" topclass="col-md-12 required"
                            value="{{ old('cantidad_salario_minimo') }}" />
                        <x-dg-input type="number" name="porcentaje_impositiva" id="porcentaje_impositiva" label="Porcentaje" topclass="col-md-12 required"
                            value="{{ old('porcentaje_impositiva') }}" />
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-danger" href="{{ route('conf_impositiva.index') }}" role="tab"><i
                                        class="far fa-window-close"></i> Cancelar</a>
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

