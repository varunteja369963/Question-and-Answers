<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header("location: loginform.html");
    die();
}
if ($_SESSION['logged_in'] != true) {
  header("location: loginform.html");
  die();
}
  $friendid = $_GET['id'];
  $friendname = $_GET['username']; 
  include_once('connection1.php');
  $select_unseen = "SELECT COUNT(*) AS count FROM `$friendname` WHERE `sent` = 0";
  $result_unseen = $conn->query($select_unseen);
  $row_unseen = $result_unseen->fetch_assoc();
  $unseen = $row_unseen['count'];
  if ($unseen != 0) {
      $accept = true;
  }
  else {
      $accept = false;
  }
  mysqli_free_result($result_unseen); 
  $conn->close();
 ?>

<html>
   <head>
<script>
var mdata;
$(document).ready(function(){
 var friendname = '<?php echo $friendname;?>';
 var accept = '<?php echo $accept;?>';
$("#message").focus();
$.ajax({
   type: 'POST',
   url: 'countmessages.php',
   data: {
       'friendname': friendname
   },
   success: function(data) {
     if (data <= 50) {
mdata = 0;
     } 
     else {
         mdata = data - 50;
     }
     $("#displaymessages").load("displaymessages.php?friendname=" + friendname + "&data=" + mdata,function(){ 
         if (accept) {
$('#displaymessages').scrollTop($("#displaymessages #unseen:nth-child(1)").position().top);             
         }
         else {
            $("#displaymessages").animate({ scrollTop: $('#displaymessages').prop("scrollHeight")}, 50);
         }
});  
   }
});
});
</script>

<script>
     $(document).ready(function(){  
         var xdata;      
     var friendname = '<?php echo $friendname;?>';
         var container = $("#displaymessages");
     setInterval(function(){ 
         xdata = mdata;         
         if (container[0].scrollHeight - (container[0].scrollTop + container[0].clientHeight) == 0) {
             $("#displaymessages").load("displaymessages.php?friendname=" + friendname + "&data=" + xdata);
 $("#displaymessages").animate({ scrollTop: $('#displaymessages').prop("scrollHeight")}, 1000);
 }
         else { 
             $("#displaymessages").load("displaymessages.php?friendname=" + friendname + "&data=" + xdata);              
         }
  }, 2000);            
     }); 
     </script>

<script>
 $(document).ready(function(){
     $(document).on('click', "#send_message", function(e){
         e.preventDefault();
         var before_msg1 = $("#message").val().replace(/\s+$/,'');
         if(/^\s+$/.test(before_msg1) || before_msg1 == '') {
             alert("not sent");
             return false;
         }
         var before_msg2 = $.trim(before_msg1.replace(/[" "]/g, "&nbsp;"));
         var before_msg3 = before_msg2.replace(/(\r\n|\n|\r)/g, "<br>");
         var msg = encodeURIComponent(before_msg3);
         var friendname = '<?php echo $friendname;?>';
         var ydata;
         $.ajax({
             url: 'adddata.php',
            type: 'POST',
             data: {
                 'msg': msg,
                 'friendname': friendname
             }
         }).done(function(){
             ydata = mdata;
             $("#displaymessages").load("displaymessages.php?friendname=" + friendname + "&data=" + ydata); 
 $("#displaymessages").animate({ scrollTop: $('#displaymessages').prop("scrollHeight")}, 1000);                
$("#message").css({"height": "27px", "bottom": "0px", "margin-top": "32px"});
             $("#message").val("");
             $("#message").focus();
             $("#send_message").css("display", "none");                

         });
     });
 });
 </script>

<script>
 $(document).ready(function(){
    var friendname = '<?php echo $friendname;?>';
    var container = $("#displaymessages"); 
 $(container).scroll(function(){ 
if (container[0].scrollTop == 0) {
  mdata = mdata-20;
  if (mdata < -20) {
      return false;
  }
  else {
     $("#displaymessages").load("displaymessages.php?friendname=" + friendname + "&data=" + mdata, function(){ 
$('#displaymessages').scrollTop($("#displaymessages div:nth-child(20)").position().top);
});
}
}
});
 });
 </script>

<script>
 $(document).ready(function(){
     $("#message").on('input', function() {
         var con = $.trim($("#message").val());
         if (con !== "") {
             $("#send_message").css("display", "block");
         }
         else {
             $("#send_message").css("display", "none");                
         }
 var scroll_height = $("#message").get(0).scrollHeight;
 if (60-scroll_height >= 0) { 
 $("#message").css('margin-top', 60-(scroll_height + 3) + 'px');
 }
 $("#message").css('height', scroll_height + 'px');
});
 });
</script>

<script>
    $(document).ready(function(){
        $(document).on("click", "#delete_button", function() {
            var result = confirm("Do you want to delete all messages?");
            if (result) {
        var friendname = '<?php echo $friendname;?>';
            $.post("truncate.php",
    {
        'friendname': friendname
    });
}
else {
    return false;
}
        });    
    });
    </script>
</head>

<body>
<div id = "total_message">
<div id = "user_profile" class = "user_profile">
    <ul>
        <il>
    <span id = "delete" class = "delete">
       <div id = "delete_button" class="trash-solid icon"></div>
</span>
</il>
<il>
<span id = "close" class = "close">
    <button type = "button" class = "close_button" id = "close_button">x</button>
</span>
</il>
</ul>
</div>
 <div id = "displaymessages" class = "displaymessages">

</div>

    <div id = "messagebox">
        <div id = "div_to_text">
            <div id = "for_texting">
    <textarea  placeholder = 'type message here...' name = "message" id = "message" rows = "1" class = "message"></textarea>
</div>

    <div id = "for_submitting">
        <div class="navigate-solid icon" id = "send_message" style = "display: none;"></div>
 </div>
</div>
</div>

</div>
</body>
</html>
