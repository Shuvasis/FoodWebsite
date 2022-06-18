<?php include('partials-front/menu.php'); ?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            //Display all the categorys that are acive and featured
                $sql = "SELECT * FROM category WHERE active='Yes'";

                //Execute the query
                $res = mysqli_query($conn, $sql);

                //Count rows
                $count = mysqli_num_rows($res);

                //Check weather categorys available or not
                if($count > 0) {
                    //Category available
                    while($row = mysqli_fetch_assoc($res)) {
                        //Get the values
                        $id = $row['id'];
                        $title =$row['title'];
                        $image_name = $row['image_name'];

                        ?>

                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container img-curve">
                                    <?php
                                    if($image_name == "") {
                                        echo "<div class='error'>Image not available</div>";
                                    } else {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>/images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive">
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
                    echo '<div class="error">Category not available</div>';
                }
            ?>

            


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>