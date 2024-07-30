<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <?php include ('../../config/framework.php'); ?>
    <?php include ('../../config/config.php'); ?>
    <?php include ('../../config/loader.php'); ?>
    <?php include ('../../notification/notification.php'); ?>
    <?php include ('../model/Product.php'); ?>
    <link rel="stylesheet" href="../../public/css/Admin.css">
</head>
<?php 
if(!isset($_POST['name'])) $_POST['name'] = null;
if(!isset($_POST['price']))$_POST['price'] = null;
if(!isset($_POST['discount']))$_POST['discount'] = null;
if(!isset($_POST['category']))$_POST['category'] = null;
if(!isset($_POST['display']))$_POST['display'] = "show";
if(isset($_POST['add'])){
    $r = new Product($_POST['name'],$_POST['price'],$_POST['discount'],$_FILES['image']['name'],$_POST['display'],$_POST['category']);
    $r->add();
}
if(isset($_POST['update'])){
    $r = new Product($_POST['name'],$_POST['price'],$_POST['discount'],$_FILES['image']['name'],$_POST['display'],$_POST['category']);
    $r->update($_GET['id']);
}
if(isset($_GET['delete']) && !empty($_GET['delete'])){
    $r = new Product("","","","","","");
    $r->delete($_GET['delete']);
}
?>
<body>
    <div class="contain">
    <?php include ('../../public/view/layout/nav-admin.php'); ?>
    <?php if($_GET['option'] == "add"){?>
        <div class="content">
            <form action="" method="post" enctype="multipart/form-data">
                <h2>Add Product</h2>
                <div class="form ">
                    <div>
                        <label for="">Name</label>
                        <input type="text" name="name" required value="<?=$_POST['name']?>">
                    </div>
                    <div>
                        <label for="">Price(?.000đ)</label>
                        <input type="number" name="price" min="0" required value="<?=$_POST['price']?>">
                    </div>
                    <div>
                        <label for="">Discount(%)</label>
                        <input type="number" name="discount" min="0" max="100" required value="<?=$_POST['discount']?>">
                    </div>
                    <div>
                        <label for="">image</label>
                        <input type="file" name="image">
                    </div>
                    <div>
                        <label for="">display</label>
                        <div>
                            <p><input type="radio" name="display" value="show" <?php if($_POST['display'] == 'show') echo"checked"; ?>>Show</p>
                            <p><input type="radio" name="display" value="hide" <?php if($_POST['display'] == 'hide') echo"checked"; ?>>Hide</p>
                        </div>
                    </div>
                    <div>
                        <label for="">category</label>
                        <select name="category" id="">
                            <?php 
                            include ('../model/Category.php');
                            $n = new Category("","");
                            $a = $n->get();
                            while ($r = $a->fetch()){
                            ?>
                            <option <?php if($_POST['category'] == $r['id']) echo "selected"; ?> value="<?= $r['id']; ?>"><?= $r['name']; ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <button name="add">Add Product</button>
            </form>
        </div>
    <?php }?>
    <?php if($_GET['option'] == "list"){?>
        <div class="content">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Original Price</th>
                    <th>Discount</th>
                    <th>Price</th>
                    <th>image</th>
                    <th>display</th>
                    <th>ID_category</th>
                    <th>View</th>
                    <th>Action</th>
                </tr>
                <?php
                    $n = new Product("","","","","","");
                    $r = $n->get();
                    while ($rs = $r->fetch()){
                ?>
                <tr>
                    <td class="td"><?= $rs['name'];?></td>
                    <td class="td"><?= $rs['price'];?>.000đ</td>
                    <td class="td"><?= $rs['discount'];?>%</td>
                    <td class="td"><?php calculate($rs['price'],$rs['discount']);?></td>
                    <td class="td"><img src="../../public/uploads/<?= $rs['image'];?>" alt=""></td>
                    <td class="td"><?= $rs['display'];?></td>
                    <td class="td"><?= $rs['id_category'];?></td>
                    <td class="td"><?= $rs['view'];?></td>
                    <td>
                        <div>
                            <a href="./usercontroller.php?act=AdminProduct&option=update&id=<?= $rs['id'];?>">Update</a>
                            <a onclick="return confirm('Do You Want To Delete This Product?');" href="./usercontroller.php?act=AdminProduct&option=update&delete=<?= $rs['id'];?>">Delete</a>
                        </div>
                    </td>
                </tr>
                <?php }?>
            </table>
        </div>
    <?php }?>
    <?php if($_GET['option'] == "update"){?>
        <?php 
        $n = new Product("","","","","","");
        $r = $n->get_id($_GET['id']);
        ?>
        <div class="content">
        <form action="" method="post" enctype="multipart/form-data">
                <h2>Update Product</h2>
                <div class="form ">
                    <div>
                        <label for="">Name</label>
                        <input type="text" name="name" required value="<?= $r['name'];?>">
                    </div>
                    <div>
                        <label for="">Price(?.000)</label>
                        <input type="number" name="price" min="0" required value="<?= $r['price'];?>">
                    </div>
                    <div>
                        <label for="">Discount(%)</label>
                        <input type="number" name="discount" min="0" max="100" required value="<?= $r['discount'];?>">
                    </div>
                    <div>
                        <label for="">image</label>
                        <div class="image">
                            <img src="../../public/uploads/<?= $r['image']; ?>" alt="">
                            <input type="file" name="image">
                        </div>
                    </div>
                    <div>
                        <label for="">display</label>
                        <div>
                            <p><input type="radio" name="display" value="show" <?php if($r['display'] == 'show') echo"checked"; ?>>Show</p>
                            <p><input type="radio" name="display" value="hide" <?php if($r['display'] == 'hide') echo"checked"; ?>>Hide</p>
                        </div>
                    </div>
                    <div>
                        <label for="">category</label>
                        <select name="category" id="">
                            <?php 
                            include ('../model/Category.php');
                            $n = new Category("","");
                            $a = $n->get();
                            while ($rs = $a->fetch()){
                            ?>
                            <option <?php if($r['id_category'] == $rs['id']) echo "selected"; ?> value="<?= $rs['id']; ?>"><?= $rs['name']; ?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <button name="update">Update Product</button>
            </form>
    <?php }?>
    </div>
    <script src="../../public/js/mini_popup.js"></script>
</body>
</html>