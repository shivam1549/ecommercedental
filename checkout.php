<?php
$title = "Checkout";
include('config/app.php');
include('codes/authentication_code.php');
include('controllers/AuthenticationController.php');
include('controllers/CategoryController.php');
include('controllers/ProductController.php');
$authenticated = new AuthenticationController;
$data = $authenticated->authDetail();
include('inc/header.php');
?>
<div class="ltn__utilize-overlay"></div>

<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image " data-bs-bg="img/bg/14.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">Checkout</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->

<!-- WISHLIST AREA START -->
<div class="ltn__checkout-area mb-105">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__checkout-inner">
                    <div class="ltn__checkout-single-content ltn__returning-customer-wrap">
                        <!-- <h5>Returning customer? <a class="ltn__secondary-color" href="#ltn__returning-customer-login" data-bs-toggle="collapse">Click here to login</a></h5> -->
                        <!-- <div id="ltn__returning-customer-login" class="collapse ltn__checkout-single-content-info">
                            <div class="ltn_coupon-code-form ltn__form-box">
                                <p>Please login your accont.</p>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-item input-item-name ltn__custom-icon">
                                                <input type="text" name="ltn__name" placeholder="Enter your name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-item input-item-email ltn__custom-icon">
                                                <input type="email" name="ltn__email" placeholder="Enter email address">
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn theme-btn-1 btn-effect-1 text-uppercase">Login</button>
                                    <label class="input-info-save mb-0"><input type="checkbox" name="agree"> Remember me</label>
                                    <p class="mt-30"><a href="register.html">Lost your password?</a></p>
                                </form>
                            </div>
                        </div> -->
                    </div>
                    <!-- <div class="ltn__checkout-single-content ltn__coupon-code-wrap">
                        <h5>Have a coupon? <a class="ltn__secondary-color" href="#ltn__coupon-code" data-bs-toggle="collapse">Click here to enter your code</a></h5>
                        <div id="ltn__coupon-code" class="collapse ltn__checkout-single-content-info">
                            <div class="ltn__coupon-code-form">
                                <p>If you have a coupon code, please apply it below.</p>
                                <form action="#">
                                    <input type="text" name="coupon-code" placeholder="Coupon code">
                                    <button class="btn theme-btn-2 btn-effect-2 text-uppercase">Apply Coupon</button>
                                </form>
                            </div>
                        </div>
                    </div> -->
                    <div class="ltn__checkout-single-content mt-50">
                        <h4 class="title-2">Billing Details</h4>
                        <p style="display:none; color:red;"></p>
                        <div class="ltn__checkout-single-content-info">
                            <form action="codes/checkout-code.php" method="POST" onsubmit="return validateForm()">
                                <h6>Personal Information</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-item input-item-name ltn__custom-icon">
                                            <input type="text" id="customername" name="customer_name" placeholder="First Name" value="<?php echo $data['user_name']?>">
                                            <small style="display:none; color:red;" id="name_err">Name Can not empty</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-item input-item-name ltn__custom-icon">
                                            <input type="text" id="customername" name="customer_lastname" placeholder="Last name">
                                           
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="input-item input-item-email ltn__custom-icon">
                                            <input type="email" id="customeremail" value="<?php echo $data['email']?>" name="customer_email" placeholder="email address">
                                            <small style="display:none; color:red;" id="email_err">Please Fill email in correct format</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-phone ltn__custom-icon">
                                            <input type="text" id="customerphone" name="customer_phone" placeholder="phone number">
                                            <small style="display:none; color:red;" id="phone_err">Only 10 digits are allowed</small>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="input-item input-item-website ltn__custom-icon">
                                            <input type="text" name="ltn__company" placeholder="Company name (optional)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-item input-item-website ltn__custom-icon">
                                            <input type="text" name="ltn__phone" placeholder="Company address (optional)">
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6">
                                        <h6>Country</h6>
                                        <div class="input-item">
                                            <select class="nice-select" id="customercountry" name="customer_country">
                                                <option>Select Country</option>
                                                <option>India</option>

                                            </select>
                                            <small style="display:none; color:red;" id="country_err">Please Select City</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <h6>Address</h6>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="input-item">
                                                    <input type="text" id="customeraddressf" name="customer_addressf" placeholder="House number and street name">
                                                    <small style="display:none; color:red;" id="addressf_err">Please Fill address</small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-item">
                                                    <input type="text" name="customer_addrest" placeholder="Apartment, suite, unit etc. (optional)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_SESSION['authenticated'])) {
                                    ?>
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['auth_user']['user_id'] ?>">
                                    <?php
                                       }
                                    ?>
                                    <div class="col-lg-4 col-md-6">
                                        <h6>Town / City</h6>
                                        <div class="input-item">
                                            <input type="text" id="customercity" name="customer_city" placeholder="City">
                                            <small style="display:none; color:red;" id="city_err">Please Fill City</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <h6>State </h6>
                                        <div class="input-item">
                                            <input type="text" id="customerstate" name="customer_state" placeholder="State">
                                            <small style="display:none; color:red;" id="state_err">Please Fill address</small>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <h6>Zip</h6>
                                        <div class="input-item">
                                            <input type="text" id="customerzip" name="customer_zip" placeholder="Zip">
                                            <small style="display:none; color:red;" id="zip_err">Please Fill Zip Code</small>
                                        </div>
                                    </div>
                                </div>
                                <!-- <p><label class="input-info-save mb-0"><input type="checkbox" name="agree"> Create an account?</label></p> -->
                                <!-- <h6>Order Notes (optional)</h6>
                                <div class="input-item input-item-textarea ltn__custom-icon">
                                    <textarea name="customer__message" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                </div> -->

                                <?php
                                if ($_SESSION["add-to-cart"]) {
                                    $carttotal = 0;
                                    foreach ($_SESSION["add-to-cart"] as $key => $cart) {
                                        $carttotal = $carttotal + ($cart['prod_quant'] * $cart['price']);
                                    }
                                } ?>

                                <input value="<?php echo $carttotal; ?>" type="hidden" name="total_price">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="ltn__checkout-payment-method mt-50">
                                            <h4 class="title-2">Payment Method</h4>
                                            <div id="checkout_accordion_1">
                                                <!-- card -->
                                                <div class="card">
                                                    <h5 class="collapsed ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-1" aria-expanded="false">
                                                        Check payments
                                                    </h5>
                                                    <div id="faq-item-2-1" class="collapse" data-bs-parent="#checkout_accordion_1">
                                                        <div class="card-body">
                                                            <p>Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- card -->
                                                <div class="card">
                                                    <h5 class="ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-2" aria-expanded="true">
                                                        Cash on delivery
                                                    </h5>
                                                    <div id="faq-item-2-2" class="collapse show" data-bs-parent="#checkout_accordion_1">
                                                        <div class="card-body">
                                                            <p>Pay with cash upon delivery.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- card -->
                                                <div class="card">
                                                    <h5 class="collapsed ltn__card-title" data-bs-toggle="collapse" data-bs-target="#faq-item-2-3" aria-expanded="false">
                                                        PayPal <img src="img/icons/payment-3.png" alt="#">
                                                    </h5>
                                                    <div id="faq-item-2-3" class="collapse" data-bs-parent="#checkout_accordion_1">
                                                        <div class="card-body">
                                                            <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="ltn__payment-note mt-30 mb-30">
                                                <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn theme-btn-1 btn-effect-1 text-uppercase" name="checkoutbtn">Place order</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="shoping-cart-total mt-50">
                    <h4 class="title-2">Cart Totals</h4>
                    <table class="table">
                        <tbody>
                            <?php if (isset($_SESSION["add-to-cart"])) {
                                foreach ($_SESSION["add-to-cart"] as $key => $cart) {
                                    $producttotal = '';
                                    $producttotal = $cart['prod_quant'] * $cart['price'];
                            ?>
                                    <tr>
                                        <td><?php echo $cart['prod_name'] ?> <strong>× <?php echo $cart['prod_quant'] ?></strong></td>
                                        <td>&#x20B9; <span><?php echo $producttotal; ?></span></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

                            <tr>
                                <td>Shipping and Handing</td>
                                <td>&#x20B9; 0</td>
                            </tr>
                            <!-- <tr>
                                <td>Vat</td>
                                <td>$00.00</td>
                            </tr> -->
                            <tr>
                                <?php
                                if ($_SESSION["add-to-cart"]) {
                                    $carttotal = 0;
                                    foreach ($_SESSION["add-to-cart"] as $key => $cart) {
                                        $carttotal = $carttotal + ($cart['prod_quant'] * $cart['price']);
                                    }
                                }
                                ?>
                                <td><strong>Order Total</strong></td>
                                <td>&#x20B9; <strong><?php echo $carttotal; ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- WISHLIST AREA START -->

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
<!-- CALL TO ACTION END -->
<script>
    function validateForm() {
        var email = document.getElementById("customeremail");
        var name = document.getElementById("customername");
        var phone = document.getElementById("customerphone");
        var country = document.getElementById("customercountry");
        var state = document.getElementById("customerstate");
        var city = document.getElementById("customercity");
        var zip = document.getElementById("customerzip");
        var addressf = document.getElementById("customeraddressf");

        var name_err = document.getElementById("name_err");
        var email_err = document.getElementById("email_err");
        var phone_err = document.getElementById("phone_err");
        var country_err = document.getElementById("country_err");
        var city_err = document.getElementById("city_err");
        var zip_err = document.getElementById("zip_err");
        var addressf_err = document.getElementById("addressf_err");
        let valid = true;
        let strzip = zip.value;
        if (strzip != '') {
            document.getElementById("zip_err").style.display = "none";
            valid = true;
        } else {
            document.getElementById("zip_err").style.display = "block";
            valid = false;

        }

        let straddressf = addressf.value;
        if (straddressf != '') {
            document.getElementById("addressf_err").style.display = "none";
            valid = true;
        } else {
            document.getElementById("addressf_err").style.display = "block";
            valid = false;

        }

        let strcity = city.value;
        if (strcity != '') {
            document.getElementById("city_err").style.display = "none";
            valid = true;
        } else {
            document.getElementById("city_err").style.display = "block";
            valid = false;

        }

        let strcountry = country.value;
        if (strcountry != '') {
            document.getElementById("country_err").style.display = "none";
            valid = true;
        } else {
            document.getElementById("country_err").style.display = "block";
            valid = false;

        }

        let regexname = /^[a-zA-Z]([0-9a-zA-Z]){2,20}$/;
        let strname = name.value;
        if (regexname.test(strname)) {
            document.getElementById("name_err").style.display = "none";
            valid = true;
        } else {
            document.getElementById("name_err").style.display = "block";
            valid = false;

        }

        console.log("email is blurred");
        let regexemail = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
        let stremail = email.value;
        if (regexemail.test(stremail)) {
            document.getElementById("email_err").style.display = "none";
            valid = true;
        } else {
            document.getElementById("email_err").style.display = "block";
            valid = false;

        }

        let regexphone = /^([0-9]){10}$/;
        let strphone = phone.value;
        if (regexphone.test(strphone)) {
            document.getElementById("phone_err").style.display = "none";
            valid = true;
        } else {
            document.getElementById("phone_err").style.display = "block";
            valid = false;

        }

        if (valid) {
            return true;

        } else {
            return false;
        }

    }
</script>

<?php
include('inc/footer.php');
?>