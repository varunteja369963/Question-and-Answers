<html>
    <head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
<meta name = "keywords" content = "making groups, asking doubts in group, learning, shareknowledge, chating">
<meta name = "description" content = "Free web learning in groups and chatting">
<meta name = "author" content = "M. Varun Teja(M.V.T)">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
      <script src = "shareidearesult.js" type = "text/javascript"></script>             
       <link rel = "stylesheet" type = "text/css" href = "displayanswer.css"/>
       <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>  
</head>
  <body>

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
    }
include_once('connection5.php');
$uuid = $_REQUEST['uuid'];

echo '<div class = "question_area">';
   $select2 = $conn->prepare("SELECT `precisequestion`, `uuid`, `question`, `tags`, `askeduser`, `dateandtime`, `points`, `yearstake`, `participation`, `requirements`, `investement` FROM `shareideaquestions` WHERE `uuid` = ?");
   $select2->bind_param("s", $uuid);
   $select2->execute();
   $result2 = $select2->get_result();
   if ($result2->num_rows > 0) { 
  $row2 = $result2->fetch_assoc();
       $specificquestions = stripslashes($row2['precisequestion']);
       $tags = stripslashes($row2['tags']);
       $before_askeduser = $row2['askeduser'];
       if (strlen($before_askeduser) > 12) {
           $askeduser = substr($before_askeduser, 0, 12);
           $askeduser .= '..';
       }
       else {
           $askeduser = $before_askeduser;
       }

       $question = stripslashes($row2['question']);
       $date = $row2['dateandtime'];
       $points = $row2['points'];
       $asked_date = date("d/m/y", strtotime("$date"));
       $asked_time = date("h:i:sa", strtotime("$date"));
       $yearstake = $row2['yearstake'];
       $participation = $row2['participation'];
       $requirements = $row2['requirements'];
       $investement = $row2['investement'];

    echo '<div id = "specific_question">';
       echo $specificquestions;
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
       if (isset($_SESSION['logged_in'])) { 
       if ($_SESSION['username'] === $before_askeduser) {
        echo '<div id = "edit_div">';
        echo '<button type = "button" id = "edit_question">';
        echo 'edit';
        echo '</button>';
        echo '</div>';
        }
    }
       echo '</div>';
      echo '<div id = "question_data">';
    echo '<div id = "question">';
    echo html_entity_decode($question);
    echo '</div>';

    echo '<div class = "yearstake_outer" style = "margin-top: 30px">';
    echo '<label for = "yearstake">';
    echo '<b>';
    echo 'Time needed to complete this project:';
    echo '</b>';
    echo '</label>';
    echo '<br/>';
    echo '<div class = "yearstake" style = "border:1px solid #E95420; padding: 5px 10px; display: inline-block;border-radius: 10px; margin-top: 15px;">';
    echo $yearstake;
    echo '</div>';
    echo '</div>';

    echo '<div class = "participation_outer" style = "margin-top: 30px">';
    echo '<label for = "participation">';
    echo '<b>';
    echo 'Members participating in this project:';
    echo '</b>';
    echo '</label>';
    echo '<br/>';
    echo '<div class = "participation" style = "border:1px solid #E95420; padding: 5px 10px; display: inline-block;border-radius: 10px; margin-top: 15px;">';
    echo $participation;
    echo '</div>';
    echo '</div>';

    echo '<div class = "requirements_outer" style = "margin-top: 30px">';
    echo '<label for = "requirements">';
    echo '<b>';
    echo 'Requriements needed for this project:';
    echo '</b>';
    echo '</label>';
    echo '<br/>';
    echo '<div class = "requirements" style = "border:1px solid #E95420; padding: 5px 10px; display: inline-block;border-radius: 10px; margin-top: 15px;">';
    echo $requirements;
    echo '</div>';
    echo '</div>';

    echo '<div class = "investement_outer" style = "margin-top: 30px; margin-bottom: 30px;">';
    echo '<label for = "investement">';
    echo '<b>';
    echo 'Investement:';
    echo '</b>';
    echo '</label>';
    echo '<br/>';
    echo '<div class = "investement" style = "border:1px solid #E95420; padding: 5px 10px; display: inline-block;border-radius: 10px; margin-top: 15px;">';
    echo $investement;
    echo '</div>';
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
$selectanswers = "SELECT `id` FROM `$uuid`";
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
        echo 'Be the first one to post your question.';
        echo '</h1>';
        exit();
    }
    mysqli_free_result($result2);    
       $conn->close();
?>

</div>
</body>
</html>

<html>
<head>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
<script type="text/javascript" src="wysiwyg.js" ></script>
<script type="text/javascript" src="answersubmission2.js" ></script>
<link rel = "stylesheet" type = "text/css" href = "wysiwyg.css"/> 
</head>
<body>
    <form action = "" method = "post" id = "form">
    <center>
    <div id = "bottom_line">
</div>
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
               <div class = "file_button">
                       Image
               <input type = "file" id = "file" class = "file" title = "include file" value = "file"/>
        </div>  
</div>
           
            <div id = "richtextarea" name = "richtextarea">
                <iframe id = "wysiwyg" name = "wysiwyg" frameborder = "0">
                </iframe>
        </div>
            </div>
    <div id = "button">
        <button type = "submit" id = "submit_button" name = "answerthisquestion">Answer this question</button>
</div>
    </center>
</form>
</body>
</html>