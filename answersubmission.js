function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

//start: getting answer data
var axiy23ksic = false;
$(document).ready(function(){
        $(document).on('click', '#edit_answer', function(){
            var iaZs23kiclDei92A = $(this).data('iazs23kicldei92a');
            var questionid = getParameterByName('uuid');
         $.ajax({
           type: 'POST',
             url: 'getanswerdata2.php',
             data: {
               'questionid': questionid,
               'iaZs23kiclDei92A': iaZs23kiclDei92A
             },
             success: function(data) {
                if (data === '1') {
                    window.location = "loginform.html";
                }
                else if (data === '2') {
                    alert("Sorry you can't edit this answer.");
                    location.reload(true);
                }
                else {
                        axiy23ksic = true;
                   $("#wysiwyg").contents().find("body").html(data);
                   $("#submit_button").html('Update Answer'); 
                   $("#submit_button").attr("class", iaZs23kiclDei92A);                    
                   $('html, body').animate({
                        scrollTop: $(document).height()
                    }, 1000); 
                }
             }
         });
        });
       });
       //end: getting answer data

       
       $(document).ready(function(){
        $("#submit_button").click(function(e) {
         e.preventDefault();
 if (!axiy23ksic) {
         var myIFrame = document.getElementById("wysiwyg");
         var send_answer1 = myIFrame.contentWindow.document.body.innerHTML;
         var send_answer2 = send_answer1.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, "<br>");
         var send_answer = encodeURIComponent(send_answer2);
         var send_questionid = getParameterByName('uuid');                        
         if (send_answer.length <= 100) {
                 alert("You have not specified the proper answer");
                 return false;
         }
            $.ajax({
                    type: "POST",
                    url: "answersubmission.php",
                    data: {
                         'question_uuid': send_questionid,
                            'answer': send_answer,
                    }, 
                    success: function(bef_data){
                            var data = $.trim(bef_data);
                            
                         if (data === '1') {
                                 alert("Successfully posted your answer");
                                 location.reload();
                         }
                         else if (data === '2') {
                                 var accept = confirm("You need to sign in to answer this question.");
                                 if (accept) { 
                                 window.location = "loginform.html";
                                 }
                                 else {
                                         return false;
                                 }
                         }
                         else {
                                var errormessage = encodeURIComponent(data);
                                var path = encodeURIComponent('answersubmission.js/(sub)answersubmission.php/error=else');
                                $.post("senderror.php", 
                                {
                                 'errormessage': errormessage,
                                 'path': path  
                            });
                                 alert("Unsuccessfull due to some reason");
                                 location.reload(true);                                 
                         }
                    }
            });
         }
 else {
       
         var myIFrame = document.getElementById("wysiwyg");                        
         var send_answer1 = myIFrame.contentWindow.document.body.innerHTML;
         var send_answer2 = send_answer1.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, "<br>");
         var send_answer = encodeURIComponent(send_answer2);
         var send_questionid = getParameterByName('uuid');                        
         if (send_answer.length <= 100) {
                 alert("You have not specified the proper answer");
                 return false;
         }
         var iaZs23kiclDei = $(this).attr('class');
         $.ajax({
                 type: "POST",
                 url: "updatinganswer2.php",
                 data: {
                      'question_id': send_questionid,
                         'answer': send_answer,
                         'iaZs23kiclDei92A': iaZs23kiclDei
                 }, 
                 success: function(data){
                      if (data === '1') { 
                   alert("Sorry you cann't update this answer.");
                   location.reload(true);
                 }
                 else if(data === '2') {
                         window.location = "loginform.html";
                 }
                 else if (data === '3') {
                         $(".answers").each(function(){
                                 $(this).find('.'+iaZs23kiclDei).html(send_answer2);
                             });
                    $("html, body").animate({
                     scrollTop: $("."+iaZs23kiclDei).position().top - 100
                    }, 1000);
                    $("#wysiwyg").contents().find("body").html("<div></div>");
                    $("#submit_button").html('Answer this question');
                    $("#submit_button").removeAttr('class'); 
                    axiy23ksic = false;                                                                      
                 }
                 else {
                        var errormessage = encodeURIComponent(data);
                        var path = encodeURIComponent('answersubmission.js/(sub)updatinganswer2.php/error=else');
                        $.post("senderror.php", 
                        {
                         'errormessage': errormessage,
                         'path': path  
                    });
                         alert("There is something problem. Please contact 9640096621 for futher details");
                         location.reload(true);
                 }
         }
 });
}
});
});
