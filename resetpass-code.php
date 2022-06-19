<?php
   include('config/constants.php');
   if(isset($_POST['submit'])){
    $password=$_POST['password'];
    $rpassword=$_POST['rpassword'];
    $id=$_POST['id'];
    $passwordlink=$_POST['passwordlink'];
    if($password == $rpassword){
        $sqlquery=mysqli_query($conn,"UPDATE userdb SET password='$password' WHERE id='$id'");
        if($sqlquery){
            header('location:user-login.php');
           
        }
        else{
            header('location:resetpass.php?passwordlink='.$passwordlink.'&msg=not updated');
          
        }
    }
    else{
        header('location:resetpass.php?passwordlink='.$passwordlink.'&msg=password not matched');
    }
           
}
else{
    echo "failed to submit";
}

?>