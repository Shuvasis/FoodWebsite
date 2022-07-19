 <?php 
    include('../config/constants.php');

?> 
<html>
    <head>
        <title>Food Order Website</title>
        <link rel="icon" type="image/x-icon" href="../images/fevicon.ico">
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>

        <?php include('partials/menu.php'); ?>

        <!-- main contain section start -->
        <div class="main-content">
        <div class="wrapper">
                <h1>DASHBOARD</h1><br><br>
                <div class="col-4 text-center" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                    <?php 
                        $sql = "SELECT * FROM category";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);

                    ?>
                    <h1><?php echo $count; ?></h1><br>
                    Category
                </div>

                <div class="col-4 text-center" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                    <?php 
                        $sql2 = "SELECT * FROM food";
                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);

                    ?>
                    <h1><?php echo $count2; ?></h1><br>
                    Foods
                </div>

                <div class="col-4 text-center" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                    <?php 
                        $sql3 = "SELECT * FROM `order`";
                        $res3 = mysqli_query($conn, $sql3);
                        $count3 = mysqli_num_rows($res3);

                    ?>
                    <h1><?php echo $count3; ?></h1><br>
                    Total Orders
                </div>

                <div class="col-4 text-center" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                    <?php
                        $sql4 = "SELECT SUM(total_price) AS Total FROM `order` WHERE status = 'Delivered'";
                        $res4 = mysqli_query($conn, $sql4);
                        $row4 = mysqli_fetch_assoc($res4);
                        $total_revenew = $row4['Total'];
                    ?>
                    <h1>₹<?php echo $total_revenew; ?></h1><br>
                    Revenew Genarated
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- main contain section end -->

       <?php include('partials/footer.php');?>

    </body>
</html>