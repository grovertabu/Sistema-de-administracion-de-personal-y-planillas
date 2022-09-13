$(()=>{
    //  tabla Cargos
    var id=1
    table_cargos = $('#table_cargos').DataTable({
        ajax: {
            url: "cargo",
        },
        columns : [
            {data: null,
                render: function (data, type, full, meta)
                {
                    return meta.row + 1;
                }
            },
            {data: 'nombre'},
            {data: 'estructura_organizacional'},
            {render:
                function ( data, type, row ) {
                    if (row['estado']=='ACTIVO') {
                        estado_t="<span class='badge badge-success' >ACTIVO</span>"
                        return  estado_t;
                    }else{
                        estado_t="<span class='badge badge-danger' >INACTIVO</span>"
                        return  estado_t;
                    }
                }
            },
            {data: 'action',orderable:false},
        ],
        deferRender: true,
        lengthMenu: [[8, 25, 50, -1], [8, 25, 50, "All"]],
        pagingType: "full_numbers",
        autoWidth: false,
        responsive: true,
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
    // table_cargos.on('draw.dt', function () {
    //     table_cargos.column(0, {
    //         page: 'all'
    //     }).nodes().each(function (cell, i) {
    //         cell.innerHTML = i + 1;
    //     });
    // });
    $(document).on('click','#deleteCargo', function(){
        var id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        Swal.fire({
            title: '¿Está seguro?',
            text: "¿Desea eliminar este cargo?",
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
                    url:'cargo/'+id,
                    method: 'DELETE',
                    success: function(result) {
                        if(result.success){
                            Swal.fire({
                                text: result.message,
                                icon: 'success',
                                confirmButtonColor: 'green',
                                confirmButtonText: 'Ok',
                                 width:300,
                                 allowOutsideClick:false,
                                 reverseButtons: true
                            }).then(function(result){
                                  if(result.value){
                                    window.location.reload()
                                  }
                            });
                        }else{
                            toastr.error(result.msg);
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
              }
        });
});
});
