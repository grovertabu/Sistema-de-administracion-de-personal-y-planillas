
<div class="modal fade" id="modalCrudExpLaboral" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:1870px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close closeModalPdf" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formExpLaboral" enctype="multipart/form-data" action="{{route('exp_laboral.registrar')}}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="trabajador_id" id="trabajador_id" value="{{$trabajador->id}}">
                        <input type="hidden" name="created_by" id="created_by" value="{{auth()->user()->name}}">
                        <x-dg-input type="text" name="nombre_entidad" id="nombre_entidad"
                            label="Entidad Laboral" topclass="col-md-12 required"
                            placeholder="Ejemplo: Empresa Local de Agua Potable Y Alcantarillado Sucre"/>
                        <x-dg-input type="text" name="cargo_laboral" id="cargo_laboral"
                            label="Cargo Asignado" topclass="col-md-12 required"
                            placeholder="Ejemplo: Contador"/>
                        <x-dg-input type="text" name="funcion_laboral" id="funcion_laboral"
                            label="Función Laboral" topclass="col-md-12 required"
                            placeholder="Ejemplo: Auditoria interna"/>
                        <x-date-icon id="fecha_inicio"  name="fecha_inicio"
                            label="Fecha Inicio" topclass="col-md-6 required" />
                        <x-date-icon id="fecha_fin"  name="fecha_fin"
                            label="Fecha Fin" topclass="col-md-6 required" />
                        <x-input-file name="file_exp_laboral" id="file_exp_laboral" topclass="col-md-12"
                            label="Subir Certificado de trabajo de respaldo (Formato Pdf)" placeholder="Subir Certificado" accept=".pdf"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light closeModalPdf" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
