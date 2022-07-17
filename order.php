<?php include('partials-front/menu.php'); ?>

<?php
    if(isset($_SESSION['loginuser'])) {
        
        if(isset($_POST['checkout'])) {
            ?>
            <section class="checkout-form">
                <div class="checkoutDiv">
                 <h1 class="heading">CHECKOUT</h1>

                </div>

              


                <form action="" method="post">

                <div class="display-order">
                <?php
                    $login_user = $_SESSION['loginuser'];
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_email = '$login_user'");
                    $total = 0;
                    $grand_total = 0;
                    if(mysqli_num_rows($select_cart) > 0){
                        while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                        $total_price = number_format($fetch_cart['product_price'] * $fetch_cart['product_quentity']);
                        $grand_total = $total += $total_price;
                ?>
                <span class="displayorder"><?= $fetch_cart['product_name']; ?>(<?= $fetch_cart['product_quentity']; ?>)</span>
                <?php
                    }
                }else{
                    echo "<div class='display-order'><span>your cart is empty!</span></div>";
                }
                ?>
                <span class="grand-total"> Price : <?= $grand_total ; ?>/- </span>
                </div>

                <div class="flex">
                <h1 class="heading">BILLING ADDRESS</h1>
                <div class="subinputtype">
                    <div class="inputBox">
                        <span>Name</span>
                        <input type="text" placeholder="enter your name" name="name" required>
                    </div>
                    <div class="inputBox">
                        <span>Phone Number</span>
                        <input type="number" placeholder="enter your number" name="number" required>
                    </div>
                    <div class="inputBox">
                        <span>your Email</span>
                        <input type="email" placeholder="enter your email" name="email" required>
                    </div>
                </div>
                <div class="subinputtype">
                    <div class="inputBox">
                        <span>address line 1</span>
                        <input type="text" placeholder="e.g. flat no." name="flat" required>
                    </div>
                    <div class="inputBox">
                        <span>address line 2</span>
                        <input type="text" placeholder="e.g. street name" name="street" required>
                    </div>
                    <div class="inputBox">
                        <span>City</span>
                        <input type="text" placeholder="e.g. mumbai" name="city" required>
                    </div>

                </div>   
                
                <div class="subinputtype">
                <div class="inputBox">
                        <span>State</span>
                        <input type="text" placeholder="e.g. maharashtra" name="state" required>
                    </div>
                    <div class="inputBox">
                        <span>Country</span>
                        <input type="text" placeholder="e.g. india" name="country" required>
                    </div>
                    <div class="inputBox">
                        <span>Pin Code</span>
                        <input type="text" placeholder="e.g. 123456" name="pin_code" required>
                    </div>
                </div>
            </div>
            <div class="payment">
                        <span>payment method :</span>
                        <div class="delivery_payment">
                        <span>payment method : &nbsp;</span>
                        <select name="method" class="method">
                           <option value=""selected="true" disabled="disabled"> --Select--</option>
                            <option value="cash on delivery" >cash on devlivery</option>
                            
                        </select>

            </div>
            </div>


                <input type="submit" value="Continue to checkout" name="order_btn" class="btn order-btn">
                </form>

            </section>
            <?php
        }
        
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
                echo "
                <div class='order-message-container'>
                <div class='message-container'>
                   <h3>thank you for shopping!</h3>
                   <div class='order-detail'>
                      <span>".$total_product."</span>
                      <span class='total'> total : ".$price_total."/-  </span>
                   </div>
                   <div class='customer-details'>
                      <p> your name : <span>".$name."</span> </p>
                      <p> your number : <span>".$number."</span> </p>
                      <p> your email : <span>".$email."</span> </p>
                      <p> your address : <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country." - ".$pin_code."</span> </p>
                      <p> your payment mode : <span>".$method."</span> </p>
                      <p>(*pay when product arrives*)</p>
                   </div>
                      <a href='foods.php' class='btn'>continue shopping</a>
                   </div>
                </div>
                ";
            }
        }

        if(isset($_GET['food_id'])) {
            $food_id = $_GET['food_id'];
            
            ?>
            <section class="checkout-form">
            <div class="checkoutDiv">
                 <h1 class="heading">CHECKOUT</h1>

                </div>

                <form action="" method="post">
                <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                <div class="display-order">
                <?php
                    $get_cart = mysqli_query($conn, "SELECT * FROM food WHERE id=$food_id");
                    $total = 0;
                    $grand_total = 0;
                    if(mysqli_num_rows($get_cart) == 1){
                        $row_cart = mysqli_fetch_assoc($get_cart);
                        $title = $row_cart['title'];
                        $grand_total = $row_cart['price'];
                ?>
                <span  class="displayorder"><?= $row_cart['title']; ?></span>
                <?php
                }else{
                    echo "<div class='display-order'><span>your cart is empty!</span></div>";
                }
                ?>
                <span class="grand-total"> Price : <?= $grand_total; ?>/- </span>
                </div>

                <div class="flex">
                <h1 class="heading">BILLING ADDRESS</h1>
                <div class="subinputtype">
                    <div class="inputBox">
                        <span>Name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" placeholder="enter your name" name="name" required>
                    </div>
                    <div class="inputBox">
                        <span>Phone Number</span>&nbsp;
                        <input type="number" placeholder="enter your number" name="number" required>
                    </div>
                    <div class="inputBox">
                        <span>your Email</span>&nbsp;
                        <input type="email" placeholder="enter your email" name="email" required>
                    </div>
                </div>
                <div class="subinputtype">
                    <div class="inputBox">
                        <span>address line 1</span>&nbsp;
                        <input type="text" placeholder="e.g. flat no." name="flat" required>
                    </div>
                    <div class="inputBox">
                        <span>address line 2</span>&nbsp;&nbsp;&nbsp;
                        <input type="text" placeholder="e.g. street name" name="street" required>
                    </div>
                    <div class="inputBox">
                        <span>City</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" placeholder="e.g. mumbai" name="city" required>
                    </div>

                </div>   
                
                <div class="subinputtype">
                <div class="inputBox">
                        <span>State</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" placeholder="e.g. maharashtra" name="state" required>
                    </div>
                    <div class="inputBox">
                        <span>Country</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" placeholder="e.g. india" name="country" required>
                    </div>
                    <div class="inputBox">
                        <span>Pin Code</span>&nbsp;&nbsp;&nbsp;
                        <input type="text" placeholder="e.g. 123456" name="pin_code" required>
                    </div>
                </div>
                    
                    
                   
                   
            </div>
            <div class="payment">
            <h1 class="heading">PAYMENT</h1>
            <div class="delivery_payment">
                <span>payment method : &nbsp;</span>
                        <select name="method" class="method">
                           <option value=""selected="true" disabled="disabled"> --Select--</option>
                            <option value="cash on delivery" >cash on devlivery</option>
                            
                        </select>

            </div>
                       
            </div>
                <input type="submit" value="Continue to checkout" name="single_order_btn" class="btn order-btn">
                </form>

            </section>
            <?php
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
                echo "
                <div class='order-message-container'>
                <div class='message-container'>
                   <h3>thank you for shopping!</h3>
                   <div class='order-detail'>
                      <span>".$title."</span>
                      <span class='total'> total : ".$grand_total."/-  </span>
                   </div>
                   <div class='customer-details'>
                      <p> your name : <span>".$name."</span> </p>
                      <p> your number : <span>".$number."</span> </p>
                      <p> your email : <span>".$email."</span> </p>
                      <p> your address : <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country." - ".$pin_code."</span> </p>
                      <p> your payment mode : <span>".$method."</span> </p>
                      <p>(*pay when product arrives*)</p>
                   </div>
                      <a href='foods.php' class='btn'>continue shopping</a>
                   </div>
                </div>
                ";
            }
        }
        
        
    }
    else {
        echo "user not login";
    }
?>


<?php include('partials-front/footer.php'); ?>