<?php include('./header.php') ?>
<?php 
if( isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ? ");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $users =  $stmt->get_result();
}else if( isset($_POST['edit_btn'])) {

    $user_id = $_POST['user_id'];
    $user_name = $_POST['name'];
    $user_email = $_POST['email'];  
    $user_phone = $_POST['phone'];

    $stmt2 = $conn->prepare('UPDATE users
                                    SET user_name = ?, user_email = ?, user_phone = ?
                                    WHERE user_id = ?'); 
    $stmt2->bind_param('ssii', $user_name,$user_email,$user_phone,$user_id);
    if ($stmt2->execute()) {
        header("Location: ./users.php?edit_scc=Order has been updated successfully");
    }else {
        header("Location: ./users.php?edit_fail=Error, try again");
    }

}else {
    header("Location: ./users.php?msj");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="../css/Siderbar.css">
    <link rel="stylesheet" href="./css/edit_product.css">
</head>
<body>
<?php  
    include('../layouts/siderbar.php');
?>
        <div class="main-content">
            <header>
                <h1>Edit User</h1>
            </header>
            <section class = "main_section" >
                <form class="form" action="edit_users.php" method="POST" >
                    <?php foreach($users as $user) { ?>

                    <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>" />
                    
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="name formEntry" value="<?php echo $user['user_name'] ?>" type="name" id="name" name="name" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="name formEntry" value="<?php echo $user['user_email'] ?>" type="email" id="email" name="email" placeholder="email">
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input class="name formEntry" value="<?php echo $user['user_phone'] ?>" type="phone" id="phone" name="phone" placeholder="Phone">
                    </div>
    
                    <button name="edit_btn" type="submit" class="submit formEntry">Edit</button>
                    <?php } ?>
                </form>
            </section>
        </div>
    </div>
</body>
</html>
