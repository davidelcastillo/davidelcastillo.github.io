<?php 

session_start();

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/Checkout.css">

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
                    <a href="./login.html" class="btn" type="submit"><i class="bi bi-person buttonNavbarRight"></i> </a>
                    <a class="btn" type="submit" href="./Cart.php" ><i class="bi bi-cart buttonNavbarRight"></i>  </a>

                </form>
            </div>
        </div>
    </nav>
    <section class="main_section">
        <div class="title">
            <h1>
                Payment
            </h1>
        </div>
        
        <div class="mx-auto container" >
            <p> <?php echo $_GET['order_status']; ?> </p>
            <p>Total payment: $<?php echo $_SESSION['total']; ?> </p>
            <input class="btn" value="Pay Now" type="submit" />
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
                <div class="footerEtiquetasA">
                    <a href="../html/ContactUs.html">Contact</a>
                    <a href="./login.php">Sign in</a>
                    <a href="../html/AboutUs.html">About us</a>
                    <a href="../index.php">Menu</a>
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