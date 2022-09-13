@extends('adminlte::page')

@section('title', 'Configuración Descuentos')

@section('content_header')
    <h1>Configuración de Descuentos
        <a href="{{ route('conf_descuento.create') }}" class="btn btn-success" style="float: right;">
            <i class="fa fa-plus-circle"></i> Nuevo
        </a>
    </h1>
@stop
@section('content')
    <div class="card card-info card-outline">
        <div class="card-body sinpadding">
            <div class="table table-bordered table-hover dataTable table-responsive">
                <table class="table table-bordered display nowrap datatable data_table" id="table_conf_descuento">
                    <thead>
                        <tr>
                            <th width="5%">Nro</th>
                            <th width="35%">Nombre descuento</th>
                            <th width="10%">Estado</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($conf_descuentos as $conf_descuento)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $conf_descuento->nombre_descuento }}</td>
                                @if ($conf_descuento->estado == 'HABILITADO')
                                    <td align="center"><span
                                            class="badge badge-success">{{ $conf_descuento->estado }}</span></td>
                                @else
                                    <td align="center"><span class="badge badge-danger">{{ $conf_descuento->estado }}</span>
                                    </td>
                                @endif
                                <td>
                                    <a href='{{ route('conf_descuento.edit', $conf_descuento->id) }}' title='editar'
                                        class='btn btn-warning btn-icon btn-sm'> <i class="fas fa-edit"></i></a>
                                    <button type="button" data-id="{{ $conf_descuento->id }}" class="btn btn-danger btn-sm"
                                        title='eliminar' id="btnBorrarConfDescuento"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop
@section('footer')
    <strong>{{ date('Y') }} || ELAPAS - SISTEMA DE RECURSOS HUMANOS </strong>
@stop
@section('js')
    @if (session('create') == true)
        <script>
            toastr.success('Nueva configuración de descuento registrado!', '', {
                timeout: 1000
            })
        </script>
    @endif
    @if (session('edit') == true)
        <script>
            toastr.success('Configuración de descuento modificado exitosamente.', '', {
                timeout: 1000
            })
        </script>
    @else
    @endif
    @if (session('delete') == true)
        <script>
            toastr.success('configuración de descuento eliminado exitosamente.', '', {
                timeout: 1000
            })
        </script>
    @endif
    <script>
        $(() => {
            //  tabla configuracion de aportes
            table_conf_descuento = $('#table_conf_descuento').DataTable({
                autoWidth: true,
                responsive: true,
                scrollY: '45vh',
                scrollX: true,
                pagingType: "full_numbers",
                language: {
                    url: "../../vendor/funciones/datatable_spanish.json"
                }
            });
            $(document).on('click', '#btnBorrarConfDescuento', function() {
                var id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                Swal.fire({
                    text: "¿Está seguro de eliminar el registro?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'green',
                    cancelButtonColor: 'red',
                    confirmButtonText: 'Si, eliminar',
                    cancelButtonText: 'Cancelar',
                    width: 300,
                    allowOutsideClick: false,
                    reverseButtons: true
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            url: 'configuracion-descuento/' + id,
                            method: 'DELETE',
                            success: function(resp) {
                                if (resp.success) {
                                    Swal.fire({
                                        text: resp.message,
                                        icon: 'success',
                                        confirmButtonColor: 'green',
                                        confirmButtonText: 'Ok',
                                        width: 400,
                                        allowOutsideClick: false,
                                        reverseButtons: true
                                    }).then(function(result) {
                                        if (result.value) {
                                            window.location.reload()
                                        }
                                    });
                                } else {
                                    toastr.error(resp.message);
                                }
                            },
                            error: function(response, status, xhr) {
                                console.log(response)
                                Swal.fire({
                                    text: response.responseJSON.message,
                                    icon: 'warning',
                                    confirmButtonText: 'Aceptar',
                                }).then(() => {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@stop
