@extends('adminlte::page')

@section('title', 'Modificar Escala Salarial')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Modificar Escala Salarial</h3>
                </div>
                <form action="{{ route('escala_salarial.update',$escala_salarial) }}" method="POST" class="create" role="form"
                    id="form_escala_salarial">
                    @csrf
                    @method('PUT')
                    <div class="card-body row">
                        <x-dg-input type="number" name="nivel" id="nivel" label="Nivel" topclass="col-md-6 required"
                            value="{{ old('nivel',$escala_salarial->nivel) }}" />
                        <x-dg-select2 id="estructura_organizacional_id" name="estructura_organizacional_id"
                            label="Estructura Organizaicional" topclass="col-md-6 required">
                            <x-dg-option value="">--SELECCIONE--</x-dg-option>
                            @foreach ($estructura_organizacionales as $estructura)
                                <option value="{{ $estructura->id }}"
                                    {{($estructura->id==$escala_salarial->estructura_organizacional_id) ? "selected" : ""}}>
                                    {{ $estructura->nombre . '[' . $estructura->version . ']' }}
                                </option>
                            @endforeach
                        </x-dg-select2>
                        <x-dg-input type="text" name="descripcion" id="descripcion" label="Descripcion"
                            topclass="col-md-12 required" value="{{ old('descripcion',$escala_salarial->descripcion) }}" />
                        <x-dg-input type="number" name="casos" id="casos" label="N° de Casos" topclass="col-md-6 required"
                            value="{{ old('casos',$escala_salarial->casos) }}" />
                        <x-dg-input type="number" name="salario_mensual" id="salario_mensual" label="Salario mensual" topclass="col-md-6 required"
                            value="{{ old('salario_mensual',$escala_salarial->salario_mensual) }}" />
                        <x-input-check
                            checked="{{ $escala_salarial->estado == 'ACTIVO' ? 'true' : '' }}"
                            name="estado" id="estado" label="Activo"  topclass="col-md-12"/>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-danger" href="{{ route('escala_salarial.index') }}" role="tab"><i
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
