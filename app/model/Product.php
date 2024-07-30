<?php
class Product{
    public $name,$price,$discount,$image,$display,$category;
    public function __construct($name,$price,$discount,$image,$display,$category){
        if(isset($_FILES['image'])) move_uploaded_file($_FILES['image']['tmp_name'],'../../public/uploads/'. $_FILES['image']['name']);
        if(!isset($this->image)) $this->image ="";
        $this->name = $name;
        $this->price = $price;
        $this->discount = $discount;
        $this->image = $image;
        $this->display = $display;
        $this->category = $category;
    }
    public function get(){
        $db = new connect();
        $strQuery = "select * from products order by id DESC";
        $r = $db->getList($strQuery);
        return $r;
    }
    public function get_display(){
        $db = new connect();
        $strQuery = "select * from products where display = 'show' order by view DESC";
        $r = $db->getList($strQuery);
        return $r;
    }
    public function get_id($id){
        $db = new connect();
        $strQuery = "select * from products where id='$id'";
        $r = $db->getInstance($strQuery);
        return $r;
    }
    public function get_category($category){
        $db = new connect();
        $strQuery = "select * from products where id_category='$category' and display = 'show'";
        $r = $db->getList($strQuery);
        return $r;
    }
    public function add(){
        $db = new connect();
        $strQuery = "insert into products(name, price, discount, image, display, id_category) values 
                    ('$this->name','$this->price','$this->discount','$this->image','$this->display','$this->category')";
        $r = $db->getInstance($strQuery);
        if($this->name != null){
            header('location: ./UserController.php?act=AdminProduct&option=list');
        }else{
            $_POST['name'] = $this->name;
            $_POST['price'] = $this->price;
            $_POST['discount'] = $this->discount;
            $_POST['display'] = $this->display;
            $_POST['category'] = $this->category;
        }
    }
    public function update($id){
        $db = new connect();
        if($this->image != ""){
            $strQuery = "update products set name = '$this->name', price = '$this->price', discount = '$this->discount', image = '$this->image', display = '$this->display', id_category = '$this->category' where id = '$id'";
            $r = $db->getInstance($strQuery);
            header('location: ./UserController.php?act=AdminProduct&option=list');
        }else{
            $strQuery = "update products set name = '$this->name', price = '$this->price', discount = '$this->discount', display = '$this->display', id_category = '$this->category' where id = '$id'";
            $r = $db->getInstance($strQuery);
            header('location: ./UserController.php?act=AdminProduct&option=list');
        }
    }
    public function delete($id){
        $db = new connect();
        $strQuery = "delete from products where id = '$id'";
        $r = $db->getInstance($strQuery);
        header('location: ./UserController.php?act=AdminProduct&option=list');
    }
    public function increase_view($product){
        $db = new connect();
        $strQuery = "update products set view = view+1 where id = '$product'";
        $r = $db->getInstance($strQuery);
    }
    public function add_to_cart($id,$name,$price,$quantity,$option,$image){
        $arr = array($id,$name,$price,$quantity,$option,$image);
        if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
        if(count($_SESSION['cart']) > 0){
            if(!in_array($id,$_SESSION['cart'])){
                $_SESSION['cart'][$id]= $arr;
            }
        }else{
            $_SESSION['cart'][$id]= $arr;
        }
    }
}
function calculate($origin_price,$discount){
    $discount_price = ( $origin_price / 100) * $discount;
    $result = $origin_price - $discount_price;
    echo round($result) . ".000đ";
}
?>