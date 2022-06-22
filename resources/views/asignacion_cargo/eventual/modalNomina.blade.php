<div class="modal fade" id="modalNCargos" role="dialog"  aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Cargos</h5>
                <button type="button" class="close" onclick="$('#modalNCargos').modal('hide')" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"  >
                @php
                    $i=1;
                @endphp
                <div class="justify-content-center row" >
                    <div class="table table-bordered table-hover dataTable table-responsive contenedor_table">
                        <table style="width:100%" class="table table-bordered responsive display nowrap datatable table_modal" id="tableCargo" >
                            <thead >
                                <tr>
                                    <th style="display:none;" >id</th>
                                    <th>Nro</th>
                                    <th>Nombre</th>
                                    <th>Unidad Organizacional</th>
                                    <th>Salario</th>
                                    <th>Estructura <br> organizacional</th>
                                    {{-- <th ></th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @isset($nomina_cargos)
                                @foreach ($nomina_cargos as $n_cargo)
                                    <tr>
                                        <td style="display:none;">{{ $n_cargo->id }}</td>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ strtoupper($n_cargo->cargo->nombre) }}</td>
                                        <td>{{ $n_cargo->unidad_organizacional->seccion}}</td>
                                        <td>{{ number_format($n_cargo->escala_salarial->salario_mensual, 2, ",", ".")}}</td>
                                        <td>{{ $n_cargo->cargo->estructura_organizacional->nombre. '[' . $n_cargo->cargo->estructura_organizacional->version . ']' }}</td>
                                    </tr>
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="selectCargo" ><i class="fas fa-check"></i> Seleccionar</button>
            </div>
        </div>
    </div>
</div>
