<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget The Password</title>
    <?php include ('../../notification/notification.php'); ?>
    <?php include ('../../config/loader.php'); ?>
    <?php include ('../../config/framework.php'); ?>
    <link rel="stylesheet" href="../../public/css/Password.css">
</head>
<body>
    <div class="contain">
        <form action="" method="post">
            <img src="https://tocotocotea.com/wp-content/themes/tocotocotea/assets/images/logo.png" alt="">
            <input type="text" placeholder="Enter your phone number">
            <button>Next</button>
            <div>
                <a href="./UserController.php?act=Register">Register</a>
                <a href="./UserController.php?act=Login">Login</a>
            </div>
            <a href="./UserController.php?act=Product">Return</a>
        </form>
    </div>
</body>
</html>