$(()=>{
    table_nomina_cargos = $('#table_nomina_cargos').DataTable({
        ajax: {
            url: "nomina-cargos",
        },
        columns : [
            {data: null,},
            {data: 'item'},
            {data: 'cargo'},
            {data: 'unidad_organizacional'},
            {data: 'escala_salarial_nivel'},
            {data: 'escala_salarial_salario_mensual'},
            {data: 'tipo_contrato'},
            {render:
                function ( data, type, row ) {
                    if (row['estado']=='OCUPADO') {
                        estado_t="<span class='badge badge-success' >OCUPADO</span>"
                        return  estado_t;
                    }else{
                        estado_t="<span class='badge badge-danger' >LIBRE</span>"
                        return  estado_t;
                    }
                }
            },
            {data: 'action',orderable:false},
        ],
        deferRender: true,
        lengthMenu: [[10, 10, 25, 50, -1], [10, 10, 25, 50, "All"]],
        pagingType: "full_numbers",
        autoWidth: true,
        scrollY: "50vh",
        scrollX: true,
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
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
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
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            }
        ],
    });
    table_nomina_cargos.on('draw.dt', function () {
        table_nomina_cargos.column(0, {
            page: 'all'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    });
    // Borrar un cargo
    $(document).on('click','#deleteNominaCargo', function(){
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
                    url:'nomina-cargos/'+id,
                    method: 'DELETE',
                    success: function(result) {
                        if(result.success){
                            $('#table_nomina_cargos').DataTable().ajax.reload(null, false);
                            toastr.success(result.message);
                        }else{
                            toastr.error(result.message);
                        }
                    }
                });
              }
        });
    });
});
