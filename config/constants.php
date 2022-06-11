<?php

//start session 
session_start();
define('SITEURL','http://localhost/FoodWebsite/');

define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');

$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die('error');
    $db_select=mysqli_select_db($conn,DB_NAME) or die('error');
   

    ?>