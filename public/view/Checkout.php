<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Out</title>
    <?php include ('../model/Product.php'); ?>
    <?php include ('../model/Order.php'); ?>
    <?php include ('../../config/config.php'); ?>
    <?php include ('../../config/loader.php'); ?>
    <?php include ('../../notification/notification.php'); ?>
    <?php include ('../../config/framework.php'); ?>
    <link rel="stylesheet" href="../../public/css/Checkout.css">
</head>
<?php
if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];  
if(!isset($_POST['name_deliver'])) $_POST['name_deliver'] = null;
if(!isset($_POST['phone_deliver'])) $_POST['phone_deliver'] = null;
if(!isset($_POST['address_deliver'])) $_POST['address_deliver'] = null;
if(!isset($_POST['note_deliver'])) $_POST['note_deliver'] = null;
if(!isset($_POST['date_deliver'])) $_POST['date_deliver'] = null;
if(!isset($_POST['name_store'])) $_POST['name_store'] = null;
if(!isset($_POST['phone_store'])) $_POST['phone_store'] = null;
if(!isset($_POST['date_store'])) $_POST['date_store'] = null;
if(!isset($_POST['note'])) $_POST['note'] = null;
if(isset($_POST['order_deliver'])){
    $n = new Order($_SESSION['username'],$_POST['name_deliver'],$_POST['phone_deliver'],$_POST['address_deliver'],$_POST['date_deliver'],$_POST['price'],$_POST['note'],"unconfirm","deliver");
    $n->add();
} 
if(isset($_POST['order_store'])){
    $n = new Order($_SESSION['username'],$_POST['name_store'],$_POST['phone_store'],"",$_POST['date_store'],$_POST['price'],$_POST['note'],"unconfirm","store");
    $n->add();
} 
?>
<body>
    <?php include ('../../public/view/layout/nav.php'); ?>
    <?php 
    $u = new User($_SESSION['username'],"","","","","","","","");
    $ru = $u->get_username();
    ?>
    <div class="content">
        <form action="" method="post">
            <div class="option">
                <button type_option="delivery" class="active btn-option" type="button" disabled>delivery</button>
                <button type_option="store" class="btn-option" type="button">pick up at the store</button>
            </div>
            <div class="product">
                <div class="info_option">
                    <p>information</p>
                    <div class="info_option_content">
                        <div class="item">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" placeholder="Name" name="name_deliver" value="<?php $x = ($_POST['name_deliver'] == null) ? $ru["fullname"] : $_POST['name_deliver']; echo $x;?>">
                        </div>
                        <div class="item">
                            <i class="fa-solid fa-phone"></i>
                            <input type="text" placeholder="Phone number" name="phone_deliver" value="<?php $x = ($_POST['phone_deliver'] == null && $ru["phonenumber"] != null) ? 0 . $ru["phonenumber"] : $_POST['phone_deliver']; echo $x;?>">
                        </div>
                        <p>Deliver to</p>
                        <div class="item">
                            <i class="fa-solid fa-location-dot"></i>
                            <input type="text" placeholder="Address" name="address_deliver" value="<?php $x = ($_POST['address_deliver'] == null) ? $ru["address"] : $_POST['address_deliver']; echo $x;?>">
                        </div>
                        <div class="item">
                            <i class="fa-solid fa-note-sticky"></i>
                            <input type="text" placeholder="Address Note" name="note_deliver" value="<?=$_POST['note_deliver'];?>">
                        </div>
                        <div class="last_item">
                            <p>Deliver - Today: <input name="date_deliver" type="date" id="date_deliver" value="<?php $x = ($_POST['date_deliver'] == "") ? date('Y-m-d') : $_POST['date_deliver']; echo $x;?>"></p>
                        </div>
                    </div>
                </div>
                <div class="info_option" style="display:none;">
                    <p>information</p>
                    <div class="info_option_content">
                        <div class="item">
                            <i class="fa-solid fa-user"></i>
                            <input type="text" placeholder="Name" name="name_store" value="<?php $x = ($_POST['name_store'] == null) ? $ru["fullname"] : $_POST['name_store']; echo $x;?>">
                        </div>
                        <div class="item">
                            <i class="fa-solid fa-phone"></i>
                            <input type="text" placeholder="Phone number" name="phone_store" value="<?php $x = ($_POST['phone_store'] == null && $ru["phonenumber"] != null) ? 0 . $ru["phonenumber"] : $_POST['phone_store']; echo $x;?>">
                        </div>
                        <p>Address to receive</p>
                        <div class="item">
                            <i class="fa-solid fa-location-dot"></i>
                            <input type="text" value="K97 Nguyễn Lương Bằng, Liên Chiểu, TP Đà Nẵng" disabled>
                        </div>
                        <div class="last_item">
                            <p>Receive - Today: <input name="date_store" type="date" value="<?php $x = ($_POST['date_store'] == "") ? date('Y-m-d') : $_POST['date_store']; echo $x;?>"></p>
                        </div>
                    </div>
                </div>
                <div class="info_product">
                    <p>Information</p>
                    <div class="info_product_content">
                        <div class="list_item">
                            <?php if(count($_SESSION['cart']) > 0){?>
                                <?php foreach($_SESSION['cart'] as $i){?>
                                    <div class="item item-cart" price="<?=$i[2];?>">
                                        <img src="../../public/uploads/<?=$i[5];?>" alt="">
                                        <div>
                                            <h3><?=$i[1];?></h3>
                                            <p><?=$i[4];?></p>
                                            <span><?=$i[2];?> x <span class="amount-cart-item"><?=$i[3];?></span> = <span class="total-cart-item"><?=$i[2];?></span></span>
                                        </div>
                                    </div>
                                <?php }?>
                            <?php }else{?>
                                <p style="font-weight: 800;font-size:19px;text-align:center;">No item!!</p>
                            <?php }?>
                        </div>
                        <div class="info">
                            <div class="top">
                                <div class="item">
                                    <p>Price:</p>
                                    <span class="total-all-cart">0</span>
                                </div>
                                <p class="quantity">quantity: <span class="quantity_number">2</span></p>
                            </div>
                            <div class="item">
                                <p>Transport fee:</p>
                                <span class="transport_fee">0đ</span>
                            </div>
                            <div class="item">
                                <p>Total:</p>
                                <span class="total">0đ</span>
                                <input type="text" name="price" id="total_input" style="display:none">
                            </div>
                        </div>
                        <div class="button">
                            <textarea name="note" id="" cols="30" rows="10" placeholder="Some note..."><?=$_POST['note'];?></textarea>
                            <?php if(count($_SESSION['cart']) > 0){?>
                            <button id="order_btn" name="order_deliver">Order</button>
                            <?php }else{?>
                            <button class="disabled_btn" disabled>Order</button>
                            <?php }?>
                            <button type="button" id="return">Return</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="../../public/js/Checkout.js"></script>
</body>
</html>