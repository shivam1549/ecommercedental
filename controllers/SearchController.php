<?php
class SearchController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function getsearchProduct($producttype, $price_filter, $sorting)
    {
        $min = 1;
        $sql = "SELECT * FROM product WHERE status = '0' AND (name LIKE '%$producttype%' OR long_desc LIKE '%$producttype%' OR short_decs LIKE '%$producttype%')";
        if (!empty($price_filter)) {
            $sql .= "AND price BETWEEN '$min' AND '$price_filter'";
        }
        if(!empty($sorting)){
            if($sorting == 'high'){
                $sql .= "ORDER BY price ASC";
            }
            else{
                $sql .= "ORDER BY price DESC"; 
            }
        }
        $result = $this->conn->query($sql);
        // print_r($result);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
}
