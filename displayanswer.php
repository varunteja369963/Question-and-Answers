<html>
    <head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
<meta name = "keywords" content = "making groups, asking doubts in group, learning, shareknowledge, chating">
<meta name = "description" content = "Free web learning in groups and chatting">
<meta name = "author" content = "M. Varun Teja(M.V.T)">
       <link rel = "stylesheet" type = "text/css" href = "displayanswer.css"/>
       <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
      <script src = "displayanswer.js" type = "text/javascript"></script>    
  </head>
  <body>

  <div class = "loading_bar">
        <div class = "loader" style = "display: none"></div>
    </div>
<div class = "total_page">
<div id = "displaying_answer">
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
$hashgroupname = $_GET['groupname'];
$questionuuid = $_GET['questionid'];
$selectgroupname = $conn->prepare("SELECT `shorthashgroupname`, `createduser` FROM `grouplist` WHERE `hashgroupname` = ?");
$selectgroupname->bind_param("s", $hashgroupname);
$selectgroupname->execute();
$resultgroupname = $selectgroupname->get_result();
$rowgroupname = $resultgroupname->fetch_assoc();
$groupname = $rowgroupname['shorthashgroupname'];
$createduser = $rowgroupname['createduser'];
mysqli_free_result($resultgroupname);
$groupname2 = $groupname;
$groupname2 .= '2';

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
 echo '<div class = "question_area">';
$select2 = $conn->prepare("SELECT `tags`, `specificquestion`, `question`, `askeduser`, `askedtime`, `points` FROM `$groupname2` WHERE `questionuuid` = ?");
$select2->bind_param("s", $questionuuid);
$select2->execute();
$result2 = $select2->get_result();
if ($result2->num_rows > 0) { 
$row2 = $result2->fetch_assoc();
$tags = $row2['tags'];
    $specificquestions = stripslashes($row2['specificquestion']);
    $question = stripslashes($row2['question']);

    $before_askeduser = $row2['askeduser'];
    if (strlen($before_askeduser) > 12) {
        $askeduser = substr($before_askeduser, 0, 12);
        $askeduser .= '..';
    }
    else {
        $askeduser = $before_askeduser;
    }

    $date = $row2['askedtime'];
    $points = $row2['points'];
    
    $asked_date = date("d/m/y", strtotime("$date"));
    $asked_time = date("h:i:sa", strtotime("$date"));

    echo '<div class = "specific_and_delete">';

 echo '<div id = "specific_question">';
    echo $specificquestions;
    echo '</div>';

    if (isset($_SESSION['username'])) { 
        if ($_SESSION['username'] === $before_askeduser) { 
    echo '<div class = "outer_delete_question_div">';
    echo '<button type = "button" class = "delete_question_button" id = "delete_question_button">';
    echo '<div class = "delete_question" id = "delete_question"></div>';
    echo '</button>';
    echo '</div>';
        }
    }
    echo '</div>';
    
    echo '<div id = "question_line">';
    echo '</div>';
    echo '<div id = "firstpointsanddata">';
    echo '<div id = "pointsanddata">';
    echo '<div id = "total_points">';      
    echo '<div id = "plus_points">';
    echo '<button type = "button" id = "add_one_point">';
    echo '+';
    echo'</button>';
    echo '</div>';
    echo '<div id = "got_points">';
    echo $points;
    echo '</div>';
    echo '<div id = "minus_points">';
    echo '<button type = "button" id = "minus_one_point">';
    echo '-';
    echo'</button>';
    echo '</div>';
    if ($_SESSION['username'] === $before_askeduser) {
    echo '<div id = "edit_div">';
    echo '<button type = "button" id = "edit_question">';
    echo 'edit';
    echo '</button>';
    echo '</div>';
    }
    echo '</div>';
   echo '<div id = "question_data">';
 echo '<div id = "question">';
 echo html_entity_decode($question);
 echo '</div>';
    $splitedtags = explode(";",$tags);
    $tagslength = count($splitedtags);
    echo '<div id = "outer_tags">';
    for ($x = 0; $x < $tagslength-1; $x++) {
     echo '<div id = "inner_tags">';
        echo $splitedtags[$x];
        echo '</div>';
    }
    echo '</div>';
    


    echo '<div id = "posted_question_details">';
   echo '<span id = "asked_time">';
   echo '<span id = "posted_on">';
   echo 'posted on:'; 
   echo '</span>';
   echo "<span style='color:red;'>".$asked_date."</span>";
   echo "<span class = 'time' style='color:blue;'>". ' (' . $asked_time. ')' . "</span>";      
   echo '</span>';
   echo '<span id = "border">';
   echo '<div id = "question_asked_user">';
   echo '<a class = "ax03ha34" href = "aboutme.php?q=' .md5($before_askeduser).'">';
   echo $askeduser;
   echo '</a>';
   echo '</div>';
   echo '</span>';
   echo '</div>';
   echo '</div>';
echo '</div>';
   echo '</div>';
   echo '</div>';
 
   echo '<div id = "line">';
   echo '</div>';

   $selectanswers = "SELECT `id` FROM `$questionuuid`";
   if ($resultanswers = $conn->query($selectanswers)) {
$answer_count = mysqli_num_rows($resultanswers);
   }
   else {
       $answer_count = 0;
   }
   mysqli_free_result($resultanswers);
echo '<div id = "acknowledged">';
echo "$answer_count" . ' ANSWERS';
echo '</div>';
echo '<div id = "content_window">';
echo '</div>';
       echo '<div id = "noofpages">';
        echo '</div>';
 }
 else {
     echo '<h1>';
     echo 'No Question was there in the datebase';
     echo '</h1>';
     exit();
 }
 mysqli_free_result($result2);
    $conn->close();
