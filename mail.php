<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function sendmail($to,$message)
{
      


      require 'PHPMailer/src/Exception.php';
      require 'PHPMailer/src/PHPMailer.php';
      require 'PHPMailer/src/SMTP.php';


      $mail = new PHPMailer(true);

      try {
      
                        
         $mail->isSMTP();                                           
         $mail->Host       = 'smtp.gmail.com';                     
         $mail->SMTPAuth   = true;                                   
         $mail->Username   = 'quickfood732@gmail.com';                    
         $mail->Password   = 'xvnuhzaikymgmwex';                             
         $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
         $mail->Port       = 465;                                    

      
         $mail->setFrom('quickfood732@gmail.com', 'Quick Food');

         $mail->addAddress($to);             


         $mail->isHTML(true);                                 
         $mail->Subject = 'Forget Password';
         $mail->Body    = $message;
         

         $mail->send();
         echo 'Message has been sent';
      } catch (Exception $e) {
         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }

}

?>
