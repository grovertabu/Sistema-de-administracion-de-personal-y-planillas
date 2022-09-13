
<div class="modal fade" id="modalCrudDocumentoPersonal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:1870px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close closeModalPdf" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="formDocumentoPersonals" enctype="multipart/form-data" action="{{route('documento_personal.registrar')}}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="trabajador_id" id="trabajador_id" value="{{$trabajador->id}}">
                        <input type="hidden" name="created_by" id="created_by" value="{{auth()->user()->name}}">
                        <x-dg-select2 id="tipo_documento" name="tipo_documento" label="Nivel" topclass="col-md-12 required">
                            <x-dg-option value="">--SELECCIONE--</x-dg-option>
                            <x-dg-option value="PERSONAL">PERSONAL</x-dg-option>
                            <x-dg-option value="ADMINISTRATIVO">ADMINISTRATIVO</x-dg-option>
                        </x-dg-select2>
                        <x-input type="text" name="detalle_documento" id="detalle_documento"
                            label="Detalle" topclass="col-md-12 required" inputclass="text-uppercase"
                            placeholder="Ejemplo: Cédula de identidad"/>
                        <x-date-icon id="fecha_registro"  name="fecha_registro"
                            label="Fecha de registro" topclass="col-md-12 required" />
                        <x-input-file name="file_documento" id="file_documento" topclass="col-md-12"
                            label="Subir Documento Personal (Formato Pdf)" placeholder="Subir Documento" accept=".pdf"/>
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
