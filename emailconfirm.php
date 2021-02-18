<?php
    session_start(); 
    include_once('connection.php'); 
    date_default_timezone_set('Asia/Kolkata');   
   
    $username_in_link = rawurldecode($_REQUEST['username']);
    $key = $_REQUEST['key'];
    $confirmcode = $_REQUEST['verificationcode'];
    if ($username_in_link == "" || $key == "" || $confirmcode == "") {  
      header('location: errorpage.html');
    die();            
        }
        if ($key !== md5($username_in_link)) {
            header('location: errorpage.html');
            die();
        }
        $select_confirm = "SELECT `id`, `sentdate` FROM `confirmuser`";
$result_confirm = mysqli_query($conn,$select_confirm); 
if ($result_confirm->num_rows > 0) { 
while ($row_confirm = $result_confirm->fetch_assoc()) { 
    $id = $row_confirm['id'];
    $present_time = strtotime(date("Y/m/d h:i:s"));
    $exceed_time = strtotime($row_confirm['sentdate'])+3600;
	if ($present_time >= $exceed_time) {
		$delete = "DELETE FROM `confirmuser` WHERE id = '$id'";
$conn->query($delete);
	}
}
  }
mysqli_free_result($result_confirm);

$total_addr = ""; 
$ipaddress = ""; 
$ipaddress .= getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');

$query = @unserialize (file_get_contents('http://ip-api.com/php/'));
if ($query && $query['status'] == 'success') {
$country = $query['country'];
$region = $query['region'];
$city = $query['city'];
$latitude = $query['lat'];
$longitude = $query['lon']; 
}
else {
$country = "";
$region = "";
$city = "";
$latitude = "";
$longitude = ""; 
}
foreach ($query as $data) {
$total_addr .= $data;
}

  $select_user = $conn->prepare("SELECT `username`, `hashpassword`, `gmail` FROM `confirmuser` WHERE `username` = ? AND `confirmationcode` = ?");
  $select_user->bind_param("ss", $username_in_link, $confirmcode);
  $select_user->execute();
  $result_user = $select_user->get_result();
