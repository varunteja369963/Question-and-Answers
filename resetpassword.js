//start: getting of the parameters from url in javascript;
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}
//end: getting of the parameters from url in javascript; 

$(document).ready(function(){
 var username = getParameterByName('username');
 var key = getParameterByName('key');
 var verificationcode = getParameterByName('verificationcode');
    $.ajax({
        type: 'GET',
        url: 'checkurl.php',
        data: {
          'username': username,
          'key': key,
          'verificationcode': verificationcode
        },
        success: function(bef_data) { 
           var output = $.trim(bef_data);
            if (output === '1') {
                window.location = "errorpage.html";
                var errormessage = encodeURIComponent(output);
        var path = encodeURIComponent('resetpassword.js/(sub)checkurl.php/error=2');
        $.post("senderror2.php", 
        {
         'errormessage': errormessage,
         'path': path  
    });
            }
            else if (output === '2') {

            }
            else {
                var errormessage = encodeURIComponent(output);
                var path = encodeURIComponent('resetpassword.js/(sub)checkurl.php/error=else');
                $.post("senderror2.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });
                window.location = "errorpage.html";
            }
        }
});
});

$(document).ready(function() {
    $("#submit").click(function(e){
        e.preventDefault();
        var username = getParameterByName('username');
        var key = getParameterByName('key');
        var verificationcode = getParameterByName('verificationcode');
        var password1 = $("#new_password").val();
        var password2 = $("#retype_new_password").val();
        if (password1 !== password2) { 
            $(".password_ack").html("");
            $(".password_ack").html("Your password and retype password is not matching.");
            return false;
        }
        else if (password1.length < 4 || password1.length > 30) {
            $(".password_ack").html("");
            $(".password_ack").html("Password length should be in between 4 and 30 characters");
            return false;
        }
        else {
            var password1_send = encodeURIComponent(password1);
            var password2_send = encodeURIComponent(password2);
        }

        $.ajax({
            type: 'POST',
            url: 'passwordupdate.php',
            data: {
                'username': username,
                'key': key,
                'verificationcode': verificationcode,
              'password1': password1_send,
              'password2': password2_send
            },
            success: function(bef_output) {
                var output = $.trim(bef_output);
                if (output === '1') {
                    var errormessage = encodeURIComponent(output);
                    var path = encodeURIComponent('resetpassword.js/(sub)passwordupdate.php/error=1');
                    $.post("senderror2.php", 
                    {
                     'errormessage': errormessage,
                     'path': path  
                });
                    alert("Please do not change any javascript code");
                    location.reload(true);
                } 
                else if (output === '2') {
                    alert("Your password is successfully reset.");
                    window.location = "loginform.html";
                }
                else {
                    var errormessage = encodeURIComponent(output);
                    var path = encodeURIComponent('resetpassword.js/(sub)passwordupdate.php/error=else');
                    $.post("senderror2.php", 
                    {
                     'errormessage': errormessage,
                     'path': path  
                });
                    alert("There is something problem. Please contact 7675807537 for futher details");
                    window.location = "loginform.html";
                }
            }
        });
    });
});