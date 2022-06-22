@extends('adminlte::page')

@section('title', 'Estructura organizacional')

@section('content_header')
    <h1>Estructura Organizacional
        <a href="{{ route('estruct_org.create') }}" class="btn btn-success" style="float: right;">
            <i class="fa fa-plus-circle"></i> Nuevo
        </a>
    </h1>
@stop
@section('content')
    <div class="card card-info card-outline">
        <div class="card-body sinpadding">
            <div class="table table-bordered table-hover dataTable table-responsive">
                <table class="table table-bordered display nowrap datatable data_table" id="table_estructura">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="35%">Nombre</th>
                            <th width="25%">Version</th>
                            <th width="10%">Estado</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estructs as $est)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $est->nombre }}</td>
                                <td>{{ $est->version }}</td>
                                @if ($est->estado == 'ACTIVO')
                                    <td align="center"><span class="badge badge-success">{{ $est->estado }}</span></td>
                                @else
                                    <td align="center"><span class="badge badge-danger">{{ $est->estado }}</span></td>
                                @endif
                                <td>
                                    <a href='{{ route('estruct_org.edit', $est->id) }}' title='editar'
                                        class='btn btn-warning btn-icon btn-sm'> <i class="fas fa-edit"></i></a>
                                    <button type="button" data-id="{{ $est->id }}" class="btn btn-danger btn-sm"
                                        title='eliminar' id="deleteEstO"><i class="fas fa-trash"></i></button>
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
            toastr.success('Nueva estructura organizacional registrado!', '', {
                timeout: 1000
            })
        </script>
    @else
        @if ($errors->any())
            <script>
                toastr.error('no se pudo registrar estructura organizacional', 'ERROR', {
                    timeout: 1000
                })
            </script>
        @endif
    @endif
    @if (session('edit') == true)
        <script>
            toastr.success('Estructura organizacional modificado exitosamente.', '', {
                timeout: 1000
            })
        </script>
    @else
    @endif
    <script src="{{ asset('js/scripts/estructura_org.js') }}"></script>
@stop
