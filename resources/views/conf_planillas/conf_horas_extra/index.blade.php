@extends('adminlte::page')

@section('title', 'Configuración Horas extra')

@section('content_header')
    <h1>Configuración de horas extra
        <a href="{{ route('conf_horas_extra.create') }}" class="btn btn-success" style="float: right;">
            <i class="fa fa-plus-circle"></i> Nuevo
        </a>
    </h1>
@stop
@section('content')
<div class="card card-info card-outline">
    <div class="card-body sinpadding">
        <div class="table table-bordered table-hover dataTable table-responsive">
            <table class="table table-bordered display nowrap datatable data_table" id="table_conf_horas_extra">
                <thead>
                    <tr>
                        <th width="5%">Nro</th>
                        <th width="35%">Descripción</th>
                        <th >Factor de cálculo</th>
                        <th width="10%">Estado</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($conf_horas_extras as $conf_horas_extra)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $conf_horas_extra->tipo_hora_extra }}</td>
                            <td>{{ $conf_horas_extra->factor_calculo }}</td>
                            @if ($conf_horas_extra->estado == 'HABILITADO')
                                <td align="center"><span class="badge badge-success">{{ $conf_horas_extra->estado }}</span></td>
                            @else
                                <td align="center"><span class="badge badge-danger">{{ $conf_horas_extra->estado }}</span></td>
                            @endif
                            <td>
                                <a href='{{ route('conf_horas_extra.edit', $conf_horas_extra->id) }}' title='editar'
                                    class='btn btn-warning btn-icon btn-sm'> <i class="fas fa-edit"></i></a>
                                <button type="button" data-id="{{ $conf_horas_extra->id }}" class="btn btn-danger btn-sm" title='eliminar'
                                    id="btnBorrarConfHoraExtra"><i class="fas fa-trash"></i></button>
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
            toastr.success('Nueva configuración de hora extra registrado!', '', {
                timeout: 1000
            })
        </script>
    @endif
    @if (session('edit') == true)
        <script>
            toastr.success('Configuración de hora extra modificado exitosamente.', '', {
                timeout: 1000
            })
        </script>
    @else
    @endif
    @if (session('delete') == true)
        <script>
            toastr.success('configuración de hora extra eliminado exitosamente.', '', {
                timeout: 1000
            })
        </script>
    @endif
    <script src="{{ asset('js/scripts/conf_planillas/conf_horas_extra.js') }}"></script>
@stop
