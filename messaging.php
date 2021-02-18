<html>
<head>
</head>
<body>
    <div class = "outer_total_page" id = "outer_total_page">
<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("location: loginform.html");
    die();
}
if ($_SESSION['logged_in'] != true) {
  header("location: loginform.html");
  die();
}
date_default_timezone_set('Asia/Kolkata');
include_once('connection1.php');
$db = $_SESSION['database'];
$select_friends = "SELECT `friendid`, `friendname` From `friendslist` ORDER BY id DESC";
$result_friends = $conn->query("$select_friends");
while($row_friends = $result_friends->fetch_assoc()) {
$accept = false;    
    $friend_id_for_message = $row_friends['friendid'];
    $friend_name_for_message = $row_friends['friendname'];
    $select_unseen = "SELECT COUNT(*) AS count FROM `$friend_name_for_message` WHERE `sent` = 0";
    if ($result_unseen = $conn->query($select_unseen)) { 
    if ($row_unseen = $result_unseen->fetch_assoc()) { 
    $unseen = $row_unseen['count'];
    if ($unseen != 0) {
        $accept = true;
    }
    }
    else {
    }
    mysqli_free_result($result_unseen); 
}
else {
    $friend_name_for_message2 = trim($friend_name_for_message);
    $delete_this_row = $conn->prepare("DELETE FROM `friendslist` WHERE `friendname` = ?");
    $delete_this_row->bind_param("s", $friend_name_for_message);
    $delete_this_row->execute();
    $delete_this_row->close();

    mysqli_select_db($conn, 'membersinwebsite');

    $select_fridb = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
    $select_fridb->bind_param("s", $friend_name_for_message2);
    $select_fridb->execute();
    $result_fridb = $select_fridb->get_result();
    $row_fridb = $result_fridb->fetch_assoc();
    $created_db = $row_fridb['databasename'];
    mysqli_free_result($result_fridb);

 mysqli_select_db($conn, $created_db);

$myusername = $_SESSION['username'];
    $delete_this_row2 = $conn->prepare("DELETE FROM `friendslist` WHERE `friendname` = ?");
    $delete_this_row2->bind_param("s", $myusername);
    $delete_this_row2->execute();
    $delete_this_row2->close();
   
    $drop_table = "DROP TABLE `$myusername`";
    $conn->query($drop_table);
    header("Refresh:0");
    die();
}
    mysqli_select_db($conn, 'membersinwebsite');
    $select_fridb = $conn->prepare("SELECT `databasename`, `profileaddr` FROM `userslist` WHERE `username` = ?");
    $select_fridb->bind_param("s", $friend_name_for_message);
    $select_fridb->execute();
    $result_fridb = $select_fridb->get_result();
    $row_fridb = $result_fridb->fetch_assoc();
    $created_db = $row_fridb['databasename'];
          $imagesrc = $row_fridb['profileaddr'];
    mysqli_free_result($result_fridb);

 mysqli_select_db($conn, $created_db);
 
    $select_last_seen = "SELECT `friendonline` FROM `userstatus` WHERE `id` = 0";
    $result_last_seen = $conn->query($select_last_seen);
    $row_last_seen = $result_last_seen->fetch_assoc();
    $last_seen_time = date("d M h:i A", strtotime($row_last_seen['friendonline']));
    mysqli_free_result($result_last_seen);
    mysqli_select_db($conn, $db);
    $select2 = "SELECT `chat`, `sendedtime` FROM `$friend_name_for_message` WHERE `id`=(SELECT max(id) FROM `$friend_name_for_message`)";
    if ($result2 = $conn->query($select2)) { 
        $row2 = $result2->fetch_assoc();
        if ($result2->num_rows > 0) { 
        $last_message = $row2['chat'];
        $last_message_sended_time = date("h:i a", strtotime($row2['sendedtime']));
    }
    else {
     $last_message = "";
     $last_message_sended_time = "";
 }
mysqli_free_result($result2);
}
else {
    $last_message = "";
    $last_message_sended_time = "";
}
 echo '<div id = "total_page" class = "total_page">';
        echo '<div id = "profile_pic" class = "profile_pic">';
        echo '<center>';
        /*
           if ($imagesrc == NULL) {

            }
            else { 
            echo '<img src = "'.$imagesrc.'" width = "80px" height = "80px" style = "border-radius: 50%; margin-top: 7px;" id = "picture">';
            }*/
            echo '</center>';
 echo '</div>';
        echo '<div id = "friend_to_message" class = "friend_to_message">';
        $friend_name_for_messages = preg_replace('/\s+/', '_', $friend_name_for_message);
        echo '<button type = "button" id = "'.$friend_id_for_message.'" name = "'.$friend_name_for_messages.'" data-fname = "'.$friend_name_for_messages.'"
        class = "button_details">';
        echo '<div class = "frienddetails">';
        echo '<div class = "nameandunseen">';
        echo '<div class = "friendname">';
        echo '<b>';
        echo '<i>';
         echo $friend_name_for_message;
         echo '</i>';
         echo '</b>';
         echo '</div>';
         if ($accept) { 
         echo '<div class = "unseen">';
         echo $unseen;
         echo '</div>';
         }
         echo '</div>';
         echo '<div class = "last_message_div">';
         echo '<div class = "last_message">';
         echo html_entity_decode($last_message);
         echo '</div>';
         echo '<div class = "last_message_sended_time">';
         echo $last_message_sended_time;
         echo '</div>';
         echo '</div>';
         echo '<div class = "last_seen_time">';
         echo 'last seen on: ';
         echo $last_seen_time;
         echo '</div>';
         echo '</div>';
         echo '</button>';
     echo '</div>';
     echo '</div>';
}
mysqli_free_result($result_friends);
$conn->close();
?>
</div>
</body>
</html>
