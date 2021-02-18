<?php
  session_start();
  if (!isset($_SESSION['logged_in'])) {
      header('location: loginform.html');
       die();
     }
     include_once('connection1.php');
echo '<div class = "friend_request">';
       $count = 0;
       $selectmember = "SELECT `requestgotname`, `requestgotgmail` FROM `friendrequestgot`";
       $resultmember = $conn->query($selectmember);
       if (mysqli_num_rows($resultmember) > 0) {
           while ($row = $resultmember->fetch_assoc()) {
               $count++;
               $rusername = $row['requestgotname'];
               $rgmail = $row['requestgotgmail'];
               $hashusername = md5(md5($rusername));
               $myusername = md5(md5($_SESSION['username']));
               $appcount = 'aicyzlai3laivy391kj73kvka9i143llkdfa';
               $appcount .= $count;
               $appcount1 = $appcount;
               $appcount1 .= 'aic';
            echo '<div class = "userprofile_outer">';
            echo '<div class = "userprofile">';
            echo '<div class = "profile_pic">';
            echo '</div>';
            echo '<div class = "user_info">';
            echo '<div class = "username">';
            echo '<a class = "ai2kla8_kdiocy" href = "aboutme.php?q='.md5($rusername).'">';
            echo $rusername;
            echo '</a>';
            echo '</div>';
            echo '<div class = "gmail">';
            echo $rgmail;
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<div class = "button_div">';
            echo '<input type = "button" id = "acceptrequest" data-axiy2wi3 = "'.$hashusername.'" 
            data-aic2eyz3 = "'.$myusername.'" value = "Accept Request"
             class = "acceptrequest_button"/>';

            echo '<input type = "button" id = "cancelrequest" data-axiy2wi3 = "'.$hashusername.'" 
            data-aic2eyz3 = "'.$myusername.'" value = "Cancel Request"
             class = "cancelrequest_button"/>';
            echo '</div>';
            echo '</div>';
           }          
       }
       mysqli_free_result($resultmember);
       echo '</div>';
       $conn->close();
    ?>