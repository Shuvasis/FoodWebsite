<?php
    include('../config/constants.php');
    session_unset();
    session_destroy();
    header('location:../admin/login.php');

?>