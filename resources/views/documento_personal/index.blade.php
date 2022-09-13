<div class="row mb-2 ml-1">
    <button id="btnRegistrarDocumentoPersonal" type="button" class='btn btn-success btn-icon' data-toggle="modal"><i class="fas fa-plus"></i></button>
</div>
<input type="hidden" id="route_listar_documento_personals" value="{{route('documento_personal.listar',$trabajador->id)}}">
<div class="table table-bordered table-hover dataTable table-responsive">
    <table class="table table-bordered datatable table-striped display nowrap data_table" id="table_documento_personals">
        <thead>
            <tr>
                <th>#</th>
                <th>Detalle</th>
                <th>Fecha registro</th>
                <th>Tipo de documento</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

