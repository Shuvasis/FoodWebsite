<html>
    <head>
        <title>Add-Employee</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <?php include('partials/menu.php');?>
        <div class="main-content">
             <div class="wrapper">
               <h1>ADD EMPLOYEE</h1><br/><br/>
               <?php
                 if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
?>

               <br/><br/>
               <form action="" method="POST">
                    <table class="table_thirty">
                        <tr>
                            <td>Full name:</td>
                            <td>
                                <input type="text" name="full_name" placeholder="Enter your Full name">
                            </td>
                            </tr>

                            <tr>
                            <td>Username:</td>
                            <td>
                                <input type="text" name="username" placeholder="Enter your Username">
                            </td>
                            </tr>

                            <tr>
                            <td>Password:</td>
                            <td>
                                <input type="password" name="password" placeholder="Enter your password">
                            </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <input type="submit" name="submit" value="Add Employee" class="btn-secondary">
                                </td>
                            </tr>
                    </table>

               </form>
            </div>
        </div>       


        <?php include('partials/footer.php'); ?>
    </body>
</html>



<!-- php code for add admin -->

<?php 
//check whether the button is clicked or not
if(isset($_POST['submit']))
{
    //Get data from form
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);//password encrypted with md5
    

    // sql query to save the data into database
    $sql="INSERT INTO my_admin SET 
        full_name='$full_name', 
        username='$username', 
        password='$password'
    ";
    
    //execute query and save data in database
      $res=mysqli_query($conn,$sql) or die('faield');

      //check wheather data is inserted or not and display 

      if($res==TRUE){
        //inserted
        $_SESSION['add']="Admin Added Successfully";
        header("location:".SITEURL.'admin/manage-admin.php');
        
      }
      else{
        //not
        $_SESSION['add']="faield to add admin";
        header("location:".SITEURL.'admin/add-admin.php');
       
      }
}

?>