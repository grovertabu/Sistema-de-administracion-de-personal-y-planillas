<?php
use App\Utils\Pdf;

$pdf = new Pdf('PLANILLA DE IMPOSITIVA', 'Periodo ' . $mes . '/' . $gestion, 'RRHH', 'L', true, true);

$pdf->SetFillColor(230, 230, 230);
$pdf->RoundedRect(10, 6, $pdf->getPageWidth() - 20, 30, 2.5, '1111');

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(230, 230, 230);

$pdf->AddPage();

$pdf->SetY(40);
$pdf->SetFont('dejavusans', 'B', 4);
$pdf->SetFillColor(230, 230, 230);
$pdf->MultiCell(7, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(25, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(14, 6, 'TOTAL GANADO.', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(14, 6, 'APORTES', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(12, 6, 'REFRIGERIO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(14, 6, 'SUELDO NETO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(12, 6, 'MIN.NO IMPONIBLE', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(12, 6, 'BASE IMPONIBLE', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(12, 6, 'IMP. B.I.', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(12, 6, 'FORM 110(13%)', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(12, 6, '13% S.M.', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(12, 6, 'FISCO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(14, 6, 'DEPENDIENTE', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(12, 6, 'MES ANTERIOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(15, 6, 'ACTUALIZACION', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(10, 6, 'TOTAL', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(13, 6, 'SALDO TOTAL DEP.', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(13, 6, 'SALDO UTILIZADO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(12, 6, 'RETENCION', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(13, 6, 'SALDO DEP. SIG. MES', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
if ($cargos->count() > 0) {
    $sum = 0;
    $sum_r = 0;
    $sum_rciva = 0;
    foreach ($cargos as $key => $cargo) {
        // $h_seccion = ceil($pdf->getStringHeight(35, trim($cargo->seccion), $reseth = true, $autopadding = true, $border = 1));
        $h = 6;

        $pdf->SetFont('dejavusans', 'B', 4);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->MultiCell(260, $h, 'SECCIÓN ' . $key, 1, 'C', 1, 1, '', '', 1, '', '', '', $h, 'M');
        $total_seccion = 0;

        $sum_s = 0;
        $sum_r_s = 0;
        $sum_rciva_s = 0;

        foreach ($cargo as $impositiva) {
            if ($pdf->GetY() + $h > $pdf->getPageHeight() - 15) {
                $pdf->AddPage();
                $pdf->SetY(15);
                $pdf->SetFont('dejavusans', 'B', 4);
                $pdf->SetFillColor(230, 230, 230);
                $pdf->MultiCell(7, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(25, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(14, 6, 'TOTAL GANADO.', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(14, 6, 'APORTES', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, 'REFRIGERIO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(14, 6, 'SUELDO NETO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, 'MIN.NO IMPONIBLE', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, 'BASE IMPONIBLE', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, 'IMP. B.I.', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, 'FORM 110(13%)', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, '13% S.M.', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, 'FISCO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(14, 6, 'DEPENDIENTE', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, 'MES ANTERIOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(15, 6, 'ACTUALIZACION', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(10, 6, 'TOTAL', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(13, 6, 'SALDO TOTAL DEP.', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(13, 6, 'SALDO UTILIZADO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, 'RETENCION', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(13, 6, 'SALDO DEP. SIG. MES', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
            }
            $pdf->SetFont('dejavusans', '', 4);
            $pdf->SetFillColor(220, 220, 220);

            if (!empty($impositiva->datos)) {
                $pdf->MultiCell(7, 6, $impositiva->item, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(25, 6, mb_strtoupper($impositiva->datos->nombre_completo), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(14, 6, Funciones::formatMoney($impositiva->datos->total_ganado), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(14, 6, Funciones::formatMoney($impositiva->datos->aportes_laborales), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, Funciones::formatMoney($impositiva->datos->total_refrigerio), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(14, 6, Funciones::formatMoney($impositiva->datos->sueldo_neto), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, Funciones::formatMoney($impositiva->datos->minimo_no_imponible), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, Funciones::formatMoney($impositiva->datos->base_imponible), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, Funciones::formatMoney($impositiva->datos->impuesto_bi), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, Funciones::formatMoney($impositiva->datos->presentacion_desc), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, Funciones::formatMoney($impositiva->datos->impuesto_mn), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, Funciones::formatMoney($impositiva->datos->saldo_fisco), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(14, 6, Funciones::formatMoney($impositiva->datos->saldo_dependiente), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, Funciones::formatMoney($impositiva->datos->saldo_mes_anterior), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(15, 6, Funciones::formatMoney($impositiva->datos->actualizacion), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(10, 6, Funciones::formatMoney($impositiva->datos->saldo_total_mes_anterior), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(13, 6, Funciones::formatMoney($impositiva->datos->saldo_total_dependiente), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(13, 6, Funciones::formatMoney($impositiva->datos->saldo_utilizado), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, Funciones::formatMoney($impositiva->datos->retencion_pagar), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(13, 6, Funciones::formatMoney($impositiva->datos->saldo_siguiente_mes), 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');

                $sum_s = $sum_s + $impositiva->datos->saldo_siguiente_mes;
                $sum_r_s = $sum_r_s + $impositiva->datos->retencion_pagar;
                $sum_rciva_s = $sum_rciva_s + $impositiva->datos->presentacion_desc;
            } else {
                $pdf->MultiCell(7, 6, $impositiva->item, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(253, 6, 'ACEFALIA (CARGO: ' . $impositiva->nombre_cargo . ')', 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');
            }
        }
        $pdf->SetFont('dejavusans', 'B', 4);
        $pdf->MultiCell(230, 6, 'TOTAL SECCIÓN ' . $key, 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(30, 6, Funciones::formatMoney($sum_s), 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');
        $sum = $sum + $sum_s;
        $sum_r = $sum_r + $sum_r_s;
        $sum_rciva = $sum_rciva + $sum_rciva_s;
    }

    $pdf->MultiCell(170, 6, 'TOTAL DEL MES', 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(30, 6, Funciones::formatMoney($sum_rciva), 1, 'C', 0, 0, '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(30, 6, Funciones::formatMoney($sum_r), 1, 'C', 0, 0, '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(30, 6, Funciones::formatMoney($sum), 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');
} else {
    $pdf->MultiCell(260, 9, 'No existen registros', 1, 'C', 0, '', '', '', 1, '', '', '', 9, 'M');
}
$pdf->Output('Planilla_Impositiva_' . $mes . '_' . $gestion . '.pdf', 'I');
