<?php include('partials-front/menu.php'); ?>

<?php
if(isset($_SESSION['loginuser']))
{

?>

    <section>
        <div class="main-contant">
            <div class="wrapper">
                <h1>Cart Page</h1>
                <br><br>
                
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
                        $grand_total = 0;
    
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
                                        <td><?php echo $row['product_name']; ?></td>
                                        <td>
                                            <?php
                                                if($row['product_image'] == "") {
                                                    echo '<div class="error">Image not avilable</div>';
                                                } else {
                                                    ?>
                                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $row['product_image']; ?>" alt="" width="100px">
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                        <form action="" method="POST">
                                            <input type="hidden" name="update_quantity_id"  value="<?php echo $row['product_id']; ?>" >
                                            <input class="update_input" type="number" name="update_quantity" min="1"  value="<?php echo $row['product_quentity']; ?>" >
                                            <input type="submit" value="Update" name="update_update_btn" class="update_btn">
                                        </form>
                                        <?php
                                            if(isset($_POST['update_update_btn'])){
                                                $update_value = $_POST['update_quantity'];
                                                $update_id = $_POST['update_quantity_id'];
                                                $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET product_quentity = $update_value WHERE product_id = $update_id");
                                                if($update_quantity_query){
                                                    header('location:cart.php');
                                                }
                                            }
                                        ?>
                                        </td>
                                        <td>₹<?php echo $sub_total = number_format($row['product_price'] * $row['product_quentity']); ?></td>
                                        <form action="removeCart.php" method="POST">
                                            <input type="hidden" name="delete_id" value="<?php echo $product_id; ?>">
                                            <td><button type="submit" name="submit" class="remove_button">Remove</button></td>
    
                                            
                                        </form>
                                    </tr>
                                <?php
                                $grand_total += $sub_total;
                            }
                        }

                    ?>
    
                    <tr class="total_price">
                        <td>Total Price: ₹</td>
                        <td><?php echo $grand_total; ?></td>
                    </tr>
                </table>
                <form action="order.php" method="POST">
                    <input type="hidden" name="total" value="<?php echo $grand_total; ?>">
                    <button type="submit" name="checkout" class="button_checkout">CHECKOUT</button>
                </form>
            </div>
        </div>
    </section>

<?php
}
else
{
    echo '<div class="error">You Login First</div>';
    header('location:'.SITEURL);

}
?>

<!-- Section Start Here -->
<!-- Section End Here -->



<?php include('partials-front/footer.php'); ?>