<?php include('config/constants.php'); ?>
<?php
    if(isset($_POST['submit'])) {
        $delete_product_id = $_POST['delete_id'];

        $deleteSQL = "DELETE FROM cart WHERE product_id = $delete_product_id";
        $deleteRES = mysqli_query($conn, $deleteSQL);
        // echo '<div class="success">Item Remove successful</div>';
        header('location:cart.php');
        
    }
?>