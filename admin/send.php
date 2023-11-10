<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["update"])){
    
    $mail = new PHPMailer(true);
    
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'xskywalker989@gmail.com';
    $mail->Password = 'ilzc vala hcww funf';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    
    $mail->setFrom('xskywalker989@gmail.com');
    
    $mail->addAddress($_POST['email']);
    
    $mail->Subject = $_POST["subject"];
    $mail->Body = $_POST["message"];
    
    $mail->send();
    
    echo
    "
    <script>
    alert('Sent Successfully');
    document.location.href = 'messages.php';
    </script>
    ";
    
}

?>