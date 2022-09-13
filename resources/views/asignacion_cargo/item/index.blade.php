@extends('adminlte::page')

@section('title', 'Items')

@section('content_header')
    <div class="row">
        <div class="col-6 mb-0">
            <h4>ITEMS</h4>
        </div>
        <div class="col-6">
            <select data-column="13" class="filter-select form-control-select float-right" id="getEstado">
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
            <div class="col-12">
                <button id="nuevoItem" class="btn btn-success btn-sm">Nuevo <i class="fa fa-plus-circle"></i></button>
                <button id="modificarItem" class="btn btn-warning btn-sm">Modificar <i
                        class="fa fa-edit"></i></button>
                <button id="cambiarItem" class="btn btn-primary btn-sm">Cambiar <i
                        class="fa fa-exchange-alt"></i></button>
                <button id="bajaItem" class="btn btn-danger btn-sm">Dar de Baja <i
                        class="fa fa-times-circle"></i></button>
                {{-- <button id="eliminarItem" class="btn btn-danger btn-sm">Eliminar <i
                        class="fa fa-times-circle"></i></button> --}}
                <button class="btn btn-default dropdown-toggle float-right" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Imprimir <i class="fa fa-file-pdf"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <button id="view_pdf" data-estado="HABILITADO" class="dropdown-item"> Altas </button>
                    <button id="view_pdf" data-estado="INHABILITADO" class="dropdown-item"> Bajas </button>
                </div>
            </div>
            <div class="table table-bordered table-hover dataTable table-responsive">
                <table width="100%" class="table table-striped table-bordered datatable data_table "
                    id="table_items">
                    <thead>
                        <tr>
                            <th width='1px'>Nro</th>
                            <th >id</th>
                            <th >Fecha Ingreso</th>
                            <th >Conclusión</th>
                            <th width="50px">Item</th>
                            <th width="110px">Documento (C.I.)</th>
                            <th width="135px">Trabajador</th>
                            <th width="150px">Cargo</th>
                            <th >Salario</th>
                            <th >Aportante AFP</th>
                            <th >Sindicalizado</th>
                            <th >Socio FE</th>
                            <th >Fecha nuevo cargo</th>
                            <th >Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><button id="btnClean" title="Limpiar filtro" class="btn btn-primary-outline btn-sm"><i class="fas fa-sync"></i></button></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><input placeholder="Item" data-column="4" class="form-control filter-input btnCi" type="text" id="getItem" autocomplete="off"></th>
                            <th><input placeholder="Buscar CI" data-column="5" class="form-control filter-input btnCi" type="text" id="getDocumento" autocomplete="off"></th>
                            <th><input placeholder="Buscar nombre" data-column="6" class="form-control filter-input" type="text" id="getName" autocomplete="off"></th>
                            <th><input placeholder="Buscar Cargo" data-column="7" class="form-control filter-input" type="text" id="getCArgo" autocomplete="off"></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>s</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalItems" role="dialog" data-backdrop="static" data-keyboard="false">
    </div>

    <div class="modal fade modal_items" role="dialog" data-backdrop="static" data-keyboard="false" style="overflow:hidden;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reporte de Items</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contenido_pdf" >

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('asignacion_cargo.item.modalItems') --}}
@stop
@section('footer')
    <strong>{{ date('Y') }} || ELAPAS - SISTEMA DE RECURSOS HUMANOS </strong>
