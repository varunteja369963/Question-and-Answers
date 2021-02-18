<html>
<body>
    <div id = "displaying_questions">
<?php
session_start();
include_once('connection5.php');
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
   if ($maxid >= 10) { 
    $minid = $maxid - 9;
     }
     else {
         $minid = 1;
     }

   $select2 = "SELECT `uuid`, `tags`, `precisequestion`, `askeduser`, `dateandtime`, `points` FROM `shareideaquestions` WHERE id BETWEEN $minid AND $maxid ORDER BY id DESC";
   if ($result2 = $conn->query($select2)) { 
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
       $uuid = $row2['uuid'];
       $specificquestions = stripslashes($row2['precisequestion']);
       $tags = stripslashes($row2['tags']);
       $before_askeduser = $row2['askeduser'];
       if (strlen($before_askeduser) > 10) {
        $askeduser = substr($before_askeduser, 0, 10);
        $askeduser .= '..';
    }
    else {
        $askeduser = $before_askeduser;
    }
       $date = $row2['dateandtime'];
       $asked_date = date("d/m/y", strtotime("$date"));
       $asked_time = date("h:i:sa", strtotime("$date"));
    echo '<div id = "specific_question">';
       echo '<a href = "shareidearesult.php?uuid=' . $uuid . '">';
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
       
       echo '<div id = "posted_question_details"';
      echo '<span id = "asked_time">';
      echo '<span class = "posted_on">';      
      echo 'posted on:'; 
      echo '</span>';
      echo "<span class = 'date_when_asked' style='color:red;'>".$asked_date."</span>";
      echo "<span class = 'asked_time' style='color:blue;'>". ' (' . $asked_time. ')' . "</span>";      
      echo '</span>';
      
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
else {
    echo '<h1>';
    echo '<center>';
    echo 'Be the first one to post the question';
    echo '</center>';
    echo '</h1>';
} 
   }
else {
    echo '<h1>';
    echo '<center>';
    echo 'Be the first one to post the question';
    echo '</center>';
    echo '</h1>';
} 
   } 
   $conn->close();
   ?>
   </div>
   </body>
</html>
   
