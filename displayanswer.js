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
        var grpname = getParameterByName('groupname');
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
                   if (data === '1') {
                   window.location = "loginform.html";
                   }
                   else if (data === '2') {
                       alert("Sorry for interrupting you. Please login again to continue");
                       window.location = "loginform.html";
                   }
                   else if (data === '3') {
     
                   }
                   else {
                    var errormessage = encodeURIComponent(data);
                    var path = encodeURIComponent('displayanswer.js/(sub)securitynetwork.php/error=else');
                    $.post("senderror.php", 
                    {
                     'errormessage': errormessage,
                     'path': path  
                });
                       alert("There is something wrong. Please contact 9640096621 for futher help");
                   }
                }
                });
            }
        }
     });
//end: for checking url

//start: preventing overflow 
$(document).ready(function() {
    $('#wysiwyg').contents().find("head")
     .append($("<style type='text/css'>  div { overflow-y: auto;word-wrap: break-word;white-space: normal;}  </style>"));
     $("#wysiwyg").contents().find("body")
     .append("<div></div>");
     $('#wysiwyg').contents().find("head") 
 .append($("<style type='text/css'> .vedio_content {border: none; width:98%;} </style>"));
    });
//end: preventing overflow


$(document).ready(function(){
    var questionuuid = getParameterByName('questionid');  
    var hashgroupname = getParameterByName('groupname');
    $.ajax({
        type: 'POST',
        url: "getnoofquestions3.php", 
        data: {
            'questionuuid': questionuuid,
            'hashgroupname': hashgroupname
        },
        success: function(bef_data){
var data = parseInt(bef_data);
            if (data == 0) {
                return false;
            }
            else if(data <= 10){
            $("#noofpages").html('<button type = "button" id = "top">top</button>');
            var questionuuid = getParameterByName('questionid'); 
            var val2 = data;
    var val1 = 0;
    $.ajax({
        type: 'POST',
        url: "groupappend.php", 
        data: {
        'questionuuid': questionuuid, 
        'hashgroupname': hashgroupname,           
            'val1': val1,
            'val2': val2
        },
        success: function(data){
       $("#content_window").html(data);
       if (performance.navigation.type == 1) {
        $('html, body').animate({
            'scrollTop' : $('#content_window #answer_pointsanddata:nth-child(1)').position().top
        }, 1000);
     }
     $("#content_window").find(".answers").find('input[type=text]').each(function(){
        var bef_string = $(this).val();
        var string = bef_string.substring(32, 43);
        $(this).replaceWith( "<div><center><iframe class = 'vedioembbed' src='https://www.youtube.com/embed/"+string+"' frameborder= '0' allow='autoplay; encrypted-media' allowfullscreen></iframe></center></div>" );
      });
    }
    });
            }
            else if ($.isNumeric(data)){
               $bef_totalno = data / 10;
               $totalno = Math.ceil($bef_totalno);
               var appenddata_bef = "", appenddata = "";
               for(var i = 1; i <= $totalno; i++) {
                   appenddata_bef = appenddata;
                   appenddata = appenddata_bef+'<button type = "button" id = "page_no">'+i+'</button>';
               }
            $("#noofpages").html(appenddata+'<button type = "button" id = "top">top</button>');
            var questionuuid = getParameterByName('questionid'); 
            var val2 = data;
    var val1 = data - 9;
    $.ajax({
        type: 'POST',
        url: "groupappend.php", 
        data: {
        'questionuuid': questionuuid, 
        'hashgroupname': hashgroupname,           
            'val1': val1,
            'val2': val2
        },
        success: function(data){
       $("#content_window").html(data);
       if (performance.navigation.type == 1) {
        $('html, body').animate({
            'scrollTop' : $('#content_window #answer_pointsanddata:nth-child(1)').position().top
        }, 1000);
    }
            $("#content_window").find(".answers").find('input[type=text]').each(function(){
             var bef_string = $(this).val();
             var string = bef_string.substring(32, 43);
             $(this).replaceWith( "<div><center><iframe class = 'vedioembbed' src='https://www.youtube.com/embed/"+string+"' frameborder= '0' allow='autoplay; encrypted-media' allowfullscreen></iframe></center></div>" );
         });
    }
    });
            }
            else {
                alert("There is something problem. Please contact 7675807537 for more details.");
            }
        }
    });
});

