<html>
        <head>
<title> Add friend to group</title>
<meta charset = "UTF-8">
<meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
<meta name = "keywords" content = "making groups, asking doubts in group, learning, shareknowledge, chating">
<meta name = "description" content = "Free web learning in groups and chatting">
<meta name = "author" content = "M. Varun Teja(M.V.T)">
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src = "groupsearch.js" type = "text/javascript"></script>
<link rel = "stylesheet" type = "text/css" href = "groupsearch.css"/>

   </head>

    <body> 
<div class = "total_page_outer">
    <div class = "text_box_to_search">
<input type = "text" id = "search"  class = "search" placeholder = "search your friend" />
</div>
<div class = "total_page">
    <div id = "content" class = "content">
    <?php
    session_start();
    include_once('connection1.php');
    $grpname = $_REQUEST['name'];
    $select = "SELECT `friendname`, `friendgmail` FROM `friendslist`";
    $result = $conn->query($select);
    if (!$result || $result->num_rows == 0) {
        echo "You don't have any friends";
    }

    else {
        echo '<div class = "my_friends">';
            while($row = $result->fetch_assoc()){     
            $friend_name = $row['friendname'];
            $hashfriname = md5(md5($friend_name));
            $friend_gmail = $row['friendgmail'];
            echo '<div class = "div_total_info">';
            echo '<div class = "outer_friend_info">';
            echo '<div class = "profile_pic">';
            echo '</div>';
            echo '<div class = "inner_friend_info">';
            echo '<div class = "space_for_left">';
            echo '<div class = "username">';
            echo '<a href = "aboutme.php?q='.md5($friend_name).'" class = "personal_link">';
         echo $friend_name;
         echo '</a>';
        echo '</div>';

        echo '<div class = "gmail">';
         echo $friend_gmail;
         echo '</div>'; 
         echo '</div>';
         echo '</div>';
        echo '</div>';
         
         mysqli_select_db($conn, 'membersinwebsite');
         $select_fridb = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
         $select_fridb->bind_param("s", $friend_name);
         $select_fridb->execute();
         $result_fridb = $select_fridb->get_result();
         $row_fridb = $result_fridb->fetch_assoc();
         $created_db = $row_fridb['databasename'];
         mysqli_free_result($result_fridb);
      mysqli_select_db($conn, $created_db);
      
         $select_from_list = $conn->prepare("SELECT `hashgroupname` FROM `grouplist` WHERE `hashgroupname` = ?");
         $select_from_list->bind_param("s", $grpname);
         $select_from_list->execute();
         $result_from_list = $select_from_list->get_result();
         $result_from_list->fetch_assoc();
         if ($result_from_list->num_rows > 0) {
             $button_name = "Group Member";
             $id_is = "groupmember";
         }
         else {
             $button_name = 'Add To Group';
             $id_is = "addtogroup";
         }
         mysqli_free_result($result_from_list);
         echo '<div "class = "ack_button">';
         echo '<input type = "button" value = "'.$button_name.'" class = "addtogroup" 
          id = "'.$id_is.'" data-cyke3lx93ja3lnkczldyb = "'.$hashfriname.'"/>';
         echo '</div>';
         mysqli_select_db($conn, $db);
        echo '</div>';
    }
      echo '</div>';
    }
    $conn->close();
    ?>
    </div>
    <div id = "display" class = "display">
</div>  
</div>  
</div>
</body>
</html>