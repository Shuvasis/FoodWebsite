<?php include('partials-front/menu.php'); ?>



<!-- Section Start Here -->
<section>
    <div class="main-contant">
        <div class="wrapper">
            <h1>Cart Page</h1>
            <br><br>
            <?php
                if(isset($_SESSION['remove_cart'])) {
                    echo $_SESSION['remove_cart'];
                    unset($_SESSION['remove_cart']);
                }
            ?><br><br>
            <table class="cTable">
                <tr>
                    <th>Serial No</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Product Quentity</th>
                    <th>Product Price</th>
                    <th>Action</th>
                </tr>

                <?php
                    $user_email = $_SESSION['loginuser'];
                    //Create a sql query to display all cart items
                    $sql = "SELECT * FROM cart WHERE user_email='$user_email'";

                    //Execute the query
                    $res = mysqli_query($conn, $sql);

                    //Count row
                    $count = mysqli_num_rows($res);

                    $sl = 1;

                    if($count > 0) {
                        while($row = mysqli_fetch_assoc($res)) {
                            $product_id = $row['product_id'];
                            $product_name = $row['product_name'];
                            $product_image = $row['product_image'];
                            $product_quentity = $row['product_quentity'];
                            $product_price = $row['product_price'];

                            ?>
                                <tr>
                                    <td><?php echo $sl++; ?></td>
                                    <td><?php echo $product_name; ?></td>
                                    <td>
                                        <?php
                                            if($product_image == "") {
                                                echo '<div class="error">Image not avilable</div>';
                                            } else {
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $product_image; ?>" alt="" width="100px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $product_quentity; ?></td>
                                    <td>₹<?php echo $product_price * $product_quentity; ?></td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="delete_id" value="<?php echo $product_id; ?>">
                                        <td><button type="submit" name="submit" class="btn btn-primary">Remove</button></td>

                                        <?php
                                            if(isset($_POST['submit'])) {
                                                $delete_product_id = $_POST['delete_id'];

                                                $deleteSQL = "DELETE FROM cart WHERE product_id = $delete_product_id";
                                                $deleteRES = mysqli_query($conn, $deleteSQL);
                                                // echo '<div class="success">Item Remove successful</div>';
                                                $_SESSION['remove_cart'] = "<div class='success'>Item Remove Successful</div>";
                                                header('location:cart.php');
                                            }
                                        ?>
                                    </form>
                                </tr>
                            <?php
                        }
                    }
                ?>

                
            </table>
            <button style="float: right">Checkout</button>
        </div>
    </div>
</section>
<!-- Section End Here -->



<?php include('partials-front/footer.php'); ?>