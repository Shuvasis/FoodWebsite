<?php include('partials-front/menu.php'); ?>

<?php
    if(isset($_SESSION['loginuser'])) {
        
        if(isset($_POST['checkout'])) {
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
