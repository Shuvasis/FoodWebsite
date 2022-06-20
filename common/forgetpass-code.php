<?php
include('../config/constants.php');
include('../mail.php');
if(isset($_POST['submit'])){
	$email=$_POST['email'];
	// $id=$_POST['id'];
	$semail=mysqli_query($conn,"SELECT * from userdb WHERE email='$email'");
	$saemail=mysqli_num_rows($semail);
	$row=mysqli_fetch_assoc($semail);
	$passwordlink=md5($email.time());
    $id=$row['userid'];
	$sql=mysqli_query($conn,"INSERT INTO forgetpassword values('$id','$passwordlink')");
	if($saemail!=0){
		$to = "$email";
        $subject = "Reset Your Login Password"; 
                    	
		$message = "
		<html>
		<head>
		<title>Reset your Password </title>
		</head>
		<body>
		<p>Dear User,</p>

		<p>Reset your Login password by following these steps:</p>
		
		<p><a href='http://localhost/FoodWebsite/resetpass.php?passwordlink=$passwordlink'>Click Here</a> to reset your password. A new browser window will open.</p>
		
		
		</body>
		</html>";
		
		sendmail($to,$message);
		header('location:../forgetpass.php?msg= A reset password link send to your mail.');
		
	}
	else{
		header('location:../forgetpass.php?msg=The email id is not registered');
	}
	
}

?>