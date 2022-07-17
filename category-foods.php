
    <?php include('partials-front/menu.php'); ?>

    <?php
        //Check wather id is pass or not
        if(isset($_GET['category_id'])) {
            //category_id is set and get the id
            $category_id = $_GET['category_id'];
            //Get the category title based on category_id
            $sql = "SELECT title FROM category WHERE id=$category_id";
            
            //Execute the query
            $res = mysqli_query($conn, $sql);

            //Get the value from database
            $row = mysqli_fetch_assoc($res);

            //Get the title
            $category_title = $row['title'];
        } else {
            //Category not pass and redirect to home page
            header('location:'.SITEURL);
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //Create SQL query to get foods based on selected query
                $sql2 = "SELECT * FROM food WHERE category_id=$category_id";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                //Count the rows
                $count = mysqli_num_rows($res2);

                //Check weather food is avilable or not
                if($count > 0) {
                    //Food is available
                    while($row2 = mysqli_fetch_assoc($res2)) {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                            <form action="addtocart.php" method="POST" enctype="multipart/form-data">
                                <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <?php
                                            //Check image avilable or not
                                            if($image_name == "") {
                                                //Image not avilable
                                                echo '<div class="error">Image are not avilable</div>';
                                            } else {
                                                //Image avilable
                                                ?>
                                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                                    <input type="hidden" name="imageName" value="<?php echo $image_name; ?>">
                                                <?php
                                            }
                                        ?>
                                    </div>

                                    <div class="food-menu-desc" data-aos="fade-left">
                                        <h4><?php echo $title; ?></h4>
                                        <input type="hidden" name="title1" value="<?php echo $title; ?>">
                                        <p class="food-price">₹<?php echo $price; ?></p>
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
                    echo '<div class="error">Food not avilavle</div>';
                }
            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>