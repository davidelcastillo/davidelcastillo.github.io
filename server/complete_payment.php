<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
include("./connection.php");

if(isset($_GET["transaction_id"]) && isset($_GET["order_id"])) {

    $order_id = $_GET["order_id"];
    $order_status = "paid";
    $transaction_id = $_GET["transaction_id"];
    $user_id = $_SESSION['user_id'];
    $payment_date = date("Y-m-d H:i:s");

    //change order status to paid

    $stmt = $conn->prepare('UPDATE orders SET order_status = ?
                            WHERE order_id = ?'); 
    $stmt->bind_param('ss', $order_status, $order_id);

    $stmt->execute();

    //change product stock
    $stmt3 = $conn->prepare('UPDATE products p 
                            INNER JOIN order_items oi ON oi.product_id = p.product_id
                            INNER JOIN orders o ON o.order_id = oi.order_id
                            SET p.product_stock = p.product_stock -1
                            WHERE o.order_id = ?'); 
    $stmt3->bind_param('i', $order_id);

    $stmt3->execute();

    // store payment info

    $stmt1 = $conn->prepare("INSERT INTO payments (order_id,user_id,transaction_id,payment_date)
                    VALUES (?,?,?,?);");

    $stmt1->bind_param('iiss', $order_id, $user_id, $transaction_id,$payment_date);

    $stmt1->execute();

    // send confirmation email

    $user_email = $_SESSION['user_email'];
    $message = 'Your order N° : ' . strval( $order_id ) . ' Has been successfully paid. Thanks you And Lets Rock!!' ;

    require '../phpmailer/src/Exception.php';
    require '../phpmailer/src/PHPMailer.php';
    require '../phpmailer/src/SMTP.php';

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'gibsonlenguajes@gmail.com';
    $mail->Password = 'kqtkgdodkivkibup';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('gibsonlenguajes@gmail.com');

    $mail->addAddress($user_email);

    $mail->isHTML(true);

    $mail->Subject = 'Payment Successfully';

    $mail->Body = $message;

    $mail->send();

    // gotto user accnt

    header('Location: ../php/Account.php?payment_message=Paid successfully, Thanks for rock with us!');
} else {
    header('Location: ../index.php');
    exit();
}






?>