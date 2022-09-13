<?php
use App\Utils\Pdf;

$pdf = new Pdf('PLANILLA DE REFRIGERIO', 'Periodo ' . $mes . '/' . $gestion, 'RRHH', 'P', true, true);

$pdf->SetFillColor(230, 230, 230);
$pdf->RoundedRect(10, 6, $pdf->getPageWidth() - 20, 30, 2.5, '1111');

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(230, 230, 230);

$pdf->AddPage();

$pdf->SetY(40);
$pdf->SetFont('dejavusans', 'B', 5);
$pdf->SetFillColor(230, 230, 230);
$pdf->MultiCell(10, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(49, 6, 'CARGO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(47, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(16, 6, 'DÍAS LABORALES', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(18, 6, 'DÍAS TRABAJADOS', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(18, 6, 'MONTO REFRIGERIO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(18, 6, 'OTROS', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(18, 6, 'TOTAL REFRIGERIO', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
if ($cargos->count() > 0) {
    $total_planilla_otros = 0;
    $total_planilla = 0;
    foreach ($cargos as $key => $cargo) {
        // $h_seccion = ceil($pdf->getStringHeight(20, trim($cargo->seccion), $reseth = true, $autopadding = true, $border = 1));
        $h = 6;
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetFont('dejavusans', 'B', 5);
        $pdf->MultiCell(194, $h, 'SECCIÓN ' . $key, 1, 'C', 1, 1, '', '', 1, '', '', '', $h, 'M');
        $total_seccion_otros = 0;
        $total_seccion = 0;
        foreach ($cargo as $refrigerio) {
            if ($pdf->GetY() + $h > $pdf->getPageHeight() - 12) {
                $pdf->AddPage();
                $pdf->SetY(15);
                $pdf->SetFont('dejavusans', 'B', 5);
                $pdf->SetFillColor(230, 230, 230);
                $pdf->MultiCell(10, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(49, 6, 'CARGO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(47, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(16, 6, 'DÍAS LABORALES', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(18, 6, 'DÍAS TRABAJADOS', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(18, 6, 'MONTO REFRIGERIO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(18, 6, 'OTROS', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(18, 6, 'TOTAL REFRIGERIO', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
            }
            $pdf->SetFont('dejavusans', '', 5);
            $pdf->SetFillColor(220, 220, 220);
            $pdf->MultiCell(10, 6, $refrigerio->item, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
            if (!empty($refrigerio->datos)) {
                $pdf->MultiCell(49, 6, $refrigerio->datos->cargo, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(47, 6, mb_strtoupper($refrigerio->datos->nombre_completo), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(16, 6, $refrigerio->datos->dias_laborales, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(18, 6, $refrigerio->datos->dias_asistencia, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(18, 6, Funciones::formatMoney($refrigerio->datos->monto_refrigerio), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(18, 6, Funciones::formatMoney($refrigerio->datos->otros), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(18, 6, Funciones::formatMoney($refrigerio->datos->total_refrigerio), 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');
                $total_seccion_otros = $total_seccion_otros + $refrigerio->datos->otros;
                $total_seccion = $total_seccion + $refrigerio->datos->total_refrigerio;
            } else {
                $pdf->MultiCell(184, 6, 'ACEFALIA (CARGO: ' . $refrigerio->nombre_cargo . ')', 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');
            }
            $total_planilla_otros = $total_planilla + $total_seccion_otros;
            $total_planilla = $total_planilla + $total_seccion;
        }
        $pdf->SetFont('dejavusans', 'B', 6);
        $pdf->MultiCell(158, 6, 'TOTAL SECCIÓN ' . $key, 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(18, 6, Funciones::formatMoney($total_seccion_otros), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(18, 6, Funciones::formatMoney($total_seccion), 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');
    }
    $pdf->MultiCell(158, 6, 'TOTAL REFRIGERIOS DEL MES', 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(18, 6, Funciones::formatMoney($total_planilla_otros), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(18, 6, Funciones::formatMoney($total_planilla), 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');
} else {
    $pdf->MultiCell(194, 6, 'No existen registros', 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
}
$pdf->Output('Planilla_Refrigerio_Periodo_' . $mes . '_' . $gestion . '.pdf', 'I');
