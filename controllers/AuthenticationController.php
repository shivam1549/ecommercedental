<?php

class AuthenticationController{
    public function __construct(){
        $db = new Databaseconnection;
        $this->conn = $db->conn;
        $this->checkisLoggedin();
    }

    public function admin(){
        $user_id =$_SESSION['auth_user']['user_id'];
        $checkAdmin = "SELECT id,role_as FROM user WHERE id ='$user_id' AND role_as='1' LIMIT 1";
        $result = $this->conn->query($checkAdmin);
        if($result->num_rows == 1){
            return true;
        }
        else{
            redirect("You are not authorized as admin", "index.php");
        }
    }

    private function checkisLoggedin(){
        if(!isset($_SESSION['authenticated'])){
            redirect("Login to access the page","login.php");
        }
        else{
            return true;
        }
    }
    
    public function forgetPassword($email, $token){
    $check_email = "SELECT * FROM user WHERE email = '$email' LIMIT 1";
    $check_email_run = $this->conn->query($check_email);
     if($check_email_run->num_rows > 0){
           $data = $check_email_run->fetch_assoc();
          $get_email = $data['email'];
     }
     
   $update_token = "UPDATE user SET verify_token = '$token' WHERE email = '$get_email'";
    $check_email_run = $this->conn->query($check_email);
    
    }

    public function authDetail(){
        $checkAuth = $this->checkisLoggedin();
        if($checkAuth){
            $user_id = $_SESSION['auth_user']['user_id'];
            $getUserdata = "SELECT * FROM user WHERE id = '$user_id' LIMIT 1";
            $result = $this->conn->query($getUserdata);
            if($result->num_rows > 0){
                    $data = $result->fetch_assoc();
                    return $data;
            }
            else{
                redirect("Something Went Wrong", "login.php");
            }
        }
        else{
            return false;
        }
    }
}


?>