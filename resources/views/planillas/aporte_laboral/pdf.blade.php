<?php
use App\Utils\Pdf;

$pdf = new Pdf('PLANILLA APORTE LABORAL', 'Periodo ' . $mes . '/' . $gestion, 'RRHH', 'L', true, true);

$pdf->SetFillColor(230, 230, 230);
$pdf->RoundedRect(10, 6, $pdf->getPageWidth() - 20, 30, 2.5, '1111');

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(230, 230, 230);

$pdf->AddPage();

$pdf->SetY(40);
$pdf->SetFont('dejavusans', 'B', 6);
$pdf->SetFillColor(230, 230, 230);
$pdf->MultiCell(13, 6, 'ITEM', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(49, 6, 'TRABAJADOR', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(49, 6, 'CARGO', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(25, 6, 'Total Ganado', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(60, 6, 'TIPO DE APORTE', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(30, 6, 'PORCENTAJE DE APORTE', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(30, 6, 'MONTO APORTE', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');

if ($registros_aporte_laboral->count() > 0) {
    $suma_total = 0;
    foreach ($registros_aporte_laboral as $registro_ap) {
        $suma_aportes = 0;
        // $h_seccion = ceil($pdf->getStringHeight(35, trim($cargo->seccion), $reseth = true, $autopadding = true, $border = 1));

        if ($pdf->GetY() + 6 > $pdf->getPageHeight() - 30) {
            $pdf->AddPage();
            $pdf->SetY(15);
            $pdf->SetFont('dejavusans', 'B', 6);
            $pdf->SetFillColor(230, 230, 230);
            $pdf->MultiCell(13, 6, 'ITEM', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(49, 6, 'TRABAJADOR', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(49, 6, 'CARGO', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(25, 6, 'Total Ganado', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(60, 6, 'TIPO DE APORTE', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(30, 6, 'PORCENTAJE DE APORTE', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(30, 6, 'MONTO APORTE', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
        }

        $pdf->SetFont('dejavusans', '', 6);
        $pdf->MultiCell(13, 30, $registro_ap->item, 1, 'C', 0, '', '', '', 1, '', '', '', 30, 'M');
        $pdf->MultiCell(49, 30, mb_strtoupper($registro_ap->trabajador->nombre_completo), 1, 'C', 0, '', '', '', 1, '', '', '', 30, 'M');
        $pdf->MultiCell(49, 30, mb_strtoupper($registro_ap->nomina_cargo->cargo->nombre), 1, 'C', 0, '', '', '', 1, '', '', '', 30, 'M');
        $pdf->MultiCell(25, 30, Funciones::formatMoney($registro_ap->planilla_total_ganados[0]->total_ganado), 1, 'C', 0, 0, '', '', 1, '', '', '', 30, 'M');
        foreach ($registro_ap->planilla_aporte_laborals as $p_aporte) {
            $pdf->MultiCell(60, 6, $p_aporte->tipo_aporte, 1, 'C', 0, 0, 146, '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(30, 6, $p_aporte->porcentaje_aporte, 1, 'C', 0, 0, '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(30, 6, Funciones::formatMoney($p_aporte->monto_aporte), 1, 'R', 0, 1, '', '', 1, '', '', '', 6, 'M');
            $suma_aportes = $suma_aportes + $p_aporte->monto_aporte;
        }
        $pdf->SetFont('dejavusans', 'B', 6);
        $pdf->MultiCell(226, 6, 'TOTAL MONTO APORTE', 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(30, 6, Funciones::formatMoney($suma_aportes), 1, 'R', 0, 1, '', '', 1, '', '', '', 6, 'M');
        $suma_total = $suma_total + $suma_aportes;
    }
    $pdf->SetFont('dejavusans', 'B', 6);
    $pdf->MultiCell(226, 6, 'TOTAL APORTES LABORALES', 1, 'R', '', '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(30, 6, Funciones::formatMoney($suma_total), 1, 'R', '', 1, '', '', 1, '', '', '', 6, 'M');
} else {
    $pdf->MultiCell(194, 6, 'No existen registros', 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
}

$pdf->Output('Planilla_Aporte_Laboral_Periodo_' . $mes . '_' . $gestion . '.pdf', 'I');
