
@extends('adminlte::page')

@section('title', 'Documentos Personales')

@section('content')
<div class="col-md-12">
    <a href="{{route('trabajador.mostrar',$id)}}" class="btn btn-success btn-xs float-right " >
        <i class="fas fa-arrow-left"></i> Volver</a></div><br><br>
    <div class="row">
        <div class="col-md-4">
            <!-- Profile Image -->
            <div class="card card-info card-outline">
                <div class="card-body ">
                <form role="form"  id="form_doc_personal" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="trabajador_id" id="trabajador_id" value="{{$id}}">
                        <input type="hidden" name="created_by" id="created_by" value="{{auth()->user()->name}}">
                        <x-dg-select2 id="tipo_documento" name="tipo_documento" label="Nivel" topclass="col-md-12 required">
                            <x-dg-option value="">--SELECCIONE--</x-dg-option>
                            <x-dg-option value="personal">PERSONAL</x-dg-option>
                            <x-dg-option value="administrativo">ADMINISTRATIVO</x-dg-option>
                        </x-dg-select2>
                        <x-dg-input type="text" name="detalle_documento" id="detalle_documento"
                            label="Detalle" topclass="col-md-12 required"
                            placeholder="Ejemplo: Servicio Militar"/>
                        <x-date-icon id="fecha_registro"  name="fecha_registro"
                            label="Fecha de registro" topclass="col-md-12 required" />
                        <x-input-file name="file_documento" id="file_documento" topclass="col-md-12"
                            label="Subir Documento Personal (Formato Pdf)" placeholder="Subir Documento" accept=".pdf"/>
                        <x-dg-submit type="success" topclass="col-12" inputclass="float-right" label="Guardar" />
                    </div>
                </form>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-8">
            <x-dg-card title="DOCUMENTOS PERSONALES" bg="info" :outline="true" >
                <div class="table table-bordered table-hover dataTable table-responsive">
                    <table class="table table-bordered datatable display nowrap data_table" id="data_table_doc">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tipo de Documento</th>
                                <th>Detalle</th>
                                <th>Fecha de registro</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </x-dg-card>
        </div>
    </div>
@stop
@section('footer')
    <strong>{{date("Y")}} || ELAPAS - SISTEMA DE RECURSOS HUMANOS </strong>
@stop
@section('js')

    @if(session('eliminar')=='ok')
        <script>
            Swal.fire(
                'Modificado!',
                'Su registro ha sido modificado.',
                'success'
                )
        </script>
    @else
        @if($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Algo salió mal!',
                })

            </script>
        @endif
    @endif
<script>

$(()=>{

    data_table_doc = $('#data_table_doc').DataTable({
        ajax: {
            url: "{{route('documento_personal.create',$id)}}",
        },
        columns : [
            {data: null, defaultContent : ''},
            {data: 'tipo_documento'},
            {data: 'detalle_documento'},
            {render:
                function ( data, type, row ) {
                    return row['fecha_registro'];
                }
            },
            {data: 'action',orderable:false},
        ],
        order: [],
        autoWidth: false,
        responsive: true,
        language: {
            url:"{{asset('vendor/funciones/datatable_spanish.json')}}"
        }
    });
    data_table_doc.on('draw.dt', function () {
        var PageInfo = $('#data_table_doc').DataTable().page.info();
        data_table_doc.column(0, {
            page: 'all'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    });
    // REGISTRAR DOCUMENTO PERSONAL
    $('#form_doc_personal').submit(function(e){
        e.preventDefault();
        var _token = $('input[name=_token]').val();
        var file_documento = $("#file_documento")[0].files[0];
        const formData= new FormData();
        formData.append('_token',_token);
        formData.append('trabajador_id',$('#trabajador_id').val());
        formData.append('tipo_documento',$('#tipo_documento').val());
        formData.append('detalle_documento',$('#detalle_documento').val());
        formData.append('fecha_registro',$('#fecha_registro').val());
        formData.append('created_by',$('#created_by').val());
        formData.append('file_documento',file_documento);
        $.ajax({
            url:"/documento-personal/registrar",
            type:"POST",
            data:formData,
            processData: false,
            dataType:'json',
            contentType: false,
            cache:false,
            success:function(resp){
                if (resp.code == 0) {
                    toastr.error(resp.error,'ERROR',{timeout:1000})
                }
                else{
                    $('#form_doc_personal')[0].reset();
                    $('#data_table_doc').DataTable().ajax.reload(null, false)
                    toastr.success(resp.msg,'Nuevo Registro',{timeout:3000});
                }
            },
            error:function(response, status, xhr) {
                Swal.fire({
                    title: status,
                    icon: 'warning',
                    confirmButtonText: 'Aceptar',
                }).then(() => {
                    location.reload();
                });
            }
        });
    });


    $('#form_doc_personal').validate({
        lang: 'es',
        rules: {
            tipo_documento: {
                required: true,

            },
            detalle_documento: {
                required: true,
            },
            fecha_registro: {
                required: true,
            },
        },
        messages: {

        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.addClass('invalid-feedback');
                error.insertAfter(element.parent());
            }
            else{
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            }
        },
    });

    $("input").on("keypress", function () {
        $input=$(this);
        setTimeout(function () {
            $input.val($input.val().toUpperCase());
        },0);
    });

});
</script>

@stop


