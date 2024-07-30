<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="../../public/css/Admin.css">
</head>
<?php include ('../../config/framework.php'); ?>
<?php include ('../../config/config.php'); ?>
<?php include ('../../config/loader.php'); ?>
<?php include ('../../notification/notification.php'); ?>
<?php include ('../model/Order.php'); ?>
<?php 
if(!isset($_POST['username'])) $_POST['username'] = null;
if(!isset($_POST['password']))$_POST['password'] = null;
if(!isset($_POST['phone']))$_POST['phone'] = null;
if(!isset($_POST['fullname']))$_POST['fullname'] = null;
if(!isset($_POST['email']))$_POST['email'] = null;
if(!isset($_POST['address']))$_POST['address'] = null;
if(!isset($_POST['role']))$_POST['role'] = "user";
if(!isset($_POST['active']))$_POST['active'] = "non-active";
if(isset($_GET['delete']) && !empty($_GET['delete'])){
    $n = new Order("","","","","","","","","");
    $n->delete($_GET['delete']);
}
if(isset($_GET['confirm']) && !empty($_GET['confirm'])){
    $n = new Order("","","","","","","","","");
    $n->update_status($_GET['confirm'],"confirm");
    header('Location: ./UserController.php?act=AdminOrder&option=list');
}
if(isset($_GET['unconfirm']) && !empty($_GET['unconfirm'])){
    $n = new Order("","","","","","","","","");
    $n->update_status($_GET['unconfirm'],"unconfirm");
    header('Location: ./UserController.php?act=AdminOrder&option=list');
}
?>
<body>
    <div class="contain">
    <?php include ('../../public/view/layout/nav-admin.php'); ?>
    <?php if($_GET['option'] == "list"){?>
        <div class="content">
            <?php 
                $n = new Order("","","","","","","","","");
                $a = $n->get();
                while ($r = $a->fetch()){
            ?>
                    <table class="item">
                        <tbody>
                        
                        <tr <?php if($r['status'] == "unconfirm") echo "class='pin'";?>>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Option</th>
                            <th>Price</th>
                            <th>Total Product</th>
                        </tr>
                        <?php
                            $e = $n->get_detailOrders($r['id']);
                            while ($rs = $e->fetch()){
                        ?>
                        <tr>
                            <td><img src="../../public/uploads/<?=$rs['image'];?>" alt=""></td>
                            <td><?=$rs['name'];?></td>
                            <td><?=$rs['quantity'];?></td>
                            <td><?=$rs['option_content'];?></td>
                            <td><?=$rs['price'];?></td>
                            <td><?php echo $rs['quantity'] * (int)$rs['price']; ?>.000đ</td>
                        </tr>
                        <?php }?>
                        <tr class="information">
                            <td></td>
                            <td>Date: <span <?php if($r['date'] < date('Y-m-d')) echo "style='color:#ee4d2d'"; else echo "style='color:#43ee2d'";?>><?=$r['date'];?></span></td>
                            <td>Status: <span class="status" <?php if($r['status'] == "unconfirm")echo "style='color:#c6a45f'";elseif($r['status'] == "cancel") echo "style='color:#ee4d2d'";else echo "style='color:#43ee2d'"; ?> ><?=$r['status'];?></span></td>
                            <td>Total: <span><?=$r['price'];?>đ</span></td>
                            <td>
                                <?php if($r['status'] != "cancel"){?>
                                <button id_order="<?=$r['id'];?>" class="cancel_btn">Cancel</button>
                                <?php if($r['status'] != "confirm") {?>
                                <button id_order="<?=$r['id'];?>" class="confirm_btn">Confirm</button>
                                <?php }else{?>
                                <button id_order="<?=$r['id'];?>" class="unconfirm_btn">Unconfirm</button>
                                <?php }?>
                                <?php }?>
                            </td>
                            <td><i id_order="<?=$r['id'];?>" style="background-color:#ee4d2d;border-radius:20px;padding:10px 20px;color:white;cursor:pointer;" class="fa-solid fa-trash-can delete_btn"></i></td>
                        </tr>
                        <tr>
                            <th style="background-color:#eeeeee;color:black;">Username</th>
                            <th style="background-color:#eeeeee;color:black;">Name user</th>
                            <th style="background-color:#eeeeee;color:black;">Phone user</th>
                            <th style="background-color:#eeeeee;color:black;">Address user</th>
                            <th style="background-color:#eeeeee;color:black;">Note</th>
                            <th style="background-color:#eeeeee;color:black;">Type</th>
                        </tr>
                        <tr>
                            <td style="border:0;"><?=$r['id_user'];?></td>
                            <td style="border:0;"><?=$r['name'];?></td>
                            <td style="border:0;">0<?=$r['phonenumber'];?></td>
                            <td style="border:0;"><?=$r['address'];?></td>
                            <td style="border:0;"><?=$r['note'];?></td>
                            <td style="border:0;"><?=$r['type'];?></td>
                        </tr>
                        </tbody>
                    </table>
            <?php }?>
        </div>
    <?php }?>
    </div>
    <script src="../../public/js/mini_popup.js"></script>
    <script src="../../public/js/Order_admin.js"></script>
</body>
</html>