<?php
class node {
    public $data;
    public $next;
    public function __construct($data ){
        $this->data = $data;
        $this->next = NULL;
    }
}

class searchlinkedlist {
    public $_firstnode = NULL;
    public  $_currentnode = NULL ;
    public $_tempnode = NULL;
     public $_assumednode = NULL;

     public function insertnode($data) {
        $newnode = new node($data);
        $newnodedata = $newnode->data;
        $newnodeexploding = explode (',', $newnodedata, -1);
         
         if ($this->_firstnode == NULL) {
             $this->_firstnode = $newnode;  
         }
         else if ($this->_firstnode->next == NULL) {
            $_tempnode = $this->_firstnode;             
            $exploding = explode (',', $_tempnode->data, -1);
            if ($newnodeexploding[0] >= $exploding[0]) {
                $_tempnode = $newnode;
                $_tempnode->next = $this->_firstnode;
                $this->_firstnode = $newnode;
            }
            else {
                $_tempnode->next = $newnode;
            }
        }
        else { 

            $_currentnode = $this->_firstnode;
            $_tempnode = $this->_firstnode;

            $exploding = explode (',', $_tempnode->data, -1);
            if ($newnodeexploding[0] >= $exploding[0]) {
                $_tempnode = $newnode;
                $_tempnode->next = $this->_firstnode;
                $this->_firstnode = $newnode;
            }
            
            else { 
               $_currentnode = $_currentnode->next;
                while ($_currentnode != NULL) {
                $exploding = explode (',', $_currentnode->data, -1);
        if ($newnodeexploding[0] >= $exploding[0]) {
            $_tempnode->next = $newnode;
            $newnode->next = $_currentnode;
            break;
        }
        
        else if ($_tempnode->next == NULL && $newnodeexploding[0] < $exploding[0]) { 
         $_currentnode->next = $newnode;
         break;
        }

        $_tempnode = $_currentnode;
        if ($_currentnode->next != NULL) { 
        $_currentnode = $_currentnode->next;
    }
 
    } 
}
        }
    } 
      
        function displaydata()  {
           $_currentnode = $this->_firstnode;
            $finaldata = array();
            while ($_currentnode != NULL) {
                array_push($finaldata, $_currentnode->data);
              $_currentnode = $_currentnode->next;
            }
          return $finaldata;
           }
        }
?>
<html>
    <head>
    </head>
<body>
    <div class = "outer_total_page" id = "outer_total_page">
<?php 
session_start();
include_once('connection1.php');
$db = $_SESSION['database'];
$searchlinkedlist = new searchlinkedlist();
$searchname = $_REQUEST["q"];
if ($searchname == "" || $searchname == null) {
    header('location: loginform.html');
    die();
}
$select = "SELECT `friendid`, `friendname` FROM `friendslist`";
if ($result = $conn->query("$select")) { 
$combinedstring = "";
if (mysqli_num_rows($result) > 0) {
while ($row = $result->fetch_assoc()) {
      similar_text ($row['friendname'], $searchname, $percent);
      if ($percent >= 60) {
        $id = $row['friendid'];
        $combinedstring = $percent;
        $combinedstring .= ',';
        $combinedstring .= $id;
         $searchlinkedlist->insertnode("$combinedstring");   
        }
    }
    mysqli_free_result($result);
}
else {
    echo "";
}
if ($combinedstring == "") {
    echo "";
 }
 else { 
     $searchresult = array();
        $searchresult = $searchlinkedlist->displaydata();
     foreach ($searchresult as $friendresult) {
         $exploding = explode (',',$friendresult, 2);
         $rid = $exploding[1];
        $select_friends = $conn->prepare("SELECT `friendid`, `friendname` FROM `friendslist` WHERE `friendid` = ?");
        $select_friends->bind_param("s", $rid);
        $select_friends->execute();
        $result_friends = $select_friends->get_result();
        $row_friends = $result_friends->fetch_assoc();
        $friend_id_for_message = $row_friends['friendid'];
    $friend_name_for_message = $row_friends['friendname'];
    mysqli_free_result($result_friends);
    
    mysqli_select_db($conn, 'membersinwebsite');
    $select_fridb = $conn->prepare("SELECT `databasename` FROM `userslist` WHERE `username` = ?");
    $select_fridb->bind_param("s", $friend_name_for_message);
    $select_fridb->execute();
    $result_fridb = $select_fridb->get_result();
    $row_fridb = $result_fridb->fetch_assoc();
    $created_db = $row_fridb['databasename'];
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
        $last_message = $row2['chat'];
        $last_message_sended_time = date("h:i a", strtotime($row2['sendedtime']));
    }
    else {
     $last_message = "";
     $last_message_sended_time = "";
 }
 mysqli_free_result($result2);
 echo '<div class = "total_page" id = "total_page">'; 
        echo '<div id = "profile_pic" class = "profile_pic">';
 echo '</div>';
        echo '<div id = "friend_to_message" class = "friend_to_message">';
        echo '<button type = "button" id = "'.$friend_id_for_message.'" name = "'.$friend_name_for_message.'" 
        class = "button_details">';
        echo '<div class = "frienddetails">';
        echo '<div class = "friendname">';
        echo '<b>';
        echo '<i>';
         echo $friend_name_for_message;
         echo '</i>';
         echo '</b>';
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
    }
}
else {
    echo "";
}
$conn->close();
?>
    </div>
</body>
</html>