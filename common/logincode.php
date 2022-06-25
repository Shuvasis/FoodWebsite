<?php
include('../config/constants.php');
if(isset($_POST['submit'])){
    $username=$_POST['username'];
$password=$_POST['password'];

if(($username=='Admin')AND($password=='admin123'))
{   
    session_start();
    $_SESSION['adminloginuser']=$username;
    header('location:../admin/index.php');
}
else{

    $uname=mysqli_query($conn,"SELECT * FROM userdb WHERE email= '$username' AND password ='$password'")or die("connection error");
    $nname=mysqli_num_rows($uname);
    if($nname==0){
        header('location:../user-login.php?msg=Wrong Userid or Password');
    }
    else{
        $_SESSION['loginuser']=$username;
        header('location:../index.php');
    }
    
    
}

}
