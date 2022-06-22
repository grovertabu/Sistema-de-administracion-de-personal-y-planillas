$(() => {
    $.validator.setDefaults({
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
        }
      });

    $('#formNuevoItem').validate({
        lang: 'es',
        rules: {
            trabajador_nombre: {
                required: true,
            },
            trabajador_id: {
                required: true,
            },
            nomina_cargo_nombre: {
                required: true,
            },
            nomina_cargo_id: {
                required: true,
            },
            fecha_ingreso: {
                required: true,
            },
        },
    });

    $('#formNuevoItem').submit(function (e) {
        e.preventDefault();
        var _token = $('input[name=_token]').val();
        const formData= new FormData();
        formData.append('_token',_token);
        formData.append('trabajador_id',$('#trabajador_id').val());
        formData.append('nomina_cargo_id',$('#nomina_cargo_id').val());
        formData.append('aporte_afp',$('#aporte_afp').val());
        formData.append('sindicato',$('#sindicato').val());
        formData.append('socio_fe',$('#socio_fe').val());
        formData.append('fecha_ingreso',$('#fecha_ingreso').val());
        formData.append('estado',$('#estado').val());
        $.ajax({
            url: e.target.action,
            type: "POST",
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            success: function (resp) {
                if (resp.code == 0) {
                    toastr.error(resp.error, 'ERROR', { timeout: 1000 })
                }
                else {
                    Pace.restart();
                    $('#formNuevoItem')[0].reset();
                    $("#modalItems").modal("hide");
                    $('#table_items').DataTable().ajax.reload(null, false)
                    toastr.success(resp.msg, 'Nuevo Item registrado', { timeout: 3000 });
                }
            }
        });
    });
    // Formulario para Editar ITEM
    $('#formEditarItem').submit(function (e) {
        e.preventDefault();
        // var _token = $('input[name=_token]').val();
        var data = {
            // 'trabajador_id': $('#trabajador_id').val(),
            'nomina_cargo_id': $('#nomina_cargo_id').val(),
            'aporte_afp': $('#aporte_afp').val(),
            'sindicato': $('#sindicato').val(),
            'socio_fe': $('#socio_fe').val(),
            'fecha_ingreso': $('#fecha_ingreso').val(),
            'fecha_conclusion': $('#fecha_conclusion').val(),
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id_item = $('#id_item').val();
        console.log(data)
        $.ajax({
            url:'/item/actualizar/'+ id_item,
            type: "PUT",
            data: data,
            dataType: 'json',
            success: function (resp) {
                if (resp.code == 0) {
                    toastr.error(resp.error, 'ERROR', { timeout: 1000 })
                }
                else {
                    $("#modalItems").modal("hide");
                    $('#table_items').DataTable().ajax.reload(null, false)
                    toastr.success(resp.msg, 'Item Modificado Exitosamente.', { timeout: 3000 });
                }
            }
        });

    });

    // Formulario para Cambiar ITEM
    $('#formCambiarItem').validate({
        lang: 'es',
        rules: {
            nomina_cargo_nombre: {
                required: true,
            },
            fecha_ingreso: {
                required: true,
            },
            fecha_conclusion: {
                required: true,
            },
        },
    });
    $('#formCambiarItem').submit(function (e) {
        e.preventDefault();
        // var _token = $('input[name=_token]').val();
        var data = {
            // 'trabajador_id': $('#trabajador_id').val(),
            'nomina_cargo_id': $('#nomina_cargo_id').val(),
            'aporte_afp': $('#aporte_afp').val(),
            'sindicato': $('#sindicato').val(),
            'socio_fe': $('#socio_fe').val(),
            'fecha_ingreso': $('#fecha_ingreso').val(),
            'fecha_conclusion': $('#fecha_conclusion').val(),
            'estado': $('#estado').val(),
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id_item = $('#id_item').val();
        $.ajax({
            url:'/item/cambiar/'+id_item,
            type: "PUT",
            data: data,
            dataType: 'json',
            success: function (resp) {
                if(resp.success == true){
                    $("#modalItems").modal("hide");
                    $('#table_items').DataTable().ajax.reload(null, false)
                    console.log(resp.data)
                    toastr.success(resp.message, 'Se cambió Item Exitosamente.', { timeout: 3000 });
                }
                else{
                    toastr.error('error', resp.message, { timeout: 3000 });
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

    $('#cancelItem').submit(function (e) {
        e.preventDefault();
        // var _token = $('input[name=_token]').val();
        var data = {
            'fecha_conclusion': $('#fecha_conclusion').val(),
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id_item = $('#id_item').val();
        $.ajax({
            url:'/item/dar-baja/'+id_item,
            type: "PUT",
            data: data,
            dataType: 'json',
            success: function (resp) {
                if(resp.success == true){
                    $("#modalItems").modal("hide");
                    $('#table_items').DataTable().ajax.reload(null, false)
                    console.log(resp.data)
                    toastr.success(resp.message, 'Se dió de baja el Item Exitosamente.', { timeout: 3000 });
                }
                else{
                    toastr.error('error', resp.message, { timeout: 3000 });
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


});
