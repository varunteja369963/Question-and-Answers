<?php
include_once('connection.php');
$username = urldecode($_POST['username']);
$key = md5($username);
$gmail = urldecode($_POST['gmail']);
$select = $conn->prepare('SELECT `confirmationcode` FROM `resetpassword` WHERE `username` = ? AND `gmail` = ?');
$select->bind_param("ss", $username, $gmail);
$select->execute();
$result = $select->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $verificationcode = $row['confirmationcode'];
    mysqli_free_result($result);
}
else {
    echo '2';
    echo 'notsent';
    mysqli_free_result($result);
    die();
}
$conn->close();
$to = $gmail;
$subject = "Verification";
$message = "
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
<a href = 'sabiduria.in/resetpassword.html?username=$username&key=$key&verificationcode=$verificationcode'  class = 'sabiduria_button' id = 'sabiduria_button'>Activate my account</a>
</div>
</center>
</body>
</html>
";
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <sabiduria@sabiduria.in>' . "\r\n";
$headers .= 'Cc: sabiduria@sabiduria.in' . "\r\n";

if (mail($to,$subject,$message,$headers)) 
{
    echo '1';
}
else {
    echo '2';
    echo 'error';
}
    ?> 