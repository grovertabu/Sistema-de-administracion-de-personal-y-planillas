$(()=>{
    $("input").on("keypress", function () {
        $input=$(this);
        setTimeout(function () {
            $input.val($input.val().toUpperCase());
        },30);
    });
    $("#btnRegistrarFormacion").click(function(){
        $("#form_academica").trigger("reset");
        $(".modal-header").css("background-color", "#093C3C");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("REGISTRAR FORMACIÓN ACADEMICA");
        $("#modalCrudFormacion").modal("show");
    });
    $('.closeModalPdf').on('click', function(){
        $('#modalCrudFormacion').modal("hide");
    });
    var id;
    $('body').on('click', '#ViewModalFormacion', function(e) {
        e.preventDefault();
        $('.modal_formacion_academica').modal("show");
        // $(".modal-title").text("FORMACIÓN ACADEMICA");
        // $(".modal-header").css("background-color", "#ffff");
        id = $(this).data('id');
        html='<div class="col-12 justify-content-center row">'+
            '<iframe src="/formacion_academica/documento/'+id+'"'+
                'width="1200" height="420">'+
            '</iframe>'+
            '</div>';
        $('#ContenidoFormacionAcademica').html(html);
    });
    // REGISTRAR UN TRABAJADOR
    $('#form_academica').submit(function(e){
        e.preventDefault();
        var _token = $('input[name=_token]').val();
        var file_formacion = $("#file_formacion")[0].files[0];
        const formData= new FormData();
        formData.append('_token',_token);
        formData.append('trabajador_id',$('#trabajador_id').val());
        formData.append('nivel_formacion',$('#nivel_formacion').val());
        formData.append('institucion',$('#institucion').val());
        formData.append('titulo_formacion',$('#titulo_formacion').val());
        formData.append('lugar_formacion',$('#lugar_formacion').val());
        formData.append('fecha_emision',$('#fecha_emision').val());
        formData.append('file_formacion',file_formacion);
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
                    $('#form_academica')[0].reset();
                    $("#modalCrudFormacion").modal("hide");
                    $('#table_formacion').DataTable().ajax.reload(null, false)
                    toastr.success(resp.msg,'Nuevo Registro',{timeout:3000});
                }
            }
        });
    });

    $('#form_academica').validate({
        lang: 'es',
        rules: {
            nivel_formacion: {
                required: true,

            },
            institucion: {
                required: true,
            },
            titulo_formacion: {
                required: true,
            },
            lugar_formacion: {
                required: true,
            },
            fecha_emision: {
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
            // else if (element.hasClass('select2') && element.next('.select2-container').length) {
            //     error.addClass('invalid-feedback');
            //     error.insertAfter(element.next('.select2-container'));
            // }
            else{
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            }
        },
        // highlight: function (element, errorClass, validClass) {
        //     $(element).addClass('is-invalid');
        // },
        // unhighlight: function (element, errorClass, validClass) {
        //     $(element).removeClass('is-invalid');
        //     $(element).addClass('is-valid');
        // }
    });
});



