<?php
class WishlistController
{
    public function __construct()
    {
        $db = new Databaseconnection;
        $this->conn = $db->conn;
    }

    public function create($productid, $customerid)
    {
        date_default_timezone_set('Asia/Kolkata');
        $created_at = date('Y-m-d H:i:s');
        $sql = "INSERT INTO wishlist (customer_id, product_id, created_at) VALUES ('$customerid', '$productid', '$created_at')";
        $result = $this->conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function checkifexist($productid, $customerid)
    {
        $sql = "SELECT * FROM wishlist WHERE customer_id = '$customerid' AND product_id ='$productid'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function getwishList($customerid)
    {
        $sql = "SELECT * FROM wishlist WHERE customer_id = '$customerid'";
        $result = $this->conn->query($sql);
        $data = array();
        if ($result) {
            foreach ($result as $row) {
                $prodid = $row['product_id'];
                $sql = "SELECT * FROM product WHERE id ='$prodid'";
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
       
    }

    public function deletewishlist($productid, $customerid)
    {
        $sql = "DELETE FROM wishlist WHERE customer_id = '$customerid' AND product_id ='$productid'";
        $result = $this->conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
