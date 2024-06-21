<?php

session_start();
include("../server/connection.php");

if(!isset($_SESSION["logged_in"])) {
    header('location: ./Login.php');
    exit;
}

if(isset($_GET["logout"])) {
    if (isset($_SESSION["logged_in"])) {
        unset( $_SESSION["logged_in"] );
        unset( $_SESSION["user_email"] );
        unset( $_SESSION["user_name"] );
        unset( $_SESSION["user_phone"] );
        header('location: ../index.php');
        exit;
    }
}

if(isset($_POST['change_password'])) {

    $password = $_POST['password'];
    $new_password = $_POST['new_password'];

    if (strlen($new_password) < 6) {
        header('location: Account.php?error2=password must be at least 6 characters');
    }else {

        $stmt1 = $conn->prepare('SELECT user_password FROM users WHERE user_email = ?');
        $stmt1->bind_param('s', $_SESSION['user_email']);
        $stmt1->execute();
        $stmt1->bind_result($pss);
        $stmt1->store_result();
        $stmt1->fetch();

        if ($pss != md5($password)) {
    
            header('location: Account.php?error=Wrong Password');
    
        }else {

            $stmt2 = $conn->prepare('UPDATE users SET user_password = ?
                                    WHERE user_email = ?'); 
            $stmt2->bind_param('ss', md5($new_password), $_SESSION['user_email']);
            
            if($stmt2->execute()){
                header('location: Account.php?message=password has been updated succesfully');
            }else {
                header('location: Account.php?error2=Could´t update password');
            }

        }

    }

}

?>


<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <title>Account</title>
    <link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/Account.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbarContenedorAbajo">
        <div class="container-fluid navbarContenedorArriba">
            <div class="contenedorDivImagenNavbar">
                <a href="../index.php">
                    <img src="../img/logoGibson.png" alt="logo de Gibson" class="logoNavbar">
                </a>  
            </div>
            <button class="navbar-toggler menuHamburguesaButton" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse contenedorInfoNavbar" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 contenedorLinksNavbar">
                    <li class="nav-item">
                        <a class="nav-link" href="./ElectricGuitars.php">electric</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./AcousticGuitars.php">Acustic</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../html/AboutUs.html">about us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../html/Guitarist.html">guitarist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../html/ContactUs.html">contact us</a>
                    </li>

                </ul>
                <form class="d-flex formNavbar" role="search">
                    <input class="form-control me-2 inputSearchNavbar" type="search" aria-label="Search">
                    <a href="./Login.php" class="btn" type="submit"><i class="bi bi-person buttonNavbarRight"></i> </a>
                    <a class="btn" type="submit" href="./Cart.php" ><i class="bi bi-cart buttonNavbarRight"></i>  </a>
                </form>
            </div>
        </div>
    </nav>
    <section class="main_section">
        <div class="title">
            <h1>
                My Account
            </h1>
        </div>
        <section class="info_section">
            <div class="info_conteiner">
                <div class="account_details">
                    <h4>Account Info</h4>
                    <p style="color:green"><?php if(isset($_GET['register_succes'])){echo $_GET['register_succes'];} ?></p>
                    <p style="color:green"><?php if(isset($_GET['login_success'])){echo $_GET['login_success'];} ?></p>
                    <form>
                        <div class="mb-3">
                        <label for="name">Name : <?php if(isset($_SESSION['user_name'])) {echo $_SESSION['user_name'];} ?> </label>
                        </div>

                        <div class="mb-3">
                        <label for="email">Email : <?php if(isset($_SESSION['user_email'])) {echo $_SESSION['user_email'];} ?> </label>
                        </div>

                        <div class="mb-3">
                        <label for="phone">Phone: <?php if(isset($_SESSION['user_phone'])) {echo $_SESSION['user_phone'];} ?>  </label>
                        </div>

                        <hr>
                        <a href="#orders" id="order-btn">
                        <p>Your orders</p>
                        </a>
                        <a href="./Account.php?logout=1" id="logout-btn" >
                        <p>Logout</p>
                        </a>
                    </form>
                </div>
                <div class="passw_details">
                    <form method="POST" action="Account.php">
                        <h4>
                            Change Password
                        </h4>

                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" name="password" placeholder="Actual Password">
                            <p style="color:red"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
                        </div>

                        <div class="mb-3">
                            <label for="password">New Password</label>
                            <input type="text" class="form-control" name="new_password" placeholder="New Password">
                            <p style="color:red"><?php if(isset($_GET['error2'])){echo $_GET['error2'];} ?></p>
                        </div> 
                    <p style="color:green"><?php if(isset($_GET['message'])){echo $_GET['message'];} ?></p>
                    <input type="submit" class="btn checkout-btn" value="Change Password" name="change_password">
                    </form>
                </div>
            </div>
            <div id="orders" class="info_conteiner">
                <div class="order_conteiner" > 
                    <h4>
                        Your Orders
                    </h4>
                    <ul style="padding-left:0;">
                        <li >
                            <div style="display: flex; align-items: center;">
                                <h5>Product</h5>
                            </div>
                            <span class="price" style="font-size:3vw;">Date</span>
                        </li>
                        <li >
                            <div style="display: flex; align-items: center;">
                                <img src="../img/guitarra_v/v_negra.png" alt="">
                                <h6>Product Name</h6>
                            </div>
                            <span class="price" style="font-size:2vw;">$ Price</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </section>
    <footer class="footerFatherContainer">
        <div class="grupo">
            <section class="footerImageContainer box">
                <div class="Gibsonfooter">
                    <img src="../img/logoGibson.png" alt="Logo Gibson">
                </div>
            </section>
            <section class="footerInfoContainer box">
                <div class="containerLogos">
                    <a href="https://www.facebook.com/GibsonES/?brand_redir=98534165717" target="_blank">
                        <i  class="bi bi-facebook"></i>
                    </a>
                    <a href="https://twitter.com/Gibson" target="_blank">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/gibsonguitar" target="_blank">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
                <div class="footerEtiquetasA">
                    <a href="./ContactUs.html">Contact</a>
                    <a href="./login.html">Sign in</a>
                    <a href="./AboutUs.html">About us</a>
                    <a href="../index.php">Menu</a>
                </div>
                <div class="footerMail">
                    <i class="bi bi-envelope"></i>
                </div>
            </section>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>