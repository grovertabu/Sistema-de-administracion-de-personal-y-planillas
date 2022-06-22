<div class="row mb-2 ml-1">
    <button id="btnRegistrarCurso" type="button" class='btn btn-success btn-icon' data-toggle="modal"><i class="fas fa-plus"></i></button>
</div>
<input type="hidden" id="route_listar_cursos" value="{{route('curso.listar',$trabajador->id)}}">
<div class="table table-bordered table-hover dataTable table-responsive">
    <table class="table table-bordered datatable display nowrap data_table" id="table_cursos">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Institucion</th>
                <th>H. Academicas</th>
                <th>Fecha de curso</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

