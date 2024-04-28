<?php
class RelatedProductController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function getcategoryProducts($productid)
    {

        $sql = "SELECT category_id FROM product_category WHERE product_id = '$productid'";
        $result = $this->conn->query($sql);
        if ($result) {
            $category_id = array();
            foreach ($result as $row) {
                $category_id[] = $row['category_id'];
            }
            // print_r($category_id);
            $getproducts = $this->getproductsId($category_id, $productid);
            if($getproducts){
                return $getproducts;
            }
            else{
                return false;
            }
        }
    }

    public function getproductsId($category_id, $prod_id)
    {
        $data = array();
        // print_r($category_id);
        $arrlength = count($category_id);
        if ($arrlength != '0') {
            for ($x = 0; $x < $arrlength; $x++) {
               $sql = "SELECT product_id FROM product_category WHERE category_id = '$category_id[$x]'";
                $resultcategory = $this->conn->query($sql);
                if ($resultcategory) {
                    foreach ($resultcategory as $category) {
                        $prodid[] = $category['product_id'];
                    }
                }
            }
        }
        $unique_products = array_unique($prodid);
        // print_r($unique_products);
        foreach ($unique_products as $productids) {
            $sql = "SELECT * FROM product WHERE status ='0' AND id ='$productids' AND id !='$prod_id'";
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

    public function getRelatedsidebarproducts(){
        $sql = "SELECT * FROM product WHERE status ='0' AND sale_tag ='bestselling'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
           return $result;
        }
        else{
            return false;
        }
    }
}
