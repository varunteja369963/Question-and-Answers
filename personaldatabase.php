<html>
<head>
      <script src = "personaldatabase.js" type = "text/javascript"></script>
      <link href = "personaldatabase.css" rel = "stylesheet" type = "text/css"/>
</head>
<body>
<div class = "total_page">
<?php 
    session_start();
    #connecting database
    include_once('connection.php');
    $hashgroupname = $_REQUEST['name'];
    if ($hashgroupname == "") {
header('location: loginform.php');        
    }
$select_quote = $conn->prepare("SELECT `gmail`, `quote`, `points`, `profileaddr` FROM `userslist` WHERE `username` = ?");
$select_quote->bind_param("s", $_SESSION['username']);
$select_quote->execute();
$result_quote = $select_quote->get_result();
if ($result_quote->num_rows != 1) {
header('location: loginform.php');
mysqli_free_result($result_quote);
}
else {
    $row_quote = $result_quote->fetch_assoc();
    $quote = $row_quote['quote']; 
    $total_points = (int)$row_quote['points'];
    $gmail = $row_quote['gmail'];
    $imagesrc = $row_quote['profileaddr'];
mysqli_free_result($result_quote);    
}

if ($quote == NULL) {
    $last_quote = '......';
}
else {
    $last_quote = stripslashes($quote);
}

    $my_db = $_SESSION['database'];
mysqli_select_db($conn, $my_db);

$selectgroupname = $conn->prepare("SELECT `groupname`, `shorthashgroupname`, `createduser` FROM `grouplist` WHERE `hashgroupname` = ?");
    $selectgroupname->bind_param("s", $hashgroupname);
    $selectgroupname->execute();
    $resultgroupname = $selectgroupname->get_result();
    $rowgroupname = $resultgroupname->fetch_assoc();
    $grpname = $rowgroupname['groupname'];
   $groupname = $rowgroupname['shorthashgroupname'];
$createduser = $rowgroupname['createduser'];
mysqli_free_result($resultgroupname);
$groupname1 = $groupname;
$groupname1 .= '1';

if ($_SESSION['username'] !== $createduser) {
    mysqli_select_db($conn, 'membersinwebsite');
    $select_fridb = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
    $select_fridb->bind_param("s", $createduser);
    $select_fridb->execute();
    $result_fridb = $select_fridb->get_result();
    $row_fridb = $result_fridb->fetch_assoc();
    $created_db = $row_fridb['databasename'];
    mysqli_free_result($result_fridb);
 mysqli_select_db($conn, $created_db);
}
else {
    $created_db = $_SESSION['database'];
}

$select1 = $conn->prepare("SELECT `hashusername`, `points`, `createdtime` FROM `$groupname1` WHERE `username` = ?");
$select1->bind_param("s", $createduser);
$select1->execute();
$result1 = $select1->get_result();
$row1 = $result1->fetch_assoc();
$cz0x8h = $row1['hashusername'];
$date = $row1['createdtime'];
$points_in_this_group = $row1['points'];
mysqli_free_result($result1);
$day = date("l d M Y", strtotime($date));
$time = date("h:ia");
echo '<div class = "group_created_time">';
echo 'Group created on '. $day . ' at ' . $time;
echo '</div>';

echo '<div class = "top_page">';

echo '<div class = "user_profile_info">';
echo '<center>';
echo '<div id = "profile_pic" class = "profile_pic">';
if ($imagesrc == NULL) {

}
else { 
echo '<img src = "'.$imagesrc.'" width = "100%" height = "100%" id = "picture">';
}
echo '</div>';
echo '</center>';
echo '</div>';

echo '<div class = "user_info">';

echo '<div class = "group_name_edit">';
echo '<input type = "text" class = "this_groupname" id = "groupname_edit" maxlength = "25" placeholder = "'.$grpname.'"/>';
echo '<div class = "groupname_edit_div">';
echo '<button type = "button" id = "edit_grpname" class = "edit_grpname" 
data-cile50xllsy = "'.$hashgroupname.'">';echo 'alter';echo '</button>';
echo '</div>';
echo '</div>';
echo '<div id = "groupname_ack">';echo '</div>';

echo '<div class = "my_info">';
echo '<div class = "my_name" id = "my_name" data-cz0x8h = "'.$cz0x8h.'">';
echo $_SESSION['username'];
echo '</div>';
echo '<div class = "gmail">';echo $gmail;echo '</div>';
echo '<div id = "quote" class = "quote">';
echo $last_quote;
echo '</div>';

