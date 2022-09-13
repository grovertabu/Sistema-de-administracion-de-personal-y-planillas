@extends('adminlte::page')

@section('title', 'Planilla Impositiva')

@section('content_header')
    @php
    $i = 1;
    @endphp
    <h1>Lista de Planilla Impositiva Periodo {{ $mes . '/' . $gestion }}</h1>
    <div class="row">
        <div class="col-12 mb-2">
            <a href="{{ route('impositiva.create_all', [$mes, $gestion, $tipo_contrato]) }}" id="generar_planilla"
                class="btn btn-primary btn-sm">Generar planilla <i class="fa fa-plus-circle"></i></a>
            {{-- <a href="{{ route('impositiva.create', [$mes, $gestion, $tipo_contrato]) }}" id="individual_impositiva"
                class="btn btn-success btn-sm">Crear registro individual <i class="fa fa-plus-circle"></i></a> --}}
            <button id="eliminar_planilla" class="btn btn-danger btn-sm">Eliminar Planilla <i
                    class="fa fa-times-circle"></i></button>
            {{-- <button id="eliminar_registro" class="btn btn-warning btn-sm">Eliminar Registro <i
                class="fa fa-times-circle"></i></button> --}}
            <button id="view_pdf_planilla" class="btn btn-default float-right"
                {{ $lista_impositiva->count() > 0 ? '' : 'disabled' }}>Imprimir Planilla <i
                    class="fa fa-file-pdf"></i></button>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-info card-outline">
        <div class="card-body sinpadding">
            <div class="table table-bordered table-hover dataTable table-responsive">
                <table style="width:100%" class="table table-striped table-bordered datatable display nowrap data_table"
                    id="table_impositivas">
                    <thead>
                        <tr>
                            <th rowspan="2">Item</th>
                            <th rowspan="2">Trabajador</th>
                            <th rowspan="2">Total Ganado</th>
                            <th rowspan="2">Aporte laboral</th>
                            <th rowspan="2">Refrigerio</th>
                            <th rowspan="2">Sueldo neto</th>
                            <th rowspan="2">Minimo <br> no imponible</th>
                            <th rowspan="2">Base imponible</th>
                            <th rowspan="2">Imp 13% BI</th>
                            <th rowspan="2">IVA F110</th>
                            <th rowspan="2">13% 2SM</th>
                            <th colspan="2">Saldo a favor</th>
                            <th colspan="3">Saldo ant a favor depen</th>
                            <th rowspan="2">Saldo <br> total depen</th>
                            <th rowspan="2">Saldo utilizado</th>
                            <th rowspan="2">Impuesto <br> retenido a pagar</th>
                            <th rowspan="2">Saldo depen sgte. mes</th>
                            <th rowspan="2"></th>
                        </tr>
                        <tr>
                            <th>Fisco</th>
                            <th>Dependiente</th>
                            <th>Mes ant.</th>
                            <th>Actualiz.</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lista_impositiva as $impositiva)
                            <tr>
                                @if ($tipo_contrato == 1)
                                    <td>{{ intval($impositiva->item) }}</td>
                                @endif
                                <td>{!! mb_strtoupper($impositiva->nombre_completo)  !!}</td>
                                <td>{{ Funciones::formatMoney($impositiva->total_ganado) }}</td>
                                <td>{{ Funciones::formatMoney($impositiva->aportes_laborales) }}</td>
                                <td>{{ Funciones::formatMoney($impositiva->total_refrigerio) }}</td>
                                <td>{{ Funciones::formatMoney($impositiva->sueldo_neto) }}</td>
                                <td>{{ Funciones::formatMoney($impositiva->minimo_no_imponible) }}</td>
                                <td>{{ Funciones::formatMoney($impositiva->base_imponible) }}</td>
                                <td>{{ Funciones::formatMoney($impositiva->impuesto_bi) }}</td>
                                <td>{{ Funciones::formatMoney($impositiva->presentacion_desc) }}</td>
                                <td>{{ Funciones::formatMoney($impositiva->impuesto_mn) }}</td>
                                <td>{{ Funciones::formatMoney($impositiva->saldo_fisco) }}</td>
                                <td>{{ Funciones::formatMoney($impositiva->saldo_dependiente) }}</td>
                                <td>{{ Funciones::formatMoney($impositiva->saldo_mes_anterior) }}</td>
                                <td>{{ Funciones::formatMoney($impositiva->actualizacion) }}</td>
                                <td>{{ Funciones::formatMoney($impositiva->saldo_total_mes_anterior) }}</td>
                                <td>{{ Funciones::formatMoney($impositiva->saldo_total_dependiente) }}</td>
                                <td>{{ Funciones::formatMoney($impositiva->saldo_utilizado) }}</td>
                                <td>{{ Funciones::formatMoney($impositiva->retencion_pagar) }}</td>
                                <td>{{ Funciones::formatMoney($impositiva->saldo_siguiente_mes) }}</td>
                                <td>
                                    <a href="{{ route('impositiva.editar', $impositiva->id) }}" title='editar'
                                        class='btn btn-warning btn-icon btn-sm'> <i class="fas fa-edit"></i></a>
                                    {{-- <button type="button" data-id="{{ $impositiva->id }}" class="btn btn-danger btn-sm"
                                        title='eliminar' id="deleteimpositiva"><i class="fas fa-trash"></i></button> --}}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('planillas.impositiva.modal_pdf')
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
        table_impositivas = $('#table_impositivas').DataTable({
            responsive: true,
            pagingType: "full_numbers",
            scrollY: "40vh",
            scrollX: true,
            deferRender: true,
            select: true,
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
            $(document).on('click', '#deleteimpositiva', function() {
                var id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                Swal.fire({
                    text: "¿Está seguro de eliminar la Impositiva?",
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
                            url: '/planilla/impositiva/' + id,
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
                            url: "/planilla/impositivas/{{ $mes . '/' . $gestion . '/' . $tipo_contrato }}",
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
                $('.modal_planilla_impositiva').modal("show");
                // Iframe para incrustrar la planilla
                html = '<div class="col-12 justify-content-center row">' +
                    '<iframe src="/planilla/impositivas-pdf/{{ $mes }}/{{ $gestion }}/{{ $tipo_contrato }}"' +
                    'width="1900" height="430">' +
                    '</iframe>' +
                    '</div>';
                $('#contenido_planilla').html(html);
            });

            // Eliminar un registro
            //  $('#eliminar_registro').on('click', function() {
            //     var data = table_impositivas.rows('tr.selected').data().toArray();
            //     if (data.length != 0) {
            //         var id_asignacion = data[0][1];
            //         console.log(id_asignacion)

            //     } else {
            //         Swal.fire({
            //             title: 'Por favor, seleccione un registro',
            //             icon: 'warning',
            //             confirmButtonText: 'Aceptar',
            //         });
            //     }

            // });
        });
    </script>
@stop
