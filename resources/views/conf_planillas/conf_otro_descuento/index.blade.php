@extends('adminlte::page')

@section('title', 'Configuración aporte')

@section('content_header')
    <h1>Configuración de otros descuentos
        <a href="{{ route('conf_otro_descuento.create') }}" class="btn btn-success" style="float: right;">
            <i class="fa fa-plus-circle"></i> Nuevo
        </a>
    </h1>
@stop
@section('content')
<div class="card card-info card-outline">
    <div class="card-body sinpadding">
        <div class="table table-bordered table-hover dataTable table-responsive">
            <table width="100%" class="table table-striped table-bordered datatable data_table " id="table_conf_otro_descuento">
                <thead >
                    <tr>
                        <th >#</th>
                        <th width="620px">Descripción</th>
                        <th >Factor de cálculo</th>
                        <th >Estado</th>
                        <th ></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    @foreach ($conf_otros_descuentos as $conf_otro_descuento)
                            <td>{{ $i++ }}</td>
                            <td>{{ $conf_otro_descuento->descripcion }}</td>
                            <td>{{ $conf_otro_descuento->factor_calculado }}</td>
                            @if ($conf_otro_descuento->estado == 'HABILITADO')
                                <td align="center"><span class="badge badge-success">{{ $conf_otro_descuento->estado }}</span></td>
                            @else
                                <td align="center"><span class="badge badge-danger">{{ $conf_otro_descuento->estado }}</span></td>
                            @endif
                            <td>
                                <a href='{{ route('conf_otro_descuento.edit', $conf_otro_descuento->id) }}' title='editar'
                                    class='btn btn-warning btn-icon btn-sm'> <i class="fas fa-edit"></i></a>
                                <button type="button" data-id="{{ $conf_otro_descuento->id }}" class="btn btn-danger btn-sm" title='eliminar'
                                    id="btnBorrarConfOtroDescuento"><i class="fas fa-trash"></i></button>
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
            toastr.success('Nueva configuración de otro descuento registrado!', '', {
                timeout: 1000
            })
        </script>
    @endif
    @if (session('edit') == true)
        <script>
            toastr.success('Configuración de otro descuento modificado exitosamente.', '', {
                timeout: 1000
            })
        </script>
    @else
    @endif
    @if (session('delete') == true)
        <script>
            toastr.success('configuración de otro descuento eliminado exitosamente.', '', {
                timeout: 1000
            })
        </script>
    @endif
    <script src="{{ asset('js/scripts/conf_planillas/conf_otro_descuento.js') }}"></script>
@stop
