<?php
use App\Utils\Pdf_papeleta;
// use App\Utils\Papeleta_pdf;

$pdf = new Pdf_papeleta('PAPELETA DE PAGO ', '', '', 'L', true, true);


$mes = $nombre_planilla->mes;
$gestion = $nombre_planilla->gestion;


$pdf->AddPage();

//$pdf->MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
if ($registros->count() > 0) {
    $paginas = $registros->count();
    $pag=0;
    foreach ($registros as $planilla) {
        // dd($planilla);
        $pdf->SetY(40);
        $pdf->setX(20);
        $pdf->SetFont('dejavusans', 'B', 8);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->MultiCell(120, 7, 'PAPELETA DE PAGO DE HABERES', 1, 'C', 1, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(120, 7, mb_strtoupper(' Correspondiente a ' . Funciones::getMes($mes) . ' ' . $gestion), 1, 'C', 1, 1, '', '', 1, '', '', '', 7, 'M');

        $pdf->setX(20);
        $pdf->MultiCell(40, 7, 'ITEM:', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(80, 7, $planilla->item, 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', 'B', 8);
        $pdf->MultiCell(65, 7, 'FECHA INGRESO:', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(55, 7, Funciones::formatDate($planilla->fecha_ingreso), 1, 'L', 0, 1, '', '', 1, '', '', '', 7, 'M');

        $pdf->setX(20);
        $pdf->SetFont('dejavusans', 'B', 8);
        $pdf->MultiCell(40, 7, 'NOMBRE:', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(80, 7, mb_strtoupper($planilla->nombres . ' ' . $planilla->apellidos), 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', 'B', 8);
        $pdf->MultiCell(65, 7, 'NRO. ASEGURADO:', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(55, 7, $planilla->nua, 1, 'L', 0, 1, '', '', 1, '', '', '', 7, 'M');

        $pdf->setX(20);
        $pdf->SetFont('dejavusans', 'B', 8);
        $pdf->MultiCell(40, 7, 'SECCION:', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(80, 7, $planilla->seccion, 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', 'B', 8);
        $pdf->MultiCell(65, 7, 'DIAS TRABAJADOS:', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(55, 7, $planilla->dias_pagados, 1, 'L', 0, 1, '', '', 1, '', '', '', 7, 'M');

        $pdf->setX(20);
        $pdf->SetFont('dejavusans', 'B', 8);
        $pdf->MultiCell(40, 7, 'CARGO:', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(80, 7, $planilla->cargo, 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', 'B', 8);
        $pdf->MultiCell(65, 7, 'DIAS FALTA:', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(55, 7, (30 - $planilla->dias_pagados), 1, 'L', 0, 1, '', '', 1, '', '', '', 7, 'M');

        $pdf->setX(20);
        $pdf->SetFont('dejavusans', 'B', 8);
        $pdf->MultiCell(40, 7, 'CATEGORIA:', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(80, 7, $planilla->porcentaje.'%', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', 'B', 8);
        $pdf->MultiCell(65, 7, 'FECHA DE PAGO:', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(55, 7, Funciones::formatDate($planilla->fecha_aprobado), 1, 'L', 0, 1, '', '', 1, '', '', '', 7, 'M');

        $pdf->setX(20);
        $pdf->SetFont('dejavusans', 'B', 8);
        $pdf->SetFillColor(230, 230, 230);
        $pdf->MultiCell(120, 7, 'INGRESOS', 1, 'C', 1, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(120, 7, 'DESCUENTOS', 1, 'C', 1, 1, '', '', 1, '', '', '', 7, 'M');

        $pdf->setX(20);
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(40, 7, 'Haber Básico', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(80, 7, Funciones::formatMoney($planilla->haber_basico), 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(65, 7, 'Descuento RC-IVA ', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(55, 7, Funciones::formatMoney($planilla->desc_rciva), 1, 'L', 0, 1, '', '', 1, '', '', '', 7, 'M');

        $pdf->setX(20);
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(40, 7, 'Horas Trabajo Nocturno', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(80, 7, Funciones::formatMoney($planilla->ht_nocturna), 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(65, 7, 'Capitalizacion Individual ', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(55, 7,  Funciones::formatMoney($planilla->categoria_individual), 1, 'L', 0, 1, '', '', 1, '', '', '', 7, 'M');

        $pdf->setX(20);
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(40, 7, 'Horas Extras Nocturnas', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(80, 7, Funciones::formatMoney($planilla->he_nocturno), 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(65, 7, 'Muerte Invalidez Riesgos ', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(55, 7, Funciones::formatMoney($planilla->prima_riesgo_comun), 1, 'L', 0, 1, '', '', 1, '', '', '', 7, 'M');

        $pdf->setX(20);
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(40, 7, 'Horas Extras', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(80, 7, Funciones::formatMoney($planilla->he), 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(65, 7, 'Comisión AFP', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(55, 7, Funciones::formatMoney($planilla->comision_ente), 1, 'L', 0, 1, '', '', 1, '', '', '', 7, 'M');

        $pdf->setX(20);
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(40, 7, 'Domingos Trabajados', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(80, 7, Funciones::formatMoney($planilla->he_domingos), 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(65, 7, 'Aporte Solidario', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(55, 7, Funciones::formatMoney($planilla->total_aporte_solidario), 1, 'L', 0, 1, '', '', 1, '', '', '', 7, 'M');

        $pdf->setX(20);
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(40, 7, 'Suplencia', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(80, 7, Funciones::formatMoney($planilla->suplencia), 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(65, 7, 'Otros Descuentos ', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(55, 7, Funciones::formatMoney($planilla->otros_descuentos), 1, 'L', 0, 1, '', '', 1, '', '', '', 7, 'M');

        $pdf->setX(20);
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(40, 7, 'Bono Antiguedad', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(80, 7, Funciones::formatMoney($planilla->bono_antiguedad), 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(65, 7, 'Fondo Social ELAPAS', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(55, 7, Funciones::formatMoney($planilla->fondo_social), 1, 'L', 0, 1, '', '', 1, '', '', '', 7, 'M');

        $pdf->setX(20);
        $pdf->SetFont('dejavusans', 'B', 8);
        $pdf->MultiCell(40, 7, 'TOTAL GANADO', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(80, 7, Funciones::formatMoney($planilla->total_ganado), 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(65, 7, 'Fondo de Empleados ELAPAS', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(55, 7, Funciones::formatMoney($planilla->fondo_empleados), 1, 'L', 0, 1, '', '', 1, '', '', '', 7, 'M');

        $pdf->setX(20);
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(120, 21, '', 1, 'L', 0, 0, '', '', 1, '', '', '', 21, 'M');
        $pdf->MultiCell(65, 7, 'Descuento Sindical ', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(55, 7, Funciones::formatMoney($planilla->sindicato), 1, 'L', 0, 1, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', '', 8);
        $pdf->MultiCell(65, 7, 'Descuentos Entidades Financieras', 1, 'L', 0, 0, 140, '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(55, 7, Funciones::formatMoney($planilla->entidades_financieras), 1, 'L', 0, 1, '', '', 1, '', '', '', 7, 'M');
        $pdf->SetFont('dejavusans', 'B', 8);
        $pdf->MultiCell(65, 7, 'TOTAL DESCUENTOS ', 1, 'L', 0, 0, 140, '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(55, 7, Funciones::formatMoney($planilla->total_descuentos), 1, 'L', 0, 1, '', '', 1, '', '', '', 7, 'M');

        $pdf->setX(20);
        $pdf->MultiCell(65, 7, 'LIQUIDO PAGABLE', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(55, 7, Funciones::formatMoney($planilla->liquido_pagable), 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(120, 14, '', 1, 'L', 0, 1, 140, '', 1, '', '', '', 21, 'M');
        $pdf->setX(20);
        $pdf->MultiCell(65, 7, 'SALDO A FAVOR RC-IVA', 1, 'L', 0, 0, $pdf->getX(), $pdf->getY() - 7, 1, '', '', '', 7, 'M');
        $pdf->MultiCell(55, 7, Funciones::formatMoney($planilla->p_saldo_siguiente_mes), 1, 'L', 0, 1, '', '', 1, '', '', '', 7, 'M');
        $pdf->setX(20);
        $pdf->MultiCell(120, 7, '', 1, 'L', 0, 0, '', '', 1, '', '', '', 7, 'M');
        $pdf->MultiCell(120, 7, 'RECIBI CONFORME', 1, 'C', 0, 1, '', '', 1, '', '', '', 7, 'M');
        $pag++;
        if ($pag < $paginas) {
            $pdf->AddPage();
        }
    }
} else {
    $pdf->MultiCell(309, 9, 'No existen registros', 1, 'C', 0, '', '', '', 1, '', '', '', 9, 'M');
}

$pdf->Output('Planilla_pagos.pdf', 'I');
