@extends('adminlte::page')

@section('title', 'Planilla Aportes Laborales')

@section('content_header')
@php
    $i=1;
@endphp
    <h1>Lista de Planilla Aportes Laborales Periodo {{ $mes . '/' . $gestion }}</h1>
    <div class="row">
        <div class="col-12 mb-2">
            <a href="{{ route('aporte_laboral.create_all', [$mes, $gestion, $tipo_contrato]) }}" id="generar_planilla"
                class="btn btn-primary btn-sm">Generar planilla <i class="fa fa-plus-circle"></i></a>
            {{-- <a href="{{ route('aporte_laboral.create', [$mes, $gestion, $tipo_contrato]) }}" id="individual_aporte_laboral"
                class="btn btn-success btn-sm">Crear registro individual <i class="fa fa-plus-circle"></i></a> --}}
            <button id="eliminar_planilla" class="btn btn-danger btn-sm">Eliminar Planilla <i
                    class="fa fa-times-circle"></i></button>
            {{-- <button id="eliminar_registro" class="btn btn-warning btn-sm">Eliminar Registro <i
                class="fa fa-times-circle"></i></button> --}}
            <button id="view_pdf_planilla" class="btn btn-default float-right"
                {{ $lista_aporte_laboral->count() > 0 ? '' : 'disabled' }}>Imprimir Planilla <i
                    class="fa fa-file-pdf"></i></button>
        </div>
    </div>
@stop

@section('content')
    <div class="card card-info card-outline">
        <div class="card-body sinpadding">
            <div class="table table-bordered table-hover dataTable table-responsive">
                <table style="width:100%" class="table table-striped table-bordered datatable display nowrap data_table"
                    id="table_aporte_laborals">
                    <thead>
                        <tr>
                            <th>Nro</th>
                            <th class="d-none">id</th>
                            <th>Trabajador</th>
                            <th>Total Ganado</th>
                            <th>Tipo aporte</th>
                            <th>Porcentaje</th>
                            <th>Monto aporte</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lista_aporte_laboral as $aporte_laboral)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td class="d-none">{{$aporte_laboral->id}}</td>
                                <td>{{ mb_strtoupper($aporte_laboral->trabajador->nombre_completo) }} <br>
                                <strong>CARGO: </strong> {{ $aporte_laboral->nomina_cargo->cargo->nombre }}</td>
                                <td>{{ Funciones::formatMoney($aporte_laboral->planilla_total_ganados[0]->total_ganado) }}</td>
                                <td>
                                    <ul style="margin-left: 10px">
                                        @foreach ($aporte_laboral->planilla_aporte_laborals as $p_aporte )
                                        <li>{{$p_aporte->tipo_aporte}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <ul style="margin-left: 10px">
                                        @foreach ($aporte_laboral->planilla_aporte_laborals as $p_aporte )
                                        <li>{{$p_aporte->porcentaje_aporte}}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <ul style="margin-left: 10px">
                                        @foreach ($aporte_laboral->planilla_aporte_laborals as $p_aporte )
                                        <li>{{Funciones::formatMoney($p_aporte->monto_aporte)}}

                                        </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <dl style="font-size:14px">
                                        @foreach ($aporte_laboral->planilla_aporte_laborals as $p_aporte )
                                        <dt>
                                            <a href="{{ route('aporte_laboral.editar', $p_aporte->id) }}" title='editar'
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

    @include('planillas.aporte_laboral.modal_pdf')
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
        table_aporte_laborals = $('#table_aporte_laborals').DataTable({
            responsive: true,
            pagingType: "full_numbers",
            scrollY: "43vh",
            scrollX: true,
            deferRender: true,
            select:true,
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
            $(document).on('click', '#deleteaporte_laboral', function() {
                var id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                Swal.fire({
                    text: "¿Está seguro de eliminar la Aportes Laborales?",
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
                            url: '/planilla/aporte_laboral/' + id,
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
                            url: "/planilla/aporte_laborals/{{ $mes . '/' . $gestion . '/' . $tipo_contrato }}",
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
                $('.modal_planilla_aporte_laboral').modal("show");
                // Iframe para incrustrar la planilla
                html = '<div class="col-12 justify-content-center row">' +
                    '<iframe src="/planilla/aporte_laborals-pdf/{{ $mes }}/{{ $gestion }}/{{ $tipo_contrato }}"' +
                    'width="1900" height="430">' +
                    '</iframe>' +
                    '</div>';
                $('#contenido_planilla').html(html);
            });

             // Eliminar un registro
            //  $('#eliminar_registro').on('click', function() {
            //     var data = table_aporte_laborals.rows('tr.selected').data().toArray();
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
