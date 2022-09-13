$(()=>{

    table_demeritos.on('draw.dt', function () {
        table_demeritos.column(0, {
            page: 'all'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    });

    $("#btnRegistrarDemerito").click(function(){
        $("#formDemerito").trigger("reset");
        $(".modal-header").css("background-color", "#093C3C");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("REGISTRAR DEMÉRITO");
        $("#modalCrudDemerito").modal("show");
    });

    $('.closeModalPdf').on('click', function(){
        $('#modalCrudMerito').modal("hide");
    });
    // Mostrar Documento Merito
    var id;
    $('body').on('click', '#ViewModalDemerito', function(e) {
        e.preventDefault();
        $(".modal-title").text("DOCUMENTO DEMÉRITO");
        id = $(this).data('id');
        console.log(id)
        html='<div class="col-12 justify-content-center row">'+
            '<iframe src="/demerito/documento/'+id+'"'+
                'width="1200" height="420">'+
            '</iframe>'+
            '</div>';
        $('#ContenidoDemerito').html(html);
        $('#modalDemerito').modal("show");
    });

    $('#formDemeritos').submit(function(e){
        e.preventDefault();
        var _token = $('input[name=_token]').val();
        var file_demerito = $("#file_demerito")[0].files[0];
        const formData= new FormData();
        formData.append('_token',_token);
        formData.append('trabajador_id',$('#trabajador_id').val());
        formData.append('detalle_demerito',$('#detalle_demerito').val());
        formData.append('fecha_demerito',$('#fecha_demerito').val());
        formData.append('file_demerito',file_demerito);
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
                    $('#formDemeritos')[0].reset();
                    $("#modalCrudDemerito").modal("hide");
                    $('#table_demeritos').DataTable().ajax.reload(null, false)
                    toastr.success(resp.msg,'Nuevo demérito registrado',{timeout:3000});
                }
            }
        });
    });


    $('#formDemeritos').validate({
        lang: 'es',
        rules: {
            detalle_demerito: {
                required: true,
            },
            fecha_demerito: {
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
