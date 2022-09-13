$(() => {
    //  tabla estructuras-organizacionales
    table_estructura = $('#table_estructura').DataTable({
        autoWidth: false,
        responsive: true,
        scrollY: 300,
        scrollX: false,
        language: {
            url: "../../vendor/funciones/datatable_spanish.json"
        },
        dom: "<'row'<'col-sm-6'Bl><'col-sm-6'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                extend: 'print',
                footer: true,
                text: '<i class="fas fa-print" data-toggle="tooltip" title="Imprimir todas las paginas">Imprimir</i>',
                className: 'btn btn-sm btn-danger',
                exportOptions: {
                    modifier: {
                        order: 'applied',
                        page: 'all',
                        search: 'applied'
                    },
                    columns: [0, 1, 2, 3]
                },
                customize: function (win) {
                    $(win.document.body).find('table')
                        .addClass('compact').attr('border', '1')
                        .css({ "font-size": "inherit" })
                    $(win.document.body).find('h1').css('text-align', 'center');
                    $(win.document.body).find('table').addClass('printer')
                }
            },
            {
                extend: 'excelHtml5',
                footer: true,
                text: '<i class="fas fa-file-excel" data-toggle="tooltip" title="Hoja de Excel Todas las páginas">Exportar</i>',
                className: 'btn btn-sm btn-success',
                exportOptions: {
                    modifier: {
                        order: 'applied',
                        page: 'all',
                        search: 'applied'
                    },
                    columns: [0, 1, 2, 3]
                }
            }
        ],
    });
    $(document).on('click', '#deleteEstO', function () {
        var id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        Swal.fire({
            title: '¿Está seguro?',
            text: "¿Eliminar Estructura Organizacional?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: 'red',
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'Cancelar',
            width: 300,
            allowOutsideClick: false,
            reverseButtons: true
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: 'estructuras-organizacionales/' + id,
                    method: 'DELETE',
                    success: function (result) {
                        if (result.success) {
                            Swal.fire({
                                text: result.message,
                                icon: 'success',
                                confirmButtonColor: 'green',
                                confirmButtonText: 'Ok',
                                width: 300,
                                allowOutsideClick: false,
                                reverseButtons: true
                            }).then(function (result) {
                                if (result.value) {
                                    window.location.reload()
                                }
                            });
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                    error: function (response, status, xhr) {
                        Swal.fire({
                            text: response.responseJSON.message,
                            icon: 'warning',
                            confirmButtonText: 'Aceptar',
                        }).then(() => {
                            location.reload();
                        });
                    }
                });
            }
        });
    });
});
