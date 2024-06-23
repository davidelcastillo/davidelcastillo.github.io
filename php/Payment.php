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

            <?php if(isset($_POST['order_status']) &&  $_POST['order_status'] == 'not paid') { ?>
                <?php $amount = strval( $_POST['order_total_price']);  ?>
                <?php $order_id = $_POST['order_id'];  ?>
                <p>Total payment: $<?php echo $_POST['order_total_price'];  ?> </p>
                <!-- <input class="btn pay-btn" value="Pay Now" type="submit" /> -->
                <div id="paypal-button-container"></div>
                <p id="result-message"></p>

            <?php } else if(isset($_SESSION['total']) && $_SESSION['total'] != 0)  { ?>
                <?php $amount = strval( $_SESSION['total']);  ?>
                <?php $order_id = $_SESSION['order_id'];  ?>
                <p>Total payment: $<?php echo $_SESSION['total'];  ?> </p>
                <!-- <input class="btn pay-btn" value="Pay Now" type="submit" /> -->
                <div id="paypal-button-container"></div>
                <p id="result-message"></p>
            <?php }else { ?>
                <p> You don't have an order</p>
            <?php } ?>
        </div>  
    </section>
    
</div>
<script src="https://www.paypal.com/sdk/js?client-id=AQJ4I02WCe1Fz8Vo2xNJOo-iat61GZw4NM4by1fFVWnrMtf33cq3_5r01DwBPy-c0PHt8uo6xEceirCV&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
<script>
    function initPayPalButton() {
        paypal.Buttons({
            style: {
                shape: 'pill',
                color: 'silver',
                layout: 'vertical',
                label: 'pay',
            },

            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        "amount":
                        {"currency_code": "USD", "value": <?php echo $amount ?>}}]
                });
            },

            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {

                    // Full available details
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction =orderData.purchase_units[0].payments.captures[0];
                    alert('Transaction ' + transaction.status + ': ' + transaction.id )
    

                    // // Show a success message within this page, for example:
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '';
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';

                    // Or go to another URL:  actions.redirect('thank_you.html');
                    window.location.href = "../server/complete_payment.php?transaction_id="+transaction.id+"&order_id="+<?php echo $order_id; ?>;

                });
            },

            onError: function(err) {
                console.log(err);
            }
        }).render('#paypal-button-container');
    }
    initPayPalButton();
</script>

<?php  
    include('../layouts/footer-php.php');
?>