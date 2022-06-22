@extends('adminlte::page')

@section('title', 'Nueva configuración de aporte')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Nueva Configuración de aporte</h3>
                </div>
                <form action="{{ route('conf_aporte.store') }}" method="POST" class="create"
                    role="form" id="form_conf_aporte">
                    @csrf
                    <div class="card-body row">
                        <x-dg-input type="text" name="tipo_aporte" id="tipo_aporte" label="Tipo de aporte" topclass="col-md-12 required"
                            value="{{ old('tipo_aporte') }}" />
                        <x-dg-input type="number" name="rango_inicial" id="rango_inicial" label="Rango Inicial" topclass="col-md-12 required"
                            value="{{ old('rango_inicial') }}" />
                        <x-dg-input type="number" name="rango_final" id="rango_final" label="Rango Final" topclass="col-md-12 required"
                            value="{{ old('rango_final') }}" />
                        <x-dg-input type="number" name="porcentaje_aporte" id="porcentaje_aporte" label="Porcentaje de Aporte" topclass="col-md-12 required"
                            value="{{ old('porcentaje_aporte') }}" />
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-danger" href="{{ route('conf_aporte.index') }}" role="tab"><i
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
