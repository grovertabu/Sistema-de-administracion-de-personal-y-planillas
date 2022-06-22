@extends('adminlte::page')

@section('title', 'Asistencias')

@section('content_header')
    <h1>Lista de Asistencia Periodo {{ $mes . '/' . $gestion }}</h1>
    <div class="row">
        <div class="col-12 mb-2">
            <a href="{{ route('asistencia.create_all', [$mes, $gestion, $tipo_contrato]) }}" id="generar_planilla"
                class="btn btn-primary btn-sm">Generar planilla <i class="fa fa-plus-circle"></i></a>
            <a href="{{ route('asistencia.create', [$mes, $gestion, $tipo_contrato]) }}" id="individual_asistencia"
                class="btn btn-success btn-sm">Crear Asistencia Individual <i class="fa fa-plus-circle"></i></a>
            <button id="eliminar_planilla" class="btn btn-danger btn-sm">Eliminar Planilla <i
                    class="fa fa-times-circle"></i></button>
            <button id="view_pdf_planilla" class="btn btn-default float-right" {{$lista_asistencia->count() > 0 ? '' :'disabled'}}>Imprimir Planilla <i
                        class="fa fa-file-pdf"></i></button>
        </div>
    </div>
@stop

@section('content')

    <div class="card card-info card-outline">
        <div class="card-body sinpadding">
            <div class="table table-bordered table-hover dataTable table-responsive">
                <table style="width:100%" class="table table-striped table-bordered datatable display nowrap data_table"
                    id="table_asistencias">
                    <thead>
                        <tr>
                            @if ($tipo_contrato == 1)
                                <th>ITEM</th>
                            @endif
                            <th>Trabajador</th>
                            <th>Cargo</th>
                            <th>Días laborables</th>
                            <th>Días trabajados</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lista_asistencia as $asistencia)
                            <tr>
                                @if ($tipo_contrato == 1)
                                    <td>{{ intval($asistencia->item) }}</td>
                                @endif
                                <td>{{ mb_strtoupper($asistencia->nombre_completo) }}</td>
                                <td>{{ $asistencia->nombre_cargo }}</td>
                                <td>{{ $asistencia->dias_laborales }}</td>
                                <td>{{ $asistencia->dias_asistencia }}</td>
                                <td>
                                    <a href="{{ route('asistencia.editar', $asistencia->id) }}" title='editar'
                                        class='btn btn-warning btn-icon btn-sm'> <i class="fas fa-edit"></i></a>
                                    <button type="button" data-id="{{ $asistencia->id }}" class="btn btn-danger btn-sm"
                                        title='eliminar' id="deleteAsistencia"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('planillas.asistencia.modal_pdf')
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
        table_asistencias = $('#table_asistencias').DataTable({
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
            $(document).on('click', '#deleteAsistencia', function() {
                var id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                Swal.fire({
                    text: "¿Está seguro de eliminar la asistencia?",
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
                            url: '/planilla/asistencia/' + id,
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
                            url: "/planilla/asistencias/{{ $mes . '/' . $gestion . '/' . $tipo_contrato }}",
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
                $('.modal_planilla_asistencia').modal("show");
                // Iframe para incrustrar la planilla
                html = '<div class="col-12 justify-content-center row">' +
                    '<iframe src="/planilla/asistencias-pdf/{{$mes}}/{{$gestion}}/{{$tipo_contrato}}"' +
                    'width="1900" height="430">' +
                    '</iframe>' +
                    '</div>';
                $('#contenido_planilla').html(html);
            });
        });
    </script>
@stop
