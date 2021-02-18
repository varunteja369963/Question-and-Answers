<html>
<head>
<title>sabiduria-admin login</title>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
<style>
body {
 margin: 0px;
}

.border {
    width: 100%;
    margin-left: 5%;
left: 0;
border: 2px solid #000000;
border-radius: 10px;
margin: 40px 0px;
padding: 10px;
position: relative;
}

.line {
 border-bottom: 1px solid #b2beb5;
 width: 95%;
 margin: 10px 0px;
}

.outer_gmail {
    word-break: break-all;
}

.outer_errorpath {
    word-break: break-all;
}

.errormessage {
    word-wrap: break-word;
}

label {
    font-size: 20px;
}

.delete_button {
    background-color: #FF0000;
    border: none;
    color: #fff;
    height: 25px;
    border-radius: 5px;
    font-weight: 600;
    position: absolute;
    right: 20;
    cursor: pointer;
}

.pages {
    position: relative;
    top: 10px;
}

.total_users {
 background-color: #9ACD32;
 border-radius: 5px;
 border: none;
 margin-top: 20px;
 color: #fff;
 height: 40px;
 width: 60px;
 position: absolute;
 left: 20px;
 font-weight: 600;
 cursor: pointer;
}

.waiting_list {
    background-color: #9ACD32;
 border-radius: 5px;
 border: none;
 margin-top: 20px;
 color: #fff;
 height: 40px;
 width: 60px;
 padding-left: 2px;
 left: 90px;
 position: absolute;
 font-weight: 600; 
 cursor: pointer;
}

.firstpage {
    position: absolute;
    right: 70px;
    background-color: #9ACD32;
    font-weight: 600;
    font-size: 18px;
    border-radius: 50%;
    color: #fff;
    width: 40px;
    height: 40px;
    top: 20px;
border: none;
cursor: pointer;
}

.secondpage {
    position: absolute;
    right: 20px;
    background-color: #9ACD32;
    color: #fff;
    font-weight: 600;
    font-size: 18px;
    border-radius: 50%;
    border: none;
    width: 40px;
    height: 40px;
    top: 20px;
    cursor: pointer;
}

.totalusers {
    top: 100px;
    position: relative;
}

.totaltable {
 width: 90%;
 border-collapse: collapse;
}

.totaltable td, .totaltable th {
    border: 1px solid #ddd;
    padding: 8px;
}

.totaltable tr:nth-child(even){background-color: #f2f2f2;}

.totaltable th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #0084b4;
    color: white;
}

.confirmusers {
    top: 100px;
    position: relative;
}

.first_page {
    position: relative;
    top: 100px;
    width: 85%;
    padding-left: 5%;
    padding-right: 10%;
}

.second_page {
    position: relative;
    top: 100px;
    width: 85%;
    padding-left: 5%;
    padding-right: 10%;
}

@media screen and (min-width: 270px) { 
    .previous {
    display: none;
}

.next {
    display: none;
}
}

@media screen and (max-width: 269px) {
.previous {
    display: block;
    position: absolute;
    left: 5px;
    background-color: #fff;
    border: none;
    font-weight: 600;
    font-size: 18px;
    margin-top: 25px;
    cursor: pointer;
}

.next {
    display: block;
    position: absolute;
    right: 5px;
    border: none;
    font-weight: 600;
    background-color: #fff;
    font-size: 18px;
    margin-top: 25px;
    cursor: pointer;
}

.total_users {
   margin-left: 18px;
   display: none;
}

.waiting_list {
   margin-left: 13px;
   display: none;

}

.firstpage {
    left: 50px;
}

.secondpage {
    left: 110px;
}
}
</style>

<script>
$(document).ready(function(){
    $(".delete_button").click(function(e){
e.preventDefault();
var id = $(this).attr('id');
$.get("deleteerrormessage.php",
{
   'id': id
},
function(bef_data) {
    var data = bef_data;
    if (data === '1') {
        location.reload(true);
    }
    else {
alert(data);
    }
});
    });
});
</script>

