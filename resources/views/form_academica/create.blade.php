<div class="modal fade" id="modalCrudFormacion" data-backdrop="static" data-keyboard="false" aria-hidden="true">
    <div class="modal-dialog" style="width:1870px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close closeModalPdf" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_academica" enctype="multipart/form-data" action="{{route('form_academica.registrar')}}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="trabajador_id" id="trabajador_id" value="{{$trabajador->id}}">
                        <x-dg-select2 id="nivel_formacion" name="nivel_formacion" label="Nivel" topclass="col-md-12 required">
                            <x-dg-option value="">--SELECCIONE--</x-dg-option>
                            <x-dg-option value="PRIMARIA">PRIMARIA</x-dg-option>
                            <x-dg-option value="SECUNDARIA">SECUNDARIA</x-dg-option>
                            <x-dg-option value="BACHILLER">BACHILLER</x-dg-option>
                            <x-dg-option value="EGRESADO">EGRESADO</x-dg-option>
                            <x-dg-option value="TÉCNICO MEDIO">TÉCNICO MEDIO</x-dg-option>
                            <x-dg-option value="TÉCNICO SUPERIOR">TÉCNICO SUPERIOR</x-dg-option>
                            <x-dg-option value="PROFESIONAL">PROFESIONAL U OFICIO</x-dg-option>
                            <x-dg-option value="DIPLOMADO">DIPLOMADO</x-dg-option>
                            <x-dg-option value="ESPECIALIDAD">ESPECIALIDAD</x-dg-option>
                            <x-dg-option value="MAESTRIA">MAESTRIA</x-dg-option>
                            <x-dg-option value="DOCTORADO">DOCTORADO</x-dg-option>
                        </x-dg-select2>
                        <x-input type="text" name="institucion" id="institucion"
                            label="Institución" topclass="col-md-12 required" inputclass="text-uppercase"
                            placeholder="Ejemplo: Universidad San Francisco Xavier de Chuquisaca"/>
                        <x-input type="text" name="titulo_formacion" id="titulo_formacion"
                            label="Título obtenido" topclass="col-md-12 required"
                            placeholder="Ejemplo: LICENCIADO EN CONTADURÍA PÚBLICA"/>
                        <x-input type="text" name="lugar_formacion" id="lugar_formacion"
                            label="Lugar" topclass="col-md-6 required"
                            placeholder="Ejemplo: Sucre - Bolivia"/>
                        <x-date-icon id="fecha_emision"  name="fecha_emision"
                            label="Fecha de emisión" topclass="col-md-6 required" />
                        <x-input-file name="file_formacion" id="file_formacion" topclass="col-md-12" accept=".pdf"
                            label="Subir Título obtenido (Formato Pdf)" placeholder="Subir Documento"/>
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
