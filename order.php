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

                <h1 class="heading">CHECKOUT</h1>

                <form action="thankyou.php" method="post">

                

                <div class="flex">
                <h1 class="heading">BILLING ADDRESS</h1>
                    <div class="subinputtype">
                        <div class="inputBox">
                            <span>Name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="text" placeholder="enter your name" name="name" required>
                        </div>
                        <div class="inputBox">
                            <span>Phone Number</span>&nbsp;
                            <input type="number" placeholder="enter your number" name="number" required>
                        </div>
                        <div class="inputBox">
                            <span>Your Email</span>&nbsp;
                            <input type="email" placeholder="enter your email" name="email" required>
                        </div>
                    </div>
                    <div class="subinputtype">
                        <div class="inputBox">
                            <span>Address Line 1</span>&nbsp;
                            <input type="text" placeholder="e.g. flat no." name="flat" required>
                        </div>
                        <div class="inputBox">
                            <span>Address Line 2</span>&nbsp;
                            <input type="text" placeholder="e.g. street name" name="street" required>
                        </div>
                        <div class="inputBox">
                            <span>City</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="text" placeholder="e.g. mumbai" name="city" required>
                        </div>
                    </div>
                    <div class="subinputtype">
                        <div class="inputBox">
                            <span>State</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                        <span>Payment method</span>&nbsp;
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

        if(isset($_GET['food_id'])) {
            $food_id = $_GET['food_id'];
            
            ?>
            <section class="checkout-form">
                
                <h1 class="heading">CHECKOUT</h1>

                <form action="thankyou.php" method="post">
                <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                

                <div class="flex">
                    <div class="subinputtype">
                        <div class="inputBox">
                            <span>Name</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="text" placeholder="enter your name" name="name" required>
                        </div>
                        <div class="inputBox">
                            <span>Phone Number</span>&nbsp;
                            <input type="number" placeholder="enter your number" name="number" required>
                        </div>
                        <div class="inputBox">
                            <span>Your Email</span>&nbsp;
                            <input type="email" placeholder="enter your email" name="email" required>
                        </div>
                    </div>
                    <div class="subinputtype">
                        <div class="inputBox">
                            <span>Address Line 1</span>&nbsp;
                            <input type="text" placeholder="e.g. flat no." name="flat" required>
                        </div>
                        <div class="inputBox">
                            <span>Address Line 2</span>&nbsp;
                            <input type="text" placeholder="e.g. street name" name="street" required>
                        </div>
                        <div class="inputBox">
                            <span>City</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="text" placeholder="e.g. mumbai" name="city" required>
                        </div>
                    </div>
                    <div class="subinputtype">
                        <div class="inputBox">
                            <span>State</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
                        <span>Payment Method</span>&nbsp;
                        <!-- <select name="method" class="method">
                            <option value="cash on delivery" selected>cash on devlivery</option>
                            <option value="credit cart">credit cart</option>
                            <option value="paypal">paypal</option>
                        </select> -->
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
   
    }
    else {
        header('location:user-login.php');
    }
?>


<?php include('partials-front/footer.php'); ?>
