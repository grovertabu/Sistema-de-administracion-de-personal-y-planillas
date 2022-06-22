<?php
use App\Utils\Pdf;

$pdf = new Pdf('PLANILLA DE BONO DE ANTIGUEDAD', 'Periodo ' . $mes . '/' . $gestion, 'RRHH', 'P', true, true);

$pdf->SetFillColor(230, 230, 230);
$pdf->RoundedRect(10, 6, $pdf->getPageWidth() - 20, 30, 2.5, '1111');

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(230, 230, 230);

$pdf->AddPage();

$pdf->SetY(40);
$pdf->SetFont('dejavusans', 'B', 6);
$pdf->SetFillColor(230, 230, 230);
$pdf->MultiCell(12, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(50, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(20, 6, 'OTRAS. INST.', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(25, 6, 'FECHA_INGRESO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(25, 6, 'FECHA_CALCULO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(18, 6, 'ANTIGUEDAD', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(22, 6, 'PORCENTAJE', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(20, 6, 'TOTAL BONO', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
if ($cargos->count() > 0) {
    $total_planilla = 0;
    foreach ($cargos as $key => $cargo) {
        // $h_seccion = ceil($pdf->getStringHeight(35, trim($cargo->seccion), $reseth = true, $autopadding = true, $border = 1));
        $h = 6;

        $pdf->SetFont('dejavusans', 'B', 6);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->MultiCell(192, $h, 'SECCIÓN ' . $key, 1, 'C', 1, 1, '', '', 1, '', '', '', $h, 'M');
        $total_seccion = 0;
        foreach ($cargo as $bono_antiguedad) {
            if ($pdf->GetY() + $h > $pdf->getPageHeight() - 15) {
                $pdf->AddPage();
                $pdf->SetY(15);
                $pdf->SetFont('dejavusans', 'B', 6);
                $pdf->SetFillColor(230, 230, 230);
                $pdf->MultiCell(12, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(50, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(20, 6, 'OTRAS. INST.', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(25, 6, 'FECHA_INGRESO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(25, 6, 'FECHA_CALCULO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(18, 6, 'ANTIGUEDAD', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(22, 6, 'PORCENTAJE', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(20, 6, 'TOTAL BONO', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
            }
            $pdf->SetFont('dejavusans', '', 6);
            $pdf->SetFillColor(220, 220, 220);

            if ($bono_antiguedad->estado_asignacion == 'HABILITADO') {
                // dd($bono_antiguedad->datos->nombre_completo);
                $h_cargo = ceil($pdf->getStringHeight(35, trim($bono_antiguedad->datos->cargo), $reseth = true, $autopadding = true, $border = 1));
                $h = max([$h_cargo]) + 2;
                $pdf->MultiCell(12, 9, $bono_antiguedad->item, 1, 'C', 0, '', '', '', 1, '', '', '', 9, 'M');
                $pdf->MultiCell(50, 9, mb_strtoupper($bono_antiguedad->datos->nombre_completo), 1, 'C', 0, '', '', '', 1, '', '', '', 9, 'M');
                $pdf->MultiCell(20, 9, $bono_antiguedad->datos->anios_arrastre . " AÑOS\n" . $bono_antiguedad->datos->meses_arrastre . " MESES \n" . $bono_antiguedad->datos->dias_arrastre . ' DÍAS', 1, 'C', 0, '', '', '', 1, '', '', '', 9, 'M');
                $pdf->MultiCell(25, 9, Funciones::formatDate($bono_antiguedad->datos->fecha_ingreso), 1, 'C', 0, '', '', '', 1, '', '', '', 9, 'M');
                $pdf->MultiCell(25, 9, Funciones::formatDate($bono_antiguedad->datos->fecha_calculo), 1, 'C', 0, '', '', '', 1, '', '', '', 9, 'M');
                $pdf->MultiCell(18, 9, $bono_antiguedad->datos->anios_actual . " AÑOS\n" . $bono_antiguedad->datos->meses_actual . " MESES \n" . $bono_antiguedad->datos->dias_actual . ' DÍAS', 1, 'C', 0, '', '', '', 1, '', '', '', 9, 'M');
                $pdf->MultiCell(22, 9, $bono_antiguedad->datos->porcentaje. ' %', 1, 'C', 0, '', '', '', 1, '', '', '', 9, 'M');
                $pdf->MultiCell(20, 9, Funciones::formatMoney($bono_antiguedad->datos->monto), 1, 'C', 0, 1, '', '', 1, '', '', '', 9, 'M');
                $total_seccion = $total_seccion + $bono_antiguedad->datos->monto; //total de bono de toda la seccion
            } else {
                $pdf->MultiCell(12, 6, $bono_antiguedad->item, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
                $pdf->MultiCell(180, 6, 'ACEFALIA', 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');
            }
            $total_planilla = $total_planilla + $total_seccion;
        }

        $pdf->SetFont('dejavusans', 'B', 6);
        $pdf->MultiCell(172, 6, 'TOTAL SECCIÓN '. $key, 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(20, 6, Funciones::formatMoney($total_seccion), 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');
    }

    $pdf->MultiCell(172, 6, 'TOTAL BONOS DE ANTIGUEDAD DEL MES', 1, 'R', 0, '', '', '', 1, '', '', '', 6, 'M');
    $pdf->MultiCell(20, 6, Funciones::formatMoney($total_planilla), 1, 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');
} else {
    $pdf->MultiCell(194, 9, 'No existen registros', 1, 'C', 0, '', '', '', 1, '', '', '', 9, 'M');
}
$pdf->Output('Planilla_Bono_antiguedad_Periodo_' . $mes . '_' . $gestion . '.pdf', 'I');
