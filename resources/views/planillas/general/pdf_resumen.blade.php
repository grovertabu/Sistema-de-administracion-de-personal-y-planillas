<?php
use App\Utils\Pdf;

$pdf = new Pdf('RESUMEN PLANILLA DE PAGO', $nombre_planilla->nombre_planilla . ' ' . $nombre_planilla->gestion, 'RRHH', 'L', true, true, [216, 330]);

$pdf->SetFillColor(230, 230, 230);
$pdf->RoundedRect(10, 6, $pdf->getPageWidth() - 20, 30, 2.5, '1111');

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(230, 230, 230);

$pdf->AddPage();

$pdf->SetY(40);
$pdf->SetFont('dejavusans', 'B', 6);
$pdf->SetFillColor(230, 230, 230);
$pdf->MultiCell(35, 8, 'CONCEPTO', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(20, 8, 'HABER BASICO', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(20, 8, 'BONO ANTIGUEDAD', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'HORAS EXTRA', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'SUPLENCIA', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'TOTAL GANADO', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'SINDICATO', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'CATEGORIA INDIVIDUAL', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'PRIMA RIESGO COMUN', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(22, 8, 'COMISION AL ENTE ADMINISTRADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'TOTAL APORTE SOLIDARIO', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(16, 8, 'RC-IVA 13%', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'OTROS DESCUENTOS', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'FONDO SOCIAL', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'FONDO EMPLEADOS', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
$pdf->MultiCell(18, 8, 'ENTIDADES FINANCIERAS', 1, 'C', 1, 1, '', '', 1, '', '', '', 8, 'M');

if (sizeof($total_secciones) > 0) {
    foreach ($total_secciones as $total_seccion) {
        // $h_seccion = ceil($pdf->getStringHeight(20, trim($cargo->seccion), $reseth = true, $autopadding = true, $border = 1));
        $h = 6;
        $pdf->SetFillColor(230, 230, 230);
        if ($pdf->GetY() + $h > $pdf->getPageHeight() - 12) {
            $pdf->AddPage();
            $pdf->SetY(15);
            $pdf->SetFont('dejavusans', 'B', 6);
            $pdf->SetFillColor(230, 230, 230);
            $pdf->MultiCell(35, 8, 'CONCEPTO', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
            $pdf->MultiCell(20, 8, 'HABER BASICO', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
            $pdf->MultiCell(20, 8, 'BONO ANTIGUEDAD', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
            $pdf->MultiCell(18, 8, 'HORAS EXTRA', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
            $pdf->MultiCell(18, 8, 'SUPLENCIA', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
            $pdf->MultiCell(18, 8, 'TOTAL GANADO', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
            $pdf->MultiCell(18, 8, 'SINDICATO', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
            $pdf->MultiCell(18, 8, 'CATEGORIA INDIVIDUAL', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
            $pdf->MultiCell(18, 8, 'PRIMA RIESGO COMUN', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
            $pdf->MultiCell(22, 8, 'COMISION AL ENTE ADMINISTRADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
            $pdf->MultiCell(18, 8, 'TOTAL APORTE SOLIDARIO', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
            $pdf->MultiCell(16, 8, 'RC-IVA 13%', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
            $pdf->MultiCell(18, 8, 'OTROS DESCUENTOS', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
            $pdf->MultiCell(18, 8, 'FONDO SOCIAL', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
            $pdf->MultiCell(18, 8, 'FONDO EMPLEADOS', 1, 'C', 1, '', '', '', 1, '', '', '', 8, 'M');
            $pdf->MultiCell(18, 8, 'ENTIDADES FINANCIERAS', 1, 'C', 1, 1, '', '', 1, '', '', '', 8, 'M');
        }
        $pdf->SetFont('dejavusans', '', 6);
        $pdf->SetFillColor(220, 220, 220);
        $pdf->MultiCell(35, 8, $total_seccion->seccion, 1, 'L', 0, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(20, 8, $total_seccion->sum_haber_basico_s, 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(20, 8, $total_seccion->sum_bono_antiguedad_s, 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_seccion->sum_extras_s, 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_seccion->sum_suplencias_s, 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_seccion->sum_total_ganado_s, 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_seccion->sum_sindicato_s , 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_seccion->sum_descuentos_afp_s, 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_seccion->sum_prima_riesgo_comun_s , 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(22, 8, $total_seccion->sum_comision_ente_s, 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_seccion->sum_total_aporte_solidario_s, 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(16, 8, $total_seccion->sum_descuentos_rciva_s, 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_seccion->sum_descuento_s, 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_seccion->sum_fondo_social_s, 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_seccion->sum_fondo_empleados_s, 1, 'R', 0, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_seccion->sum_entidades_financieras_s , 1, 'R', 0, 1, '', '', 1, '', '', '', 8, 'M');
    }
        $pdf->SetFont('dejavusans', '', 6);
        $pdf->SetFillColor(220, 220, 220);
        $pdf->MultiCell(35, 8, $total_general[0]->seccion, 1, 'L', 1, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(20, 8, $total_general[0]->sum_haber_basico, 1, 'R', 1, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(20, 8, $total_general[0]->sum_bono_antiguedad, 1, 'R', 1, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_general[0]->sum_extras, 1, 'R', 1, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_general[0]->sum_suplencias, 1, 'R', 1, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_general[0]->sum_total_ganado, 1, 'R', 1, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_general[0]->sum_sindicato , 1, 'R', 1, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_general[0]->sum_descuentos_afp, 1, 'R', 1, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_general[0]->sum_prima_riesgo_comun , 1, 'R', 1, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(22, 8, $total_general[0]->sum_comision_ente, 1, 'R', 1, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_general[0]->sum_total_aporte_solidario, 1, 'R', 1, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(16, 8, $total_general[0]->sum_descuentos_rciva, 1, 'R', 1, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_general[0]->sum_descuento, 1, 'R', 1, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_general[0]->sum_fondo_social, 1, 'R', 1, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_general[0]->sum_fondo_empleados, 1, 'R', 1, '', '', '', 1, '', '', '', 8, 'M');
        $pdf->MultiCell(18, 8, $total_general[0]->sum_entidades_financieras , 1, 'R', 1, 1, '', '', 1, '', '', '', 8, 'M');
} else {
    $pdf->MultiCell(238, 6, 'No existen registros', 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
}
$pdf->Output('Resumen_planilla_pagos.pdf', 'I');
