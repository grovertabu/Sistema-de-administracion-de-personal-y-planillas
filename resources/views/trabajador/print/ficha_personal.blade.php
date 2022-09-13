<?php
use App\Utils\Pdf;
$pdf = new Pdf('DIVISIÓN DE PERSONAL', 'FICHA PERSONAL', $usuario, 'P', true, true);

$pdf->SetFillColor(230, 230, 230);
$pdf->RoundedRect(10, 6, $pdf->getPageWidth() - 20, 30, 2.50, '1111');

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(230, 230, 230);

$pdf->AddPage();

$pdf->SetY(38);

$pdf->SetFont('dejavusans', 'B', 10);
$pdf->MultiCell('', 6, '1. DATOS PERSONALES', 1, 'L', 0, 1, '', '', 1, '', '', '', 6, 'M');
// datos personales
$documento_ci = $trabajador->comp == null ? $trabajador->ci : $trabajador->ci.'-'.$trabajador->comp;
$nombre_completo= $trabajador->nombre.' '.$trabajador->apellido_paterno.' '.$trabajador->apellido_materno;

if($trabajador->foto == ""){
    $pdf->Image('images/default-avatar.jpg', 165.5, 46, 38.7,42.5);
}
else {
    $avatar = $trabajador->foto;
    $path = 'private/avatars/' . $avatar;
    $pdf->Image($path, 165.5, 46, 38.7,42.5);
}

