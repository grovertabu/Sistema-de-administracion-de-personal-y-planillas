@extends('adminlte::page')

@section('title', 'Aportes laborales')

@section('content_header')
    <h1>Consultar Planilla Aportes laborales</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </strong>
        </div>
    @endif
    <div class="card card-secondary card-outline">
        <div class="justify-content-center row" style="height:250px;width:100%">
            <form class="form-inline" action="{{ route('aporte_laboral.lista') }}" method="GET">
                {{-- @csrf --}}
                <input type="hidden" name="tipo_contrato" id="tipo_contrato" value="1">
                <div class="form-group mx-sm-3 ">
                    <label for="inputPassword2" class="mr-1">Mes: </label>
                    <select class="form-control select2 @error('mes') is-invalid @enderror" name="mes" id="mes">
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
                    </select>
                </div>
                <div class="form-group mx-sm-3 ">
                    <label for="inputPassword2" class="mr-1">Gestión: </label>
                    <div class="input-group required-valid">
                        <input type="text" class="form-control  form-control-md @error('gestion') is-invalid @enderror"
                            placeholder="aaaa" name="gestion" id="gestion" data-inputmask-alias="datetime"
                            data-inputmask-inputformat="yyyy" data-mask value="{{ date('Y') }}">
                        <div class="input-group-prepend" data-target="#gestion" data-toggle="datetimepicker">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ">Mostrar</button>
            </form>

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
