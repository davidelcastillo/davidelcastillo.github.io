<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../server/connection.php');
if (isset($_POST['create_btn'])) {
    $user_name = $_POST['name'];
    $user_email = $_POST['email'];
    $user_phone = $_POST['phone'];
    $user_password = $_POST['password'];

    //create a new user
    $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_phone, user_password)
                                 VALUES (?, ?, ?, ?)");
                                   

    $stmt->bind_param('ssis', $user_name,$user_email,$user_phone,md5($user_password));
    if ($stmt->execute()) {
    header('location: products.php?product_created=Product has been created successfully');
    }else{
    header('location: products.php?product_failed=Error occured, try again');
    }

}

?>