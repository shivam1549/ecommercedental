<?php
use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'vendor/phpmailer/phpmailer/src/Exception.php';
  require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
  require 'vendor/phpmailer/phpmailer/src/SMTP.php';
  require 'vendor/autoload.php';

class MailController{
      public function mailsend($content, $email, $subject){
        $mail = new PHPMailer(true); 
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->From = "bh147ty@gmail.com";
        $mail->FromName = "Dento";
        $mail->setFrom('bh147ty@gmail.com','Admin');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = "Dento $subject";
        $mail->Body = $content;
        $mail->addcc("pormetheus77@gmail.com");
        $mail->send();
      }
  }
?>