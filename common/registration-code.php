<?php
include('../config/constants.php');
if(isset($_POST['submit'])){
    $username=get_post($conn,'username');
$email=get_post($conn,'email');
$password=get_post($conn,'password');
$repassword=get_post($conn,'repassword');


$semail=mysqli_query($conn,"SELECT * FROM userdb WHERE email='$email'") or die("connection error");
$seemail=mysqli_num_rows($semail);

if($seemail!=0)
{
    header('location:../user-registration.php?emailmsg=This Email id is already exsists');
}
else
{
     if($password==$repassword)
     {
         
         $sql="INSERT INTO userdb VALUES('','$password','$username','$email')";
        //  die($sql);
        
        //  $store=mysqli_query($conn,$sql);
        //  die("$store");
        $store= $conn->query($sql);
         
         if($store)
         {
            session_start();
            $_SESSION['loginuser']=$username;
             header('location:../index.php');
    
          
         }
         else{
             header('location:../user-registration.php?unsucsesmsg=Unsuccessful,Try Again');
         }
     }
     else{
         header('location:../user-registration.php?passwordmsg=Password not matched');
     }

}

}


?>
<?php 
	 function get_post($conn,$var)
	 {
	     return $conn->real_escape_string($_POST[$var]);
	 }
?>