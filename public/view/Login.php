<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php include ('../model/User.php'); ?>
    <?php include ('../../config/config.php'); ?>
    <?php include ('../../notification/notification.php'); ?>
    <?php include ('../../config/loader.php'); ?>
    <?php include ('../../config/framework.php'); ?>
    <link rel="stylesheet" href="../../public/css/Login.css">
</head>
<?php 
if(!isset($_POST['username'])) $_POST['username'] = null;
if(!isset($_POST['password']))$_POST['password'] = null;
if(isset($_POST['login'])){
    $r = new User($_POST['username'],$_POST['password'],"","","","","","","");
    $r->login();
}
?>
<body>
    <div class="contain">
        <form action="" method="post">
            <img src="https://tocotocotea.com/wp-content/themes/tocotocotea/assets/images/logo.png" alt="">
            <input type="text" placeholder="Enter your username" name="username" value="<?=$_POST['username']?>">
            <input type="password" placeholder="Enter your password" name="password" value="<?=$_POST['password']?>">
            <a href="./UserController.php?act=Password">Forgot the password?</a>
            <button name="login">Login</button>
            <p>Haven't you an account? <a href="./UserController.php?act=Register">Register Now</a></p>
            <a href="./UserController.php?act=Product">Return</a>
        </form>
    </div>
</body>
</html>