<?php
include('../../config/app.php');
include_once('../controllers/ProductController.php');
include_once('../controllers/BannerController.php');
if (isset($_POST['add_banner'])) {
    $main_imagetmp = $_FILES["banner_img"]["tmp_name"];
    $main_image = $_FILES["banner_img"]["name"];
    $main_image_size = $_FILES["banner_img"]["size"];
    $product = new ProductController;
    $checkmainprod_img = $product->validateImage($main_imagetmp, $main_image, $main_image_size);
    $inputData = [
        'banner_name' => validateInput($db->conn, $_POST['banner_name']),
        'banner_heading' => validateInput($db->conn, $_POST['banner_heading']),
        'main_image' => validateInput($db->conn, $main_image),
        'banner_description' => validateInput($db->conn, $_POST['banner_description']),
        'banner_url' => validateInput($db->conn, $_POST['banner_url']),
        'bannerbtn_text' => validateInput($db->conn, $_POST['bannerbtn_text']),

    ];
    $banner = new BannerController;
    if (!$checkmainprod_img) {
        redirect("Image already exists or size is not matched", "admin/banners.php");
    }
    $result = $banner->create($inputData);
    // echo $result;
    if ($result) {
        redirect("Uploaded Succesfully", "admin/banners.php");
    } else {
        redirect("Some Error occured", "admin/banners.php");
    }
}

if (isset($_POST['update_banner'])) {
    $main_imagetmp = $_FILES["banner_img"]["tmp_name"];
    $main_image = $_FILES["banner_img"]["name"];
    $main_image_size = $_FILES["banner_img"]["size"];
    $product = new ProductController;
    if (!empty($main_image)) {
        $checkmainprod_img = $product->validateImage($main_imagetmp, $main_image, $main_image_size);
        if (!$checkmainprod_img) {
            redirect("Image already exists or size is not matched", "admin/banners.php");
        }
    }
    $banner_id = validateInput($db->conn, $_POST['banner_id']);
    $inputData = [
        'banner_name' => validateInput($db->conn, $_POST['banner_name']),
        'banner_heading' => validateInput($db->conn, $_POST['banner_heading']),
        'main_image' => validateInput($db->conn, $main_image),
        'banner_description' => validateInput($db->conn, $_POST['banner_description']),
        'banner_url' => validateInput($db->conn, $_POST['banner_url']),
        'bannerbtn_text' => validateInput($db->conn, $_POST['bannerbtn_text']),

    ];
    $banner = new BannerController;

    $result = $banner->update($inputData,$banner_id);
    // echo $result;
    if ($result) {
        redirect("Updated Succesfully", "admin/banners.php");
    } else {
        redirect("Some Error occured", "admin/banners.php");
    }
}
