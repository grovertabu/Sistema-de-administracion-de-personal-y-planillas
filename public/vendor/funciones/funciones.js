$(document).ready(function() {
    $('.select2').select2({ theme: 'bootstrap4' });
    $('.dataT').DataTable({
        deferRender: true,
        lengthMenu: [[5, 10, 25, 40, -1], [5, 10, 25, 40, "All"]],
        autoWidth: true,
        language: {
            url:"../../vendor/funciones/datatable_spanish.json"
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
            url:"../../vendor/funciones/datatable_spanish.json"
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
            url:"../../vendor/funciones/datatable_spanish.json"
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
});


function exportarDocumento(urlExportRoute,movementType, exportType) {
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



