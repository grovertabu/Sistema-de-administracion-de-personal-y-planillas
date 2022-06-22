@extends('adminlte::page')

@section('title', 'Editar Cargo')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Editar Cargo</h3>
                </div>
                <form action="{{ route('cargo.update', $cargo) }}" method="POST" class="create" role="form"
                    id="form_cargo">
                    @csrf
                    @method('PUT')
                    <div class="card-body row">
                        <x-dg-input type="text" name="nombre" id="nombre" label="Nombre" topclass="col-md-12 required"
                            value="{{ old('nombre', $cargo->nombre) }}" />
                        <x-dg-select2 id="estructura_organizacional_id" name="estructura_organizacional_id"
                            label="Estructura Organizaicional" topclass="col-md-12 required">
                            <x-dg-option value="">--SELECCIONE--</x-dg-option>
                            @foreach ($estructura_organizacionales as $estructura)
                                <option value="{{ $estructura->id }}"
                                    {{ $estructura->id == $cargo->estructura_organizacional_id ? 'selected' : '' }}>
                                    {{ $estructura->nombre . '[' . $estructura->version . ']' }}
                                </option>
                            @endforeach
                        </x-dg-select2>
                        <x-input-check checked="{{ $cargo->estado == 'ACTIVO' ? 'true' : '' }}" name="estado" id="estado"
                            label="Activo" topclass="col-md-12" />
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-danger" id="cancelar_Cargo" href="{{ route('cargo.index') }}"
                                    role="tab"><i class="far fa-window-close"></i> Cancelar</a>
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
