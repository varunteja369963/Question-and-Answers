/*$(document).ready(function(){
           $.ajax({
               type: 'POST',
               url: "securitynetwork2.php", 
               success: function(bef_data){
                   var data = $.trim(bef_data);
              if (data === '1') {
              window.location = "loginform.html";
              }
              else if (data === '2') {
              }
              else {
                var errormessage = encodeURIComponent(data);
                var path = encodeURIComponent('solvemyproblemquestions.js/(sub)securitynetwork2.php/error=else');
                $.post("senderror.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });
                  alert("There is something wrong. Please contact 7675805437 for futher help");
              }
           }
        });
});*/