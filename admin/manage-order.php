<?php include('../config/constants.php');?>
<html>
    <head>
        <title>Manage order </title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="icon" type="image/x-icon" href="../images/fevicon.ico">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>

        <?php include('partials/menu.php'); ?>
         <!-- main contain section start -->
         <div class="main-content">
        <div class="wrapper">
               <h1>MANAGE ORDER</h1>
               
               <br><br>
               <?php
                    if(isset($_SESSION['order-update'])) {
                        echo $_SESSION['order-update'];
                        unset($_SESSION['order-update']);
                    }
               ?>
               <br>

                <table class="tbl-full">
                    <tr>
                        <th>Sl.No</th>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Email</th>
                        <th>Payment Method</th>
                        <th>Address</th>
                        <th>Product Names</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                        <th>Order Status</th>
                        <th>Action</th>
                    </tr>

                    <?php
                        $sql = "SELECT * FROM `order` ORDER BY order_id DESC";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);

                        $sl = 1;

                        if($count > 0) {
                            while($row = mysqli_fetch_assoc($res)) {
                                $order_id = $row['order_id'];
                                $name = $row['name'];
                                $mobile_number = $row['number'];
                                $email = $row['email'];
                                $payment_method = $row['method'];
                                $flat = $row['flat'];
                                $street = $row['street'];
                                $city = $row['city'];
                                $state = $row['state'];
                                $country = $row['country'];
                                $pin_code = $row['pin_code'];
                                $product_names = $row['total_products'];
                                $total_price = $row['total_price'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];

                                ?>
                                    <tr>
                                        <td><?php echo $sl++; ?></td>
                                        <td><?php echo $name; ?></td>
                                        <td><?php echo $mobile_number; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $payment_method; ?></td>
                                        <td>
                                            <?php echo $flat." ".$street." ".$city." ".$state." ".$country." ".$pin_code; ?>
                                        </td>
                                        <td><?php echo $product_names; ?></td>
                                        <td><?php echo $total_price; ?></td>
                                        <td><?php echo $order_date; ?></td>
                                        <td>
                                            <?php 
                                                if($status == "Ordered") {
                                                    echo "<strong style='color: violet;'>$status</strong>";
                                                }
                                                elseif($status == "On-Delivery") {
                                                    echo "<strong style='color: orange;'>$status</strong>";
                                                }
                                                elseif($status == "Delivered") {
                                                    echo "<strong style='color: green;'>$status</strong>";
                                                }
                                                elseif($status == "Cancelled") {
                                                    echo "<strong style='color: red;'>$status</strong>";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-order.php?order_id=<?php echo $order_id; ?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        } 
                        else {
                            echo '<tr><td class="error" colspan="12">Order not avilable</td></tr>';
                        }
                    ?>
                </table>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- main contain section end -->
        <?php include('partials/footer.php');?>