<?php
use App\Utils\Pdf;

$pdf = new Pdf('PLANILLA DESCUENTO LABORAL', 'Periodo ' . $mes . '/' . $gestion, 'RRHH', 'P', true, true);

$pdf->SetFillColor(230, 230, 230);
$pdf->RoundedRect(10, 6, $pdf->getPageWidth() - 20, 30, 2.5, '1111');

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(230, 230, 230);

$pdf->AddPage();

$pdf->SetY(40);
$pdf->SetFont('dejavusans', 'B', 6);
$pdf->SetFillColor(230, 230, 230);
$pdf->MultiCell(13, 6, 'ITEM', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(45, 6, 'TRABAJADOR', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(45, 6, 'CARGO', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(60, 6, 'Nombre Descuento', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(30, 6, 'MONTO DESCUENTO', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');

if ($registros_descuento->count() > 0) {
    $suma_total = 0;
    foreach ($registros_descuento as $registro_ap) {
        $suma_descuentos = 0;
        // $h_seccion = ceil($pdf->getStringHeight(35, trim($cargo->seccion), $reseth = true, $autopadding = true, $border = 1));

        if ($pdf->GetY() + 6 > $pdf->getPageHeight() - 30) {
            $pdf->AddPage();
            $pdf->SetY(15);
            $pdf->SetFont('dejavusans', 'B', 6);
            $pdf->SetFillColor(230, 230, 230);
            $pdf->MultiCell(13, 6, 'ITEM', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(45, 6, 'TRABAJADOR', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(45, 6, 'CARGO', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(60, 6, 'NOMBRE DESCUENTO', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(30, 6, 'MONTO DESCUENTO', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
        }

        $pdf->SetFont('dejavusans', '', 6);
        $pdf->MultiCell(13, 18, $registro_ap->item, 1, 'C', 0, '', '', '', 1, '', '', '', 18, 'M');
        $pdf->MultiCell(45, 18, mb_strtoupper($registro_ap->trabajador->nombre_completo), 1, 'C', 0, '', '', '', 1, '', '', '', 18, 'M');
        $pdf->MultiCell(45, 18, mb_strtoupper($registro_ap->nomina_cargo->cargo->nombre), 1, 'C', 0, '', '', '', 1, '', '', '', 18, 'M');
        foreach ($registro_ap->planilla_descuentos as $p_descuento) {
            $pdf->MultiCell(60, 6, $p_descuento->nombre_descuento, 1, 'C', 0, 0, 113, '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(30, 6, Funciones::formatMoney($p_descuento->monto), 1, 'R', 0, 1, '', '', 1, '', '', '', 6, 'M');
            $suma_descuentos = $suma_descuentos + $p_descuento->monto;
        }
        $pdf->SetFont('dejavusans', 'B', 6);
        $pdf->MultiCell(163, 6, 'TOTAL MONTO DESCUENTO', 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(30, 6, Funciones::formatMoney($suma_descuentos), 1, 'R', 0, 1, '', '', 1, '', '', '', 6, 'M');
        $suma_total = $suma_total + $suma_descuentos;
    }
    $pdf->SetFont('dejavusans', 'B', 6);
    $pdf->MultiCell(163, 6, 'TOTAL DESCUENTOS LABORALES', 1, 'R', '', '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(30, 6, Funciones::formatMoney($suma_total), 1, 'R', '', 1, '', '', 1, '', '', '', 6, 'M');
} else {
    $pdf->MultiCell(193, 6, 'No existen registros', 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
}

$pdf->Output('Planilla_Descuento_Periodo_' . $mes . '_' . $gestion . '.pdf', 'I');
