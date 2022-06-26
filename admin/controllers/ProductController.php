<?php
class ProductController
{
    public function __construct()
    {
        $db = new Databaseconnection;
        $this->conn = $db->conn;
    }

    public function validateImage($main_imagetmp, $main_image, $main_image_size)
    {
        $target_dir = "../assets/product-images/";
        $target_file = $target_dir . basename($main_image);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($main_imagetmp);
            if ($check !== false) {
               
                $uploadOk = 1;
            } else {
               
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        // if (file_exists($target_file)) {
        //     echo "Sorry, file already exists.";
        //     $uploadOk = 0;
        // }

        // Check file size
        if ($main_image_size > 500000) {
         
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"  && $imageFileType != "webp"
        ) {
          
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return false;
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($main_imagetmp, $target_file)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function updateProdcategory($last_prod_id, $category_id){
        $arrlength = count($category_id);
        if($arrlength != '0'){
        for ($x = 0; $x < $arrlength; $x++) {
             $sql = "SELECT * FROM product_category WHERE product_id = '$last_prod_id' AND category_id = '$category_id[$x]'";
            $result = $this->conn->query($sql);
            // print_r($result);
            if ($result ->num_rows > 0) {
                foreach($result as $row){
                $delid = "DELETE FROM product_category WHERE product_id = '$last_prod_id' AND category_id != '$category_id[$x]'";
                $result = $this->conn->query($delid);    
            }
            } 
           else{
             $sqlupdate = "INSERT INTO product_category (product_id, category_id) VALUES ('$last_prod_id' , '$category_id[$x]')";
            $resultupdate = $this->conn->query($sqlupdate);
           }
        }
    }
    else{
        $delproductid = "DELETE FROM product_category WHERE product_id = '$last_prod_id'";
        $resultdelete = $this->conn->query($delproductid); 
    }
        return true;
       
    }

    public function createProdcategory($last_prod_id, $category_id)
    {
        $arrlength = count($category_id);
        for ($x = 0; $x < $arrlength; $x++) {
            $sql = "INSERT INTO product_category (product_id, category_id) VALUES ('$last_prod_id' , '$category_id[$x]')";
            $result = $this->conn->query($sql);
        }
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function create($inputdata)
    {
        $data = "'" . implode("','", $inputdata) . "'";
        $sql = "INSERT INTO product (name, image, image_one, image_two, image_three, image_four, price, regular_price, quantity, sku, url, title, meta_description,status,long_desc,short_decs,sale_tag,added_on) VALUES ($data)";
        $result = $this->conn->query($sql);
        if ($result) {
            $last_prod_id = $this->conn->insert_id;
            return $last_prod_id;
        } else {
            return false;
        }
    }



    public function index()
    {
        $sql = "SELECT * FROM product WHERE status != '2' ORDER BY ID DESC";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    
       public function export()
    {
        $sql = "SELECT * FROM product WHERE status != '2'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function edit($id)
    {
        $getProducts = "SELECT * FROM product WHERE id = '$id' LIMIT 1";
        $result = $this->conn->query($getProducts);
        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }

    public function update($inputData, $productid)
    {
        $productname =  $inputData['productname'];
        $main_image =  $inputData['main_image'];
        $prod_img1 =  $inputData['prod_img1'];
        $prod_img2 =  $inputData['prod_img2'];
        $prod_img3 =  $inputData['prod_img3'];
        $prod_img4 =  $inputData['prod_img4'];
        $sale_price =  $inputData['sale_price'];
        $regular_price =  $inputData['regular_price'];
        $prod_qty =  $inputData['prod_qty'];
        $prod_sku =  $inputData['prod_sku'];
        $prod_url =  $inputData['prod_url'];
        $prod_meta_desc =  $inputData['prod_meta_desc'];
        $visibility =  $inputData['visibility'];
        $long_description =  $inputData['long_description'];
        $short_description =  $inputData['short_description'];
        $prod_title =  $inputData['prod_title'];
        $updated =  $inputData['updated'];
        $sale_tag = $inputData['sale_tag'];
        $sql = "UPDATE product 
    SET ";
        $sql .= "name = '$productname' ,";
        if (!empty($main_image)) {
            $sql .= "image ='$main_image' ,";
        }
        if (!empty($prod_img1)) {
            $sql .= "image_one ='$prod_img1' ,";
        }
        if (!empty($prod_img2)) {
            $sql .= "image_two = '$prod_img2' ,";
        }
        if (!empty($prod_img3)) {
            $sql .= "image_three = '$prod_img3' ,";
        }
        if (!empty($prod_img4)) {
            $sql .= "image_four = '$prod_img4' ,";
        }
        $sql .= "
    price = '$sale_price',
    regular_price = '$regular_price',
    quantity = '$prod_qty',
    sku = '$prod_sku',
    url = '$prod_url',
    title = '$prod_title',
    meta_description ='$prod_meta_desc',
    status ='$visibility',
    long_desc = '$long_description',
    short_decs = '$short_description',
    sale_tag = '$sale_tag',
    updated_on = '$updated' ";
        $sql .= "WHERE id ='$productid'
    ";
        $result = $this->conn->query($sql);
        //  echo $result;
        if ($result) {
            $last_prod_id = $this->conn->insert_id;
            return $productid;
        } else {
            return false;
        }
    }
    
      public function getCategoryIdprod($id)
    {
        $id = validateInput($this->conn, $id);
        $sql = "SELECT category_id FROM product_category WHERE product_id = '$id'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $data = array();
            foreach ($result as $row) {
                $id = validateInput($this->conn, $row['category_id']);
                $sql = "SELECT * FROM category WHERE id = '$id'";
                $result = $this->conn->query($sql);
                while ($row_data = mysqli_fetch_array($result)) {
                    $category_id[] =  $row_data['id'];
                    
                }
            }
            if ($result) {
                return $category_id;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getCategoryname($id)
    {
        $id = validateInput($this->conn, $id);
        $sql = "SELECT category_id FROM product_category WHERE product_id = '$id'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $data = array();
            foreach ($result as $row) {
                $id = validateInput($this->conn, $row['category_id']);
                $sql = "SELECT * FROM category WHERE id = '$id'";
                $result = $this->conn->query($sql);
                while ($row_data = mysqli_fetch_array($result)) {
                    $data[] = array(
                        'category_name' => $row_data['cat_name'],
                        'category_id' => $row_data['id'],
                    );
                }
            }
            if ($result) {
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function delete($productid)
    {
        $sql = "UPDATE product SET status ='2' WHERE id ='$productid'";
        $result = $this->conn->query($sql);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getProductId($prodid)
    {
        $sql = "SELECT * FROM product WHERE id = '$prodid' LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
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
