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
        $(".back_button").click(function(){
          window.history.go(-1);
        });
      });
     
      $(document).ready(function(){
        $("#back_button2").click(function(){
          window.history.go(-1);
        });
      });

       $(document).ready(function(){
             $("#home_button").click(function(){
                 window.location = "groupfrontpage.php";
             });
     });
    
$(document).ready(function() {
   $("#prolong_button").click(function() {
        $("#box").toggle();
   });
});

 //start: displaying related questions and number of characters after specific box;
 function specific(befstr){
    $(document).ready(function(){     
     count = 200;
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
        ajaxRequest.open("GET", "groupsearchlinkedlist3.php?q=" + str, true);
        ajaxRequest.send();
    }  
  }
//end: displaying related questions and number of characters after specific box;

//start: result when user search for tags;
$(document).ready(function(){
    $("input[type=checkbox]").prop("checked", false);
});

function search(str) {
    $(document).ready(function(){
          $("#hidding_the_option").css({"display" : "none"});
          $("#show_tags").css({"display" : "block"});
 
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
                document.getElementById("show_tags").innerHTML = this.responseText;
             }
         };
         ajaxRequest.open("GET", "fetchingxml.php?q=" + encodeURIComponent(str), true);
         ajaxRequest.send();
         
          if ($("#searchbox").val() == "") {
                 $("#hidding_the_option").css({"display" : "block"});
                 $("#show_tags").css({"display" : "none"});
         }
    });
 }
