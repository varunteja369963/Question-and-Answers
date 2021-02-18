
<html>
    <head>
    <title>groupfrontpage</title>
    <meta charset = "UTF-8">
<meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
<meta name = "keywords" content = "making groups, asking doubts in group, learning, shareknowledge, chating">
<meta name = "description" content = "Free web learning in groups and chatting">
<meta name = "author" content = "M. Varun Teja(M.V.T)">
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
            <script type = "text/javascript" src = "groupfrontpage.js"></script>
    <link rel = "stylesheet" type = "text/css" href = "groupfrontpage.css">
            
            <style>
    .addingclass {
        width: 100%;
        height: 250px;
        border:1px solid black;
        border-bottom: none;
        overflow: auto;       
    }
    
</style>
</head>
<body>
    <div class = "total_page">
<div id = "creategroup_button">
<button type = "button" class = "creategroup" name = "creategroup">
creategroup
</button>
</div>
 <div id = "line">
 </div>
<div id = "creategroupbox">
</div>

<?php
session_start();
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
     header('location: loginform.html');
    }

   include_once('connection1.php');
      $count = 0;
      $select = "SELECT `sno`, `shorthashgroupname`, `groupname`, `hashgroupname`, `createduser`, `addeduser` FROM `grouplist`";
    $result = $conn->query($select);
    if(!$result) { 
        echo '<center>';
        echo 'You have no groups in your list';
        echo '</center>';
    }
    else if ($result->num_rows == 0){
        echo '<center>';
        echo 'You have no groups in your list';
        echo '</center>';
    
}
echo '<div id = "firstline"></div>';
       if ($result) { 
      while ($row = $result->fetch_assoc()) {
         $sno = $row['sno'];
         $createdone = $row['createduser'];
         if (strlen($createdone) > 10){
            $createduser = substr($createdone,0,10);
            $createduser .= '...';
         }
         else {
            $createduser = $createdone;
         }
         $hashgroupname = $row['hashgroupname'];
         $groupname = $row['groupname']; 
         $groupname_for_count = $row['shorthashgroupname']; 
         $groupname_for_count .= '1';
         if($createdone != $_SESSION['username']) {
             mysqli_select_db($conn, 'membersinwebsite');
             $select_fridb = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
             $select_fridb->bind_param("s", $createdone);
             $select_fridb->execute();
             $result_fridb = $select_fridb->get_result();
             $row_fridb = $result_fridb->fetch_assoc();
             $created_db = $row_fridb['databasename'];
             mysqli_free_result($result_fridb);
          mysqli_select_db($conn, $created_db);
         }
         $query_of_users = "SELECT COUNT(*) AS SUM FROM `$groupname_for_count`";
         $result_of_users = $conn->query($query_of_users);
         $fetch_users = mysqli_fetch_assoc($result_of_users);
         $no_of_users = $fetch_users['SUM'];
         
         $select_created_time = $conn->prepare("SELECT `createdtime` FROM `$groupname_for_count` WHERE `username` = ?");
         $select_created_time->bind_param("s", $createduser);
         $select_created_time->execute();
         $result_created_time = $select_created_time->get_result();
         $row_created_time = mysqli_fetch_assoc($result_created_time);
          $date = $row_created_time['createdtime'];
          $created_time = date("d/m/y", strtotime("$date"));
    mysqli_free_result($result_created_time);
          echo '<div class = "buttons">'; 
          
          echo '<div class = "group_button">';
          echo '<button id = "'.$hashgroupname.'" type = "button" class = "groupname" onclick = "passingname(this)" >';
          echo '<div class = "groupnamebutton">';                             
          echo "$groupname";
          echo '</div>';

          echo '<div id = "posted_question_details">';
          echo '<span id = "created_user" style="color:blue;">';
          echo "$createduser" . '(' . "$no_of_users" . ')';
          echo '</span>';
          
          echo '<span id = "created_time" style="color:red;">';
          echo "$created_time";     
          echo '</span>';
          echo '</div>';
          echo '</button>';
          echo '</div>';

          echo '<span class = "add_to_group">';  
          echo '<button id = "'.$sno.'" data-grpname = "'.$hashgroupname.'" type = "button" onclick = "passingid(this)" class = "addfriendtogroup"  >';         
          echo '+';
          echo '</button>';
          echo '</span>';
          echo '</div>'; 
 
          if($createdone != $_SESSION['username']) {
            mysqli_select_db($conn, $db);
        }   
        }
        mysqli_free_result($result);
    }
    else {
        echo '<center>';
        echo 'You have no groups in your list';
        echo '</center>';
    }       
    
   
      $conn->close();
?>
</div>
</body>
</html> 

