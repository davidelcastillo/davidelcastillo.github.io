<?php include('./header.php') ?>
<?php 
if( isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ? ");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $orders =  $stmt->get_result();
}else if( isset($_POST['edit_btn'])) {

    $order_id = $_POST['order_id'];
    $order_status = $_POST['status'];
    $order_cost = $_POST['cost'];
    $order_date = $_POST['date'];
    $user_phone = $_POST['phone'];
    $user_address = $_POST['address'];

    $stmt2 = $conn->prepare('UPDATE orders 
                                    SET order_status = ?, order_cost = ?, order_date = ?, user_phone = ?, user_address = ?
                                    WHERE order_id = ?'); 
    $stmt2->bind_param('sisisi', $order_status, $order_cost, $order_date, $user_phone, $user_address, $order_id);
    if ($stmt2->execute()) {
        header("Location: ./orders.php?edit_scc=Order has been updated successfully");
    }else {
        header("Location: ./orders.php?edit_fail=Error, try again");
    }

}else {
    header("Location: ./orders.php?msj");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <link rel="icon" type="image/x-icon" href="../asset/favicon.ico">
    <link rel="stylesheet" href="../css/Siderbar.css">
    <link rel="stylesheet" href="./css/edit_product.css">
</head>
<body>
<?php  
    include('../layouts/siderbar.php');
?>
        <div class="main-content">
            <header>
                <h1>Edit Order</h1>
            </header>
            <section class = "main_section" >
                <form class="form" action="edit_order.php" method="POST" >
                    <?php foreach($orders as $order) { ?>

                    <input type="hidden" name="order_id" value="<?php echo $order['order_id'] ?>" />
                    
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="formEntry" >
                                <option value="not paid" <?php if($order['order_status'] == 'not paid') echo 'selected' ?> >Not Paid</option>
                                <option value="paid" <?php if($order['order_status'] == 'paid') echo 'selected' ?> >Paid</option>
                                <option value="shipped" <?php if($order['order_status'] == 'shipped') echo 'selected' ?> >Shipped</option>
                                <option value="delivered" <?php if($order['order_status'] == 'delivered') echo 'selected' ?> >Delivered</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="cost">Cost</label>
                        <input class="name formEntry" value="<?php echo $order['order_cost'] ?>" type="cost" id="cost" name="cost" placeholder="Cost">
                    </div>

                    <div class="form-group">
                        <label for="date">Date</label>
                        <input class="name formEntry" value="<?php echo $order['order_date'] ?>" type="date" id="date" name="date" placeholder="Date">
                    </div>

                    <div class="form-group">
                        <label for="cost">Cost</label>
                        <input class="name formEntry" value="<?php echo $order['order_cost'] ?>" type="cost" id="cost" name="cost" placeholder="Cost">
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input class="name formEntry" value="<?php echo $order['user_phone'] ?>" type="phone" id="phone" name="phone" placeholder="Phone">
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input class="name formEntry" value="<?php echo $order['user_address'] ?>" type="address" id="address" name="address" placeholder="Address">
                    </div>

                    <button name="edit_btn" type="submit" class="submit formEntry">Edit</button>
                    <?php } ?>
                </form>
            </section>
        </div>
    </div>
</body>
</html>