$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(50, 9, 'Nombres y Apellidos:', 1, 'L', 1, '', '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(105, 9,' '.mb_strtoupper($nombre_completo), 1, 'L', 0, '', '', '', 1, '', '', '', 9, 'M');
$pdf->MultiCell(40, 9, '', 'R', 'C', 0, 1, '', '', 1, '', '', '', 9, 'M');

$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(50, 9, 'Fecha de Nacimiento:', 1, 'L', 1, '', '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(30, 9,' '.Funciones::formatDate($trabajador->fecha_nacimiento), 1, 'L', 0, '', '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(20, 9, 'Edad:', 1, 'L', 1, '', '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(55, 9,' '.Funciones::calcula_edad($trabajador->fecha_nacimiento), 1, 'L', 0, '', '', '', 1, '', '', '', 9, 'M');
$pdf->MultiCell(40, 9, '', 'R', 'C', 0, 1, '', '', 1, '', '', '', 9, 'M');

$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(50, 9, 'Nacionalidad:', 1, 'L', 1, '', '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(30, 9,' '.$trabajador->nacionalidad, 1, 'L', 0, '', '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(30, 9, 'Estado Civil:', 1, 'L', 1, '', '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(45, 9,' '.Funciones::estadoCivil($trabajador->sexo,$trabajador->estado_civil), 1, 'L', 0, '', '', '', 1, '', '', '', 9, 'M');
$pdf->MultiCell(40, 9, '', 'R', 'C', 0, 1, '', '', 1, '', '', '', 9, 'M');

$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(50, 9, 'Cédula de Identidad:', 1, 'L', 1, '', '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(30, 9,' '.$documento_ci. ' ' . $trabajador->expedido, 1, 'L', 0, '', '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(45, 9, 'Grupo Sanguíneo:', 1, 'L', 1, '', '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(30, 9,' '.$trabajador->tipo_sangre, 1, 'L', 0, '', '', '', 1, '', '', '', 9, 'M');
$pdf->MultiCell(40, 9, '', 'R', 'C', 0, 1, '', '', 1, '', '', '', 9, 'M');

$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(50, 9, 'Telf. Fijo:', 1, 'L', 1, '', '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(30, 9,' '.$trabajador->telefono, 1, 'L', 0, '', '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(45, 9, 'Celular:', 1, 'L', 1, '', '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(30, 9,' '.$trabajador->celular, 1, 'L', 0, '', '', '', 1, '', '', '', 9, 'M');
$pdf->MultiCell(40, 9, '', 'R', 'C', 0, 1, '', '', 1, '', '', '', 9, 'M');


$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(50, 9, 'Dirección:', 1, 'L', 1, '', '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(145, 9,' '.$trabajador->direccion, 1, 'L', 0, 1, '', '', 1, '', '', '', 9, 'M');

$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(50, 9, 'Antiguedad Otras Instancias:', 1, 'L', 1, '', '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(145, 9,' '.Funciones::fecha_text($trabajador->antiguedad_anios, $trabajador->antiguedad_meses, $trabajador->antiguedad_dias), 1, 'L', 0, 1, '', '', 1, '', '', '', 9, 'M');

$pdf->SetY($pdf->GetY() + 8);
$pdf->SetFont('dejavusans', 'B', 10);
$pdf->MultiCell('', 6, '2. FORMACIÓN ACADÉMICA', 1, 'L', 0, 1, '', '', 1, '', '', '', 6, 'M');
$pdf->SetFont('dejavusans', 'B', 9);
$pdf->MultiCell(50, 9, 'Profesión u Oficio:', 1, 'L', 1, '', '', '', 1, '', '', '', 9, 'M');
$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(145, 9,' '.mb_strtoupper($trabajador->profesion), 1, 'L', 0, 1, '', '', 1, '', '', '', 9, 'M');


if($trabajador->asignacion_cargo->count()>0){
    $item = $trabajador->asignacion_cargo[0]->nomina_cargo->tipo_contrato_id == 1 ? '| ITEM: '.$trabajador->asignacion_cargo[0]->nomina_cargo->item : '';
    $pdf->SetY($pdf->GetY() + 8);
    $pdf->SetFont('dejavusans', 'B', 10);
    $pdf->MultiCell('', 6, '3. DATOS LABORALES', 1, 'L', 0, 1, '', '', 1, '', '', '', 6, 'M');
    $pdf->SetFont('dejavusans', 'B', 9);
    $pdf->MultiCell(50, 9, 'Cargo:', 1, 'L', 1, '', '', '', 1, '', '', '', 9, 'M');
    $pdf->SetFont('dejavusans', '', 9);
    $pdf->MultiCell(145, 9,' '.$trabajador->asignacion_cargo[0]->nomina_cargo->cargo->nombre.' '.$item, 1, 'L', 0, 1, '', '', 1, '', '', '', 9, 'M');

    $pdf->SetFont('dejavusans', 'B', 9);
    $pdf->MultiCell(50, 9, 'Salario:', 1, 'L', 1, '', '', '', 1, '', '', '', 9, 'M');
    $pdf->SetFont('dejavusans', '', 9);
    $pdf->MultiCell(30, 9,' '.Funciones::formatMoney($trabajador->asignacion_cargo[0]->nomina_cargo->escala_salarial->salario_mensual), 1, 'L', 0, '', '', '', 1, '', '', '', 9, 'M');
    $pdf->SetFont('dejavusans', 'B', 9);
    $pdf->MultiCell(40, 9, 'Unidad Organizacional:', 1, 'L', 1, '', '', '', 1, '', '', '', 9, 'M');
    $pdf->SetFont('dejavusans', '', 9);
    $pdf->MultiCell(75, 9,' '.$trabajador->asignacion_cargo[0]->nomina_cargo->unidad_organizacional->seccion, 1, 'L', 0, '', '', '', 1, '', '', '', 9, 'M');
    $pdf->MultiCell(40, 9, '', 'R', 'C', 0, 1, '', '', 1, '', '', '', 9, 'M');
}



$pdf->SetY($pdf->GetY() + 90);
$pdf->SetFont('dejavusans', '', 6);
$pdf->MultiCell(65, 4, '', 0, 'C', 0, 0, '', '', 1, 1, 0, 1, 4, 'M');
$pdf->MultiCell(65, 4, '_____________________________________', 0, 'C', 0, 0, '', '', 1, 1, 0, 1, 4, 'M');
$pdf->MultiCell(65, 4, '', 0, 'C', 0, 1, '', '', 1, 1, 0, 1, 4, 'M');
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell(65, 4, '', 0, 'C', 0, 0, '', '', 1, 1, 0, 1, 4, 'M');
$pdf->MultiCell(65, 4, 'FIRMA DEL INTERESADO', 0, 'C', 0, 0, '', '', 1, 1, 0, 1, 4, 'M');
$pdf->MultiCell(65, 4, '', 0, 'C', 0, 1, '', '', 1, 1, 0, 1, 4, 'M');


$pdf->Output('FICHA-PERSONAL-' . $nombre_completo . '.pdf', 'I');
