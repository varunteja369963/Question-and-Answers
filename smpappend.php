<html>
<body>
<?php
session_start();
include_once('connection4.php');
$uuid = $_POST['questionuuid'];
$minid = $_POST['val1'];
$maxid = $_POST['val2'];
if ($uuid == "" || $minid == "" || $maxid == "") {
  header('location: loginform.html');
  die();
} 
$selectanswers = "SELECT `answers`, `answeruuid`, `dateandtime`, `answereduser`, `points` FROM `$uuid` WHERE id BETWEEN $minid AND $maxid ORDER BY id DESC";
      if ($resultanswers = $conn->query($selectanswers)) {
          while ($rowanswers = $resultanswers->fetch_assoc()) {
              $answers = stripslashes($rowanswers['answers']);
           $identity = $rowanswers['answeruuid'];              
              $date = $rowanswers['dateandtime'];
              $asked_date = date("d/m/y", strtotime("$date"));
              $asked_time = date("h:i:sa", strtotime("$date"));
              $answer_points = $rowanswers['points'];
              $askeduser = $rowanswers['answereduser'];
              echo '<div id = "answer_firstpointsanddata">';
              echo '<div id = "answer_pointsanddata">';
              echo '<div id = "answer_total_points" class = "answer_total_points">'; 
              echo '<div id = "answer_plus_points">';
              echo '<button type = "button" title = "This answer is useful" id = "answer_add_one_point" data-iden12zsall9zla20 = "'.$identity.'">';
              echo '+';
              echo'</button>';
              echo '</div>';
              echo '<div id = "answer_got_points" class = "'.$identity.'">';
              echo $answer_points;
              echo '</div>';
              echo '<div id = "answer_minus_points">';
              echo '<button type = "button" title = "This answer is unuseful" id = "answer_minus_one_point" data-iden12zsall9zla20 = "'.$identity.'">';
              echo '-';
              echo'</button>';
              echo '</div>';
              if (isset($_SESSION['username'])) { 
              if ($_SESSION['username'] === $askeduser) {
                echo '<div id = "edit_div">';
                echo '<button type = "button" id = "edit_answer" data-iazs23kicldei92a = "'.$identity.'">';
                echo 'edit';
                echo '</button>';
                echo '</div>';
                }     
              }
              echo '</div>';
              echo '<div id = "answer_data" class = "answer_data">';
              echo '<div id = "answers" class = "answers">';
              echo '<div id = "answer_without_frame" class = "'.$identity.'">';
              echo html_entity_decode($answers);
              echo '</div>';
              echo '</div>';
                echo '<div id = "answer_posted_question_details">';
                echo '<span id = "asked_time">';
                echo '<span id = "posted_on">';
                echo 'posted on:'; 
                echo '</span>';
                echo "<span style='color:red;'>".$asked_date."</span>";
                echo "<span class = 'time' style='color:blue;'>". ' (' . $asked_time. ')' . "</span>";      
                echo '</span>';
                
                echo '<span id = "border">';
                echo '<div id = "asked_user">';
                echo '<a class = "ax03ha34" href = "aboutme.php?q=' .md5($askeduser).'">';
                echo $askeduser;
                echo '</a>';
                echo '</div>';
                echo '</span>';
                echo '</div>';
            
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div id = "line">';
                echo '</div>';
          }
      }
      
      mysqli_free_result($resultanswers);
      ?>
    </body>
</html>