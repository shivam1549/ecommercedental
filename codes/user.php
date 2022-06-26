<?php
include('../config/app.php');
include('../controllers/RegisterController.php');
if(isset($_POST['update_btn'])){
    $userid = validateInput($db->conn, $_POST['userid']);
    $inputData = [
        'firstname' => validateInput($db->conn, $_POST['firstname']),
        'lastname' => validateInput($db->conn, $_POST['lastname']),
        'email' => validateInput($db->conn, $_POST['email']),
        'phone' => validateInput($db->conn, $_POST['phone']),
        'address1' => validateInput($db->conn, $_POST['address1']),
        'address2' => validateInput($db->conn, $_POST['address2']),
        'city' => validateInput($db->conn, $_POST['city']),
        'state' => validateInput($db->conn, $_POST['state']),
        'country' => validateInput($db->conn, $_POST['country']),
        'zip' => validateInput($db->conn, $_POST['zip']),
    ];
    $updateUser = new RegisterController;

    $result = $updateUser->updateUser($inputData, $userid);
    //    echo $result;
    if ($result) {
        redirect('Updated Successfully', 'my-account');
    } else {
        redirect('Some Error Occured', 'my-account');
    }
}
?>