<?php
use App\Utils\Pdf;

$pdf = new Pdf('PLANILLA DE HORAS EXTRAS', 'Periodo ' . $mes . '/' . $gestion, 'RRHH', 'P', true, true);

$pdf->SetFillColor(230, 230, 230);
$pdf->RoundedRect(10, 6, $pdf->getPageWidth() - 20, 30, 2.5, '1111');

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(230, 230, 230);

$pdf->AddPage();

$pdf->SetY(40);
$pdf->SetFont('dejavusans', 'B', 6);
$pdf->SetFillColor(230, 230, 230);
$pdf->MultiCell(15, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(57, 6, 'CARGO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(52, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(25, 6, 'SALARIO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(20, 6, 'HORAS EXTRAS', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(25, 6, 'MONTO', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
$total_horas = 0;
$total_monto = 0;
if ($horas_extras->count() > 0) {
    foreach ($horas_extras as $key => $hora_extra) {
        // $h_seccion = ceil($pdf->getStringHeight(35, trim($cargo->seccion), $reseth = true, $autopadding = true, $border = 1));

        if ($pdf->GetY() + 6 > $pdf->getPageHeight() - 12) {
            $pdf->AddPage();
            $pdf->SetY(15);
            $pdf->SetFont('dejavusans', 'B', 6);
            $pdf->SetFillColor(230, 230, 230);
            $pdf->MultiCell(15, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(57, 6, 'CARGO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(52, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(25, 6, 'SALARIO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(20, 6, 'HORAS EXTRAS', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(25, 6, 'MONTO', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
        }
        $pdf->SetFont('dejavusans', '', 6);
        $pdf->SetFillColor(220, 220, 220);
        $pdf->MultiCell(15, 6, $hora_extra->item, 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(57, 6, $hora_extra->nombre_cargo, 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(52, 6, mb_strtoupper($hora_extra->nombre_completo), 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(25, 6, $hora_extra->salario_mensual, 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(20, 6, $hora_extra->cantidad, 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(25, 6, Funciones::formatMoney($hora_extra->total), 1, 'C', '', 1, '', '', 1, '', '', '', 6, 'M');
        $total_horas = $total_horas + $hora_extra->cantidad;
        $total_monto = $total_monto + $hora_extra->total;
    }
    $pdf->SetFont('dejavusans', 'B', 6);
    $pdf->MultiCell(149, 6, 'TOTAL', 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(20, 6, $total_horas, 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(25, 6, Funciones::formatMoney($total_monto), 1, 'C', '', 1, '', '', 1, '', '', '', 6, 'M');
} else {
    $pdf->MultiCell(194, 6, 'No existen registros', 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
}
$pdf->Output('Planilla_Horas_extras_Periodo_' . $mes . '_' . $gestion . '.pdf', 'I');
