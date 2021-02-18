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
  
//start: for checking url
$(document).ready(function(){
        var grpname = getParameterByName('name');
        if (grpname === null) {
            window.location = "loginform.html";
        }
        else {
            if (grpname.length !== 70) {
                window.location = "loginform.html";
            }
            else {
                $.ajax({
                    type: 'POST',
                    url: "securitynetwork.php", 
                    data: {'hashgroupname': grpname},
                    success: function(bef_data){
                        var data = $.trim(bef_data);
                   if (data == 1) {
                   window.location = "registerform.html";
                   }
                   else if (data == 2) {
                    var errormessage = encodeURIComponent(data);
                    var path = encodeURIComponent('personaldatabase.js/(sub)securitynetwork.php/error=2');
                    $.post("senderror.php", 
                    {
                     'errormessage': errormessage,
                     'path': path  
                });
                       alert("Sorry for interrupting you. Please login again to continue");
                       window.location = "loginform.html";
                   }
                   else if (data == 3) {
     
                   }
                   else {
                       alert("There is something wrong. Please contact 7675805437 for futher help");
                   }
                }
                });
            }
        }
     });
//end: for checking url

