<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="../../public/css/Admin.css">
</head>
<?php include ('../../config/framework.php'); ?>
<?php include ('../../config/config.php'); ?>
<?php include ('../../config/loader.php'); ?>
<?php include ('../../notification/notification.php'); ?>
<?php include ('../model/User.php'); ?>
<?php 
if(!isset($_POST['username'])) $_POST['username'] = null;
if(!isset($_POST['password']))$_POST['password'] = null;
if(!isset($_POST['phone']))$_POST['phone'] = null;
if(!isset($_POST['fullname']))$_POST['fullname'] = null;
if(!isset($_POST['email']))$_POST['email'] = null;
if(!isset($_POST['address']))$_POST['address'] = null;
if(!isset($_POST['role']))$_POST['role'] = "user";
if(!isset($_POST['active']))$_POST['active'] = "non-active";
if(isset($_POST['add'])){
    $r = new User($_POST['username'],$_POST['password'],$_POST['phone'],$_POST['fullname'],$_FILES['image']['name'],$_POST['email'],$_POST['address'],$_POST['role'],$_POST['active']);
    $r->add();
}
if(isset($_POST['update'])){
    $r = new User($_GET['username'],$_POST['password'],$_POST['phone'],$_POST['fullname'],$_FILES['image']['name'],$_POST['email'],$_POST['address'],$_POST['role'],$_POST['active']);
    $r->update();
}
if(isset($_GET['delete']) && !empty($_GET['delete'])){
    $r = new User($_GET['delete'],"","","","","","","","");
    $r->delete();
}
?>
<body>
    <div class="contain">
    <?php include ('../../public/view/layout/nav-admin.php'); ?>
    <?php if($_GET['option'] == "add"){?>
        <div class="content">
            <form action="" method="post" enctype="multipart/form-data">
                <h2>Add User</h2>
                <div class="form ">
                    <div>
                        <label for="">username</label>
                        <input type="text" name="username" required value="<?=$_POST['username']?>">
                    </div>
                    <div>
                        <label for="">password</label>
                        <input type="text" name="password" required value="<?=$_POST['password']?>">
                    </div>
                    <div>
                        <label for="">phone number</label>
                        <input type="text" name="phone" value="<?=$_POST['phone']?>">
                    </div>
                    <div>
                        <label for="">fullname</label>
                        <input type="text" name="fullname" value="<?=$_POST['fullname']?>">
                    </div>
                    <div>
                        <label for="">image</label>
                        <input type="file" name="image">
                    </div>
                    <div>
                        <label for="">email</label>
                        <input type="email" name="email"  value="<?=$_POST['email']?>">
                    </div>
                    <div>
                        <label for="">address</label>
                        <input type="text" name="address" value="<?=$_POST['address']?>">
                    </div>
                    <div>
                        <label for="">role</label>
                        <div>
                            <p><input type="radio" name="role" value="user" <?php if($_POST['role'] == 'user') echo"checked"; ?>>User</p>
                            <p><input type="radio" name="role" value="staff" <?php if($_POST['role'] == 'staff') echo"checked"; ?>>Staff</p>
                        </div>
                    </div>
                    <div>
                        <label for="">active</label>
                        <div>
                            <p><input type="radio" name="active" value="non-active" <?php if($_POST['active'] == 'non-active') echo"checked"; ?>>Non-active</p>
                            <p><input type="radio" name="active" value="active" <?php if($_POST['active'] == 'active') echo"checked"; ?>>Active</p>
                        </div>
                    </div>
                </div>
                <button name="add">Add User</button>
            </form>
        </div>
    <?php }?>
    <?php if($_GET['option'] == "list"){?>
        <div class="content">
            <table>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                <?php
                    $n = new User("","","","","","","","","");
                    $r = $n->get();
                    while ($rs = $r->fetch()){
                ?>
                <tr>
                    <td class="td"><?= $rs['username'];?></td>
                    <td class="td"><?= $rs['fullname'];?></td>
                    <td class="td"><img src="../../public/uploads/<?= $rs['image'];?>" alt=""></td>
                    <td class="td"><?= $rs['email'];?></td>
                    <td class="td"><?php $x = ($rs['phonenumber'] == null) ?  "" : 0 . $rs['phonenumber']; echo $x; ?></td>
                    <td class="td"><?= $rs['address'];?></td>
                    <td class="td"><?= $rs['role'];?></td>
                    <td class="td"><?= $rs['active'];?></td>
                    <td>
                        <?php if($rs['username'] != "admin"){ ?>
                        <div>
                            <a href="./usercontroller.php?act=AdminUser&option=update&username=<?= $rs['username'];?>">Update</a>
                            <a onclick="return confirm('Do You Want To Delete This User?');" href="./usercontroller.php?act=AdminUser&option=update&delete=<?= $rs['username'];?>">Delete</a>
                        </div>
                        <?php }?>
                    </td>
                </tr>
                <?php }?>
            </table>
        </div>
    <?php }?>
    <?php if($_GET['option'] == "update"){?>
        <?php 
        $n = new User($_GET['username'],"","","","","","","","");
        $r = $n->get_username();
        ?>
        <div class="content">
        <form action="" method="post" enctype="multipart/form-data">
                <h2>Update User</h2>
                <div class="form ">
                    <div>
                        <label for="">username</label>
                        <input type="text" name="username" disabled value="<?= $r['username'];?>" >
                    </div>
                    <div>
                        <label for="">password</label>
                        <input type="text" name="password" required value="<?= $r['password'];?>">
                    </div>
                    <div>
                        <label for="">phone number</label>
                        <input type="text" name="phone" value="<?php $x = ($r['phonenumber'] == null) ?  "" : 0 . $r['phonenumber']; echo $x; ?>">
                    </div>
                    <div>
                        <label for="">fullname</label>
                        <input type="text" name="fullname" value="<?= $r['fullname'];?>">
                    </div>
                    <div>
                        <label for="">image</label>
                        <div class="image">
                            <img src="../../public/uploads/<?= $r['image']; ?>" alt="">
                            <input type="file" name="image">
                        </div>
                    </div>
                    <div>
                        <label for="">email</label>
                        <input type="email" name="email" value="<?= $r['email'];?>">
                    </div>
                    <div>
                        <label for="">address</label>
                        <input type="text" name="address" value="<?= $r['address'];?>">
                    </div>
                    <div>
                        <label for="">role</label>
                        <div>
                            <p><input type="radio" name="role" value="user" <?php if($r['role'] == "user") echo"checked"?>>User</p>
                            <p><input type="radio" name="role" value="staff" <?php if($r['role'] == "staff") echo"checked"?>>Staff</p>
                        </div>
                    </div>
                    <div>
                        <label for="">active</label>
                        <div>
                            <p><input type="radio" name="active" value="non-active" <?php if($r['active'] == "non-active") echo"checked"?>>Non-active</p>
                            <p><input type="radio" name="active" value="active" <?php if($r['active'] == "active") echo"checked"?>>Active</p>
                        </div>
                    </div>
                </div>
                <button name="update">Update User</button>
            </form>
        </div>
    <?php }?>
    </div>
    <script src="../../public/js/mini_popup.js"></script>
</body>
</html>