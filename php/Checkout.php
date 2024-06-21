<?php 

session_start();

if (!empty( $_SESSION["cart"] ) && isset($_POST['checkout']) ) {


// send user to home
} else {

    header('location: ../index.php');

}

?>



<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <title>Checkout</title>
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
                Checkout
            </h1>
        </div>
        <section class="nno_title" >
            <div class="info_conteiner">
                <div class="info_details">
                    <h4>Billing address</h4>
                    <form class="needs-validation" method="POST" action="../server/place_order.php">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstName">First name</label>
                                <input type="text" class="form-control" name="firstName" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastName">Last name</label>
                                <input type="text" class="form-control" name="lastName" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                Valid last name is required.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                        </div>

                        <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" placeholder="1234 Main St" required="">
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                        </div>

                        <div class="mb-3">
                        <label for="address2">Phone</label>
                        <input type="text" class="form-control" name="phone" placeholder="333 111 2222">
                        </div>

                        <div class="mb-3">
                        <label for="address2">City</label>
                        <input type="text" class="form-control" name="city" placeholder="Texas">
                        </div>

                        <hr>
                        <div class="place_order-container">
                            <input type="submit" class="place_order-btn" name="Place_order" value="Continue to checkout" >
                        </div>
                    </form>
                </div>
                <div class="cart_details">
                    <h4>
                        Your cart
                    </h4>

                    <ul>

                        <?php foreach($_SESSION['cart'] as $key => $value) { ?>

                        <li >
                            <div>
                                <h6><?php echo $value['product_name'];?></h6>
                            </div>
                            <span class="price">$<?php echo $value['product_price'];?></span>
                        </li>

                        <?php } ?>

                        <li class="list-group-item d-flex justify-content-between total-li">
                            <span>Total (USD)</span>
                            <h4>$<?php echo $_SESSION['total'];?>.00</h4>
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
                    <a href="../html/ContactUs.html">Contact</a>
                    <a href="./login.php">Sign in</a>
                    <a href="../html/AboutUs.html">About us</a>
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