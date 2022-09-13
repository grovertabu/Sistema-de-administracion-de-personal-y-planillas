<form action="{{ route('trabajador.registrar') }}" method="POST" role="form" class="create"
    id="form_trabajador" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-custom modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo Trabajador</h5>
                <button type="button" class="close" onclick="$('#modalTrabajador').modal('hide')"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9 ">
                        <ul class="nav nav-pills"  role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="info_personal-tab" data-toggle="tab" href="#info_personal" role="tab"  aria-selected="true">1. Información Personal</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="info-laboral-tab" data-toggle="tab" href="#info_laboral" role="tab"  aria-selected="false">2. Información laboral</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="info_personal" role="tabpanel">
                                <div class="row">
                                    <x-input type="number" name="ci_trabajador" id="ci_trabajador"
                                        label="Documento(CI)" topclass="col-md-5 required" inputclass="form-control-sm"/>
                                    <x-input type="text"  name="complemento" id="complemento" label="Comp."
                                        topclass="col-md-1" inputclass="form-control-sm"/>
                                    <div class="form-group col-md-6 required">
                                        <label for="expedido">Expedido</label>
                                        <select class="form-control form-control-sm" style="width:100%" id="expedido" name="expedido" >
                                            <option value="">--SELECCIONE--</option>
                                            <option value="CH">CHUQUISACA</option>
                                            <option value="LP">LA PAZ</option>
                                            <option value="CB">COCHABAMBA</option>
                                            <option value="OR">ORURO</option>
                                            <option value="PT">POTOSí</option>
                                            <option value="TJ">TARIJA</option>
                                            <option value="SC">SANTA CRUZ</option>
                                            <option value="BE">BENI</option>
                                            <option value="PD">PANDO</option>
                                        </select>
                                    </div>
                                    <x-input-icon type="text" name="nombre_trabajador" id="nombre_trabajador"
                                        label="Nombre" topclass="col-md-6 required"
                                        icon="fas fa-user" inputclass="form-control-sm text-uppercase"/>

                                    <x-input-icon type="text" name="apellido_paterno" id="apellido_paterno"
                                        label="Apellido Paterno" topclass="col-md-6 required"
                                        icon="fas fa-user" inputclass="form-control-sm text-uppercase"/>
                                    <x-input-icon type="text" name="apellido_materno" id="apellido_materno"
                                        label="Apellido Materno" topclass="col-md-6"
                                        icon="fas fa-user" inputclass="form-control-sm text-uppercase"/>

                                    <x-input type="text" name="direccion" id="direccion" label="Direccion"
                                        topclass="col-md-6 required" inputclass="form-control-sm text-uppercase"/>
                                    <x-input type="text" name="nro_asegurado" id="nro_asegurado"
                                        label="Nro. Asegurado" inputclass="form-control-sm" topclass="col-md-6 required" />
                                    <div class="form-group col-md-6 required">
                                        <label>Fecha de nacimiento:</label>
                                        <div class="input-group required-valid">
                                            <input type="text" class="form-control form-control-sm" placeholder="dd-mm-aaaa"
                                                name="fecha_nacimiento" id="fecha_nacimiento"
                                                data-inputmask-alias="datetime"
                                                data-inputmask-inputformat="dd-mm-yyyy" data-mask>
                                            <div class="input-group-prepend" data-target="#fecha_nacimiento"
                                                data-toggle="datetimepicker">
                                                <span class="input-group-text"><i
                                                        class="far fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6 required">
                                        <label>Sexo</label>
                                        <select class="form-control form-control-sm" id="sexo" name="sexo">
                                            <option value="">--SELECCIONE--</option>
                                            <option value="M">MASCULINO</option>
                                            <option value="F">FEMENINO</option>
                                        </select>
                                    </div>
                                    <x-input type="text" name="tipo_sangre" id="tipo_sangre"
                                        label="Tipo de Sangre" inputclass="form-control-sm text-uppercase" topclass="col-md-6" />
                                </div>
                            </div>
                            <div class="tab-pane fade" id="info_laboral" role="tabpanel">
                                <div class="row">
                                    <x-input type="text" name="nacionalidad" id="nacionalidad"
                                        label="Nacionalidad" topclass="col-md-6 required" value="BOLIVIANO" inputclass="form-control-sm"/>
                                    <div class="form-group col-md-6 required">
                                        <label>Estado Civil</label>
                                        <select class="form-control form-control-sm" id="estado_civil" name="estado_civil">
                                            <option value="NONE">SIN ESPECIFICAR</option>
                                            <option value="SINGLE">SOLTERO(A)</option>
                                            <option value="MARRIED">CASADO(A)</option>
                                            <option value="WIDOWER">VIUDO(A)</option>
                                            <option value="DIVORCED">DIVORCIADO(A)</option>
                                        </select>
                                    </div>
                                    <x-input type="number" name="antiguedad_anios" id="antiguedad_anios"
                                        label="Años de Antiguedad" topclass="col-md-4 required" inputclass="form-control-sm"/>
                                    <x-input type="number" name="antiguedad_meses" id="antiguedad_meses"
                                        label="Meses de Antiguedad" topclass="col-md-4 required" inputclass="form-control-sm"/>
                                    <x-input type="number" name="antiguedad_dias" id="antiguedad_dias"
                                        label="Días de Antiguedad" topclass="col-md-4 required" inputclass="form-control-sm"/>
                                    <x-input type="text" name="telefono" id="telefono"
                                        label="Teléfono" topclass="col-md-3" inputclass="form-control-sm"/>
                                    <x-input type="text" name="celular" id="celular"
                                        label="Celular" topclass="col-md-3" inputclass="form-control-sm"/>
                                    <x-input type="text" name="profesion" id="profesion"
                                        label="Profesión u oficio" topclass="col-md-6" inputclass="form-control-sm"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-11">
                                <img id="foto_perfil" src="{{ asset('images/default-avatar.jpg') }}"
                                   class="img-thumbnail img-responsive" style="width:200px;height:200px">
                                <a class="btn btn-info btn-block" onclick="$('#foto').trigger('click')">
                                    <i class="fa fa-upload"></i> Seleccionar foto
                                </a>
                                <x-input-file name="foto" id="foto" topclass="col-md-12 d-none" label="FOTO"
                                        accept="image/*" placeholder="Ingresar la foto del trabajador..." />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col d-flex justify-content-between">
                    <button type="button" class="btn btn-danger float-left"
                        onclick="$('#modalTrabajador').modal('hide')"><i class="fa fa-times"></i> Cancelar</button>
                    <button type="submit" id="btnSave" class="btn btn-success float-right"><i
                            class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="{{ asset('js/scripts/trabajador.js') }}"></script>
