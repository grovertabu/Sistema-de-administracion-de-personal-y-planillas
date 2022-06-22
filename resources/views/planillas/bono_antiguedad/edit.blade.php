@extends('adminlte::page')

@section('title', 'Editar Bono de Antiguedad')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Editar bono de antiguedad</h3>
                </div>
                <form action="{{ route('bono_antiguedad.actualizar', $bono_antiguedad->id) }}" method="POST" class="create" role="form"
                    id="form_edit_bono_antiguedad">
                    @csrf
                    @method('PUT')
                    <div class="card-body row">
                        <x-input type="text" readonly=true  name="trabajador" id="trabajador" label="Trabajador"
                            topclass="col-md-12 required" value="{{ $trabajador->nombre_completo }}" />
                        {{-- Componente de Dias de bono_antiguedad --}}
                        <x-input type="number" name="monto" id="monto" label="Monto"
                            topclass="col-md-12 required" value="{{ old('monto', $bono_antiguedad->monto) }}" />
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <buttton class="btn btn-danger" onclick="javascript:window.history.back()"><i
                                        class="far fa-window-close"></i> Cancelar</buttton>
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
    </script>
@stop
