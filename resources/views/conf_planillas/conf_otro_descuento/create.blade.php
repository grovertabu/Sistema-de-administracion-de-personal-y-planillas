@extends('adminlte::page')

@section('title', 'Nueva configuración de otro descuento')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Nueva Configuración de otro descuento</h3>
                </div>
                <form action="{{ route('conf_otro_descuento.store') }}" method="POST" class="create"
                    role="form" id="form_conf_otro_descuento">
                    @csrf
                    <div class="card-body row">
                        <x-dg-input type="text" name="descripcion" id="descripcion" label="Descripción" topclass="col-md-12 required"
                            value="{{ old('descripcion') }}" />
                        <x-dg-input type="text" name="factor_calculado" id="factor_calculado" label="Factor de calculo" topclass="col-md-12 required"
                            value="{{ old('factor_calculado') }}" />
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
