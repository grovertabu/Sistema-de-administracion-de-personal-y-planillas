<div class="row mb-2 ml-1">
    <button id="btnRegistrarFormacion" type="button" class='btn btn-success btn-icon' data-toggle="modal"><i class="fas fa-plus"></i></button>
</div>
<input type="hidden" id="route_listar_formacion" value="{{route('form_academica.listar',$trabajador->id)}}">
<div class="table table-bordered table-hover dataTable table-responsive">
    <table class="table table-bordered datatable display nowrap data_table" id="table_formacion">
        <thead>
            <tr>
                <th>N°</th>
                <th>Titulo Obtenido</th>
                <th>Nivel</th>
                <th>Institución</th>
                <th>Fecha de emisión</th>
                <th>Lugar</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

