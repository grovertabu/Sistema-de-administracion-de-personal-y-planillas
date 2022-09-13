<div class="row mb-2">
    <button id="btnRegistrarDemerito" type="button" class='btn btn-success btn-icon' data-toggle="modal"><i class="fas fa-plus"></i></button>
</div>
<input type="hidden" id="route_listar_demeritos" value="{{route('demerito.listar',$trabajador->id)}}">
<div class="table table-bordered table-hover dataTable table-responsive">
    <table class="table table-bordered datatable display table-striped nowrap data_table" id="table_demeritos">
        <thead>
            <tr>
                <th>#</th>
                <th>Detalle demérito</th>
                <th>Fecha de registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

