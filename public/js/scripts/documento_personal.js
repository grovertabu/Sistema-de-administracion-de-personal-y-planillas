$(()=>{

    table_documento_personals.on('draw.dt', function () {
        table_documento_personals.column(0, {
            page: 'all'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    });

    $("#btnRegistrarDocumentoPersonal").click(function(){
        $("#formDocumentoPersonal").trigger("reset");
        $(".modal-header").css("background-color", "#093C3C");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("REGISTRAR DOCUMENTO");
        $("#modalCrudDocumentoPersonal").modal("show");
    });

    $('.closeModalPdf').on('click', function(){
        $('#modalCrudDocumentoPersonal').modal("hide");
    });
    // Mostrar Documento DocumentoPersonal
    var id;
    $('body').on('click', '#ViewModalDocumentoPersonal', function(e) {
        e.preventDefault();
        $(".modal-title").text("DOCUMENTO");
        id = $(this).data('id');
        console.log(id)
        html='<div class="col-12 justify-content-center row">'+
            '<iframe src="/documento_personal/documento/'+id+'"'+
                'width="1200" height="420">'+
            '</iframe>'+
            '</div>';
        $('#ContenidoDocumentoPersonal').html(html);
        $('#modalDocumentoPersonal').modal("show");
    });

    $('#formDocumentoPersonals').submit(function(e){
        e.preventDefault();
        var _token = $('input[name=_token]').val();
        var file_documento = $("#file_documento")[0].files[0];
        const formData= new FormData();
        formData.append('_token',_token);
        formData.append('trabajador_id',$('#trabajador_id').val());
        formData.append('detalle_documento',$('#detalle_documento').val());
        formData.append('tipo_documento',$('#tipo_documento').val());
        formData.append('fecha_registro',$('#fecha_registro').val());
        formData.append('file_documento',file_documento);
        $.ajax({
            url:e.target.action,
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
                    $('#formDocumentoPersonals')[0].reset();
                    $("#modalCrudDocumentoPersonal").modal("hide");
                    $('#table_documento_personals').DataTable().ajax.reload(null, false)
                    toastr.success(resp.msg,'Nuevo Registro',{timeout:3000});
                }
            }
        });
    });


    $('#formDocumentoPersonals').validate({
        lang: 'es',
        rules: {
            detalle_documento: {
                required: true,
            },
            instituto: {
                required: true,
            },
            tipo_documento: {
                required: true,
            },
            file_documento: {
                required: true,
            },
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

    $("input").on("blur", function () {
        $input=$(this);
        setTimeout(function () {
            $input.val($input.val().toUpperCase());
        },0);
    });

})
