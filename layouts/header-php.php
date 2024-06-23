
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
                <form class="d-flex formNavbar" role="search" method="POST" action="./Search.php" >
                    <input class="form-control me-2 inputSearchNavbar" type="search" aria-label="Search" name="search">
                    <button class="search-btn" type="submit"><i class="bi bi-search buttonNavbarRight"></i></button>
                    <a href="./Login.php" class="btn" type="submit"><i class="bi bi-person buttonNavbarRight"></i> </a>
                    <div class="cart-container">
                    <a class="btn cart-btn" type="submit" href="./Cart.php" ><i class="bi bi-cart buttonNavbarRight"> </i>
                        <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0) { ?> 
                            <span class="cart-quantity" ><?php echo $_SESSION['quantity']; ?></span> 
                        <?php }?>
                      </a>
                    </div>
                </form>
            </div>
        </div>
    </nav>
