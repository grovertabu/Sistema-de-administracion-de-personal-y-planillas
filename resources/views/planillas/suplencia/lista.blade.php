@extends('adminlte::page')

@section('title', 'Suplencias')

@php
$i = 1;
@endphp
@section('content_header')
    <h1>Lista de Planilla de Suplencias Periodo {{ $mes . '/' . $gestion }}</h1>
    <div class="row">
        <div class="col-12 mb-2">
            <a href="{{ route('suplencia.create', [$mes, $gestion, $tipo_contrato]) }}" id="individual_suplencia"
                class="btn btn-success btn-sm">Registrar Suplencia <i class="fa fa-plus-circle"></i></a>
            <button id="view_pdf_planilla" class="btn btn-default float-right"
                {{ $lista_suplencia->count() > 0 ? '' : 'disabled' }}>Imprimir Planilla <i
                    class="fa fa-file-pdf"></i></button>
        </div>
    </div>
@stop

@section('content')

    <div class="card card-info card-outline">
        <div class="card-body sinpadding">
            <div class="table table-bordered table-hover dataTable table-responsive">
                <table style="width:100%" class="table table-striped table-bordered datatable display nowrap data_table"
                    id="table_suplencias">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Trabajador</th>
                            <th>Fecha inicio</th>
                            <th>Fecha fin</th>
                            <th>Total días</th>
                            <th>Cargo suplencia</th>
                            <th>Salario</th>
                            <th>Monto x Suplencia</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lista_suplencia as $suplencia)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ mb_strtoupper($suplencia->nombre_completo) }}</td>
                                <td>{{ $suplencia->fecha_inicio->format('d-m-Y') }}</td>
                                <td>{{ $suplencia->fecha_fin->format('d-m-Y') }}</td>
                                <td>{{ $suplencia->total_dias }}</td>
                                <td>{{ $suplencia->cargo_suplencia }}</td>
                                <td>{{ $suplencia->salario_mensual }}</td>
                                <td>{{ Funciones::formatMoney($suplencia->monto) }}</td>
                                <td>
                                    <a href="{{ route('suplencia.editar', $suplencia->id) }}" title='editar'
                                        class='btn btn-warning btn-icon btn-sm'> <i class="fas fa-edit"></i></a>
                                    <button type="button" data-id="{{ $suplencia->id }}" class="btn btn-danger btn-sm"
                                        title='eliminar' id="deleteSuplencia"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('planillas.suplencia.modal_pdf')
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
        table_suplencias = $('#table_suplencias').DataTable({
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
            $(document).on('click', '#deleteSuplencia', function() {
                var id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                Swal.fire({
                    text: "¿Está seguro de eliminar la suplencia?",
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
                            url: '/planilla/suplencia/' + id,
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
                $('.modal_planilla_suplencia').modal("show");
                // Iframe para incrustrar la planilla
                html = '<div class="col-12 justify-content-center row">' +
                    '<iframe src="/planilla/suplencias-pdf/{{ $mes }}/{{ $gestion }}/{{ $tipo_contrato }}"' +
                    'width="1900" height="430">' +
                    '</iframe>' +
                    '</div>';
                $('#contenido_planilla').html(html);
            });
        });
    </script>
@stop