?>
</div>
</div>
</body>
</html>


<html>
<head>
<script type="text/javascript" src="wysiwyg.js" ></script>
<script type="text/javascript" src="formsubmission.js"></script>
<link rel = "stylesheet" type = "text/css" href = "wysiwyg.css"/> 
</head>
<body>
    <form action = "" method = "post" id = "form">
<div id = "box" name = "box">
            <div id = "menu">
               <button type = "button" id = "Bold" title = "Bold"><b>B</b></button>
               <button type = "button" id = "Italic" title = "Italic"><em>I</em></button>
               <button type = "button" id = "Underline" title = "Underline"><u>abc</u></button>
               <button type = "button" id = "Strike" title = "Strikethrough"><s>abc</s></button>
               <button type = "button" id = "orderedList" title = "Numbered list">(i)</button>
               <button type = "button" id = "unorderedList" title = "Bulleted list">&bull;</button>
        <div class = "align">
               <button type = "button" id = "alignleft" title = "Align Left">L</button>
               <button type = "button" id = "aligncenter" title = "Align Center">C</button>
               <button type = "button" id = "alignright" title = "Align Right">R</button>
        </div>
           <div class = "size">
               <button type = "button" id = "auto" title = "AutoSize">auto-size</button>               
               <button type = "button" id = "h1" title = "FontSize">h1</button> 
               <button type = "button" id = "h3" title = "FontSize">h3</button> 
               <button type = "button" id = "h6" title = "FontSize">h6</button>
        </div> 
               <input type = "color" id = "textcolor" title = "TextColor">
               <input type = "color" id = "backcolor" title = "BackGroundColor">           
               <button type = "button" id = "Link" title = "Link">&#x27BF;</button> 
               <button type = "button" id = "Unlink" title = "Unlink">Unlink</button>
               <button type = "button" id = "sup" title = "SuperScript">X<sup>2</sup></button>
               <button type = "button" id = "sub" title = "SubScript">X<sub>2</sub></button> 
               <button type = "button" id = "video" class = "video" title = "include video">video</button>          
</div>
           
            <div id = "richtextarea" name = "richtextarea">
                <iframe id = "wysiwyg" name = "wysiwyg" frameborder = "0">
                </iframe>
        </div>
            </div>
    <div id = "button">
        <button type = "submit" id = "submit_button" name = "answerthisquestion">Submit</button>
</div>
</form>
</body>
</html>
