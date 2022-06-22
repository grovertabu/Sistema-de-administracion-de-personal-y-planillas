$(()=>{
    //  tabla estructuras-organizacionales
    table_tipo_contrato = $('#table_tipo_contrato').DataTable({
        autoWidth: false,
        responsive: true,
        // scrollY: 300,
        // scrollX: false,
        language: {
            url:"../../vendor/funciones/datatable_spanish.json"
        }
    });
    $(document).on('click','#btnBorrarTipoContrato', function(){
        var id = $(this).data('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        Swal.fire({
            text: "¿Está seguro de eliminar el tipo de contrato?",
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
                    url:'tipo-contrato/'+id,
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
