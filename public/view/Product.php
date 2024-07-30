<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <?php include ('../../config/loader.php'); ?>
    <?php include ('../../config/framework.php'); ?>
    <?php include ('../../config/config.php'); ?>
    <?php include ('../model/Category.php'); ?>
    <?php include ('../../notification/notification.php'); ?>
    <?php include ('../model/Product.php'); ?>
    <link rel="stylesheet" href="../../public/css/Product.css">
</head>
<?php 
if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];  
if(isset($_GET['id']) && isset($_GET['name']) && isset($_GET['price']) && isset($_GET['quantity']) && isset($_GET['option'])){
    $n = new Product("","","","","","");
    $n->add_to_cart($_GET['id'],$_GET['name'],$_GET['price'],$_GET['quantity'],$_GET['option'],$_GET['image']);
    header('Location: ./UserController.php?act=Product');
}
if(isset($_GET['id_product']) && isset($_GET['change_quantity'])){
    $id_product = $_GET['id_product'];
    $change_quantity = $_GET['change_quantity'];
    $_SESSION['cart'][$id_product][3] = $change_quantity;
    header('location: ./UserController.php?act=Product');
}
if(isset($_GET['delete_cart'])){
    unset($_SESSION['cart']);
    header('Location: ./UserController.php?act=Product');
}
if(isset($_GET['delete_item_cart']) && $_GET['delete_item_cart'] != null){
    unset($_SESSION['cart'][$_GET['delete_item_cart']]);
    header('Location: ./UserController.php?act=Product');
}
if(isset($_POST['addToCart'])){
    $n = new Product("","","","","","");
    $n->add_to_cart($_GET['id'],$_GET['name'],$_GET['price'],$_GET['quantity'],$_GET['option'],$_GET['image']);
    header('Location: ./UserController.php?act=Product');
}
?>
<body>
    <?php include ('../../public/view/layout/nav.php'); ?>
    <div class="content">
        <div class="category">
            <h3>Category</h3>
            <?php 
            $n = new Category("","");
            $a = $n->get();
            while ($r = $a->fetch()){
            ?>
            <div class="item">
                <input type="checkbox" class="input_display" checked >
                <p><?= $r['name'] ?></p>
            </div>
            <?php }?>
        </div>
        <div class="product">
            <?php 
            $n = new Category("","");
            $a = $n->get();
            while ($r = $a->fetch()){
            ?>
            <div class="item-product">
                <div class="name-list-product">
                    <p><?= $r['name'] ?></p>
                    <i class="fa-solid fa-chevron-down icon-name-list-product" style="transform:rotate(0deg);"></i>
                </div>
                <div class="list-item" style=" height: auto;">
                    <?php 
                    $n = new Product("","","","","","");
                    $t = $n->get_category($r['id']);
                    while ($i = $t->fetch()){
                    ?>
                    <div class="item item_product_small" id_product=<?= $i['id']; ?>>
                        <img src="../../public/uploads/<?= $i['image']; ?>" alt="">
                        <h3><?= $i['name']; ?></h3>
                        <p><?php calculate($i['price'],$i['discount']);?><del><?= $i['price']; ?>.000đ</del></p>
                        <?php if($_SESSION['cart'] != null){
                                if(array_key_exists($i['id'],$_SESSION['cart'])){?>
                                    <i class="fa-solid fa-check"></i>
                                <?php }else{?>
                                    <a href="./UserController.php?act=Product&id=<?=$i['id'];?>&name=<?=$i['name'];?>&price=<?php calculate($i['price'],$i['discount']);?>&quantity=1&option=sugar:normal, ice:normal&image=<?=$i['image'];?>"><i class="fa-solid fa-plus"></i></a>
                                <?php }?>
                        <?php }else{?>
                            <a href="./UserController.php?act=Product&id=<?=$i['id'];?>&name=<?=$i['name'];?>&price=<?php calculate($i['price'],$i['discount']);?>&quantity=1&option=sugar:normal, ice:normal&image=<?=$i['image'];?>"><i class="fa-solid fa-plus"></i></a>
                        <?php }?>
                    </div>
                    <?php }?>
                </div>
            </div>
            <?php }?>
        </div>
        <div class="cart">
            <div class="top">
                <h3>My cart</h3>

                <a onclick="return confirm('Do You Want To Delete All?');" href="./UserController.php?act=Product&delete_cart">Delete all</a>
            </div>
            <div class="contain">
                <?php 
                    if(count($_SESSION['cart']) > 0){
                ?>
                <?php foreach($_SESSION['cart'] as $i){ ?>
                <div class="item item-cart" id_product="<?=$i[0];?>" price="<?=$i[2];?>">
                    <div class="top">
                        <div>
                            <p><?=$i[1];?></p>
                            <span><?=$i[2];?> x <span class="amount-cart-item"><?=$i[3];?></span> = <span class="total-cart-item"><?=$i[2];?></span></span>
                        </div>
                        <div class="amount">
                            <i class="fa-solid fa-minus decrease-amount-cart"></i>
                            <span class="amount-cart"><?=$i[3];?></span>
                            <i class="fa-solid fa-plus increase-amount-cart"></i>
                        </div>
                    </div>
                    <div class="bottom">
                        <a href="./UserController.php?act=Product&product=<?=$i[0];?>"><i class="fa-solid fa-wrench"></i> Edit</a>
                        <a class="delete_item_cart" onclick="return confirm('Do You Want To Delete This Item?');" href="./UserController.php?act=Product&delete_item_cart=<?=$i[0];?>"><i class="fa-solid fa-trash"></i> Delete</a>
                    </div>
                </div>
                <?php }}else{?>
                    <p style="text-align:center;">No item!</p>
                <?php }?>
            </div>
            <p>Total: <span class="total-all-cart">0d</span></p>
            <?php if(isset($_SESSION['username']) && $_SESSION['username'] != null){ ?>
                <?php if(count($_SESSION['cart']) > 0) {?>
                    <button class="pay_btn">Paying</button>
                <?php }else{?>
                    <button style="background-color:#c8c8c8;border: 1px solid #5d5d5d;">Paying</button>
                <?php }?>
            <?php }else{?>
                <a href="./UserController.php?act=Login">Login to pay</a>
            <?php }?>
        </div>
    </div>
    <?php if(isset($_GET['product']) && !empty($_GET['product'])){?>
    <?php 
        $n = new Product("","","","","","");
        if(isset($_SESSION['username']) && $_SESSION['username'] != null){
            $n->increase_view($_GET['product']);
        }
        $i = $n->get_id($_GET['product']);
    ?>
    <div class="detail" id="detail">
        <div class="product id_product" image="<?= $i['image'];?>" id_product="<?= $i['id'];?>">
            <div class="item">
                <img src="../../public/uploads/<?= $i['image']; ?>" alt="">
                <div class="info">
                    <p class="name_item"><?= $i['name']; ?></p>
                    <div class="price"><span class="price-item"><?php calculate($i['price'],$i['discount']) ?></span><del><?= $i['price']; ?>.000đ</del></div>
                    <div class="amount">
                        <div class="amount-wrap">
                            <i class="fa-solid fa-minus decrease-amount-number"></i>
                            <span class="amount-number">1</span>
                            <i class="fa-solid fa-plus increase-amount-number"></i>
                        </div>
                        <button class="total-item">+ <?php calculate($i['price'],$i['discount']) ?></button>
                    </div>
                </div>
                <i class="fa-solid fa-xmark" id="exit-detail"></i>
            </div>
            <div class="note">
                <div class="item">
                    <div class="name-detail-item">
                        <p>Sugar</p>
                        <i class="fa-solid fa-chevron-down icon-detail-item" style="transform:rotate(0deg);"></i>
                    </div>
                    <div class="contain-detail-item" style="height:auto;">
                        <div class="option">
                            <input class="option-item" type="radio" name="sugar" value="sugar:none">
                            <p>None</p>
                        </div>
                        <div class="option">
                            <input class="option-item" type="radio" name="sugar" value="sugar:less">
                            <p>Less</p>
                        </div>
                        <div class="option">
                            <input class="option-item" type="radio" name="sugar" checked value="sugar:normal">
                            <p>Normal</p>
                        </div>
                        <div class="option">
                            <input class="option-item" type="radio" name="sugar" value="sugar:more">
                            <p>More</p>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="name-detail-item">
                        <p>Ice</p>
                        <i class="fa-solid fa-chevron-down icon-detail-item" style="transform:rotate(0deg);"></i>
                    </div>
                    <div class="contain-detail-item" style="height:auto;">
                        <div class="option">
                            <input class="option-item" type="radio" name="ice" value="ice:none">
                            <p>None</p>
                        </div>
                        <div class="option">
                            <input class="option-item" type="radio" name="ice" value="ice:less">
                            <p>Less</p>
                        </div>
                        <div class="option">
                            <input class="option-item" type="radio" name="ice" checked value="ice:normal">
                            <p>Normal</p>
                        </div>
                        <div class="option">
                            <input class="option-item" type="radio" name="ice" value="ice:more">
                            <p>More</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
    <div class="popup_order">
        <form action="" method="post">

        </form>
    </div>
    <script src="../../public/js/Product.js"></script>
</body>
</html>