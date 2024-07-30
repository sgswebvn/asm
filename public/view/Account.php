<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <?php include ('../model/Product.php'); ?>
    <?php include ('../../config/config.php'); ?>
    <?php include ('../../notification/notification.php'); ?>
    <?php include ('../../config/framework.php'); ?>
    <?php include ('../../config/loader.php'); ?>
    <link rel="stylesheet" href="../../public/css/Account.css">
</head>
<body>
    <?php include ('../../public/view/layout/nav.php'); ?>
    <?php 
        if(!isset($_POST['fullname'])) $_POST['fullname'] = null;
        if(!isset($_POST['phone']))$_POST['phone'] = null;
        if(!isset($_POST['email'])) $_POST['email'] = null;
        if(!isset($_POST['address']))$_POST['address'] = null;
        $n = new User($_SESSION['username'],"","","","","","","","");
        $r = $n -> get_username();
        if(isset($_POST['update'])){
            $n = new User($_SESSION['username'],$r['password'],$_POST['phone'],$_POST['fullname'],$_FILES['image']['name'],$_POST['email'],$_POST['address'],$r['role'],$r['active']);
            $n->update_user();
        }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
    <div class="content">
        <?php include ('../../public/view/layout/nav-account.php'); ?>
        <div class="display">
            <img src="https://tocotocotea.com/wp-content/themes/tocotocotea/assets/images/background-account.png" alt="">
            <div class="detail">
                <div class="image">
                    <img src="../../public/uploads/<?= $r['image'];?>" alt="">
                    <i class="fa-solid fa-camera" id="upload_image"></i>
                    <p id="status_image"></p>
                    <input type="file" name="image" id="input_image">
                </div>
                <div class="info">
                    <div>
                        <p>Username</p>
                        <input type="text" disabled name="username" value="<?=$r['username'];?>">
                    </div>
                    <div>
                        <p>fullname</p>
                        <input type="text" name="fullname" value="<?php $x = ($_POST['fullname'] == "") ? $r['fullname'] : $_POST['fullname']; echo $x;?>">
                    </div>
                    <div>
                        <p>Phone number</p>
                        <input type="text" name="phone" value="<?php $x = ($r['phonenumber'] == null) ?  "" : 0 . $r['phonenumber']; echo $x; ?>">
                    </div>
                    <div>
                        <p>email</p>
                        <input type="text" name="email" value="<?php $x = ($_POST['email'] == "") ? $r['email'] : $_POST['email']; echo $x;?>">
                    </div>
                    <div>
                        <p>Address</p>
                        <input type="text" name="address" value="<?php $x = ($_POST['address'] == "") ? $r['address'] : $_POST['address']; echo $x;?>">
                    </div>
                </div>
                <button class="btn_update" name="update">Save changes</button>
            </div>
        </div>
    </div>
</form>
<script src="../../public/js/Account.js"></script>
</body>
</html>