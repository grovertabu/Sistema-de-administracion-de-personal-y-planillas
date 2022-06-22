@extends('adminlte::page')

@section('title', 'Configuración aporte')

@section('content_header')
    <h1>Configuración de Aportes
        <a href="{{ route('conf_aporte.create') }}" class="btn btn-success" style="float: right;">
            <i class="fa fa-plus-circle"></i> Nuevo
        </a>
    </h1>
@stop
@section('content')
<div class="card card-info card-outline">
    <div class="card-body sinpadding">
        <div class="table table-bordered table-hover dataTable table-responsive">
            <table class="table table-bordered display nowrap datatable data_table" id="table_conf_aportes">
                <thead >
                    <tr>
                        <th width="5%">#</th>
                        <th width="35%">Tipo Aporte</th>
                        <th >Rango inicial</th>
                        <th >Rango final</th>
                        <th >Porcentaje de aporte</th>
                        <th width="10%">Estado</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($conf_aportes as $conf_aporte)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $conf_aporte->tipo_aporte }}</td>
                            <td>{{ $conf_aporte->rango_inicial }}</td>
                            <td>{{ $conf_aporte->rango_final }}</td>
                            <td>{{ $conf_aporte->porcentaje_aporte }}</td>
                            @if ($conf_aporte->estado == 'HABILITADO')
                                <td align="center"><span class="badge badge-success">{{ $conf_aporte->estado }}</span></td>
                            @else
                                <td align="center"><span class="badge badge-danger">{{ $conf_aporte->estado }}</span></td>
                            @endif
                            <td>
                                <a href='{{ route('conf_aporte.edit', $conf_aporte->id) }}' title='editar'
                                    class='btn btn-warning btn-icon btn-sm'> <i class="fas fa-edit"></i></a>
                                <button type="button" data-id="{{ $conf_aporte->id }}" class="btn btn-danger btn-sm" title='eliminar'
                                    id="btnBorrarConfAporte"><i class="fas fa-trash"></i></button>
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
            toastr.success('Nueva configuración de aporte registrado!', '', {
                timeout: 1000
            })
        </script>
    @endif
    @if (session('edit') == true)
        <script>
            toastr.success('configuración de aporte modificado exitosamente.', '', {
                timeout: 1000
            })
        </script>
    @else
    @endif
    @if (session('delete') == true)
        <script>
            toastr.success('configuración de aporte eliminado exitosamente.', '', {
                timeout: 1000
            })
        </script>
    @endif
    <script src="{{ asset('js/scripts/conf_planillas/conf_aporte.js') }}"></script>
@stop
