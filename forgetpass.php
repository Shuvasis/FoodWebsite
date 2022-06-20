<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forget password</title>
    <link rel="stylesheet" href="css/forgetpass.css">
</head>
<body>
    <img src="pic/pic2png.png" alt="logo">
    <div class="container">
        <div class="div1">
            <p>Forgot your password?</p>
            <form method="post" action="common/forgetpass-code.php">
           <div class="input_box">
                <label>Please enter the Email ID you use for ragistration</label>
               <!-- <input type="hidden" name="id"> -->
                <input placeholder="Enter your e Email ID" name="email" type="email" required>
            </div>
            <?php
                if(isset($_GET['msg'])){
            ?>
			    <span style="text-align: center; font-size:1.2rem;  color:white;"><?php echo $_GET['msg']; ?></span> 
                <?php } ?>
   
            <div class="input_box">
                <input type="submit" name="submit" value="submit">
            </div>
            </form>
        </div>
        
    </div>
</body>
</html>