<?php
class LoginController{
    public function __construct(){
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }
   public function loginUser($email,$password){
    $loginuser = "SELECT * FROM user WHERE email = '$email' AND status = '1' LIMIT 1";
    $result = $this->conn->query($loginuser);
    if($result->num_rows > 0){
        $data = $result->fetch_assoc();
        $hashed_password = $data['password'];
        if(password_verify($password, $hashed_password)) {
            $this->userAuthentication($data);
            return true;
        }
        else{
            return false;
        }
    }
}

   public function loginAdmin($email,$password){
    $loginuser = "SELECT * FROM admin WHERE email = '$email' AND status = '1' LIMIT 1";
    $result = $this->conn->query($loginuser);
    if($result->num_rows > 0){
        $data = $result->fetch_assoc();
        $hashed_password = $data['password'];
        if(password_verify($password, $hashed_password)) {
            $this->userAuthentication($data);
            return true;
        }
        else{
            return false;
        }
    }
}

private function userAuthentication($data){
    $_SESSION['authenticated'] = true;
    $_SESSION['auth_role'] = $data['role_as'];
    $_SESSION['auth_user'] = [
        'user_id' => $data['id'],
        'username' => $data['user_name'],
        'user_email' => $data['email']
    ];
}

public function isLoggedin(){
    if(isset($_SESSION['authenticated']) === TRUE){
        redirect('You are already logged in', 'index.php');
    }
    else{
        return false;
    }
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

public function forgetPassword($email, $token){
    $check_email = "SELECT * FROM user WHERE email = '$email' LIMIT 1";
      $result = $this->conn->query($check_email);
    if($result->num_rows > 0){
        $data = $result->fetch_assoc();
        $get_email = $data['email'];
        $update_token = "UPDATE user SET verify_token = '$token' WHERE email = '$get_email'";
        $update_tokenresult = $this->conn->query($update_token);
        if($update_tokenresult){
            return true;
        }
        else{
            return false;
        }
        
    }
    else{
        return false;
    }
}


public function updatePassword($email, $token, $password, $cpassword){
    if(!empty($token) && !empty($password) && !empty($cpassword)){
    $token_name = "SELECT verify_token FROM user WHERE verify_token ='$token' LIMIT 1";
     $result = $this->conn->query($token_name);
        if($result->num_rows > 0){
           if($password == $cpassword)  {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
              $chnage_pass = "UPDATE user SET password = '$hashedPassword' WHERE verify_token = '$token'";
              $chnage_pass_result = $this->conn->query($chnage_pass);
              if($chnage_pass_result){
                 return true; 
              }
              else{
                 return false;  
              }
           }
           else{
               return false;
           }
        }
        else{
            return false;
        }
    }
    else{   
        return false;
    }
}
}
?>