//end: result when user search for tags;
  
 //start: checking checkbox and displaying name on right side      
 var limit = 1;  
 var assume = true;     
         $(document).ready(function(){                    
           $("input[type=checkbox]").change(function(){

                    var fex = $(this).prop("labels");                   
                    var farr = $.trim($(fex).text());
                    var farr1 = $("#question_box").find("#1").text();
                    var farr2 = $("#question_box").find("#2").text();
                    var farr3 = $("#question_box").find("#3").text();
                    var farr4 = $("#question_box").find("#4").text();
                    var farr5 = $("#question_box").find("#5").text();
                    
                    if ($.trim(farr1) == farr
                    || $.trim(farr2) == farr
                    || $.trim(farr3) == farr 
                    || $.trim(farr4) == farr 
                    || $.trim(farr5) == farr) { 
                            $(this).prop("checked");
                            assume = false;
            }
                 
                   if ($(this).prop("checked")) { 
                   if ($("#question_box").find("#1").text().length > 0 && 
                   $("#question_box").find("#2").text().length > 0 &&
                   $("#question_box").find("#3").text().length > 0 &&
                   $("#question_box").find("#4").text().length > 0 &&
                   $("#question_box").find("#5").text().length > 0
              ) {
                      alert("You cannot select more than five tags");
                      return false;
              } 
                   if (limit <= 5 && assume){ 
                         limit++;  
                         
         var ex = $(this).prop("labels");                   
         var arr = $.trim($(ex).text());
         if ($("#question_box").find("#1").text().length == 0)
         {
                 $("#question_box").find("#1").text(arr);
         }
         else if ($("#question_box").find("#2").text().length == 0)
         {
            $("#question_box").find("#2").text(arr);
         }
         else if ($("#question_box").find("#3").text().length == 0)
         {
            $("#question_box").find("#3").text(arr);
         }
         else if ($("#question_box").find("#4").text().length == 0)
         {
            $("#question_box").find("#4").text(arr);
         }
         else if ($("#question_box").find("#5").text().length == 0)
         {
            $("#question_box").find("#5").text(arr);
         }  
                   } 
                   else if (!assume) {
                         assume = true; 
                 }
                 else {
                    alert("You cannot select more than five tags");
                    $(this).prop("checked", false);    
                 }
                 }
                 else {
                    if (limit > 1) { 
                           limit--;
                         }
                           
                           var ex = $(this).prop("labels");                   
                           var arr = $.trim($(ex).text());
                           var tarr1 = $("#question_box").find("#1").text();
                           var tarr2 = $("#question_box").find("#2").text();
                           var tarr3 = $("#question_box").find("#3").text();
                           var tarr4 = $("#question_box").find("#4").text();
                           var tarr5 = $("#question_box").find("#5").text();

                           if ($.trim(tarr1) == arr) {
                                   $("#question_box").find("#1").text("");
                           }
                           else if ($.trim(tarr2) == arr) {
                                   $("#question_box").find("#2").text("");
                           }
                           else if ($.trim(tarr3) == arr) {
                                   $("#question_box").find("#3").text("");
                           }
                           else if ($.trim(tarr4) == arr) {
                                   $("#question_box").find("#4").text("");
                           }
                           else if ($.trim(tarr5) == arr) {
                                   $("#question_box").find("#5").text("");
                           }
                   }  
           });
         });

         $(document).ready(function(){
               var finding = $("#show_tags");
       finding.on("click", function(){
               $(this).find(".matched_tags").click(function(){
                    var arr = $.trim($(this).text());
        if ($("#question_box").find("#1").text() == arr 
        || $("#question_box").find("#2").text() == arr 
        || $("#question_box").find("#3").text() == arr 
        || $("#question_box").find("#4").text() == arr 
        || $("#question_box").find("#5").text() == arr) { 
               if (limit > 1) { 
                       limit--;
                     }
               if ($("#question_box").find("#1").text() == arr) {
                                         $("#question_box").find("#1").text("");
                                 }
                                 else if ($("#question_box").find("#2").text() == arr) {
                                         $("#question_box").find("#2").text("");
                                 }
                                 else if ($("#question_box").find("#3").text() == arr) {
                                         $("#question_box").find("#3").text("");
                                 }
                                 else if ($("#question_box").find("#4").text() == arr) {
                                         $("#question_box").find("#4").text("");
                                 }
                                 else if ($("#question_box").find("#5").text() == arr) {
                                         $("#question_box").find("#5").text("");
                                 }
        }
        else { 
               if ($("#question_box").find("#1").text().length > 0 && 
               $("#question_box").find("#2").text().length > 0 &&
               $("#question_box").find("#3").text().length > 0 &&
               $("#question_box").find("#4").text().length > 0 &&
               $("#question_box").find("#5").text().length > 0
          ) {
                  alert("You cannot select more than five tags");
                  return false;
          } 
                       if (limit <= 5){
                                limit++; 
                    if ($("#question_box").find("#1").text().length == 0)
                    {     
                       $("#question_box").find("#1").text(arr);
                    }
                    else if ($("#question_box").find("#2").text().length == 0)
                    {
                       $("#question_box").find("#2").text(arr);
                    }
                    else if ($("#question_box").find("#3").text().length == 0)
                    {
                       $("#question_box").find("#3").text(arr);
                    }
                    else if ($("#question_box").find("#4").text().length == 0)
                    {
                       $("#question_box").find("#4").text(arr);
                    }
                    else if ($("#question_box").find("#5").text().length == 0)
                    {
                       $("#question_box").find("#5").text(arr);
                    } 
               } 
                   else {
                          alert("You cannot select more than five tags");
                         
                      } 
               }      
              return false;      
               });
               return false;
             });
       });
//end: checking checkbox and displaying name on right side
 
//start: result when user search for tags;
         $(document).ready(function(){
                 $("#searchbox").val('');
           $("#close_button").click(function(){ 
                 $("#hidding_the_option").css({"display" : "block"}); 
                 $("#show_tags").css({"display" : "none"});              
         });
 });
//end: result when user search for tags;

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
 //end: checking checkbox and displaying name on right side

