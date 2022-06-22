@extends('adminlte::page')

@section('title', 'Registrar suplencia')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-10">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Registrar suplencia</h3>
                </div>
                <form action="{{ route('suplencia.registrar_suplencia') }}" method="POST" class="create" role="form"
                    id="form_suplencia">
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

                        <x-dg-select2 id="trabajador" name="trabajador" label="Trabajador" topclass="col-sm-6 required">
                            <option value="">-seleccione-</option>
                            @foreach($trabajadores as $trabajador)
                                <option value="{{$trabajador->asignacion_cargo_id}}" {{ old('trabajador') == $trabajador->asignacion_cargo_id ? 'selected' : '' }}>{{$trabajador->nombre_completo}}</option>
                            @endforeach
                        </x-dg-select2>

                        <x-dg-select2 id="id_cargo_suplencia" name="id_cargo_suplencia" label="Cargo suplencia" topclass="col-sm-6 required">
                            <option value="">-seleccione-</option>
                            @foreach($suplencias as $suplencia)
                                <option value="{{$suplencia->id_cargo}}" {{ old('id_cargo_suplencia') == $suplencia->id_cargo ? 'selected' : '' }}>{{$suplencia->nombre_cargo}}</option>
                            @endforeach
                        </x-dg-select2>
                        {{-- rango de tiempo de una suplencia --}}
                        <div class="form-group col-md-4 required">
                            <label>Fecha inicio:</label>
                            <div class="input-group required-valid">
                                <input type="text" class="form-control" placeholder="aaaa-mm-dd" name="fecha_inicio"
                                    id="fecha_inicio" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="yyyy-mm-dd" data-mask value="{{Funciones::mesPasado($mes)}}">
                                <div class="input-group-prepend" data-target="#fecha_inicio" data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 required">
                            <label>Fecha fin:</label>
                            <div class="input-group required-valid">
                                <input type="text" class="form-control @error('fecha_fin') is-invalid @enderror" placeholder="aaaa-mm-dd" name="fecha_fin"
                                    id="fecha_fin" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="yyyy-mm-dd" data-mask >
                                <div class="input-group-prepend" data-target="#fecha_fin" data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                @error('fecha_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- total de dias de suplencia --}}
                        <x-input type="number" name="total_dias" id="total_dias" label="Total días" min="0"
                            topclass="col-md-4 required" value="{{ old('total_dias') }}" />
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

        $('#fecha_inicio').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: moment.locale('es'),
            viewMode: 'months',
        });
        $('#fecha_inicio').inputmask('yyyy-mm-dd', {
            placeholder: 'aaaa-mm-dd',
            inputFormat: 'aaaa-mm-dd'
        })

        $('#fecha_fin').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: moment.locale('es'),
            viewMode: 'months',
            minDate: $('#fecha_inicio').val(),
        });
        $('#fecha_fin').inputmask('yyyy-mm-dd', {
            placeholder: 'aaaa-mm-dd',
            inputFormat: 'aaaa-mm-dd'
        })

        $("#fecha_inicio").on("change.datetimepicker", function (e) {
            $('#fecha_fin').datetimepicker('minDate', e.date);
        });

        $("#fecha_fin").on("change.datetimepicker", function (e) {
            $('#fecha_inicio').datetimepicker('maxDate', e.date);
            var endDate = $("#fecha_fin").val();
            var startDate = $("#fecha_inicio").val();
            var total_dias = $("#total_dias");
            let fecha_inicio = Date.parse(startDate);
            let fecha_fin = Date.parse(endDate);
            var diff = fecha_fin - fecha_inicio;
            var diferencia = (diff / (1000 * 60 * 60 * 24)) + 1;
            total_dias.val(diferencia)
        });


        $("#fecha_fin").blur(function() {
            var endDate = $("#fecha_fin").val();
            var startDate = $("#fecha_inicio").val();
            var total_dias = $("#total_dias");
            let fecha_inicio = Date.parse(startDate);
            let fecha_fin = Date.parse(endDate);
            var diff = fecha_fin - fecha_inicio;
            var diferencia = (diff / (1000 * 60 * 60 * 24)) + 1;

            total_dias.val(diferencia <= 30 ? diferencia : 30)
            // document.getElementById('dias_solicitados').value = (diff / (1000 * 60 * 60 * 24)) + 1;
        });
    </script>
@stop
