
   <html>
<body>
    <div id = "displaying_questions">
<?php
session_start();
   include_once('connection1.php');

   //start: fetching groupname
   $hashgroupname = $_POST['groupname'];
   if ($hashgroupname == "") {
       echo '1';
       header("location: loginform.html");
       die();
   } 
   $maxid = $_POST['maxid'];
   if ($maxid === 'nothing') {
    echo '<h1>';
    echo '<center>';
    echo 'No Question posted in this group';
    echo '</center>';
    echo '</h1>';
    die();
   }
   else { 

   $selectgroupname = $conn->prepare("SELECT `shorthashgroupname`, `createduser` FROM `grouplist` WHERE `hashgroupname` = ?");
   $selectgroupname->bind_param("s", $hashgroupname);
   $selectgroupname->execute();
   $resultgroupname = $selectgroupname->get_result();
   $rowgroupname = $resultgroupname->fetch_assoc();

$shorthashgroupname = $rowgroupname['shorthashgroupname'];
$createduser = $rowgroupname['createduser'];
mysqli_free_result($resultgroupname);
//end: fetching groupname
  if ($createduser !== $_SESSION['username']) { 
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
   $shorthashgroupname2 = $shorthashgroupname;
   $shorthashgroupname2 .= '2';
   if ($maxid >= 10) { 
  $minid = $maxid - 9;
   }
   else {
       $minid = 1;
   }

   $select2 = "SELECT `tags`, `specificquestion`, `questionuuid`, `askeduser`, `askedtime`, `points` FROM `$shorthashgroupname2` WHERE id BETWEEN $minid AND $maxid ORDER BY id DESC";
   $result2 = $conn->query($select2);
   if ($result2) { 
    if ($result2->num_rows > 0) { 
   while ($row2 = $result2->fetch_assoc()) {
    $points = $row2['points'];       
       echo '<div class = "total_question">';
       echo '<div class = "left_side">';
       echo '<div class = "inner_points">';
       echo $points;
       echo '</div>';
       echo '</div>';
       echo '<div class = "right_side">';
       $specificquestions = stripslashes($row2['specificquestion']);
       $tags = stripslashes($row2['tags']);
       $questionuuid = $row2['questionuuid'];
       $before_askeduser = $row2['askeduser'];
       if (strlen($before_askeduser) > 10) {
           $askeduser = substr($before_askeduser, 0, 10);
           $askeduser .= '..';
       }
       else {
           $askeduser = $before_askeduser;
       }
       $date = $row2['askedtime'];
       $asked_date = date("d/m/y", strtotime("$date"));
       $asked_time = date("h:i:sa", strtotime("$date"));
    echo '<div id = "specific_question">';
       echo '<a href = "displayanswer.php?questionid=' . $questionuuid .'&groupname=' . $hashgroupname .'">';
       echo $specificquestions;
       echo '</a>';
       echo '</div>';

       $splitedtags = explode(";",$tags);
       $tagslength = count($splitedtags);
       echo '<div id = "outer_tags">';
       for ($x = 0; $x < $tagslength-1; $x++) {
        echo '<div id = "inner_tags">';
           echo $splitedtags[$x];
           echo '</div>';
       }
       echo '</div>';
       
       echo '<div id = "posted_question_details">';
      echo '<div id = "asked_time">';
      echo '<span class = "posted_on">';
      echo 'posted on:'; 
      echo '</span>';
      echo "<span class = 'date_when_asked' style='color:red;'>".$asked_date."</span>";
      echo "<span class = 'asked_time' style='color:blue;'>". ' (' . $asked_time. ')' . "</span>";      
      echo '</div>';
      
      echo '<div id = "border">';
      echo '<div id = "asked_user">';
      echo $askeduser;
      echo '</div>';
      echo '</div>';
      echo '</div>';
      
       echo '<div id = "line">';
       echo '</div>';
       echo '</div>';
echo '</div>';
  }
  mysqli_free_result($result2);
   }

   }
else {
    echo '<h1>';
    echo '<center>';
    echo 'No Question posted in this group';
    echo '</center>';
    echo '</h1>';
}  
}
   $conn->close();
   ?>
   </div>
   </body>
</html>
   