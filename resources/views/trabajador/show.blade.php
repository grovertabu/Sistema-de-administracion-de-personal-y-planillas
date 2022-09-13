@extends('adminlte::page')

@section('title', 'Kardex Trabajador')
@section('content_header')
<div class="col-md-12">
  <a href="{{route('trabajador.index')}}" class="btn btn-success btn-xs float-right " >
    <i class="fas fa-arrow-left"></i> Volver
  </a>
</div><br>
@stop
@section('content')
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <!-- Imagen y datos de perfil del trabajador -->
          <div class="card card-info card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                @if ($trabajador->foto=="")
                <img class="profile-user-img img-fluid img-circle"
                      src="{{asset('images/default-avatar.jpg')}}"
                      alt="foto de perfil">
                @else
                <img class="profile-user-img img-circular"
                      src="{{ route('trabajador.avatar',encrypt($trabajador->id))}}"
                      alt="foto de perfil">
                @endif
              </div>
              <h3 class="profile-username text-center">{{$trabajador->nombre." ".$trabajador->apellido_paterno}}</h3>
              <p class="text-muted text-center">{{$trabajador->nacionalidad}}</p>
              @php
                  $comp=$trabajador->complemento=="" ? "" : "-";
              @endphp
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Documento</b>
                  <a class="float-right">{{$trabajador->ci.$comp}}
                    <span class="text-secondary">{{$trabajador->complemento}}</span>
                  </a>
                </li>
                <li class="list-group-item">
                  <b>Expedido</b> <a class="float-right">{{$trabajador->expedido}}</a>
                </li>
                <li class="list-group-item">
                  <b>Edad</b> <a class="float-right">{{edad($trabajador->fecha_nacimiento)}}</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="card card-info card-outline" >
              {{-- Menu de los nav del trabajador --}}
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#Datos_trabajador" data-toggle="tab">Datos</a></li>
                <li class="nav-item"><a class="nav-link" href="#f_academica" data-toggle="tab">Formación académica</a></li>
                <li class="nav-item"><a class="nav-link" href="#doc_personales" data-toggle="tab">Documentos</a></li>
                <li class="nav-item"><a class="nav-link" href="#cursos" data-toggle="tab">Curso</a></li>
                <li class="nav-item"><a class="nav-link" href="#exp_laboral" data-toggle="tab">Exp laboral</a></li>
                <li class="nav-item"><a class="nav-link" href="#meritos" data-toggle="tab">Méritos</a></li>
                <li class="nav-item"><a class="nav-link" href="#demeritos" data-toggle="tab">Deméritos</a></li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                {{-- Datos del trabajador --}}
                @include('trabajador.showData')
                {{-- ..................FORMACION ACADEMICA.......................... --}}
                <div class="tab-pane" id="f_academica">
                    @include('form_academica.index')
                    @include('form_academica.create')
                    @include('form_academica.ModalViewPdf')
                </div>
                {{-- CURSOS --}}
                <div class="tab-pane" id="doc_personales">
                    @include('documento_personal.index')
                    @include('documento_personal.create')
                    @include('documento_personal.ModalviewPdf')
                </div>
                {{-- CURSOS --}}
                <div class="tab-pane" id="cursos">
                    @include('curso.index')
                    @include('curso.create')
                    @include('curso.ModalviewPdf')
                </div>
                <div class="tab-pane" id="exp_laboral">
                    @include('experiencia_laboral.index')
                    @include('experiencia_laboral.create')
                    @include('experiencia_laboral.ModalViewPdf')
                </div>
                <div class="tab-pane" id="meritos">
                    @include('merito.index')
                    @include('merito.create')
                    @include('merito.modalViewPdf')
                </div>
                <div class="tab-pane" id="demeritos">
                    @include('demerito.index')
                    @include('demerito.create')
                    @include('demerito.modalViewPdf')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@stop

@section('js')
<script>

