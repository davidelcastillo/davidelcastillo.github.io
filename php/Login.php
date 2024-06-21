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

            header('location: Account.php?login_success=logged successfull');
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
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/Login.css">

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
                <span class="navbar-toggler-icon logoHamburguesa"></span>
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
                    <a href="./login.php" class="btn" type="submit"><i class="bi bi-person buttonNavbarRight"></i> </a>
                    <a class="btn" type="submit" href="./Cart.php" ><i class="bi bi-cart buttonNavbarRight"></i>  </a>

                </form>
            </div>
        </div>
    </nav>

    <section class="main_section">
        <div class="title">
            <h1>
                Sign In
            </h1>
        </div>
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