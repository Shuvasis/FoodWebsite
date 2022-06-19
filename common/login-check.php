<?php
    // include('../config/constants.php');
    if(!isset($_SESSION['adminloginuser'])){
        header('location:../admin/login.php');
    }
?>