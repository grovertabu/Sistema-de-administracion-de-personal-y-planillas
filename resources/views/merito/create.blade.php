
<div class="modal fade" id="modalCrudMerito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:1870px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close closeModalPdf" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formMeritos" enctype="multipart/form-data" action="{{route('merito.registrar')}}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="trabajador_id" id="trabajador_id" value="{{$trabajador->id}}">
                        <input type="hidden" name="created_by" id="created_by" value="{{auth()->user()->name}}">
                        <x-input type="text" name="detalle_merito" id="detalle_merito" inputclass="text-uppercase"
                            label="Detalle" topclass="col-md-12 required"/>
                        <x-date-icon id="fecha_merito"  name="fecha_merito"
                            label="Fecha de registro" topclass="col-md-6 required" />
                        <x-input-file name="file_merito" id="file_merito" topclass="col-md-12"
                            label="Subir Certificado del mérito (Formato Pdf)" placeholder="Subir Certificado" accept=".pdf"/>
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
