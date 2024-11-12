<?php
include('../server/connection.php');
if (isset($_POST['update_images'])){

    $product_name = $_POST['product_name'];
    $product_id = $_POST['product_id'];

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

    $stmt = $conn->prepare("UPDATE products SET product_image_stand=?, product_image2=?, product_image3=?,
                                                    product_image4=?, product_image5=?, product_image1=? 
                                    WHERE product_id=?");
    $stmt->bind_param('ssssssi', $image_name1, $image_name2, $image_name3, $image_name4, $product_id);
    if ($stmt->execute()) {
    header('location: products.php?images_updated=Images have been updated successfully');
    }else{
    header('location: products.php?images_failed-Error occured, try again' );
    }
}
