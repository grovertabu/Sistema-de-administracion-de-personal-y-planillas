@extends('adminlte::page')

@section('title', 'Lista Planilla General')

@php
$i = 1;
@endphp
@section('content_header')
    <h4>{{ $nombre_planilla->nombre_planilla . ' ' . $nombre_planilla->gestion }}</h4>
    <div class="col-12 mb-2">
        <button id="generar_planilla" class="btn btn-success btn-sm">Generar Planilla <i
                class="fa fa-plus-circle"></i></button>
        <button id="papeletas_pago_pdf" class="btn btn-primary btn-sm">Papeletas de pago <i class="fa fa-file"></i></button>
        <button id="eliminar_planilla" class="btn btn-danger btn-sm">Eliminar planilla <i
                class="fa fa-times-circle"></i></button>
        <button id="view_pdf_planilla" class="btn btn-default float-right">Imprimir Planilla <i
                class="fa fa-file-pdf"></i></button>
        @if ($estado <= 0)
            <button id="estado_planilla" data-estado="APROBADO" class="btn btn-success btn-sm">Aprobar <i
                    class="fa fa-edit"></i></button>
        @else
            <button id="estado_planilla" data-estado="REPROBADO" class="btn btn-warning btn-sm">Reprobar <i
                    class="fa fa-edit"></i></button>
        @endif

    </div>

@stop
@section('content')
    <div class="card card-info card-outline">
        <div class="card-body sinpadding">

            <div class="table table-bordered table-hover dataTable table-responsive">
                <table class="table table-bordered table-striped datatable data_table" id="table_lista_planilla">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Item</th>
                            <th>CI</th>
                            <th>NUA</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Cargo</th>
                            <th>Fecha ingreso</th>
                            <th>Dias pagado</th>
                            <th>Haber mensual</th>
                            <th>Haber basico</th>
                            <th>Bono antiguedad</th>
                            <th>Horas extra</th>
                            <th>Suplencia</th>
                            <th>Total ganado</th>
                            <th>Sindicato</th>
                            <th>Categoria Individual</th>
                            <th>Prima riesgo comun</th>
                            <th>Comision al ente</th>
                            <th>Total aporte solidario</th>
                            <th>RCIVA 13%</th>
                            <th>Otros descuentos</th>
                            <th>Fondo Social</th>
                            <th>Fondo empleados</th>
                            <th>Entidades financieras</th>
                            <th>Total Descuentos</th>
                            <th>Liquido pagable</th>
                            <th>Estado planilla</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($lista_planillas as $planilla)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $planilla->item }}</td>
                                <td>{{ $planilla->ci }}</td>
                                <td>{{ $planilla->nua }}</td>
                                <td>{{ $planilla->nombres }}</td>
                                <td>{{ $planilla->apellidos }}</td>
                                <td>{{ $planilla->cargo }}</td>
                                <td>{{ $planilla->fecha_ingreso->format('d-m-Y') }}</td>
                                <td>{{ $planilla->dias_pagados }}</td>
                                <td>{{ Funciones::formatMoney($planilla->haber_mensual) }}</td>
                                <td>{{ Funciones::formatMoney($planilla->haber_basico) }}</td>
                                <td>{{ Funciones::formatMoney($planilla->bono_antiguedad) }}</td>
                                <td>{{ Funciones::formatMoney($planilla->horas_extra) }}</td>
                                <td>{{ Funciones::formatMoney($planilla->suplencia) }}</td>
                                <td>{{ Funciones::formatMoney($planilla->total_ganado) }}</td>
                                <td>{{ Funciones::formatMoney($planilla->sindicato) }}</td>
                                <td>{{ Funciones::formatMoney($planilla->categoria_individual) }}</td>
                                <td>{{ Funciones::formatMoney($planilla->prima_riesgo_comun) }}</td>
                                <td>{{ Funciones::formatMoney($planilla->comision_ente) }}</td>
                                <td>{{ Funciones::formatMoney($planilla->total_aporte_solidario) }}</td>
                                <td>{{ Funciones::formatMoney($planilla->desc_rciva) }}</td>
                                <td>{{ Funciones::formatMoney($planilla->otros_descuentos) }}</td>
                                <td>{{ Funciones::formatMoney($planilla->fondo_social) }}</td>
                                <td>{{ Funciones::formatMoney($planilla->fondo_empleados) }}</td>
                                <td>{{ Funciones::formatMoney($planilla->entidades_financieras) }}</td>
                                <td>{{ Funciones::formatMoney($planilla->total_descuentos) }}</td>
                                <td>{{ Funciones::formatMoney($planilla->liquido_pagable) }}</td>
                                <td>{{ $planilla->estado }}</td>
                                <td></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('planillas.general.modal_pdf')
@stop
@section('footer')
    <strong>{{ date('Y') }} || ELAPAS - SISTEMA DE RECURSOS HUMANOS </strong>
@stop
@section('js')
    @if (session('create') == true)
        <script>
            toastr.success('Plnailla creada exitosamente', '', {
                timeout: 1000
            })
        </script>
    @endif
    <script>
        $(() => {
            table_lista_planilla = $('#table_lista_planilla').DataTable({
                autoWidth: false,
                responsive: true,
                scrollY: "50vh",
                scrollX: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                select: true,
                language: {
                    url: "../../vendor/funciones/datatable_spanish.json"
                },
                dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            });
            //Boton para crear nueva planilla general de pagos

            $('#generar_planilla').on('click', function() {
                var link = "{{ route('planilla.create', $nombre_planilla->id) }}";
                $(location).attr('href', link);
            });

            $('body').on('click', '#view_pdf_planilla', function(e) {
                e.preventDefault();
                $('.modal_planilla').modal("show");
                // Iframe para incrustrar la planilla
                html = '<div class="col-12 justify-content-center row">' +
                    '<iframe src="/planilla_general/planilla_pdf/{{ $nombre_planilla->id }}"' +
                    'width="1900" height="430">' +
                    '</iframe>' +
                    '</div>';
                $('#contenido_planilla').html(html);
            });

            $('body').on('click', '#papeletas_pago_pdf', function(e) {
                e.preventDefault();
                $('.modal_planilla').modal("show");
                // Iframe para incrustrar la planilla
                html = '<div class="col-12 justify-content-center row">' +
                    '<iframe src="/planilla_general/papeletas_pago/{{ $nombre_planilla->id }}"' +
                    'width="1900" height="430">' +
                    '</iframe>' +
                    '</div>';
                $('#contenido_planilla').html(html);
            });
            //

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
                            url: "/planilla_general/{{$nombre_planilla->id}}",
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

            $(document).on('click', '#estado_planilla', function() {
                const estado = $(this).data('estado');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                Swal.fire({
                    text: "¿Está seguro?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'green',
                    cancelButtonColor: 'red',
                    confirmButtonText: 'Si, seguro',
                    cancelButtonText: 'Cancelar',
                    width: 300,
                    allowOutsideClick: false,
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: "/planilla_general/estado/{{$nombre_planilla->id}}/"+estado,
                            method: 'GET',
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

        });
    </script>
@stop
