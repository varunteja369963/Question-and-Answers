<?php
session_start();
  include_once('connection1.php');
$friendname = $_GET['friendname'];
$mdata = $_GET['data'];
if ($friendname == "" || $mdata == "") {
    header('location: loginform.html');
    die();
}
    $select = "SELECT `chat`, `place`, `sent`, `sendedtime` FROM `$friendname` WHERE `id` > $mdata ORDER BY `id` ASC";
    if ($result = $conn->query($select)) { 
        while ($row = $result->fetch_assoc()) { 
            if ($row['place'] == 1) {
                $bef_chat1 = html_entity_decode($row['chat']);
                echo '<div align = "right" class = "right_message">';
                echo '<div class = "outer_right_message">';
                echo '<div class = "second_right_inner_class">';
                echo '<div class = "third_right_inner_class">';
                $chat1 = stripslashes($bef_chat1);                
                if ($row['sent'] === 0) { 
                echo '<div class = "inner_right_message" id = "unseen">';
                if (filter_var($chat1, FILTER_VALIDATE_URL)) {
                    echo '<a href= "'.$chat1.'">';
                    echo $chat1;
                    echo '</a>';
                }
                else {
                    echo $chat1;
                }
                echo '</div>';
            }
            else {
                echo '<div class = "inner_right_message">';
                if (filter_var($chat1, FILTER_VALIDATE_URL)) {
                        echo '<a href= "'.$chat1.'">';
                        echo $chat1;
                        echo '</a>';
                    }
                    else {
                        echo $chat1;
                    }
                echo '</div>';
            }
                echo '<div class = "time">';
                echo date("h:i a", strtotime($row['sendedtime']));
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            else {
                $bef_chat2 = html_entity_decode($row['chat']);
                echo '<div align = "left" class = "left_message">';
                echo '<div class = "outer_left_message">';
                echo '<div class = "second_left_inner_class">';
                echo '<div class = "third_left_inner_class">'; 
                $chat2 = stripslashes($bef_chat2);                               
                if ($row['sent'] == 0) { 
                    echo '<div class = "inner_left_message" id = "unseen">';
                    if (filter_var($chat2, FILTER_VALIDATE_URL)) {
                        echo '<a href= "'.$chat2.'">';
                        echo $chat2;
                        echo '</a>';
                    }
                    else {
                        echo $chat2;
                    }
                    echo '</div>';
                }
                else {
                    echo '<div class = "inner_left_message">';
                    if (filter_var($chat2, FILTER_VALIDATE_URL)) {
                        echo '<a href= "'.$chat2.'">';
                        echo $chat2;
                        echo '</a>';
                    }
                    else {
                        echo $chat2;
                    }  
                    echo '</div>';
                }
                echo '<div class = "time">';
                echo date("h:i a", strtotime($row['sendedtime']));
                echo '</div>';
                echo '</div>';                
                echo '</div>';
                echo '</div>';
                echo '</div>';                
            }
        }
        mysqli_free_result($result);
    }
    else {
        echo 'You have no conversation with him.';
    }
    $update = "UPDATE `$friendname` SET `sent` = 1 WHERE `sent` = 0";
$conn->query($update);
$conn->close();
?>