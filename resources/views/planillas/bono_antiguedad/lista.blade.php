@extends('adminlte::page')

@section('title', 'Bonos de Antiguedad')

@section('content_header')
    <h1>Lista de Bonos de Antiguedad Periodo {{ $mes . '/' . $gestion }}</h1>
    <div class="row">
        <div class="col-12 mb-2">
            <a href="{{ route('bono_antiguedad.create_all', [$mes, $gestion, $tipo_contrato]) }}" id="generar_planilla"
                class="btn btn-primary btn-sm">Generar planilla <i class="fa fa-plus-circle"></i></a>
            <a href="{{ route('bono_antiguedad.create', [$mes, $gestion, $tipo_contrato]) }}" id="individual_bono_antiguedad"
                class="btn btn-success btn-sm">Crear bono antiguedad Individual <i class="fa fa-plus-circle"></i></a>
            <button id="eliminar_planilla" class="btn btn-danger btn-sm">Eliminar Planilla <i
                    class="fa fa-times-circle"></i></button>
            <button id="view_pdf_planilla" class="btn btn-default float-right" {{$lista_bono_antiguedad->count() > 0 ? '' :'disabled'}}>Imprimir Planilla <i
                        class="fa fa-file-pdf"></i></button>
        </div>
    </div>
@stop

@section('content')

    <div class="card card-info card-outline">
        <div class="card-body sinpadding">
            <div class="table table-bordered table-hover dataTable table-responsive">
                <table style="width:100%" class="table table-striped table-bordered datatable display nowrap data_table"
                    id="table_bono_antiguedads">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Trabajador</th>
                            <th>Ant. otras inst.</th>
                            <th>Fecha ingreso</th>
                            <th>Fecha calculo</th>
                            <th>Antiguedad</th>
                            <th>Porcentaje</th>
                            <th>Total bono</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($lista_bono_antiguedad as $bono_antiguedad)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{ mb_strtoupper($bono_antiguedad->nombre_completo) }}</td>
                                <td>{{ $bono_antiguedad->anios_arrastre}}AÑOS<br/>{{$bono_antiguedad->meses_arrastre}}MESES<br/>{{$bono_antiguedad->dias_arrastre }}DÍAS</td>
                                <td>{{ $bono_antiguedad->fecha_ingreso->format('d-m-Y') }}</td>
                                <td>{{ $bono_antiguedad->fecha_calculo->format('d-m-Y') }}</td>
                                <td>{{ $bono_antiguedad->anios_actual}}AÑOS<br/>{{$bono_antiguedad->meses_actual}}MESES<br/>{{$bono_antiguedad->dias_actual }}DÍAS</td>
                                <td>{{ $bono_antiguedad->porcentaje }}</td>
                                <td>{{ formatNumber($bono_antiguedad->monto) }}</td>
                                <td>
                                    <a href="{{ route('bono_antiguedad.editar', $bono_antiguedad->id) }}" title='editar'
                                        class='btn btn-warning btn-icon btn-sm'> <i class="fas fa-edit"></i></a>
                                    <button type="button" data-id="{{ $bono_antiguedad->id }}" class="btn btn-danger btn-sm"
                                        title='eliminar' id="deleteBono_antiguedad"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('planillas.bono_antiguedad.modal_pdf')
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
                title: '{{ session('edit') }}',
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
    <script>
        table_bono_antiguedads = $('#table_bono_antiguedads').DataTable({
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
            $(document).on('click', '#deleteBono_antiguedad', function() {
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
                            url: '/planilla/bono_antiguedad/' + id,
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
                            url: "/planilla/bono_antiguedads/{{ $mes . '/' . $gestion . '/' . $tipo_contrato }}",
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
                $('.modal_planilla_bono_antiguedad').modal("show");
                // Iframe para incrustrar la planilla
                html = '<div class="col-12 justify-content-center row">' +
                    '<iframe src="/planilla/bono_antiguedads-pdf/{{$mes}}/{{$gestion}}/{{$tipo_contrato}}"' +
                    'width="1900" height="430">' +
                    '</iframe>' +
                    '</div>';
                $('#contenido_planilla').html(html);
            });
        });
    </script>
@stop
