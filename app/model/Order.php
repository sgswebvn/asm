<?php
class Order{
    public $id_user,$name,$phone,$address,$date,$price,$note,$status,$type;
    public function __construct($id_user,$name,$phone,$address,$date,$price,$note,$status,$type){
        $this->id_user = $id_user;
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
        $this->date = $date;
        $this->price = $price;
        $this->note = $note;
        $this->status = $status;
        $this->type = $type;
    }
    public function get(){
        $db = new connect();
        $strQuery = "select * from orders order by date ASC";
        $r = $db->getList($strQuery);
        return $r;
    }
    public function get_username(){
        $db = new connect();
        if($this->type == "deliver"){
            $strQuery = "select * from orders where type = 'deliver' and id_user = '$this->id_user'";
            $r = $db->getList($strQuery);
        }else{
            $strQuery = "select * from orders where type = 'store' and id_user = '$this->id_user'";
            $r = $db->getList($strQuery);
        }
        return $r;
    }
    public function get_detailOrders($id_order){
        $db = new connect();
        $strQuery = "select * from detailorders where id_order = '$id_order'";
        $r = $db->getList($strQuery);
        return $r;
    }
    public function update_status($id_order,$content){
        $db = new connect();
        $strQuery = "update Orders set status = '$content' where id = '$id_order'";
        $r = $db->getInstance($strQuery);
        return $r;
    }
    public function delete($id){
        $db = new connect();
        $strQuery = "delete from detailOrders where id_order = '$id'";
        $r = $db->getInstance($strQuery);
        $strQuery = "delete from orders where id = '$id'";
        $r = $db->getInstance($strQuery);
        header('location: ./UserController.php?act=AdminOrder&option=list');
    }
    public function add(){
        // echo $this->id_user,$this->name,$this->phone,$this->address,$this->date,$this->price,$this->note,$this->status,$this->type;
        $db = new connect();
        if($this->type == "deliver"){
            $this->address = $this->address . " - Note: " . $_POST['note_deliver'];
            if($this->name != null && $this->phone != null && $this->address != null){
                if($this->phone != null && strlen($this->phone) == 10 && is_numeric($this->phone)){
                    if($this->date >= date('Y-m-d')){
                        $strQuery = "insert into Orders(id_user, name, phonenumber, address, date, price, note, status, type) values 
                                    ('$this->id_user','$this->name','$this->phone','$this->address','$this->date','$this->price','$this->note','$this->status','$this->type')";
                        $r = $db->getInstance($strQuery);
                        $rs = $db->get_last_insert_id();
                        $id_order = $rs->lastInsertId();
                        $cart = $_SESSION['cart'];
                        foreach($cart as $i){
                            $strQuery = "insert into detailOrders(id_product, id_order, name, price, quantity, option_content, image) values ('$i[0]','$id_order','$i[1]','$i[2]','$i[3]','$i[4]','$i[5]')";
                            $r = $db->getInstance($strQuery);
                        } 
                        unset($_SESSION['cart']);
                        header('Location: ./UserController.php?act=Product');
                    }else{
                        fail('invalid date');
                        $_POST['name_deliver'] = $this->name;
                        $_POST['phone_deliver'] = $this->phone;
                        $_POST['address_deliver'] = $_POST['address_deliver'];
                        $_POST['note_deliver'] = $_POST['note_deliver'];
                        $_POST['date_deliver'] = $this->date;
                        $_POST['note'] = $this->note;
                    }
                }else{
                    fail('invalid phone number');
                    $_POST['name_deliver'] = $this->name;
                    $_POST['phone_deliver'] = $this->phone;
                    $_POST['address_deliver'] = $_POST['address_deliver'];
                    $_POST['note_deliver'] = $_POST['note_deliver'];
                    $_POST['date_deliver'] = $this->date;
                    $_POST['note'] = $this->note;
                }
            }else{
                fail('Please enter full name, phone number, address');
                $_POST['name_deliver'] = $this->name;
                $_POST['phone_deliver'] = $this->phone;
                $_POST['address_deliver'] = $_POST['address_deliver'];
                $_POST['note_deliver'] = $_POST['note_deliver'];
                $_POST['date_deliver'] = $this->date;
                $_POST['note'] = $this->note;
            }
        }
        if($this->type == "store"){
            if($this->name != null && $this->phone != null){
                if($this->phone != null && strlen($this->phone) == 10 && is_numeric($this->phone)){
                    if($this->date >= date('Y-m-d')){
                        $strQuery = "insert into Orders(id_user, name, phonenumber, address, date, price, note, status, type) values 
                                    ('$this->id_user','$this->name','$this->phone','$this->address','$this->date','$this->price','$this->note','$this->status','$this->type')";
                        $r = $db->getInstance($strQuery);
                        $rs = $db->get_last_insert_id();
                        $id_order = $rs->lastInsertId();
                        $cart = $_SESSION['cart'];
                        foreach($cart as $i){
                            $strQuery = "insert into detailOrders(id_product, id_order, name, price, quantity, option_content, image) values ('$i[0]','$id_order','$i[1]','$i[2]','$i[3]','$i[4]','$i[5]')";
                            $r = $db->getInstance($strQuery);
                        } 
                        unset($_SESSION['cart']);
                        header('Location: ./UserController.php?act=Product');
                    }else{
                        fail('invalid date');
                        $_POST['name_store'] = $this->name;
                        $_POST['phone_store'] = $this->phone;
                        $_POST['date_store'] = $this->date;
                        $_POST['note'] = $this->note;
                    }
                }else{
                    fail('invalid phone number');
                    $_POST['name_store'] = $this->name;
                    $_POST['phone_store'] = $this->phone;
                    $_POST['date_store'] = $this->date;
                    $_POST['note'] = $this->note;
                }
            }else{
                fail('Please enter full name, phone number');
                $_POST['name_store'] = $this->name;
                $_POST['phone_store'] = $this->phone;
                $_POST['date_store'] = $this->date;
                $_POST['note'] = $this->note;
            }
        }
    }
}
?>