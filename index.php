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

    <?php
        if(isset($_SESSION['order'])) {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }

        if(isset($_SESSION['already-added'])) {
            echo $_SESSION['already-added'];
            unset($_SESSION['already-added']);
        }
    ?>

    

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //Create SQL query to display Category from Database

                $sql = "SELECT * FROM category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                
                //Execute the query
                $res = mysqli_query($conn, $sql);

                //Count row the check weather the category if avialable or not
                $count = mysqli_num_rows($res);

                if($count > 0) {
                    //Category avialabel
                    while($row = mysqli_fetch_assoc($res)) {
                        //Create values like tittle image name and id
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container img-curve" data-aos="fade-up">
                                    <?php
                                        if($image_name == "") {
                                            echo "<div class='error'>Image not available</div>";
                                        } else {
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive ">
                                            <?php
                                        }
                                    ?>

                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                    }
                } else {
                    //Category not available
                    echo '<div class="error">Category not added</div>';
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            //Getting food from database that are active and featured

                $sql2 = "SELECT * FROM food WHERE active='Yes' AND featured='Yes' LIMIT 6";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2 > 0){
                    $i = 1;
                    while($row2 = mysqli_fetch_assoc($res2)) {
                        $id2 = $row2['id'];
                        $title2 = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name2 = $row2['image_name'];
                        // $featured = $row2['featured'];
                        if($i%2==0) {
                            ?>
                            <form action="addtocart.php" method="POST" enctype="multipart/form-data">
                                <div class="food-menu-box" data-aos="fade-left">
                            <?php
                        } else {
                            ?>
                            <form action="addtocart.php" method="POST" enctype="multipart/form-data">
                                <div class="food-menu-box" data-aos="fade-right">
                            <?php
                        }
                        ?>
                        
                            <div class="food-menu-img">
                                <?php
                                if($image_name2 == "") {
                                    echo '<div class="error">Image not available</div>';
                                } else {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name2; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve fixed">
                                    <input type="hidden" name="imageName" value="<?php echo $image_name2; ?>">
                                    <?php
                                }
                                ?>
                            </div>

                            <div class="food-menu-desc" >
                                <h4 style="font-size: 30px;"><?php echo $title2; ?></h4>
                                <input type="hidden" name="title1" value="<?php echo $title2; ?>">
                                <p class="food-price">₹<?php echo $price; ?></p>
                                <input type="hidden" name="price1" value="<?php echo $price; ?>">
                                <p class="food-detail text-truncate">
                                <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id2; ?>" class="btn btn-primary">Order Now</a>
                                <!-- <input type="number" class="quentityInput" name="quentity" min="1" max="100"> -->
                                <input type="hidden" name="food_id" value="<?php echo $id2; ?>">
                                <button type="submit" name="submit1" class="btn btn-primary">Add to Cart</button>
                            </div>
                        </div>
                        </form>
                        <?php
                        $i++;
                    }
                } else {
                    echo '<div class="error">Food not available</div>';
                }
            ?>

            

            <div class="clearfix"></div>

        </div>

        <!-- <p class="text-center">
            <a href="#">See All Foods</a>
        </p> -->
    </section>
    <!-- fOOD MEnu Section Ends Here -->



    <?php include('partials-front/footer.php'); ?>


    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init({
    	offset: 150,
    	delay: 100,
    	duration: 1000
    });
  </script>