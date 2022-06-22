$(()=>{

    table_cursos.on('draw.dt', function () {
        table_cursos.column(0, {
            page: 'all'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    });

    $("#btnRegistrarCurso").click(function(){
        $("#formCursos").trigger("reset");
        $(".modal-header").css("background-color", "#093C3C");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("REGISTRAR CURSO");
        $("#modalCrudCurso").modal("show");
    });

    $('.closeModalPdf').on('click', function(){
        $('#modalCrudCurso').modal("hide");
    });
    // Mostrar Documento Curso
    var id;
    $('body').on('click', '#ViewModalCurso', function(e) {
        e.preventDefault();
        $(".modal-title").text("DOCUMENTO CURSO");
        id = $(this).data('id');
        console.log(id)
        html='<div class="col-12 justify-content-center row">'+
            '<iframe src="/curso/documento/'+id+'"'+
                'width="1200" height="420">'+
            '</iframe>'+
            '</div>';
        $('#ContenidoCurso').html(html);
        $('#modalCurso').modal("show");
    });

    $('#formCursos').submit(function(e){
        e.preventDefault();
        var _token = $('input[name=_token]').val();
        var file_curso = $("#file_curso")[0].files[0];
        const formData= new FormData();
        formData.append('_token',_token);
        formData.append('trabajador_id',$('#trabajador_id').val());
        formData.append('nombre_curso',$('#nombre_curso').val());
        formData.append('institucion',$('#instituto').val());
        formData.append('horas_academicas',$('#horas_academicas').val());
        formData.append('fecha_curso',$('#fecha_curso').val());
        formData.append('file_curso',file_curso);
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
                    $('#formCursos')[0].reset();
                    $("#modalCrudCurso").modal("hide");
                    $('#table_cursos').DataTable().ajax.reload(null, false)
                    toastr.success(resp.msg,'Nuevo Registro',{timeout:3000});
                }
            }
        });
    });


    $('#formCursos').validate({
        lang: 'es',
        rules: {
            nombre_curso: {
                required: true,
            },
            instituto: {
                required: true,
            },
            horas_academicas: {
                required: true,
            },
            fecha_curso: {
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
        },0);
    });

})
