<?php include('./header.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../asset/favicon.ico">
    <link rel="stylesheet" href="../css/Siderbar.css">
    <link rel="stylesheet" href="./css/reports.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Products</title>
</head>
<body>
<?php  
    include('../layouts/siderbar.php');
?>
        <div class="main-content">
            <header>
                <h1>Reports</h1>
            </header>
            <section class="main-tble">
            <?php 
                if(isset($_GET['report_create'])) { 
            ?>
                    <script>
                        Swal.fire({
                            icon: "success",
                            title: "Report has been created successfully",
                            color: "#6f6d6b",
                            background: "#0f0e0b"
                        });
                    </script>    

            <?php }?>
                <div class="table_conteiner">
                    <form action="./reports/generate_report.php" method="GET">
                        <label for="report">Select Report Type : </label>
                        <select class="formEntry" name="report" id="report">
                            <option class="option" value="purchases_by_clients">Purchases by Clients</option>
                            <option class="option" value="most_sold_products">Most Sold Products</option>
                            <option class="option" value="revenue_by_product">Revenue by Product</option>
                            <option class="option" value="report_inactive_customers">Report Inactive Customers</option>
                            <option class="option" value="sales_by_month">Sales By Month</option>
                        </select>
                        <button class="submit" type="submit">Generate PDF</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
</body>
</html>