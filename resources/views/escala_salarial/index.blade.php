@extends('adminlte::page')

@section('title', 'Escala Salarial')

@section('content_header')
    <h3>Escala Salarial
        <a href="{{ route('escala_salarial.create') }}" class="btn btn-success" style="float: right;">
            <i class="fa fa-plus-circle"></i> Nuevo
        </a>
    </h3>
@stop
@section('content')
    <div class="card card-info card-outline">
        <div class="card-body sinpadding">
            <div class="table table-bordered table-hover dataTable table-responsive">
                <table class="table table-striped table-bordered display nowrap datatable data_table"
                    id="table_escala_salarial">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nivel</th>
                            <th>Descripción</th>
                            <th>N° Casos</th>
                            <th>Salario Mensual</th>
                            <th>Estructura Organizacional</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($escala_salarials as $esc)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $esc->nivel }}</td>
                                <td>{{ $esc->descripcion }}</td>
                                <td>{{ $esc->casos }}</td>
                                <td>{{ number_format($esc->salario_mensual, 2, ',', '.') }}</td>
                                <td>{{ $esc->estructura_organizacional->nombre . '[' . $esc->estructura_organizacional->version . ']' }}
                                </td>
                                @if ($esc->estado == 'ACTIVO')
                                    <td align="center"><span class="badge badge-success">{{ $esc->estado }}</span></td>
                                @else
                                    <td align="center"><span class="badge badge-danger">{{ $esc->estado }}</span></td>
                                @endif
                                <td>
                                    <a href='{{ route('escala_salarial.edit', $esc->id) }}' title='editar'
                                        class='btn btn-warning btn-icon btn-sm'> <i class="fas fa-edit"></i></a>
                                    <button type="button" data-id="{{ $esc->id }}"
                                        class="btn btn-danger btn-sm btnBorrarEscala" title='eliminar'
                                        id="btnBorrarEscala"><i class="fas fa-trash"></i></button>
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
            toastr.success('Escala Salarial registrado exitosamente.', '', {
                timeout: 1000
            })
        </script>
    @else
        @if ($errors->any())
            <script>
                toastr.error('no se pudo registrar escala salarial', 'ERROR', {
                    timeout: 1000
                })
            </script>
        @endif
    @endif
    @if (session('edit') == true)
        <script>
            toastr.success('Escala Salarial modificado exitosamente.', '', {
                timeout: 1000
            })
        </script>
    @else
    @endif
    <script src="{{ asset('js/scripts/escala_salarial.js') }}"></script>
@stop
