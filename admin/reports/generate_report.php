<?php
if (isset($_GET['report'])) {
    $report = $_GET['report'];
    switch ($report) {
        case 'purchases_by_clients':
            include('report_purchases_by_clients.php');
            break;
        case 'most_sold_products':
            include('report_most_sold_products.php');
            break;
        case 'revenue_by_product':
            include('report_revenue_by_product.php');
            break;
        case 'report_inactive_customers':
            include('report_inactive_customers.php');
            break;
        case 'sales_by_month':
            include('report_sales_by_month.php');
            break;
        default:
            echo "Invalid report type.";
            break;
    }
}
