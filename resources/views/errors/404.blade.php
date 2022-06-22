@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>404 Página no encontrada</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">404 Página no encontrada</li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="error-page">
        <h2 class="headline text-warning"> 404</h2>
        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> ¡Oops! Página no encontrada.</h3>
            <p>
                No hemos podido encontrar la página que buscaba. Mientras tanto Puede  <br>
                <a class="btn btn-primary btn-sm" href="/inicio">Volver a Inicio</a>
            </p>
        </div>
    </div>
@stop
@section('footer')
    <strong>{{ date('Y') }} || ELAPAS - SISTEMA DE RECURSOS HUMANOS </strong>
@stop
