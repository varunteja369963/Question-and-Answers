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
include_once('connection5.php');

$searchname1 = urldecode($_REQUEST["q"]);
$searchname2 = htmlentities($searchname1);
$searchname = mysqli_real_escape_string($conn, $searchname2);

$searchlinkedlist = new searchlinkedlist();
$select = "SELECT `id`, `precisequestion` FROM `shareideaquestions`";
if ($result = $conn->query($select)) { 
$combinedstring = "";
if (mysqli_num_rows($result) > 0) {
while ($row = $result->fetch_assoc()) {
      similar_text ($row['precisequestion'], $searchname, $percent);
      if ($percent >= 50) {
        $id = $row['id'];
        $combinedstring = $percent;
        $combinedstring .= ',';
        $combinedstring .= $id;
         $searchlinkedlist->insertnode("$combinedstring");   
        }
    }
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
        echo '<div style = "color: #E95420;margin-bottom: 13px;text-decoration: underline">';
        echo 'related questions:-';
        echo '</div>';
     foreach ($searchresult as $friendresult) {
         $exploding = explode (',',$friendresult, 2);
         $rid = $exploding[1];
        $select2 = $conn->prepare("SELECT `precisequestion`, `uuid`, `points` FROM `shareideaquestions` WHERE `id` = ?");
        $select2->bind_param("s", $rid);
        $select2->execute();
        $result2 = $select2->get_result();
        $row2 = $result2->fetch_assoc();
        echo '<div class = "total_question">';
        echo '<div class = "for_points">';
        echo $row2['points'];
        echo '</div>';
        echo '<div id = "relatedquestion">';
        echo '<a class = "question_link" href = "shareidearesult.php?uuid='.$row2['uuid'].'">';
         echo stripslashes($row2['precisequestion']);
         echo '</a>';
         echo '</div>';
         echo '</div>';
    mysqli_free_result($result2);         
     }
    }
    mysqli_free_result($result);
}
else {
    echo "";
}
$conn->close();
?>

