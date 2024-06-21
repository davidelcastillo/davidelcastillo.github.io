<?php

session_start();

include("../server/connection.php");

 // if user has already register -> account page
if (isset ($_SESSION['logged_in'])) {
    header('location: Account.php');
    exit;
}

if (isset($_POST["register"])) {

    $name = $_POST['name'];
    $email= $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];


    if (strlen($password) < 6) {
        header('location: Register.php?error=password must be at least 6 characters');
    }

    // if there is no error
    else {
        //check whether there is a user wht this email o phone or not
        $stmp1 = $conn->prepare('SELECT count(*) FROM users WHERE user_email=?');
        $stmp1->bind_param('s', $email);
        $stmp1->execute();
        $stmp1->bind_result($num_rows);
        $stmp1->store_result();
        $stmp1->fetch();
    
        // if there is a user wht already register with the email or phone
        if ($num_rows != 0) {
    
            header('location: Register.php?error=user with this email or phone already exists');
    
        }else {
            //create a new user
            $stmp = $conn->prepare('INSERT INTO users (user_name,user_email,user_phone,user_password)
                                    VALUES (?,?,?,?)');
            
            $stmp->bind_param('ssss', $name,$email,$phone, md5($password));
            
            
            if($stmp->execute()){
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['user_phone'] = $phone;
                $_SESSION['logged_in'] = true;
    
                header('location: Account.php?register_succes=You register succesfully');
            }else{
    
                header('location: Register.php?error=Cold´t create account');
    
            }
        } 
    } 
}

?>


<!doctype html>
<html lang="en">

<head>
    <title>Sign Up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/Register.css">

</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbarContenedorAbajo">
        <div class="container-fluid navbarContenedorArriba">
            <div class="contenedorDivImagenNavbar">
                <a href="../index.html">
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
                Sign Up
            </h1>
        </div>
        <div class="wrapper">
            <form method="POST" action="Register.php" class="form">
                
                <div class="form-group">
                    <p>Name</p>
                    <input class="inp-main" type="text" class="form-style" name="name">
                    <i class="input-icon uil uil-user"></i>
                </div>
                <div class="form-group mt-2">
                    <p>Phone</p>
                    <input class="inp-main" type="tel" class="form-style" name="phone">
                    <i class="input-icon uil uil-phone"></i>
                </div>
                <div class="form-group mt-2">
                    <p>Email</p>
                    <input class="inp-main" type="email" class="form-style" name="email">
                    <i class="input-icon uil uil-at"></i>
                </div>
                <div class="form-group mt-2">
                    <p>Password</p>
                    <input class="inp-main" type="password" class="form-style" name="password">
                    <i class="input-icon uil uil-lock-alt"></i>
                </div>
                <p style="color:red;" ><?php  if(isset($_GET['error'])) {$_GET['error']; }?> </p>
                <input type="checkbox" class="termsConditions" value="Term">
                <label style="color: rgb(255, 254, 254)" for="terms"> I Accept the <span style="color: #a1a0a0">Terms of Use</span> & <span style="color: #a1a0a0">Privacy Policy</span>.</label><br>
                <input class="btn submit" type="submit" name="register" value="Sing Up" />
                <p style="color:red"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
                <a href="Login.php">
                    <p class="lst-p" >Already have an account? Login</p>
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