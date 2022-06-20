<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <link rel="icon" type="image/x-icon" href="images/fevicon.ico">
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    

    
</head>

<body>

    <!-- Navbar Section Starts Here -->
    <section class="navbar" >
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                <img src="images/newlogo.png" alt="Restaurant Logo" class="img-responsiveOne">
                    
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                    <li><a href="user-login.php" class="logout">Log In</a></li>
                    <li>
                        <a href="user-logout.php" class="logout">Log out</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->


    