$(document).ready(function () {
    $('.select2').select2({ theme: 'bootstrap4' });
    $('.dataT').DataTable({
        deferRender: true,
        lengthMenu: [[5, 10, 25, 40, -1], [5, 10, 25, 40, "All"]],
        autoWidth: true,
        language: {
            url: "../../vendor/funciones/datatable_spanish.json"
        }
    });

    $('.table-files').DataTable({
        deferRender: true,
        lengthMenu: [[3, 10, 25, 40, -1], [3, 10, 25, 40, "All"]],
        autoWidth: true,
        dom: "<'row'<'col-sm-12 col-md-8'f>>" +
            "<'row'<'col-sm-12't>>" +
            "<'row'<'col-sm-12 col-md-8'p>>",
        language: {
            url: "../../vendor/funciones/datatable_spanish.json"
        },

    });

    $('.table_modal').DataTable({
        deferRender: true,
        lengthMenu: [[5, 10, 25, 40, -1], [5, 10, 25, 40, "All"]],
        autoWidth: true,
        dom: "<'row'<'col-sm-12 col-md-8'f>>" +
            "<'row'<'col-sm-12't>>" +
            "<'row'<'col-sm-12 col-md-8'p>>",
        language: {
            url: "../../vendor/funciones/datatable_spanish.json"
        }
    });

    // ***********************Funciones para el menu************************
    // $("#menuPersonal").addClass("menu-open");
    // $(".menuPersonal ul").addClass("bg-submenu");
    // *********************************************************************

    Inputmask("datetime", {
        inputFormat: "dd-mm-yyyy",
        placeholder: "_",
    }).mask(".date_mask");

    $('.date_picker').datetimepicker({
        format: 'DD-MM-YYYY',
        locale: moment.locale('es'),
    });
    // -----------------------------------------------------------------------------------------------------------------------------------
    function ContarPuntos(input) {
        var cant = 0;
        if (input != null) {
            for (var i = 0; i < input.length; i++) {
                if (input[i] == '.')
                    cant += 1;
            }
        }
        return cant;
    }

    function CantidadDecimales(input) {
        var cant = 0;
        if (input.indexOf(".") != -1)
            cant = input.substr(input.indexOf(".") + 1).length;
        return cant;
    }
    function borrar_mensaje(campo) {
        $(campo).parent().find('br').remove();
        $(campo).parent().find('.error_float').remove();
    }

    $.fn.Enteros = function () {
        $(this).on('keypress', function (e) {

            if (e.which >= 48 && e.which <= 57 || e.which == 8 || e.which == 0 || e.which == 13) {
                borrar_mensaje(this);
                return true;
            }
            else {
                crear_mensaje(this, 'Solo se permite n&uacute;meros enteros');
                e.preventDefault();
            }
        });
        $(this).on('blur', function () {
            borrar_mensaje(this);
        });

    };

    function crear_mensaje(campo, txtmensaje) {
        var existe = $(campo).parent().find('.error_float').length;
    }

    $.fn.Decimales = function (NumeroDeDecimales) {

        jQuery(this).on('keypress', function (e) {
            var decimales = 0;
            var text = $(this).val();
            if (ContarPuntos(text) > 0) {
                decimales = CantidadDecimales(text);
            }

            if (e.which >= 48 && e.which <= 57 && decimales < NumeroDeDecimales || e.which == 8 || e.which == 0) {
                borrar_mensaje(this);
                return true;
            }
            else {
                if (text != "" && e.which == 46 && ContarPuntos(text) == 0) {
                    borrar_mensaje(this);
                    return true;
                }
                else {
                    crear_mensaje(this, 'Solo se permite n&uacute;meros, decimales');
                    e.preventDefault();
                }
            }
        });

    };
    $(".enteros").Enteros();
    $(".decimales").Decimales(2);
});


function exportarDocumento(urlExportRoute, movementType, exportType) {
    var url = urlExportRoute + '/' + movementType + '?';
    if ($('#date-from').val() != "" && $('#date-to').val() != "") {
        url += "&date_from=" + $('#date-from').val();
        url += "&date_to=" + $('#date-to').val();
        url += '&type=' + exportType;
        $('#modalReportItems iframe').attr("src", url);
        if (exportType == 'pdf') {
            $('#modalReportItems').modal('show');
        }
    } else {
        Swal.fire({
            title: 'Debe seleccionar un rango de fechas',
            type: 'warning',
            confirmButtonText: 'Aceptar',
        });
    }
}



