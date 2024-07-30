<?php
 class connect{
    var $db = null;
    public function __construct() {
          $dsn = "mysql:host=localhost;dbname=asmphp2";
          $user = "root";
          $pass = "";
          $this-> db = new PDO($dsn, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
     }
    public function getList($select) {
         $result = $this->db->query($select);
         return $result;
     }
    public function getInstance($select) {
         $results = $this->db->query($select);
         $result = $results -> fetch();
         return $result;
     }
    public function exec($query) {
         $result = $this->db->exec($query);
         return $result;
    }
    public function get_last_insert_id(){
          return $this->db;
    }
}
?>