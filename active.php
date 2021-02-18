<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSendmail();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'sabiduria@sabiduria.in';                 // SMTP username
    $mail->Password = 'Nancy3690#';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('sabiduria@sabiduria.in', 'sabiduria');
    $mail->addAddress($gmail, $username);     // Add a recipient            
    $mail->addReplyTo('sabiduria@sabiduria.in', 'reply');
    $mail->addCC('sabiduria@sabiduria.in');
  
  
  //Headers
  $mail->addCustomHeader('MIME-Version: 1.0');
$mail->addCustomHeader('Content-Type: text/html; charset=ISO-8859-1'); 

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'New Quote From'".$mobile-number.";
    $mail->Body    = "
<html>
<head>
<title>Email Confirmation</title>
<style>
.border {
border: 1px solid #0084b4;
width: 400px;
height: 400px;
}

.s {
    font-size: 45px;
    color: #fff; 
    padding-left: 10px;
    padding-right: 10px;
    font-weight: 600;
    background-color: #0084b4;
}

.abiduria {
    font-size: 42px;
    color: #0084b4;
}

.symbol {
margin-top: 40px;
}

.paragraph1 {
    color: #E95420;
    font-size: 20;
    margin-top: 30px;
    margin-right: 10px;
    margin-left: 10px;
    text-align: left;
}

.paragraph3 {
  margin-bottom: 50px;
}

.sabiduria_button {
  width: 200px;
  border: none;
  background-color: #E95420;
  height: 80px;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
  padding: 15px 20px;
  text-decoration: none;
}

.li a[href] {
    color: #fff;
    }
</style>
</head>
<boby>
<center>
<div class = 'border'>
<div class = 'symbol'>
<span class = 's'>S</span>
<span class = 'abiduria'>abiduria</span>
</div>
<p class = 'paragraph1'>HELLO $username! Welcome to sabiduria. A site where you can enhance your wisdom (sabiduria).</p>
<p class = 'paragraph2'>Please click the button to activate your account</p>
<p class = 'paragraph3'> Thank you???</p>
<a href = 'https://sabiduria.in/index.php/emailconfirm.php?username=$username&key=$key&verificationcode=$verificationcode'  class = 'sabiduria_button' id = 'sabiduria_button'>Activate my account</a>
</div>
</center>
</body>
</html>
";

    $mail->send();
    echo '1';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>