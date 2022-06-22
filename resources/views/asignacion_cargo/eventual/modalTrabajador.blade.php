<div class="modal fade" id="modalTrabajador" data-backdrop="static" role="dialog" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-white bg-info">
                <h5 class="modal-title" id="exampleModalLabel">Personas</h5>
                <button type="button" class="close" onclick="$('#modalTrabajador').modal('hide')" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"  >
                @php
                    $i=1;
                @endphp
                <div class="justify-content-center row" >
                    <div class="table table-bordered table-hover dataTable table-responsive contenedor_table">
                        <table style="width:100%" class="table table-bordered responsive display nowrap datatable table_modal" id="tableTrabajador" >
                            <thead >
                                <tr>
                                    <th style="display:none;" >id</th>
                                    <th >Nro</th>
                                    <th >Documento(C.I)</th>
                                    <th >Nombre</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($trabajadores)
                                @foreach ($trabajadores as $trabajador)
                                    <tr>
                                        <td style="display:none;">{{ $trabajador->id }}</td>
                                        <td width="10%">{{ $i++ }}</td>
                                        <td width="20%">{{ $trabajador->ci }}</td>
                                        <td>{{ $trabajador->apellido_paterno . " " . $trabajador->apellido_materno.", ". $trabajador->nombre }}</td>
                                    </tr>
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="selectTrabajador" ><i class="fas fa-check"></i> Seleccionar</button>
            </div>
        </div>
    </div>
</div>
