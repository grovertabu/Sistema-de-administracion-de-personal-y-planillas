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
        }
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
