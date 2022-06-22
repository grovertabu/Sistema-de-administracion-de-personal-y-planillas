<form method="POST" class="create" role="form" id="formCambiarEventual">
    <div class="modal-dialog modal-custom modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambiar Eventual</h5>
                <button type="button" class="close" onclick="$('#modalEventuales').modal('hide')"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="id" id="id_eventual" value="{{ $eventual->id }}">
                    <div class="card-body modal_font_size row">
                        <div class="form-group col-md-12 required">
                            <label for="trabajador_nombre">Persona:</label>
                            <div class="input-group ">
                                <input type="text" class="form-control" readonly id="trabajador_nombre"
                                    name="trabajador_nombre"
                                    value="{{ $eventual->trabajador->apellido_paterno .' ' .$eventual->trabajador->apellido_materno .', ' .$eventual->trabajador->nombre }}">
                            </div>
                        </div>
                        <div class="form-group col-md-5 required">
                            <label for="nomina_cargo_anterior_nombre">Cargo anterior:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" readonly
                                    value="{{ $eventual->nomina_cargo->cargo->nombre .' - ' .formatMoney($eventual->nomina_cargo->escala_salarial->salario_mensual) }}">
                            </div>

                        </div>
                        <div class="form-group col-md-3 required">
                            <label>Fecha ingreso:</label>
                            <div class="input-group required-valid">
                                <input type="text" class="form-control" placeholder="dd-mm-aaaa"
                                    data-inputmask-alias="datetime" readonly data-inputmask-inputformat="dd-mm-yyyy"
                                    data-mask value="{{ $eventual->fecha_ingreso->format('d-m-Y') }}">
                                <div class="input-group-prepend" data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 required">
                            <label>Fecha conclusión:</label>
                            <div class="input-group required-valid">
                                <input type="text" class="form-control" placeholder="dd-mm-aaaa"
                                    name="fecha_conclusion_antiguo" id="fecha_conclusion_antiguo"
                                    data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask
                                    value="{{ $eventual->fecha_conclusion->format('d-m-Y') }}">
                                <div class="input-group-prepend" data-target="#fecha_conclusion_antiguo"
                                    data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Observación:</label>
                            <div class="input-group required-valid">
                                <textarea disabled class="form-control" cols="5" rows="2">{{ $eventual->observacion }}
                                </textarea>
                            </div>
                        </div>
                        <hr
                            style="width: 100%; background-color: rgb(194, 194, 194); height: 0.05px; border-color : transparent;" />
                        {{-- ================================ Nuevo Cargo ========================================== --}}
                        <div class="form-group col-md-6 required">
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
                        <div class="form-group col-md-3 required">
                            <label>Fecha ingreso:</label>
                            <div class="input-group required-valid">
                                <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="fecha_ingreso"
                                    id="fecha_ingreso" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="dd-mm-yyyy" data-mask value="{{ ahora() }}">
                                <div class="input-group-prepend" data-target="#fecha_ingreso"
                                    data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-3 required">
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
                    </div>
                    <div class="form-group col-md-12">
                        <label>Observación:</label>
                        <div class="input-group required-valid">
                            <textarea class="form-control" name="observacion" id="observacion" cols="15" rows="2">
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col d-flex justify-content-between">
                    <button type="button" class="btn btn-danger float-left"
                        onclick="$('#modalEventuales').modal('hide')"><i class="fa fa-times"></i> Cancelar</button>
                    <button type="submit" id="btnSave" class="btn btn-success float-right"><i
                            class="fa fa-save"></i> Guardar</button>
                </div>
            </div>

        </div>
    </div>
</form>
@include('asignacion_cargo.eventual.modalNomina')
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
    $('#fecha_conclusion_antiguo').datetimepicker({
        format: 'DD-MM-YYYY',
        locale: moment.locale('es'),
    });
    $('#fecha_conclusion_antiguo').inputmask('dd-mm-yyyy', {
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
