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

    $('#formNuevoEventual').validate({
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
            fecha_conclusion: {
                required: true,
            },
        },
    });

    $('#formNuevoEventual').submit(function (e) {
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
        formData.append('fecha_conclusion',$('#fecha_conclusion').val());
        formData.append('observacion',$('#observacion').val());
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
                    $('#formNuevoEventual')[0].reset();
                    $("#modalEventuales").modal("hide");
                    $('#table_eventuales').DataTable().ajax.reload(null, false)
                    toastr.success(resp.msg, 'Nuevo Eventual registrado', { timeout: 3000 });
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
    // Formulario para Editar Eventual
    $('#formEditarEventual').submit(function (e) {
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
            'observacion': $('#observacion').val(),
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id_eventual = $('#id_eventual').val();
        $.ajax({
            url:'/eventual/actualizar/'+ id_eventual,
            type: "PUT",
            data: data,
            dataType: 'json',
            success: function (resp) {
                if (resp.code == 0) {
                    toastr.error(resp.error, 'ERROR', { timeout: 1000 })
                }
                else {
                    $("#modalEventuales").modal("hide");
                    $('#table_eventuales').DataTable().ajax.reload(null, false)
                    toastr.success(resp.msg, 'Eventual Modificado Exitosamente.', { timeout: 3000 });
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

    // Formulario para Cambiar Eventual
    $('#formCambiarEventual').validate({
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
            fecha_conclusion_antiguo: {
                required: true,
            },
        },
    });
    $('#formCambiarEventual').submit(function (e) {
        e.preventDefault();
        // var _token = $('input[name=_token]').val();
        var data = {
            // 'trabajador_id': $('#trabajador_id').val(),
            'nomina_cargo_id': $('#nomina_cargo_id').val(),
            'fecha_ingreso': $('#fecha_ingreso').val(),
            'fecha_conclusion_antiguo': $('#fecha_conclusion_antiguo').val(),
            'fecha_conclusion': $('#fecha_conclusion').val(),
            'observacion': $('#observacion').val(),
            'estado': $('#estado').val(),
        }
        console.log(data);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id_eventual = $('#id_eventual').val();
        $.ajax({
            url:'/eventual/cambiar/'+id_eventual,
            type: "PUT",
            data: data,
            dataType: 'json',
            success: function (resp) {
                if(resp.success == true){
                    $("#modalEventuales").modal("hide");
                    $('#table_eventuales').DataTable().ajax.reload(null, false)
                    console.log(resp.data)
                    toastr.success(resp.message, 'Se cambió Eventual Exitosamente.', { timeout: 3000 });
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

    $('#cancelEventual').submit(function (e) {
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
        var id_eventual = $('#id_eventual').val();
        $.ajax({
            url:'/eventual/dar-baja/'+id_eventual,
            type: "PUT",
            data: data,
            dataType: 'json',
            success: function (resp) {
                if(resp.success == true){
                    $("#modalEventuales").modal("hide");
                    $('#table_eventuales').DataTable().ajax.reload(null, false)
                    console.log(resp.data)
                    toastr.success(resp.message, 'Se dió de baja el Eventual Exitosamente.', { timeout: 3000 });
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
