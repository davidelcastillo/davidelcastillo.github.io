<?php

session_start();
include("../server/connection.php");

if(isset($_POST["order_detail"]) && isset($_POST['order_id']) ) {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare('SELECT * FROM order_items WHERE order_id=?');
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $order_details = $stmt->get_result();

    $order_total_price = calculateTotalOrderPrice($order_details) ;
}else{
    header('location : Account.php');
    exit();
}

function calculateTotalOrderPrice($order_details) {
    $total = 0;

    foreach($order_details as $row ){
        $product_price = $row['product_price'];

        $total = $total + $product_price;
    }
  
    return $total;
}


?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <title>Order Detail</title>
    <link rel="stylesheet" href="">
    <link rel="icon" type="image/x-icon" href="../asset/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/Order_detail.css">
    <link rel="stylesheet" href="../css/Header.css">
    <link rel="stylesheet" href="../css/Footer.css">

</head>

<?php  
    include('../layouts/header-php.php');
?>
    <section class="main_section">
        <div class="title">
            <h1>
                Order Detail
            </h1>
        </div>
        <section class="info_section">
            <div id="orders" class="info_conteiner">
                <div class="order_conteiner" > 
                    <h4>
                        Order N° <?php echo $order_id ?>
                    </h4>
                    <table class="table table-dark table-borderless" style="background-color: rgba(0, 0, 0, 0); align-items: center;">
                        <thead>
                            <tr>
                            <th scope="col"><h5>Product</h5></th>
                            <th scope="col"><h5>Price</h5></th>
                            </tr>
                        </thead>
                        <tbody class="table-active" >
                            <?php foreach( $order_details as $row ){ ?>
                            <tr>
                                <td>
                                    <div class="product-info">
                                        <img src="../img/<?php echo $row['product_image']; ?>" alt="">
                                        <div>
                                            <h6><?php echo $row['product_name']; ?></h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div><h6>$<?php echo $row['product_price']; ?>.00</h6></div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <?php if($order_status == 'not paid') { ?>

                    <form method="POST" action="Payment.php" style="float: right; display: flex ; justify-content :right;">
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" >
                        <input type="hidden" name="order_total_price" value="<?php echo $order_total_price; ?>" >
                        <input type="hidden" name="order_status" value="<?php echo $order_status; ?>" >
                        <input type="submit" name="order_pay" class="btn pay-btn" value="Pay Now">
                    </form>

                    <?php } ?>

                </div>
            </div>
        </section>
    </section>
<?php  
    include('../layouts/footer-php.php');
?>