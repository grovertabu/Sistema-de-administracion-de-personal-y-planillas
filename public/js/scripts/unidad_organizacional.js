$(()=>{
    //  tabla estructuras-organizacionales
    table_unidad_organizacional = $('#table_unidad_organizacional').DataTable({
        autoWidth: false,
        responsive: true,
        scrollY: '50vh',
        scrollX: false,
        deferRender: true,
        lengthMenu: [[8, 25, 50, -1], [8, 25, 50, "All"]],
        pagingType: "full_numbers",
        language: {
            url:"../../vendor/funciones/datatable_spanish.json"
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
                },
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

    $(document).on('click','#btnBorrarUnidad', function(){
        var id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        Swal.fire({
            text: '¿Está seguro de eliminar la Unidad Organizacional ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'green',
            cancelButtonColor: 'red',
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'Cancelar',
             width:300,
             allowOutsideClick:false,
             reverseButtons: true
        }).then(function(result){
              if(result.value){
                $.ajax({
                    url:'unidad-organizacional/'+id,
                    method: 'DELETE',
                    success: function(resp) {
                        if(resp.success){
                            Swal.fire({
                                text: resp.message,
                                icon: 'success',
                                confirmButtonColor: 'green',
                                confirmButtonText: 'Ok',
                                 width:400,
                                 allowOutsideClick:false,
                                 reverseButtons: true
                            }).then(function(result){
                                  if(result.value){
                                    window.location.reload()
                                  }
                            });
                        }else{
                            toastr.error(resp.message);
                        }
                    },
                    error:function(response, status, xhr) {
                        console.log(response)
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
