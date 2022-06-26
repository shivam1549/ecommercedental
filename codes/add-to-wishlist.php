<?php
include('../config/app.php');
include_once('../controllers/WishlistController.php');
if($_POST['action'] == 'add-to-wishlist'){
    $productid = validateInput($db->conn, $_POST['productid']);
    $customerid = validateInput($db->conn, $_POST['customerid']);
    $wishlist = new WishlistController;
    $checkifalreadyexist =  $wishlist->checkifexist($productid, $customerid);
    if($checkifalreadyexist){
        echo "error";
    }
    else{
    $result = $wishlist->create($productid, $customerid);
    // echo  $result;
    if($result){
        echo "success";
    }
    else{
        echo "error";
    }
}
}
if($_POST['action'] == 'delete-wishlist'){
    $productid = validateInput($db->conn, $_POST['productid']);
    $customerid = validateInput($db->conn, $_POST['customerid']);
    $wishlist = new WishlistController;
    $result = $wishlist->deletewishlist($productid, $customerid);
    if($result){
        echo "success";
    }
    else{
        echo "error";
    }
}
?>