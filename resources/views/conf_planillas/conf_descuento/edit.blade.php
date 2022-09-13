@extends('adminlte::page')

@section('title', 'Modificar')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Modificar Configuración de Horas extra</h3>
                </div>
                <form action="{{ route('conf_horas_extra.update', $conf_horas_extra->id) }}" method="POST" class="create"
                    role="form" id="form_conf_horas_extra">
                    @csrf
                    @method('PUT')
                    <div class="card-body row">
                        <x-input type="text" name="tipo_hora_extra" id="tipo_hora_extra" label="Descripción" topclass="col-md-12 required"
                            value="{{ old('tipo_hora_extra', $conf_horas_extra->tipo_hora_extra) }}" />
                        <x-input type="text" name="factor_calculo" id="factor_calculo" label="Factor de Calculo" topclass="col-md-12 required"
                            value="{{ old('factor_calculo', $conf_horas_extra->factor_calculo) }}" />
                        <x-input-check
                            checked="{{ $conf_horas_extra->estado == 'HABILITADO' ? 'true' : '' }}"
                            name="estado" id="estado" label="Activo"  topclass="col-md-12"/>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-danger" href="{{ route('conf_horas_extra.index') }}" role="tab"><i
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
