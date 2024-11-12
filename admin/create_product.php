<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('../server/connection.php');
if (isset($_POST['create_btn'])) {
    $product_name = $_POST['name'];
    $product_name_shrt = $_POST['name_shrt'];
    $product_description_title = $_POST['description_title'];
    $product_description = $_POST['description'];
    $product_price = $_POST['price'];
    $product_stock = $_POST['stock'];
    $product_category = $_POST['category'];

    $image1 =$_FILES['img1'] ['tmp_name'];
    $image2 =$_FILES['img2']['tmp_name'];
    $image3 =$_FILES['img3']['tmp_name'];
    $image4 =$_FILES['img4']['tmp_name'];
    $image5 =$_FILES['img5']['tmp_name'];
    $image6 =$_FILES['img6']['tmp_name'];
    //$file_name = $_FILES['img1'] ['name'];

    $image_name1 = $product_name."1.jpeg";
    $image_name2 = $product_name."2.jpeg";
    $image_name3 = $product_name."3.jpeg";
    $image_name4 = $product_name."4.jpeg";
    $image_name5 = $product_name."5.jpeg";
    $image_name6 = $product_name."volt.jpeg";

    move_uploaded_file($image1,"../img/".$image_name1);
    move_uploaded_file($image2,"../img/".$image_name2);
    move_uploaded_file($image3,"../img/".$image_name3);
    move_uploaded_file($image4,"../img/".$image_name4);
    move_uploaded_file($image5,"../img/".$image_name5);
    move_uploaded_file($image6,"../img/".$image_name6);

    //create a new user
    $stmt = $conn->prepare("INSERT INTO products (product_name, product_name_shrt, product_description_title , product_description,             
                                                        product_price, product_stock , product_image_stand, product_image2, product_image3,product_image4, 
                                                        product_image5 , product_image1, product_category)
                                    VALUES (?,?,?,?, ?,?, ?, ?, ?, ?,?,?,?)");

    $stmt->bind_param('ssssiisssssss', $product_name,$product_name_shrt,$product_description_title,$product_description,
                $product_price,$product_stock,$image_name1,$image_name2,$image_name3,$image_name4,$image_name5,$image_name6,$product_category);
    if ($stmt->execute()) {
    header('location: products.php?product_created=Product has been created successfully');
    }else{
    header('location: products.php?product_failed=Error occured, try again');
    }

}

?>