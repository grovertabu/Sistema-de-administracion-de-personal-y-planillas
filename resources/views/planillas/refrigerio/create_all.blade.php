@extends('adminlte::page')

@section('title', 'Crear Refrigerio')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Generar planilla de Refrigerio</h3>
                </div>
                <form action="{{ route('refrigerio.generar_planilla') }}" method="POST" class="create" role="form"
                    id="form_all_refrigerio">
                    @csrf
                    <div class="card-body row">
                        <x-dg-select2 id="mes" name="mes" label="Mes:" topclass="col-sm-12 required">
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
                        <div class="form-group col-sm-12 required">
                            <label for="inputPassword2" class="mr-1">Gestión: </label>
                            <div class="input-group required-valid">
                                <input type="text"
                                    class="form-control  form-control-md @error('gestion') is-invalid @enderror"
                                    placeholder="aaaa" name="gestion" id="gestion" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="yyyy" data-mask value="{{ date('Y') }}">
                                <div class="input-group-prepend" data-target="#gestion" data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        {{-- Componente de Dias de asistencia --}}
                        <x-input type="number" name="dias_asistencia" id="dias_asistencia" label="Días Asistencia" min="1"
                            topclass="col-md-6 required" value="{{ old('dias_asistencia', 30) }}" />
                        {{-- Componente de Dias de asistencia --}}
                        <x-input type="number" name="dias_laborales" id="dias_laborales" label="Días Laborales" min="1"
                            topclass="col-md-6 required" value="{{ old('dias_laborales', 30) }}" />
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
