<?php 

include('../server/get_featured_products.php');

if(isset($_GET['product_id'])) {

    $product_id = $_GET['product_id'];

    $stmt = $conn->prepare('SELECT * FROM products WHERE product_id = ?');
    $stmt->bind_param('i', $product_id);

    $stmt->execute();

    $product =  $stmt->get_result();

    //no product id was givven
} else {
    header('location: .//index.php');
}

?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy</title>
    <link rel="stylesheet" href="">
    <link rel="icon" type="image/x-icon" href="../asset/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/ProductDetail.css">
    <link rel="stylesheet" href="../css/Header.css">
    <link rel="stylesheet" href="../css/Footer.css">
</head> 

<?php  
    include('../layouts/header-php.php');
?>

    <section class="main_section">
        <div class="title">
            <h1>Buy</h1>
        </div>
        <?php while($row = $product->fetch_assoc()){ ?>
            
                <div class="product-page">
                    <div class="product-image-section">
                        <div class="product-images">
                            <div class="thumbnail-images">
                                <img class="fst_guit" src="../img/<?php echo $row['product_image1']; ?>" alt="Thumbnail 1" onclick="showImage('../img/<?php echo $row['product_image1']; ?>')">
                                <img src="../img/<?php echo $row['product_image2']; ?>" alt="Thumbnail 2" onclick="showImage('../img/<?php echo $row['product_image2']; ?>')">
                                <img src="../img/<?php echo $row['product_image3']; ?>" alt="Thumbnail 3" onclick="showImage('../img/<?php echo $row['product_image3']; ?>')">
                                <img src="../img/<?php echo $row['product_image4']; ?>" alt="Thumbnail 4" onclick="showImage('../img/<?php echo $row['product_image4']; ?>')">
                                <img src="../img/<?php echo $row['product_image5']; ?>" alt="Thumbnail 5" onclick="showImage('../img/<?php echo $row['product_image5']; ?>')">
                            </div>
                            <div class="main_img">
                                <img id="main-image" src="../img/<?php echo $row['product_image1']; ?>" alt="Guitar Image" class="main-image">
                            </div>

                        </div>              
                        <div class="product-description">
                            <h4><?php echo $row['product_description_title']; ?></h4>
                            <p><?php echo $row['product_description']; ?></p>
                        </div>
                    </div>

                    <div class="product-details-section">
                        <h2><?php echo $row['product_name']; ?></h2>
                        <div class="product-options">
                            <div class="option">
                                <hr>
                                <label>Handedness</label>
                                <select>
                                    <option>Right</option>
                                    <option>Left</option>
                                </select>
                            </div>
                        </div>                        
                        <hr>
                        <div class="product-price">
                            <h3>$ <?php echo $row['product_price']; ?></h3>

                            <form method="POST" action="Cart.php">
                                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
                                <input type="hidden" name="product_image" value="<?php echo $row['product_image_stand']; ?>" />
                                <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>" />
                                <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>" />
                                <button type="submit" name="add_to_cart">
                                    Buy
                                </button>
                            </form>
                        </div>
                        <img class="gibson_logo" src="../img/logoGibson.png" alt="">
                    </div>    
                </div>
            
        <?php }?>

        <div class="video_section">
            <hr>
            <iframe  src="https://www.youtube.com/embed/IFun5e2RwY0?si=WwsvBOL9Rkb1Ifw3" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        
    </section>
<?php  
    include('../layouts/footer-php.php');
?>