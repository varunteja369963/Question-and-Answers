<?php 
class register{  
function enterdata(){
	include_once('connection.php');
	date_default_timezone_set('Asia/Kolkata');
	$bef_username = urldecode($_POST['username']);
	$username = trim($bef_username);
	$gmail = urldecode($_POST['gmail']);
	$password1 = urldecode($_POST['password1']);
	$password2 = urldecode($_POST['password2']);

$valid_ok = false;
if ($username == "" || $password1 == "" || $password2 == "" || $gmail == "") {
	echo '6';
	header('location: registerform.html');
	die();
}
if (!preg_match("/^[a-z,A-Z,0-9 ]+$/", $username)) {
	echo '1';
	die();
}
if(!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
	echo '1';
	die();
}
if (strlen($username) < 4 || strlen($username) > 30) {
	echo '1';
	die();
}
else if (strlen($password1) < 4 || strlen($password1) > 30) {
	echo '1';
	die();
}
else if (strlen($password2) < 4 || strlen($password2) > 30) {
	echo '1';
	die();
}
else if (strlen($gmail) < 6 || $gmail == "") {
	echo '1';
	die();
}
else { 
if (md5($password1) === md5($password2))  {
	$valid_ok = true;
}
	if ($valid_ok){
		$trimming = function($data) use ($conn){
			$details = mysqli_real_escape_string($conn,$data);
			return $details;
		};
		$hashpassword1 = $trimming(hash('sha256', $password1));
		$username1 = $trimming($username);
		$gmail1 = $trimming($gmail);
		$userslist = "CREATE TABLE IF NOT EXISTS `userslist`(
			`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
			`username` VARCHAR(30) NOT NULL,
			`hashusername` VARCHAR(32) NOT NULL,
			`hashpassword` VARCHAR(64) NOT NULL,
			`gmail` VARCHAR(200) NOT NULL,
			`databasename` VARCHAR(15) NOT NULL, 
			`profileaddr` TEXT,
			`points` INT NOT NULL DEFAULT 0,
			`smppoints` INT NOT NULL DEFAULT 0,
			`sipoints` INT NOT NULL DEFAULT 0,
			`ipaddress` VARCHAR(20) NOT NULL, 
			`latitude` FLOAT NOT NULL,
			`longitude` FLOAT NOT NULL,
			`country` VARCHAR(200) NOT NULL,
			`region` VARCHAR(200) NOT NULL,
			`city` VARCHAR(200) NOT NULL,
			`totaladdr` TEXT NOT NULL,
			`quote` TEXT,
			`aboutyourself` TEXT,
			`greateststrength` TEXT,
			`greatestweakness` TEXT,
			`diffsituations` TEXT,
			`seeyourself` TEXT,
			`teamplayer` TEXT,
			`disagreement` TEXT,
			`longandshortgoal` TEXT, 
			`hobbies` TEXT,
			`whenyoustart` TEXT,
			`pointsformydata` INT NOT NULL DEFAULT 0
			)";
			$conn->query($userslist);

			$confirm_user = "CREATE TABLE IF NOT EXISTS `confirmuser`(
				`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				`username` VARCHAR(30) NOT NULL, 
				`hashpassword` VARCHAR(64) NOT NULL, 
				`gmail` VARCHAR(200) NOT NULL, 
				`confirmationcode` INT NOT NULL,
				`sentdate` TIMESTAMP NOT NULL
				)";
				$conn->query($confirm_user);

				$resetpassword = "CREATE TABLE IF NOT EXISTS `resetpassword`(
					`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
					`username` VARCHAR(30) NOT NULL, 
					`gmail` VARCHAR(200) NOT NULL, 
					`confirmationcode` INT NOT NULL,
					`sentdate` TIMESTAMP NOT NULL
					)";
					$conn->query($resetpassword);

		$select = "SELECT `username`, `gmail` FROM `userslist`";
		$result = mysqli_query($conn,$select); 
		if ($result->num_rows > 0) { 
		while ($row = $result->fetch_assoc()) { 
		if($row['username'] === $username1){
			echo '2';
			die();
		}
		else if ($row['gmail'] === $gmail1) {
			echo '3';
			die();
		}
	}
}
mysqli_free_result($result);
$select_confirm = "SELECT `id`, `username`, `gmail`, `sentdate` FROM `confirmuser`";
$result_confirm = mysqli_query($conn,$select_confirm); 
if ($result_confirm->num_rows > 0) { 
while ($row_confirm = $result_confirm->fetch_assoc()) {
	$id = $row_confirm['id'];
	$present_time = strtotime(date("Y/m/d h:i:s"));
	$exceed_time = strtotime($row_confirm['sentdate'])+3600;

	if ($present_time >= $exceed_time) { 
		$delete = "DELETE FROM `confirmuser` WHERE `id` = '$id'";
$conn->query($delete);
	}
else if($row_confirm['username'] === $username1){
	echo '2';
	die();
}
else if ($row_confirm['gmail'] === $gmail1) {
	echo '3';
	die();
}
}
}
mysqli_free_result($result_confirm);

$rand_valid = true;
do {
	$bef_randno = rand(10000000, 99999999);
$select_rand = $conn->prepare("SELECT `confirmationcode` FROM `confirmuser` WHERE `confirmationcode` = ?");
$select_rand->bind_param("s", $bef_randno);
$select_rand->execute();
$result_rand = $select_rand->get_result(); 
if ($result_rand->num_rows === 0) { 
  $randno = $bef_randno;
  $rand_valid = false;
 }
}while($rand_valid);
mysqli_free_result($result_rand);
$dateandtime = date("Y/m/d h:i:s");
$insert = $conn->prepare ("INSERT INTO `confirmuser` (username, hashpassword, gmail, confirmationcode, sentdate) VALUES (?, ?, ?, ?, ?)");
$insert -> bind_param("sssss", $username1, $hashpassword1, $gmail1, $randno, $dateandtime);
if ($insert->execute()){
echo '4';
}
else {
	echo '5';
}
$insert->close();
}
  else {
	echo '1';
  }
}
  $conn->close();
}
}
$registerpage = new register();
$registerpage->enterdata();
?>

