<?php

session_start();

include('../server/connection.php'); 

if(isset($_SESSION['logged_in'])){
    header('location: Account.php');
    exit();
}else {

}

if (isset($_POST['login_btn'])) {

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare('SELECT user_id,user_name,user_email,user_phone,user_password FROM users
                            WHERE user_email = ?  AND user_password = ? LIMIT 1;');     

    $stmt->bind_param('ss', $email, $password);

    if ($stmt->execute()) {

        $stmt->bind_result($user_id,$user_name, $user_email,$user_phone,$user_password);
        $stmt->store_result();

        if ($stmt->num_rows() == 1) {
            $stmt->fetch();

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_phone'] = $user_phone;
            $_SESSION['logged_in'] = true;

            header('location: Account.php?log_success=Logged Successfull');
        }else {
            // error 
            header('location: Login.php?error=There is no account with this email');
        }

    }else {
        // error 
        header('location: Login.php?error=something went wrong');
    }
}else if (isset($_POST['go-register'])) {
    header('location: ./Register.php');
}

?>



<!doctype html>
<html lang="en">

<head>
    <title>Sign In</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="../asset/favicon.ico">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/Login.css">
    <link rel="stylesheet" href="../css/Header.css">
    <link rel="stylesheet" href="../css/Footer.css">

</head>
<?php  
    include('../layouts/header-php.php');
?>

    <section class="main_section">
        <div class="title">
            <h1>
                Sign In
            </h1>
        </div>
        <section class="sign-section">
            <div class="wrapper">
                <form method="POST" action="Login.php" class="form">
                    <div class="inpt-container" >
                        <div class="form-group" style="margin:0;">
                            <p>Email</p>
                            <input  class="inp-main" type="email" name="email">
                            <i class="input-icon uil uil-at"></i>
                        </div>
                        <div class="form-group">
                            <p>Password</p>
                            <input class="inp-main" type="password" name="password">
                            <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <input class="btn submit" type="submit" name="login_btn" value="Sing In" />
                        <p style="color:red"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
                        <hr>
                    </div>
                    <p>Create an Account</p>
                    <br>
                    <a href="./Register.php">
                        <input class="btn submit" type="submit" name="go-register" value="Sign Up" />
                    </a>
                </form> 
            </div>
        </section>
    </section>
<?php  
    include('../layouts/footer-php.php');
?>