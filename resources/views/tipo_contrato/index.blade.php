@extends('adminlte::page')

@section('title', 'Tipo de Contrado')

@section('content_header')
    <h1>Tipo de Contrato
        <a href="{{ route('tipo_contrato.create') }}" class="btn btn-success" style="float: right;">
            <i class="fa fa-plus-circle"></i> Nuevo
        </a>
    </h1>
@stop
@section('content')
    <div class="card card-info card-outline">
        <div class="card-body sinpadding">
            <div class="table table-bordered table-hover dataTable table-responsive">
                <table class="table table-striped table-bordered display nowrap datatable data_table" id="table_tipo_contrato">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="35%">Nombre</th>
                            <th width="10%">Estado</th>
                            <th width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tipo_contratos as $tipo_c)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $tipo_c->nombre }}</td>
                                @if ($tipo_c->estado == 'ACTIVO')
                                    <td align="center"><span class="badge badge-success">{{ $tipo_c->estado }}</span></td>
                                @else
                                    <td align="center"><span class="badge badge-danger">{{ $tipo_c->estado }}</span></td>
                                @endif
                                <td>
                                    <a href='{{ route('tipo_contrato.edit', $tipo_c->id) }}' title='editar'
                                        class='btn btn-warning btn-icon btn-sm'> <i class="fas fa-edit"></i></a>
                                    <button type="button" data-id="{{ $tipo_c->id }}" class="btn btn-danger btn-sm"
                                        title='eliminar' id="btnBorrarTipoContrato"><i class="fas fa-trash"></i></button>
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
            toastr.success('Nuevo Tipo de contrato registrado!', '', {
                timeout: 1000
            })
        </script>
    @else
        @if ($errors->any())
            <script>
                toastr.error('no se pudo registrar Tipo de contrato', 'ERROR', {
                    timeout: 1000
                })
            </script>
        @endif
    @endif
    @if (session('edit') == true)
        <script>
            toastr.success('Tipo de contrato modificado exitosamente.', '', {
                timeout: 1000
            })
        </script>
    @else
    @endif
    @if (session('delete') == true)
        <script>
            toastr.success('Tipo de contrato eliminado exitosamente.', '', {
                timeout: 1000
            })
        </script>
    @else
        @if ($errors->any())
            <script>
                toastr.error('no se pudo registrar Tipo de contrato', 'ERROR', {
                    timeout: 1000
                })
            </script>
        @endif
    @endif
    <script src="{{ asset('js/scripts/tipo_contrato.js') }}"></script>
@stop