@stop
@section('js')
    <script>
        function lista_items(){
            table_items = $('#table_items').DataTable({
                ajax: {
                    url: "{{ route('items.lista') }}",
                },
                columns: [
                    {data: null,
                        render: function (data, type, full, meta)
                        {
                            return meta.row + 1;
                        }
                    },
                    {data: 'id',visible: false},
                    {data: 'fecha_ingreso'},
                    {data: 'fecha_conclusion',visible: false},
                    {data: 'item'},
                    {data: 'trabajador_ci'},
                    {data: 'trabajador_nombre'},
                    {data: 'cargo'},
                    {data: 'salario'},
                    {data: 'aporte_afp'},
                    {data: 'sindicato'},
                    {data: 'socio_fe'},
                    {data: 'fecha_nuevo_cargo'},
                    {
                        render: function(data, type, row) {
                            if (row['estado'] == 'HABILITADO') {
                                estado_t = "<span class='badge badge-success' >VIGENTE</span>"
                                return estado_t;
                            } else {
                                estado_t = "<span class='badge badge-danger' >INHABILITADO</span>"
                                return estado_t;
                            }
                        },
                    },
                ],
                columnDefs: [{
                    searchable: false,
                    orderable: false,
                    targets: [0, 8, 9, 10, 11],
                }, ],
                responsive: true,
                scrollY: "43vh",
                scrollX: true,
                deferRender: true,
                lengthMenu: [
                    [10, 10, 25, 50, -1],
                    [10, 10, 25, 50, "All"]
                ],
                autoWidth: true,
                dom: "<'row'<'col-sm-12 col-md-12'>>" +
                    "<'row'<'col-sm-12't>>" +
                    "<'row'i<'col-sm-12 col-md-5'p>>",
                select: true,
                language: {
                    url: "../../vendor/funciones/datatable_spanish.json"
                },
                initComplete: function(settings, json) {
                    if(json.recordsTotal == 0){
                        Swal.fire({
                            title: 'No existen ítems',
                            type: 'warning',
                            confirmButtonText: 'Aceptar',
                        });
                    }else{console.log(true)}
                }
            });
        }
        function filterSelect(){
            var filter = $('.filter-select')
            console.log(filter.val());
            table_items.column(filter.data('column'))
                    .search(filter.val())
                    .draw();
        }
        $(document).ready(function() {
            // Tabla de los items
            lista_items()
            // Filtro por estado
            filterSelect()
            // buscar por texto
            $('.filter-input').keyup(function(){
                table_items.column($(this).data('column'))
                .search($(this).val())
                .draw();
            });
            // buscar por estado
            $('.filter-select').change(function(){
                if($(this).val() == 'TODOS'){
                    var table = $('#table_items').DataTable();
                    table
                    .search('')
                    .columns().search('')
                    .column( 3 ).visible( true )
                    .draw();
                }
                else{
                    var visible = $(this).val() === 'VIGENTE' ? false : true;
                    table_items.column($(this).data('column'))
                    .search($(this).val())
                    .column( 3 ).visible( visible )
                    .draw();
                    console.log(visible)
                }
            });
            // limpiar inputs
            $('button#btnClean').click(function (e) {
                Pace.restart();
                e.preventDefault();
                var filter = $('.filter-select')
                var table = $('#table_items').DataTable()
                .search('')
                .columns().search('')
                .column( 3 ).visible( false );
                console.log("reset table");
                $('.filter-input').val("");
                $('.filter-select').val("VIGENTE");
                filterSelect()
            });

            // Nuevo Item
            var urlAddItem = "{{ route('item.nuevo') }}";
            $('#nuevoItem').click(function() {
                $('#modalItems').load(urlAddItem, null,
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
                                $('#modalItems').modal('show');
                                $('.modal-custom').css("max-width", "600px");
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
            // MODIFICAR ITEM
            $('#modificarItem').on('click', function() {
                var data = table_items.rows('tr.selected').data().toArray();
                if (data.length != 0) {
                    var rowId = data[0]['id'];
                    var rowConclusion = data[0]['fecha_conclusion'];
                    if(rowConclusion != null){
                        Swal.fire({
                            title: 'El contrato no se puede modificar porque este ya ha concluido',
                            icon: 'warning',
                            confirmButtonText: 'Aceptar',
                        });
                    }
                    else{
                        var urlEditItem = "/item/" + rowId + "/editar";
                        $('#modalItems').load(urlEditItem, null,
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
                                        $('#modalItems').modal('show');
                                        $('.modal-custom').css("max-width", "600px");
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
                    }

                } else {
                    Swal.fire({
                        title: 'Por favor, seleccione un registro',
                        icon: 'warning',
                        confirmButtonText: 'Aceptar',
                    });
                }

            });

            $('#cambiarItem').on('click', function() {
                var data = table_items.rows('tr.selected').data().toArray();
                if (data.length != 0) {
                    var rowId = data[0]['id'];
                    var rowConclusion = data[0]['fecha_conclusion'];
                    if(rowConclusion != null){
                        Swal.fire({
                            title: 'El contrato no se puede modificar porque este ya ha concluido',
                            icon: 'warning',
                            confirmButtonText: 'Aceptar',
                        });
                    }
                    else{
                        var urlChangeItem = "/item/" + rowId + "/cambiar";
                        $('#modalItems').load(urlChangeItem, null,
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
                                        $('#modalItems').modal('show');
                                        $('.modal-custom').css("max-width", "800px");
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
                    }
                } else {
                    Swal.fire({
                        title: 'Por favor, seleccione un registro',
                        icon: 'warning',
                        confirmButtonText: 'Aceptar',
                    });
                }

            });
            // BAja de ITEM
            $('#bajaItem').on('click', function() {
                var data = table_items.rows('tr.selected').data().toArray();
                if (data.length != 0) {
                    var rowId = data[0]['id'];
                    var rowConclusion = data[0]['fecha_conclusion'];
                    if(rowConclusion != null){
                        Swal.fire({
                            title: 'El contrato no se puede dar de baja porque este ya ha concluido',
                            icon: 'warning',
                            confirmButtonText: 'Aceptar',
                        });
                    }
                    else{
                        var urlCancelItem = "/item/" + rowId + "/dar-baja";
                        $('#modalItems').load(urlCancelItem, null,
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
                                        $('#modalItems').modal('show');
                                        $('.modal-custom').css("max-width", "800px");
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
                    }
                } else {
                    Swal.fire({
                        title: 'Por favor, seleccione un registro',
                        icon: 'warning',
                        confirmButtonText: 'Aceptar',
                    });
                }

            });

            $('body').on('click', '#view_pdf', function(e) {
                e.preventDefault();
                $('.modal_items').modal("show");
                estado = $(this).data('estado');
                tipo_contrato = 1;
                nombre_tipo = 'ITEMS';
                // Iframe para incrustrar la planilla
                html = `<div class="col-12 justify-content-center row">
                    <iframe src="{{route("contratos.pdf")}}?estado=${estado}&tipo_contrato=${tipo_contrato}&nombre_tipo=${nombre_tipo}"
                    width="1900" height="430">
                    </iframe>
                    </div>`;
                $('#contenido_pdf').html(html);
            });
        });
    </script>
    {{-- <script src="{{asset('js/scripts/asignacion_cargo.js')}}"></script> --}}
@stop
