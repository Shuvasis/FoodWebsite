    <?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <?php
                //Get the search keyword
                // $search = $_POST['search'];
                $search = mysqli_real_escape_string($conn, $_POST['search']);
            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $_POST['search']; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

            //SQL query is get foods based on search keyword
            $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //Count rows
            $count = mysqli_num_rows($res);

            //Check weather food avilable or not
            if($count > 0) {
                //Food avilable
                while($row = mysqli_fetch_assoc($res)) {
                    //Get the details 
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                        <form action="addtocart.php" method="POST" enctype="multipart/form-data">
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                    //Check image avilable or not
                                    if($image_name == "") {
                                        //Image not avilable
                                        echo '<div class="error">Image not avilable</div>';
                                    } else {
                                        //image available
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                            <input type="hidden" name="imageName" value="<?php echo $image_name; ?>">
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <input type="hidden" name="title1" value="<?php echo $title; ?>">
                                    <p class="food-price"><?php echo $price; ?></p>
                                    <input type="hidden" name="price1" value="<?php echo $price; ?>">
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                    <input type="hidden" name="food_id" value="<?php echo $id; ?>">
                                    <button type="submit" name="submit1" class="btn btn-primary">Add to Cart</button>
                                </div>
                            </div>
                        </form>
                    <?php
                }
            } else {
                //Food not avilable
                echo '<div class="error">Food not found</div>';
            }

            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>
    