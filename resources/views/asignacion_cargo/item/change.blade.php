<div class="modal-dialog modal-custom">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Cambiar Item</h5>
            <button type="button" class="close" onclick="$('#modalItems').modal('hide')" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <form method="POST" class="create" role="form" id="formCambiarItem">
                    <input type="hidden" name="id" id="id_item" value="{{ $item->id }}">
                    <div class="card-body modal_font_size row">
                        <div class="form-group col-md-12 required">
                            <label for="trabajador_nombre">Persona:</label>
                            <div class="input-group ">
                                <input type="text" class="form-control" readonly id="trabajador_nombre"
                                    name="trabajador_nombre"
                                    value="{{ $item->trabajador->apellido_paterno .' ' .$item->trabajador->apellido_materno .', ' .$item->trabajador->nombre }}">
                            </div>
                        </div>
                        <div class="form-group col-md-5 required">
                            <label for="nomina_cargo_anterior_nombre">Cargo anterior:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" readonly
                                    value="{{ $item->nomina_cargo->item .' - ' .$item->nomina_cargo->cargo->nombre .' - ' .formatMoney($item->nomina_cargo->escala_salarial->salario_mensual) .' Bs' }}">
                            </div>

                        </div>
                        <div class="form-group col-md-3 required">
                            <label>Fecha ingreso:</label>
                            <div class="input-group required-valid">
                                <input type="text" class="form-control" placeholder="dd-mm-aaaa"
                                    data-inputmask-alias="datetime" readonly data-inputmask-inputformat="dd-mm-yyyy"
                                    data-mask value="{{ $item->fecha_ingreso->format('d-m-Y') }}">
                                <div class="input-group-prepend"
                                    data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 required">
                            <label>Fecha conclusión:</label>
                            <div class="input-group required-valid">
                                <input type="text" class="form-control" placeholder="dd-mm-aaaa"
                                    name="fecha_conclusion" id="fecha_conclusion" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                <div class="input-group-prepend" data-target="#fecha_conclusion"
                                    data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        <hr
                            style="width: 100%; background-color: rgb(194, 194, 194); height: 0.05px; border-color : transparent;" />
                        {{-- ================================ Nuevo Cargo ========================================== --}}
                        <div class="form-group col-md-8 required">
                            <label for="nomina_cargo_nombre">Nuevo Cargo:</label>
                            <div class="input-group ">
                                <input type="text" class="form-control" readonly id="nomina_cargo_nombre"
                                    name="nomina_cargo_nombre" autocomplete="off">
                                <div class="input-group-prepend">
                                    <span class="input-group-append">
                                        <button type="button" id="buscar_cargo" class="btn btn-info btn-flat"
                                            data-toggle="modal"><i class="fas fa-search"></i></button>
                                    </span>
                                </div>
                                <input type="hidden" id="nomina_cargo_id" name="nomina_cargo_id">
                            </div>
                        </div>
                        <div class="form-group col-md-4 required">
                            <label>Fecha ingreso:</label>
                            <div class="input-group required-valid">
                                <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="fecha_ingreso"
                                    id="fecha_ingreso" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                <div class="input-group-prepend" data-target="#fecha_ingreso"
                                    data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 required">
                            <label>Aportante AFP:</label>
                            <div class="input-group required-valid">
                                <select name="aporte_afp" id="aporte_afp" class="form-control">
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4 required">
                            <label>Sindicalizado:</label>
                            <div class="input-group required-valid">
                                <select name="sindicato" id="sindicato" class="form-control">
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4 required">
                            <label>Socio fondo empleados:</label>
                            <div class="input-group required-valid">
                                <select name="socio_fe" id="socio_fe" class="form-control">
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer modal_font_size">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger " onclick="$('#modalItems').modal('hide')"
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
@include('asignacion_cargo.item.modalNomina')
<script>
    $('#fecha_ingreso').datetimepicker({
        format: 'DD-MM-YYYY',
        locale: moment.locale('es'),
    });
    $('#fecha_ingreso').inputmask('dd-mm-yyyy', {
        placeholder: 'dd-mm-aaaa',
        inputFormat: 'dd-mm-aaaa'
    });

    $('#fecha_conclusion').datetimepicker({
        format: 'DD-MM-YYYY',
        locale: moment.locale('es'),
    });
    $('#fecha_conclusion').inputmask('dd-mm-yyyy', {
        placeholder: 'dd-mm-aaaa',
        inputFormat: 'dd-mm-aaaa'
    });
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
    $("#buscar_cargo").click(function() {
        $("#modalNCargos").modal("show");
        $('.modal-lg').css("max-width", "1000px");
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
<script src="{{ asset('js/scripts/asignacion_cargos/item.js') }}"></script>
