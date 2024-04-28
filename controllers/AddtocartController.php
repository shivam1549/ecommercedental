<?php
class AddtocartController
{
    public function __construct()
    {
        $db = new Databaseconnection;
        $this->conn = $db->conn;
    }
    public function addCart($productid, $prod_quantity)
    {
        $sql = "SELECT * FROM product WHERE id = '$productid' LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $dataproduct = $result->fetch_assoc();
            if (isset($_SESSION["add-to-cart"])) {
                $data_array_id = array_column($_SESSION["add-to-cart"], "productid");
                if (!in_array($productid, $data_array_id)) {
                    $count = count($_SESSION["add-to-cart"]);
                    $data = array(
                        'productid' => $productid,
                        'prod_name' =>  $dataproduct['name'],
                        'prod_url' => $dataproduct['url'],
                        'prod_image' => $dataproduct['image'],
                        'price' => $dataproduct['price'],
                        'sku' => $dataproduct['sku'],
                        'prod_quant' => $prod_quantity,
                        'max-quantity' =>$dataproduct['quantity']
                    );
                    $_SESSION["add-to-cart"][$count] = $data;
                } else {
                    return false;
                }
            } else {
                $data = array(
                    'productid' => $productid,
                    'prod_name' => $dataproduct['name'],
                    'prod_image' => $dataproduct['image'],
                    'prod_url' => $dataproduct['url'],
                    'price' => $dataproduct['price'],
                    'sku' => $dataproduct['sku'],
                    'prod_quant' => $prod_quantity,
                    'max-quantity' =>$dataproduct['quantity']
                );
                $_SESSION["add-to-cart"][0] = $data;
            }
            return true;
        }
    }
    public function deleteCart($productid)
    {
        if (isset($_SESSION["add-to-cart"])) {
            foreach ($_SESSION["add-to-cart"] as $keys => $prod_values) {
                if ($prod_values['productid'] == $productid) {
                    unset($_SESSION["add-to-cart"][$keys]);
                    return true;
                }
            }
        }
    }
    
}
