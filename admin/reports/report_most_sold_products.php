<?php
require('./fpdf.php');
include('../../server/connection.php');

class PDF extends FPDF {
    function Header() {
        $this->Image('../../img/Gibson_logo_black.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(40);
        $this->Cell(100, 10, 'Gibson - Most Sold Products Report', 0, 1, 'C');
        $this->SetFont('Arial', 'I', 12);
        $this->Cell(190, 10, 'List of Most Frequently Sold Products', 0, 1, 'C');
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
$pdf->Cell(120, 10, 'Product Name', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Total Sold', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 10);
$query = "
    SELECT p.product_name, SUM(oi.product_price) AS total_sold
    FROM products p
    JOIN order_items oi ON p.product_id = oi.product_id
    GROUP BY p.product_id
    ORDER BY total_sold DESC";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $pdf->Cell(120, 10, $row['product_name'], 1);
    $pdf->Cell(40, 10, $row['total_sold'], 1, 1, 'C');
}

$pdf->Output('D', 'most_sold_products_report.pdf');
?>
