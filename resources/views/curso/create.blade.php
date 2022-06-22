
<div class="modal fade" id="modalCrudCurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:1870px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close closeModalPdf" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formCursos" enctype="multipart/form-data" action="{{route('curso.registrar')}}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="trabajador_id" id="trabajador_id" value="{{$trabajador->id}}">
                        <x-dg-input type="text" name="nombre_curso" id="nombre_curso"
                            label="Nombre del Curso" topclass="col-md-12 required"
                            placeholder="Ejemplo: Desarrollo web"/>
                        <x-dg-input type="text" name="instituto" id="instituto"
                            label="Institución" topclass="col-md-12 required"
                            placeholder="Ejemplo: Udemy"/>
                        <x-dg-input type="number" name="horas_academicas" id="horas_academicas"
                            label="Horas Academicas"  topclass="col-md-6 required"  />
                        <x-date-icon id="fecha_curso"  name="fecha_curso"
                            label="Fecha de conclusión" topclass="col-md-6 required" />
                        <x-input-file name="file_curso" id="file_curso" topclass="col-md-12"
                            label="Subir Certificado del curso (Formato Pdf)" placeholder="Subir Certificado" accept=".pdf"/>
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