echo '<div class = "points">';
echo '<div class = "points_inner">';
echo '<div class = "points_in_this_group" title = "points earned in this group" style = "display: flex;">';
echo '<span class = "badge">';echo '</span>';
echo '<span class = "points1">';
echo $points_in_this_group;
echo '</span>';
echo '</div>';
echo '<div class = "total_points" title = "Total points you earned" style = "display: flex;">';
echo '<span class = "heart">';echo '</span>';
echo '<span class = "points2">';
echo $total_points;
echo '</span>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class = "users_in_website">';

echo '<div class = "users_list">';
$select_of_participants = "SELECT COUNT(*) AS SUM FROM `$groupname1`";
$result_of_participants = $conn->query($select_of_participants);
$row_of_participants = $result_of_participants->fetch_assoc();
echo '<div class = "no_of_participants">';
echo $row_of_participants['SUM'] . ' participants';
echo '</div>';
mysqli_free_result($result_of_participants);
$select4 = "SELECT `username`, `hashusername`, `gmail` FROM `$groupname1`";
$result4 = $conn->query($select4);
while ($row4 = $result4->fetch_assoc()) {
    $friname = $row4['username'];
    $userax0z = $row4['hashusername'];

    mysqli_select_db($conn, 'membersinwebsite');
    $selecturl = $conn->prepare("SELECT `profileaddr` FROM `userslist` WHERE `username` = ?");
    $selecturl->bind_param("s", $friname);
    $selecturl->execute();
    $resulturl = $selecturl->get_result();
    $rowurl = $resulturl->fetch_assoc();
    $imagesrc = $rowurl['profileaddr'];
    mysqli_free_result($resulturl);
mysqli_select_db($conn, $created_db);

    echo '<div class = "user_info2">';
    echo '<div class = "user_profile_pic">';
    echo '<div class = "inner_profile_pic">';
    if ($imagesrc == NULL) {

    }
    else { 
    echo '<img src = "'.$imagesrc.'" width = "100%" height = "100%" id = "picture">';
    }
    echo '</div>';
    echo '</div>';
    echo '<div class = "friend_info">';
    echo '<div class = "inner_friend_info">';
    echo '<div id = "fri_name" class = "fri_name" data-userax0z = "'.$userax0z.'">';
    echo $friname;
    echo '</div>';
    echo '<div class = "gmail2">';
    echo $row4['gmail'];
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
mysqli_free_result($result4);
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class = "user_response">';
echo '<div class = "personal_data_page">';
echo '<div class = "questions_display">';
$created_db3 = $_SESSION['database'];
mysqli_select_db ($conn, $created_db3);
$select2 = $conn->prepare("SELECT `precisequestion`, `uuid`, `points` FROM `storingquestions` WHERE `groupuuid` = ? ORDER BY id DESC");
$select2->bind_param('s', $hashgroupname);
$select2->execute();
$result2 = $select2->get_result();
echo '<div class = "your_questions">';
echo 'questions asked in this group';
echo '</div>';
echo '<div class = "questions_list">';
while ($row2 = $result2->fetch_assoc()) {
    echo '<div class = "question_info">';
    echo '<div class = "question_points">';
    echo $row2['points'];
    echo '</div>';
    echo '<div class = "asked_questions">';
    echo '<a id = "question_link" href = "displayanswer.php?questionid='.$row2['uuid'].'&groupname='.$hashgroupname.'">';
    echo stripslashes($row2['precisequestion']);
    echo '</a>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';
mysqli_free_result($result2);
echo '</div>';

echo '<div class = "answers_display">';
$select3 = "SELECT `precisequestion`, `uuid` FROM `storinganswers`";
$result3 = $conn->query($select3);
echo '<div class = "your_answers">';
echo 'Your contribution to this group';
echo '</div>';
echo '<div class = "answers_list">';
while ($row3 = $result3->fetch_assoc()) {
    echo '<div class = "answer_info">';
    echo '<div class = "asked_answers">';
    echo '<a id = "answer_link" href = "displayanswer.php?questionid='.$row3['uuid'].'&groupname='.$hashgroupname.'">';
    echo stripslashes($row3['precisequestion']);
    echo '</a>';
    echo '</div>';
    echo '</div>';
}
echo '</div>';
mysqli_free_result($result3);
echo '</div>';
echo '</div>';
$conn->close();
?>
</div>
</body>
</html>