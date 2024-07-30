<?php
class Category{
    public $name,$id;
    public function __construct($name,$id){
        $this->name = $name;
        $this->id = $id;
    }
    public function check_FK($id){
        $db = new connect();
        $strQuery = "select * from products where id_category = '$id'";
        $r = $db->getList($strQuery);
        if($r->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function get(){
        $db = new connect();
        $strQuery = "select * from categories";
        $r = $db->getList($strQuery);
        return $r;
    }
    public function get_id(){
        $db = new connect();
        $strQuery = "select * from categories where id='$this->id'";
        $r = $db->getInstance($strQuery);
        return $r;
    }
    public function add(){
        $db = new connect();
        $strQuery = "insert into categories(name) values ('$this->name')";
        $r = $db->getInstance($strQuery);
        header('location: ./UserController.php?act=AdminCategory&option=list');
    }
    public function update(){
        $db = new connect();
        $strQuery = "update categories set name ='$this->name' where id = '$this->id'";
        $r = $db->getInstance($strQuery);
        header('location: ./UserController.php?act=AdminCategory&option=list');
    }
    public function delete(){
        $db = new connect();
        $strQuery = "delete from categories where id = '$this->id'";
        $r = $db->getInstance($strQuery);
        header('Location: UserController.php?act=AdminCategory&option=list');
    }
}
?>