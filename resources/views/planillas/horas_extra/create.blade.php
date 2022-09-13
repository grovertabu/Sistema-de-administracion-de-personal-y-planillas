@extends('adminlte::page')

@section('title', 'Registrar hora extra')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Registrar hora extra</h3>
                </div>
                <form action="{{ route('horas_extra.registrar_horas_extra') }}" method="POST" class="create" role="form"
                    id="form_horas_extra">
                    @csrf
                    <div class="card-body row">
                        <input type="hidden" name="mes" id="mes" value="{{ $mes }}" >
                        <input type="hidden" name="tipo_contrato" id="tipo_contrato" value="{{ $tipo_contrato }}" >
                        <x-dg-select2 label="Mes:" name="getmes" id="getmes" topclass="col-sm-6 required" disabled="true">
                            <option value="">-seleccione-</option>
                            <option value="1" {{$mes==1 ? 'selected': ''}}>Enero</option>
                            <option value="2" {{$mes==2 ? 'selected': ''}}>Febrero</option>
                            <option value="3" {{$mes==3 ? 'selected': ''}}>Marzo</option>
                            <option value="4" {{$mes==4 ? 'selected': ''}}>Abril</option>
                            <option value="5" {{$mes==5 ? 'selected': ''}}>Mayo</option>
                            <option value="6" {{$mes==6 ? 'selected': ''}}>Junio</option>
                            <option value="7" {{$mes==7 ? 'selected': ''}}>Julio</option>
                            <option value="8" {{$mes==8 ? 'selected': ''}}>Agosto</option>
                            <option value="9" {{$mes==9 ? 'selected': ''}}>Septiembre</option>
                            <option value="10" {{$mes==10 ? 'selected': ''}}>Octubre</option>
                            <option value="11" {{$mes==11 ? 'selected': ''}}>Noviembre</option>
                            <option value="12" {{$mes==12 ? 'selected': ''}}>Diciembre</option>
                        </x-dg-select2>
                        <div class="form-group col-sm-6 required">
                            <label for="gestion">Gestión: </label>
                            <div class="input-group">
                                <input type="text" readonly="true"
                                    class="form-control  form-control-md @error('gestion') is-invalid @enderror"
                                    placeholder="aaaa" name="gestion" id="gestion" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="yyyy" data-mask value="{{ $gestion}}">
                                <div class="input-group-prepend" data-target="#gestion" data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        {{-- Trabajadores que no tenga hora_extra --}}
                        <x-dg-select2 id="trabajador" name="trabajador" label="Trabajador" topclass="col-sm-12 required">
                            <option value="">-seleccione-</option>
                            @foreach($trabajadores as $trabajador)
                                <option value="{{$trabajador->asignacion_cargo_id}}" {{ old('trabajador') == $trabajador->asignacion_cargo_id ? 'selected' : '' }}>{{$trabajador->nombre_completo}}</option>
                            @endforeach
                        </x-dg-select2>
                        {{-- Trabajadores que no tenga hora_extra --}}
                        <x-dg-select id="tipo_hora_extra" name="tipo_hora_extra" label="Tipo de hora extra" topclass="col-sm-12 required">
                            <option value="">-seleccione-</option>
                            @foreach($conf_horas_extras as $conf_he)
                                <option value="{{$conf_he->id}}" {{ old('tipo_hora_extra') == $conf_he->id ? 'selected' : '' }}>{{$conf_he->tipo_hora_extra}}</option>
                            @endforeach
                        </x-dg-select>
                        {{-- Componente de Dias de hora_extra --}}
                        <x-input type="text" name="cantidad" id="cantidad" label="Cantidad Horas"
                            topclass="col-md-12 required" value="{{ old('cantidad') }}" inputclass="decimales"/>
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
        $('#gestion').datetimepicker({
            format: 'YYYY',
            locale: moment.locale('es'),
            buttons: {
                showToday: true,
                showClear: true,
                showClose: true
            },
            icons: {
                today: 'fa fa-calendar',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            }
        });
        $('#gestion').inputmask('yyyy', {
            placeholder: "_",
            inputFormat: 'aaaa'
        })
    </script>
@stop
