<?php
class AuthController{
    
       public function __construct()
    {
        $db = new Databaseconnection;
        $this->conn = $db->conn;
    }
public function logout(){
    if(isset($_SESSION['authenticated']) === TRUE){
       unset($_SESSION['authenticated']);
       unset($_SESSION['auth_user']);
       return true;
    }
    else{
        return false;
    }
}
}
