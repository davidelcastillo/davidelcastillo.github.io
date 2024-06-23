<?php 

session_start();

if (isset($_POST["order_pay"])) {
    $order_status = $_POST['order_status'];
    $order_total_price = $_POST['order_total_price']; 
    
}


?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <title>Payment</title>
    <link rel="stylesheet" href="">
    <link rel="icon" type="image/x-icon" href="../asset/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/Payment.css">
    <link rel="stylesheet" href="../css/Header.css">
    <link rel="stylesheet" href="../css/Footer.css">

</head>

<?php  
    include('../layouts/header-php.php');
?>
    <section class="main_section">
        <div class="title">
            <h1>
                Payment
            </h1>
        </div>
        
        <div class="info-container" >

            <?php if(isset($_SESSION['total']) && $_SESSION['total'] != 0)  { ?>
                <p>Total payment: $<?php echo $_SESSION['total'];  ?> </p>
                <input class="btn pay-btn" value="Pay Now" type="submit" />

            <?php } else if(isset($_POST['order_status']) &&  $_POST['order_status'] == 'not paid') { ?>
                <p>Total payment: $<?php echo $_POST['order_total_price'];  ?> </p>
                <input class="btn pay-btn" value="Pay Now" type="submit" />
            <?php }else { ?>
                <p> You don't have an order</p>
            <?php } ?>

        </div>
        
    </section>
<?php  
    include('../layouts/footer-php.php');
?>