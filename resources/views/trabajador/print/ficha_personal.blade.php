<?php
use App\Utils\Pdf;
$pdf = new Pdf('FICHA DE PERSONAL', 'ELAPAS', $usuario, 'P', true, true);

$pdf->SetFillColor(230, 230, 230);
$pdf->RoundedRect(10, 6, $pdf->getPageWidth() - 20, 30, 2.50, '1111');

$pdf->setAutoPageBreak(false);
$pdf->SetFillColor(230, 230, 230);

$pdf->AddPage();

$pdf->SetY(38);

$pdf->SetFont('dejavusans', 'B', 10);
$pdf->MultiCell('', 6, '1. Datos personales', 1, 'L', 0, 1, '', '', 1, '', '', '', 6, 'M');
// datos personales
$documento_ci = $trabajador->comp == null ? $trabajador->ci : $trabajador->ci.'-'.$trabajador->comp;
$nombre_completo= $trabajador->nombre.' '.$trabajador->apellido_paterno.' '.$trabajador->apellido_materno;

if($trabajador->foto == ""){
    $pdf->Image('images/default-avatar.jpg', 165.5, 45, 38.7,42.5);
}
else {
    $avatar = $trabajador->foto;
    $path = 'private/avatars/' . $avatar;
    $pdf->Image($path, 165.5, 45, 38.7,42.5);
}

$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell(55, 5, 'NOMBRE', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(50, 5, 'APELLIDO PATERNO', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(50, 5, 'APELLIDO MATERNO', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(40, 5, '', 'R', 'C', 0, 1, '', '', 1, '', '', '', 5, 'M');

$pdf->SetFont('dejavusans', '', 9);

$pdf->MultiCell(55, 6, mb_strtoupper($trabajador->nombre), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(50, 6, mb_strtoupper($trabajador->apellido_paterno), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(50, 6, mb_strtoupper($trabajador->apellido_materno), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(40, 6, '', 'R', 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');

$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell(40, 5, 'CARNET IDENTIDAD', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(40, 5, 'NRO ASEGURADO', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(40, 5, 'TIPO DE SANGRE', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(35, 5, 'SEXO', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(40, 5, '', 'R', 'C', 0, 1, '', '', 1, '', '', '', 5, 'M');

$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(40, 6, $documento_ci . ' ' . $trabajador->expedido, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(40, 6, $trabajador->nro_asegurado, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(40, 6, $trabajador->tipo_sangre, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(35, 6, Funciones::genero($trabajador->sexo), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(40, 6, '', 'R', 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');

$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell(40, 5, 'NACIONALIDAD', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(40, 5, 'FECHA DE NACIMIENTO', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(75, 5, 'ESTADO CIVIL', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(40, 5, '', 'R', 'C', 0, 1, '', '', 1, '', '', '', 5, 'M');

$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(40, 6, $trabajador->nacionalidad, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(40, 6, Funciones::formatDate($trabajador->fecha_nacimiento), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(75, 6, Funciones::estadoCivil($trabajador->sexo,$trabajador->estado_civil), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(40, 6, '', 'R', 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');


$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell(40, 5, 'MÓVIL', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(40, 5, 'TELÉFONO', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(75, 5, 'DIRECCIÓN', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(40, 5, '', 'R', 'C', 0, 1, '', '', 1, '', '', '', 5, 'M');


$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(40, 6, $trabajador->celular, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(40, 6, $trabajador->telefono, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(75, 6, $trabajador->direccion, 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
$pdf->MultiCell(40, 6, '', 'BR', 'C', 0, 1, '', '', 1, '', '', '', 6, 'M');

$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell(60.9, 5, 'AÑOS DE ANTIGUEDAD', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(67, 5, 'MESES DE ANTIGUEDAD', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(67, 5, 'DÍAS DE ANTIGUEDAD', 1, 'C', 1, 1, '', '', 1, '', '', '', 5, 'M');

$pdf->SetFont('dejavusans', '', 9);
$pdf->MultiCell(60.9, 5, $trabajador->antiguedad_anios, 1, 'C', 0, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(67, 5, $trabajador->antiguedad_meses, 1, 'C', 0, '', '', '', 1, '', '', '', 5, 'M');
$pdf->MultiCell(67, 5, $trabajador->antiguedad_dias, 1, 'C', 0, '', '', '', 1, '', '', '', 5, 'M');

if($trabajador->formacion_academicas->count()>0){
    $pdf->SetY($pdf->GetY() + 8);
    $pdf->SetFont('dejavusans', 'B', 10);
    $pdf->MultiCell('', 6, '2. Formación académica', 1, 'L', 0, 1, '', '', 1, '', '', '', 6, 'M');
    $pdf->SetFont('dejavusans', 'B', 8);
    $pdf->MultiCell(40, 5, 'NIVEL DE EDUCACIÓN', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
    $pdf->MultiCell(115, 5, 'PROFESIÓN', 1, 'C', 1, '', '', '', 1, '', '', '', 5, 'M');
    $pdf->MultiCell(40, 5, 'FECHA DE EMISIÓN', 1, 'C', 1, 1, '', '', 1, '', '', '', 5, 'M');

    $pdf->SetFont('dejavusans', '', 9);
    foreach ($trabajador->formacion_academicas as $formacion_academica) {
        $pdf->MultiCell(40, 6, mb_strtoupper($formacion_academica->nivel_formacion), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(115, 6, mb_strtoupper($formacion_academica->titulo_formacion), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
        $pdf->MultiCell(40, 6, Funciones::formatDate($formacion_academica->fecha_emision), 1, 'C', 0, '', '', '', 1, '', '', '', 6, 'M');
    }

}


$pdf->SetY($pdf->GetY() + 20);
$pdf->SetFont('dejavusans', '', 6);
$pdf->MultiCell(65, 4, '', 0, 'C', 0, 0, '', '', 1, 1, 0, 1, 4, 'M');
$pdf->MultiCell(65, 4, '_____________________________________', 0, 'C', 0, 0, '', '', 1, 1, 0, 1, 4, 'M');
$pdf->MultiCell(65, 4, '', 0, 'C', 0, 1, '', '', 1, 1, 0, 1, 4, 'M');
$pdf->SetFont('dejavusans', 'B', 8);
$pdf->MultiCell(65, 4, '', 0, 'C', 0, 0, '', '', 1, 1, 0, 1, 4, 'M');
$pdf->MultiCell(65, 4, 'FIRMA DEL INTERESADO', 0, 'C', 0, 0, '', '', 1, 1, 0, 1, 4, 'M');
$pdf->MultiCell(65, 4, '', 0, 'C', 0, 1, '', '', 1, 1, 0, 1, 4, 'M');


$pdf->Output('Ficha-Afiliación-' . '1' . '-' . '123' . '.pdf', 'I');
