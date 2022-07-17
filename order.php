<?php include('partials-front/menu.php'); ?>

    <?php
        //Check weather food is set or not
        if(isset($_GET['food_id'])) {
            //Get the food and details of the selected food
            $food_id = $_GET['food_id'];

            //get the details of the selected food
            $sql = "SELECT * FROM food WHERE id=$food_id";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //Count the rows
            $count = mysqli_num_rows($res);

            //Check wather data is avilable or not
            if($count == 1) {
                //We have data
                //Get the data from database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            } else {
                //Food not avialable and redirect to home page
                echo '<div class="error">Food is not avilable</div>';
                header('location:index.php');
            }
        } else {
            //Redirect to homepage
            header('location:index.php');
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order" enctype="multipart/form-data">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            //Check image is avilable or not
                            if($image_name == "") {
                                echo '<div class="error">Image not avilable</div>';
                            } else {
                                ?>
                                    <img src="<?php SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">₹<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
                //Check wather submit button clicked or not
                if(isset($_POST['submit'])) {
                    //Get all the details from the form

                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $quantity = $_POST['qty'];
                    $total = $price * $quantity; //calculate order price
                    $order_date = date("Y-m-d h:i:sa"); //order date
                    $status = "Ordered"; //Order status like ordered, on-delivered, delivered, canceled

                    //Coustomer details
                    $coustomer_name = $_POST['full-name'];
                    $coustomer_contact = $_POST['contact'];
                    $coustomer_email = $_POST['email'];
                    $coustomer_address = $_POST['address'];

                    //Save the order in Database
                    //Create a SQL query to save the data
                    // $sql2 = "INSERT INTO order_food SET
                    //     food = '$food',
                    //     price = $price,
                    //     quantity = $quantity,
                    //     total = $total,
                    //     order_date = '$order_date',
                    //     status = '$status',
                    //     coustomer_name = '$coustomer_name',
                    //     coustomer_contact = '$coustomer_contact',
                    //     coustomer_address = '$coustomer_address'
                    // ";

                    $sql2 = "INSERT INTO `order_food`(`food`, `price`, `quantity`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`)
                        VALUES (
                            '$food',
                             $price,
                             $quantity,
                             $total,
                             '$order_date',
                             '$status',
                             '$coustomer_name',
                             '$coustomer_contact',
                             '$coustomer_email',
                             '$coustomer_address')";
                    //Execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==true) {
                        
                        $_SESSION['order'] = '<div class="success">Food Order Successfull.</div>';
                        header('location:index.php');
                    } else {
                        $_SESSION['order'] = '<div class="error">Failed to Order Food</div>';
                        header('location:index.php');
                    }
                }
            ?>
            <section class="checkout-form">

                <h1 class="heading">complete your order</h1>

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
                <span><?= $fetch_cart['product_name']; ?>(<?= $fetch_cart['product_quentity']; ?>)</span>
                <?php
                    }
                }else{
                    echo "<div class='display-order'><span>your cart is empty!</span></div>";
                }
                ?>
                <span class="grand-total"> grand total : $<?= $grand_total; ?>/- </span>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>your name</span>
                        <input type="text" placeholder="enter your name" name="name" required>
                    </div>
                    <div class="inputBox">
                        <span>your number</span>
                        <input type="number" placeholder="enter your number" name="number" required>
                    </div>
                    <div class="inputBox">
                        <span>your email</span>
                        <input type="email" placeholder="enter your email" name="email" required>
                    </div>
                    <div class="inputBox">
                        <span>payment method</span>
                        <select name="method">
                            <option value="cash on delivery" selected>cash on devlivery</option>
                            <option value="credit cart">credit cart</option>
                            <option value="paypal">paypal</option>
                        </select>
                    </div>
                    <div class="inputBox">
                        <span>address line 1</span>
                        <input type="text" placeholder="e.g. flat no." name="flat" required>
                    </div>
                    <div class="inputBox">
                        <span>address line 2</span>
                        <input type="text" placeholder="e.g. street name" name="street" required>
                    </div>
                    <div class="inputBox">
                        <span>city</span>
                        <input type="text" placeholder="e.g. mumbai" name="city" required>
                    </div>
                    <div class="inputBox">
                        <span>state</span>
                        <input type="text" placeholder="e.g. maharashtra" name="state" required>
                    </div>
                    <div class="inputBox">
                        <span>country</span>
                        <input type="text" placeholder="e.g. india" name="country" required>
                    </div>
                    <div class="inputBox">
                        <span>pin code</span>
                        <input type="text" placeholder="e.g. 123456" name="pin_code" required>
                    </div>
                </div>
                <input type="submit" value="order now" name="order_btn" class="btn order-btn">
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

                <h1 class="heading">complete your order</h1>

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
                <span><?= $row_cart['title']; ?></span>
                <?php
                }else{
                    echo "<div class='display-order'><span>your cart is empty!</span></div>";
                }
                ?>
                <span class="grand-total"> grand total : <?= $grand_total; ?>/- </span>
                </div>

                <div class="flex">
                    <div class="inputBox">
                        <span>your name</span>
                        <input type="text" placeholder="enter your name" name="name" required>
                    </div>
                    <div class="inputBox">
                        <span>your number</span>
                        <input type="number" placeholder="enter your number" name="number" required>
                    </div>
                    <div class="inputBox">
                        <span>your email</span>
                        <input type="email" placeholder="enter your email" name="email" required>
                    </div>
                    <div class="inputBox">
                        <span>payment method</span>
                        <select name="method">
                            <option value="cash on delivery" selected>cash on devlivery</option>
                            <option value="credit cart">credit cart</option>
                            <option value="paypal">paypal</option>
                        </select>
                    </div>
                    <div class="inputBox">
                        <span>address line 1</span>
                        <input type="text" placeholder="e.g. flat no." name="flat" required>
                    </div>
                    <div class="inputBox">
                        <span>address line 2</span>
                        <input type="text" placeholder="e.g. street name" name="street" required>
                    </div>
                    <div class="inputBox">
                        <span>city</span>
                        <input type="text" placeholder="e.g. mumbai" name="city" required>
                    </div>
                    <div class="inputBox">
                        <span>state</span>
                        <input type="text" placeholder="e.g. maharashtra" name="state" required>
                    </div>
                    <div class="inputBox">
                        <span>country</span>
                        <input type="text" placeholder="e.g. india" name="country" required>
                    </div>
                    <div class="inputBox">
                        <span>pin code</span>
                        <input type="text" placeholder="e.g. 123456" name="pin_code" required>
                    </div>
                </div>
                <input type="submit" value="order now" name="single_order_btn" class="btn order-btn">
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