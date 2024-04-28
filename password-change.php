<?php
include('config/app.php');
include('codes/authentication_code.php');
include('controllers/CategoryController.php');
$auth->isLoggedin();
$title = "Password Reset";
include('inc/header.php');

?>
<style>
  .is-invalid{
    border:1px solid red !important;
  }
  .is-valid{
    border:1px solid green;
  }
  #error{
    color:red;
    display:none;
  }
</style>
  <div class="ltn__utilize-overlay"></div>

<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="img/bg/14.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">Account</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->

<!-- LOGIN AREA START (Register) -->
<div class="ltn__login-area pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area text-center">
                    <h1 class="section-title">Reset Password</h1>
                    <!-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. <br>
                         Sit aliquid,  Non distinctio vel iste.</p> -->
                         <p id ="error">Please Fill All The Details</p>
                         <?php include('message.php')?>
                </div>
            </div>
        </div>
        <?php
        $token = validateInput($db->conn, $_GET['token']);
        $email = validateInput($db->conn, $_GET['email']);
        ?>
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="account-login-inner">
                    <form action="" class="" method="POST" onsubmit="return validateForm()">
                       
                        <input name="pass_reset_token" type="hidden" value="<?php echo $token;?>">
                        <input class="" type="password"  id="password" name="password"  placeholder="Password*">
                        <p style="display:none; color:red;" id = "pass_err">Password must contain of 1 uppercase character,1 lowercase character, 1 digit,1 special character, and minimum length of 8 characters.</p>
                        
                        
                      
                        <label class="checkbox-inline">
                        <input type="checkbox" onclick="showPassword()">Show Password
                           
                        </label>
                        
                         <input class="" type="password"  id="passwordb"  name="cpassword" placeholder="Confirm Password*">
                        <p style="display:none; color:red;" id = "pass_errb">Password must contain of 1 uppercase character,1 lowercase character, 1 digit,1 special character, and minimum length of 8 characters.</p>
                        
                        
                      
                        <label class="checkbox-inline">
                        <input type="checkbox" onclick="showPasswordb()">Show Password
                           
                        </label>
                        <!-- <label class="checkbox-inline">
                            <input type="checkbox" value="">
                            By clicking "create account", I consent to the privacy policy.
                        </label> -->
                        <div class="btn-wrapper">
                            <button name="reset-pass-btn" type="submit" class="theme-btn-1 btn reverse-color btn-block" type="submit">UPDATE PASSWORD</button>
                        </div>
                    </form>
                 
                </div>
            </div>
        </div>
    </div>
</div>
<!-- LOGIN AREA END -->

<!-- CALL TO ACTION START (call-to-action-6) -->
<div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bs-bg="img/1.jpg--">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
                    <div class="coll-to-info text-color-white">
                        <h1>Buy medical disposable face mask <br> to protect your loved ones</h1>
                    </div>
                    <div class="btn-wrapper">
                        <a class="btn btn-effect-3 btn-white" href="shop.html">Explore Products <i class="icon-next"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

function showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
         
            }
     
     function showPasswordb() {
            var x = document.getElementById("passwordb");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
         
            }
   
        var passowrd = document.getElementById("password");
         var passowrdb = document.getElementById("passwordb");


       
let validPassword = false;
let validPasswordb = false;



password.addEventListener('change', ()=>{
    console.log("phone is blurred");
    let str = password.value;
    console.log(str);
    if (str.match(/[a-z]/g) && str.match(
                    /[A-Z]/g) && str.match(
                    /[0-9]/g) && str.match(
                    /[^a-zA-Z\d]/g) && str.length >= 8){
                      password.classList.add('is-valid');
                        password.classList.remove('is-invalid');
                        document.getElementById("pass_err").style.display = 'none';
                        validPassword = true;
                        
                    }
        else{
          password.classList.remove('is-valid');
          document.getElementById("pass_err").style.display = 'block';
            password.classList.add('is-invalid');
                        validPassword = false;
        }
})

passwordb.addEventListener('change', ()=>{
    console.log("phone is blurred");
    let str = passwordb.value;
    console.log(str);
    if (str.match(/[a-z]/g) && str.match(
                    /[A-Z]/g) && str.match(
                    /[0-9]/g) && str.match(
                    /[^a-zA-Z\d]/g) && str.length >= 8){
                      passwordb.classList.add('is-valid');
                        passwordb.classList.remove('is-invalid');
                        document.getElementById("pass_errb").style.display = 'none';
                        validPasswordb = true;
                        
                    }
        else{
          password.classList.remove('is-valid');
          document.getElementById("pass_errb").style.display = 'block';
            password.classList.add('is-invalid');
                        validPasswordb = false;
        }
})

function validateForm(){
if(validPassword && validPasswordb){
  document.getElementById("error").style.display = "none";
  return true;
}

else{
  document.getElementById("error").style.display = "block";
  console.log("false");
  return false;
  
}
      }
  </script>

<?php
include('inc/footer.php');
?>

