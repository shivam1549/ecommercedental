<?php
$title = "Thank You";
include('config/app.php');
include('codes/authentication_code.php');
include('controllers/CategoryController.php');
include('inc/header.php');
?>
<style>
    .is-invalid {
        border: 1px solid red !important;
    }

    .is-valid {
        border: 1px solid green;
    }

    #error {
        color: red;
        display: none;
    }

    .product_img {
        width: 60px;
    }
    .ltn__breadcrumb-area{
        margin-bottom: 0;
    }
</style>
<div class="ltn__utilize-overlay"></div>

<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image " data-bs-bg="img/bg/14.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">Success</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="/"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Success</li>
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
                    <!-- <h1 class="section-title">Register <br>Your Account</h1> -->
                    <!-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. <br>
                         Sit aliquid,  Non distinctio vel iste.</p> -->
                    <!-- <p id ="error">Please Fill All The Details</p> -->
                    <?php include('message.php') ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-12">
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading">Thank You For Shopping With Us!</h4>
                        <p>Your Order Has Been Placed.</p>
                    </div>
                </div>  
                <div class="account-login-inner">
                    <?php
                    // print_r($_SESSION['order_details']);
                    if (isset($_SESSION['order_details'])) {
                    ?>
                        <div class="row">

                            <div class="col-md-3">

                                <ul>
                                    <li>Order Number:<strong><?php echo $_SESSION['order_details']['order_id'] ?></strong></li>
                                    <li>Order Date:<span><?php echo $_SESSION['order_details']['date'] ?></span></li>
                                    <li>Order Status:<span><?php echo $_SESSION['order_details']['status'] ?></span></li>
                                    <li>Payment Information:<span><?php echo $_SESSION['order_details']['payment_info'] ?></span></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <ul>
                                    <li>Full Name:<span><?php echo $_SESSION['order_details']['ship_firstname'] . $_SESSION['order_details']['ship_lastname']  ?> </span></li>
                                    <li>Email:<span><?php echo $_SESSION['order_details']['ship_email'] ?></span></li>
                                    <li>Phone:<span><?php echo $_SESSION['order_details']['ship_phone'] ?></span></li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <ul>
                                    <li>Address1:<span><?php echo $_SESSION['order_details']['ship_address1'] ?></span></li>
                                    <li>Address2:<span><?php echo $_SESSION['order_details']['ship_address2'] ?></span></li>
                                    <li>City:<span><?php echo $_SESSION['order_details']['ship_city'] ?></span></li>
                                    <li>Zip:<span><?php echo $_SESSION['order_details']['ship_zip'] ?></span></li>
                                    <li>State:<span><?php echo $_SESSION['order_details']['ship_zone'] ?></span></li>
                                    <li>Country:<span><?php echo $_SESSION['order_details']['ship_country'] ?></span></li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <th>Sr No.</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_SESSION["add-to-cart"])) {
                                            $count = 1;
                                            $carttotal = 0;
                                            foreach ($_SESSION["add-to-cart"] as $key => $cart) {
                                                $carttotal = $carttotal + ($cart['prod_quant'] * $cart['price']);
                                        ?>
                                                <tr>
                                                    <td><?php echo $count; ?></td>
                                                    <td><?php echo $cart['prod_name'] ?></td>
                                                    <td><img class="product_img" src="<?php echo SITE_URL; ?>admin/assets/product-images/<?php echo $cart['prod_image'] ?>" alt=""> </td>
                                                    <td><?php echo $cart['prod_quant'] ?></td>
                                                    <td> &#8377 <?php echo $cart['price'] ?></td>

                                                </tr>
                                        <?php
                                                $count++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="col-lg-12">
                                    <h3>Grand Total: &#8377 <span><?php echo $cart['price']; ?></span></h3>
                                </div>
                                <?php unset($_SESSION["add-to-cart"]);?>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

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
        var y = document.getElementById("cpassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        if (y.type === "password") {
            y.type = "text";
        } else {
            y.type = "password";
        }
    }

    var fname = document.getElementById("fname");
    var email = document.getElementById("email");
    var passowrd = document.getElementById("password");
    var cpassword = document.getElementById("cpassword");

    let validEmail = false;
    let validPassword = false;
    let validName = false;

    fname.addEventListener('blur', () => {
        let str = fname.value;
        // alert(str);
        console.log(str);
        if (str) {
            fname.classList.add('is-valid');
            fname.classList.remove('is-invalid');
            validName = true;
            // alert(str);
        } else {
            fname.classList.remove('is-valid');
            fname.classList.add('is-invalid');
            validName = false;

        }
    })

    email.addEventListener('blur', () => {
        console.log("email is blurred");
        let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
        let str = email.value;
        console.log(regex, str);
        if (regex.test(str)) {
            email.classList.add('is-valid');
            email.classList.remove('is-invalid');
            validEmail = true;
        } else {
            email.classList.remove('is-valid');
            email.classList.add('is-invalid');
            validEmail = false;

        }
    })
    password.addEventListener('blur', () => {
        console.log("phone is blurred");
        let str = password.value;
        console.log(str);
        if (str.match(/[a-z]/g) && str.match(
                /[A-Z]/g) && str.match(
                /[0-9]/g) && str.match(
                /[^a-zA-Z\d]/g) && str.length >= 8) {
            password.classList.add('is-valid');
            password.classList.remove('is-invalid');
            document.getElementById("pass_err").style.display = 'none';
            validPassword = true;

        } else {
            password.classList.remove('is-valid');
            document.getElementById("pass_err").style.display = 'block';
            password.classList.add('is-invalid');
            validPassword = false;
        }
    })

    function validateForm() {
        if (validEmail && validPassword) {
            document.getElementById("error").style.display = "none";
            return true;
        } else {
            document.getElementById("error").style.display = "block";
            console.log("false");
            return false;

        }
    }
</script>

<?php
include('inc/footer.php');
?>