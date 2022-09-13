<?php
use App\Utils\Pdf;

$pdf = new Pdf('REPORTE DE ' . $nombre_tipo, $estado . 'S', 'RRHH', 'L', true, true);

$pdf->SetFillColor(230, 230, 230);
$pdf->RoundedRect(10, 6, $pdf->getPageWidth() - 20, 30, 2.5, '1111');

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(230, 230, 230);

$pdf->AddPage();

$salto_linea = $estado=='INHABILITADO' ? 0 : 1;

$pdf->SetY(40);
$pdf->SetFont('dejavusans', 'B', 5);
$pdf->SetFillColor(230, 230, 230);
$pdf->MultiCell(19, 6, 'FECHA INGRESO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
if ($estado == 'INHABILITADO' || $tipo_contrato_id!=1) {
    $pdf->MultiCell(20, 6, 'FECHA CONCLUSIÓN', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
}
if ($tipo_contrato_id == 1) {
    $pdf->MultiCell(10, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
}

$pdf->MultiCell(25, 6, 'DOCUMENTO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(50, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
if($estado== 'HABILITADO'){
    $pdf->MultiCell(50, 6, 'CARGO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
}
$pdf->MultiCell(20, 6, 'SALARIO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(18, 6, 'APORTE AFP', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(18, 6, 'SINDICALIZADO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(18, 6, 'SOCIO FE', 1, 'C',1, $salto_linea, '', '', 1, '', '', '', 6, 'M');
if($estado== 'INHABILITADO'){
    $pdf->MultiCell(62, 6, 'MOTIVO DE BAJA', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
}
if ($contratos->count() > 0) {
    foreach ($contratos as $contrato) {

        // $h_seccion = ceil($pdf->getStringHeight(20, trim($cargo->seccion), $reseth = true, $autopadding = true, $border = 1));
        $h = 6;
        $pdf->SetFillColor(230, 230, 230);
        if ($pdf->GetY() + $h > $pdf->getPageHeight() - 12) {
            $pdf->AddPage();
            $pdf->SetY(15);
            $pdf->SetFont('dejavusans', 'B', 5);
            $pdf->SetFillColor(230, 230, 230);
            $pdf->MultiCell(19, 6, 'FECHA INGRESO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');

            if ($estado == 'INHABILITADO' || $tipo_contrato_id!=1) {
                $pdf->MultiCell(20, 6, 'FECHA CONCLUSIÓN', 1, 'C', 1, 0, '', '', 1, '', '', '', 6, 'M');
            }
            if ($tipo_contrato_id == 1) {
                $pdf->MultiCell(10, 6, 'ITEM', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            }
            $pdf->MultiCell(25, 6, 'DOCUMENTO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(50, 6, 'TRABAJADOR', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            if($estado== 'HABILITADO'){
                $pdf->MultiCell(50, 6, 'CARGO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            }
            $pdf->MultiCell(20, 6, 'SALARIO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(18, 6, 'APORTE AFP', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(18, 6, 'SINDICALIZADO', 1, 'C', 1, '', '', '', 1, '', '', '', 6, 'M');
            $pdf->MultiCell(18, 6, 'SOCIO FE', 1, 'C', 1, $salto_linea, '', '', 1, '', '', '', 6, 'M');
            if($estado== 'INHABILITADO'){
                $pdf->MultiCell(62, 6, 'MOTIVO DE BAJA', 1, 'C', 1, 1, '', '', 1, '', '', '', 6, 'M');
            }
        }
        $nombre_completo = $contrato->trabajador->nombre . ' ' . $contrato->trabajador->apellido_paterno . ' ' . $contrato->trabajador->apellido_materno;
        $cargo = $estado == 'INHABILITADO' ? "\n CARGO: ".$contrato->nomina_cargo->cargo->nombre : '';
        $pdf->SetFont('dejavusans', '', 5);
        $pdf->SetFillColor(220, 220, 220);
        $pdf->MultiCell(19, 6, $contrato->fecha_ingreso->format('d-m-Y'), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
        if ($estado == 'INHABILITADO' || $tipo_contrato_id !=1) {
            $pdf->MultiCell(20, 6, $contrato->fecha_conclusion->format('d-m-Y'), 1, 'C', 0, 0, '', '', 1, '', '', '', 6, 'M');
        }
        if ($tipo_contrato_id == 1) {
            $pdf->MultiCell(10, 6, $contrato->nomina_cargo->item, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
        }

        $pdf->MultiCell(25, 6, $contrato->trabajador->ci, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(50, 6, mb_strtoupper($nombre_completo).$cargo, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
        if($estado== 'HABILITADO'){
            $pdf->MultiCell(50, 6, $contrato->nomina_cargo->cargo->nombre, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
        }
        $pdf->MultiCell(20, 6, Funciones::formatMoney($contrato->nomina_cargo->escala_salarial->salario_mensual), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(18, 6, $contrato->aporte_afp, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(18, 6, $contrato->sindicato, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(18, 6, $contrato->socio_fe, 1, 'C', 0, $salto_linea, '', '', 1, '', '', '', 6, 'M');
        if($estado== 'INHABILITADO'){
            $pdf->MultiCell(62, 6, $contrato->motivo_baja, 1, 'L', 0, 1, '', '', 1, '', '', '', 6, 'M');
        }
    }
} else {
    if ($tipo_contrato_id == 1) {
        $pdf->MultiCell(238, 6, 'No existen registros', 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
    } else {
        $pdf->MultiCell(248, 6, 'No existen registros', 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
    }
}
$pdf->Output('Reporte_contratos' . $nombre_tipo . 'pdf', 'I');
