$(document).ready(function(){
    $('#submit').on('click', function (e) {
e.preventDefault();
var username = $("#username").val();
var gmail = $("#gmail").val();
if (username.length == 0 || username == "") {
    $("#username_ack").text("Please fill this field");
    $("#gmail_ack").text("");
    return false;
}

if (gmail.length == 0 || gmail == "") {
    $("#gmail_ack").text("Please fill this field");
    $("#username_ack").text("");
    return false;
}

if (username.length < 4 || username.length > 30) {
    $("#username_ack").text("Username should be in between 4-30 characters"); 
    $("#gmail_ack").text(""); 
    return false;
}


var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
if (!pattern.test(gmail)) {
    $("#gmail_ack").text("Please enter a valid gmail address");   
    return false;   
}

if(!/[^a-zA-Z0-9 ]/.test(username)) {
    var username = encodeURIComponent(username);
    var gmail = encodeURIComponent(gmail);
    $("#username_ack").text("");
    $.ajax({  
        type: 'POST', 
url: 'forgotmypassword.php', 
data: {
    'username': username,
    'gmail': gmail
},
success: function (bef_data) {
    data = $.trim(bef_data);
alert(data);
    if (data === '1') {
        $.ajax({
            type: 'POST', 
            url: 'resetpasswordmail.php', 
            data: {
                'username': username,
                'gmail': gmail
            },
            success: function (bef_data) {
                data = $.trim(bef_data);
                if (data === '1') {
                    window.location = 'confirmation.html';
                }
            else {
                var errormessage = encodeURIComponent(data);
                var path = encodeURIComponent('forgotmypassword.js/(sub)resetpasswordmail.php/error=else');
                $.post("senderror2.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });
             alert('There is something problem. Please try again later.'); 
             location.reload(true);
            }
            }
            });
    }
    else if (data === '2') {
    $("#gmail_ack").text("");   
        $("#username_ack").text("Your username is not matching with your gmail address.");   
    }
    else if (data === '3') {
    $("#username_ack").text("");   
    $("#gmail_ack").text("Your gmail address is not matching with your username.");   
    }
else {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('forgotmypassword.js/(sub)forgotmypassword.php/error=else');
    $.post("senderror2.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
 alert('There is something problem. Please try again later.'); 
 location.reload(true);
}
}
});  
}
else {
    $("#username_ack").text("Your username should not contain special characters like (ex:#$%*(!@\")");
    $("#gmail_ack").text("");
    return false;
}
});
 });
