$(()=>{

    table_meritos.on('draw.dt', function () {
        table_meritos.column(0, {
            page: 'all'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    });

    $("#btnRegistrarMerito").click(function(){
        $("#formMerito").trigger("reset");
        $(".modal-header").css("background-color", "#093C3C");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("REGISTRAR MÉRITO");
        $("#modalCrudMerito").modal("show");
    });

    $('.closeModalPdf').on('click', function(){
        $('#modalCrudMerito').modal("hide");
    });
    // Mostrar Documento Merito
    var id;
    $('body').on('click', '#ViewModalMerito', function(e) {
        e.preventDefault();
        $(".modal-title").text("DOCUMENTO MÉRITO");
        id = $(this).data('id');
        console.log(id)
        html='<div class="col-12 justify-content-center row">'+
            '<iframe src="/merito/documento/'+id+'"'+
                'width="1200" height="420">'+
            '</iframe>'+
            '</div>';
        $('#ContenidoMerito').html(html);
        $('#modalMerito').modal("show");
    });

    $('#formMeritos').submit(function(e){
        e.preventDefault();
        var _token = $('input[name=_token]').val();
        var file_merito = $("#file_merito")[0].files[0];
        const formData= new FormData();
        formData.append('_token',_token);
        formData.append('trabajador_id',$('#trabajador_id').val());
        formData.append('detalle_merito',$('#detalle_merito').val());
        formData.append('fecha_merito',$('#fecha_merito').val());
        formData.append('file_merito',file_merito);
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
                    $('#formMeritos')[0].reset();
                    $("#modalCrudMerito").modal("hide");
                    $('#table_meritos').DataTable().ajax.reload(null, false)
                    toastr.success(resp.msg,'Nuevo mérito registrado',{timeout:3000});
                }
            }
        });
    });


    $('#formMeritos').validate({
        lang: 'es',
        rules: {
            detalle_merito: {
                required: true,
            },
            fecha_merito: {
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
