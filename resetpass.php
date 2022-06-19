<?php
include('config/constants.php');

$passwordlink=$_GET['passwordlink'];
$store=mysqli_query($conn,"SELECT userid from forgetpassword WHERE  passwordlink='$passwordlink'");
$storeid=mysqli_num_rows($store);
if(!$storeid){
    die("incorrect link");
}
else{
    $row=mysqli_fetch_assoc($store);
    $id=$row['userid'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset password</title>
    <link rel="stylesheet" href="css/forgetpass.css">
</head>
<body>
    <img src="pic/pic3.png" alt="logo">
    <div class="container">
    <form method="POST" action="resetpass-code.php">
        <div class="div1">
            <p>Reset password</p>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="passwordlink" value="<?php echo $passwordlink; ?>">
            <div class="input_box">
               
                <lable style="font-size: 1.2rem; color: rgb(48, 20, 48);"></lable>
                <input placeholder="Enter Password" name="password" type="password" required>
                <input placeholder="Confirm Password" name="rpassword" type="password" required>
            </div>
            <div class="input_box">
                <input type="submit" value="Submit" name="submit">
                
            </div>
            <?php
                if(isset($_GET['msg'])){
            ?>
			    <span style="text-align: center; font-size:1.2rem;  color:white;"><?php echo $_GET['msg']; ?></span> 
                <?php } ?>
            
        </div>
    </form>
    </div>
</body>
</html>