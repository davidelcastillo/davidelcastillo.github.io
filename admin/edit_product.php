<?php include('./header.php') ?>
<?php 
if( isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ? ");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $products =  $stmt->get_result();
}else if( isset($_POST['edit_btn'])) {

    $product_id = $_POST['product_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $stmt2 = $conn->prepare('UPDATE products 
                                    SET product_name = ?, product_description = ?, product_price = ?, product_category = ?
                                    WHERE product_id = ?'); 
    $stmt2->bind_param('ssisi', $title,$description,$price,$category,$product_id);    
    if ($stmt2->execute()) {
        header("Location: ./products.php?edit_scc=Product has been updated successfully");
    }else {
        header("Location: ./products.php?edit_fail=Erro, try again");
    }

}else {
    header("Location: ./products.php?msj");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="../css/Siderbar.css">
    <link rel="stylesheet" href="./css/edit_product.css">
</head>
<body>
<?php  
    include('../layouts/siderbar.php');
?>
        <div class="main-content">
            <header>
                <h1>Edit Product</h1>
            </header>
            <section class = "main_section" >
                <form class="form" action="edit_product.php" method="POST" >
                    <?php foreach($products as $product) { ?>

                    <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>" />
                    
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input class="name formEntry" value="<?php echo $product['product_name'] ?>" type="text" id="title" name="title" placeholder="Title">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="message formEntry" id="description" name="description" placeholder="Description"><?php echo $product['product_description'] ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input class="name formEntry" value="<?php echo $product['product_price'] ?>" type="number" id="price" name="price" placeholder="Price" step="0.01">
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input class="name formEntry" value="<?php echo $product['product_stock'] ?>" type="text" id="stock" name="stock" placeholder="Stock">
                    </div>

                    <div class="form-group option">
                        <label for="category">Category</label>
                            <select class="formEntry" name="category" id="category" >
                                <option class="option">Electric</option>
                                <option class="option">Acoustic</option>
                            </select>
                    </div>

                    <button name="edit_btn" type="submit" class="submit formEntry">Edit</button>
                    <?php } ?>
                </form>
            </section>
        </div>
    </div>
</body>
</html>
