@extends('adminlte::page')

@section('title', 'Crear planilla')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Crear Planilla</h3>
                </div>
                <form action="{{ route('nombre_planilla.store') }}" method="POST" class="create" role="form"
                    id="form_all_nombre_planilla">
                    @csrf
                    <div class="card-body row">
                        <x-dg-select2 id="mes" name="mes" label="Mes:" topclass="col-sm-12 required">
                            <option value="">-seleccione-</option>
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
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
                        <x-input type="text" name="nombre_planilla" id="nombre_planilla" label="Nombre Planilla"
                            topclass="col-md-12 required" value="{{ old('nombre_planilla') }}" />
                        <div class="form-group col-md-12 required">
                            <label>Fecha Creacion:</label>
                            <div class="input-group required-valid">
                                <input type="text" class="form-control @error('fecha_creacion') is-invalid @enderror"
                                    placeholder="aaaa-mm-dd" name="fecha_creacion" id="fecha_creacion"
                                    data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask>
                                <div class="input-group-prepend" data-target="#fecha_creacion" data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                @error('fecha_creacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-danger" href="{{ route('nombre_planilla.index') }}"><i
                                    class="far fa-window-close"></i> Cancelar</a>
                            </div>
                            <x-dg-submit type="success" topclass="col-md-6" inputclass="float-right" label="Guardar" />
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

        $('#fecha_creacion').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: moment.locale('es'),
            viewMode: 'months',
        });
        $('#fecha_creacion').inputmask('yyyy-mm-dd', {
            placeholder: 'aaaa-mm-dd',
            inputFormat: 'aaaa-mm-dd'
        })
    </script>
@stop
