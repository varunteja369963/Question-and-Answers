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
            var path = encodeURIComponent('groupfrontpage.js/(sub)securitynetwork2.php/error=else');
            $.post("senderror.php", 
            {
             'errormessage': errormessage,
             'path': path  
        });
               alert("There is something wrong. Please contact 9640096621 for futher help");
               window.location = "loginform.html";
           }
        }
     });
    });
    
     $(document).ready(function(){
        $("#back_button").click(function(){
          window.history.go(-1);
        });
      });
     
       $(document).ready(function(){
             $("#home_button").click(function(){
                 window.location = "groupfrontpage.php";
             });
     });
    
 
 //start: displaying related questions and number of characters after specific box;
 function specific(befstr){
    $(document).ready(function(){     
     count = 100;
     length = befstr.length;
     count = count - length;
  $("#count").text(count + " characters left");
    });

    var str = encodeURIComponent(befstr);
        if (str.length <= 10) { 
        document.getElementById("related_questions").innerHTML = "";
       return false;
    }
    else {
        var ajaxRequest;
        try {
            ajaxRequest = new XMLHttpRequest();
        }
        catch(e){
            try{
            ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch(e) {
            try { 
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(e) {
            alert ("your browser broke!");
            return false;
        }
        }
    }
        ajaxRequest.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200){
               document.getElementById("related_questions").innerHTML = this.responseText;
            }
        };
        ajaxRequest.open("GET", "groupsearchlinkedlist5.php?q=" + str, true);
        ajaxRequest.send();
    }  
  }
//end: displaying related questions and number of characters after specific box;

        var tagvalue = false;
        function tagsclicked() { 
             $(document).ready(function() {
                     if(!tagvalue) {
                        $("#selection_option").css("display","block");
                             $("#selection_option").addClass("selectionoption");
                             $("#checkbox_for_tags").addClass("tag_hover");
                       tagvalue = true;
                     }
                     else {   
                        $("#selection_option").css("display","none");                             
                             $("#selection_option").removeClass("selectionoption");
                             $("#checkbox_for_tags").removeClass("tag_hover");                             
                       tagvalue = false;                        
                     }
              });
     } 

//start: limiting the text in wysiwyg
$(document).ready(function() {
        $('#wysiwyg').contents().find("head")
         .append($("<style type='text/css'>  div { overflow-y: auto;word-wrap: break-word;white-space: normal;}  </style>"));
        $('#wysiwyg').contents().find("head") 
         .append($("<style type='text/css'> .vedio_content {border: none; width:98%;} </style>"));
         $("#wysiwyg").contents().find("body")
        .append("<div></div>");
        });
        //end: limiting the text in wysiwyg
        
        //start: for including vedio into wysiwyg
        var video_val = 0;
        $(document).ready(function(){
          $("#video").click(function(){
                var url1_before = prompt("Enter a URL", "http://");
                if (url1_before == null) {
                        return false;
                }
        var res = url1_before.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
        if (res == null) { 
        alert("Please enter a valid url");
        return false;
        }
        if (url1_before.length === 43) { 
        if (url1_before.substring(0, 32) === 'https://www.youtube.com/watch?v=') {
                var string = url1_before.substring(32, 43);
        video_val++;
        var video_name = "video" + video_val;
        var button_name = "button"+ video_val;
        $("#wysiwyg").contents().find('body').append("<div><input type = 'text' id = "+video_name+" class = 'vedio_content' value = "+url1_before+" readonly = 'readonly'/></div>");
        $("#wysiwyg").contents().find('body').append("<div><br/></div>"); 
        $("#wysiwyg").contents().find('body').append("<div><br/></div>"); 
        $("#wysiwyg").contents().find('body').find("#vedio_content").prop("readonly", true);
        }
        else {
                alert("Please enter a valid youtube url.");
                return false;
        }
        }
        else {
                alert("Please enter a valid youtube url.");
                return false;      
        }
        var url1 = encodeURIComponent(url1_before);
         });
        });
        //end: for including vedio into wysiwyg
         
        $(document).ready(function(){ 
        document.getElementById("alignleft").style.backgroundColor = "rgba(236, 239, 236, 1)";
        document.getElementById("aligncenter").style.color = "rgba(80, 94, 83, 1)";
        });
  


          var value = false;
    function showcheckbox() {
        var checkbox = document.getElementById("checkbox");
        if(!value) {
checkbox.style.display = "block";
value = true;
        }
        else {
checkbox.style.display = "none";
value = false;
        }
    }