//start: limiting the text in wysiwyg
$(document).ready(function() {
        $('#wysiwyg').contents().find("head")
         .append($("<style type='text/css'>  div { overflow-y: auto;word-wrap: break-word;white-space: normal;}  </style>"));
        $('#wysiwyg').contents().find("head") 
         .append($("<style type='text/css'> .vedio_content {border: none; width:98%;} html {font-size: 18px; letter-spacing: 1px;} </style>"));
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

         var checkingEmpty = bef_send_question1;
         var send_question = '';
       
        $final_checkingEmpty = checkingEmpty.replace(/(<div>|<br>|<\/div>)/g, "");
       
         if ($.trim($final_checkingEmpty).length > 0) {
              send_question = encodeURIComponent(bef_send_question2);
         }

         if (send_selected_tags.length < 0) {
                 alert("You have not specified the tags");
                 return false;
         }

         if (send_precise_question.length <= 15) {
                $('html,body').animate({
                        scrollTop: $("#spcificquestion").offset().top
                    }, 1000);
                    $("#count").html("Your specific question don't is not clear");
                 return false;
         }

         $.ajax({
                 type: "POST",
                 url: "updatesolvemyproblem.php",
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
                        var path = encodeURIComponent('solvemyproblem.js/(sub)updatesolvemyproblem.php/error=1');
                        $.post("senderror.php", 
                        {
                         'errormessage': errormessage,
                         'path': path  
                    });
                              alert("There is something problem. Please contact 9640096621 for futher details");
                              window.location = "loginform.html";
                      }
                      else if (data === '2') {
                        var errormessage = encodeURIComponent(data);
                        var path = encodeURIComponent('solvemyproblem.js/(sub)updatesolvemyproblem.php/error=2');
                        $.post("senderror.php", 
                        {
                         'errormessage': errormessage,
                         'path': path  
                    });
                         window.location = "loginform.html";
                      }
                      else {
                              alert("successfully updated");
                              window.location = "displayresult.php?uuid=" + questionid;
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
         var bef_send_question2 = $.trim(bef_send_question1);

         var checkingEmpty = bef_send_question1;
         var send_question = '';
       
        $final_checkingEmpty = checkingEmpty.replace(/(<div>|<br>|<\/div>)/g, "");
       
         if ($.trim($final_checkingEmpty).length > 0) {
              send_question = encodeURIComponent(bef_send_question2);
         }

         if (send_selected_tags.length <= 0) {
                 alert("You have not specified the tags");
                 return false;
         }

         if (send_precise_question.length <= 15) {
                $('html,body').animate({
                        scrollTop: $("#spcificquestion").offset().top - 100
                    }, 1000);
                    $("#count").html("Your specific question don't is not clear");
                 return false;
         }


            $.ajax({
                    type: "POST",
                    url: "solvemyproblem.php",
                    data: {
                        'selected_tags': send_selected_tags,
                        'precise_question': send_precise_question,
                        'question': send_question
                    }, 
                    success: function(data){
                         if (data === '1') {
                                var errormessage = encodeURIComponent(data);
                                var path = encodeURIComponent('solvemyproblem.js/(sub)solvemyproblem.php/error=1');
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
                                 alert("Successfully posted your question");
                                 window.location = "displayresult.php?uuid=" + data;
                         }
                         else {
                                var errormessage = encodeURIComponent(data);
                                var path = encodeURIComponent('solvemyproblem.js/(sub)updatesolvemyproblem.php/error=else');
                                $.post("senderror.php", 
                                {
                                 'errormessage': errormessage,
                                 'path': path  
                            });
                                 alert("Unsuccessfull due to some reason. Please contact 9640096621");
                                 location.reload(true);
                         }
                    }
            });
         }
        });
 });
//end: submitting the details of the question;

//start: updating question
$(document).ready(function(){
        var questionid = getParameterByName('questionid');
        if (questionid !== null && questionid.length == 32){
                $("#ask_question_submit_button").html('Update Question');
        $.ajax({
                type: "POST",
                url: "getprecisequestion2.php",
                data: {
                     'questionid': questionid
                }, 
                success: function(data){
                        if(data === '1') {
                                var errormessage = encodeURIComponent(data);
                                var path = encodeURIComponent('solvemyproblem.js/(sub)getprecisequestion2.php/error=1');
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
                                        url: "getquestion2.php",
                                        data: {
                                             'questionid': questionid
                                        }, 
                                        success: function(data){
                                              
                                                if (data.length > 0) {
                                                        $("#box").css("display", "block");
                                                }
                                                if(data === '1') {
                                                        var errormessage = encodeURIComponent(data);
                                                        var path = encodeURIComponent('solvemyproblem.js/(sub)getqestion2.php/error=1');
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
        //end: updating question
        
        
