<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <?php include ('../../config/framework.php'); ?>
    <?php include ('../../notification/notification.php'); ?>
    <?php include ('../../config/config.php'); ?>
    <?php include ('../../config/loader.php'); ?>
    <?php include ('../model/Product.php'); ?>
    <link rel="stylesheet" href="../../public/css/HomePage.css">
</head>
<body>
    <div class="header">
        <div class="left">
            <a href="./UserController.php?act=HomePage" class="logo"><img src="https://tocotocotea.com/wp-content/uploads/2021/04/Logo-ngang-01.png" alt=""></a>
            <ul>
                <a href="./UserController.php?act=HomePage"><li>Home</li></a>
                <a href=""><li>Introduce</li></a>
                <a href="./UserController.php?act=Product"><li>Product</li></a>
                <a href=""><li>Store</li></a>
            </ul>
        </div>
        <div class="right">
            <i id="icon_search_input" class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="search_input" style="width: 0vh;background-color:transparent;">
            <div class="result-search">
                <?php 
                    $n = new Product("","","","","","");
                    $t = $n->get();
                    while ($i = $t->fetch()){
                ?>
                        <div class="item item-result-search" name="<?=$i['name'];?>">
                            <a href="./UserController.php?act=Product&product=<?=$i['id'];?>">
                            <img src="../../public/uploads/<?=$i['image'];?>" alt="">
                            <div>
                                <p class="info_name"><?=$i['name'];?></p>
                                <span><?php calculate($i['price'],$i['discount']);?></span>
                            </div>
                        </a>
                        </div>
                <?php }?>
                </div>
        </div>
        <!-- <div class="tamthoi">
            <a style="padding:5px 10px;border-radius:5px;background-color:#d8b979;color:white;text-transform: capitalize;margin-left:20px;" href="./UserController.php?act=AdminCategory&option=list">Quản lí website(tạm thời)</a>
        </div> -->
    </div>
    <div class="menu">
        <div class="title">
            <p>MENU</p>
            <span>Outstanding Product</span>
        </div>
        <div class="list-item">
        <?php 
            $n = new Product("","","","","","");
            $t = $n->get_display    ();
            while ($i = $t->fetch()){
        ?>
            <a class="product" href="./UserController.php?act=Product&product=<?= $i['id']; ?>"><div class="item">
                <div class="image">
                    <img src="../../public/uploads/<?= $i['image']; ?>" alt="">
                    <p class="discount"><?= $i['discount']; ?>%</p>
                </div>
                <div class="info">
                    <h3 class="info_name"><?= $i['name']; ?></h3>
                    <p><?php calculate($i['price'],$i['discount']); ?><del><?= $i['price']; ?>.000đ</del></p>
                    <button>Order</button>
                </div>
            </div></a>
        <?php }?>
        </div>
        <button id="ShowAll">Show All</button>
    </div>
    <div class="introduce">
        <img src="../../public/uploads/intro1.png" alt="">
        <img src="../../public/uploads/intro2.png" alt="">
    </div>
    <div class="footer">
        <img src="../../public/uploads/footer.png" alt="">
    </div>
    <script src="../../public/js/HomePage.js"></script>
</body>
</html>