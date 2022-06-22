@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<a href="{{route('users.create')}}" class="btn btn-success btn-rounded" style="float: right;">
    Registrar Usuario <i class="fa fa-plus-circle"></i>
</a>
    <h1>LISTA DE USUARIOS</h1>

@stop


@section('content')

<div class="table table-bordered table-hover dataTable table-responsive">
    <table class="table table-bordered display nowrap dataT" id="example">
    <thead>
      <tr>
        <th width="50">Id</th>
        <th>Nombre</th>
        <th width="350">Usuario</th>
        <th>Roles</th>
        <th width="150">Acciones</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->username}}</td>
                <td>
                  @foreach($user->roles as $rol)
                  {{$rol->name}}
                  @endforeach
                </td>
                <td>
                    <div class="row">
                        <form action="{{route('users.destroy',$user->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <a href='{{route('users.edit',$user->id)}}'
                                class='btn btn-info btn-icon btn-xs'>
                                Editar
                                <i class="fas fa-pencil-alt"></i></a>
                            <button class='btn btn-danger btn-icon btn-xs' type="submit">Eliminar  <i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
@stop
@section('footer')
    <strong>{{date("Y")}} || ELAPAS - SISTEMA DE RECURSOS HUMANOS </strong>
@stop
@section('js')
    <script>
    </script>
@stop
