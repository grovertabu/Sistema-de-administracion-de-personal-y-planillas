@extends('adminlte::page')

@section('title', 'Planilla Descuentos')

@section('content_header')
@php
    $i=1;
@endphp
    <h1>Lista de Planilla Descuentos Periodo {{ $mes . '/' . $gestion }}</h1>
    <div class="row">
        <div class="col-12 mb-2">
            <a href="{{ route('descuento.create_all', [$mes, $gestion, $tipo_contrato]) }}" id="generar_planilla"
                class="btn btn-primary btn-sm">Generar planilla <i class="fa fa-plus-circle"></i></a>
            {{-- <a href="{{ route('descuento.create', [$mes, $gestion, $tipo_contrato]) }}" id="individual_descuento"
                class="btn btn-success btn-sm">Crear registro individual <i class="fa fa-plus-circle"></i></a> --}}
            <button id="eliminar_planilla" class="btn btn-danger btn-sm">Eliminar Planilla <i
                    class="fa fa-times-circle"></i></button>
            {{-- <button id="eliminar_registro" class="btn btn-warning btn-sm">Eliminar Registro <i
                class="fa fa-times-circle"></i></button> --}}
            <button id="view_pdf_planilla" class="btn btn-default float-right"
                {{ $lista_descuento->count() > 0 ? '' : 'disabled' }}>Imprimir Planilla <i
                    class="fa fa-file-pdf"></i></button>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-info card-outline">
        <div class="card-body sinpadding">
            <div class="table table-bordered table-hover dataTable table-responsive">
                <table style="width:100%" class="table table-striped table-bordered datatable display nowrap data_table"
                    id="table_descuentos">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th class="d-none">id</th>
                            <th>Trabajador</th>
                            <th>Nombre descuento</th>
                            <th>Monto</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lista_descuento as $descuento)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td class="d-none">{{$descuento->id}}</td>
                                <td>{{ mb_strtoupper($descuento->trabajador->nombre_completo) }} <br>
                                <strong>CARGO: </strong> {{ $descuento->nomina_cargo->cargo->nombre }}</td>
                                <td>
                                    <ul style="margin-left: 10px">
                                        @foreach ($descuento->planilla_descuentos as $p_descuento )
                                        <li>{{$p_descuento->nombre_descuento}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <ul style="margin-left: 10px">
                                        @foreach ($descuento->planilla_descuentos as $p_descuento )
                                        <li>{{$p_descuento->monto}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <dl style="font-size:14px">
                                        @foreach ($descuento->planilla_descuentos as $p_descuento )
                                        <dt>
                                            <a href="{{ route('descuento.editar', $p_descuento->id) }}" title='editar'
                                                class='badge bg-warning mt-1'>EDITAR</i></a>
                                        </dt>
                                        @endforeach
                                    </dl>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('planillas.descuento.modal_pdf')
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
        table_descuentos = $('#table_descuentos').DataTable({
            responsive: true,
            pagingType: "full_numbers",
            scrollY: "43vh",
            scrollX: true,
            deferRender: true,
            select:false,
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
            $(document).on('click', '#deletedescuento', function() {
                var id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                Swal.fire({
                    text: "¿Está seguro de eliminar la Descuentos?",
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
                            url: '/planilla/descuento/' + id,
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
                            url: "/planilla/descuentos/{{ $mes . '/' . $gestion . '/' . $tipo_contrato }}",
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
                $('.modal_planilla_descuento').modal("show");
                // Iframe para incrustrar la planilla
                html = '<div class="col-12 justify-content-center row">' +
                    '<iframe src="/planilla/descuentos-pdf/{{ $mes }}/{{ $gestion }}/{{ $tipo_contrato }}"' +
                    'width="1900" height="430">' +
                    '</iframe>' +
                    '</div>';
                $('#contenido_planilla').html(html);
            });

             // Eliminar un registro
            //  $('#eliminar_registro').on('click', function() {
            //     var data = table_descuentos.rows('tr.selected').data().toArray();
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
