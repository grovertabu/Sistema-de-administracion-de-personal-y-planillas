@extends('adminlte::page')

@section('title', 'Modificar configuración de Impositiva')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Modificar Configuración de Impositiva</h3>
                </div>
                <form action="{{ route('conf_impositiva.update', $conf_impositiva->id) }}" method="POST" class="create"
                    role="form" id="form_conf_impositiva">
                    @csrf
                    @method('PUT')
                    <div class="card-body row">
                        <x-dg-input type="text" name="salario_minimo" id="salario_minimo" label="Salario minimo" topclass="col-md-12 required"
                            value="{{ old('salario_minimo', $conf_impositiva->salario_minimo) }}" />
                        <x-dg-input type="number" name="cantidad_salario_minimo" id="cantidad_salario_minimo" label="Cantidad Salario minimo" topclass="col-md-12 required"
                            value="{{ old('cantidad_salario_minimo', $conf_impositiva->cantidad_salario_minimo) }}" />
                        <x-dg-input type="number" name="porcentaje_impositiva" id="porcentaje_impositiva" label="Porcentaje Impositiva" topclass="col-md-12 required"
                            value="{{ old('porcentaje_impositiva', $conf_impositiva->porcentaje_impositiva) }}" />
                        <x-input-check
                            checked="{{ $conf_impositiva->estado == 'HABILITADO' ? 'true' : '' }}"
                            name="estado" id="estado" label="Activo"  topclass="col-md-12"/>
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
@section('js')
<script>
    $(() => {
        $("input").on("keypress", function() {
            $input = $(this);
            setTimeout(function() {
                $input.val($input.val().toUpperCase());
            }, 0);
        });
    })
</script>
@stop
