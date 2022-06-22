<div class="modal fade" id="modalUnidadOrg" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Unidades Organizacionales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"  >
                <div class="justify-content-center row" id="ContenidoUnidadesOrganizacionales">
                    <div class="table table-bordered table-hover dataTable table-responsive">
                        <table style="width:100%" class="table table-bordered display nowrap datatable table_modal" id="table_modal" >
                            <thead >
                                <tr>
                                    <th >#</th>
                                    <th >Nombre</th>
                                    <th >Estructura Organizacional</th>
                                    <th ></th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($unidades_organizacionales)
                                @foreach ($unidades_organizacionales as $unidad)
                                    <tr>
                                        <td>{{ $unidad->id }}</td>
                                        <td>{{ $unidad->seccion }}</td>
                                        <td>{{ $unidad->estructura_organizacional->nombre. '[' . $unidad->estructura_organizacional->version . ']' }}</td>
                                        <td>
                                            <button type="button" data-id="{{ $unidad->id }}" class="btn btn-primary btn-xs btnSeleccionarUnidad" title='seleccionar'
                                                id="btnSeleccionarUnidad">Seleccionar <i class="fas fa-check"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
