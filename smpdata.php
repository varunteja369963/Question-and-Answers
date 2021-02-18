<html>
<head>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
      <link href = "personaldatabase.css" rel = "stylesheet" type = "text/css"/>
</head>
<body>
<div class = "total_page">
<?php 
    session_start();
    #connecting database
    include_once('connection.php');
$select_quote = $conn->prepare("SELECT `hashusername`, `gmail`, `quote`, `points`, `smppoints`, `profileaddr` FROM `userslist` WHERE `username` = ?");
$select_quote->bind_param("s", $_SESSION['username']);
$select_quote->execute();
$result_quote = $select_quote->get_result();
if ($result_quote->num_rows != 1) {
    mysqli_free_result($result_quote);
    header('location: loginform.php');
}
else {
    $row_quote = $result_quote->fetch_assoc();
    $quote = $row_quote['quote'];
    $total_points = (int)$row_quote['points'];
    $cz0x8h = $row_quote['hashusername'];
    $gmail = $row_quote['gmail'];
    $points_in_smp = $row_quote['smppoints'];
$imagesrc = $row_quote['profileaddr'];

mysqli_free_result($result_quote);    
}

if ($quote == NULL) {
    $last_quote = '......';
}
else {
    $last_quote = stripslashes($quote);
}

    $my_db = 'solvemyproblem';
mysqli_select_db($conn, $my_db);

echo '<div class = "top_page">';

echo '<div class = "user_profile_info2">';
echo '<center>';
echo '<div id = "profile_pic2" class = "profile_pic2">';
if ($imagesrc == NULL) {

}
else { 
echo '<img src = "'.$imagesrc.'" width = "100%" height = "100%" id = "picture">';
}
echo '</div>';
echo '</center>';
echo '</div>';

echo '<div class = "user_infos2">';
echo '<div class = "my_info2">';
echo '<div class = "my_name" id = "my_name" data-cz0x8h = "'.$cz0x8h.'">';
$my_name = $_SESSION['username'];
echo $my_name;
echo '</div>';
echo '<div class = "gmail">';
echo $gmail;
echo '</div>';
echo '<div id = "quote" class = "quote">';
echo $last_quote;
echo '</div>';

echo '<div class = "points">';
echo '<div class = "points_inner">';
echo '<div class = "points_in_this_group" title = "points earned in solve my problem" style = "display: flex;">';
echo '<span class = "badge">';echo '</span>';
echo '<span class = "points1">';
echo $points_in_smp;
echo '</span>';
echo '</div>';
echo '<div class = "total_points" title = "Total points you earned" style = "display: flex;">';
echo '<span class = "heart">';echo '</span>';
echo '<span class = "points2">';
echo $total_points;
echo '</span>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';

echo '<div class = "user_response">';
echo '<div class = "personal_data_page">';
echo '<div class = "questions_display">';
$created_db3 = $_SESSION['database'];
mysqli_select_db ($conn, $created_db3);

echo '<div class = "your_questions">';
echo 'questions asked in this group';
echo '</div>';
$select2 = "SELECT `precisequestion`, `uuid`, `points` FROM `smpquestions` ORDER BY id DESC";
if ($result2 = $conn->query($select2)) { 
echo '<div class = "questions_list">';
while ($row2 = $result2->fetch_assoc()) {
    echo '<div class = "question_info">';
    echo '<div class = "question_points">';
    echo $row2['points'];
    echo '</div>';
    echo '<div class = "asked_questions">';
    echo '<a id = "question_link" href = "displayresult.php?uuid='.$row2['uuid'].'">';
    echo stripslashes($row2['precisequestion']);
    echo '</a>';
    echo '</div>';
    echo '</div>';
}
mysqli_free_result($result2);    
echo '</div>';
}
echo '</div>';

echo '<div class = "answers_display">';

echo '<div class = "your_answers">';
echo 'Your contribution to this group';
echo '</div>';
$select3 = "SELECT `precisequestion`, `uuid` FROM `smpanswers` ORDER BY id DESC";
if ($result3 = $conn->query($select3)) { 
echo '<div class = "answers_list">';
while ($row3 = $result3->fetch_assoc()) {
    echo '<div class = "answer_info">';
    echo '<div class = "asked_answers">';
    echo '<a id = "answer_link" href = "displayresult.php?uuid='.$row3['uuid'].'">';
    echo stripslashes($row3['precisequestion']);
    echo '</a>';
    echo '</div>';
    echo '</div>';
}
mysqli_free_result($result3);    
echo '</div>';
}
echo '</div>';
echo '</div>';
$conn->close();
?>
</div>
</body>
</html>