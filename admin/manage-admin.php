<html>
    <head>
        <title>Manage Admin</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>

        <?php include('partials/menu.php'); ?>
       
        <!-- main contain section start -->
        <div class="main-content">
        <div class="wrapper">
               <h1>MANAGE EMPLOYEE</h1><br /><br/>
<?php
    if(isset($_SESSION['add'])){
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
?>
<br /><br>

                    <!-- button to add admin -->
                    <a href="add-admin.php" class="btn-primary">Add Employee</a>
                    <br/><br/><br/>

                <table class="tbl-full">
                    <tr>
                        <th>Sl.No</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    $sql="SELECT * FROM my_admin";
                    $res = mysqli_query($conn, $sql);
                    if($res==TRUE){
                        $count = mysqli_num_rows($res);
                        $sn=1;
                        if($count>0)
                        {
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username?></td>
                                   
                                    <td>
                                        <a href="#" class="btn-secondary">Update Employee</a>
                                        <a href="#" class="btn-danger">Delete Employee</a>
                                    </td>
                    </tr>
                                <?php
                            }
                        }
                        else{

                        }

                    }

                    ?>

                    

                </table>
            </div>
        </div>
        <!-- main contain section end -->

       <?php include('partials/footer.php');?>





    </body>
</html>