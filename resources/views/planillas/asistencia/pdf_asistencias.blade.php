<?php
use App\Utils\Pdf;

$pdf = new Pdf('PLANILLA DE ASISTENCIA', 'Periodo '. $mes.'/'.$gestion, 'grover', 'P', true, true);

$pdf->SetFillColor(230, 230, 230);
$pdf->RoundedRect(10, 6, $pdf->getPageWidth() - 20, 30, 2.50, '1111');

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(230, 230, 230);

$pdf->AddPage();

$pdf->SetY(40);
$pdf->SetFont('dejavusans', 'B', 6);
$pdf->SetFillColor(230, 230, 230);
$pdf->MultiCell(15, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(57, 6, 'CARGO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(52, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(35, 6, 'DÍAS LABORALES', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(35, 6, 'DÍAS TRABAJADOS', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
if($cargos->count() > 0){
foreach ($cargos as $key => $cargo) {
    // $h_seccion = ceil($pdf->getStringHeight(35, trim($cargo->seccion), $reseth = true, $autopadding = true, $border = 1));
    $h = 6;

    $pdf->SetFont('dejavusans', 'B', 6);
    $pdf->MultiCell(194, $h, 'SECCIÓN '.$key, 1, 'C', 0, 1, '', '', 1, '', '', '', $h, 'M');

    foreach ($cargo as $asistencia){
        if ($pdf->GetY() + $h > $pdf->getPageHeight() - 12) {
        $pdf->AddPage();
        $pdf->SetY(15);
        $pdf->SetFont('dejavusans', 'B', 6);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->MultiCell(15, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(57, 6, 'CARGO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(52, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(35, 6, 'DÍAS LABORALES', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(35, 6, 'DÍAS TRABAJADOS', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
    }
        $pdf->SetFont('dejavusans', '', 6);
        $pdf->SetFillColor(220, 220, 220);
        $pdf->MultiCell(15, 6, $asistencia->item, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
        if($asistencia->estado_asignacion == "HABILITADO"){
            // dd($asistencia->datos->nombre_completo);
            $h_cargo = ceil($pdf->getStringHeight(35, trim($asistencia->datos->cargo), $reseth = true, $autopadding = true, $border = 1));
            $h = max(array($h_cargo)) + 2;
            $pdf->MultiCell(57, 6, $asistencia->datos->cargo, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(52, 6, mb_strtoupper($asistencia->datos->nombre_completo), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(35, 6, $asistencia->datos->dias_asistencia, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(35, 6, $asistencia->datos->dias_laborales, 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');
        }
        else {
            $pdf->MultiCell(179, 6, 'ACEFALIA', 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');
        }
    }
}
}
else{
    $pdf->MultiCell(194, 6, 'No existen registros', 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
}
$pdf->Output('Planilla_Asistencia_Periodo_'. $mes.'_'.$gestion. '.pdf', 'I');
