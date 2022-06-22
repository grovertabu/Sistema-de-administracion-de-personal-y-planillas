<div class="modal-dialog modal-custom">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Nuevo Eventual</h5>
            <button type="button" class="close" onclick="$('#modalEventuales').modal('hide')" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <form action="{{ route('eventual.registrar') }}" method="POST" class="create"
                    role="form" id="formNuevoEventual">
                    @csrf
                    <div class="card-body modal_font_size row">
                        <div class="form-group col-md-12 required">
                            <label for="trabajador_nombre">Persona:</label>
                            <div class="input-group ">
                                <input type="text" class="form-control" readonly id="trabajador_nombre"
                                    name="trabajador_nombre" autocomplete="off">
                                <div class="input-group-prepend">
                                    <span class="input-group-append">
                                        <button type="button" id="buscar_trabajador" class="btn btn-info btn-flat"
                                            data-toggle="modal"><i class="fas fa-search"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group required-valid">
                            <input type="hidden" id="trabajador_id" name="trabajador_id">
                        </div>
                        <div class="form-group col-md-12 required">
                            <label for="nomina_cargo_nombre">Cargo:</label>
                            <div class="input-group ">
                                <input type="text" class="form-control" readonly id="nomina_cargo_nombre"
                                    name="nomina_cargo_nombre" autocomplete="off">
                                <div class="input-group-prepend">
                                    <span class="input-group-append">
                                        <button type="button" id="buscar_cargo" class="btn btn-info btn-flat"
                                            data-toggle="modal"><i class="fas fa-search"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group required-valid">
                            <input type="hidden" id="nomina_cargo_id" name="nomina_cargo_id">
                        </div>
                        <div class="form-group col-md-6 required">
                            <label>Fecha ingreso:</label>
                            <div class="input-group required-valid">
                                <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="fecha_ingreso"
                                    id="fecha_ingreso" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="dd-mm-yyyy" data-mask value="{{ date('d-m-Y') }}">
                                <div class="input-group-prepend" data-target="#fecha_ingreso"
                                    data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6 required">
                            <label>Fecha conclusión:</label>
                            <div class="input-group required-valid">
                                <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="fecha_conclusion"
                                    id="fecha_conclusion" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="dd-mm-yyyy" data-mask value="{{ date('d-m-Y') }}">
                                <div class="input-group-prepend" data-target="#fecha_conclusion"
                                    data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Aportante AFP:</label>
                            <div class="input-group required-valid">
                                <select name="aporte_afp" id="aporte_afp" class="form-control">
                                    <option value="NO">NO</option>
                                    <option value="SI">SI</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Sindicalizado:</label>
                            <div class="input-group required-valid">
                                <select name="sindicato" id="sindicato" class="form-control">
                                    <option value="NO">NO</option>
                                    <option value="SI">SI</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Socio fondo empleados:</label>
                            <div class="input-group required-valid">
                                <select name="socio_fe" id="socio_fe" class="form-control">
                                    <option value="NO">NO</option>
                                    <option value="SI">SI</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Observación:</label>
                            <div class="input-group required-valid">
                                <textarea class="form-control" name="observacion" id="observacion" cols="15" rows="2"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="estado" id="estado" value="HABILITADO">
                    </div>
                    <div class="card-footer modal_font_size">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger " onclick="$('#modalEventuales').modal('hide')"
                                    aria-label="Close">
                                    <i class="fa fa-times-circle"></i> Cerrar
                                </button>
                            </div>
                            <x-dg-submit type="success" topclass="col-md-6" inputclass="float-right"
                                label="Guardar" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('asignacion_cargo.eventual.modalTrabajador')
@include('asignacion_cargo.eventual.modalNomina')
<script>
    var table_modal = $('.table_modal').DataTable({
        deferRender: true,
        lengthMenu: [
            [7, 15, 25, 40, -1],
            [7, 15, 25, 40, "All"]
        ],
        autoWidth: true,
        responsive: true,
        select: true,
        // scrollY: 250,
        // scrollX: false,
        pagingType: "full_numbers",
        dom: "<'row d-flex justify-content-center'f>" +
            "<'row'<'col-md-12't>>" +
            "<'row d-flex justify-content-center'p>",
        language: {
            url: "../../vendor/funciones/datatable_spanish.json"
        }
    });

    $('#fecha_ingreso').datetimepicker({
        format: 'DD-MM-YYYY',
        locale: moment.locale('es'),
    });
    $('#fecha_ingreso').inputmask('dd-mm-yyyy', {
        placeholder: 'dd-mm-aaaa',
        inputFormat: 'dd-mm-aaaa'
    })
    $('#fecha_conclusion').datetimepicker({
        format: 'DD-MM-YYYY',
        locale: moment.locale('es'),
    });
    $('#fecha_conclusion').inputmask('dd-mm-yyyy', {
        placeholder: 'dd-mm-aaaa',
        inputFormat: 'dd-mm-aaaa'
    });

    $("#buscar_cargo").click(function() {
        $("#modalNCargos").modal("show");
        $('.modal-lg').css("max-width", "1000px");
    });

    $("#buscar_trabajador").click(function() {
        $("#modalTrabajador").modal("show");
        $('.modal-lg').css("max-width", "860px");
    });
    $('#selectTrabajador').on('click', function() {
        var data = $("#tableTrabajador").DataTable().rows('tr.selected').data().toArray();
        if (data.length != 0) {
            var rowId = data[0][0];
            $("#trabajador_nombre").val(data[0][3])
            $("#trabajador_id").val(rowId)
            $("#modalTrabajador").modal("hide");
            console.log(data)
        } else {
            Swal.fire({
                title: 'Por favor, seleccione un registro',
                icon: 'warning',
                confirmButtonText: 'Aceptar',
            });
        }
    });
    $('#selectCargo').on('click', function() {
        var data = $("#tableCargo").DataTable().rows('tr.selected').data().toArray();
        if (data.length != 0) {
            var rowId = data[0][0];
            var nombre_cargo = data[0][2] + " - " + data[0][3] + " - " + data[0][5];
            $("#nomina_cargo_nombre").val(nombre_cargo)
            $("#nomina_cargo_id").val(rowId)
            $("#modalNCargos").modal("hide");
            console.log(data)
        } else {
            Swal.fire({
                title: 'Por favor, seleccione un registro',
                icon: 'warning',
                confirmButtonText: 'Aceptar',
            });
        }

    });
</script>

<script src="{{ asset('js/scripts/asignacion_cargos/eventual.js') }}"></script>
