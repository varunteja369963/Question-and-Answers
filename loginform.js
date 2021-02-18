
$(document).ready(function(){
    $.post("seemycookie.php",
    function(bef_data) {
        var data = $.trim(bef_data);
        if (data === '1') {
            window.location = "homepage.html";
        }
    }
    );
    $("#username").val("");
    $("#password").val("");
  $("#username").focus();
});

    $(document).ready(function(){
$("#register").click(function(){
    window.location = "registerform.html";
});
    });

    $(document).ready(function(){
           $('form').on('submit', function (e) {
e.preventDefault();
var username = $("#username").val();
var password = $("#password").val();
if (username == "" || username.length == 0) {
   $("#username-ack").text("Please fill this field.");
   $("#password-ack").text("");   
   return false;
} 

if (username.length < 4 || username.length > 30) {
    $("#username-ack").text("You have entered incorrect username.");
   $("#password-ack").text("");       
    return false;
 } 

if (/[^a-zA-Z0-9 ]/.test(username)) {
    $("#username-ack").text("You have entered incorrect username.");
   $("#password-ack").text("");       
    return false;
 } 

if (password.length == 0 || password == "") {
    $("#password-ack").text("Please fill this field.");
    $("#username-ack").text("");    
    return false;
}

$.ajax({
  type: 'POST', 
  url: 'loginform.php', 
  data: $('#form').serialize(),
  success: function (bef_data) {
      $(".loader").css("display", "block");
      $(".loginform").css("opacity", "0.2");
     var data = $.trim(bef_data);
    $("#username-ack").text(""); 
    $("#password-ack").text("");          
    if (data === '1'){
        var errormessage = encodeURIComponent(data);
        var path = encodeURIComponent('loginform.js/(sub)loginform.php/error=1');
        $.post("senderror2.php", 
        {
         'errormessage': errormessage,
         'path': path  
    });
        alert("Please do not change any javascript code or html code.");
        location.reload(true);
    }
    else if (data === '2'){
        $(".loader").css("display", "none");
        $(".loginform").css("opacity", "1");
        $("#username-ack").text("You have entered incorrect username.");
    $("#password-ack").text("");               
    }
    else if (data === '3'){ 
        $(".loader").css("display", "none");
        $(".loginform").css("opacity", "1");      
    $("#password-ack").text("You have entered incorrect password.");  
    $("#username-ack").text("");         
    }
    else if (data === '4'){
        $.post("setcookies.php", 
        function(bef_data) {
            var data = $.trim(bef_data);
            if (data === '1') {
                window.location = "homepage.html";
            }
            else {
                var errormessage = encodeURIComponent(data);
                var path = encodeURIComponent('loginform.js/(sub)setcookies.php/error=1');
                $.post("senderror2.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });
            }
        });      
}
    else if (data === '5') {
        window.location = "loginform.html";
    }
    else {
        var errormessage = encodeURIComponent(data);
        var path = encodeURIComponent('loginform.js/(sub)loginform.php/error=else');
        $.post("senderror2.php", 
        {
         'errormessage': errormessage,
         'path': path  
    });
        alert('There is something problem. Please contact 9640096621 for futher help.');
        location.reload(true);
    }
  }
});
});
        });
   
 