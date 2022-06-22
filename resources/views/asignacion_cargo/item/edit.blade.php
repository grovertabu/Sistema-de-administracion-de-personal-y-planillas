<div class="modal-dialog modal-custom">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Editar Item</h5>
            <button type="button" class="close" onclick="$('#modalItems').modal('hide')" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="row">
                <form  method="POST" class="create"
                    role="form" id="formEditarItem">
                    <input type="hidden" name="id" id="id_item" value="{{$item->id}}">
                    <div class="card-body modal_font_size row">
                        <div class="form-group col-md-12 required">
                            <label for="trabajador_nombre">Persona:</label>
                            <div class="input-group ">
                                <input type="text" class="form-control" readonly id="trabajador_nombre"
                                    name="trabajador_nombre" value="{{$item->trabajador->apellido_paterno." ".$item->trabajador->apellido_materno.", ".$item->trabajador->nombre}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group required-valid">
                            <input type="hidden" id="trabajador_id" name="trabajador_id" value="{{$item->trabajador_id}}">
                        </div>
                        <div class="form-group col-md-12 required">
                            <label for="nomina_cargo_nombre">Cargo:</label>
                            <div class="input-group ">
                                <input type="text" class="form-control" readonly id="nomina_cargo_nombre"
                                name="nomina_cargo_nombre" value="{{$item->nomina_cargo->item." - ".$item->nomina_cargo->cargo->nombre." - ".number_format($item->nomina_cargo->escala_salarial->salario_mensual, 2, ",", "."). " Bs"}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group required-valid">
                            <input type="hidden" id="nomina_cargo_id" name="nomina_cargo_id" value="{{$item->nomina_cargo_id}}">
                        </div>
                        <div class="form-group col-md-4 required">
                            <label>Aportante AFP:</label>
                            <div class="input-group required-valid">
                                <select name="aporte_afp" id="aporte_afp" class="form-control">
                                    <option value="SI" {{$item->aporte_afp == 'SI' ? "selected" : ""}}>SI</option>
                                    <option value="NO" {{$item->aporte_afp == 'NO' ? "selected" : ""}}>NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4 required">
                            <label>Sindicalizado:</label>
                            <div class="input-group required-valid">
                                <select name="sindicato" id="sindicato" class="form-control">
                                    <option value="SI" {{$item->sindicato == 'SI' ? "selected" : ""}}>SI</option>
                                    <option value="NO" {{$item->sindicato == 'NO' ? "selected" : ""}}>NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4 required">
                            <label>Socio fondo empleados:</label>
                            <div class="input-group required-valid">
                                <select name="socio_fe" id="socio_fe" class="form-control">
                                    <option value="SI" {{$item->socio_fe == 'SI' ? "selected" : ""}}>SI</option>
                                    <option value="NO" {{$item->socio_fe == 'NO' ? "selected" : ""}}>NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4 required">
                            <label>Fecha ingreso:</label>

                            <div class="input-group required-valid">
                                <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="fecha_ingreso"
                                    id="fecha_ingreso" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="dd-mm-yyyy" data-mask value="{{$item->fecha_ingreso->format('d-m-Y')}}">
                                <div class="input-group-prepend" data-target="#fecha_ingreso"
                                    data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="estado" id="estado" value="HABILITADO">
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


</script>
<script src="{{ asset('js/scripts/asignacion_cargos/item.js') }}"></script>
