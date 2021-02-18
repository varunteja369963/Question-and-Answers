<html>
    <head>
        <title>about me</title>
<meta charset = "UTF-8"/>
<meta name = "viewport" content = "width=device-width, initial-scale = 1.0"/>
<meta name = "keywords" content = "groups, qestion and answer, shareideas, learning, shareknowledge, chating "/>
<meta name = "description" content = "Free web learning"/>
<meta name = "author" content = "M.Varun Teja(M.V.T)"/>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
        <link href = "aboutme.css" rel = "stylesheet" type = "text/css"/>
<script src = "aboutme.js" type = "text/javascript"></script>        
    </head>
    <body>
<?php
session_start();
include_once("connection.php");

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
        header("location: loginform.html");    
    }

$hashusername = $_REQUEST['q'];

$retrieve_username = $conn->prepare("SELECT `username`, `gmail`, `profileaddr`,
 `points`, `quote`, `aboutyourself`, `greateststrength`, `greatestweakness`,
 `diffsituations`, `seeyourself`, `teamplayer`, `disagreement`, `longandshortgoal`,
 `hobbies`, `whenyoustart` FROM `userslist` WHERE `hashusername` = ?");
 $retrieve_username->bind_param("s", $hashusername);
 $retrieve_username->execute();
 $result_username = $retrieve_username->get_result();
 $row_username = $result_username->fetch_assoc();
 if ($result_username->num_rows != 1) {
     mysqli_free_result($result_username);
     header('location: loginform.html');
     die();
 }
 else {
  $username = $row_username['username'];
  $gmail = $row_username['gmail'];
  $points = $row_username['points'];
  $imagesrc = $row_username['profileaddr'];
  $quote = stripslashes($row_username['quote']);
  $aboutyourself = stripslashes($row_username['aboutyourself']);
  $greateststrength = stripslashes($row_username['greateststrength']);
  $greatestweakness = stripslashes($row_username['greatestweakness']);
  $diffsituations = stripslashes($row_username['diffsituations']);
  $seeyourself = stripslashes($row_username['seeyourself']);
  $teamplayer = stripslashes($row_username['teamplayer']);
  $disagreement = stripslashes($row_username['disagreement']);
  $longandshortgoal = stripslashes($row_username['longandshortgoal']);
  $hobbies = stripslashes($row_username['hobbies']);
  $whenyoustart = stripslashes($row_username['whenyoustart']);
 mysqli_free_result($result_username);  
 }
 if ($quote == NULL || $quote == "") {
     $quote = '.........';
 }
 if ($aboutyourself == NULL) {
     $aboutyourself = '.........';
 }
 if ($greateststrength == NULL) {
    $greateststrength = '.........';
}
if ($greatestweakness == NULL) {
    $greatestweakness = '.........';
}
if ($diffsituations == NULL) {
    $diffsituations = '.........';
}
if ($seeyourself == NULL) {
    $seeyourself = '.........';
}
if ($teamplayer == NULL) {
    $teamplayer = '.........';
}if ($disagreement == NULL) {
    $disagreement = '.........';
}if ($longandshortgoal == NULL) {
    $longandshortgoal = '.........';
}if ($hobbies == NULL) {
    $hobbies = '.........';
}if ($whenyoustart == NULL) {
    $whenyoustart = '.........';
}
?>

<div class = "total_page">
    <div class = "top_page">
        <div class = "inner_top_page">
            <div class = "outer_profile_pic">
                <center>
            <div class = "profile_pic">
            <div class="loader" style = "display:none"></div> 
            <?php
            if ($imagesrc == NULL) {

            }
            else { 
            echo '<img src = "'.$imagesrc.'" width = "100%" height = "100%" id = "picture">';
            }
            ?>
            </div>
            <?php
            if ($_SESSION['username'] === $username){
               echo '<form action="#" method="post" enctype="multipart/form-data" id = "form">';
               echo '<div id = "update_profile_pic_div" class = "update_profile_pic_div">';
               echo 'update profile pic';
            echo '<input type = "file" id = "update_profile_pic" name = "profile_pic_file" 
            class = "update_profile_pic" value = "update profile pic" />';
            echo '</div>';
            echo '</form>';
        }
            ?>
            </center>
            </div>
            <div class = "user_info">
              <div class = "inner_user_info">
          <div class = "username"><?php echo $username;?></div>
                <div class = "gmail"><?php echo $gmail;?></div>
                <?php 
                if ($_SESSION['username'] === $username) { 
                echo '<div class = "quote_of_the_day">';
                echo '<div id = "quote" class = "quote">';
                echo $quote;
                echo '</div>';
                echo '<div class = "quote_edit_div">';
                echo '<button type = "button" class = "edit_quote_button" id = "edit_quote_button">edit</button>';
                echo '</div>';
                echo '</div>';
                }
                else {
                    echo '<div id = "quote" class = "quote">';
                    echo $quote;
                    echo '</div>';  
                }
                ?>
                <?php
                if ($_SESSION['username'] !== $username) { 
                    $database = $_SESSION['database'];
        mysqli_select_db($conn, $database);
        if ($username === $_SESSION['username']) {
            header("Refresh:0");
        }   
        else {
$select_friend = $conn->prepare("SELECT `friendname` FROM `friendslist` WHERE `friendname` = ?");
$select_friend->bind_param("s", $username);
$select_friend->execute();
$result_friend = $select_friend->get_result();
if ($result_friend->num_rows > 0) {
 if ($result_friend->num_rows === 1) {
    echo '<div class = "message_button">';
            echo '<button type = "button" class = "message" id = "message">';
            echo 'message';
                echo '</button>';
                echo '</div>';
 }
 else {
     alert('There is something problem. Please contact 9640096621 for futher detials');
     location('header: 0');
 }
}
mysqli_free_result($result_friend);
        }      
    }
        ?>
            <div class = "outer_points">
                <div class = "inner_points">
           <div class = "total_points" title = "Total points you earned" style = "display: flex;">
<span class = "heart"></span>
<span class = "points1"><?php echo $points;?></span>
</div>
            </div>
</div>
               </div>
            </div>
        </div>
    </div>

    <div class = "bottom_page">
     <div class = "inner_bottom_page">
        <div class = "about_yourself">
        <div class = "for_edit">            
        <label for = "inner_about_yourself" class = "div_for_labels">
        Tell me about yourself.
        </label>
        <?php
        if ($_SESSION['username'] === $username) { 
        echo '<div class = "div_for_edit">';
        echo '<button type = "button" class = "edit_button" id = "edit_button" data-uuid = "a9ak0ali34" data-num = "1">';
        echo 'edit';
        echo '</button>';
        echo '</div>';
        }
        ?>
        </div>
        <div contenteditable = "false" class = "a9ak0ali34" id = "answer"><?php echo $aboutyourself;?></div>
        </div>

        <div class = "greatest_strength">
        <div class = "for_edit">
        <label for = "inner_greatest_strength" class = "div_for_labels">
        What is your greatest strength?
        </label>
        <?php
        if ($_SESSION['username'] === $username) { 
        echo '<div class = "div_for_edit">';
        echo '<button type = "button" class = "edit_button" id = "edit_button" data-uuid = "56ak0a5634" data-num = "2">';
        echo 'edit';
        echo '</button>';
        echo '</div>';
        }
        ?>
        </div>
        <div contenteditable = "false" class = "56ak0a5634" id = "answer"><?php echo $greateststrength;?></div>        
        </div>

        <div class = "greatest_weakness">
        <div class = "for_edit">
        <label for = "inner_greatest_weakness" class = "div_for_labels">
        What is your greatest weakness?
        </label>
        <?php
        if ($_SESSION['username'] === $username) { 
        echo '<div class = "div_for_edit">';
        echo '<button type = "button" class = "edit_button" id = "edit_button" data-uuid = "5adas34as" data-num = "3">';
        echo 'edit';
        echo '</button>';
        echo '</div>';
        }
        ?>
        </div>
        <div contenteditable = "false" class = "5adas34as" id = "answer"><?php echo $greatestweakness;?></div>        
        </div>

        <div class = "diff_situations">
        <div class = "for_edit">
        <label for = "inner_diff_situations" class = "div_for_labels">
        Describe a difficult situation in your life and how you overcame it.
        </label>
        <?php         
        if ($username === $_SESSION['username']) {
        echo '<div class = "div_for_edit">';
        echo '<button type = "button" class = "edit_button" id = "edit_button" data-uuid = "a88sdf92asz" data-num = "4">';
        echo 'edit';
        echo '</button>';
        echo '</div>';
        }
        ?>
        </div>
        </div>
        <div contenteditable = "false" class = "a88sdf92asz" id = "answer"><?php echo $diffsituations;?></div>        

        <div class = "see_yourself">
        <div class = "for_edit">
        <label for = "inner_see_yourself" class = "div_for_labels">
        Where do you see yourself in 5 years?
        </label>
        <?php         
        if ($username === $_SESSION['username']) {
        echo '<div class = "div_for_edit">';
        echo '<button type = "button" class = "edit_button" id = "edit_button" data-uuid = "aidf9234ka" data-num = "5">';
        echo 'edit';
        echo '</button>';
        echo '</div>';
        }
        ?>
        </div>
        <div contenteditable = "false" class = "aidf9234ka" id = "answer"><?php echo $seeyourself;?></div>        
        </div>

        <div class = "team_player">
        <div class = "for_edit">
        <label for = "inner_team_player" class = "div_for_labels">
        What do you think about Being a Team Player?
        </label>
        <?php         
        if ($username === $_SESSION['username']) {
        echo '<div class = "div_for_edit">';
        echo '<button type = "button" class = "edit_button" id = "edit_button" data-uuid = "asd83kz3k" data-num = "6">';
        echo 'edit';
        echo '</button>';
        echo '</div>';
        }
        ?>
        </div>
        <div contenteditable = "false" class = "asd83kz3k" id = "answer"><?php echo $teamplayer;?></div>        
        </div>

        <div class = "disagreement">
        <div class = "for_edit">
        <label for = "inner_disagreement" class = "div_for_labels">
        How do you deal with conflict?
        </label>
        <?php         
        if ($username === $_SESSION['username']) {
        echo '<div class = "div_for_edit">';
        echo '<button type = "button" class = "edit_button" id = "edit_button" data-uuid = "as83kjd8al2" data-num = "7">';
        echo 'edit';
        echo '</button>';
        echo '</div>';
        }
        ?>
        </div>
        <div contenteditable = "false" class = "as83kjd8al2" id = "answer"><?php echo $disagreement;?></div>        
        </div>

        <div class = "long_and_short_goal">
        <div class = "for_edit">
        <label for = "inner_long_and_short_goal" class = "div_for_labels">
        What are your long and short term goals?
        </label>
        <?php         
        if ($username === $_SESSION['username']) {
        echo '<div class = "div_for_edit">';
        echo '<button type = "button" class = "edit_button" id = "edit_button" data-uuid = "asdfd832kds9" data-num = "8">';
        echo 'edit';
        echo '</button>';
        echo '</div>';
        }
        ?>
        </div>
        <div contenteditable = "false" class = "asdfd832kds9" id = "answer"><?php echo $longandshortgoal;?></div>        
        </div>

        <div class = "hobbies">
        <div class = "for_edit">
        <label for = "inner_hobbies" class = "div_for_labels">
        What are your hobbies?
        </label>
        <?php         
        if ($username === $_SESSION['username']) {
        echo '<div class = "div_for_edit">';
        echo '<button type = "button" class = "edit_button" id = "edit_button" data-uuid = "di934kicl" data-num = "9">';
        echo 'edit';
        echo '</button>';
        echo '</div>';
        }
        ?>
        </div>
        <div contenteditable = "false" class = "di934kicl" id = "answer"><?php echo $hobbies;?></div>        
        </div>

        <div class = "when_you_start">
        <div class = "for_edit">
        <label for = "inner_when_you_start" class = "div_for_labels">
        What can you start? (or) What is the best time to start?
        </label>
        <?php         
        if ($username === $_SESSION['username']) {
        echo '<div class = "div_for_edit">';
        echo '<button type = "button" class = "edit_button" id = "edit_button" data-uuid = "34jickj19" data-num = "10">';
        echo 'edit';
        echo '</button>';
        echo '</div>';
        }
        ?>
        </div>
        <div contenteditable = "false" class = "34jickj19" id = "answer"><?php echo $whenyoustart;?></div>                
        </div> 
     </div>
    </div>
</div>
    </body>
</html>