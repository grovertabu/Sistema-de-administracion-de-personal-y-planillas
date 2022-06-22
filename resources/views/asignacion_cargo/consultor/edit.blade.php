<div class="modal-dialog modal-custom">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Modificar Consultor</h5>
            <button type="button" class="close" onclick="$('#modalConsultores').modal('hide')" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <form  method="POST" class="create"
                    role="form" id="formEditarConsultor">
                    <input type="hidden" name="id" id="id_consultor" value="{{$consultor->id}}">
                    <div class="card-body modal_font_size row">
                        <div class="form-group col-md-12 required">
                            <label for="trabajador_nombre">Persona:</label>
                            <div class="input-group ">
                                <input type="text" class="form-control" readonly id="trabajador_nombre"
                                    name="trabajador_nombre" value="{{$consultor->trabajador->apellido_paterno." ".$consultor->trabajador->apellido_materno.", ".$consultor->trabajador->nombre}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group required-valid">
                            <input type="hidden" id="trabajador_id" name="trabajador_id" value="{{$consultor->trabajador_id}}">
                        </div>
                        <div class="form-group col-md-12 required">
                            <label for="nomina_cargo_nombre">Cargo:</label>
                            <div class="input-group ">
                                <input type="text" class="form-control" readonly id="nomina_cargo_nombre"
                                name="nomina_cargo_nombre" value="{{$consultor->nomina_cargo->cargo->nombre." - ".formatMoney($consultor->nomina_cargo->escala_salarial->salario_mensual)}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="input-group required-valid">
                            <input type="hidden" id="nomina_cargo_id" name="nomina_cargo_id" value="{{$consultor->nomina_cargo_id}}">
                        </div>
                        <div class="form-group col-md-6 required">
                            <label>Fecha ingreso:</label>
                            <div class="input-group required-valid">
                                <input type="text" class="form-control" placeholder="dd-mm-aaaa" name="fecha_ingreso"
                                    id="fecha_ingreso" data-inputmask-alias="datetime"
                                    data-inputmask-inputformat="dd-mm-yyyy" data-mask value="{{$consultor->fecha_ingreso->format('d-m-Y')}}">
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
                                    data-inputmask-inputformat="dd-mm-yyyy" data-mask value="{{$consultor->fecha_conclusion->format('d-m-Y')}}">
                                <div class="input-group-prepend" data-target="#fecha_conclusion"
                                    data-toggle="datetimepicker">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-4 ">
                            <label>Aportante AFP:</label>
                            <div class="input-group required-valid">
                                <select name="aporte_afp" id="aporte_afp" class="form-control">
                                    <option value="NO" {{$consultor->aporte_afp == 'NO' ? "selected" : ""}}>NO</option>
                                    <option value="SI" {{$consultor->aporte_afp == 'SI' ? "selected" : ""}}>SI</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4 ">
                            <label>Sindicalizado:</label>
                            <div class="input-group required-valid">
                                <select name="sindicato" id="sindicato" class="form-control">
                                    <option value="NO" {{$consultor->sindicato == 'NO' ? "selected" : ""}}>NO</option>
                                    <option value="SI" {{$consultor->sindicato == 'SI' ? "selected" : ""}}>SI</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4 ">
                            <label>Socio fondo empleados:</label>
                            <div class="input-group required-valid">
                                <select name="socio_fe" id="socio_fe" class="form-control">
                                    <option value="NO" {{$consultor->socio_fe == 'NO' ? "selected" : ""}}>NO</option>
                                    <option value="SI" {{$consultor->socio_fe == 'SI' ? "selected" : ""}}>SI</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Observación:</label>
                            <div class="input-group required-valid">
                                <textarea class="form-control" name="observacion" id="observacion" cols="15" rows="2">{{$consultor->observacion}}
                                </textarea>
                            </div>
                        </div>

                        <input type="hidden" name="estado" id="estado" value="HABILITADO">
                    </div>
                    <div class="card-footer modal_font_size">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger " onclick="$('#modalConsultores').modal('hide')"
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

<script src="{{ asset('js/scripts/asignacion_cargos/consultor.js') }}"></script>
