@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Sistema de Recursos Humanos</h1>
    <p><b>Usuario:</b> {{auth()->user()->name}} <b>Rol: </b>{{auth()->user()->roles[0]->name}}</p>
@stop

@section('content')
    {{-- <div class="card card-secondary card-outline">
    <div class="card-body sinpadding">
    </div>
</div> --}}
    {{-- <h4>Bienvenido. <strong>{{ auth()->user()->name }} </strong></h4> --}}
    @can('admin_rrhh')
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $trabajadores }}</h3>

                        <p><b>Trabajadores</b></p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <a href="{{route('trabajador.index')}}" class="small-box-footer"><b>Ingresar</b> <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $nomina_cargos_ocupados }}</h3>

                        <p><b>Cargos Ocupados</b></p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clipboard"></i>
                    </div>
                    <a href="{{route('nomina_cargo.index')}}" class="small-box-footer"><b>Ingresar</b> <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $items_habilitados }}</h3>

                        <p><b>Contratos Vigentes</b></p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clipboard"></i>
                    </div>
                    <a href="{{route('items.lista')}}" class="small-box-footer"><b>Ingresar</b> <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$nomina_cargos_libres}}</h3>

                        <p><b>Cargos Libres</b></p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clipboard"></i>
                    </div>
                    <a href="{{route('nomina_cargo.index')}}" class="small-box-footer"><b>Ingresar</b> <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
    @endcan

    <img src="{{ asset('css/ELAPAS.png') }}" width="500px" height="222px">
@stop
@section('footer')
    <strong>{{ date('Y') }} || ELAPAS - SISTEMA DE RECURSOS HUMANOS </strong>
@stop
