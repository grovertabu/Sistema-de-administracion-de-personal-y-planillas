<?php
use App\Utils\Pdf;

$pdf = new Pdf('PLANILLA DE OTROS DESCUENTOS', 'Periodo ' . $mes . '/' . $gestion, 'RRHH', 'P', true, true);

$pdf->SetFillColor(230, 230, 230);
$pdf->RoundedRect(10, 6, $pdf->getPageWidth() - 20, 30, 2.5, '1111');

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(230, 230, 230);

$pdf->AddPage();

$pdf->SetY(40);
$pdf->SetFont('dejavusans', 'B', 5);
$pdf->SetFillColor(230, 230, 230);
$pdf->MultiCell(10, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(50, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(10, 6, 'SINDICALIZADO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(15, 6, 'HABER BASICO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(15, 6, 'TOTAL GANADO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(80, 6, 'DESCRIPCIÓN', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(15, 6, 'MONTO DESC.', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
$total_monto = 0;
if ($otro_descuentos->count() > 0) {
    foreach ($otro_descuentos as $key => $otro_descuento) {
        // $h_seccion = ceil($pdf->getStringHeight(35, trim($cargo->seccion), $reseth = true, $autopadding = true, $border = 1));

        if ($pdf->GetY() + 6 > $pdf->getPageHeight() - 12) {
            $pdf->AddPage();
            $pdf->SetY(15);
            $pdf->SetFont('dejavusans', 'B', 6);
            $pdf->SetFillColor(230, 230, 230);
            $pdf->MultiCell(10, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(50, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(10, 6, 'SINDICALIZADO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(15, 6, 'HABER BASICO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(15, 6, 'TOTAL GANADO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(80, 6, 'DESCRIPCIÓN', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(15, 6, 'MONTO DESC.', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
        }
        $pdf->SetFont('dejavusans', '', 6);
        $pdf->SetFillColor(220, 220, 220);
        $pdf->MultiCell(10, 6, $otro_descuento->item, 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(50, 6, $otro_descuento->nombre_completo, 1, 'L', '', '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(10, 6, $otro_descuento->sindicalizado, 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(15, 6, Funciones::formatMoney($otro_descuento->haber_basico), 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(15, 6, Funciones::formatMoney($otro_descuento->total_ganado), 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(80, 6, $otro_descuento->od_descripcion, 1, 'L', '', '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(15, 6, Funciones::formatMoney($otro_descuento->od_monto), 1, 'C', '', 1, '', '', 1, '', '', '', 6, 'M');
        $total_monto = $total_monto + $otro_descuento->od_monto;
    }
    $pdf->SetFont('dejavusans', 'B', 6);
    $pdf->MultiCell(180, 6, 'TOTAL', 1, 'C', '', '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(15, 6, Funciones::formatMoney($total_monto), 1, 'C', '', 1, '', '', 1, '', '', '', 6, 'M');
} else {
    $pdf->MultiCell(195, 6, 'No existen registros', 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
}
$pdf->Output('Planilla_otro_descuentos_Periodo_' . $mes . '_' . $gestion . '.pdf', 'I');
