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
        }
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
