<?php
if(isset($_SESSION['message'])){
    echo "<div class='alert alert-primary' role='alert'>" .$_SESSION['message']. "</div>";

    unset($_SESSION['message']);
}
?>