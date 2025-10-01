<?php
require('fpdf/fpdf.php');
include 'db.php';

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Inventario de Equipos Electronicos', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    function LoadData($sql) {
        global $conn;
        $data = array();
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    function FancyTable($header, $data) {
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $w = array(20, 30, 30, 20, 30, 30);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();
        $this->SetFont('Arial', '', 10);
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row['codigo'], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row['marca'], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row['modelo'], 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, $row['año'], 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, $row['tipo'], 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, $row['serial'], 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$header = array('Codigo', 'Marca', 'Modelo', 'Año', 'Tipo', 'Serial');
$data = $pdf->LoadData("SELECT codigo, marca, modelo, año, tipo, serial FROM equipos");
$pdf->FancyTable($header, $data);
$pdf->Output();
?>