<?php
class AdminController
{
    public function __construct()
    {
        $db = new Databaseconnection;
        $this->conn = $db->conn;
    }
    
    public function shippedProducts(){
        $sql = "SELECT * FROM order_items_status WHERE item_status = 'Shipped'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $numrows = $result->num_rows;
            return $numrows;
        }
        else{
            return false;
        }
    }
    
    public function getAllproducts(){
        $sql = "SELECT * FROM `product` WHERE status = '0'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $numrows = $result->num_rows;
            return $numrows;
        }
        else{
            return false;
        }
    }
    
       public function gettotalOrders(){
        $sql = "SELECT * FROM `orders` WHERE status != 'Cancel'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $numrows = $result->num_rows;
            return $numrows;
        }
        else{
            return false;
        }
    }
    
       public function getNeworders()
    {
        $sql = "SELECT * FROM `orders` WHERE status ='Order Placed' ORDER BY ID DESC";
        $result = $this->conn->query($sql);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    
    public function getnumberOfneworders(){
          $sql = "SELECT * FROM `orders` WHERE status = 'Order Placed'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $numrows = $result->num_rows;
            return $numrows;
        }
        else{
            return false;
        }
    }
    
      public function cutomerQueries(){
        $sql = "SELECT * FROM `customer_query` WHERE status = '1'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $numrows = $result->num_rows;
            return $numrows;
        }
        else{
            return false;
        }
    }
}