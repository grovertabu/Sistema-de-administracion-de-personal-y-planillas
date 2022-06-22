@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>ELAPAS</h1>
@stop

@section('content')
{{-- <div class="card card-secondary card-outline">
    <div class="card-body sinpadding">
    </div>
</div> --}}
<h4>Bienvenido. <strong>{{auth()->user()->name}}</strong></h4>
<img src="{{asset('css/ELAPAS.png')}}" alt="">
@stop
@section('footer')
    <strong>{{date("Y")}} || ELAPAS - SISTEMA DE RECURSOS HUMANOS </strong>
@stop
