<?php 

session_start();

if (isset($_POST['add_to_cart'])){

  // if user already added product to cart
  if(isset($_SESSION['cart'])){

    $products_array_ids = array_column($_SESSION['cart'],'product_id');
    //if product has already been added
    if(!in_array($_POST['product_id'], $products_array_ids)){

      $product_id = $_POST['product_id'];

        $product_array = array(
          'product_id'=> $_POST['product_id'], 
          'product_image'=> $_POST['product_image'],
          'product_name'=> $_POST['product_name'],
          'product_price'=> $_POST['product_price'],
        );

        $_SESSION['cart'][$_POST['product_id']] = $product_array;

      // product has already been added
    }else {
          echo'<script>alert("Product was already added to the cart");</script>'; 
    }

    // if is the 1st product
  } else {

      $product_id = $_POST['product_id'];
      $product_image = $_POST['product_image'];
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];

      $product_array = array(
        'product_id'=> $product_id, 
        'product_image'=> $product_image,
        'product_name'=> $product_name,
        'product_price'=> $product_price,
      );
      
      $_SESSION['cart'][$product_id] = $product_array;

  }

  //calculate TOTAL
  calculateTotalCart() ;
  $_SESSION['total_tax'] = $_SESSION['total'] + 4;

//remove product 4 cart
}else if(isset($_POST['remove_product'])){

  $product_id = $_POST['product_id'];
  unset($_SESSION['cart'][$product_id]);

  //calculate TOTAL
  calculateTotalCart() ;
  $_SESSION['total_tax'] = $_SESSION['total'] + 4;

}else {
  // header('location: index.php');
}


function calculateTotalCart() {
  $total = 0;

  foreach($_SESSION['cart'] as $key => $value) {
    $product = $_SESSION['cart'][$key];
    $price = $product['product_price'];

    $total = $total + $price;
  }

  $_SESSION['total'] = $total;
}

?>


<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <title>Cart</title>
    <link rel="stylesheet" href="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/Cart.css">
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
                Cart
            </h1>
        </div>
        
        <section class="Shopping_section">
          <div class="table_conteiner">
            <table class="table table-borderless table-dark">
              <thead class="table-dark">
                <tr>
                  <th scope="col" class="table_title">Shopping Bag</th>
                  <th scope="col"class="table_title price-cell">Price</th>
                </tr>
              </thead>

              <tbody class="table-active">
                      
                <?php foreach($_SESSION['cart'] as $key => $value) { ?>
                <tr>
                  <th scope="row" style="width: 50vw; align-items: center;">
                    <div class="product_conteiner">
                      <img src="../img/<?php echo $value['product_image'];?>" class=" img-1"  alt="Product">
                      <div class="product_detail">
                        <p class="mb-1"><?php echo $value['product_name'];?></p>
                        <br>
                        <form method="POST" action="cart.php">
                          <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                          <input type="submit" name="remove_product" class="remove-btm" value="Remove"/>
                        </form>
                      </div>
                    </div>
                  </th>
                          
                  <td style="align-items: center;">
                    <div class="Subtotal_conteiner" >
                      <p class="mb-0"><?php echo $value['product_price'];?></p>
                    </div>
                  </td>
                </tr>

                <?php } ?>
              </tbody>
            </table>
          </div>
          
          <div class="Total_conteiner";">
            <div class="Sub_conteiner">
              <p class="mb-3">Subtotal</p>
              <p class="mb-0">$ <?php echo $_SESSION['total']; ?></p>
            </div>
            
            <div class="Sub_conteiner">
              <p class="mb-3">Shipping</p>
              <p class="mb-0">$4</p>
              <hr>
            </div>

            <div class="Total">
              <p class="mb-1">Total (tax included)</p>
              <p class="mb-0">$<?php echo $_SESSION['total_tax']; ?></p>
            </div>
            
            <div class="checkout-container">
              <form  method="POST" action="Checkout.php">
                    <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout">
              </form>
            </div>
            <!-- <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn">
              <div class="d-flex justify-content-between">
                <span>Checkout   $</span>
                <span><?php echo $_SESSION['total_tax']; ?></span>
              </div>
            </button> -->
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