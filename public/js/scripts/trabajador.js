
$(()=>{

    $.validator.setDefaults({
        errorElement: 'span',
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.addClass('invalid-feedback');
                error.insertAfter(element.parent());
            }
            else if (element.hasClass('select2') && element.next('.select2-container').length) {
                error.addClass('invalid-feedback');
                error.insertAfter(element.next('.select2-container'));
            }
            else{
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).addClass('is-valid');
        }
    });
    $('#fecha_nacimiento').datetimepicker({
        format: 'DD-MM-YYYY',
        locale: moment.locale('es'),
        buttons: {
            showToday: true,
            showClear: true,
            showClose: true
        },
        icons: {
            today: 'fa fa-calendar',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
        }
    });
    $('#fecha_nacimiento').inputmask('dd-mm-yyyy', {
        placeholder: "_",
        inputFormat: 'dd-mm-aaaa'
    })
    // validacion para el formulario al registrar un nuevo trabajador
    $('#form_trabajador').validate({
        lang: 'es',
        rules: {
            ci_trabajador: {
                required: true,
                number: true,
                maxlength:10
            },
            nombre_trabajador: {
                required: true,
            },
            apellido_paterno: {
                required: true,
            },
            expedido: {
                required: true,
            },
            nro_asegurado: {
                required: true,
            },
            direccion: {
                required: true,
            },
            sexo: {
                required: true
            },
            nacionalidad: {
                required: true,
            },
            fecha_nacimiento: {
                required: true,
            },
            antiguedad_anios: {
                required: true,
            },
            antiguedad_meses: {
                required: true,
            },
            antiguedad_dias: {
                required: true,
            },
        },
    });
    // REGISTRAR UN TRABAJADOR
    $('#form_trabajador').submit(function(e){
        e.preventDefault();
        var _token = $('input[name=_token]').val();
        var foto = $("#foto")[0].files[0];
        const formData= new FormData();
        formData.append('_token',_token);
        formData.append('ci',$('#ci_trabajador').val());
        formData.append('complemento',$('#complemento').val());
        formData.append('nombre_trabajador',$('#nombre_trabajador').val());
        formData.append('apellido_paterno',$('#apellido_paterno').val());
        formData.append('apellido_materno',$('#apellido_materno').val());
        formData.append('expedido',$('#expedido').val());
        formData.append('nro_asegurado',$('#nro_asegurado').val());
        formData.append('direccion',$('#direccion').val());
        formData.append('tipo_sangre',$('#tipo_sangre').val());
        formData.append('telefono',$('#telefono').val());
        formData.append('celular',$('#celular').val());
        formData.append('estado_civil',$('#estado_civil').val());
        formData.append('sexo',$('#sexo').val());
        formData.append('nacionalidad',$('#nacionalidad').val());
        formData.append('fecha_nacimiento',$('#fecha_nacimiento').val());
        formData.append('antiguedad_anios',$('#antiguedad_anios').val());
        formData.append('antiguedad_meses',$('#antiguedad_meses').val());
        formData.append('antiguedad_dias',$('#antiguedad_dias').val());
        formData.append('foto',foto);
        $.ajax({
            url:"trabajador/registrar",
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
                    $("#modalTrabajador").modal("hide");
                    $('#table_trabajador').DataTable().ajax.reload(null, false)
                    toastr.success('Registro ingresado con exito','Nuevo Registro',{timeout:3000});
                }
            },
            error:function(response, status, xhr) {
                Swal.fire({
                    text: response.responseJSON.message,
                    icon: 'warning',
                    confirmButtonText: 'Aceptar',
                }).then(() => {
                    location.reload();
                });
            }
        });
    });

    $('#form_trabajador_editar').validate({
        lang: 'es',
        rules: {
            ci: {
                required: true,
                number: true,
                maxlength:10
            },
            nombre_trabajador: {
                required: true,
            },
            apellido_paterno: {
                required: true,
            },
            apellido_materno: {
                required: true,
            },
            expedido: {
                required: true,
            },
            nro_asegurado: {
                required: true,
            },
            direccion: {
                required: true,
            },
            sexo: {
                required: true
            },
            nacionalidad: {
                required: true,
            },
            fecha_nacimiento: {
                required: true,
            },
            antiguedad_anios: {
                required: true,
            },
            antiguedad_meses: {
                required: true,
            },
            antiguedad_dias: {
                required: true,
            },
        },
    });
    // Modificar datos de  UN TRABAJADOR
    $('#form_trabajador_editar').submit(function(e){
        e.preventDefault();
        var formData= new FormData($("#form_trabajador_editar")[0]);
        formData.append('_method', 'PUT');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:e.target.action,
            type: "POST",
            data: formData,
            contentType: false,
	        processData: false,
            success: function (resp) {
                if (resp.code == 0) {
                    toastr.error(resp.error,'ERROR',{timeout:1000})
                }
                else{
                    $("#modalTrabajador").modal("hide");
                    $('#table_trabajador').DataTable().ajax.reload(null, false)
                    toastr.success('Trabajador modificiado','Nuevo Registro',{timeout:3000});
                }
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                $('#edit-trabajador-errors').html('');
                $.each(errors.messages, function(key, value) {
                    $('#edit-trabajador-errors').append('<li>' + value + '</li>');
                });
                $("#edit-trabajador-errors").removeClass('d-none');
            }
        });
    });


    // funcion para volver mayusculas todos los inputs
    $("input").on("blur", function () {
        $input=$(this);
        setTimeout(function () {
            $input.val($input.val().toUpperCase());
        },0);
    });
    // funcion para visualizar la foto antes de subirlo
    $('#foto').change(function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            $('#foto_perfil').attr('src', reader.result);
        };
        reader.readAsDataURL(event.target.files[0]);
        console.log(event.target.files);
    });
});
