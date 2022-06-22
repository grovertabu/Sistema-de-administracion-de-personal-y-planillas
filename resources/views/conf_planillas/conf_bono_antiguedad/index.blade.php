@extends('adminlte::page')
@php
    $title = 'Lista Configuración bono antiguedad';
@endphp
@section('title', $title)

@section('content_header')
    <h1>{{$title}}
        <a href="{{ route('conf_bono_antiguedad.create') }}" class="btn btn-success" style="float: right;">
            <i class="fa fa-plus-circle"></i> Nuevo
        </a>
    </h1>
@stop
@section('content')
<div class="card card-info card-outline">
    <div class="card-body sinpadding">
        <div class="table table-bordered table-hover dataTable table-responsive">
            <table class="table table-bordered display nowrap datatable data_table" id="table_conf_bono_antiguedads">
                <thead >
                    <tr>
                        <th width="5%">#</th>
                        <th >Año inicio</th>
                        <th >Año fin</th>
                        <th >Porcentaje</th>
                        <th width="10%">Estado</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($conf_bono_antiguedads as $conf_bono_antiguedad)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $conf_bono_antiguedad->anio_i }}</td>
                            <td>{{ $conf_bono_antiguedad->anio_f }}</td>
                            <td>{{ $conf_bono_antiguedad->porcentaje }}</td>
                            @if ($conf_bono_antiguedad->estado == 'HABILITADO')
                                <td align="center"><span class="badge badge-success">{{ $conf_bono_antiguedad->estado }}</span></td>
                            @else
                                <td align="center"><span class="badge badge-danger">{{ $conf_bono_antiguedad->estado }}</span></td>
                            @endif
                            <td>
                                <a href='{{ route('conf_bono_antiguedad.edit', $conf_bono_antiguedad->id) }}' title='editar'
                                    class='btn btn-warning btn-icon btn-sm'> <i class="fas fa-edit"></i></a>
                                <button type="button" data-id="{{ $conf_bono_antiguedad->id }}" class="btn btn-danger btn-sm" title='eliminar'
                                    id="btnBorrarConfBonoAntiguedad"><i class="fas fa-trash"></i></button>
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
            toastr.success('Nueva configuración de bono antiguedad!', '', {
                timeout: 1000
            })
        </script>
    @endif
    @if (session('edit') == true)
        <script>
            toastr.success('configuración de bono antiguedad.', '', {
                timeout: 1000
            })
        </script>
    @else
    @endif
    <script src="{{ asset('js/scripts/conf_planillas/conf_bono_antiguedad.js') }}"></script>
@stop
