@extends('adminlte::page')

@section('title', 'Trabajadores')
@section('content_header')
    <div class="row">
        <div class="col-6 mb-0">
            <h4>TRABAJADORES</h4>
        </div>
        <div class="col-6">
            <select data-column="9" class="filter-select form-control-select float-right" id="getEstado">
                <option value="TODOS">TODOS</option>
                <option value="VIGENTE" selected>VIGENTE</option>
                <option value="INHABILITADO">INHABILITADO</option>
            </select>
            <label for="estado" class="control-label float-right">Estado:&nbsp; </label>

        </div>
    </div>
@stop
@section('content')
    <div class="card card-secondary card-outline">
        <div class="card-body sinpadding">
            <div class="col-12 mb-2">
                <button id="nuevo_trabajador" class="btn btn-success btn-sm">Nuevo <i
                        class="fa fa-plus-circle"></i></button>
                <button id="modificar_trabajador" class="btn btn-warning btn-sm">Modificar <i
                        class="fa fa-edit"></i></button>
                <button id="file_trabajador" class="btn btn-primary btn-sm">File Digital <i class="fa fa-file"></i></button>
                <button id="eliminar_trabajador" class="btn btn-danger btn-sm">Eliminar <i
                        class="fa fa-times-circle"></i></button>
                <button id="view_pdf_ficha_personal" class="btn btn-default btn-sm">Ficha de Personal <i
                        class="fa fa-print"></i></button>
            </div>
            <x-datatable id="table_trabajador" :heads="[
                'Nro',
                'DOCUMENTO(CI)',
                'NRO. ASEGURADO',
                'NOMBRE COMPLETO',
                'DIRECCION',
                'SEXO',
                'NACIONALIDAD',
                'F. NACIMIENTO',
                'ANTIGUEDAD',
                'ESTADO',
            ]" :buttons="true" />
        </div>
        <div class="modal fade" id="modalTrabajador" role="dialog" data-backdrop="static" data-keyboard="false">
        </div>
    </div>
    @include('trabajador.modal_pdf')
@stop
@section('footer')
    <strong>{{ date('Y') }} || ELAPAS - SISTEMA DE RECURSOS HUMANOS </strong>
