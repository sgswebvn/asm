<?php
class User{
    public $username,$password,$phone,$fullname,$image,$email,$address,$role,$active;
    public function __construct($username,$password,$phone,$fullname,$image,$email,$address,$role,$active){
        if(isset($_FILES['image'])) move_uploaded_file($_FILES['image']['tmp_name'],'../../public/uploads/'. $_FILES['image']['name']);
        if(!isset($this->image)) $this->image ="";
        $this->username = $username;
        $this->fullname = $fullname;
        $this->password = $password;
        $this->phone = $phone;
        $this->image = $image;
        $this->email = $email;
        $this->address = $address;
        $this->role = $role;
        $this->active = $active;
    }
    public function get(){
        $db = new connect();
        $strQuery = "select * from users";
        $r = $db->getList($strQuery);
        return $r;
    }
    public function get_username(){
        $db = new connect();
        $strQuery = "select * from users where username='$this->username'";
        $r = $db->getInstance($strQuery);
        return $r;
    }
    public function login(){
        $db = new connect();
        $check = "select * from users where username = '$this->username'";
        $query = $db->getList($check);
        if($query->rowCount() > 0){
            $rs = $query->fetch();
            if($this->password === $rs['password']){
                $_SESSION['username'] = $rs['username'];
                header('location: ./UserController.php?act=Product');
            }else{
                fail("Your password is incorrect!");
                $_POST['username'] = $this->username;
                $_POST['password'] = $this->password;
            }
        }else{
            fail('The username does not exist!');
        }
    }
    public function register($re_password){
        $db = new connect();
        $check = "select * from users where username = '$this->username'";
        $query = $db->getList($check);
        if($query->rowCount() == 0){
            if($re_password === $this->password){
                $strQuery = "insert into users(username, password, phonenumber, fullname, image, email, address, role, active) values 
                            ('$this->username','$this->password','$this->phone','$this->fullname','$this->image','$this->email','$this->address','user','non-active')";
                $r = $db->getInstance($strQuery);
                header('location: ./UserController.php?act=Login');
            }else{
                fail("Your passwords do not match!");
            }
        }else{
            fail("This username has used!");
            $_POST['username'] = $this->username;
            $_POST['password'] = $this->password;
            $_POST['re-password'] = $re_password;
        }
    }
    public function update_user(){
        $db = new connect();
            if($this->phone == null || strlen($this->phone) == 10 && is_numeric($this->phone)){
                if($this->image != ""){
                    $strQuery = "update users set password = '$this->password', phonenumber = '$this->phone', fullname = '$this->fullname', image = '$this->image', email = '$this->email', address = '$this->address', role = '$this->role', active = '$this->active' where username = '$this->username'";
                    $r = $db->getInstance($strQuery);
                    header('location: ./UserController.php?act=Account');
                }else{
                    $strQuery = "update users set password = '$this->password', phonenumber = '$this->phone', fullname = '$this->fullname', email = '$this->email', address = '$this->address', role = '$this->role', active = '$this->active' where username = '$this->username'";
                    $r = $db->getInstance($strQuery);
                    header('location: ./UserController.php?act=Account');
                }
            }else{
                fail('invalid phone number');
                $_POST['fullname'] = $this->fullname;
                $_POST['phone'] = $this->phone;
                $_POST['email'] = $this->email;
                $_POST['address'] = $this->address;
            }
    }
    public function add(){
        function check_phone($phone){
            if($phone != null){
            if(strlen($phone) == 10 ){
                if(is_numeric($phone)){
                    return true;
                }else{
                    fail('invalid phone number');
                }
            }else{
                fail('invalid phone number');
            }
            }else{
                return true;
            }
        }
        $db = new connect();
        $check = "select * from users where username = '$this->username'";
        $query = $db->getList($check);
        if($query->rowCount() == 0){
            if(check_phone($this->phone)){
                $strQuery = "insert into users(username, password, phonenumber, fullname, image, email, address, role, active) values 
                            ('$this->username','$this->password','$this->phone','$this->fullname','$this->image','$this->email','$this->address','$this->role','$this->active')";
                $r = $db->getInstance($strQuery);
                header('location: ./UserController.php?act=AdminUser&option=list');
            }
        }else{
            fail("This username has used!");
            $_POST['username'] = $this->username;
            $_POST['password'] = $this->password;
            $_POST['phone'] = $this->phone;
            $_POST['fullname'] = $this->fullname;
            $_POST['email'] = $this->email;
            $_POST['address'] = $this->address;
            $_POST['role'] = $this->role;
            $_POST['active'] = $this->active;
        }
    }
    public function update(){
        function check_phone($phone){
            if($phone != null){
            if(strlen($phone) == 10 ){
                if(is_numeric($phone)){
                    return true;
                }else{
                    fail('invalid phone number');
                }
            }else{
                fail('invalid phone number');
            }
            }else{
                return true;
            }
        }
        $db = new connect();
        if(check_phone($this->phone)){
            if($this->image != ""){
                $strQuery = "update users set password = '$this->password', phonenumber = '$this->phone', fullname = '$this->fullname', image = '$this->image', email = '$this->email', address = '$this->address', role = '$this->role', active = '$this->active' where username = '$this->username'";
                $r = $db->getInstance($strQuery);
                header('location: ./UserController.php?act=AdminUser&option=list');
            }else{
                $strQuery = "update users set password = '$this->password', phonenumber = '$this->phone', fullname = '$this->fullname', email = '$this->email', address = '$this->address', role = '$this->role', active = '$this->active' where username = '$this->username'";
                $r = $db->getInstance($strQuery);
                header('location: ./UserController.php?act=AdminUser&option=list');
            }
        }
    }
    public function delete(){
        $db = new connect();
        $strQuery = "delete from users where username = '$this->username'";
        $r = $db->getInstance($strQuery);
        header('location: ./UserController.php?act=AdminUser&option=list');
    }
}
?>