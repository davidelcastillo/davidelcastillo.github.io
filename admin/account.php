<?php 
include('../admin/header.php');
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: ../admin/login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../asset/favicon.ico">
    <link rel="stylesheet" href="./css/account.css">
    <link rel="stylesheet" href="../css/Siderbar.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Account</title>
</head>
<body>
<?php  
    include('../layouts/siderbar.php');
?>
        <div class="main-content">
        <div class="info_conteiner">
                <div class="account_details">
                    <h4>Account Info</h4>
                    <form>
                        <div class="mb-3">
                        <label for="name">Name : <?php if(isset($_SESSION['admin_name'])) {echo $_SESSION['admin_name'];} ?> </label>
                        </div>

                        <div class="mb-3">
                        <label for="email">Email : <?php if(isset($_SESSION['admin_email'])) {echo $_SESSION['admin_email'];} ?> </label>
                        </div>
                    </form>
                </div>
                <div class="passw_details">
                    <form method="POST" action="Account.php">
                        <h4>
                            Change Password
                        </h4>

                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="text" class="form-control main-inpt" name="password" placeholder="Actual Password">
                            <p style="color:red"><?php if(isset($_GET['error'])){echo $_GET['error'];} ?></p>
                        </div>

                        <div class="mb-3">
                            <label for="password">New Password</label>
                            <input type="text" class="form-control main-inpt" name="new_password" placeholder="New Password">
                            <p style="color:red"><?php if(isset($_GET['error2'])){echo $_GET['error2'];} ?></p>
                        </div> 

                    <input type="submit" class="btn checkout-btn" value="Change Password" name="change_password">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>