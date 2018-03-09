<?php
require('assets/api/fpdf.php');
include_once("confg/class.php");

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('assets/images/IbidenLogo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Title',1,0,'C');
    // Line break
    $this->Ln(20);

    $this->SetFont('Times','',12);
    $this->SetTextColor(0,0,0);
    $this->SetFont("Arial","B","10");
    $this->Cell(20,5,"Rec ID",1,0,"C");
    $this->Cell(76,5,"EmployeeRecNo",1,0,"C");
    $this->Cell(26,5,"CompanyID",1,0,"C");
    $this->Cell(26,5,"AgencyID",1,0,"C");
    $this->Cell(26,5,"EmployeeIDNo",1,0,"C");
    $this->Cell(18,5,"BadgeNo",1,0,"C");
    $this->Ln();

}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}

}

    // Instanciation of inherited class
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $db = new MSSQL();
    $result = $db->systemUtility("exec sp_getPrintData");
    while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
        $s0 = $row[0];
        $s1 = $row[1];  
        $s2 = $row[2];
        $s3 = $row[3];
        $s4 = $row[4];
        $s5 = $row[5];

        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont("Arial","B","9");
        $pdf->Cell(20,5,$s0,1,0,"C");
        $pdf->Cell(76,5,$s1,1,0,"L");
        $pdf->Cell(26,5,$s2,1,0,"C");
        $pdf->Cell(26,5,$s3,1,0,"C");
        $pdf->Cell(26,5,$s4,1,0,"C");
        $pdf->Cell(18,5,$s5,1,0,"C");
        $pdf->Ln();
    }

    $pdf->Output();

?>