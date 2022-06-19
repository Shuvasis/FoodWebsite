<?php
    include('../config/constants.php');
    session_destroy();
    header('location:user-login.php');

?>