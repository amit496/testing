<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['sbtn']))
{


$mail = new PHPMailer(true);

try {
 
                  
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'amitquckit@gmail.com';                    
    $mail->Password   = 'wrpfohovyqoxlubv';                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

  
    $mail->setFrom('amitquckit@gmail.com', 'Amit Gautam');

    // $mail->addAddress('amitgautam583@gmail.com');             
    $mail->addAddress($_POST['email']);             


    $mail->isHTML(true);                                 
    // $mail->Subject = 'Here is the subject'.time();
    $mail->Subject = $_POST['user'];
    $mail->Body    = 'Congratulation Amit Gautam You Are Success In Email Prectice In PHP'.$_POST['user'];
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}