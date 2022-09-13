<?php
use App\Utils\Pdf;

$pdf = new Pdf('PLANILLA FONDO EMPLEADOS', 'Periodo ' . $mes . '/' . $gestion, 'RRHH', 'P', true, true);

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(230, 230, 230);

$pdf->AddPage();

$pdf->SetY(40);
$pdf->SetX(25);
$pdf->SetFont('dejavusans', 'B', 5);
$pdf->SetFillColor(230, 230, 230);
$pdf->MultiCell(10, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(60, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(20, 6, 'TOTAL GANADO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(20, 6, 'PORCENTAJE_FE', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(20, 6, 'MONTO APORTE', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(20, 6, 'PAGO DEUDA', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(20, 6, 'TOTAL FE.', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
$total_monto_fe = 0;
$total_pago_deuda = 0;
$total_total_fe = 0;
if ($fondo_empleados->count() > 0) {
    foreach ($fondo_empleados as $key => $fondo_empleado) {

        if ($pdf->GetY() + 6 > $pdf->getPageHeight() - 12) {
            $pdf->AddPage();
            $pdf->SetY(15);
            $pdf->SetX(25);
            $pdf->SetFont('dejavusans', 'B', 6);
            $pdf->SetFillColor(230, 230, 230);
            $pdf->MultiCell(10, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(60, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(20, 6, 'TOTAL GANADO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(20, 6, 'PORCENTAJE_FE', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(20, 6, 'MONTO APORTE', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(20, 6, 'PAGO DEUDA', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(20, 6, 'TOTAL FE.', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
        }
        $pdf->SetX(25);
        $pdf->SetFont('dejavusans', '', 6);
        $pdf->SetFillColor(220, 220, 220);
        $pdf->MultiCell(10, 6, $fondo_empleado->item, 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(60, 6, $fondo_empleado->nombre_completo, 1, 'L', '', '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(20, 6, Funciones::formatMoney($fondo_empleado->total_ganado), 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(20, 6, Funciones::formatMoney($fondo_empleado->porcentaje_fe), 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(20, 6, Funciones::formatMoney($fondo_empleado->monto_fe), 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(20, 6, Funciones::formatMoney($fondo_empleado->pago_deuda), 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(20, 6, Funciones::formatMoney($fondo_empleado->total_fe), 1, 'C', '', 1, '', '', 1, '', '', '', 6, 'M');
        $total_monto_fe = $total_monto_fe + $fondo_empleado->monto_fe;
        $total_pago_deuda = $total_pago_deuda + $fondo_empleado->pago_deuda;
        $total_total_fe = $total_total_fe + $fondo_empleado->total_fe;
    }
    $pdf->SetX(25);
    $pdf->SetFont('dejavusans', 'B', 6);
    $pdf->MultiCell(110, 6, 'TOTAL', 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(20, 6, Funciones::formatMoney($total_monto_fe), 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(20, 6, Funciones::formatMoney($total_pago_deuda), 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(20, 6, Funciones::formatMoney($total_total_fe), 1, 'C', '', 1, '', '', 1, '', '', '', 6, 'M');
} else {
    $pdf->MultiCell(115, 6, 'No existen registros', 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
}
$pdf->Output('Planilla_fondo_empleados_Periodo_' . $mes . '_' . $gestion . '.pdf', 'I');
