<?php
use App\Utils\Pdf;

$pdf = new Pdf('PLANILLA TOTAL GANADO', 'Periodo ' . $mes . '/' . $gestion, 'RRHH', 'L', true, true);

$pdf->SetFillColor(230, 230, 230);
$pdf->RoundedRect(10, 6, $pdf->getPageWidth() - 20, 30, 2.5, '1111');

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(230, 230, 230);

$pdf->AddPage();

$pdf->SetY(40);
$pdf->SetFont('dejavusans', 'B', 5.5);
$pdf->SetFillColor(230, 230, 230);
$pdf->MultiCell(14, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(51, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(54, 6, 'CARGO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(12, 6, 'TOTAL DÍAS', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(17, 6, 'HABER MENSUAL', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(17, 6, 'HABER BÁSICO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(20, 6, 'BONO ANTIGUEDAD', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(14, 6, 'HORAS EXTRA', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(20, 6, 'MONTO HRS EXTRA', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(20, 6, 'SUPLENCIA', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(20, 6, 'TOTAL GANADO', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
if ($cargos->count() > 0) {
    $total_planilla = 0;
    foreach ($cargos as $key => $cargo) {
        $h = 6;
        $pdf->SetFillColor(230, 230, 230);
        $pdf->SetFont('dejavusans', 'B', 5.5);
        $pdf->MultiCell(259, $h, 'SECCIÓN ' . $key, 1, 'C', 1, 1, '', '', 1, '', '', '', $h, 'M');
        $total_seccion = 0;
        foreach ($cargo as $total_ganado) {
            if ($pdf->GetY() + $h > $pdf->getPageHeight() - 12) {
                $pdf->AddPage();
                $pdf->SetY(15);
                $pdf->SetFont('dejavusans', 'B', 5);
                $pdf->SetFillColor(230, 230, 230);
                $pdf->MultiCell(14, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(51, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(54, 6, 'CARGO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, 'TOTAL DÍAS', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(17, 6, 'HABER MENSUAL', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(17, 6, 'HABER BÁSICO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(20, 6, 'BONO ANTIGUEDAD', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(14, 6, 'HORAS EXTRA', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(20, 6, 'MONTO HRS EXTRA', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(20, 6, 'SUPLENCIA', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(20, 6, 'TOTAL GANADO', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
            }
            $pdf->SetFont('dejavusans', '', 5.5);
            $pdf->SetFillColor(220, 220, 220);
            $pdf->MultiCell(14, 6, $total_ganado->item, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
            if ($total_ganado->estado_asignacion == 'HABILITADO') {
                // dd($total_ganado->datos->nombre_completo);
                $h_cargo = ceil($pdf->getStringHeight(35, trim($total_ganado->datos->cargo), $reseth = true, $autopadding = true, $border = 1));
                $h = max([$h_cargo]) + 2;
                $pdf->MultiCell(51, 6, mb_strtoupper($total_ganado->datos->nombre_completo), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(54, 6, $total_ganado->datos->cargo, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(12, 6, $total_ganado->datos->total_dias, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(17, 6, $total_ganado->datos->haber_mensual, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(17, 6, $total_ganado->datos->haber_basico, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(20, 6, $total_ganado->datos->bono_antiguedad, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(14, 6, $total_ganado->datos->horas_extra, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(20, 6, $total_ganado->datos->monto_horas_extra, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(20, 6, $total_ganado->datos->suplencia, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(20, 6, $total_ganado->datos->total_ganado, 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');
                $total_seccion = $total_seccion + $total_ganado->datos->total_ganado; //total de bono de toda la seccion
            } else {
                $pdf->MultiCell(245, 6, 'ACEFALIA (CARGO '.$total_ganado->nombre_cargo.')', 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');
            }
            $total_planilla = $total_planilla + $total_seccion;
        }
        $pdf->SetFont('dejavusans', 'B', 5.5);
        $pdf->MultiCell(239, 6, 'TOTAL SECCIÓN '. $key, 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(20, 6, Funciones::formatMoney($total_seccion), 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');
    }
    $pdf->MultiCell(239, 6, 'TOTAL GANADO DEL MES', 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(20, 6, Funciones::formatMoney($total_planilla), 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');
} else {
    $pdf->MultiCell(194, 6, 'No existen registros', 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
}
$pdf->Output('Planilla_Asistencia_Periodo_' . $mes . '_' . $gestion . '.pdf', 'I');
