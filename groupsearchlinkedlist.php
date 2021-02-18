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


<?php
session_start();
include_once('connection.php');
$searchlinkedlist = new searchlinkedlist();
$searchname = $_REQUEST["q"];
$grpname = $_REQUEST['grpname'];

        $select = "SELECT `id`, `username` FROM `userslist`";
$result = $conn->query("$select");
$combinedstring = "";
if (mysqli_num_rows($result) > 0) {
while ($row = $result->fetch_assoc()) {
      similar_text ($row['username'], $searchname, $percent);
      if ($percent >= 50) {
        $id = $row['id'];
        $combinedstring = $percent;
        $combinedstring .= ',';
        $combinedstring .= $id;
         $searchlinkedlist->insertnode("$combinedstring");   
        }
    }
}
mysqli_free_result($result);
if ($combinedstring == "") {
    echo "no suggestions";
 }
 else { 
     $searchresult = array();
        $searchresult = $searchlinkedlist->displaydata();

        echo '<div class = "my_friends">';  
     foreach ($searchresult as $friendresult) {
            $exploding = explode (',',$friendresult, 2);
         $rid = $exploding[1];
        $select2 = $conn->prepare("SELECT `username`, `gmail`, `profileaddr` FROM `userslist` WHERE `id` = ?");
        $select2->bind_param("s", $rid);
        $select2->execute();
        $result2 = $select2->get_result();
        $row2 = $result2->fetch_assoc();
        $friend_name = $row2['username'];
        $hashfriname = md5(md5($friend_name));
        $imagesrc = $row2['profileaddr'];
        $friend_gmail = $row2['gmail'];
            echo '<div class = "div_total_info">';            
            echo '<div class = "outer_friend_info">';
            echo '<div class = "profile_pic">';
            if ($imagesrc == NULL) {

            }
            else { 
            echo '<img src = "'.$imagesrc.'" width = "100%" height = "100%" id = "picture">';
            }
            echo '</div>';
            echo '<div class = "inner_friend_info">';
            echo '<div class = "space_for_left">';
            echo '<div class = "username">';
            echo $friend_name;
        echo '</div>';
        echo '<div class = "gmail">';
        echo "$friend_gmail";
         echo '</div>'; 
         echo '</div>';
         echo '</div>';
         echo '</div>';
       
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
             $id_is = 'groupmember';             
         }
         else {
             $button_name = 'Add To Group';
             $id_is = 'addtogroup';             
         }
         mysqli_free_result($result_from_list);
         echo '<div "class = "ack_button">';
         echo '<input type = "button" value = "'.$button_name.'" class = "addtogroup" id = "'.$id_is.'" 
         data-cyke3lx93ja3lnkczldyb = "'.$hashfriname.'"/>';
         echo '</div>';
         $membersinwebsite = 'membersinwebsite';
         mysqli_select_db($conn, $membersinwebsite);
        echo '</div>';
     }
     mysqli_free_result($result2);
     echo '</div>';
    }
$conn->close();
?>






