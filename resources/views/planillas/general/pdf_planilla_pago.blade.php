<?php
use App\Utils\Pdf;

$pdf = new Pdf('PLANILLA DE PAGO', $nombre_planilla->nombre_planilla . ' ' . $nombre_planilla->gestion, 'RRHH', 'L', true, true, [216, 330]);

$pdf->SetFillColor(230, 230, 230);
$pdf->RoundedRect(10, 6, $pdf->getPageWidth() - 20, 30, 2.5, '1111');

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(230, 230, 230);

$pdf->AddPage();

$pdf->SetY(40);
$pdf->SetFont('dejavusans', 'B', 6);
$pdf->SetFillColor(230, 230, 230);
//$pdf->MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
$pdf->MultiCell(12, 22, 'ITEM', 1, 'C', 1, 0, '', '', 1, '', '', '', 22, 'M');
$pdf->MultiCell(35, 22, 'NOMBRE', 1, 'C', 1, '', '', '', 1, '', '', '', 22, 'M');
$pdf->MultiCell(30, 8, 'CARGO', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'CI', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'NUA', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'FECHA INGRESO', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'HABER MENSUAL', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(15, 8, 'DIAS', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'HABER BASICO', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(20, 8, 'BONO ANT.', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'HORAS EXTRA', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(16, 8, 'SUPLEN.', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'TOTAL GANADO', 1, 'C', 1, 0, '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(20, 22, 'LIQUIDO PAGABLE', 1, 'C', 1, 0, '', '', 1, '', '', '', 22, 'M');
$pdf->MultiCell(35, 22, 'FIRMA TRABAJADOR', 1, 'C', 1, 1, '', '', 1, '', '', '', 22, 'M');
$pdf->MultiCell(207, 6, 'DESCUENTOS', 1, 'C', 1, 1, 57, 48, 1, '', '', '', 6, 'M');
$pdf->MultiCell(30, 8, 'SIND.', 1, 'C', 1, '', 57, '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'CAT. IND.', 1, 'C', 1, 0, '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'PRIM. RIESGO C.', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'COM. AL ENTE', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'TOTAL APORTE SOL.', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(15, 8, 'RCIVA 13%', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'OTROS DESC.', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(20, 8, 'FONDO SOCIAL', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'FONDO EMPL.', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(16, 8, 'ENT. FINAN.', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'TOTAL.DESC', 1, 'C', 1, 1, '', '', 1, '', '', '', 8, 'M');
$i = 0;
if ($cargos->count() > 0) {
    $cantidad_secciones = $cargos->count();

    $sum_haber_basico = 0;
    $sum_bono_antiguedad = 0;
    $sum_extras = 0;
    $sum_suplencias = 0;
    $sum_sindicato = 0;
    $sum_total_ganado = 0;
    $sum_descuentos_afp = 0;
    $sum_prima_riesgo_comun = 0;
    $sum_comision_ente = 0;
    $sum_total_aporte_solidario = 0;
    $sum_descuentos_rciva = 0;
    $sum_descuento = 0;
    $sum_fondo_social = 0;
    $sum_fondo_empleados = 0;
    $sum_entidades_financieras = 0;
    $sum_total_descuentos = 0;
    $sum_liquido_pagable = 0;
    foreach ($cargos as $key => $cargo) {
        // $h_seccion = ceil($pdf->getStringHeight(35, trim($cargo->seccion), $reseth = true, $autopadding = true, $border = 1));
        $sum_haber_basico_s = 0;
        $sum_bono_antiguedad_s = 0;
        $sum_extras_s = 0;
        $sum_suplencias_s = 0;
        $sum_sindicato_s = 0;
        $sum_total_ganado_s = 0;
        $sum_descuentos_afp_s = 0;
        $sum_prima_riesgo_comun_s = 0;
        $sum_comision_ente_s = 0;
        $sum_total_aporte_solidario_s = 0;
        $sum_descuentos_rciva_s = 0;
        $sum_descuento_s = 0;
        $sum_fondo_social_s = 0;
        $sum_fondo_empleados_s = 0;
        $sum_entidades_financieras_s = 0;
        $sum_total_descuentos_s = 0;
        $sum_liquido_pagable_s = 0;

        $h = 6;

        $pdf->SetFont('dejavusans', 'B', 6);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->MultiCell(309, $h, 'SECCIÓN ' . $key, 1, 'C', 1, 1, '', '', 1, '', '', '', $h, 'M');
        $total_seccion = 0;

        foreach ($cargo as $planilla) {
            if ($pdf->GetY() + $h > $pdf->getPageHeight() - 16) {
                $pdf->AddPage();
                $pdf->SetY(10);
                $pdf->SetFont('dejavusans', 'B', 6);
                $pdf->SetFillColor(230, 230, 230);
                $pdf->MultiCell(12, 22, 'ITEM', 1, 'C', 1, 0, '', '', 1, '', '', '', 22, 'M');
                $pdf->MultiCell(35, 22, 'NOMBRE', 1, 'C', 1, '', '', '', 1, '', '', '', 22, 'M');
                $pdf->MultiCell(30, 8, 'CARGO', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, 'CI', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, 'NUA', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, 'FECHA INGRESO', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, 'HABER MENSUAL', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(15, 8, 'DIAS', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, 'HABER BASICO', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(20, 8, 'BONO ANT.', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, 'HORAS EXTRA', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(16, 8, 'SUPLEN.', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, 'TOTAL GANADO', 1, 'C', 1, 0, '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(20, 22, 'LIQUIDO PAGABLE', 1, 'C', 1, 0, '', '', 1, '', '', '', 22, 'M');
                $pdf->MultiCell(35, 22, 'FIRMA TRABAJADOR', 1, 'C', 1, 1, '', '', 1, '', '', '', 22, 'M');
                $pdf->MultiCell(207, 6, 'DESCUENTOS', 1, 'C', 1, 1, 57, 18, 1, '', '', '', 6, 'M');
                $pdf->MultiCell(30, 8, 'SIND.', 1, 'C', 1, '', 57, '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, 'CAT. IND.', 1, 'C', 1, 0, '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, 'PRIM. RIESGO C.', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, 'COM. AL ENTE', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, 'TOTAL APORTE SOL.', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(15, 8, 'RCIVA 13%', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, 'OTROS DESC.', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(20, 8, 'FONDO SOCIAL', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, 'FONDO EMPL.', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(16, 8, 'ENT. FINAN.', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, 'TOTAL.DESC', 1, 'C', 1, 1, '', '', 1, '', '', '', 8, 'M');
            }
            $pdf->SetFont('dejavusans', '', 6);
            $pdf->SetFillColor(220, 220, 220);

            if (!empty($planilla->datos)) {
                $horas_extra = $planilla->horas_extra == null ? 0 : '(' . $planilla->horas_extra->cantidad . ')' . Funciones::formatMoney($planilla->horas_extra->monto);
                $pdf->MultiCell(12, 14, $planilla->item, 1, 'C', 0, '', '', '', 1, '', '', '', 14, 'M');
                $pdf->MultiCell(35, 14, mb_strtoupper($planilla->datos->nombres . ' ' . $planilla->datos->apellidos), 1, 'L', 0, '', '', '', 1, '', '', '', 14, 'M');
                $pdf->MultiCell(30, 8, mb_strtoupper($planilla->datos->cargo), 1, 'L', 0, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, $planilla->datos->ci, 1, 'C', 0, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, $planilla->datos->nua, 1, 'C', 0, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, Funciones::formatDate($planilla->datos->fecha_ingreso), 1, 'C', 0, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, Funciones::formatMoney($planilla->datos->haber_mensual), 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(15, 8, $planilla->datos->dias_pagados, 1, 'C', 0, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, Funciones::formatMoney($planilla->datos->haber_basico), 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(20, 8, Funciones::formatMoney($planilla->datos->bono_antiguedad), 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, $horas_extra, 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(16, 8, Funciones::formatMoney($planilla->datos->suplencia), 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(18, 8, Funciones::formatMoney($planilla->datos->total_ganado), 1, 'R', 0, 0, '', '', 1, '', '', '', 8, 'M');
                $pdf->MultiCell(20, 8, Funciones::formatMoney($planilla->datos->liquido_pagable), 'LTR', 'R', 0, '', '', '', 1, '', '', '', 8, 'B');
                $pdf->SetFont('dejavusans', '', 5);
                $pdf->MultiCell(35, 8, $planilla->datos->item, 'LTR', 'R', 0, 1, '', '', 1, '', '', '', 8, 'M'); // firma t8bajador

                $pdf->MultiCell(30, 6, Funciones::formatMoney($planilla->datos->sindicato), 1, 'R', 0, '', 57, '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(18, 6, Funciones::formatMoney($planilla->datos->categoria_individual), 1, 'R', 0, 0, '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(18, 6, Funciones::formatMoney($planilla->datos->prima_riesgo_comun), 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(18, 6, Funciones::formatMoney($planilla->datos->comision_ente), 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(18, 6, Funciones::formatMoney($planilla->datos->total_aporte_solidario), 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(15, 6, Funciones::formatMoney($planilla->datos->desc_rciva), 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(18, 6, Funciones::formatMoney($planilla->datos->otros_descuentos), 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(20, 6, Funciones::formatMoney($planilla->datos->fondo_social), 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(18, 6, Funciones::formatMoney($planilla->datos->fondo_empleados), 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(16, 6, Funciones::formatMoney($planilla->datos->entidades_financieras), 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(18, 6, Funciones::formatMoney($planilla->datos->total_descuentos), 1, 'R', 0, 0, '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(20, 6, '', 'LRB', 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->SetFont('dejavusans', '', 5);
                $pdf->MultiCell(35, 6, '', 'LRB', 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');

                $sum_haber_basico_s = $sum_haber_basico_s + $planilla->datos->haber_basico;
                $sum_bono_antiguedad_s = $sum_bono_antiguedad_s + $planilla->datos->bono_antiguedad;
                $sum_extras_s = $sum_extras_s + $planilla->datos->horas_extra;
                $sum_suplencias_s = $sum_suplencias_s + $planilla->datos->suplencia;
                $sum_total_ganado_s = $sum_total_ganado_s + $planilla->datos->total_ganado;
                $sum_sindicato_s = $sum_sindicato_s + $planilla->datos->sindicato;
                $sum_descuentos_afp_s = $sum_descuentos_afp_s + $planilla->datos->categoria_individual;
                $sum_prima_riesgo_comun_s = $sum_prima_riesgo_comun_s + $planilla->datos->prima_riesgo_comun;
                $sum_comision_ente_s = $sum_comision_ente_s + $planilla->datos->comision_ente;
                $sum_total_aporte_solidario_s = $sum_total_aporte_solidario_s + $planilla->datos->total_aporte_solidario;
                $sum_descuentos_rciva_s = $sum_descuentos_rciva_s + $planilla->datos->desc_rciva;
                $sum_descuento_s = $sum_descuento_s + $planilla->datos->otros_descuentos;
                $sum_fondo_social_s = $sum_fondo_social_s + $planilla->datos->fondo_social;
                $sum_fondo_empleados_s = $sum_fondo_empleados_s + $planilla->datos->fondo_empleados;
                $sum_entidades_financieras_s = $sum_entidades_financieras_s + $planilla->datos->entidades_financieras;
                $sum_total_descuentos_s = $sum_total_descuentos_s + $planilla->datos->total_descuentos;
                $sum_liquido_pagable_s = $sum_liquido_pagable_s + $planilla->datos->liquido_pagable;

                // $total_seccion = $total_seccion + $planilla->datos->monto; //total de bono de toda la seccion
            } else {
                $pdf->MultiCell(12, 6, $planilla->item, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(297, 6, 'ACEFALIA (CARGO: ' . $planilla->nombre_cargo . ')', 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');
            }
        }
        $i = $i + 1;
        $pdf->SetFont('dejavusans', 'B', 6);
        $pdf->SetFillColor(211, 235, 215);
        $pdf->MultiCell(47, 12, 'TOTAL SECCIÓN ' . $key, 1, 'R', 1, '', '', '', 1, '', '', '', 12, 'M');
        $pdf->MultiCell(30, 12, Funciones::formatMoney($sum_sindicato_s), 1, 'R', 1, '', 57, '', 1, '', '', '', 12, 'M');
        $pdf->MultiCell(18, 12, Funciones::formatMoney($sum_descuentos_afp_s), 1, 'R', 1, 0, '', '', 1, '', '', '', 12, 'M');
        $pdf->MultiCell(18, 12, Funciones::formatMoney($sum_prima_riesgo_comun_s), 1, 'R', 1, '', '', '', 1, '', '', '', 12, 'M');
        $pdf->MultiCell(18, 12, Funciones::formatMoney($sum_comision_ente_s), 1, 'R', 1, '', '', '', 1, '', '', '', 12, 'M');
        $pdf->MultiCell(18, 12, Funciones::formatMoney($sum_total_aporte_solidario_s), 1, 'R', 1, '', '', '', 1, '', '', '', 12, 'M');
        $pdf->MultiCell(15, 12, Funciones::formatMoney($sum_descuentos_rciva_s), 1, 'R', 1, '', '', '', 1, '', '', '', 12, 'M');
        $pdf->MultiCell(18, 6, Funciones::formatMoney($sum_haber_basico_s), 1, 'R', 1, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(20, 6, Funciones::formatMoney($sum_bono_antiguedad_s), 1, 'R', 1, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(18, 6, Funciones::formatMoney($sum_extras_s), 1, 'R', 1, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(16, 6, Funciones::formatMoney($sum_suplencias_s), 1, 'R', 1, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(18, 6, Funciones::formatMoney($sum_total_ganado_s), 1, 'R', 1, 0, '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(20, 6, Funciones::formatMoney($sum_liquido_pagable_s), 'LTR', 'R', 1, 0, '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(35, 6, '', 'LTR', 'R', 1, 1, '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(18, 6, Funciones::formatMoney($sum_descuento_s), 1, 'R', 1, '', 174, '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(20, 6, Funciones::formatMoney($sum_fondo_social_s), 1, 'R', 1, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(18, 6, Funciones::formatMoney($sum_fondo_empleados_s), 1, 'R', 1, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(16, 6, Funciones::formatMoney($sum_entidades_financieras_s), 1, 'R', 1, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(18, 6, Funciones::formatMoney($sum_total_descuentos_s), 1, 'R', 1, 0, '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(20, 6, '', 'LRB', 'R', 1, 0, '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(35, 6, '', 'LRB', 'R', 1, 1, '', '', 1, '', '', '', 6, 'M');
        if ($i < $cantidad_secciones) {
            $pdf->AddPage();
        }

        $sum_haber_basico = $sum_haber_basico_s + $sum_haber_basico;
        $sum_bono_antiguedad = $sum_bono_antiguedad_s + $sum_bono_antiguedad;
        $sum_extras = $sum_extras_s + $sum_extras;
        $sum_suplencias = $sum_suplencias_s + $sum_suplencias;
        $sum_total_ganado = $sum_total_ganado_s + $sum_total_ganado;
        $sum_sindicato = $sum_sindicato_s + $sum_sindicato;
        $sum_descuentos_afp = $sum_descuentos_afp_s + $sum_descuentos_afp;
        $sum_prima_riesgo_comun = $sum_prima_riesgo_comun_s + $sum_prima_riesgo_comun;
        $sum_comision_ente = $sum_comision_ente_s + $sum_comision_ente;
        $sum_total_aporte_solidario = $sum_total_aporte_solidario_s + $sum_total_aporte_solidario;
        $sum_descuentos_rciva = $sum_descuentos_rciva_s + $sum_descuentos_rciva;
        $sum_descuento = $sum_descuento_s + $sum_descuento;
        $sum_fondo_social = $sum_fondo_social_s + $sum_fondo_social;
        $sum_fondo_empleados = $sum_fondo_empleados_s + $sum_fondo_empleados;
        $sum_entidades_financieras = $sum_entidades_financieras_s + $sum_entidades_financieras;
        $sum_total_descuentos = $sum_total_descuentos_s + $sum_total_descuentos;
        $sum_liquido_pagable = $sum_liquido_pagable_s + $sum_liquido_pagable;
    }
    $pdf->SetFont('dejavusans', 'B', 6);
    $pdf->SetFillColor(230, 230, 230);
    $pdf->MultiCell(47, 12, 'TOTALES', 1, 'R', 1, '', '', '', 1, '', '', '', 12, 'M');
    $pdf->MultiCell(30, 12, Funciones::formatMoney($sum_sindicato), 1, 'R', 1, '', 57, '', 1, '', '', '', 12, 'M');
    $pdf->MultiCell(18, 12, Funciones::formatMoney($sum_descuentos_afp), 1, 'R', 1, 0, '', '', 1, '', '', '', 12, 'M');
    $pdf->MultiCell(18, 12, Funciones::formatMoney($sum_prima_riesgo_comun), 1, 'R', 1, '', '', '', 1, '', '', '', 12, 'M');
    $pdf->MultiCell(18, 12, Funciones::formatMoney($sum_comision_ente), 1, 'R', 1, '', '', '', 1, '', '', '', 12, 'M');
    $pdf->MultiCell(18, 12, Funciones::formatMoney($sum_total_aporte_solidario), 1, 'R', 1, '', '', '', 1, '', '', '', 12, 'M');
    $pdf->MultiCell(15, 12, Funciones::formatMoney($sum_descuentos_rciva), 1, 'R', 1, '', '', '', 1, '', '', '', 12, 'M');
    $pdf->MultiCell(18, 6, Funciones::formatMoney($sum_haber_basico), 1, 'R', 1, '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(20, 6, Funciones::formatMoney($sum_bono_antiguedad), 1, 'R', 1, '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(18, 6, Funciones::formatMoney($sum_extras), 1, 'R', 1, '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(16, 6, Funciones::formatMoney($sum_suplencias), 1, 'R', 1, '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(18, 6, Funciones::formatMoney($sum_total_ganado), 1, 'R', 1, 0, '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(20, 6, Funciones::formatMoney($sum_liquido_pagable), 'LTR', 'R', 1, 1, '', '', 1, '', '', '', 6, 'B');

    $pdf->MultiCell(18, 6, Funciones::formatMoney($sum_descuento), 1, 'R', 1, '', 174, '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(20, 6, Funciones::formatMoney($sum_fondo_social), 1, 'R', 1, '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(18, 6, Funciones::formatMoney($sum_fondo_empleados), 1, 'R', 1, '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(16, 6, Funciones::formatMoney($sum_entidades_financieras), 1, 'R', 1, '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(18, 6, Funciones::formatMoney($sum_total_descuentos), 1, 'R', 1, 0, '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(20, 6, '', 'LRB', 'R', 1, 1, '', '', 1, '', '', '', 6, 'M');

    $pdf->SetY($pdf->GetY() + 10);
    $pdf->SetFont('dejavusans', '', 6);
    $pdf->MultiCell(65, 4, 'Lic. Marcelo Flores Daza', 0, 'C', 0, 0, '', '', 1, 1, 0, 1, 4, 'M');
    $pdf->MultiCell(65, 4, 'Lic. Elizabeth Zulema Brito Pozo', 0, 'C', 0, 0, '', '', 1, 1, 0, 1, 4, 'M');
    $pdf->MultiCell(65, 4, 'Lic. Ernesto Sejas', 0, 'C', 0, 0, '', '', 1, 1, 0, 1, 4, 'M');
    $pdf->MultiCell(65, 4, 'Ing. Enzo Arnaldo Porcel Arandia', 0, 'C', 0, 1, '', '', 1, 1, 0, 1, 4, 'M');
    $pdf->SetFont('dejavusans', 'B', 6);
    $pdf->MultiCell(65, 4, 'JEFE ADMINISTRATIVO Y PERSONAL', 0, 'C', 0, 0, '', '', 1, 1, 0, 1, 4, 'M');
    $pdf->MultiCell(65, 4, 'JEFE FINANCIERO Y CONTABLE', 0, 'C', 0, 0, '', '', 1, 1, 0, 1, 4, 'M');
    $pdf->MultiCell(65, 4, 'GERENTE ADMINISTRATIVO Y FINANCIERO', 0, 'C', 0, 0, '', '', 1, 1, 0, 1, 4, 'M');
    $pdf->MultiCell(65, 4, 'GERENTE GENERAL a.i.', 0, 'C', 0, 1, '', '', 1, 1, 0, 1, 4, 'M');
} else {
    $pdf->MultiCell(309, 9, 'No existen registros', 1, 'C', 0, '', '', '', 1, '', '', '', 9, 'M');
}

$pdf->Output('Planilla_pagos.pdf', 'I');
