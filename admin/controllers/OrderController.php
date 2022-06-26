<?php
class OrderController
{
    public function __construct()
    {
        $db = new Databaseconnection;
        $this->conn = $db->conn;
    }

    public function index()
    {
        $sql = "SELECT * FROM `orders` ORDER BY ID DESC";
        $result = $this->conn->query($sql);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }
    
       public function export()
    {
        $sql = "SELECT * FROM `orders`";
        $result = $this->conn->query($sql);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function editorder($id)
    {
        $getOrders = "SELECT * FROM orders WHERE id = '$id' LIMIT 1";
        $result = $this->conn->query($getOrders);
        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }

    public function getorderItems($orderid)
    {
        $orderitems = "SELECT * FROM order_items WHERE order_id ='$orderid'";
        $result = $this->conn->query($orderitems);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function update_order_item_status($order_item_id, $order_status)
    {
        $sql = "UPDATE order_items_status SET item_status = '$order_status' WHERE order_item_id = '$order_item_id'";
        $result = $this->conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getOrdereditemstatus($itemid){
      $sql ="SELECT * FROM order_items_status WHERE order_item_id='$itemid' LIMIT 1";
           $result = $this->conn->query($sql);
        //   print_r($result);
         if ($result->num_rows >0 ) {
            $item_status_data = $result->fetch_assoc();
            // print_r($item_status_data);
            return $item_status_data;
        } else {
            return false;
        }
    }
    
    public function orderComplete($orderedid, $orderedstatus){
        // echo  $orderedstatus;
        $sql = "UPDATE orders SET status = '$orderedstatus'";
        if($orderedstatus == 'Delivered'){
        $sql .=" ,payment_info = 'completed' ";
        }
        $sql .= " WHERE id = '$orderedid'";
          $result = $this->conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
