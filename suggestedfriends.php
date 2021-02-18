<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('location: loginform.html');
     die();
   }
   include_once('connection1.php');
   $select_id = "SELECT `friendid` FROM `friendslist`";
   $result_id = $conn->query($select_id);
   $friends_list = array();
   $i = 0;
   if ($result_id->num_rows > 0) { 
   while ($row_id = $result_id->fetch_assoc()) {
     $friends_list[$i] = $row_id['friendid'];
     $i++;
   }
}
else {
    $friends_list[0] = 0;
}
   mysqli_free_result($result_id);

   mysqli_select_db($conn, 'membersinwebsite');
   $select = "SELECT COUNT(*) AS count FROM `userslist`";
 $result = $conn->query($select);
 $row = $result->fetch_assoc();
 $total = $row['count'];
 mysqli_free_result($result);
 $shuffled_nos = range(1, $total);
 shuffle($shuffled_nos);
 $shuffled = array();
   echo '<div class = "total_user_profile_info">';   
   function repeat() {  
       global $total;
       global $shuffled_nos;  
       $start = $_POST['start'];
       $end = $_POST['end'];
       global $friends_list;
       global $conn;
      
   $j = 0;
   $count = 0;       
    if ($total <= 0) {
        /*
        foreach($shuffled_nos as $nos) {
            $shuffled[$j] = $nos;
            $j++;
        }*/
        return false;

    }
    else {
        $shuffled = array_slice($shuffled_nos, $start, 10, true);
    }
   foreach ($shuffled as $rid) {
    $count++;
       if($friends_list[0] !== 0) { 
       foreach($friends_list as $friendid) {
           if ($friendid == $rid) {
               continue;
           }
       }
    }
      $select2 = $conn->prepare("SELECT `username`, `gmail`, `profileaddr` FROM `userslist` WHERE `id` = ?");
      $select2->bind_param("s", $rid);
      $select2->execute();
      $result2 = $select2->get_result();
      if ($result2->num_rows <= 0) {
          continue;
      }
      $row2 = $result2->fetch_assoc();
      $rusername = $row2['username'];
      $rgmail = $row2['gmail'];
      $imagesrc = $row2['profileaddr'];
      mysqli_free_result($result2);
      echo '<div class = "userprofile_outer">';
      echo '<div class = "userprofile">';
      echo '<div class = "profile_pic">';
      if ($imagesrc == NULL) {

    }
    else { 
    echo '<img src = "'.$imagesrc.'" width = "100%" height = "100%" id = "picture">';
    }
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
      $database = $_SESSION['database'];
      mysqli_select_db($conn, $database);

      if ($rusername == $_SESSION['username']) {
          $number = '5';
      }
      else {
      $selectmember1 = "SELECT `requestsendedid` FROM `friendrequestsent` WHERE `requestsendedid` ='".$rid."'";
      $resultmember1 = $conn->query($selectmember1);
      if (mysqli_num_rows($resultmember1) > 0) {
          $number = '2';
          mysqli_free_result($resultmember1);
      }
      else {
      $selectmember2 = "SELECT `requestgotid` FROM `friendrequestgot` WHERE `requestgotid` = '$rid'";
      $resultmember2 = $conn->query($selectmember2);
      if (mysqli_num_rows($resultmember2) > 0) {
          $number = '3';           
      }
      else {
          $selectmember3 = "SELECT `friendid` FROM `friendslist` WHERE `friendid` = '$rid'";
          $resultmember3 = $conn->query($selectmember3);
          if ($resultmember3) { 
          if (mysqli_num_rows($resultmember3) > 0) {
              $number = '4';               
          }
          else {
              $number = '1';
          }
      } 
      else {
          $number = '1';
      }
      mysqli_free_result($resultmember2); 
      mysqli_free_result($resultmember3); 
      }
  }
}

     $hashusername = md5(md5($rusername));
     $myusername = md5(md5($_SESSION['username']));
     $appcount = 'aicyzlai3laivy391kj73kvka9i143llkdfa';
     $appcount .= $count;
     $appcount1 = $appcount;
     $appcount1 .= 'aic';
      if ($number == '1'){
          echo '<input type = "button" id = "addfriend" data-axiy2wi3 = "'.$hashusername.'"
          data-aic2eyz3 = "'.$myusername.'" data-si2x0ezp = "'.$appcount.'" value = "Add Friend"
          class = "addfriend_sf"/>';
          
      }
      else if ($number == '2'){
          echo '<input type = "button" id = "cancelsentrequest" data-axiy2wi3 = "'.$hashusername.'"
          data-aic2eyz3 = "'.$myusername.'" data-si2x0ezp = "'.$appcount.'" value = "Cancel Sent Request"
           class = "cancelsentrequest_sf"/>';
      }
      else if ($number == '3'){
          echo '<input type = "button" id = "acceptrequest" data-axiy2wi3 = "'.$hashusername.'" 
          data-aic2eyz3 = "'.$myusername.'" data-si2x0ezp = "'.$appcount1.'" value = "Accept Request"
           class = "acceptrequest_sf"/>';

          echo '<input type = "button" id = "cancelrequest" data-axiy2wi3 = "'.$hashusername.'" 
          data-aic2eyz3 = "'.$myusername.'" data-si2x0ezp = "'.$appcount.'" value = "Cancel Request"
           class = "cancelrequest_sf"/>';
      }
      else if ($number == '4') {
          echo '<input type = "button"  id = "unfriend" data-axiy2wi3 = "'.$hashusername.'" 
          data-aic2eyz3 = "'.$myusername.'" data-si2x0ezp = "'.$appcount.'" value = "Unfriend"
          class = "unfriend_sf"/>';
      }
      else if ($number == '5'){
          echo '<input type = "button" class = "this_is_your_best_friend_sf" value = "This is your Best Friend"/>';
      }
       echo '</div>';
       echo '</div>';
   mysqli_select_db($conn, 'membersinwebsite'); 
       
   }   
}
   echo '</div>';
   repeat();
   $conn->close();
?>