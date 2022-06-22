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

    $('#fecha_ingreso').datetimepicker({
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
    $('#fecha_ingreso').inputmask('dd-mm-yyyy', {
        placeholder: 'dd-mm-aaaa',
        inputFormat: 'dd-mm-aaaa'
    })
    $('#fecha_conclusion').datetimepicker({
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
    $('#fecha_conclusion').inputmask('dd-mm-yyyy', {
        placeholder: 'dd-mm-aaaa',
        inputFormat: 'dd-mm-aaaa'
    });
    $('#fecha_conclusion_antiguo').datetimepicker({
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
    $('#fecha_conclusion_antiguo').inputmask('dd-mm-yyyy', {
        placeholder: 'dd-mm-aaaa',
        inputFormat: 'dd-mm-aaaa'
    });
    $('#formNuevoConsultor').validate({
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

    $('#formNuevoConsultor').submit(function (e) {
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
                    $('#formNuevoConsultor')[0].reset();
                    $("#modalConsultores").modal("hide");
                    $('#table_consultores').DataTable().ajax.reload(null, false)
                    toastr.success(resp.msg, 'Nuevo Consultor registrado', { timeout: 3000 });
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
    // Formulario para Editar CONSULTOR
    $('#formEditarConsultor').submit(function (e) {
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
        var id_consultor = $('#id_consultor').val();
        $.ajax({
            url:'/consultor/actualizar/'+ id_consultor,
            type: "PUT",
            data: data,
            dataType: 'json',
            success: function (resp) {
                if (resp.code == 0) {
                    toastr.error(resp.error, 'ERROR', { timeout: 1000 })
                }
                else {
                    $("#modalConsultores").modal("hide");
                    $('#table_consultores').DataTable().ajax.reload(null, false)
                    toastr.success(resp.msg, 'Consultor Modificado Exitosamente.', { timeout: 3000 });
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

    // Formulario para Cambiar Consultor
    $('#formCambiarConsultor').validate({
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
    $('#formCambiarConsultor').submit(function (e) {
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
        var id_consultor = $('#id_consultor').val();
        $.ajax({
            url:'/consultor/cambiar/'+id_consultor,
            type: "PUT",
            data: data,
            dataType: 'json',
            success: function (resp) {
                if(resp.success == true){
                    $("#modalConsultores").modal("hide");
                    $('#table_consultores').DataTable().ajax.reload(null, false)
                    console.log(resp.data)
                    toastr.success(resp.message, 'Se cambió Consultor Exitosamente.', { timeout: 3000 });
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

    $('#cancelConsultor').submit(function (e) {
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
        var id_consultor = $('#id_consultor').val();
        $.ajax({
            url:'/consultor/dar-baja/'+id_consultor,
            type: "PUT",
            data: data,
            dataType: 'json',
            success: function (resp) {
                if(resp.success == true){
                    $("#modalConsultores").modal("hide");
                    $('#table_consultores').DataTable().ajax.reload(null, false)
                    console.log(resp.data)
                    toastr.success(resp.message, 'Se dió de baja el Consultor Exitosamente.', { timeout: 3000 });
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
