@extends('adminlte::page')

@php
    $title = 'Modificar configuración bono antiguedad';
@endphp
@section('title', $title)

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <form action="{{ route('conf_bono_antiegad.update', $conf_bono_antiegad->id) }}" method="POST" class="create"
                    role="form" id="form_conf_bono_antiegad">
                    @csrf
                    @method('PUT')
                    <div class="card-body row">
                        <x-input type="text" name="anio_i" id="anio_i" label="Año inicio" topclass="col-md-12 required"
                            value="{{ old('anio_i', $conf_bono_antiegad->anio_i) }}" />
                        <x-input type="number" name="anio_f" id="anio_f" label="Año fin" topclass="col-md-12 required"
                            value="{{ old('anio_f', $conf_bono_antiegad->anio_f) }}" />
                        <x-input type="number" name="porcentaje" id="porcentaje" label="Porcentaje" topclass="col-md-12 required"
                            value="{{ old('porcentaje', $conf_bono_antiegad->porcentaje) }}" />
                        <x-input-check
                            checked="{{ $conf_bono_antiegad->estado == 'HABILITADO' ? 'true' : '' }}"
                            name="estado" id="estado" label="Activo"  topclass="col-md-12"/>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-danger" href="{{ route('conf_bono_antiegad.index') }}" role="tab"><i
                                        class="far fa-window-close"></i> Cancelar</a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success float-right"><i class="fa fa-save"></i> Guardar</button>
                            </div>
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
