<?php
session_start();
define('DB_HOST','localhost');
define('DB_USER','ictdzfbe_dento');
define('DB_PASSWORD','Dento@#123');
define('DB_DATABASE','ictdzfbe_dento');
define('SITE_URL','https://maidenstride.in/dento1/');
include_once('Databaseconnection.php');
$db = new Databaseconnection;


function base_url($slug){
    echo SITE_URL.$slug;
}
function redirect($message,$page){
    $redirectTo = SITE_URL.$page;
    $_SESSION['message'] = $message;
    header("location: $redirectTo");
    exit(0);
}

function validateInput($dbcon, $input){
 return mysqli_real_escape_string($dbcon,$input);
}
?>