@extends('adminlte::page')

@section('title', 'Modificar')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Modificar Configuración de otro descuento</h3>
                </div>
                <form action="{{ route('conf_otro_descuento.update', $conf_otro_descuento->id) }}" method="POST" class="create"
                    role="form" id="form_conf_otro_descuento">
                    @csrf
                    @method('PUT')
                    <div class="card-body row">
                        <x-dg-input type="text" name="descripcion" id="descripcion" label="Descripción" topclass="col-md-12 required"
                            value="{{ old('descripcion', $conf_otro_descuento->descripcion) }}" />
                        <x-dg-input type="text" name="factor_calculado" id="factor_calculado" label="Factor de Calculo" topclass="col-md-12 required"
                            value="{{ old('factor_calculado', $conf_otro_descuento->factor_calculado) }}" />
                        <x-input-check
                            checked="{{ $conf_otro_descuento->estado == 'HABILITADO' ? 'true' : '' }}"
                            name="estado" id="estado" label="Activo"  topclass="col-md-12"/>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-danger" href="{{ route('conf_otro_descuento.index') }}" role="tab"><i
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
