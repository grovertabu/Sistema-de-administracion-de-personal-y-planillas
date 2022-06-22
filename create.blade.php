@extends('adminlte::page')

@section('title', 'REGISTRAR VACACION')

@section('content_header')
    <h1>USAR VACACIONES</h1>
    <a href="{{ route('vacaciones.usar', $volver->id) }}" class="btn btn-danger btn-rounded" style="float: right;"
        title="VOLVER"><i class="fa fa-arrow-alt-circle-left"></i></a>
@stop

@section('content')
    <div class="justify-content-center row">
        <!-- left column -->
        <div class="col-md-10">
            <!-- general form elements -->
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">Registrar Vacacion</h3>
                </div>
                <!-- /.card-header -->
                <!-- formulario inicio -->
                <form action="{{ route('vacaciones.store') }}" method="POST" class="create" role="form"
                    id="form_vacacion">
                    @csrf
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <input type="hidden" name="id_detalle_vacacion" id="id_detalle_vacacion"
                            value="{{ $detalle->id_dv }}">
                        <!-- DATOS TRABAJADOR -->
                        <div class="row mb-3">
                            <div class="input-group col-sm">
                                <label for="trabajador">Trabajador</label>
                                <div class="input-group col-sm">
                                    <input type="text" name="trabajador"
                                        class="form-control {{ $errors->has('trabajador') ? 'is-invalid' : '' }}"
                                        value="{{ $detalle->nombre . ' ' . $detalle->apellido_paterno . ' ' . $detalle->apellido_materno }}"
                                        readonly autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-user-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END DATOS TRABAJADOR -->
                        <!-- DATOS GESTION -->
                        <div class="row mb-3">
                            <div class="input-group col-sm">
                                <label for="gestion_inicio">GESTION INICIO</label>
                                <div class="input-group col-sm">
                                    <input type="text" name="gestion_inicio"
                                        class="form-control {{ $errors->has('gestion_inicio') ? 'is-invalid' : '' }}"
                                        value="{{ $detalle->gestion_inicio }}" readonly autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-calendar-times {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group col-sm">
                                <label for="gestion_fin">GESTION FIN</label>
                                <div class="input-group col-sm">
                                    <input type="text" name="gestion_fin"
                                        class="form-control {{ $errors->has('gestion_fin') ? 'is-invalid' : '' }}"
                                        value="{{ $detalle->gestion_fin }}" readonly autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span
                                                class="fas fa-calendar-times {{ config('adminlte.classes_auth_icon', '') }}"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END DATOS GESTION -->
                        <!-- FECHA SOLICITUD -->
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="fecha_solicitud">FECHA DE SOLICITUD</label>
                                <div class="col-sm">
                                    <input type="date" name="fecha_solicitud"
                                        class="form-control {{ $errors->has('fecha_solicitud') ? 'is-invalid' : '' }}"
                                        value="{{ date('Y-m-d') }}" readonly autofocus>
                                    @if ($errors->has('fecha_solicitud'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('fecha_solicitud') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm">
                                <label for="fecha_inicio">FECHA INCIO</label>
                                <div class="col-sm">
                                    <input type="date" id="fecha_inicio" name="fecha_inicio"
                                        class="form-control {{ $errors->has('fecha_inicio') ? 'is-invalid' : '' }}"
                                        value="{{ date('Y-m-d') }}" autofocus>
                                    @if ($errors->has('fecha_inicio'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('fecha_inicio') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm">
                                <label for="fecha_fin">FECHA FIN</label>
                                <div class="col-sm">
                                    <input type="date" id="fecha_fin" name="fecha_fin"
                                        class="form-control fecha_fin {{ $errors->has('fecha_fin') ? 'is-invalid' : '' }}"
                                        value="{{ date('Y-m-d') }}" autofocus>
                                        <div class="invalid-feedback">
                                            <strong>Fecha Fin debe ser mayor a la fecha Inicio</strong>
                                        </div>
                                    @if ($errors->has('fecha_fin'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('fecha_fin') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- END FECHA SOLICITUD -->
                        <!-- DIAS SOLICITADOS -->
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="dias_solicitados">DIAS SOLICITADOS</label>
                                <div class="col-sm">
                                    <input type="text" name="dias_solicitados"
                                        class="form-control {{ $errors->has('dias_solicitados') ? 'is-invalid' : '' }}"
                                        value="{{ old('dias_solicitados') }}" autofocus>
                                    @if ($errors->has('dias_solicitados'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('dias_solicitados') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm">
                                <label for="autorizado_por">AUTORIZADO POR</label>
                                <div class="col-sm">
                                    <select name="autorizado_por" id="autorizado_por" class="form-control required select2">
                                        <option value="0" selected>--SELECCIONE--</option>
                                        @foreach ($trabajador as $key)
                                            <option value='{{ $key->id }}'>
                                                {{ $key->nombre }}&nbsp;{{ $key->apellido_paterno }}&nbsp;{{ $key->apellido_materno }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- END DIAS SOLICITADOS -->
                        <!-- OBSERVACIONES -->
                        <div class="row mb-3">
                            <div class="col-sm">
                                <label for="hora_salida_t">OBSERVACIONES</label>
                                <div class="col-sm">
                                    <textarea id="observaciones" name="observaciones" rows="4" cols="30"
                                        onkeyup="mayus(this);" value="-" class="form-control text">-</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- END OBSERVACIONES -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-block btn-primary">Registrar</button>
                    </div>
                </form>
                {{-- Fin de formulario --}}
            </div>
        </div>
    </div>

@stop

@section('js')
    <script>
        function mayus(e) {
            e.value = e.value.toUpperCase();
        }
    </script>
    <script>
        $(() => {
            $('.select2').select2();

            $("#fecha_inicio").change(function() {
                var x = $("#fecha_fin").val();
                var y = $("#fecha_inicio").val();
                if(x <= y)
                {
                    $('.fecha_fin').addClass('is-invalid')
                }

            });
            $("#fecha_fin").change(function() {
                var x = $("#fecha_fin").val();
                var y = $("#fecha_inicio").val();
                if(x > y)
                {
                    $('.fecha_fin').removeClass('is-invalid')
                }

            });
        });
    </script>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
