<?php

namespace App\Utils;

use TCPDF;

class Pdf_papeleta extends TCPDF
{
    private $subtitle;
    private $username;

    public function __construct($title, $subtitle = '', $username = '', $orientation = 'P', $print_header = false, $print_footer = false, $format = array(215, 279))
    {
        parent::__construct($orientation, 'mm', $format, true, 'utf-8', false);

        $this->SetTitle($title);
        $this->subtitle = $subtitle;
        $this->username = $username;
        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor('Grover Taboada Rodas');
        $this->SetKeywords('Trabajador Elapas');

        $this->SetPrintHeader($print_header);
        $this->SetPrintFooter($print_footer);

        //cambiar margenes
        $this->SetMargins(10, 10, 10, 10);

        //set auto page breaks
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $this->startPageGroup();

        //set image scale factor
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);

        $this->setJPEGQuality(100);
    }

    public function Header()
    {
        $this->SetFillColor(230, 230, 230);
        $this->RoundedRect(10, 6, $this->getPageWidth() - 20, 30, 2.50, '1111');

        $this->Image('images/elapas-logo.png', 26, 7, 16);
        $this->SetY(23);
        $this->SetFont('dejavusans', 'B', 6);
        $this->MultiCell(50, 2, 'Sistema de RRHH', '', 'C', 0, 1, '', '', 1, '', '', '', 8, 'M');
        $this->MultiCell(50, 2, 'EMPRESA LOCAL DE AGUA POTABLE Y ALCANTARILLADO SUCRE', '', 'C', 0, 1, '', '', 1, '', '', '', 8, 'M');

        $this->SetY(14);
        $this->SetFont('dejavusans', 'B', 13);
        $this->MultiCell('', 8, $this->title, 0, 'C', 0, 1, '', '', 1, '', '', '', 9, 'M');
        $this->SetFont('dejavusans', 'B', 10);
        $this->MultiCell('', 10, $this->subtitle, 0, 'C', 0, 1, '', '', 1, '', '', '', 10, 'T');

        $this->SetY(13);
        $this->SetFont('dejavusans', 'B', 7);
        $this->MultiCell(30, 4, '', 0, 'C', 0, 1, $this->getPageWidth() - 45, '', 1, '', '', '', 4, 'M');
        $this->SetFont('dejavusans', 'B', 7);
        $this->SetY($this->GetY() + 1);
        $this->MultiCell(30, 4, 'Fecha de impresión', 0, 'C', '', 1, $this->getPageWidth() - 45, '', 1, '', '', '', 4, 'M');
        $this->SetFont('dejavusans', '', 7);
        $this->MultiCell(30, 4, date('d/m/Y H:i:s'), 0, 'C', '', '', $this->getPageWidth() - 45, '', 1, '', '', '', 4, 'M');
    }

    public function Footer()
    {
        $this->SetY(-10);
        $this->SetFont('dejavusans', 'B', 7);
        $this->MultiCell(130, 4, 'EMPRESA LOCAL DE AGUA POTABLE Y ALCANTARILLADO SUCRE', 'T', 'L', '', '', '', '', 1, '', '', '', 4, 'M');
        $this->MultiCell('', 4, 'Página ' . $this->getGroupPageNo() . ' de ' . $this->getPageGroupAlias(), 'T', 'R', '', 1, '', '', 1, '', '', '', 4, 'M');
    }
}
