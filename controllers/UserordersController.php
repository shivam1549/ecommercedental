<?php
class UserordersController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function get_orders($user_id){
        $sql = "SELECT * FROM orders WHERE customer_id = '$user_id' ORDER BY id DESC";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }
        else{
            return false;
        }
    }

    public function get_ordered_items($id){
        $sql = "SELECT product_id, quantity, total, item_status, order_items.id FROM order_items INNER JOIN order_items_status
        ON order_items.id = order_items_status.order_item_id
        WHERE order_items.order_id = '$id' LIMIT 1 
        ";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }
        else{
            return false;
        }
    }

    public function getOrderid($id){
        $sql = "SELECT order_id FROM order_items WHERE id ='$id' LIMIT 1";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
           $data = $result->fetch_assoc();
           return $data;
        }
        else{
            return false; 
        }
    }

    public function orderDetails($orderId){
        $sql = "SELECT * FROM orders WHERE id = '$orderId' LIMIT 1";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
           $data = $result->fetch_assoc();
           return $data;
        }
        else{
            return false; 
        }
    }
}
?>