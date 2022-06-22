$(()=>{
    //  tabla estructuras-organizacionales
    table_escala_salarial = $('#table_escala_salarial').DataTable({
        deferRender: true,
        lengthMenu: [[8, 10, 25, 40, -1], [8, 10, 25, 40, "All"]],
        autoWidth: false,
        responsive: true,
        language: {
            url:"../../vendor/funciones/datatable_spanish.json"
        }
    });

    $(document).on('click','#btnBorrarEscala', function(){
        var id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        Swal.fire({
            text: '¿Está seguro de eliminar la Escala Salarial ?',
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
                    url:'escala-salarial/'+id,
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
