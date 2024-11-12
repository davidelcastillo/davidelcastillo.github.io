<?php
require('./fpdf.php');
include('../../server/connection.php');

class PDF extends FPDF {
    function Header() {
        $this->Image('../../img/Gibson_logo_black.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(40);
        $this->Cell(100, 10, 'Gibson - Sales by Month Report', 0, 1, 'C');
        $this->SetFont('Arial', 'I', 12);
        $this->Cell(190, 10, 'Total Sales by Month', 0, 1, 'C');
        $this->Ln(10);
    }
    
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(230, 230, 230);
$pdf->Cell(60, 10, 'Month', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Year', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Total Sales', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 10);
$query = "
    SELECT MONTH(order_date) AS month, YEAR(order_date) AS year, SUM(order_cost) AS total_sales
    FROM orders
    GROUP BY YEAR(order_date), MONTH(order_date)
    ORDER BY year DESC, month DESC";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $pdf->Cell(60, 10, date("F", mktime(0, 0, 0, $row['month'], 10)), 1);
    $pdf->Cell(60, 10, $row['year'], 1);
    $pdf->Cell(60, 10, '$' . number_format($row['total_sales'], 2), 1, 1, 'C');
}

$pdf->Output('D', 'sales_by_month_report.pdf');
?>
