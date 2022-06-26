<?php
class ProductController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }
    public function getcategoryProducts($categoryid, $price_filter)
    {
        $min = 1;
        $data =array();
        $sql = "SELECT product_id FROM product_category WHERE category_id = '$categoryid'";
        $resultcategory = $this->conn->query($sql);
        if ($resultcategory) {
            $prodid = array();
            foreach ($resultcategory as $category) {
                $prodid[] = $category['product_id'];
            }
        }
        foreach ($prodid as $productid) {
            $sql = "SELECT * FROM product WHERE status ='0' AND id ='$productid'";
            if (!empty($price_filter)) {
                $sql .= "AND price BETWEEN '$min' AND '$price_filter'";
            }
           
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                foreach ($result as $row) {
                    $data[] = $row;
                }
            }
        }
        if ($data) {
            return $data;
        } else {
            return false;
        }
    }

    public function getSingleproduct($url){
     $sql = "SELECT * FROM product WHERE url ='$url' AND status = '0' LIMIT 1";
     $result = $this->conn->query($sql);
     if ($result->num_rows >0 ) {
        $data = $result->fetch_assoc();
        return $data;
    } else {
        return false;
    }
    }


    public function getProductnamebyId($id){
        $sql = "SELECT * FROM product WHERE id ='$id' LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows >0 ) {
           return $result;
       } else {
           return false;
       }
       }

    public function homepageProducts($sale_tag){
        $sale_tag = validateInput($this->conn, $sale_tag);
        $sql = "SELECT * FROM product WHERE status = '0' AND sale_tag = '$sale_tag'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $productdata = array();
            foreach ($result as $row) {
                $productdata[] = $row;
            }
            return $productdata;
        }
    }
    
    
     public function getProdstocks($orderitemid){
        // print_r($orderitemid);
        $prod_qty =0;
        foreach($orderitemid as $itemid){
       $sql = "SELECT * FROM order_items WHERE id ='$itemid'";
        $result = $this->conn->query($sql);
           if ($result->num_rows > 0) {
               
                 foreach($result as $row_data){
                  $prod_qty =   $prod_qty + $row_data['quantity'];
                 }   
           }
        }
        return $prod_qty;
       
    }
    
    public function checkStockunit($id){
       $sql = "SELECT * FROM order_items WHERE product_id = '$id'";
         $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $orderitemid = array();
             $order_itemid = array();
          foreach($result as $row_data){
            $order_itemid[] =  $row_data['id'];
            $order_itemqty =  $row_data['quantity'];
          
          }
        }
        
        // print_r($order_itemid);
        
        foreach($order_itemid as $orderitems){
            $sqlitem = "SELECT * FROM order_items_status WHERE order_item_id ='$orderitems' AND item_status != 'Cancelled'";
            $resultitems = $this->conn->query($sqlitem);
            if( $resultitems){
               foreach($resultitems as $orderitem) {
                 $orderitemid[] =  $orderitem['order_item_id'];
               }
            }
        }
        //  print_r($orderitemid);
          $getprodstck = $this->getProdstocks($orderitemid);
        //   echo $getprodstck;
          if($getprodstck){
             return $getprodstck; 
          }
          else{
              return false;
          }
        
    }
}