$(document).ready(function(){
        val = false;
        $("#selectbox").click(function(){
                if(!val) {
          $("#multiselect").css("border-top", "2px solid #fff");
          val = true;          
                }
                else {
          $("#multiselect").css("border", "none");
          val = false;         
                }
        });
});

$(document).ready(function(){
    $("#searchbox").val('');
$("#close_button").click(function(){ 
    $("#hidding_the_option").css({"display" : "block"}); 
    $("#show_tags").css({"display" : "none"});              
});
});

                $(document).ready(function(){
                         $("input[type=checkbox]").prop("checked", false);
                });

var limit = 0;
    $(document).ready(function(){
$("input[type=checkbox]").change(function() {
    if ($(this).prop("checked")) { 
 if (limit >= 1) {
     alert("You can't select more than one tag");
     $(this).prop("checked", false);
 }
 else {
    var fex = $(this).prop("labels");                   
    var farr = $(fex).text();
    $("#question_box").find("#one_tag").text(farr);
    limit++;
 }
}
  else if($(this).prop("checked",false)){
    $("#question_box").find("#one_tag").text("");
    limit--;
    $(this).prop("checked", false);
  }
});
    });


//start: submitting the details of the question;
$(document).ready(function(){
    $("#ask_question_submit_button").click(function(e) {
     e.preventDefault();
     var questionid = getParameterByName('questionid');
if (questionid !== null && questionid.length == 32){
     var selected_tags_array = "";
     $("input[type=checkbox]:checked").each(function(){                 
               var ex = $(this).prop("labels");
               var arr = $(ex).text(); 
               selected_tags_array += arr;
               selected_tags_array += ';';
     });
     var send_selected_tags = selected_tags_array;
     var send_precise_question = encodeURIComponent($(".precisequestion").val());
     var myIFrame = document.getElementById("wysiwyg");
     var bef_send_question = myIFrame.contentWindow.document.body.innerHTML;
     var bef_send_question1 = bef_send_question.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, "<br>");
     var bef_send_question2 = $.trim(bef_send_question1);
     var send_question = encodeURIComponent(bef_send_question2);

     if (send_selected_tags.length < 0) {
             alert("You have not specified the tags");
             return false;
     }

     if (send_precise_question.length <= 15) {
             alert("You have not specified the proper specific question");
             return false;
     }

     if (send_question.length <= 100) {
             alert("You have not specified the proper question");
             return false;
     }

     $.ajax({
             type: "POST",
             url: "updateshareidea.php",
             data: {
                  'questionid': questionid,
                  'selected_tags': send_selected_tags,
                    'precise_question': send_precise_question,
                    'question': send_question
             }, 
             success: function(bef_data){
                     var data = $.trim(bef_data);
                  if (data === '1') {
                        var errormessage = encodeURIComponent(data);
                        var path = encodeURIComponent('shareidea.js/(sub)updateshareidea.php/error=1');
                        $.post("senderror.php", 
                        {
                         'errormessage': errormessage,
                         'path': path  
                    });
                          alert("There is something problem. Please contact 7675807537 for futher details");
                          window.location = "loginform.html";
                  }
                  else if (data === '2') {
                        var errormessage = encodeURIComponent(data);
                        var path = encodeURIComponent('shareidea.js/(sub)updateshareidea.php/error=2');
                        $.post("senderror.php", 
                        {
                         'errormessage': errormessage,
                         'path': path  
                    });
                     window.location = "loginform.html";
                  }
                  else {
                          alert("successfully updated");
                          window.location = "shareidearesult.php?uuid=" + questionid;
                  }
             }
     });
}
else { 
     var selected_tags_array = "";
     $("input[type=checkbox]:checked").each(function(){                 
               var ex = $(this).prop("labels");
               var arr = $(ex).text(); 
               selected_tags_array += arr;
               selected_tags_array += ';';
     });
     var send_selected_tags = selected_tags_array;
     var send_precise_question = encodeURIComponent($(".precisequestion").val());
     var myIFrame = document.getElementById("wysiwyg");
     var bef_send_question = myIFrame.contentWindow.document.body.innerHTML;
     var bef_send_question1 = bef_send_question.replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, "<br>");
     var send_question = encodeURIComponent(bef_send_question1);

     if (send_selected_tags.length < 0) {
             alert("You have not specified the tags");
             return false;
     }

     if (send_precise_question.length <= 15) {
             alert("You have not specified the proper specific question");
             return false;
     }

     if (send_question.length <= 30) {
             alert("You have not specified the proper question");
             return false;
     }

     var yearstake = $(".years_taken").children("option:selected").html();
     var participation = $(".how_many").children("option:selected").html();
     var requirements = $(".requirements").children("option:selected").html();
     var investement = $(".investement").children("option:selected").html();

     var send_yearstake = encodeURIComponent(yearstake);
     var send_participation = encodeURIComponent(participation);
     var send_requirements = encodeURIComponent(requirements);
     var send_investement = encodeURIComponent(investement);
        $.ajax({
                type: "POST",
                url: "shareidea.php",
                data: {
                    'selected_tags': send_selected_tags,
                    'precise_question': send_precise_question,
                    'question': send_question,
                    'yearstake': send_yearstake,
                    'participation': send_participation,
                    'requirements': send_requirements,
                    'investement': send_investement
                }, 
                success: function(bef_data){
                        var data = $.trim(bef_data);
                     if (data === '1') {
                        var errormessage = encodeURIComponent(data);
                        var path = encodeURIComponent('shareidea.js/(sub)shareidea.php/error=1');
                        $.post("senderror.php", 
                        {
                         'errormessage': errormessage,
                         'path': path  
                    });
                            window.location = "loginform.html";                                 
                     }
                     else if (data === '2') {
                             alert("This question already there in the group, please try different way of asking the question");
                     }
                     else if (data.length == 32) {
                             alert("Successfully posted your Idea");
                             window.location = "shareidearesult.php?uuid=" + data;
                     }
                     else {
                        var errormessage = encodeURIComponent(data);
                        var path = encodeURIComponent('shareidea.js/(sub)shareidea.php/error=else');
                        $.post("senderror.php", 
                        {
                         'errormessage': errormessage,
                         'path': path  
                    });
                             alert("Unsuccessfull due to some reason. Please contact 7675805737");
                             location.reload(true);
                     }
                }
        });
     }
    });
});
//end: submitting the details of the question;

