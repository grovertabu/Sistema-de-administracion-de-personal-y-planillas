@extends('adminlte::page')

@section('title', 'Nuevo Cargo')

@section('content')
    <div class="justify-content-center row">
        <div class="col-md-7">
            <div class="card card-info ">
                <div class="card-header">
                    <h3 class="card-title">Nuevo Cargo</h3>
                </div>
                <form action="{{ route('nomina_cargo.store') }}" method="POST" class="create" role="form"
                    id="form_nomina_cargo">
                    @csrf
                    <div class="card-body row">
                        <x-dg-select2 id="tipo_contrato_id" name="tipo_contrato_id" label="Tipo de Contrato"
                            topclass="col-md-12 required tipo_contrato_id">
                            <option value="">--SELECCIONE--</option>
                            @foreach ($tipo_contratos as $t_contrato)
                                <option value="{{ $t_contrato->id }}" {{old('tipo_contrato_id')==$t_contrato->id ? 'selected':''}}>
                                    {{ $t_contrato->nombre }}</option>
                            @endforeach
                        </x-dg-select2>

                        <div id="content_item"  class="form-group col-md-6 required d-none">
                            <label for="item">ITEM</label>
                            <input type="number" class="form-control" name="item" id="item" min="0" value="{{ old('item') }}">
                            <span class="text-danger d-none error-text item_error"></span>
                        </div>

                        <x-input-icon-btn type="text" id="unidad_organizacional_nombre" idbutton="buscar_unidad_o" label="Unidad Organizacional"
                            topclass="col-md-12 required" disabled="true" icon="fas fa-search" />
                        <input type="hidden" id="unidad_organizacional_id" name="unidad_organizacional_id">

                        <x-input-icon-btn type="text" id="cargo_nombre" idbutton="buscar_cargo" label="Cargo" topclass="col-md-12 required"
                            disabled="true" icon="fas fa-search" />
                        <input type="hidden" id="cargo_id" name="cargo_id">

                        <x-input-icon-btn type="text" id="escala_salarial_nivel" idbutton="buscar_escala_salarial" label="Escala Salarial" topclass="col-md-12 required"
                            disabled="true" icon="fas fa-search" />
                        <input type="hidden" id="escala_salarial_id" name="escala_salarial_id">
                        <input type="hidden" name="estado" id="estado" value="LIBRE">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-danger" id="cancelar_Cargo" href="{{ route('nomina_cargo.index') }}"
                                    role="tab"><i class="far fa-window-close"></i> Cancelar</a>
                            </div>
                            <x-dg-submit type="success" topclass="col-md-6" inputclass="float-right btnSubmit"
                                label="Guardar" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('nomina_cargo.modal.unidades-organizacionales')
    @include('nomina_cargo.modal.cargos')
    @include('nomina_cargo.modal.escalas-salariales')

@stop
@section('footer')
<strong>{{date("Y")}} ||  ELAPAS - SISTEMA DE RECURSOS HUMANOS </strong>
@stop

@section('js')
    <script>
        $(() => {
            $("#tipo_contrato_id").on("change", function() {
                var selectValor = $(this).val();
                if(selectValor == 1){
                    $("#item").attr("required", true);
                    $("#content_item").removeClass('d-none')
                    $(".tipo_contrato_id").removeClass('col-md-12')
                    $(".tipo_contrato_id").addClass('col-md-6')
                }
                else{
                    $("#item").attr("required", false);
                    $("#content_item").addClass('d-none')
                    $(".tipo_contrato_id").removeClass('col-md-6')
                    $(".tipo_contrato_id").addClass('col-md-12')
                }
            });
            // BUSCAR
            $("#buscar_unidad_o").click(function(){
                $("#modalUnidadOrg").modal("show");
            });
            $('.table_modal').on('click', '#btnSeleccionarUnidad', function () {
                var data = new Array();
                i=0;
                $(this).parents("tr").find("td").each(function(){
                data[i] =$(this).html();
                    i++;
                });
                console.log(data);
                $('#unidad_organizacional_id').val(data[0]);
                $('#unidad_organizacional_nombre').val(data[1]);
                $("#modalUnidadOrg").modal("hide");
            } );

            $("#buscar_cargo").click(function(){
                $("#modalCargos").modal("show");
            });
            $('.table_modal').on('click', '#btnSeleccionarCargo', function () {
                var data = new Array();
                i=0;
                $(this).parents("tr").find("td").each(function(){
                data[i] =$(this).html();
                    i++;
                });
                console.log(data);
                $('#cargo_id').val(data[0]);
                $('#cargo_nombre').val(data[1]);
                $("#modalCargos").modal("hide");
            } );
            $("#buscar_escala_salarial").click(function(){
                $("#modalEscalasSalariales").modal("show");
                $('.modal-lg').css("max-width","980px");
            });
            $('.table_modal').on('click', '#btnSeleccionarEscala', function () {
                var data = new Array();
                i=0;
                $(this).parents("tr").find("td").each(function(){
                data[i] =$(this).html();
                    i++;
                });
                console.log(data);
                $('#escala_salarial_id').val(data[0]);
                $('#escala_salarial_nivel').val("Nivel "+data[1] + " - Bs. " + data[3]);
                $("#modalEscalasSalariales").modal("hide");
            } );
            // validar si existe un item
            $("#item").on("keyup", function() {
                var data = {
                    'item': $('#item').val()
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url:'/nomina-cargo/exist-item',
                    method:'GET',
                    data:data,
                    dataType:'json',
                    success:function(res) {
                        if(res.success){
                            var html = '<b>'+res.message+'</b>';
                            $(".item_error").html(html)
                            $(".item_error").removeClass('d-none')
                            $('.btnSubmit').prop('disabled', true)
                        }
                        else{
                            $(".item_error").addClass('d-none')
                            $('.btnSubmit').prop('disabled', false)
                        }
                    }
                });
            });
        })
    </script>
@stop
