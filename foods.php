<?php include('partials-front/menu.php'); ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            //Sql query
            $sql = "SELECT * FROM food WHERE active='Yes'";

            //Execute query
            $res = mysqli_query($conn, $sql);

            //Count number of rows
            $count = mysqli_num_rows($res);

            //Check food are avilable or not
            if($count > 0) {
                $i = 1;
                //Foods avilable
                while($row = mysqli_fetch_assoc($res)) {
                    //Get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $description = $row['description'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];

                    if($i%2==0) {
                        ?>
                            <div class="food-menu-box" data-aos="fade-left">
                        <?php
                    } else {
                        ?>
                            <div class="food-menu-box" data-aos="fade-right">
                        <?php
                    }

                    ?>
                    
                    
                        <div class="food-menu-img">
                            <?php
                            if($image_name == "") {
                                echo '<div class="error">Image not avilable</div>';
                            } else {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">₹<?php echo $price; ?></p>
                            <p class="food-detail text-truncate">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
            } else {
                //Foods not avilable
                echo '<div class="error">Foods are not avilable</div>';
            }
            ?>

            


            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>
    