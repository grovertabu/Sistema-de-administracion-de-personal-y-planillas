<div class="modal fade" id="modalEscalasSalariales" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Escalas Salariales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"  >
                <div class="justify-content-center row table-responsive" id="ContenidoEscalasSalariales">
                    <table style="width:100%" class="table table-bordered display nowrap datatable table_modal" id="table_modal" >
                        <thead >
                            <tr>
                                <th >#</th>
                                <th >Nivel</th>
                                <th >Descripción</th>
                                <th >Salario Mensual</th>
                                <th >Estructura Organizacional</th>
                                <th ></th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($escalas_salariales)
                            @foreach ($escalas_salariales as $escala_salarial)
                                <tr>
                                    <td>{{ $escala_salarial->id }}</td>
                                    <td>{{ $escala_salarial->nivel }}</td>
                                    <td>{{ $escala_salarial->descripcion }}</td>
                                    <td>{{ number_format($escala_salarial->salario_mensual, 2, ",", ".") }}</td>
                                    <td>{{ $escala_salarial->estructura_organizacional->nombre. '[' . $escala_salarial->estructura_organizacional->version . ']' }}</td>
                                    <td>
                                        <button type="button" data-id="{{ $escala_salarial->id }}" class="btn btn-primary btn-xs btnSeleccionarEscala" title='seleccionar'
                                            id="btnSeleccionarEscala">Seleccionar <i class="fas fa-check"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
