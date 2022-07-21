<?php
                    include('../config/constants.php');
                    if(isset($_POST['submit']))
                    {
                        $title=$_POST['title'];
                        $description=$_POST['description'];
                        $price=$_POST['price'];
                        $category=$_POST['category'];
                        

                        if(isset($_POST['featured'])){
                            $featured=$_POST['featured'];
                        }
                        else{
                            $featured="No";
                        }
                    

                    if(isset($_POST['active'])){
                        $active=$_POST['active'];
                    }
                    else{
                        $active="No";
                    }

                    if(isset($_FILES['image']['name']))
                    {
                        $image_name = $_FILES['image']['name'];

                        if($image_name != "")
                        {
                           
                            $src = $_FILES['image']['tmp_name'];
                            // echo $src."<br>";
                            $dst="../images/food/".$image_name;
                            // echo $dst."<br>";
                            $upload = move_uploaded_file($src,$dst);
                            if($upload==false)
                            {
                                $_SESSION['upload'] = "<div class='error'>Faield to upload Image .</div>";
                                header('location:add-food.php');
                                // die();
                            }

                        }
                    }
                       
                    else
                     {
                        $image_name = "";
                    }
                   

                    $sql2="INSERT INTO food
                    VALUES ('','$title','$description','$price','$image_name','$category','$featured','$active')";
                    $res2= mysqli_query($conn, $sql2);
                    if($res2 == true)
                    {
                        $_SESSION['foodadd']= '<div class="success">Food Added successful.</div>';
                        header('location:manage-food.php');
                        
                     }
                    else{
                        $_SESSION['foodadd']= '<div class="error">Faield to Add Food.</div>';
                        header('location:manage-food.php');

                    }
                }
                ?>

<html>
    <head>
       <title> Add food </title>
       <link rel="stylesheet" href="../css/admin.css">
       <link rel="icon" type="image/x-icon" href="../images/fevicon.ico">
    </head>   
    <body>
    <?php include('partials/menu.php'); ?>
        <div class="main-content">
            <div class="wrapper">
                <h1>Add Food</h1>
                <br />

                <?php
                
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);}
                

                 ?>

                <form action="add-food.php" method="POST" enctype="multipart/form-data">
                    <table class="table_thirty">
                        <tr>
                            <td>Title: </td>
                            <td>
                                <input type="text" name="title" placeholder="Title of the food">
                            </td>
                        </tr>

                        <tr>
                            <td>Description: </td>
                            <td>
                                <textarea  name="description" cols="30" rows="5" placeholder="Description of the food"></textarea>
                            </td>
                        </tr>

                        <tr>
                            <td>Price: </td>
                            <td>
                                <input type="number" name="price" placeholder="Price of the food">
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Select Image: </td>
                            <td>
                                <input type="file" name="image">
                            </td>
                        </tr>

                        <tr>
                            <td>Category: </td>
                            <td>
                                <select name="category">
                                    <!-- display php code from database -->
                                    <?php
                                        $sql="SELECT * FROM category WHERE active='Yes'";
                                        $res = mysqli_query($conn, $sql);
                                        $count=mysqli_num_rows($res);
                                        if($count>0){
                                            while($row = mysqli_fetch_assoc($res)){
                                                $id = $row['id'];
                                                $title = $row['title'];
                                                ?>
                                                    <option value="<?php echo $id; ?>"> <?php echo $title; ?></option>

                                                <?php
                                            }
                                         }
                                        else{

                                            ?>
                                            <option value='0'>No Category Found</option>";
                                        <?php
                                        }
                                        ?>
                                        </select>
                                    </td>
                        </tr>

                        <tr>
                            <td>Featured: </td>
                            <td>
                                <input type="radio" value="Yes" name="featured" >Yes
                                <input type="radio" value="No" name="featured" >No
                            </td>
                        </tr>

                        <tr>
                            <td>Active: </td>
                            <td>
                                <input type="radio" value="Yes" name="active" >Yes
                                <input type="radio" value="No" name="active" >No
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="submit" name="submit" value="Add Food" class="btn-secondary">

                            </td>
                        </tr>
                    </table>
                </form>
                
                <!-- add data into db -->
                
            </div>
        </div>    


        <?php include('partials/footer.php'); ?>
    </body>
</html>

