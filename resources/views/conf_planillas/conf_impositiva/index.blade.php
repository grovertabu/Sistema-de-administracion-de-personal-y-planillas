@extends('adminlte::page')

@section('title', 'Configuración Impositiva')

@section('content_header')
    <h1>Configuración de Impositiva
        <a href="{{ route('conf_impositiva.create') }}" class="btn btn-success" style="float: right;">
            <i class="fa fa-plus-circle"></i> Nuevo
        </a>
    </h1>
@stop
@section('content')
<div class="card card-info card-outline">
    <div class="card-body sinpadding">
        <div class="table table-bordered table-hover dataTable table-responsive">
            <table class="table table-bordered display nowrap datatable data_table" id="table_conf_impositivas">
                <thead >
                    <tr>
                        <th width="5%">#</th>
                        <th >Salario minimo</th>
                        <th >Cantidad Salario minimo</th>
                        <th >Porcentaje</th>
                        <th width="10%">Estado</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($conf_impositivas as $conf_impositiva)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $conf_impositiva->salario_minimo }}</td>
                            <td>{{ $conf_impositiva->cantidad_salario_minimo }}</td>
                            <td>{{ $conf_impositiva->porcentaje_impositiva }}</td>
                            @if ($conf_impositiva->estado == 'HABILITADO')
                                <td align="center"><span class="badge badge-success">{{ $conf_impositiva->estado }}</span></td>
                            @else
                                <td align="center"><span class="badge badge-danger">{{ $conf_impositiva->estado }}</span></td>
                            @endif
                            <td>
                                <a href='{{ route('conf_impositiva.edit', $conf_impositiva->id) }}' title='editar'
                                    class='btn btn-warning btn-icon btn-sm'> <i class="fas fa-edit"></i></a>
                                <button type="button" data-id="{{ $conf_impositiva->id }}" class="btn btn-danger btn-sm" title='eliminar'
                                    id="btnBorrarConfImpositiva"><i class="fas fa-trash"></i></button>
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
            toastr.success('Nueva configuración de Impositiva registrado!', '', {
                timeout: 1000
            })
        </script>
    @endif
    @if (session('edit') == true)
        <script>
            toastr.success('configuración de impositiva modificado exitosamente.', '', {
                timeout: 1000
            })
        </script>
    @else
    @endif
    <script src="{{ asset('js/scripts/conf_planillas/conf_impositiva.js') }}"></script>
@stop
