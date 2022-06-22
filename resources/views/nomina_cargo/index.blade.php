@extends('adminlte::page')

@section('title', 'NOMINA DE Cargo')

@section('content_header')
<h1>NOMINA DE CARGOS
    <a href="{{route('nomina_cargo.create')}}" class="btn btn-success btn-rounded" style="float: right;">
        Nuevo Cargo <i class="fa fa-plus-circle"></i>
    </a>
</h1>
@stop
@section('content')
    <div class="card card-info card-outline">
        <div class="card-body sinpadding">
            <div class="table table-bordered table-hover dataTable table-responsive">
                <table style="width:100%" class="table table-striped table-bordered datatable display nowrap data_table" id="table_nomina_cargos">
                    <thead>
                        <tr>
                            <th >#</th>
                            <th >Item</th>
                            <th >Nombre</th>
                            <th >Unidad Organizacional</th>
                            <th >Nivel</th>
                            <th >Salario</th>
                            <th >Tipo de Contrato</th>
                            <th >Estado</th>
                            <th ></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
@section('footer')
<strong>{{date("Y")}} ||  ELAPAS - SISTEMA DE RECURSOS HUMANOS </strong>
@stop
@section('js')
    @if(session('create')==true)
        <script>
            toastr.success('Nuevo Cargo registrado!','',{timeout:1000})
        </script>
    @else
        @if($errors->any())
            <script>
                toastr.error('no se pudo registrar cargo','ERROR',{timeout:1000})
            </script>
        @endif
    @endif
    @if(session('edit')==true)
        <script>
            toastr.success('Cargo modificado exitosamente.','',{timeout:1000})
        </script>
    @else
    @endif
    <script src="{{asset('js/scripts/nomina_cargo.js')}}"></script>
@stop
