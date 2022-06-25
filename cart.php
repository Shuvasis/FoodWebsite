<?php include('partials-front/menu.php'); ?>


<!-- Section Start Here -->
<section>
    <div class="main-contant">
        <div class="wrapper">
            <h1>Cart Page</h1>
            <br>
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
                    //Create a sql query to display all cart items
                    $sql = "SELECT * FROM cart";

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
                                    <td><button class="btn btn-primary">Remove</button></td>
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