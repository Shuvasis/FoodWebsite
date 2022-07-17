<?php include('partials-front/menu.php'); ?>

<?php
    if(isset($_SESSION['loginuser'])) {
        
        if(isset($_POST['checkout'])) {
            ?>
            <section class="checkout-form">

                <h1 class="heading">complete your order</h1>

                <form action="thankyou.php" method="post">

                

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

        if(isset($_GET['food_id'])) {
            $food_id = $_GET['food_id'];
            
            ?>
            <section class="checkout-form">

                <h1 class="heading">complete your order</h1>

                <form action="thankyou.php" method="post">
                <input type="hidden" name="food_id" value="<?php echo $food_id; ?>">
                

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
   
    }
    else {
        header('location:user-login.php');
    }
?>


<?php include('partials-front/footer.php'); ?>