if ($result_user->num_rows > 0) {
    $row_user = $result_user->fetch_assoc();
        $username1 = mysqli_real_escape_string($conn, $row_user['username']);
        $hashpassword1 = mysqli_real_escape_string($conn, $row_user['hashpassword']);
        $gmail1 = mysqli_real_escape_string($conn, $row_user['gmail']);
        $hashusername = md5($row_user['username']);

        $delete_row = $conn->prepare("DELETE FROM `confirmuser` WHERE `username` = ? AND `confirmationcode` = ?");
        $delete_row->bind_param("ss", $username_in_link, $confirmcode);
        $delete_row->execute();
        mysqli_free_result($result_user);

        mysqli_select_db($conn, 'searchanderror');
        $dbvalid = false;
        $select_max = "SELECT MAX(id) AS maximum FROM `userdatabase`";
        $result_max = $conn->query($select_max);
        $row_max = $result_max->fetch_assoc();
        $insertid = $row_max['maximum'];
        if ($insertid > 0) {
            $select = "SELECT `databasename` FROM `userdatabase` WHERE `id` = $insertid";
            $result = $conn->query($select);
            $row = $result->fetch_assoc();
            $dataname = $row['databasename'];
            $substring = substr($dataname, 9);
            $num = (int)$substring;
            if ($num > 1000) {
              header('location: errorpage.html');
              die();
            }
            else {
                $i = 0;
                do {  
                $num = $num + 1;
                $bef_databasename = 'sabiduria';
                $bef_databasename .= $num;
                $select_dbname = $conn->prepare("SELECT `databasename` FROM `userdatabase` WHERE `databasename` = ?");
                $select_dbname->bind_param("s", $bef_databasename);
                $select_dbname->execute();
                $result_dbname = $select_dbname->get_result();
                if ($result_dbname->num_rows > 0) {
                  $dbvalid = false;
                }
                else {
                    $select_db = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$bef_databasename'";
                    $result_db = $conn->query($select_db);
                    if ($result_db->num_rows > 0) { 
                    $dbvalid = true;
                    break;
                    }
                }
            }while($i <= 50);
            }
        }
        else {
            $dbvalid = true;
            $bef_databasename = 'sabiduria1';
        }

        if ($dbvalid) {
            $databasename = $bef_databasename;
            $hashusername = md5($username1);
           $insert_check = $conn->prepare("INSERT INTO `userdatabase` (username, hashusername, databasename) VALUES (?, ?, ?)");
           $insert_check->bind_param("sss", $username1, $hashusername, $databasename);
$insert_check->execute();
$insert_check->close();
$_SESSION['database'] = $databasename;
        }
        else {
            header('location: errorpage.html');
            die();
        }
        mysqli_select_db($conn, 'membersinwebsite');

        $insert = $conn->prepare ("INSERT INTO `userslist` (username, hashusername, hashpassword, gmail, databasename, ipaddress, latitude, longitude, country, region, city, totaladdr) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$insert -> bind_param("ssssssssssss", $username1, $hashusername, $hashpassword1, $gmail1, $_SESSION['database'], $ipaddress, $latitude, $longitude, $country, $region, $city, $total_addr);
 $insert->execute();
 $insert->close();
        $_SESSION['username'] = $username1;
        $_SESSION['logged_in'] = true;

        $dbname = $_SESSION['database'];
        mysqli_select_db($conn, $dbname);

           $creategrouplist = "CREATE TABLE IF NOT EXISTS `grouplist`(
            `sno` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `groupname` VARCHAR(63) NOT NULL,
            `shorthashgroupname` VARCHAR(38) NOT NULL,
            `hashgroupname` VARCHAR(70) NOT NULL,
            `createduser` VARCHAR(30) NOT NULL,
            `addeduser` VARCHAR(30) NOT NULL
          )";
          $conn->query($creategrouplist);

           $friendrequestsentlist = "CREATE TABLE IF NOT EXISTS `friendrequestsent`(
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `requestsendedid` INT NOT NULL,
            `requestsendedname` VARCHAR(30) NOT NULL,
            `requestsendedgmail` VARCHAR(200) NOT NULL
        )";
      $conn->query($friendrequestsentlist);
      
      $friendrequestgotlist = "CREATE TABLE IF NOT EXISTS `friendrequestgot`(
        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `requestgotid` INT NOT NULL,
        `requestgotname` VARCHAR(30) NOT NULL,
        `requestgotgmail` VARCHAR(200) NOT NULL
        )";
        $conn->query($friendrequestgotlist);
    
        $friendslist = "CREATE TABLE IF NOT EXISTS `friendslist`(
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `friendid` INT NOT NULL,
        `friendname` VARCHAR(30) NOT NULL,
        `friendgmail` VARCHAR(200) NOT NULL
            )";
            $conn->query($friendslist);
            
            $useractivity = "CREATE TABLE IF NOT EXISTS `userstatus`(
                `id` TINYINT UNSIGNED NOT NULL PRIMARY KEY,
        `friendonline` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP 
                )";
                if(!$conn->query($useractivity)) {
                    echo $conn->error;
                }
    $dbLastActivity = date("Y/m/d h:i:s");
                
                $insertuseractivity = "INSERT INTO `userstatus`(friendonline) VALUES ('$dbLastActivity')";
                $conn->query($insertuseractivity);
    
                $createstoringquestions = "CREATE TABLE IF NOT EXISTS `storingquestions`(
                    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    `precisequestion` VARCHAR(250) NOT NULL,
                    `uuid` VARCHAR(38) NOT NULL, 
                    `groupuuid` VARCHAR(70) NOT NULL,
                    `points` INT NOT NULL DEFAULT 0,
                    `place` INT UNSIGNED NOT NULL
                    )";
                    $conn->query($createstoringquestions);
    
                $createstoringanswers = "CREATE TABLE IF NOT EXISTS `storinganswers`(
                    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    `precisequestion` VARCHAR(250) NOT NULL,				
                    `uuid` VARCHAR(38) NOT NULL, 
                    `groupuuid` VARCHAR(70) NOT NULL
                )";
                    $conn->query($createstoringanswers);
    
                    $createsmpquestions = "CREATE TABLE IF NOT EXISTS `smpquestions`(
                        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        `precisequestion` VARCHAR(250) NOT NULL,
                        `uuid` VARCHAR(38) NOT NULL, 
                        `points` INT NOT NULL DEFAULT 0
                        )";
                        $conn->query($createsmpquestions);
        
                    $createsmpanswers = "CREATE TABLE IF NOT EXISTS `smpanswers`(
                        `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        `precisequestion` VARCHAR(250) NOT NULL,				
                        `uuid` VARCHAR(38) NOT NULL
                        )";
                        $conn->query($createsmpanswers);
    
                        $createsiquestions = "CREATE TABLE IF NOT EXISTS `siquestions`(
                            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            `precisequestion` VARCHAR(250) NOT NULL,
                            `uuid` VARCHAR(38) NOT NULL, 
                            `points` INT NOT NULL DEFAULT 0
                            )";
                            $conn->query($createsiquestions);
            
                        $createsianswers = "CREATE TABLE IF NOT EXISTS `sianswers`(
                            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            `precisequestion` VARCHAR(250) NOT NULL,				
                            `uuid` VARCHAR(38) NOT NULL
                            )";
                            $conn->query($createsianswers);
                setcookie("username", $_SESSION['username'], time() + (86400 * 30), "/");
                setcookie("database", $_SESSION['database'], time() + (86400 * 30), "/");
   header('location: homepage.html');
}
else {
    header('location: errorpage.html');
}
$conn->close();
?>