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
$select = "SELECT `id`, `username` FROM `userslist`";
$result = $conn->query("$select");
$combinedstring = "";
if (mysqli_num_rows($result) > 0) {
while ($row = $result->fetch_assoc()) {
      similar_text($row['username'], $searchname, $percent);
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
        $count = 0;
     echo '<div class = "total_user_profile_info">';     
     foreach ($searchresult as $friendresult) {
         if ($count >= 100) {
             break;
         }
         $count++;
         $exploding = explode (',',$friendresult, 2);
         $rid = $exploding[1];
        $select2 = $conn->prepare("SELECT `username`, `gmail` FROM `userslist` WHERE id = ?");
        $select2->bind_param("s", $rid);
        $select2->execute();
        $result2 = $select2->get_result();
        $row2 = $result2->fetch_assoc();
        $rusername = $row2['username'];
        $rgmail = $row2['gmail'];
        mysqli_free_result($result2);
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
       mysqli_select_db($conn, $db);
       $hashusername = md5(md5($rusername));
       $myusername = md5(md5($_SESSION['username']));
       $appcount = 'aicyzlai3laivy391kj73kvka9i143llkdfa';
       $appcount .= $count;
       $appcount1 = $appcount;
       $appcount1 .= 'aic';
        if ($number == '1'){
            echo '<input type = "button" id = "addfriend" data-axiy2wi3 = "'.$hashusername.'"
            data-aic2eyz3 = "'.$myusername.'" data-si2x0ezp = "'.$appcount.'" value = "Add Friend"
            class = "addfriend"/>';
            
        }
        else if ($number == '2'){
            echo '<input type = "button" id = "cancelsentrequest" data-axiy2wi3 = "'.$hashusername.'"
            data-aic2eyz3 = "'.$myusername.'" data-si2x0ezp = "'.$appcount.'" value = "Cancel Sent Request"
             class = "cancelsentrequest"/>';
        }
        else if ($number == '3'){
            echo '<input type = "button" id = "acceptrequest" data-axiy2wi3 = "'.$hashusername.'" 
            data-aic2eyz3 = "'.$myusername.'" data-si2x0ezp = "'.$appcount1.'" value = "Accept Request"
             class = "acceptrequest"/>';

            echo '<input type = "button" id = "cancelrequest" data-axiy2wi3 = "'.$hashusername.'" 
            data-aic2eyz3 = "'.$myusername.'" data-si2x0ezp = "'.$appcount.'" value = "Cancel Request"
             class = "cancelrequest"/>';
        }
        else if ($number == '4') {
            echo '<input type = "button"  id = "unfriend" data-axiy2wi3 = "'.$hashusername.'" 
            data-aic2eyz3 = "'.$myusername.'" data-si2x0ezp = "'.$appcount.'" value = "Unfriend"
            class = "unfriend"/>';
        }
        else if ($number == '5'){
            echo '<input type = "button" class = "this_is_your_best_friend" value = "This is your Best Friend"/>';
        }
         echo '</div>';
         echo '</div>';
     } 
     echo '</div>';
    }
$conn->close();
?>


