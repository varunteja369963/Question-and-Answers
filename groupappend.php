<html>
<body>
<?php
session_start();
include_once('connection1.php');
$questionuuid = $_POST['questionuuid'];
$minid = $_POST['val1'];
$maxid = $_POST['val2'];
if ($questionuuid == "" || $minid == "" || $maxid == "") {
    header('location: loginform.html');
    die();
  } 

  $hashgroupname = $_POST['hashgroupname'];
  $select_user = $conn->prepare("SELECT `createduser` FROM `grouplist` WHERE `hashgroupname` = ?");
  $select_user->bind_param("s", $hashgroupname);
  $select_user->execute();
  $result_user = $select_user->get_result();
  $row_user = $result_user->fetch_assoc();
  $createduser = $row_user['createduser'];

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

   $selectanswers = "SELECT `answer`, `answeruuid`, `answereduser`, `dateandtime`, `points` FROM `$questionuuid` WHERE id BETWEEN $minid AND $maxid ORDER BY id DESC";
   if ($resultanswers = $conn->query($selectanswers)) {
       while ($rowanswers = $resultanswers->fetch_assoc()) {
           $answers = stripslashes($rowanswers['answer']);
           $identity = $rowanswers['answeruuid'];
           $date = $rowanswers['dateandtime'];
           $answerpoints = $rowanswers['points'];
           $answereduser = $rowanswers['answereduser'];
           $asked_date = date("d/m/y", strtotime("$date"));
           $asked_time = date("h:i:sa", strtotime("$date"));
           echo '<div id = "answer_firstpointsanddata">';
           echo '<div id = "answer_pointsanddata">';
           echo '<div id = "answer_total_points"  class = "answer_total_points">';      
           echo '<div id = "answer_plus_points">';
           echo '<button type = "button" title = "This answer is useful" id = "answer_add_one_point" data-iden12zsall9zla20 = "'.$identity.'">';
           echo '+';
           echo'</button>';
           echo '</div>';
           echo '<div id = "answer_got_points" class = "'.$identity.'">';
           echo $answerpoints;
           echo '</div>';
           echo '<div id = "answer_minus_points">';
           echo '<button type = "button" title = "This answer is unuseful" id = "answer_minus_one_point" data-iden12zsall9zla20 = "'.$identity.'">';
           echo '-';
           echo'</button>';
           echo '</div>';
           if (isset($_SESSION['username'])) { 
           if ($_SESSION['username'] === $answereduser) {
            echo '<div id = "edit_div">';
            echo '<button type = "button" id = "edit_answer" data-iazs23kicldei92a = "'.$identity.'">';
            echo 'edit';
            echo '</button>';
            echo '</div>';
            }
          }
          else {
            header("location: loginform.html");
          }
           echo '</div>';
      echo '<div id = "answer_data" class = "answer_data">';

      if (isset($_SESSION['username'])) { 
        if ($_SESSION['username'] === $answereduser) { 
    echo '<div class = "outer_delete_answer_div">';
    echo '<button type = "button" class = "delete_answer_button" id = "delete_answer_button" data-i2oxl3kcue93lci39 = "'.$identity.'">';
    echo '<div class = "delete_answer" id = "delete_answer"></div>';
    echo '</button>';
    echo '</div>';
        }
    }
    else {
      header("location: loginform.html");
    }

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
        echo '<a class = "ax03ha34" href = "aboutme.php?q=' .md5($answereduser).'">';
        echo $answereduser;
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
    mysqli_free_result($resultanswers);    
       
    }
      ?>
    </body>
</html>