<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Order</title>
    <?php include ('../model/Product.php'); ?>
    <?php include ('../model/Order.php'); ?>
    <?php include ('../../config/config.php'); ?>
    <?php include ('../../config/loader.php'); ?>
    <?php include ('../../notification/notification.php'); ?>
    <?php include ('../../config/framework.php'); ?>
    <link rel="stylesheet" href="../../public/css/Order.css">
</head>
<?php 
if(isset($_GET['cancel']) && !empty($_GET['cancel'])){
    $n = new Order("","","","","","","","","");
    $n->update_status($_GET['cancel'],"cancel");
    header('Location: ./UserController.php?act=Order');
}
?>
<body>
    <?php include ('../../public/view/layout/nav.php'); ?>
    <div class="content">
        <?php include ('../../public/view/layout/nav-account.php'); ?>
        <div class="display">
            <div class="type">
                <div class="name">
                    <p>Deliver</p>
                    <i class="fa-solid fa-chevron-down icon-name-list-product" style="transform:rotate(0deg);"></i>
                </div>
                <div class="content">
                <?php 
                    $n = new Order($_SESSION['username'],"","","","","","","","deliver");
                    $a = $n->get_username();
                    while ($r = $a->fetch()){
                ?>
                    <table class="item">
                        <tr>
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
                            <td>Date: <span <?php if($r['date'] < date('Y-m-d')) echo "style='color:#ee4d2d'"; else echo "style='color:#43ee2d'";?>><?=$r['date'];?></span></td>
                            <td>Status: <span class="status"><?=$r['status'];?></span></td>
                            <td>Total: <span><?=$r['price'];?>đ</span></td>
                            <td>
                                <?php if($r['status'] == "unconfirm"){?>
                                <button id_order="<?=$r['id'];?>" class="cancel_btn">Cancel</button>
                                <?php }?>
                            </td>
                        </tr>
                    </table>
                    <?php }?>
                </div>
            </div>
            <div class="type">
                <div class="name">
                    <p>Store</p>
                    <i class="fa-solid fa-chevron-down icon-name-list-product" style="transform:rotate(0deg);"></i>
                </div>
                <div class="content">
                <?php 
                    $n = new Order($_SESSION['username'],"","","","","","","","store");
                    $a = $n->get_username();
                    while ($r = $a->fetch()){
                ?>
                    <table class="item">
                        <tr>
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
                            <td>Date: <span <?php if($r['date'] < date('Y-m-d')) echo "style='color:#ee4d2d'"; else echo "style='color:#43ee2d'";?>><?=$r['date'];?></span></td>
                            <td>Status: <span class="status"><?=$r['status'];?></span></td>
                            <td>Total: <span><?=$r['price'];?>đ</span></td>
                            <td>
                                <?php if($r['status'] == "unconfirm"){?>
                                <button id_order="<?=$r['id'];?>" class="cancel_btn">Cancel</button>
                                <?php }?>
                            </td>
                        </tr>
                    </table>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    <script src="../../public/js/Order.js"></script>
</body>
</html>