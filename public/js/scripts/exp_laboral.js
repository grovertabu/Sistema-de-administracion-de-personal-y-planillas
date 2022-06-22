$(()=>{

    table_exp_laboral.on('draw.dt', function () {
        table_exp_laboral.column(0, {
            page: 'all'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    });

    $("#btnRegistrarExpLaboral").click(function(){
        $("#formExpLaboral").trigger("reset");
        $(".modal-header").css("background-color", "#093C3C");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("REGISTRAR Experiencia Laboral");
        $("#modalCrudExpLaboral").modal("show");
    });

    $('.closeModalPdf').on('click', function(){
        $('#modalCrudExpLaboral').modal("hide");
    });
    // Mostrar Documento Experiencia Laboral
    var id;
    $('body').on('click', '#ViewModalExpLaboral', function(e) {
        e.preventDefault();
        $(".modal-title").text("Documento Experiencia Laboral");
        id = $(this).data('id');
        console.log(id)
        html='<div class="col-12 justify-content-center row">'+
            '<iframe src="/experiencia-laboral/documento/'+id+'"'+
                'width="1200" height="420">'+
            '</iframe>'+
            '</div>';
        $('#ContenidoExpLaboral').html(html);
        $('#modalExpLaboral').modal("show");
    });

    $('#formExpLaboral').submit(function(e){
        e.preventDefault();
        var _token = $('input[name=_token]').val();
        var file_exp_laboral = $("#file_exp_laboral")[0].files[0];
        const formData= new FormData();
        formData.append('_token',_token);
        formData.append('trabajador_id',$('#trabajador_id').val());
        formData.append('nombre_entidad',$('#nombre_entidad').val());
        formData.append('cargo_laboral',$('#cargo_laboral').val());
        formData.append('funcion_laboral',$('#funcion_laboral').val());
        formData.append('fecha_inicio',$('#fecha_inicio').val());
        formData.append('fecha_fin',$('#fecha_fin').val());
        formData.append('file_exp_laboral',file_exp_laboral);
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
                    $('#formExpLaboral')[0].reset();
                    $("#modalCrudExpLaboral").modal("hide");
                    $('#table_exp_laboral').DataTable().ajax.reload(null, false)
                    toastr.success(resp.msg,'Nuevo Registro insertado',{timeout:3000});
                }
            }
        });
    });


    $('#formExpLaboral').validate({
        lang: 'es',
        rules: {
            nombre_entidad: {
                required: true,
            },
            cargo_laboral: {
                required: true,
            },
            funcion_laboral: {
                required: true,
            },
            fecha_inicio: {
                required: true,
            },
            fecha_fin: {
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

    $("input").on("keypress", function () {
        $input=$(this);
        setTimeout(function () {
            $input.val($input.val().toUpperCase());
        },50);
    });
})
