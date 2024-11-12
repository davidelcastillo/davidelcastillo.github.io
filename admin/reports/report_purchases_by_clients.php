<?php
require('./fpdf.php');
include('../../server/connection.php');

class PDF extends FPDF {
    // Header
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Report: Purchases by Clients', 0, 1, 'C');
        $this->Ln(10);
    }

    // Footer
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }
}

// Create a new PDF instance
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

// Fetch data from the database
$query = "SELECT u.user_id, u.user_name AS client_name, SUM(o.order_cost) AS total_purchases
          FROM orders o
          JOIN users u ON o.user_id = u.user_id
          GROUP BY u.user_id
          ORDER BY total_purchases DESC";
$result = $conn->query($query);

// Output data to PDF
$pdf->Cell(30, 10, 'Client ID', 1);
$pdf->Cell(70, 10, 'Client Name', 1);
$pdf->Cell(40, 10, 'Total Purchases', 1);
$pdf->Ln();

while ($row = $result->fetch_assoc()) {
    $pdf->Cell(30, 10, $row['user_id'], 1);
    $pdf->Cell(70, 10, $row['client_name'], 1);
    $pdf->Cell(40, 10, '$' . number_format($row['total_purchases'], 2), 1);
    $pdf->Ln();
}

// Output the PDF
$pdf->Output('D', 'Report_Purchases_by_Clients.pdf');
?>
