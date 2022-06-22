$(()=>{
    //  tabla estructuras-organizacionales
    table_estructura = $('#table_estructura').DataTable({
        autoWidth: false,
        responsive: true,
        scrollY: 300,
        scrollX: false,
        language: {
            url:"../../vendor/funciones/datatable_spanish.json"
        }
    });
    $(document).on('click','#deleteEstO', function(){
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
             width:300,
             allowOutsideClick:false,
             reverseButtons: true
        }).then(function(result){
              if(result.value){
                $.ajax({
                    url:'estructuras-organizacionales/'+id,
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
