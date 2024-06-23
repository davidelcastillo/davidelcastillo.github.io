<?php 

session_start();
include("../server/connection.php");

$result = null;

if(isset($_POST['search'])) {
    $search = trim($_POST['search']);
    
    // Verificar si el campo de búsqueda está vacío
    if (empty($search)) {
        header('Location: ../index.php');
        exit();
    }

    $search = '%' . $search . '%';

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_name LIKE ? OR product_description LIKE ? OR product_category LIKE ?");
    
    $stmt->bind_param('sss', $search,$search,$search);
    
    $stmt->execute();

    $result = $stmt->get_result();
    
    if(!$result || $result->num_rows <= 0) {
        header('Location: ../index.php');
        exit();

    } 

}else{
    header('Location: ../index.php');
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guitars</title>
    <link rel="stylesheet" href="">
    <link rel="icon" type="image/x-icon" href="../asset/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/Search.css">
    <link rel="stylesheet" href="../css/Header.css">
    <link rel="stylesheet" href="../css/Footer.css">
</head>
<?php  
    include('../layouts/header-php.php');
?>
    <section class="main_section">
        <div class="titleContainer">
            <h1>Search : </h1>
            <p><?php echo $_POST['search']?></p>
        </div>
            <div class="cardsContainer">
            <?php while($row= $result->fetch_assoc()) { ?>
                    <div class="card"> 
                        <div class="logoGibsonCard">
                            <img class="logoGibsonImgCard" src="../img/logoGibson.png" alt="Logo de Gibson">
                        </div>
                        <img class="guitarImgContainer" src="../img/<?php echo $row['product_image_stand']?>" alt="Guitar EXPL Black">
                        <p class="productName"><?php echo $row['product_name_shrt']?> </p>
                        <p class="productPrice">US$<?php echo $row['product_price']?></p>
                        <a href="<?php echo "ProductDestail.php?product_id=". $row['product_id'];?>">
                            <button class="buy-btn"> Buy now </button>
                        </a>
                    </div>
            <?php }?>
            </div>
    </section>
<?php  
    include('../layouts/footer-php.php');
?>