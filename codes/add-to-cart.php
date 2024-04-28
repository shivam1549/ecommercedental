<?php
include('../config/app.php');
include_once('../controllers/AddtocartController.php');
if($_POST['action'] == 'add-to-cart'){
    $prod_quantity = validateInput($db->conn, $_POST['prod_quantity']);
    $productid = validateInput($db->conn, $_POST['productid']);
    $cart = new AddtocartController;
    $result = $cart->addCart($productid,$prod_quantity);
    if($result){
        echo "success";
    }
    else{
        echo "error";
    }
}
if($_POST['action'] == 'delete-cart'){
    $productid = validateInput($db->conn, $_POST['productid']);
    $cart = new AddtocartController;
    $result = $cart->deleteCart($productid);
    if($result){
        echo "success";
    }
    else{
        echo "error";
    }
}

if($_POST['action'] == 'update-cart'){
    if(isset($_SESSION["add-to-cart"]))
    {
        foreach ($_SESSION["add-to-cart"] as $key => $val) {

            if ($val["productid"] == $_POST['productid']) {
                $_SESSION["add-to-cart"][$key]['prod_quant'] = $_POST['product_quantity']; 
                echo "success";
            }
     
         }
}
}
?>
