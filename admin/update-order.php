<?php include('../config/constants.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Order</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="icon" type="image/x-icon" href="../images/fevicon.ico">
</head>
<body>
<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE ORDER</h1>
        <br><br>

        <?php
            if(isset($_GET['order_id'])) {
                $order_id = $_GET['order_id'];
                $sql = "SELECT * FROM `order` WHERE order_id = $order_id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $name = $row['name'];
                    $flat = $row['flat'];
                    $street = $row['street'];
                    $city = $row['city'];
                    $state = $row['state'];
                    $country = $row['country'];
                    $pin_code = $row['pin_code'];
                    $product_names = $row['total_products'];
                    $total_price = $row['total_price'];
                    $status = $row['status'];
                }
                else {
                    $_SESSION['no-category-found'] = "<div class='error'>Order not found</div>";
                    header('location:manage-category.php');
                }
            }
            else {
                header('location:manage-category.php');
            }
        ?>

        <form action="" method="post">
            <table style="width: 100%;">
                <tr>
                    <th>Customer Name</th>
                    <th>Customer Adress</th>
                    <th>Product Names</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td><?php echo $name; ?></td>
                    <td>
                    <?php echo $flat." ".$street." ".$city." ".$state." ".$country." ".$pin_code; ?>
                    </td>
                    <td><?php echo $product_names; ?></td>
                    <td><?php echo $total_price; ?></td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On-Delivery"){echo "selected";} ?> value="On-Delivery">On-Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
            </table>
            <br><br>
            <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
            <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">

            <button type="submit" name="submit" class="btn-secondary">Update Order</button>
        </form>

        <?php
            if(isset($_POST['submit'])) {
                $update_status = $_POST['status'];
                $order_id = $_POST['order_id'];

                $update_order_sql = "UPDATE `order` SET  `status`='$update_status' WHERE order_id = $order_id";
                $update_res = mysqli_query($conn, $update_order_sql);

                if($update_res == true) {
                    $_SESSION['order-update'] = "<div class='success'>Order Updated Successfully</div>";
                    header('location:manage-order.php');
                }
                else {
                    $_SESSION['order-update'] = "<div class='error'>Order Update Failed</div>";
                    header('location:manage-order.php');
                }
            }
        ?>
    </div>
</div>
<?php include('partials/footer.php');?>
</body>
</html>