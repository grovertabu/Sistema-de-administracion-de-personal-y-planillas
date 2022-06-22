@extends('adminlte::page')

@section('title', 'Modificar Tipo de Contrato')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Modificar Tipo de Contrato</h3>
                </div>
                <form action="{{ route('tipo_contrato.update', $tipo_c->id) }}" method="POST" class="create"
                    role="form" id="form_tipo_contrato">
                    @csrf
                    @method('PUT')
                    <div class="card-body row">
                        <x-dg-input type="text" name="nombre" id="nombre" label="Nombre" topclass="col-md-12 required"
                            value="{{ old('nombre', $tipo_c->nombre) }}" />
                        <x-input-check
                            checked="{{ $tipo_c->estado == 'ACTIVO' ? 'true' : '' }}"
                            name="estado" id="estado" label="Activo"  topclass="col-md-12"/>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-danger" href="{{ route('tipo_contrato.index') }}" role="tab"><i
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