$(document).ready(function(){
$(document).on('click', '#page_no', function(){
    var questionuuid = getParameterByName('questionid');
    var hashgroupname = getParameterByName('groupname');

    var num = parseInt($(this).html());     
    $.ajax({
        type: 'POST',
        url: "getnoofquestions3.php", 
        data: {
            'questionuuid': questionuuid,
            'hashgroupname': hashgroupname
        },
        success: function(data){
           if ($.isNumeric(data)) {
                var val1 = data - ((num - 1) * 10);
                var val2 = (val1 - 10) + 1;
                if (val2 >= 0) {
                    val2 = val2;
                }
                else {
                    val2 = 0;
                }
                $.ajax({
                    type: 'POST',
                    url: "groupappend.php", 
                    data: {
                    'questionuuid': questionuuid,
                    'hashgroupname': hashgroupname,            
                        'val1': val2,
                        'val2': val1
                    },
                    success: function(data){
                   $("#content_window").html(data);
                   $('html, body').animate({
                    'scrollTop' : $('#content_window #answer_pointsanddata:nth-child(1)').position().top
                }, 1000);
                    $("#content_window").find(".answers").find('input[type=text]').each(function(){
                     var bef_string = $(this).val();
                     var string = bef_string.substring(32, 43);
                     $(this).replaceWith( "<div><center><iframe class = 'vedioembbed' src='https://www.youtube.com/embed/"+string+"' frameborder= '0' allow='autoplay; encrypted-media' allowfullscreen></iframe></center></div>" );
                 });
                }
            });   
            }
            else {
                var errormessage = encodeURIComponent(data);
                var path = encodeURIComponent('displayanswer.js/(sub)groupappend.php/error=else');
                $.post("senderror.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });
                alert('There is something problem. Please contact 9640096621 for futher details');
                return false; 
}
        }
    });
});
});

$(document).ready(function(){
    $(document).on('click', '#top', function(){
        $('html, body').animate({
            'scrollTop' : $('#content_window #answer_pointsanddata:nth-child(1)').position().top
        }, 1000);
    });
});

var iframe_invoke_count = false;
$(document).ready(function(){ 
$(".iframe_invoke_button").click(function(){
var firstset = $(this).data("one");
var secondset = $(this).data("two");
var thirdset = $(this).data("three");

var iframe_button_id = $(this).attr('id');
if (!iframe_invoke_count) { 
$("#"+iframe_button_id+"_outer_frame").css("display", "block");
if (firstset === 1) { 
var thisiframe = $("#"+iframe_button_id+"_outer_frame").find("#1iframe");
thisiframe.attr("src",thisiframe.data("source"));
}
if (secondset === 1) { 
var thisiframe = $("#"+iframe_button_id+"_outer_frame").find("#2iframe");
thisiframe.attr("src", thisiframe.data("source"));
}
if (thirdset === 1) { 
var thisiframe = $("#"+iframe_button_id+"_outer_frame").find("#3iframe");
thisiframe.attr("src", thisiframe.data("source"));
}
iframe_invoke_count = true;
}
else {
$("#"+iframe_button_id+"_outer_frame").css("display", "none");
iframe_invoke_count = false;
}
});
});

$(document).ready(function() {
    var hashgrpname = getParameterByName('groupname');
    var questionuuid = getParameterByName('questionid');  
    $("#add_one_point").click(function(){ 
        var value = $("#got_points").html();  
        var updated_value = parseInt(value) + 1;
        $("#got_points").html(updated_value); 
$.ajax({
    type: 'POST',
    url: "addingpoints.php", 
    data: {
        'hashgroupname': hashgrpname,
        'questionuuid': questionuuid
    },
    success: function(bef_data){
        var data = $.trim(bef_data);
   if (data === '1') {
       
   }
   else if (data === '2') {
    value = $("#got_points").html();  
    updated_value = parseInt(value) - 1;
   $("#got_points").html(updated_value);
       alert("Only 1 reputation is allowed");
   }
   else {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('displayanswer.js/(sub)addingpoints.php/error=else');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
value = $("#got_points").html();  
updated_value = parseInt(value) - 1;
$("#got_points").html(updated_value);
       alert("There is something problem. Please contact 9640096621");
   }
}
   });       
  });
});

$(document).ready(function() {
    var hashgrpname = getParameterByName('groupname');
    var questionuuid = getParameterByName('questionid');
    $("#minus_one_point").click(function(){ 
        var value = $("#got_points").html();  
        var updated_value = parseInt(value) - 1;
        $("#got_points").html(updated_value); 
$.ajax({
    type: 'POST',
    url: "minuspoints.php", 
    data: {
        'hashgroupname': hashgrpname,
        'questionuuid': questionuuid
    },
    success: function(bef_data){
        var data = $.trim(bef_data);
        if (data === '1') {
   
         }
         else if (data === '2') {
             value = $("#got_points").html();  
             updated_value = parseInt(value) + 1;
            $("#got_points").html(updated_value); 
             alert("Only 1 reputation is allowed");
         }
         else {
            var errormessage = encodeURIComponent(data);
            var path = encodeURIComponent('displayanswer.js/(sub)minuspoints.php/error=else');
            $.post("senderror.php", 
            {
             'errormessage': errormessage,
             'path': path  
        });
             alert("There is something problem. Please contact 9640096621");
              value = $("#got_points").html();  
             updated_value = parseInt(value) + 1;
        $("#got_points").html(updated_value); 
         }
}
   });       
  });
});


$(document).ready(function() {
    var hashgrpname = getParameterByName('groupname');
    var questionuuid = getParameterByName('questionid');   
    $(document).on("click", "#answer_add_one_point", function(){
        var ca3ka9zqkdi = $(this).data("iden12zsall9zla20");
        var value = $("."+ca3ka9zqkdi).html(); 
        var updated_value = parseInt(value) + 1;
        $(".answer_total_points").find("."+ca3ka9zqkdi).html(updated_value);          
$.ajax({
    type: 'POST',
    url: "answeraddingpoints.php", 
    data: {
        'hashgroupname': hashgrpname,
        'questionuuid': questionuuid, 
        'ca3ka9zqkdi': ca3ka9zqkdi        
    },
    success: function(bef_data){
        var data = $.trim(bef_data);
   if (data === '1') {

   }
   else if (data === '2') {
     value = $("."+ca3ka9zqkdi).html(); 
     updated_value = parseInt(value) - 1;
    $(".answer_total_points").find("."+ca3ka9zqkdi).html(updated_value);
       alert("Only 1 reputation is allowed");
   }
   else {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('displayanswer.js/(sub)answeraddingpoints.php/error=else');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
value = $("."+ca3ka9zqkdi).html(); 
updated_value = parseInt(value) - 1;
$(".answer_total_points").find("."+ca3ka9zqkdi).html(updated_value);
     alert("There is something problem. Please contact 9640096621");
   }
}
   });       
  });
});

$(document).ready(function() {
    var hashgrpname = getParameterByName('groupname');
    var questionuuid = getParameterByName('questionid');
    $(document).on("click", "#answer_minus_one_point", function(){    
        var ca3ka9zqkdi = $(this).data("iden12zsall9zla20");
        var value = $("."+ca3ka9zqkdi).html(); 
        var updated_value = parseInt(value) - 1;
        $(".answer_total_points").find("."+ca3ka9zqkdi).html(updated_value); 
$.ajax({
    type: 'POST',
    url: "answerminuspoints.php", 
    data: {
        'hashgroupname': hashgrpname,
        'questionuuid': questionuuid,
        'ca3ka9zqkdi': ca3ka9zqkdi
    },
    success: function(bef_data){
        var data = $.trim(bef_data);
        if (data === '1') {
          
         }
         else if (data === '2') {
            value = $("."+ca3ka9zqkdi).html(); 
            updated_value = parseInt(value) + 1;
           $(".answer_total_points").find("."+ca3ka9zqkdi).html(updated_value);
             alert("Only 1 reputation is allowed");
         }
         else {
            var errormessage = encodeURIComponent(data);
            var path = encodeURIComponent('displayanswer.js/(sub)answerminuspoints.php/error=else');
            $.post("senderror.php", 
            {
             'errormessage': errormessage,
             'path': path  
        });
        value = $("."+ca3ka9zqkdi).html(); 
        updated_value = parseInt(value) + 1;
       $(".answer_total_points").find("."+ca3ka9zqkdi).html(updated_value);
             alert("There is something problem. Please contact 9640096621");
         }
}
   });       
  });
});

//start: for updating question
$(document).ready(function(){
    $("#edit_question").click(function(){
        var questionid = getParameterByName('questionid');
        var groupname = getParameterByName('groupname');        
        window.location = "askquestion.html?questionid=" + questionid + "&groupname=" + groupname;
    });
});
//end: for updating question

$(document).ready(function(){
    $("#question").find('input[type=text]').each(function(){
        var bef_string = $(this).val();
        var string = bef_string.substring(32, 43);
        $(this).replaceWith( "<center><iframe class = 'vedioembbed' src='https://www.youtube.com/embed/"+string+"' frameborder= '0' allow='autoplay; encrypted-media' allowfullscreen></iframe></center>" );
      });
   });

 $(document).ready(function(){
    $("#delete_question_button").click(function(){
     $("#displaying_answer").css("opacity", "0.3");
        $(".loader").css({"display": "block", "opacity": "1"});
        
        var questionid = getParameterByName('questionid');
        var groupname = getParameterByName('groupname'); 
        var execute = confirm("Do you really want to delete this question?");
        if (execute) {
       $.ajax({
           type: 'POST',
           url: 'deletegroupquestion.php', 
           data: {
             'questionid': questionid,
             'groupname': groupname
           },
           success: function(bef_data){
               var data = $.trim(bef_data);
               if (data === '1') {
                 window.location = "loginform.html";
               }
               else if (data === '2') {
                window.location = "toolbar.html?name="+groupname;
               }
               else {
                var errormessage = encodeURIComponent(data);
                var path = encodeURIComponent('displayanswer.js/(sub)deletegroupquestion.php/error=else');
                $.post("senderror.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });
                 alert("There is something problem. Please contact 9640096621 for more details");
                    $("#displaying_answer").css("opacity", "1");
        $(".loader").css({"display": "none"});
               }
           }
       });
    }
    else {
       $("#displaying_answer").css("opacity", "1");
        $(".loader").css({"display": "none"});
        return false;
    }
    });
   });

   $(document).ready(function(){
   $(document).on("click", ".delete_answer_button", function(){
    $("#displaying_answer").css("opacity", "0.3");
        $(".loader").css({"display": "block", "opacity": "1"});
        
        var questionid = getParameterByName('questionid');
        var groupname = getParameterByName('groupname'); 
        var answeruuid = $(this).data('i2oxl3kcue93lci39');
        var execute = confirm("Do you really want to delete this answer?");
        if (execute) {
       $.ajax({
           type: 'POST',
           url: 'deletegroupanswers.php', 
           data: {
             'questionid': questionid,
             'groupname': groupname,
             'answeruuid': answeruuid
           },
           success: function(bef_data){
               var data = $.trim(bef_data);
               if (data === '1') {
                 window.location = "loginform.html";
               }
               else if (data === '2') {
                location.reload(true);
               }
               else {
                var errormessage = encodeURIComponent(data);
                var path = encodeURIComponent('displayanswer.js/(sub)deletegroupanswers.php/error=else');
                $.post("senderror.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });
                 alert("There is something problem. Please contact 9640096621 for more details");
                    $("#displaying_answer").css("opacity", "1");
        $(".loader").css({"display": "none"});
               }
           }
       });
    }
    else {
       $("#displaying_answer").css("opacity", "1");
        $(".loader").css({"display": "none"});
        return false;
    }
    });
   });


