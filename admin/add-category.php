<?php include('../config/constants.php');?>
<html>
    <head>
        <title>Add category</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <?php include('partials/menu.php'); ?>

            <div class="main-content">
                <!-- add category -->
                <div class="wrapper">
                    <h1>Add Category</h1>
                    <br><br>
                    <?php
                        if(isset($_SESSION['add']))
                        {
                            echo $_SESSION['add'];
                            unset($_SESSION['add']);
                        }

                        if(isset($_SESSION['upload']))
                        {
                            echo $_SESSION['upload'];
                            unset($_SESSION['upload']);
                        }
                    ?>
                    <br><br>

                    <!-- Add category form starts -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <table class="table_thirty">
                            <tr>
                                <td>Title: </td>
                                <td>
                                    <input type="text" name="title" placeholder="Category Title">
                                </td>
                            </tr>
                            <tr>
                                <td>Select Image: </td>
                                <td>
                                    <input type="file" name="image">
                                </td>
                            </tr>
                            <tr>
                                <td>Featured: </td>
                                <td>
                                    <input type="radio" name="featured" value="Yes">Yes
                                    <input type="radio" name="featured" value="No">No
                                </td>
                            </tr>
                            <tr>
                                <td>Active: </td>
                                <td>
                                    <input type="radio" name="active" value="Yes">Yes
                                    <input type="radio" name="active" value="No">No
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" name="submit" value="Add Categroy" class="btn-secondary">
                                </td>
                            </tr>
                        </table>
                    </form>
                    <!-- Add category form ends -->
                    <?php 
                        // whether the submit button clicked or not
                        if(isset($_POST['submit']))
                        {
                            
                            
                            //1st get the value from categroy form
                            $title = $_POST['title'];
                            
                            // for radio button clicked or not or get the value
                            if(isset($_POST['featured']))
                            {
                                $featured = $_POST['featured'];
                            }
                            else
                            {
                                $featured = "No";
                            }

                            if(isset($_POST['active']))
                            {
                                $active = $_POST['active'];
                            }
                            else
                            {
                                $active = "No";
                            }

                            //Check weather image selected or not and set the value of image name
                           
                            if(isset($_FILES['image']['name']))
                            {
                                $image_name = $_FILES['image']['name'];

                                if($image_name != "") {
                                    
                                    $ext = end(explode('.', $image_name));
                                    $image_name = "Food_Category_".rand(000, 999).'.'.$ext;
                                    $sourece_path = $_FILES['image']['tmp_name'];
                                    $destination_path = "../images/category/".$image_name;

                                    $upload = move_uploaded_file($sourece_path, $destination_path);
                                    if($upload==false)
                                    {
                                        $_SESSION['upload'] = "<div class='error'>Failed to upload image </div>";
                                        header('location:'.SITEURL.'admin/add-category.php');
                                        die();
                                    }
                                }
                            }
                            else
                            {
                                $image_name = "";
                            }

                            //Create SQL Quary to Insert Category into database

                            $sql = "INSERT INTO category SET 
                            title = '$title',
                            image_name = '$image_name',
                            featured = '$featured',
                            active = '$active'
                            ";

                            //Execute the quary and save in database
                            $res = mysqli_query($conn, $sql);
                            
                            //Check weather the quary excuted or not add data added or not
                            if($res==true)
                            {
                                //Quary executed
                                $_SESSION['add'] = '<div class="success">Category added successful</div>';

                                //Redirect too manage category page
                                header('location:'.SITEURL.'admin/manage-category.php');
                            }
                            else
                            {
                                //Failed too Add Category
                                $_SESSION['add'] = '<div class="error">Category added failed</div>';

                                //Redirect too manage category page
                                header('location:'.SITEURL.'admin/add-category.php');
                            }
                        }   
                    ?>
                </div>
            </div>

        <?php include('partials/footer.php'); ?>        
    </body>
</html>