<script>
    $(document).ready(function(){
       do { 
           var pass = true;
           var securecode;
        
        secure_code = prompt("Please enter a secure code:");
       if (secure_code === 'water988') { 
        $(".first_page").css({"display": "block"});
          $(".firstpage").css({"background-color": "#FF0000"});
        $(".firstpage").click(function(){
            $(".first_page").css({"display": "block"});
$(".second_page").css({"display": "none"});
$(".totalusers").css({"display": "none"});    
$(".confirmusers").css({"display": "none"});

$(".firstpage").css({"background-color": "#FF0000"});
$(".secondpage").css({"background-color": "#9ACD32"});
$(".total_users").css({"background-color": "#9ACD32"});
$(".waiting_list").css({"background-color": "#9ACD32"});
        });

        $(".secondpage").click(function(){
            $(".first_page").css({"display": "none"});
$(".second_page").css({"display": "block"});
$(".totalusers").css({"display": "none"});    
$(".confirmusers").css({"display": "none"});

$(".firstpage").css({"background-color": "#9ACD32"});
$(".secondpage").css({"background-color": "#FF0000"});
$(".total_users").css({"background-color": "#9ACD32"});
$(".waiting_list").css({"background-color": "#9ACD32"});
        });

        $(".total_users").click(function(){
            $(".first_page").css({"display": "none"});
$(".second_page").css({"display": "none"});
$(".totalusers").css({"display": "block"});    
$(".confirmusers").css({"display": "none"});

$(".firstpage").css({"background-color": "#9ACD32"});
$(".secondpage").css({"background-color": "#9ACD32"});
$(".total_users").css({"background-color": "#FF0000"});
$(".waiting_list").css({"background-color": "#9ACD32"});
        });

          $(".waiting_list").click(function(){
            $(".first_page").css({"display": "none"});
$(".second_page").css({"display": "none"});
$(".totalusers").css({"display": "none"});    
$(".confirmusers").css({"display": "block"});

$(".firstpage").css({"background-color": "#9ACD32"});
$(".secondpage").css({"background-color": "#9ACD32"});
$(".total_users").css({"background-color": "#9ACD32"});
$(".waiting_list").css({"background-color": "#FF0000"});
        });

$(".previous").click(function(){
    $(".firstpage").css({"display": "block"});
    $(".secondpage").css({"display": "block"});
    $(".total_users").css({"display": "none"});
    $(".waiting_list").css({"display": "none"});
});

$(".next").click(function(){
    $(".firstpage").css({"display": "none"});
    $(".secondpage").css({"display": "none"});
    $(".total_users").css({"display": "block"});
    $(".waiting_list").css({"display": "block"});
});

       } else {
       }
       } while(secure_code !== 'water988');
    });
    </script>
</head>

<body>
<div class = "total_page">

<div class = "pages">
    <button type = "button" class = "previous"><-</button>
    <button type = "button" class = "total_users">Total Users</button>
    <button type = "button" class = "waiting_list">Waiting List</button>
 <button type = "button" class = "firstpage">1</button>
 <button type = "button" class = "secondpage">2</button>
 <button type = "button" class = "next">-></button>
  </div>

<div class = "totalusers" style = "display: none">
<?php
include_once('connection.php');
$select = "SELECT `id`, `username`, `gmail` FROM `userslist`";
$result = $conn->query($select);
echo '<center>';
if ($result->num_rows > 0) { 
echo '<table class = "totaltable">';

echo '<tr>';
echo '<th>';
echo 'id';
echo '</th>';
echo '<th>';
echo 'username';
echo '</th>';
echo '<th>';
echo 'gmail';
echo '</th>';
echo '</tr>';

while($row = $result->fetch_assoc()) {

echo '<tr>';
echo '<td>';
echo $row['id'];
echo '</td>';
echo '<td>';
echo $row['username'];
echo '</td>';
echo '<td>';
echo $row['gmail'];
echo '</td>';
echo '</tr>';
}
echo '</table>';
}
else { 
echo '<h1>';
echo 'NO RECORDS FOUND';
ECHO '</h1>';
}
echo '</center>';
?>
</div>


<div class = "confirmusers" style = "display: none">
<?php
echo '<center>';
$select2 = "SELECT `id`, `username`, `gmail` FROM `confirmuser`";
$result2 = $conn->query($select2);
if ($result2->num_rows > 0) { 
echo '<table class = "totaltable">';

echo '<tr>';
echo '<th>';
echo 'id';
echo '</th>';
echo '<th>';
echo 'username';
echo '</th>';
echo '<th>';
echo 'gmail';
echo '</th>';
echo '</tr>';

while($row2 = $result2->fetch_assoc()) {

echo '<tr>';
echo '<td>';
echo $row2['id'];
echo '</td>';
echo '<td>';
echo $row2['username'];
echo '</td>';
echo '<td>';
echo $row2['gmail'];
echo '</td>';
echo '</tr>';
}
echo '</table>';
}
else {
    echo '<h1>';
    echo 'NO RECORDS FOUND';
    ECHO '</h1>';
}
echo '</center>';
$conn->close();
?>
</div>

  <div class = "first_page"  style = "display: none">