@stop
@section('js')
    <script>
        function lista_trabajadores() {
            //  tabla Trabajador
            table_trabajador = $('#table_trabajador').DataTable({
                ajax: {
                    url: "trabajador/lista",
                },
                columns: [{
                        data: null,
                        render: function(data, type, full, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        render: function(data, type, row) {
                            var guion = row['complemento'] == "null" || row['complemento'] == "" ? "" : "-";
                            var comp = row['complemento'] == "[null]" || row['complemento'] == "" ? " " :
                                row['complemento'];
                            return (row['ci'] + guion + "<span class='text-secondary'>" + comp + '</span>');
                        }
                    },
                    {
                        data: 'nro_asegurado'
                    },
                    {
                        render: function(data, type, row) {
                            trabajador = row['nombre'] + ' ' + row['apellido_paterno'] + ' ' + row[
                                'apellido_materno'];
                            return trabajador;
                        }
                    },
                    {
                        data: 'direccion'
                    },
                    {
                        data: 'sexo'
                    },
                    {
                        data: 'nacionalidad'
                    },
                    {
                        data: 'fecha_nacimiento'
                    },
                    {
                        render: function(data, type, row) {
                            trabajador = row['antiguedad_anios'] + ' AÑOS <br> ' + row['antiguedad_meses'] +
                                ' MESES<br> ' + row[
                                    'antiguedad_dias'] + ' DÍAS';
                            return trabajador;
                        }
                    },
                    {
                        render: function(data, type, row) {
                            if (row['estado_trabajador'] == 'HABILITADO') {
                                estado_t = "<span class='badge badge-success' >VIGENTE</span>"
                                return estado_t;
                            } else {
                                estado_t = "<span class='badge badge-danger' >INHABILITADO</span>"
                                return estado_t;
                            }
                        },
                    }
                ],
                lengthMenu: [10, 25, 50, 75, 100],
                autoWidth: false,
                pagingType: "full_numbers",
                dom: "<'row'<'col-sm-6'Bl><'col-sm-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                scrollY: '45vh',
                scrollX: true,
                select: true,
                deferRender: true,
                buttons: [
                    // {
                    //     extend: 'print',
                    //     footer: true,
                    //     text: '<i class="fas fa-print" title="Imprimir la página actual"></i>',
                    //     className: 'btn btn-sm btn-danger',
                    //     exportOptions: {
                    //         modifier: {
                    //             order: 'applied',
                    //             page: 'current',
                    //             search: 'applied'
                    //         },
                    //         columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    //     },
                    //     customize: function(win) {
                    //         $(win.document.body).find('table').addClass('printer')
                    //     }
                    // },
                    // {
                    //     extend: 'excelHtml5',
                    //     footer: true,
                    //     text: '<i class="fas fa-file-excel" data-toggle="tooltip" title="Hoja de Excel Página actual"></i>',
                    //     className: 'btn btn-sm btn-success',
                    //     exportOptions: {
                    //         modifier: {
                    //             order: 'applied',
                    //             page: 'current',
                    //             search: 'applied'
                    //         },
                    //         columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    //     }
                    // },
                    {
                        extend: 'print',
                        footer: true,
                        text: '<i class="fas fa-print" data-toggle="tooltip" title="Imprimir todas las paginas">Imprimir</i>',
                        className: 'btn btn-sm btn-danger',
                        exportOptions: {
                            modifier: {
                                order: 'applied',
                                page: 'all',
                                search: 'applied'
                            },
                            columns: [1, 3, 4, 5, 6, 7, 8]
                        },
                        customize: function(win) {
                            $(win.document.body).find('table')
                                .addClass('compact').attr('border','1')
                                .css({"font-size": "inherit"})
                            $(win.document.body).find('h1').css('text-align', 'center');
                            $(win.document.body).find('table').addClass('printer')
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        footer: true,
                        text: '<i class="fas fa-file-excel" data-toggle="tooltip" title="Hoja de Excel Todas las páginas">Exportar</i>',
                        className: 'btn btn-sm btn-success',
                        exportOptions: {
                            modifier: {
                                order: 'applied',
                                page: 'all',
                                search: 'applied'
                            },
                            columns: [0, 1, 3, 4, 5, 6, 7, 8]
                        }
                    }
                ],
                language: {
                    url: "../../vendor/funciones/datatable_spanish.json"
                }
            });

        }

        function filterSelect() {
            var filter = $('.filter-select')
            table_trabajador.column(filter.data('column'))
                .search(filter.val())
                .draw();
        }
        $(() => {
            lista_trabajadores();

            filterSelect();
            $('.filter-select').change(function() {
                if ($(this).val() == 'TODOS') {
                    var table = $('#table_trabajador').DataTable();
                    table
                        .search('')
                        .columns().search('')
                        .draw();
                    console.log($(this).val());
                } else {
                    table_trabajador.column($(this).data('column'))
                        .search($(this).val())
                        .draw();
                    console.log($(this).val());
                }
            });
            $('#table_trabajador').on('dblclick', 'tr', function() {
                var data = table_trabajador.rows(this).data().toArray();
                var id_trabajador = data[0]['id'];
                var url = '{{route("trabajador.mostrar", ":id")}}';
                let urlFileTrabajador = url.replace(':id', id_trabajador);
                $(location).attr('href', urlFileTrabajador);
            });
            // Modal para Registrar un nuevo trabajador
            var urlAddTrabajador = "trabajador/create";
            $('#nuevo_trabajador').click(function() {
                $('#modalTrabajador').load(urlAddTrabajador, null,
                    function(response, status, xhr) {
                        switch (xhr.status) {
                            case 403:
                                Swal.fire({
                                    title: 'Acceso restringido o sesión caducada',
                                    icon: 'warning',
                                    confirmButtonText: 'Aceptar',
                                }).then(() => {
                                    location.reload();
                                });
                                break;
                            case 200:
                                $('#modalTrabajador').modal('show');
                                $('.modal-custom').css("max-width", "900px");
                                break;
                            case 500:
                                Swal.fire({
                                    title: xhr.statusText,
                                    icon: 'warning',
                                    confirmButtonText: 'Aceptar',
                                }).then(() => {
                                    location.reload();
                                });
                                break;

                            default:
                                break;
                        }
                    }
                );
            });
            // modificar datos de un trabajador
            $('#modificar_trabajador').on('click', function() {
                var data = table_trabajador.rows('tr.selected').data().toArray();
                if (data.length != 0) {
                    const rowId = data[0]['id'];
                    var url = '{{route("trabajador.edit", ":id")}}';
                    let urlEditTrabajador = url.replace(':id', rowId);
                    $('#modalTrabajador').load(urlEditTrabajador, null,
                        function(response, status, xhr) {
                            switch (xhr.status) {
                                case 403:
                                    Swal.fire({
                                        title: 'Acceso restringido o sesión caducada',
                                        icon: 'warning',
                                        confirmButtonText: 'Aceptar',
                                    }).then(() => {
                                        location.reload();
                                    });
                                    break;
                                case 200:
                                    $('#modalTrabajador').modal('show');
                                    $('.modal-custom').css("max-width", "900px");
                                    break;
                                case 500:
                                    Swal.fire({
                                        title: xhr.statusText,
                                        icon: 'warning',
                                        confirmButtonText: 'Aceptar',
                                    }).then(() => {
                                        location.reload();
                                    });
                                    break;

                                default:
                                    break;
                            }
                        }
                    );

                } else {
                    Swal.fire({
                        title: 'Por favor, seleccione un registro',
                        icon: 'warning',
                        confirmButtonText: 'Aceptar',
                    });
                }
            });
            // File de un trabajador
            $('#file_trabajador').on('click', function() {
                var data = table_trabajador.rows('tr.selected').data().toArray();
                if (data.length != 0) {
                    var id_trabajador = data[0]['id'];
                    var url = '{{route("trabajador.mostrar", ":id")}}';
                    let urlFileTrabajador = url.replace(':id', id_trabajador);
                    $(location).attr('href', urlFileTrabajador);
                } else {
                    Swal.fire({
                        title: 'Por favor, seleccione un registro',
                        icon: 'warning',
                        confirmButtonText: 'Aceptar',
                    });
                }
            });
            // Eliminar un trabajador
            $('#eliminar_trabajador').on('click', function() {
                var data = table_trabajador.rows('tr.selected').data().toArray();
                if (data.length != 0) {
                    var id_trabajador = data[0]['id'];
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    Swal.fire({
                        title: '¿Está seguro?',
                        text: "¿Desea eliminar este trabajador?",
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
                                url: 'trabajador/' + id_trabajador,
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
                                    }
                                },
                                error: function(response, status, xhr) {
                                    Swal.fire({
                                        html: response.responseJSON.message,
                                        icon: 'warning',
                                        confirmButtonText: 'Aceptar',
                                    }).then(() => {

                                    });
                                }
                            });
                        }
                    });

                } else {
                    Swal.fire({
                        title: 'Por favor, seleccione un registro',
                        icon: 'warning',
                        confirmButtonText: 'Aceptar',
                    });
                }

            });

            $('#view_pdf_ficha_personal').on('click', function() {
                var data = table_trabajador.rows('tr.selected').data().toArray();
                if (data.length != 0) {
                    var id_trabajador = data[0]['id'];
                    $('.modal_ficha_personal').modal("show");
                    // Iframe para incrustrar la planilla
                    html = `<div class="col-12 justify-content-center row">
                                <iframe src="trabajador/pdf-ficha-personal/${id_trabajador}"
                                width="1900" height="430"></iframe>
                            </div>`;
                    $('#contenido_pdf').html(html);
                } else {
                    Swal.fire({
                        title: 'Por favor, seleccione un registro',
                        icon: 'warning',
                        confirmButtonText: 'Aceptar',
                    });
                }
            });
        });
    </script>
@stop
