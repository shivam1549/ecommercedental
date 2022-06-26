<?php
// include('config/app.php');
include_once('controllers/RegisterController.php');
include_once('controllers/LoginController.php');
include_once('Mails/MailController.php');
$auth = new LoginController;
if(isset($_POST['logout_btn'])){
  $checkedLoggedout = $auth->logout();
  if($checkedLoggedout){
    redirect("Logged Out Successfully", "login");  
  }
}

if(isset($_POST['admin-login-btn'])){
    $email = validateInput($db->conn, $_POST['email']);
    $password = validateInput($db->conn, $_POST['password']);
    
    $result = $auth->loginAdmin($email,$password);
    if($result){
        if($_SESSION['auth_role'] == '1'){
            redirect("Login Succesfully", "admin/index.php"); 
        }
        else{
        redirect("Login Succesfully", "index.php"); 
        }
    }
    else{
        redirect("Invalid email or password", "login");  
    }
}

if(isset($_POST['login-btn'])){
    $email = validateInput($db->conn, $_POST['email']);
    $password = validateInput($db->conn, $_POST['password']);
    
    $result = $auth->loginUser($email,$password);
    if($result){
        if($_SESSION['auth_role'] == '1'){
            redirect("Login Succesfully", "admin/index.php"); 
        }
        else{
        redirect("Login Succesfully", "index.php"); 
        }
    }
    else{
        redirect("Invalid email or password", "login");  
    }
}

if(isset($_POST['checkout-login'])){
    $email = validateInput($db->conn, $_POST['email']);
    $password = validateInput($db->conn, $_POST['password']);
    
    $result = $auth->loginUser($email,$password);
    if($result){
        redirect("Login Succesfully", "checkout"); 
    }
    else{
        redirect("Invalid email or password", "cart");  
    }
}

if(isset($_POST['wishlist-login'])){
    $email = validateInput($db->conn, $_POST['email']);
    $password = validateInput($db->conn, $_POST['password']);
    // $current_page = $_POST['current_page'];
    
    $result = $auth->loginUser($email,$password);
    if($result){
        redirect("Login Succesfully", $_SERVER['HTTP_REFERER']); 
    }
    else{
        redirect("Invalid email or password", "$current_page");  
    }
}



if(isset($_POST['register-btn'])){
    $name = validateInput($db->conn, $_POST['fname']);
    $email = validateInput($db->conn, $_POST['email']);
    $password = validateInput($db->conn, $_POST['password']);
    $cpassword = validateInput($db->conn, $_POST['cpassword']);
    $token = md5(rand());
    date_default_timezone_set("Asia/Calcutta"); 
    $created_at = date('Y-d-m H:i:s');

    $register = new RegisterController;
    $check_password = $register->confirmPassword($password,$cpassword);

    if($check_password){
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $check_user = $register->isUserexist($email);
        if($check_user){
            redirect("User With same Email Already Exist", "register.php"); 
        }
        else{
            $registerUser = $register->registerUser($name,$email,$hashed_password,$token,$created_at);
            if($registerUser){
                //Send Verification mail to user
                $subject ="activate user";
                $sendVerificationmail = new MailController;
                $content = '<p>Click The Below Link To activate your account</p><br>
                <a href="https://gyangreedy.com/dento/activate-user.php?token='.$token.'&email='.$email.'">Click here to activate your account</a>
                ';
                $mailsend = $sendVerificationmail->mailsend($content, $email, $subject);

               redirect("We have sent you a verification mail, if not found please check in spam folder", "register.php");  
            }
            else{
               redirect("Some Error Occured", "register.php"); 
            }
        }
    }
    else{
        redirect("Password Does not match", "register.php");
    }
    
}

if(isset($_POST['forget-btn'])){
    $email = validateInput($db->conn, $_POST['email']);
    $token = md5(rand());
    $check_user = new LoginController;
    $result =  $check_user->forgetPassword($email, $token); 
    if($result){
          $subject ="Reset Password";
                $sendVerificationmail = new MailController;
                $content = '<p>You are receving this mail because we recevied a password reset request from your account</p><br>
                <a href="https://gyangreedy.com/dento/password-change.php?token='.$token.'&email='.$email.'">Click here to reset password</a>
                ';
                $mailsend = $sendVerificationmail->mailsend($content, $email, $subject);

               redirect("We e-mailed you a password reset link", "login.php");
        
    }
    else{
        redirect("Something went wrong", "login.php");
    }
}

if(isset($_POST['reset-pass-btn'])){
     $email = validateInput($db->conn, $_POST['email']);
     $password = validateInput($db->conn, $_POST['password']);
     $cpassword = validateInput($db->conn, $_POST['cpassword']);
     $token = validateInput($db->conn, $_POST['pass_reset_token']);
    $update_user_pass = new LoginController;
    $updatepass =  $update_user_pass->updatePassword($email, $token, $password, $cpassword); 
    // print_r($updatepass);
    if($updatepass){
          redirect("Password Changed Successfully", "login.php"); 
    }
    else{
      redirect("Something went wrong", "login.php"); 
    }
    
}
?>