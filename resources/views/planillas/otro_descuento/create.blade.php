@extends('adminlte::page')

@section('title', 'Crear Otro Descuento')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Crear otro descuento individual</h3>
                </div>
                <form action="{{ route('otro_descuento.generar_otro_descuento') }}" method="POST" class="create" role="form"
                    id="form_all_otro_descuento">
                    @csrf
                    <div class="card-body row">
                        <input type="hidden" name="mes" id="mes" value="{{ $mes }}" >
                        <input type="hidden" name="tipo_contrato" id="tipo_contrato" value="{{ $tipo_contrato }}" >

                        <div class="form-group col-sm-6 required">
                            <label for="inputPassword2" class="mr-1">Mes: </label>
                            <div class="input-group required-valid">
                                <input type="text" readonly="true"
                                    class="form-control  form-control-md"
                                    name="mes_" id="mes_"
                                    value="{{Funciones::getMes($mes)}}">
                                <div class="input-group-prepend" data-target="#gestion" data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6 required">
                            <label for="inputPassword2" class="mr-1">Gestión: </label>
                            <div class="input-group required-valid">
                                <input type="text" readonly="true"
                                    class="form-control  form-control-md"
                                    name="gestion" id="gestion"
                                    value="{{$gestion}}">
                                <div class="input-group-prepend" data-target="#gestion" data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>


                        <x-dg-select2 id="trabajador" name="trabajador" label="Trabajador:" topclass="col-sm-12 required">
                            <option value="">-seleccione-</option>
                            @foreach($trabajadores as $trabajador)
                                <option value="{{$trabajador->asignacion_cargo_id}}">{{$trabajador->item.' | '.$trabajador->nombre_completo}}</option>
                            @endforeach
                        </x-dg-select2>

                        <x-dg-select2 id="conf_otro_descuento_id" name="conf_otro_descuento_id" label="Descripción"
                            topclass="col-md-12 requiredsm-12 required">
                            <option value="">-seleccione-</option>
                            @foreach ($conf_otro_descuentos as $conf_od)
                                <option value="{{ $conf_od->id }}"
                                    {{ old('conf_otro_descuento_id') == $conf_od->id ? 'selected' : '' }}>
                                    {{ $conf_od->descripcion }}</option>
                            @endforeach
                        </x-dg-select2>

                        <x-dg-select2 id="de_donde" name="de_donde" label="De Donde?"
                            topclass="col-md-12 required">
                            <option value="1" selected>Total Ganado</option>
                            <option value="0">Haber básico</option>
                        </x-dg-select2>
                        <input type="hidden" name="tipo_contrato" id="tipo_contrato" value="{{ $tipo_contrato }}">
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
