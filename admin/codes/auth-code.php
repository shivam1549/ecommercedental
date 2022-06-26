<?php
include_once('./controllers/AuthController.php');
if(isset($_POST['logout_btn'])){
    $auth = new AuthController;
  $checkedLoggedout = $auth->logout();
  if($checkedLoggedout){
    redirect("Logged Out Successfully", "admin-login.php");  
  }
}
?>