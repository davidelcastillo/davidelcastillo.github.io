<?php
require('./fpdf.php');
include('../../server/connection.php');

class PDF extends FPDF {
    function Header() {
        $this->Image('../../img/Gibson_logo_black.png', 10, 6, 30);
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(40);
        $this->Cell(100, 10, 'Gibson - Inactive Customers Report', 0, 1, 'C');
        $this->SetFont('Arial', 'I', 12);
        $this->Cell(190, 10, 'List of Customers with No Recent Orders', 0, 1, 'C');
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
$pdf->Cell(60, 10, 'Customer Name', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Customer Email', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Last Order Date', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 10);
$query = "
    SELECT u.user_name, u.user_email, MAX(o.order_date) AS last_order_date
    FROM users u
    LEFT JOIN orders o ON u.user_id = o.user_id
    GROUP BY u.user_id
    HAVING last_order_date IS NULL OR last_order_date < DATE_SUB(NOW(), INTERVAL 1 YEAR)
    ORDER BY last_order_date DESC";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $pdf->Cell(60, 10, $row['user_name'], 1);
    $pdf->Cell(60, 10, $row['user_email'], 1);
    $pdf->Cell(60, 10, $row['last_order_date'] ? $row['last_order_date'] : 'N/A', 1, 1, 'C');
}

$pdf->Output('D', 'inactive_customers_report.pdf');
header('Location: ../../pages/admin/reports.php?report_create');
?>
