@extends('adminlte::page')

@section('title', 'Fondo Empleados')

@section('content_header')
    <h1>Lista de Fondo Empleados Periodo {{ $mes . '/' . $gestion }}</h1>
    <div class="row">
        <div class="col-12 mb-2">
            <a href="{{ route('fondo_empleado.create_all', [$mes, $gestion, $tipo_contrato]) }}" id="generar_planilla"
                class="btn btn-primary btn-sm">Generar planilla <i class="fa fa-plus-circle"></i></a>
            {{-- <a href="{{ route('fondo_empleado.create', [$mes, $gestion, $tipo_contrato]) }}" id="individual_fondo_empleado"
                class="btn btn-success btn-sm">Crear Otro descuento Individual <i class="fa fa-plus-circle"></i></a> --}}
            <button id="eliminar_planilla" class="btn btn-danger btn-sm">Eliminar Planilla <i
                    class="fa fa-times-circle"></i></button>
            <button id="view_pdf_planilla" class="btn btn-default float-right" {{$lista_fondo_empleado->count() > 0 ? '' :'disabled'}}>Imprimir Planilla <i
                        class="fa fa-file-pdf"></i></button>
        </div>
    </div>
@stop

@section('content')

    <div class="card card-info card-outline">
        <div class="card-body sinpadding">
            <div class="table table-bordered table-hover dataTable table-responsive">
                <table style="width:100%" class="table table-striped table-bordered datatable data_table"
                    id="table_fondo_empleados">
                    <thead>
                        <tr>
                            <th>ITEM</th>
                            <th width="250px">Trabajador</th>
                            <th>Porcentaje</th>
                            <th>Total ganado</th>
                            <th>Descuento F.E.</th>
                            <th>Pago deuda</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($lista_fondo_empleado as $fondo_empleado)
                        <tr>
                            <td>{{ intval($fondo_empleado->item) }}</td>
                            <td>{!! mb_strtoupper($fondo_empleado->nombre_completo).'<br><b>CARGO: </b>'.$fondo_empleado->nombre_cargo  !!}</td>
                            <td>{{ Funciones::formatMoney($fondo_empleado->porcentaje_fe) }}</td>
                            <td>{{ Funciones::formatMoney($fondo_empleado->total_ganado) }}</td>
                            <td>{{ Funciones::formatMoney($fondo_empleado->monto_fe) }}</td>
                            <td>{{ Funciones::formatMoney($fondo_empleado->pago_deuda) }}</td>
                            <td>{{ Funciones::formatMoney($fondo_empleado->total_fe) }}</td>
                            <td>
                                <a href="{{ route('fondo_empleado.editar', $fondo_empleado->id) }}" title='editar'
                                    class='btn btn-warning btn-icon btn-sm'> <i class="fas fa-edit"></i></a>
                                {{-- <button type="button" data-id="{{ $fondo_empleado->id }}" class="btn btn-danger btn-sm"
                                    title='eliminar' id="delete_registro"><i class="fas fa-trash"></i></button> --}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('planillas.fondo_empleado.modal_pdf')
@stop
@section('footer')
    <strong>{{ date('Y') }} || ELAPAS - SISTEMA DE RECURSOS HUMANOS </strong>
@stop
@section('js')
    @if (session('message'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                title: '{{ session('message') }}',
            })
        </script>
    @endif
    @if (session('create'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('create') }}',
            })
        </script>
    @endif
    @if (session('edit'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Oops...',
                title: '{{ session('edit') }}',
            })
        </script>
    @endif
    <script>
        table_fondo_empleados = $('#table_fondo_empleados').DataTable({
            responsive: true,
            pagingType: "full_numbers",
            scrollY: "43vh",
            scrollX: true,
            deferRender: true,

            // order: [[0, 'asc']],
            columnDefs: [{
                searchable: false,
                orderable: false,
                targets: [-1],
            }, ],
            autoWidth: true,

            language: {
                url: "../../vendor/funciones/datatable_spanish.json"
            },
        });
        $(document).ready(function() {
            $(document).on('click', '#delete_registro', function() {
                var id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                Swal.fire({
                    text: "¿Está seguro de eliminar el registro?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'green',
                    cancelButtonColor: 'red',
                    confirmButtonText: 'Si, eliminar',
                    cancelButtonText: 'Cancelar',
                    width: 300,
                    allowOutsideClick: false,
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: '/planilla/fondo_empleado/' + id,
                            method: 'DELETE',
                            success: function(resp) {
                                if (resp.success) {
                                    Swal.fire({
                                        text: resp.message,
                                        icon: 'success',
                                        confirmButtonColor: 'green',
                                        confirmButtonText: 'Aceptar',
                                        width: 400,
                                        allowOutsideClick: false,
                                        reverseButtons: true
                                    }).then(function(result) {
                                        if (result.value) {
                                            window.location.reload()
                                        }
                                    });
                                } else {
                                    toastr.error(resp.message);
                                }
                            },
                            error: function(response, status, xhr) {
                                Swal.fire({
                                    text: response.responseJSON.message,
                                    icon: 'warning',
                                    confirmButtonText: 'Aceptar',
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            });

            // ELiminar Planilla
            $(document).on('click', '#eliminar_planilla', function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                Swal.fire({
                    text: "¿Está seguro de eliminar la planilla?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'green',
                    cancelButtonColor: 'red',
                    confirmButtonText: 'Si, eliminar',
                    cancelButtonText: 'Cancelar',
                    width: 300,
                    allowOutsideClick: false,
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: "/planilla/fondo_empleados/{{ $mes . '/' . $gestion . '/' . $tipo_contrato }}",
                            method: 'DELETE',
                            success: function(resp) {
                                if (resp.success) {
                                    Swal.fire({
                                        text: resp.message,
                                        icon: 'success',
                                        confirmButtonColor: 'green',
                                        confirmButtonText: 'Aceptar',
                                        width: 400,
                                        allowOutsideClick: false,
                                        reverseButtons: true
                                    }).then(function(result) {
                                        if (result.value) {
                                            window.location.reload()
                                        }
                                    });
                                } else {
                                    toastr.error(resp.message);
                                }
                            },
                            error: function(response, status, xhr) {
                                Swal.fire({
                                    text: response.responseJSON.message,
                                    icon: 'warning',
                                    confirmButtonText: 'Aceptar',
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            });

            $('body').on('click', '#view_pdf_planilla', function(e) {
                e.preventDefault();
                $('.modal_planilla_fondo_empleado').modal("show");
                // Iframe para incrustrar la planilla
                html = '<div class="col-12 justify-content-center row">' +
                    '<iframe src="/planilla/fondo_empleados-pdf/{{$mes}}/{{$gestion}}/{{$tipo_contrato}}"' +
                    'width="1900" height="430">' +
                    '</iframe>' +
                    '</div>';
                $('#contenido_planilla').html(html);
            });
        });
    </script>
@stop
