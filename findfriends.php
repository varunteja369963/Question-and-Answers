<?php
session_start();
  if (!isset($_SESSION['logged_in'])) {
    header('location: loginform.html');
     die();
   }
  include_once('connection.php');
 $select = "SELECT COUNT(*) AS count FROM `userslist`";
 $result = $conn->query($select);
 $row = $result->fetch_assoc();
 $total = $row['count'];
 mysqli_free_result($result);
 $conn->close();
 ?>
<html>
    <head>
        <title>find friends</title>
        <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale = 1.0">
    <meta name = "keywords" content = "making groups, asking doubts in group, learning, shareknowledge, chating">
    <meta name = "description" content = "Free web learning in groups and chatting">
    <meta name = "author" content = "M. Varun Teja(M.V.T)">
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
<script src = "findfriends.js" type = "text/javascript"></script>
    <link rel = "stylesheet" type = "text/css" href = "findfriends.css">

    <script type = "text/javascript">
    var start = 0;
    var end = 10;
    var total = '<?php echo $total;?>';
     $(document).ready(function(){
        $.ajax({
                url: 'suggestedfriends.php',
                type: 'POST',
                data: {
                    'start': start,
                    'end': end
                },
                success: function(output) 
                { 
                    var current = $("#suggested_friends").html();
                    $("#suggested_friends").html(current + output);
                    start = end + 1;
                    end = end + 10;
                }
            });   
    $("#show_more").click(function(){
    if (total <= end) {
        $("#button_div").remove();
    } 
   $.ajax({
                url: 'suggestedfriends.php',
                type: 'POST',
                data: {
                    'start': start,
                    'end': end
                },
                success: function(output) 
                { 
                    var current = $("#suggested_friends").html();
                    $("#suggested_friends").html(current + output);
                    start = end + 1;
                    end = end + 10;
                }
            });
 });
     });
        </script>
</head>
<body>
    <?php
       echo '<div class = "total_page">';
       echo '<div class = "searchbar">';
       echo '<input type = "text" class = "searchbox" id = "searchbox" onkeyup = "ajaxFunction(this.value)"
        placeholder = "search your friends"/>';
       echo '</div>';
       echo '<div class = "starting_div" id = "starting_div">';
       echo '<div class = "friend_request_div" id = "friend_request_div">';
       echo '</div>';
       echo '<div class = "line">';echo '</div>';
       echo '<div class = "suggested_friends" id = "suggested_friends">';
       echo '</div>';
       echo '<div class = "button_div" id = "button_div">';
       echo '<button type = "button" class = "show_more" id = "show_more">';
       echo 'show more';
       echo '</button>';
       echo '</div>';
       echo '</div>';

       echo '<div class = "displaybox" id = "displaybox" style = "display: none;">';
       echo '</div>';
    ?>
</body>
</html>