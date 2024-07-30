<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <?php include ('../model/Category.php'); ?>
    <?php include ('../../config/framework.php'); ?>
    <?php include ('../../config/loader.php'); ?>
    <?php include ('../../config/config.php'); ?>
    <?php include ('../../notification/notification.php'); ?>
    <link rel="stylesheet" href="../../public/css/Admin.css">
</head>
<?php 
if(isset($_POST['add'])){
    $r = new Category($_POST['name'], "");
    $r->add();
}
if(isset($_POST['update'])){
    $r = new Category($_POST['name'], $_GET['id']);
    $r->update();
}
if(isset($_GET['delete']) && !empty($_GET['delete'])){
    $r = new Category("", $_GET['delete']);
    $r->delete();
}
?>
<body>
    <div class="contain">
    <?php include ('../../public/view/layout/nav-admin.php'); ?>
    <?php if($_GET['option'] == "add"){?>
        <div class="content">
            <form action="" method="post">
                <h2>Add Category</h2>
                <div class="form form-category">
                    <div>
                        <label for="">Name</label>
                        <input type="text" name="name" required>
                    </div>
                    <div>
                        <label for="">ID</label>
                        <input type="text" disabled value="Auto">
                    </div>
                </div>
                <button name="add">Add category</button>
            </form>
        </div>
    <?php }?>
    <?php if($_GET['option'] == "list"){?>
        <div class="content">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                <?php
                    $n = new Category("","");
                    $r = $n->get();
                    while ($rs = $r->fetch()){
                ?>
                <tr>
                    <td class="td"><?= $rs['id'];?></td>
                    <td class="td"><?= $rs['name'];?></td>
                    <td>
                        <div>
                            <a href="./usercontroller.php?act=AdminCategory&option=update&id=<?= $rs['id'];?>">Update</a>
                            <?php
                                $check = $n->check_FK($rs['id']);
                                if($check){
                            ?>
                            <button disabled>Delete</button>
                            <?php }else{?>
                            <a onclick="return confirm('Do You Want To Delete This Category?');" href="./usercontroller.php?act=AdminCategory&option=update&delete=<?= $rs['id'];?>">Delete</a>
                            <?php }?>
                        </div>
                    </td>
                </tr>
                <?php }?>
            </table>
        </div>
    <?php }?>
    <?php if($_GET['option'] == "update"){?>
        <?php 
        $n = new Category("",$_GET['id']);
        $r = $n->get_id();
        ?>
        <div class="content">
            <form action="" method="post">
                <h2>Update Category</h2>
                <div class="form form-category">
                    <div>
                        <label for="">Name</label>
                        <input type="text" name="name" value="<?= $r['name'];?>" required>
                    </div>
                    <div>
                        <label for="">ID</label>
                        <input type="text" disabled value="<?= $r['id'];?>">
                    </div>
                </div>
                <button name="update">Update category</button>
            </form>
        </div>
    <?php }?>
    </div>
    <script src="../../public/js/mini_popup.js"></script>
</body>
</html>