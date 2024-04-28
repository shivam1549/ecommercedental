<?php
include('../../config/app.php');
include_once('../controllers/CategoryController.php');
if (isset($_POST['add_category'])) {
    date_default_timezone_set('Asia/Kolkata');
    $created_at = date('Y-m-d H:i:s');
    $category = new CategoryController;
    $checkCatexist = $category->checkCategoryurlexist($_POST['category_url']);
    if($checkCatexist){
        $category_url = $checkCatexist;
    }
    $inputData = [
        'parent_category' => validateInput($db->conn, $_POST['parent_category']),
        'categoryname' => validateInput($db->conn, $_POST['category_name']),
        'categoryurl' => validateInput($db->conn, $category_url),
        'categorydescription' => validateInput($db->conn, $_POST['description']),
        'created_at' => $created_at,
    ];
   
    $result = $category->create($inputData);
    //    echo $result;
    if ($result) {
        redirect('Created SuccessFully', 'admin/categories.php');
    } else {
        redirect('Some Error Occured', 'admin/categories.php');
    }
}

if (isset($_POST['update_category'])) {
    $category = new CategoryController;
    $category_id = validateInput($db->conn, $_POST['category_id']);
    $inputData = [
        'parent_category' => validateInput($db->conn, $_POST['parent_category']),
        'categoryname' => validateInput($db->conn, $_POST['category_name']),
        'categoryurl' => validateInput($db->conn, $_POST['category_url']),
        'categorydescription' => validateInput($db->conn, $_POST['description']),
    ];
   
    $result = $category->update($inputData, $category_id);
//    echo $result;
    if ($result) {
        redirect('Updated SuccessFully', 'admin/categories.php');
    } else {
        redirect('Category Exist', 'admin/categories.php');
    }
}

if(isset($_POST['deletecatid'])){
    $category = new CategoryController;
    $category_id = validateInput($db->conn, $_POST['categoryid']); 
    $result = $category->delete($category_id);
    if ($result) {
        redirect('Deleted SuccessFully', 'admin/categories.php');
    } else {
        redirect('Some Error Occured', 'admin/categories.php');
    }
}

if(isset($_POST['update-status'])){
    $category = new CategoryController;
    $category_id = validateInput($db->conn, $_POST['categoryid']); 
    $categoryshow = validateInput($db->conn, $_POST['showcategory']); 
    
    $result = $category->showcategory($category_id, $categoryshow);
//   echo $result;
    if ($result) {
        redirect('Updated Successfully', 'admin/categories.php');
    } else {
        redirect('Some Error Occured', 'admin/categories.php');
    }
}
?>
