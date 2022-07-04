<?php
    include('config/constants.php');
        if(isset($_POST['submit1'])) {
            $product_name = $_POST['title1'];
            $product_image = $_POST['imageName'];
            $product_price = $_POST['price1'];
            $user_email = $_SESSION['loginuser'];
            
            //Write a sql query
            $cartSql = "INSERT INTO `cart`(`product_name`, `product_image`, `product_quentity`, `product_price`, `user_email`)
            VALUES 
            (
                '$product_name',
                '$product_image',
                1,
                $product_price,
                '$user_email'
            )";

            //Execute sql
            $cartRes = mysqli_query($conn, $cartSql);

            //Redirect to cart page
            header('location:'.SITEURL.'cart.php');
        }
        
        
?>