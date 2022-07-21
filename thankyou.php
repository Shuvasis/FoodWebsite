<?php include('partials-front/menu.php'); ?>

<?php

    if(isset($_POST['order_btn'])) {
        $name = $_POST['name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $method = $_POST['method'];
        $flat = $_POST['flat'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $pin_code = $_POST['pin_code'];
        $user = $_SESSION['loginuser'];
        $order_date = date("Y-m-d h:i:sa"); //order date
        $status = "Ordered"; //Order status like ordered, on-delivered, delivered, canceled

        $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_email = '$user'");
        $price_total = 0;
        if(mysqli_num_rows($cart_query) > 0){
            while($product_item = mysqli_fetch_assoc($cart_query)){
                $product_name[] = $product_item['product_name'] .' ('. $product_item['product_quentity'] .') ';
                $product_price = number_format($product_item['product_price'] * $product_item['product_quentity']);
                $price_total += $product_price;
            }
        }

        $total_product = implode(', ',$product_name);
        $detail_query = mysqli_query($conn, "INSERT INTO `order`(name, number, email, method, flat, street, city, state, country, pin_code, total_products, total_price, order_date, status, user_email) VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$total_product','$price_total', '$order_date', '$status', '$user')") or die('query failed');
        $delete_cart = mysqli_query($conn, "DELETE FROM cart WHERE user_email = '$user'");

        if($cart_query && $detail_query && $delete_cart){
            
            ?>
                <table cellpadding="0" cellspacing="0" width="100%" style="max-width:600px; margin-left: auto; margin-right: auto; margin-top: 1rem;">
            
                    <tr>
                        <td style="padding: 35px 35px 20px 35px; background-color: #ffffff;">
                        <table cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                            <tr>
                                <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                                    <img src="https://www.kareoptions.com/assets/img/tenor.gif" width="125" height="120" style="display: block; border: 0px; margin-left: auto; margin-right: auto;" /><br>
                                    <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0; text-align: center;">
                                        Thank You For Your Order!
                                    </h2>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                                    <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777; text-align: center;">
                                        Your Order Get Delivered Soon...
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 20px;">
                                    <table cellspacing="0" cellpadding="0" width="100%">
                                        <tr>
                                            <td width="75%" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                                Order Confirmation
                                            </td>
                                            <td width="25%" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; text-align: right;">
                                                #21545
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="75%" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                                Purchased Price
                                            </td>
                                            <td width="25%" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px; text-align: right;">
                                                ₹<?php echo $price_total; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="75%" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                                Payment Method
                                            </td>
                                            <td width="25%" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px; text-align: right;">
                                                <?php echo $method; ?>
                                            </td>
                                        </tr>
                                        
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 20px;">
                                    <table cellspacing="0" cellpadding="0" width="100%">
                                        <tr>
                                            <td width="75%" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
                                                TOTAL
                                            </td>
                                            <td width="25%" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee; text-align: right;">
                                                ₹<?php echo $price_total; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        
                        </td>
                    </tr>
                    <tr>
                        <td height="100%" valign="top" width="100%" style="padding: 0 35px 35px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                        <table cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
                            <tr>
                                <td valign="top" style="font-size:0;">
                                    <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">

                                        <table cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                            <tr>
                                                <td valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                                    <p style="font-weight: 800;">Delivery Address</p>
                                                    <p><?php echo "{$name}, {$number}, {$flat}, {$street}, {$city}, {$state}, {$pin_code}"; ?></p>

                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                            <tr>
                                                <td valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; text-align: right;">
                                                    <p style="font-weight: 800;">Estimated Delivery Date</p>
                                                    <p>July 17st, 2022</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <a href="index.php" style="text-align: center; text-decoration: none; color: red; text-align: center;">Continue Shopping</a>
                                </td>
                            </tr>
                        </table>
                        </td>
                    </tr>
                </table>
            <?php
        }
    }

    if(isset($_POST['single_order_btn'])) {
        $name = $_POST['name'];
        $number = $_POST['number'];
        $email = $_POST['email'];
        $method = $_POST['method'];
        $flat = $_POST['flat'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $orderFood_id = $_POST['food_id'];
        $pin_code = $_POST['pin_code'];
        $user = $_SESSION['loginuser'];
        $order_date = date("Y-m-d h:i:sa"); //order date
        $status = "Ordered"; //Order status like ordered, on-delivered, delivered, canceled

        $get_cart = mysqli_query($conn, "SELECT * FROM food WHERE id=$orderFood_id");
        $total = 0;
        $grand_total = 0;
        if(mysqli_num_rows($get_cart) == 1){
            $row_cart = mysqli_fetch_assoc($get_cart);
            $title = $row_cart['title'];
            $grand_total = $row_cart['price'];
        }

        $single_order_query = mysqli_query($conn, 
        "INSERT INTO `order`(name, number, email, method, flat, street, city, state, country, pin_code, total_products, total_price, order_date, status, user_email) 
        VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$title','$grand_total', '$order_date', '$status', '$user')") or die('query failed');
        
        if($get_cart && $single_order_query){
            
            ?>
                <table cellpadding="0" cellspacing="0" width="100%" style="max-width:600px; margin-left: auto; margin-right: auto; margin-top: 1rem;">
            
                    <tr>
                        <td style="padding: 35px 35px 20px 35px; background-color: #ffffff;">
                        <table cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
                            <tr>
                                <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 25px;">
                                    <img src="https://www.kareoptions.com/assets/img/tenor.gif" width="125" height="120" style="display: block; border: 0px; margin-left: auto; margin-right: auto;" /><br>
                                    <h2 style="font-size: 30px; font-weight: 800; line-height: 36px; color: #333333; margin: 0; text-align: center;">
                                        Thank You For Your Order!
                                    </h2>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 10px;">
                                    <p style="font-size: 16px; font-weight: 400; line-height: 24px; color: #777777; text-align: center;">
                                        Your Order Get Delivered Soon...
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 20px;">
                                    <table cellspacing="0" cellpadding="0" width="100%">
                                        <tr>
                                            <td width="75%" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px;">
                                                Order Confirmation
                                            </td>
                                            <td width="25%" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; text-align: right;">
                                                #465465
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="75%" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                                Purchased Price
                                            </td>
                                            <td width="25%" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px; text-align: right;">
                                                ₹<?php echo $grand_total; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="75%" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px;">
                                                Payment Method
                                            </td>
                                            <td width="25%" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 15px 10px 5px 10px; text-align: right;">
                                                <?php echo $method; ?>
                                            </td>
                                        </tr>
                                        
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 20px;">
                                    <table cellspacing="0" cellpadding="0" width="100%">
                                        <tr>
                                            <td width="75%" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee;">
                                                TOTAL
                                            </td>
                                            <td width="25%" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 800; line-height: 24px; padding: 10px; border-top: 3px solid #eeeeee; border-bottom: 3px solid #eeeeee; text-align: right;">
                                                ₹<?php echo $grand_total; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        
                        </td>
                    </tr>
                    <tr>
                        <td height="100%" valign="top" width="100%" style="padding: 0 35px 35px 35px; background-color: #ffffff;" bgcolor="#ffffff">
                        <table cellpadding="0" cellspacing="0" width="100%" style="max-width:660px;">
                            <tr>
                                <td valign="top" style="font-size:0;">
                                    <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">

                                        <table cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                            <tr>
                                                <td valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px;">
                                                    <p style="font-weight: 800;">Delivery Address</p>
                                                    <p><?php echo "{$name}, {$number}, {$flat}, {$street}, {$city}, {$state}, {$pin_code}"; ?></p>

                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div style="display:inline-block; max-width:50%; min-width:240px; vertical-align:top; width:100%;">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="max-width:300px;">
                                            <tr>
                                                <td valign="top" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; text-align: right;">
                                                    <p style="font-weight: 800;">Estimated Delivery Date</p>
                                                    <p>July 17st, 2022</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <a href="index.php" style="text-align: center; text-decoration: none; color: red; text-align: center;">Continue Shopping</a>
                                </td>
                            </tr>
                        </table>
                        </td>
                    </tr>
                </table>
            <?php
        }
    }

?>

<?php include('partials-front/footer.php'); ?>