<?php
include_once('connection2.php');
$select = "SELECT * FROM `errorlogs` ORDER BY `id` DESC";
$result = $conn->query($select);
if ($result->num_rows > 0) { 
echo '<div class = "total_sub_page">';
while($row = $result->fetch_assoc()) {
  echo '<div class = "border">';

  echo '<div class = "delete_div">';
  echo '<button type = "button" id = "'.$row['id'].'" class = "delete_button">';
  echo 'delete';
  echo '</button>';
  echo '</div>';
echo '<br/>';
echo '<br/>';

  echo '<div class = "outer_username" style = "margin-top: 20px;">';
 echo '<b>';
 echo '<label for = "username">Username: </label>';
 echo '</b>';
 echo '<span class = "username">';
 echo $row['username'];
 echo '</span>';
 echo '<div class = "line"></div>';
 echo '</div>';

 echo '<div class = "outer_gmail" style = "">';
 echo '<b>';
 echo '<label for = "gmail">GMail: </label>';
 echo '</b>';
 echo '<span class = "gmail">';
 echo $row['gmail'];
 echo '</span>';
 echo '<div class = "line"></div>';
 echo '</div>';

 echo '<div class = "outer_errorpath" style = "">';
 echo '<b>';
 echo '<label for = "errorpath">Error Path: </label>';
 echo '</b>';
 echo '<span class = "erorpath">';
 echo $row['errorpath'];
 echo '</span>';
 echo '<div class = "line"></div>';
 echo '</div>';

 echo '<div class = "outer_errormessage" style = "">';
 echo '<b>';
 echo '<label for = "errormessage">Error Message: </label>';
 echo '</b>';
 echo '<span class = "errormessage">';
 echo $row['errormessage'];
 echo '</span>';
 echo '<div class = "line"></div>';
 echo '</div>';

 echo '<div class = "outer_time">';
 echo '<b>';
 echo '<label for = "time">time: </label>';
 echo '</b>';
 echo '<span class = "time">';
 echo date("d-m-Y h:i:s", strtotime($row['gotdate']));
 echo '</span>';
 echo '<div class = "line"></div>';
 echo '</div>';

  echo '</div>';

}
echo '</div>';
}
else {
    echo '<h1>';
    echo '<center>';
    echo 'NO RECORDS FOUND';
    echo '</center>';
    echo '</h1>';
}
$conn->close();
?>
</div>

<div class = "second_page" style = "display: none">
<?php
require "connection2.php";
$select = "SELECT * FROM `errorlogs2` ORDER BY `id` DESC";
$result = $conn->query($select);
if ($result->num_rows > 0) { 
echo '<div class = "total_sub_page">';

while($row = $result->fetch_assoc()) {
  echo '<div class = "border">';

  echo '<div class = "delete_div">';
  echo '<button type = "button" id = "'.$row['id'].'" class = "delete_button">';
  echo 'delete';
  echo '</button>';
  echo '</div>';
echo '<br/>';

 echo '<div class = "outer_errorpath" style = "">';
 echo '<b>';
 echo '<label for = "errorpath">Error Path: </label>';
 echo '</b>';
 echo '<span class = "erorpath">';
 echo $row['errorpath'];
 echo '</span>';
 echo '<div class = "line"></div>';
 echo '</div>';

 echo '<div class = "outer_errormessage" style = "">';
 echo '<b>';
 echo '<label for = "errormessage">Error Message: </label>';
 echo '</b>';
 echo '<span class = "errormessage">';
 echo $row['errormessage'];
 echo '</span>';
 echo '<div class = "line"></div>';
 echo '</div>';

 echo '<div class = "outer_time">';
 echo '<b>';
 echo '<label for = "time">time: </label>';
 echo '</b>';
 echo '<span class = "time">';
 echo date("d-m-Y h:i:s", strtotime($row['gotdate']));
 echo '</span>';
 echo '<div class = "line"></div>';
 echo '</div>';

  echo '</div>';

}
echo '</div>';
}
else {
    echo '<center>';
    echo '<h1>';
    echo 'NO RECORDS FOUND';
    ECHO '</h1>';
    echo '</center>';
}
$conn->close();
?>
</div>
</div>
</body>
</html>