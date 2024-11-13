<?php include('./header.php') ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
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
                <h1>Add User</h1>
            </header>
            <section class = "main_section" >
                <form class="form" action="create_user.php" method="POST" enctype="multipart/form-data" >
                    
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="name formEntry" type="text" id="name" name="name" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="name formEntry" type="text" id="email" name="email" placeholder="Email" >
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input class="name formEntry" type="text" id="phone" name="phone" placeholder="Phone">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="name formEntry" type="number" id="password" name="password" placeholder="Password">
                    </div>

                    <button name="create_btn" type="submit" class="submit formEntry">Add</button>
                </form>
            </section>
        </div>
    </div>
</body>
</html>
