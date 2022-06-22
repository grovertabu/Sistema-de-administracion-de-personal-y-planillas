<div class="row mb-2">
    <button id="btnRegistrarExpLaboral" type="button" class='btn btn-success btn-icon' data-toggle="modal"><i class="fa fa-plus"></i></button>
</div>
<input type="hidden" id="route_listar_exp_laboral" value="{{route('exp_laboral.listar',$trabajador->id)}}">
<div class="table table-bordered table-hover dataTable table-responsive">
    <table class="table table-bordered datatable display nowrap data_table" id="table_exp_laboral">
        <thead>
            <tr>
                <th>#</th>
                <th>Entidad Laboral</th>
                <th>Cargo Laboral</th>
                <th>Funcion Laboral</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Tiempo de trabajo</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

