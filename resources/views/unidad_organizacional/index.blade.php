@extends('adminlte::page')

@section('title', 'Unidad Organizacional')

@section('content_header')
    <h3>Unidad Organizacional
        <a href="{{ route('unidad_organizacional.create') }}" class="btn btn-success" style="float: right;">
            <i class="fa fa-plus-circle"></i> Nuevo
        </a>
    </h3>
@stop
@section('content')
    <div class="card card-info card-outline">
        <div class="card-body sinpadding">
            <div class="table table-bordered table-hover dataTable table-responsive">
                <table class="table table-striped table-bordered display nowrap datatable data_table"
                    id="table_unidad_organizacional">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="35%">Nombre</th>
                            <th width="25%">Estructura Organizacional</th>
                            <th width="10%">Estado</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($unidad_organizacionals as $unidad)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $unidad->seccion }}</td>
                                <td>{{ $unidad->estructura_organizacional->nombre . '[' . $unidad->estructura_organizacional->version . ']' }}
                                </td>
                                @if ($unidad->estado == 'ACTIVO')
                                    <td align="center"><span class="badge badge-success">{{ $unidad->estado }}</span></td>
                                @else
                                    <td align="center"><span class="badge badge-danger">{{ $unidad->estado }}</span></td>
                                @endif
                                <td>
                                    <a href='{{ route('unidad_organizacional.edit', $unidad->id) }}' title='editar'
                                        class='btn btn-warning btn-icon btn-sm'> <i class="fas fa-edit"></i></a>
                                    <button type="button" data-id="{{ $unidad->id }}"
                                        class="btn btn-danger btn-sm btnBorrarUnidad" title='eliminar'
                                        id="btnBorrarUnidad"><i class="fas fa-trash"></i></button>
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
            toastr.success('Unidad Organizacional registrado exitosamente.', '', {
                timeout: 1000
            })
        </script>
    @else
        @if ($errors->any())
            <script>
                toastr.error('no se pudo registrar Unidad Organizacional', 'ERROR', {
                    timeout: 1000
                })
            </script>
        @endif
    @endif
    @if (session('edit') == true)
        <script>
            toastr.success('Unidad Organizacional modificado exitosamente.', '', {
                timeout: 1000
            })
        </script>
    @else
    @endif
    <script src="{{ asset('js/scripts/unidad_organizacional.js') }}"></script>
@stop
