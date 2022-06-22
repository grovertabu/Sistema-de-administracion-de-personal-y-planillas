<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cronograma
    </title>
<style>
    body{
        font-family:verdana;
    }
    table{
        border-collapse:collapse;
    }
    .container{
        /* margin:30px 50px; */
        text-align:center;
    }
    .centrar{
        text-align: center;
    }
</style>
</head>
@php
    $dias = array("domingo","lunes","martes","miércoles","jueves","viernes","sábado");
    $n=1;
    date_default_timezone_set('America/La_Paz');
    $fecha=strtotime($fecha_inspeccion);
    $anio=date("Y",$fecha);
    $mes=date("M", $fecha);
    $dia=date("d", $fecha);
    $dia_s=date("l", $fecha);
	$fecha_ins=date("d-m-Y",$fecha);
    $Mes_ = strftime("%B", strtotime($mes));
    $dia_semana=$dias[(date('N', strtotime($fecha_inspeccion)))] 
@endphp
<body>
    <div class="container">
    <table border="1" width="100%">
    <tr>
        <th class="centrar" colspan="7">Cronograma de Ampliacion de red Matriz de {{ucfirst($dia_semana)}} {{$fecha_ins}}</th>
    </tr>
    <tr>
        <th rowspan="2">N°</th>
        <th rowspan="2">BARRIO</th>
        <th rowspan="2">Nombre Solicitante</th>
        <th rowspan="2">Celular</th>
        <th colspan="3">Fecha y hora de programacion</th>
    </tr>
    <tr>
        
        <th>Miercoles</th>
        <th>Jueves</th>
        <th>INSPECTOR</th>
    </tr>
    @foreach ($cronogramas as $cronograma)
        <tr>
            <td>{{$n++}}</td>
            <td>{{$cronograma->zona}}</td>
            <td>{{$cronograma->nombre_sol}}</td>
            <td>{{$cronograma->celular}}</td>
            @if($dias[(date('N', strtotime($cronograma->fecha_inspe)))]=="miércoles")
                <td class="centrar">{{date('H:s', strtotime($cronograma->fecha_inspe))}}</td>
                <td></td>
            @elseif ($dias[(date('N', strtotime($cronograma->fecha_inspe)))]=="jueves")
                <td></td>
                <td class="centrar">{{date('H:s', strtotime($cronograma->fecha_inspe))}}</td>
            @else
                <td></td>
                <td></td>
            @endif
            <td>{{$cronograma->name}}</td>
        </tr>
    @endforeach
    </table>
    </div>
</body>
</html>