//start: getting question
$(document).ready(function(){
    var questionid = getParameterByName('questionid');
    if (questionid !== null && questionid.length == 32){
            $("#ask_question_submit_button").html('Update Question');
    $.ajax({
            type: "POST",
            url: "getprecisequestion3.php",
            data: {
                 'questionid': questionid
            }, 
            success: function(data){
                    if(data === '1') {
                        var errormessage = encodeURIComponent(data);
                        var path = encodeURIComponent('shareidea.js/(sub)getprecisequestion3.php/error=1');
                        $.post("senderror.php", 
                        {
                         'errormessage': errormessage,
                         'path': path  
                    });
                            window.location = "loginform.html";
                    }
                    else {
                            $(".precisequestion").val(data);
                            $.ajax({
                                    type: "POST",
                                    url: "getquestion3.php",
                                    data: {
                                         'questionid': questionid
                                    }, 
                                    success: function(data){
                                            if(data === '1') {
                                                var errormessage = encodeURIComponent(data);
                                                var path = encodeURIComponent('shareidea.js/(sub)getquestion3.php/error=1');
                                                $.post("senderror.php", 
                                                {
                                                 'errormessage': errormessage,
                                                 'path': path  
                                            });
                                                    window.location = "loginform.html";
                                            }
                                            else {
                                                    $("#wysiwyg").contents().find("body").html(data);
                                            }
                                    }
                            });
                    }
            }
    });
    }
    else {
            return false;
    }
    });
    //end: getting question
    
    

         