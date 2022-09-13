@extends('adminlte::page')

@section('title', 'Planilla')

@section('content_header')
    <h1>Planillas</h1>
    <div class="col-12 mb-2">
        <button id="nueva_planilla" class="btn btn-success btn-sm">Crear planilla <i class="fa fa-plus-circle"></i></button>
        <button id="cargar_planilla" class="btn btn-warning btn-sm">Cargar planilla <i class="fa fa-edit"></i></button>
        <button id="resumen_planilla" class="btn btn-primary btn-sm">Resumen planilla <i class="fa fa-file"></i></button>
        <button id="eliminar_planilla" class="btn btn-danger btn-sm">Eliminar planilla <i
                class="fa fa-times-circle"></i></button>
    </div>
@stop
@section('content')
    <div class="card card-info card-outline">
        <div class="card-body sinpadding">

            <div class="table table-bordered table-hover dataTable table-responsive">
                <table class="table table-bordered table-striped display nowrap datatable data_table"
                    id="table_nombre_planilla">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="d-none">id</th>
                            <th>Nombre Planilla</th>
                            <th>Fecha creacion</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lista_planillas as $planilla)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td class="d-none">{{ $planilla->id }}</td>
                                <td>{{ $planilla->nombre_planilla }}</td>
                                <td>{{ $planilla->fecha_creacion->format('d-m-Y') }}</td>
                                @if ($planilla->estado == 'ACTIVO')
                                    <td align="center"><span class="badge badge-success">{{ $planilla->estado }}</span></td>
                                @else
                                    <td align="center"><span class="badge badge-danger">{{ $planilla->estado }}</span></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
            table_nombre_planilla = $('#table_nombre_planilla').DataTable({
                autoWidth: false,
                responsive: true,
                scrollY: "45vh",
                scrollX: false,
                select: true,
                language: {
                    url: "../../vendor/funciones/datatable_spanish.json"
                },
                dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            });
            $(document).on('click', '#borrarPlanilla', function() {
                var id = $(this).data('id');
            });

            $('#nueva_planilla').on('click', function() {
                var link = "{{ route('nombre_planilla.create') }}";
                $(location).attr('href', link);
            });
            $('#cargar_planilla').on('click', function() {
                var data = table_nombre_planilla.rows('tr.selected').data().toArray();
                if (data.length != 0) {
                    const id = data[0][1];
                    var url = '{{ route("planilla.lista", ":id") }}';
                    url = url.replace(':id', id);
                    var link = url;
                    $(location).attr('href', link);
                } else {
                    Swal.fire({
                        title: 'Por favor, seleccione un registro',
                        icon: 'warning',
                        confirmButtonText: 'Aceptar',
                    });
                }
            });

            $('#resumen_planilla').on('click', function() {
                var data = table_nombre_planilla.rows('tr.selected').data().toArray();
                if (data.length != 0) {
                    // var id_planilla = data[0]['id'];
                    console.log(data[0][1]);
                    const id = data[0][1];
                    var link = "/planilla_general/resumen/" + id;
                    $(location).attr('href', link);
                } else {
                    Swal.fire({
                        title: 'Por favor, seleccione un registro',
                        icon: 'warning',
                        confirmButtonText: 'Aceptar',
                    });
                }
            });

            // cargar planilla

            $('#eliminar_planilla').on('click', function() {
                var data = table_nombre_planilla.rows('tr.selected').data().toArray();
                if (data.length != 0) {
                    // var id_planilla = data[0]['id'];
                    console.log(data[0][1]);
                    const id = data[0][1];
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    Swal.fire({
                        title: '¿Está seguro?',
                        text: "¿Eliminar planilla?",
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
                                url: "/planilla/nombre_planilla/"+id,
                                method: 'DELETE',
                                success: function(result) {
                                    if (result.success) {
                                        Swal.fire({
                                            text: result.message,
                                            icon: 'success',
                                            confirmButtonColor: 'green',
                                            confirmButtonText: 'Ok',
                                            width: 300,
                                            allowOutsideClick: false,
                                            reverseButtons: true
                                        }).then(function(result) {
                                            if (result.value) {
                                                window.location.reload()
                                            }
                                        });
                                    } else {
                                        toastr.error(result.msg);
                                    }
                                },
                                error: function(response, status, xhr) {
                                    console.log(response);
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
                    // var link = "trabajador/" + id_trabajador + "/mostrar";
                    // $(location).attr('href', link);
                } else {
                    Swal.fire({
                        title: 'Por favor, seleccione un registro',
                        icon: 'warning',
                        confirmButtonText: 'Aceptar',
                    });
                }
            });

            //

        });
    </script>
@stop
