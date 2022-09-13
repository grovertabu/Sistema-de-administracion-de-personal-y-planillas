@extends('adminlte::page')

@section('title', 'Resumen Planilla')

@section('content_header')
    <h4>RESUMEN {{ $nombre_planilla->nombre_planilla }}
        {{$nombre_planilla->gestion }}
        <button id="view_pdf_planilla" class="btn btn-default float-right">Imprimir Planilla <i
            class="fa fa-file-pdf"></i></button>
    </h4>

@stop
@section('content')
    <div class="card card-info card-outline">
        <div class="card-body sinpadding">

            <div class="table table-bordered table-hover dataTable table-responsive">
                <table class="table table-bordered table-striped datatable data_table"
                    id="table_resumen_planilla">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>HABER <br> BASICO</th>
                            <th>BONO <br> ANTIGUEDAD</th>
                            <th>HORAS <br> EXTRA</th>
                            <th>SUPLENCIA</th>
                            <th>TOTAL <br> GANADO</th>
                            <th>SINDICATO</th>
                            <th>CATEGORIA <br> INDIVIDUAL</th>
                            <th>PRIMA RIESGO <br> COMUN</th>
                            <th>COMISION AL ENTE <br>  ADMINISTRADOR</th>
                            <th>TOTAL APORTE <br> SOLIDARIO</th>
                            <th>RC-IVA 13%</th>
                            <th>OTROS <br> DESCUENTOS</th>
                            <th>FONDO <br> SOCIAL</th>
                            <th>FONDO DE <br> EMPLEADOS</th>
                            <th>ENTIDADES <br> FINANCIERAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($total_secciones as $total_seccion)
                            <tr>
                                <td>{{ $total_seccion->seccion }}</td>
                                <td align='right'>{{ $total_seccion->sum_haber_basico_s }}</td>
                                <td align='right'>{{ $total_seccion->sum_bono_antiguedad_s }}</td>
                                <td align='right'>{{ $total_seccion->sum_extras_s }}</td>
                                <td align='right'>{{ $total_seccion->sum_suplencias_s }}</td>
                                <td align='right'>{{ $total_seccion->sum_total_ganado_s }}</td>
                                <td align='right'>{{ $total_seccion->sum_sindicato_s }}</td>
                                <td align='right'>{{ $total_seccion->sum_descuentos_afp_s }}</td>
                                <td align='right'>{{ $total_seccion->sum_prima_riesgo_comun_s }}</td>
                                <td align='right'>{{ $total_seccion->sum_comision_ente_s }}</td>
                                <td align='right'>{{ $total_seccion->sum_total_aporte_solidario_s }}</td>
                                <td align='right'>{{ $total_seccion->sum_descuentos_rciva_s }}</td>
                                <td align='right'>{{ $total_seccion->sum_descuento_s }}</td>
                                <td align='right'>{{ $total_seccion->sum_fondo_social_s }}</td>
                                <td align='right'>{{ $total_seccion->sum_fondo_empleados_s }}</td>
                                <td align='right'>{{ $total_seccion->sum_entidades_financieras_s }}</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td>{{ $total_general[0]->seccion }}</td>
                            <td align='right'>{{ $total_general[0]->sum_haber_basico }}</td>
                            <td align='right'>{{ $total_general[0]->sum_bono_antiguedad }}</td>
                            <td align='right'>{{ $total_general[0]->sum_extras }}</td>
                            <td align='right'>{{ $total_general[0]->sum_suplencias }}</td>
                            <td align='right'>{{ $total_general[0]->sum_total_ganado }}</td>
                            <td align='right'>{{ $total_general[0]->sum_sindicato }}</td>
                            <td align='right'>{{ $total_general[0]->sum_descuentos_afp }}</td>
                            <td align='right'>{{ $total_general[0]->sum_prima_riesgo_comun }}</td>
                            <td align='right'>{{ $total_general[0]->sum_comision_ente }}</td>
                            <td align='right'>{{ $total_general[0]->sum_total_aporte_solidario }}</td>
                            <td align='right'>{{ $total_general[0]->sum_descuentos_rciva }}</td>
                            <td align='right'>{{ $total_general[0]->sum_descuento }}</td>
                            <td align='right'>{{ $total_general[0]->sum_fondo_social }}</td>
                            <td align='right'>{{ $total_general[0]->sum_fondo_empleados }}</td>
                            <td align='right'>{{ $total_general[0]->sum_entidades_financieras }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('planillas.general.modal_resumen_pdf')
@stop
@section('footer')
    <strong>{{ date('Y') }} || ELAPAS - SISTEMA DE RECURSOS HUMANOS </strong>
@stop
@section('js')
    @if (session('create') == true)
        <script>
            toastr.success('Plnailla creada exitosamente', '', {
                timeout: 1000
            })
        </script>
    @endif
    <script>
        $(() => {
            table_resumen_planilla = $('#table_resumen_planilla').DataTable({
                autoWidth: false,
                responsive: true,
                scrollY: "50vh",
                scrollX: true,
                lengthMenu: [[15, 25, 50, -1], [15, 25, 50, "All"]],
                select: true,
                language: {
                    url: "../../vendor/funciones/datatable_spanish.json"
                },
                dom: "<'row'<'col-sm-6'l><'col-sm-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            });

            $('body').on('click', '#view_pdf_planilla', function(e) {
                e.preventDefault();
                $('.modal_resumen').modal("show");
                // Iframe para incrustrar la planilla
                html = '<div class="col-12 justify-content-center row">' +
                    '<iframe src="/planilla_general/resumen_pdf/{{$nombre_planilla->id}}"' +
                    'width="1900" height="430">' +
                    '</iframe>' +
                    '</div>';
                $('#contenido_planilla').html(html);
            });
            //

        });
    </script>
@stop
