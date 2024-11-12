<?php include('./header.php') ?>
<?php 
if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];
}else {
    header('Location: ./products.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Imaget</title>
    <link rel="stylesheet" href="../css/Siderbar.css">
    <link rel="stylesheet" href="./css/edit_product.css">
</head>
<body>
<?php  
    include('../layouts/siderbar.php');
?>
        <div class="main-content">
            <header>
                <h1>Edit Image</h1>
            </header>
            <section class = "main_section" >
            <form class="form" action="update_images.php" method="POST" enctype="multipart/form-data" >
                    
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>" />
                    <input type="hidden" name="product_name" value="<?php echo $product['product_name'] ?>" />

                    <div class="form-group">
                        <label for="image1">Image 1</label>
                        <input class="image formEntry" type="file" id="img1" name="img1" placeholder="Image 1" required>
                    </div>

                    <div class="form-group">
                        <label for="image2">Image 2</label>
                        <input class="image formEntry" type="file" id="img2" name="img2" placeholder="Image 2" required>
                    </div>

                    <div class="form-group">
                        <label for="image3">Image 3</label>
                        <input class="image formEntry" type="file" id="img3" name="img3" placeholder="Image 3" required>
                    </div>

                    <div class="form-group">
                        <label for="image4">Image 4</label>
                        <input class="image formEntry" type="file" id="img4" name="img4" placeholder="Image 4" required>
                    </div>

                    <div class="form-group">
                        <label for="image5">Image 5</label>
                        <input class="image formEntry" type="file" id="img5" name="img5" placeholder="Image 5" required>
                    </div>

                    <div class="form-group">
                        <label for="image6">Image Landscape</label>
                        <input class="image formEntry" type="file" id="img6" name="img6" placeholder="Image 6" required>
                    </div>

                    <button name="update_images" type="submit" class="submit formEntry">Edit</button>
                </form>
            </section>
        </div>
    </div>
</body>
</html>
