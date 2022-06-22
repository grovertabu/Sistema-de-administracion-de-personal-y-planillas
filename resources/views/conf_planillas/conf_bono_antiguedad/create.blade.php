@extends('adminlte::page')
@php
    $title = 'Nueva configuración de bono de antiguedad';
@endphp
@section('title', $title)

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                </div>
                <form action="{{ route('conf_bono_antiguedad.store') }}" method="POST" class="create"
                    role="form" id="form_conf_bono_antiguedad">
                    @csrf
                    <div class="card-body row">
                        <x-input type="number" name="anio_i" id="anio_i" label="Año inicio" topclass="col-md-12 required"
                            value="{{ old('anio_i') }}" />
                        <x-input type="number" name="anio_f" id="anio_f" label="Año fin" topclass="col-md-12 required"
                            value="{{ old('anio_f') }}" />
                        <x-input type="number" name="porcentaje" id="porcentaje" label="Porcentaje" topclass="col-md-12 required"
                            value="{{ old('porcentaje') }}" step="0.5"/>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-danger" href="{{ route('conf_bono_antiguedad.index') }}" role="tab"><i
                                        class="far fa-window-close"></i> Cancelar</a>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success float-right"><i class="fa fa-save"></i> Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop
@section('footer')
    <strong>{{ date('Y') }} || ELAPAS - SISTEMA DE RECURSOS HUMANOS </strong>
@stop

