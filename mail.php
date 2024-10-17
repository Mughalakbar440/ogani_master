<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function pre($p){
    echo"<pre>";
    print_r($p);
    echo"</pre>";
    exit;
}
require 'vendor/autoload.php'; 

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

    $otp = $_SESSION['User']['otp']?$_SESSION['User']['otp']:'otp not set';
    $email = $_SESSION['User']['email']?$_SESSION['User']['email']:'email not set';

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'akbarhusain.bhoraniya@qalbit.com';
        $mail->Password = 'ltojsmqvrjnzzoot';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('akbarhusain.bhoraniya@qalbit.com', 'Your Name');
        $mail->addAddress($email);
        $mail->addReplyTo('bhoraniya4429@gmail.com', 'Your Name');

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';

        $mail->Body = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your OTP Code</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            color: #343a40;
        }
        .otp {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            background: #e7f1ff;
            padding: 10px;
            border-radius: 4px;
            display: inline-block;
            margin: 20px 0;
        }
        p {
            color: #6c757d;
            line-height: 1.6;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #868e96;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Ogani Master</h1>
        <p>Dear User,</p>
        <p>Your OTP code is:</p>
        <div class="otp">' . $otp . '</div>
        <p>Please use this code to verify your email address.</p>
        <p>If you did not request this code, please ignore this email.</p>
        <div class="footer">
            <p>Thank you!</p>
            <p>Your Company Name</p>
        </div>
    </div>
</body>
</html>';

        $mail->AltBody = "Your OTP code is $otp. Please use this code to verify your email address.";

        $mail->send();
        if ($mail->send()) {
           header("Location:otp.php");
           exit;
        }
        echo 'OTP has been sent to your email address: ' . htmlspecialchars($email);
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
