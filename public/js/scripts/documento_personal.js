$(()=>{
    // Mostrar Documento Documento personal
    var id;
    $('body').on('click', '#ViewModalDocumentoPersonal', function(e) {
        e.preventDefault();
        $(".modal-title").text("DOCUMENTO PERSONAL");
        $(".modal-header").css("background-color", "#ffff");
        id = $(this).data('id');
        console.log(id)
        html='<div class="col-12 justify-content-center row">'+
            '<iframe src="/documento_personal/documento/'+id+'"'+
                'width="1200" height="420">'+
            '</iframe>'+
            '</div>';
        $('#ContenidoDocumentoPersonal').html(html);
        $('#modalDocumentoPersonal').modal("show");
    });

})
