<div class="modal-dialog modal-custom">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Dar de baja Item</h5>
            <button type="button" class="close" onclick="$('#modalItems').modal('hide')" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <form method="POST" class="cancelItem" role="form" id="cancelItem">
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
                                <div class="input-group-prepend" data-toggle="datetimepicker">
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
                        <hr style="width: 100%; background-color: rgb(194, 194, 194); height: 0.05px; border-color : transparent;" />
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
</script>
<script src="{{ asset('js/scripts/asignacion_cargos/item.js') }}"></script>
