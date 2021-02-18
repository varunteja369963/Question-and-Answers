$(document).ready(function(){
$("#username").focus();
$("#username").val("");
$("#password1").val("");
$("#password2").val("");
$("#gmail").val("");
$.post("lastinsertedid.php",
function(bef_data) {
    var data = $.trim(bef_data);
    if (data === '1') {
        var errormessage = encodeURIComponent(data);
        var path = encodeURIComponent('registerform.js/(sub)lastinsertedid.php/error=1');
        $.post("senderror2.php", 
        {
         'errormessage': errormessage,
         'path': path  
    });
        alert("Sorry! we have closed our registration count. Please try again later");
        window.location = "loginform.html";
    }
    else {       
    return false;
    }
});
});

$(document).ready(function(){
    $('#register_the_details').on('click', function (e) {
e.preventDefault();
var username = $.trim($("#username").val());
var password1 = $("#password1").val();
var password2 = $("#password2").val();
var gmail = $.trim($("#gmail").val());

if (username.length == 0 || username == "") {
    $("#username_ack").text("Please fill this field");
    $("#password1_ack").text("");
    $("#password2_ack").text(""); 
    $("#gmail_ack").text("");
    return false;
}

if (password1.length == 0 || password1 == "") {
    $("#password1_ack").text("Please fill this field");
    $("#username_ack").text("");    
    $("#password2_ack").text(""); 
    $("#gmail_ack").text("");
    return false;
}

if (password2.length == 0 || password2 == "") {
    $("#password2_ack").text("Please fill this field");
    $("#username_ack").text("");    
    $("#password1_ack").text(""); 
    $("#gmail_ack").text("");
    return false;
}

if (gmail.length == 0 || gmail == "") {
    $("#gmail_ack").text("Please fill this field");
    $("#username_ack").text("");
    $("#password1_ack").text("");
    $("#password2_ack").text(""); 
    return false;
}

if (username.length < 4 || username.length > 30) {
    $("#username_ack").text("Username should be in between 4-30 characters");
    $("#password1_ack").text("");
    $("#password2_ack").text(""); 
    $("#gmail_ack").text(""); 
    return false;
}

if (password1.length < 4 || password1.length > 30) {
    $("#username_ack").text("");
    $("#gmail_ack").text("");     
    $("#password1_ack").text("Password should be in between 4-30 characters");
    $("#password2_ack").text("Password should be in between 4-30 characters"); 
    return false;
}

var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
if (!pattern.test(gmail)) {
    $("#gmail_ack").text("Please enter a valid gmail address");   
    return false;   
}

if(!/[^a-zA-Z0-9 ]/.test(username)) {
    $("#username_ack").text(""); 
if (password1 === password2) {
    $("#password1_ack").text("");
    $("#password2_ack").text(""); 
    
    var username_encoded = encodeURIComponent(username);
    var password1_encoded = encodeURIComponent(password1);
    var password2_encoded = encodeURIComponent(password2);
    var gmail_encoded = encodeURIComponent(gmail);
    
    $.post("registerform.php", 
    {
    'username': username_encoded,
    'password1': password1_encoded,
    'password2': password2_encoded,
    'gmail': gmail_encoded
    },
    function(bef_data){
       data = $.trim(bef_data);
        if (data === '1') {
            alert('Please do not change any javascript or html code');      
            location.reload(true);
        }
    else if (data === '2'){
        $("#password1_ack").text("");
        $("#password2_ack").text(""); 
        $("#gmail_ack").text("");
        $("#username_ack").text("Someone already used this username. Please go for another username.");
        return false;
    }
    else if (data === '3'){
        $("#username_ack").text("");    
        $("#password1_ack").text("");
        $("#password2_ack").text(""); 
        $("#gmail_ack").text("Someone already used this gmail address. You cannot use this gmail address.");
        return false;        
       }
       else if (data === '4'){
        $.post("activateaccount.php", 
             {
                'username': username_encoded,
                'password1': password1_encoded,
                'gmail': gmail_encoded
            },
          function (bef_data2) {
              var data2 = $.trim(bef_data2);
                if (data2 === '1') {
                    $(".registerform").css("display", "none");
                    $(".confirmation_outer").css("display", "block"); 
                }
            else {
             alert('There is something problem. Please try again later.'); 
             location.reload(true);
            }
            });
       }
       else if (data === '5'){
        alert('sorry your data has not entered into our database due to some reasons. Please contact 9640096621 for futher help.');    
        location.reload(true);
       }
       else if (data === '6') {
           location.reload(true);
       }
    else {
     alert('There is something wrong. Please contact to 7675805324 for futher help.'); 
     location.reload(true);
    }
    }
    );
}
else {
    $("#password1_ack").text("Your Password and Re-type Password didn't match. Try again.");
    $("#password2_ack").text("Your Password and Re-type Password didn't match. Try again.");
    $("#username_ack").text("");
    $("#gmail_ack").text("");  
    return false;
}
}
else {
    $("#username_ack").text("Your username should not contain any special characters like (ex:#$%*(!@\")");
    $("#password1_ack").text("");
    $("#password2_ack").text(""); 
    $("#gmail_ack").text("");
    return false;
}
});
 });
