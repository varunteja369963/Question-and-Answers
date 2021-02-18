  <?php
session_start();

##########   members in website  #########

include_once('connection.php');

##########   members in website  #########

$hashpassword = $_POST['axiy2wi3'];
$hashmypassword = $_POST['aic2eyz3'];

//START: setting sessions if not logged in and exiting if not valid request
if (isset($_COOKIE['username'])){ 
  if (isset($_SESSION['logged_in'])) {
    }
    else {
      $_SESSION['username'] = $_COOKIE['username'];
      $_SESSION['database'] = $_COOKIE['database'];
      $_SESSION['logged_in'] = true;
    }
  }
  else { 
    echo '1';
  header("location: loginform.html");
  die();
  }
//END: setting sessions if not logged in and exiting if not valid request

//START: checking for valid redirection
if ($hashpassword == "" || $hashmypassword == "") {
  echo '1';
  header("location: loginform.html");
  die();
}
//END: checking for valid redirection

/*START: getting friend id, friend name and friend gmail*/
$got_friend_details = false;
$get_id = "SELECT `id`, `username`, `gmail` FROM `userslist`";
$result_id = $conn->query($get_id);
while($rowid = $result_id->fetch_assoc()) {
  $hash_match = md5(md5($rowid['username']));
   if ($hash_match === $hashpassword) {
    $friid = $rowid['id'];
$friname = $rowid['username'];
$frigmail = $rowid['gmail'];
$got_friend_details = true;
    break;
   }
}
mysqli_free_result($result_id);
if (!$got_friend_details) {
  echo 'Not got friend details';
  die();
}
/*END: getting friend id, friend name and friend gmail*/

/*START: getting MY id, MY name and MY gmail*/
$got_my_details = false;
$get_myid = "SELECT `id`, `username`, `gmail` FROM `userslist`";
$result_myid = $conn->query($get_myid);
while($rowmyid = $result_myid->fetch_assoc()) {
  $hash_mymatch = md5(md5($rowmyid['username']));
   if ($hash_mymatch === $hashmypassword) {
    $myid = $rowmyid['id'];
    $myname = $rowmyid['username'];
    $mygmail = $rowmyid['gmail'];
    $got_my_details = true;
    break;
   }
}
mysqli_free_result($result_myid);
if (!$got_my_details) {
  echo 'Not got my details';
  die();
}
/*END: getting MY id, MY name and MY gmail*/

//START: getting and changing to my database

##########   mydatabase  #########
$mydb = $_SESSION['database'];
mysqli_select_db($conn, $mydb);
##########   mydatabase #########

//END: getting and changing to my database

//START: checking if already recieved the request from the same friend from friendrequestgot
$selectfriend = $conn->prepare("SELECT `requestgotname` FROM `friendrequestgot` WHERE `requestgotname` = ?");
$selectfriend->bind_param("s", $friname);
$selectfriend->execute();
$resultfriend = $selectfriend->get_result();
if ($resultfriend->num_rows > 0) {
 echo '3';
 mysqli_free_result($resultfriend);
 die();
}//END: checking if already recieved the request from the same friend from friendrequestgot

else { //START: if not recieved the request from the same friend then sending the request to the friend

  mysqli_free_result($resultfriend);

  //START: inserting friend details into my database in table friendrequestsent
$insertfriend = $conn->prepare("INSERT INTO `friendrequestsent`
(requestsendedid, requestsendedname, requestsendedgmail) VALUES (?, ?, ?)");
$insertfriend->bind_param("sss", $friid, $friname, $frigmail);
$insertfriend->execute();
$insertfriend->close();
  //END: inserting friend details into my database in table friendrequestsent

##########   members in website  #########

mysqli_select_db($conn, 'membersinwebsite');

##########   members in website  #########

//START: getting the friend database name from members in website
$select_fridb = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
$select_fridb->bind_param("s", $friname);
$select_fridb->execute();
$result_fridb = $select_fridb->get_result();
$row_fridb = $result_fridb->fetch_assoc();
$created_db = $row_fridb['databasename'];
mysqli_free_result($result_fridb);
//END: getting the friend database name from members in website

########## friend database ############

mysqli_select_db($conn, $created_db);

########## friend database ############

//START: inserting my details into friend database in table friend request got
  $insertmine = $conn->prepare("INSERT INTO `friendrequestgot`(requestgotid, requestgotname, requestgotgmail)
   VALUES (?, ?, ?)");
  $insertmine->bind_param("sss", $myid, $myusername, $mygmail);
  $myusername = $_SESSION['username'];
  if ($insertmine->execute()) {
    echo '2';
  }
  else {
    echo $conn->error;// if not inserting getting the error 
  }
  $insertmine->close();
//END: inserting my details into friend database in table friend request got
}
//END: if not recieved the requst from the same friend then sending the request to the friend

$conn->close();
?>

    