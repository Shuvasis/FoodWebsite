<?php include('../config/constants.php');?>
<html>
    <head>
        <title>Manage Category </title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>

        <?php include('partials/menu.php'); ?>
         <!-- main contain section start -->
         <div class="main-content">
        <div class="wrapper">
               <h1>MANAGE CATEGORY</h1>
              <br>
                <?php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['remove']))
                    {
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['no-category-found']))
                    {
                        echo $_SESSION['no-category-found'];
                        unset($_SESSION['no-category-found']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['failed-remove']))
                    {
                        echo $_SESSION['failed-remove'];
                        unset($_SESSION['failed-remove']);
                    }
                ?>
                <br><br>
               <a href="<?php echo SITEURL; ?>admin/add-category.php" class="add_category" >Add Category</a>
              

                <table class="tbl-full">
                    <tr>
                        <th>Sl.No</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    
                        $sql = "SELECT * FROM category";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        $sl = 1;

                        if($count > 0)
                        {
                            while ($row = mysqli_fetch_assoc($res)) {
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>

                                    <tr>
                                        <td><?php echo $sl++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td>
                                            <?php 
                                                if($image_name!="") {
                                                    ?>
                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                                                    <?php
                                                } else {
                                                    echo "<div class='error'>Image not added</div>";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>/admin/update-category.php?id=<?php echo $id; ?>" style="color:blue"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" style="color:red"><i class="fa-solid fa-trash-can fa-2x"></i></a>
                                        </td>
                                    </tr>

                                <?php
                            }
                        }
                        else
                        {
                            ?>

                            <td colspan="6"><div class="error">No Category Added.</div></td>
                            <?php
                        }
                    ?>
                    

                </table>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- main contain section end -->
        <?php include('partials/footer.php');?>
    <!-- </body>
</html> -->