$(()=>{
    $('#fecha_nacimiento').datetimepicker({
        defaultDate: "{{$trabajador->fecha_nacimiento}}",
        format: 'DD/MM/YYYY',
        locale: moment.locale('es'),
    });
    var translate_spanish = "{{asset('vendor/funciones/datatable_spanish.json')}}";
    // Lista Formacion academica
    table_formacion = $('#table_formacion').DataTable({
        ajax: {
            url: "{{route('form_academica.listar',$trabajador->id)}}",
        },
        columns : [
            {data: null,
                render: function (data, type, full, meta)
                {
                    return meta.row + 1;
                }
            },
            {data: 'titulo_formacion'},
            {data: 'nivel_formacion'},
            {data: 'fecha_emision'},
            {data: 'lugar_formacion'},
            {data: 'action',orderable:false},
        ],
        order: [],
        lengthMenu: [[5, 25, 50, -1], [5, 25, 50, "All"]],
        autoWidth: false,
        responsive: true,
        language: {
            url: translate_spanish
        }
    });
    // Lista Cursos
    table_cursos = $('#table_cursos').DataTable({
        ajax: {
            url: "{{route('curso.listar',$trabajador->id)}}",
        },
        columns : [
            {data: null, defaultContent : ''},
            {data: 'nombre_curso'},
            {data: 'institucion'},
            {data: 'horas_academicas'},
            {render:
                function ( data, type, row ) {
                    return moment(row['fecha_curso']).format('DD/MM/YYYY');
                }
            },
            {data: 'action',orderable:false},
        ],
        order: [],
        lengthMenu: [[5, 25, 50, -1], [5, 25, 50, "All"]],
        autoWidth: false,
        responsive: true,
        language: {
            url: translate_spanish
        }
    });
    // lista documento personales
    table_documento_personals = $('#table_documento_personals').DataTable({
        ajax: {
            url: "{{route('documento_personal.listar',$trabajador->id)}}",
        },
        columns : [
            {data: null, defaultContent : ''},
            {data: 'detalle_documento'},
            {data: 'fecha_registro'},
            {data: 'tipo_documento'},
            {data: 'action',orderable:false},
        ],
        order: [],
        lengthMenu: [[5, 25, 50, -1], [5, 25, 50, "All"]],
        autoWidth: false,
        responsive: true,
        language: {
            url: translate_spanish
        }
    });
    // LISTA DE TABLA EXPERIENCIA LABORAL
    table_exp_laboral = $('#table_exp_laboral').DataTable({
        ajax: {
            url: "{{route('exp_laboral.listar',$trabajador->id)}}",
        },
        columns : [
            {data: null, defaultContent : ''},
            {data: 'nombre_entidad'},
            {data: 'cargo_laboral'},
            {data: 'funcion_laboral'},
            {render:
                function ( data, type, row ) {
                    return moment(row['fecha_inicio']).format('DD/MM/YYYY');
                }
            },
            {render:
                function ( data, type, row ) {
                    return moment(row['fecha_fin']).format('DD/MM/YYYY');
                }
            },
            {render:
                function ( data, type, row ) {
                    date1=new Date(moment(row['fecha_inicio']).format('MM/DD/YYYY'));
                    date2=new Date(moment(row['fecha_fin']).format('MM/DD/YYYY'));
                    date = row['fecha_inicio'].split('-');

                    var year = date2.getFullYear();
                    var month = date2.getMonth() + 1;
                    var day = date2.getDate();

                    var yy = parseInt(date[0]);
                    var mm = parseInt(date[1]);
                    var dd = parseInt(date[2]);
                    var years, months, days;
                    // months
                    months = month - mm;
                    if (day < dd) {
                        months = months - 1;
                    }
                    // years
                    years = year - yy;
                    if (month * 100 + day < mm * 100 + dd) {
                        years = years - 1;
                        months = months + 12;
                    }
                    // days
                    days = Math.floor((date2.getTime() - (new Date(yy + years, mm + months - 1, dd)).getTime()) / (24 * 60 * 60 * 1000));
                    message= years + " Años <br> " + months + " Meses<br> " + days + " Dias"
                    return message;
                }
            },
            {data: 'action',orderable:false},
        ],
        order: [],
        autoWidth: false,
        responsive: true,
        lengthMenu: [[5, 25, 50, -1], [5, 25, 50, "All"]],
        language: {
            url:translate_spanish
        }
    });
    // Lista meritos
    table_meritos = $('#table_meritos').DataTable({
        ajax: {
            url: "{{route('merito.listar',$trabajador->id)}}",
        },
        columns : [
            {data: null, defaultContent : ''},
            {data: 'detalle_merito'},
            {data: 'fecha_merito'},
            {data: 'action',orderable:false},
        ],
        order: [],
        lengthMenu: [[5, 25, 50, -1], [5, 25, 50, "All"]],
        autoWidth: false,
        responsive: true,
        language: {
            url:translate_spanish
        }
    });
    // Lista demeritos
    table_demeritos = $('#table_demeritos').DataTable({
        ajax: {
            url: "{{route('demerito.listar',$trabajador->id)}}",
        },
        columns : [
            {data: null, defaultContent : ''},
            {data: 'detalle_demerito'},
            {data: 'fecha_demerito'},
            {data: 'action',orderable:false},
        ],
        order: [],
        autoWidth: false,
        responsive: true,
        lengthMenu: [[5, 25, 50, -1], [5, 25, 50, "All"]],
        language: {
            url:translate_spanish
        }
    });


    $(document).on('click','#deleteDocumento', function(){
        var table = $(this).data('table');
        var ruta = $(this).data('ruta');
        console.log(ruta);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        Swal.fire({
            title: '¿Está seguro?',
            text: "¿Desea eliminar este registro?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: 'red',
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'Cancelar',
             width:300,
             allowOutsideClick:false,
             reverseButtons: true
        }).then(function(result){
              if(result.value){
                $.ajax({
                    url:ruta,
                    method: 'DELETE',
                    success: function(result) {
                        if(result.success){
                            $('#'+table).DataTable().ajax.reload(null, false);
                            toastr.success(result.message);
                        }else{
                            toastr.error(result.message);
                        }
                    }
                });
              }
        });
    });
})
</script>
<script>
    var urlFormacionAcademica = "{{route('form_academica.view_document',':id')}}"
</script>
<script src="{{asset('js/scripts/form_academica.js')}}"></script>
<script src="{{asset('js/scripts/curso.js')}}"></script>
<script src="{{asset('js/scripts/exp_laboral.js')}}"></script>
<script src="{{asset('js/scripts/merito.js')}}"></script>
<script src="{{asset('js/scripts/demerito.js')}}"></script>
<script src="{{asset('js/scripts/documento_personal.js')}}"></script>
@stop
@section('footer')
    <strong>{{date("Y")}} || ELAPAS - SISTEMA DE RECURSOS HUMANOS </strong>
@stop
