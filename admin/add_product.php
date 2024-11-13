<?php include('./header.php') ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="icon" type="image/x-icon" href="../asset/favicon.ico">
    <link rel="stylesheet" href="../css/Siderbar.css">
    <link rel="stylesheet" href="./css/edit_product.css">
</head>
<body>
<?php  
    include('../layouts/siderbar.php');
?>
        <div class="main-content">
            <header>
                <h1>Add Product</h1>
            </header>
            <section class = "main_section" >
                <form class="form" action="create_product.php" method="POST" enctype="multipart/form-data" >
                    
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="name formEntry" type="text" id="name" name="name" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <label for="name">Name Short</label>
                        <input class="name formEntry" type="text" id="name_shrt" name="name_shrt" placeholder="Name Short" >
                    </div>

                    <div class="form-group">
                        <label for="description title">Description Title</label>
                        <input class="name formEntry" type="text" id="descripction_title" name="description_title" placeholder="Description Title">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="message formEntry" id="description" name="description" placeholder="Description"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input class="name formEntry" type="number" id="price" name="price" placeholder="Price" step="0.01">
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input class="name formEntry" type="text" id="stock" name="stock" placeholder="Stock">
                    </div>

                    <div class="form-group option">
                        <label for="category">Category</label>
                            <select class="formEntry" name="category" id="category" >
                                <option class="option" >Electric</option>
                                <option class="option">Acoustic</option>
                            </select>
                    </div>

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

                    <button name="create_btn" type="submit" class="submit formEntry">Add</button>
                </form>
            </section>
        </div>
    </div>
</body>
</html>
