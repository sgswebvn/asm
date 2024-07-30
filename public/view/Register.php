<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <?php include ('../model/User.php'); ?>
    <?php include ('../../config/config.php'); ?>
    <?php include ('../../notification/notification.php'); ?>
    <?php include ('../../config/loader.php'); ?>
    <?php include ('../../config/framework.php'); ?>
    <link rel="stylesheet" href="../../public/css/Register.css">
</head>
<?php 
if(!isset($_POST['username'])) $_POST['username'] = null;
if(!isset($_POST['password'])) $_POST['password'] = null;
if(!isset($_POST['re-password'])) $_POST['re-password'] = null;
if(isset($_POST['register'])){
    $r = new User($_POST['username'],$_POST['password'],"","","","","","","");
    $r->register($_POST['re-password']);
}
?>
<body>
    <div class="contain">
        <form action="" method="post">
            <img src="https://tocotocotea.com/wp-content/themes/tocotocotea/assets/images/logo.png" alt="">
            <input type="text" name="username" placeholder="Enter your username" value="<?=$_POST['username']?>" required> 
            <input type="password" name="password" placeholder="Enter your password" value="<?=$_POST['password']?>" required>
            <input type="password" name="re-password" placeholder="Enter your password again" value="<?=$_POST['re-password']?>" required>
            <button name="register">Register</button>
            <p>Did you have an account? <a href="./UserController.php?act=Login">Login Now</a></p>
            <a href="./UserController.php?act=Product">Return</a>
        </form>
    </div>
</body>
</html>