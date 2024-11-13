<?php 
include('../admin/header.php');
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: ../admin/login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../asset/favicon.ico">
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="../css/Siderbar.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Dashboard</title>
</head>
<body>
<?php  
    include('../layouts/siderbar.php');
?>
        <div class="main-content">
            <header>
                <h1>Welcome back, <?php if(isset($_SESSION['admin_name'])) {echo $_SESSION['admin_name'];} ?></h1>
            </header>

            <?php 
                if(isset($_GET['admin_log_success'])) { 
            ?>
                <script>
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: " <?php echo $_GET['admin_log_success']; ?> ",
                        showConfirmButton: false,
                        timer: 1500,
                        color: "#6f6d6b",
                        background: "#0f0e0b",

                    });
                </script>
            <?php 
                }
            ?>

            <section class="stats">
                <div class="stat-card">
                    <h3>Pageviews</h3>
                    <p>50.8K</p>
                </div>
                <div class="stat-card">
                    <h3>Monthly Users</h3>
                    <p>23.6K</p>
                </div>
                <div class="stat-card">
                    <h3>New Users</h3>
                    <p>756</p>
                </div>
                <div class="stat-card">
                    <h3>Subscriptions</h3>
                    <p>2.3K</p>
                </div>
            </section>

            <section class="charts">
                <div class="total-revenue">
                    <h3>Total Revenue</h3>
                    <canvas id="revenueChart"></canvas>
                </div>
                <div class="recent-profits">
                    <h3>Recent Profits</h3>
                    <canvas id="profitsChart"></canvas>
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctxRevenue, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Revenue',
                    data: [120, 190, 300, 500, 200, 300, 400],
                    borderColor: 'rgba(108, 93, 211, 1)',
                    backgroundColor: 'rgba(108, 93, 211, 0.2)',
                }]
            }
        });

        const ctxProfits = document.getElementById('profitsChart').getContext('2d');
        const profitsChart = new Chart(ctxProfits, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Profits',
                    data: [100, 150, 250, 400, 180, 250, 350],
                    backgroundColor: 'rgba(108, 93, 211, 0.8)',
                }]
            }
        });
    </script>
</body>
</html>