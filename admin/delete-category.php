<?php
    // echo "Delete page";
    include('../config/constants.php');
    if(isset($_GET['id']) AND isset($_GET['image_name'])) {
        // echo "Get value and Delete";

        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        if($image_name != "") {
            $path = "../images/category/".$image_name;
            $remove = unlink($path);

            if($remove==false) {

                $_SESSION['remove']= "<div class='error'>Failed to Remove</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }
        }
        // $path = "../images/category/".$image_name;
        // if(file_exists($path)) {
        //     unlink($path);
        //     echo "Delete image successful";
        // } else {
        //     // echo 'Could not delete file does not exist';
        //     $_SESSION['remove']= "<div class='error'>Failed to Remove</div>";
        //     header('location:'.SITEURL.'admin/manage-category.php');
        //     die();
        // }

        $sql = "DELETE FROM category WHERE id = $id";
        $res = mysqli_query($conn, $sql);

        if($res==true){

            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        } else{
            $_SESSION['delete'] = "<div class='error'>Category Deleted Failed</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }

    } else {
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>