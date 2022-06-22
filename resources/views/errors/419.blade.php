@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>419 Lo siento, </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">419 Lo siento, la se sesión ha caducado </li>
                </ol>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="error-page">
        <h2 class="headline text-warning"> 419</h2>
        <div class="error-content">
            <h3><i class="fas fa-exclamation-triangle text-warning"></i> ¡Oops! la se sesión ha caducado.</h3>
            <p>
                <a class="btn btn-primary btn-sm" href="/login">Volver a Iniciar Sesión</a>
            </p>
        </div>
    </div>
@stop
@section('footer')
    <strong>{{ date('Y') }} || ELAPAS - SISTEMA DE RECURSOS HUMANOS </strong>
@stop
