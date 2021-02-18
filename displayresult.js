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
     
$(document).ready(function(){
    var questionuuid = getParameterByName('uuid');  
    $.ajax({
        type: 'POST',
        url: "getnoofquestions2.php", 
        data: {
            'questionuuid': questionuuid
        },
        success: function(bef_data){
var data = parseInt(bef_data);
            if (data == 0) {
                return false;
            }
            else if(data <= 10){
            $("#noofpages").html('<button type = "button" id = "top">top</button>');
            var questionuuid = getParameterByName('uuid'); 
            var val2 = data;
    var val1 = 0;
    $.ajax({
        type: 'POST',
        url: "smpappend.php", 
        data: {
        'questionuuid': questionuuid,            
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
            var questionuuid = getParameterByName('uuid'); 
            var val2 = data;
    var val1 = data - 9;
    $.ajax({
        type: 'POST',
        url: "smpappend.php", 
        data: {
        'questionuuid': questionuuid,            
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
                var errormessage = encodeURIComponent(data);
                var path = encodeURIComponent('displayresult.js/(sub)smpappend.php/error=else');
                $.post("senderror.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });
                alert("There is something problem. Please contact 9640096621 for more details.");
            }
        }
    });
});

$(document).ready(function(){
$(document).on('click', '#page_no', function(){
    var questionuuid = getParameterByName('uuid');
    var num = parseInt($(this).html());     
    $.ajax({
        type: 'POST',
        url: "getnoofquestions2.php", 
        data: {
            'questionuuid': questionuuid
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
                    url: "smpappend.php", 
                    data: {
                    'questionuuid': questionuuid,            
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
                var path = encodeURIComponent('displayresult.js/(sub)smpappend.php/error=else');
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

$(document).ready(function() {
    var questionuuid = getParameterByName('uuid');  
    $("#add_one_point").click(function(){ 
        var value = $("#got_points").html();  
      var updated_value = parseInt(value) + 1;
      $("#got_points").html(updated_value); 
$.ajax({
    type: 'POST',
    url: "smpaddpoints.php", 
    data: {
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
    var path = encodeURIComponent('displayresult.js/(sub)smpaddpoints.php/error=else');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
value = $("#got_points").html();  
             updated_value = parseInt(value) - 1;
        $("#got_points").html(updated_value);
       alert("there is something problem. Please contact 9640096621");
   }
}
   });       
  });
});

$(document).ready(function() {
    var questionuuid = getParameterByName('uuid');
    $("#minus_one_point").click(function(){ 
        var value = $("#got_points").html();
            var updated_value = parseInt(value) - 1;
            $("#got_points").html(updated_value);
$.ajax({
    type: 'POST',
    url: "smpminuspoints.php", 
    data: {
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
            var path = encodeURIComponent('displayresult.js/(sub)smpminuspoints.php/error=else');
            $.post("senderror.php", 
            {
             'errormessage': errormessage,
             'path': path  
        });
        value = $("#got_points").html();  
             updated_value = parseInt(value) + 1;
        $("#got_points").html(updated_value);
             alert("there is something problem. Please contact 9640096621");
         }
}
   });       
  });
});


$(document).ready(function() {
    var questionuuid = getParameterByName('uuid');   
    $(document).on("click", "#answer_add_one_point", function(){
        var ca3ka9zqkdi = $(this).data("iden12zsall9zla20");  
        var value = $("."+ca3ka9zqkdi).html(); 
        var updated_value = parseInt(value) + 1;
        $(".answer_total_points").find("."+ca3ka9zqkdi).html(updated_value);        
$.ajax({
    type: 'POST',
    url: "smpansweraddpoints.php", 
    data: {
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
    var path = encodeURIComponent('displayresult.js/(sub)smpansweraddpoints.php/error=else');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
value = $("."+ca3ka9zqkdi).html(); 
updated_value = parseInt(value) - 1;
$(".answer_total_points").find("."+ca3ka9zqkdi).html(updated_value);
       alert("there is something problem. Please contact 9640096621");
   }
}
   });       
  });
});

$(document).ready(function() {
    var questionuuid = getParameterByName('uuid');
    $(document).on("click", "#answer_minus_one_point", function(){    
        var ca3ka9zqkdi = $(this).data("iden12zsall9zla20"); 
        var value = $("."+ca3ka9zqkdi).html(); 
            var updated_value = parseInt(value) - 1;
            $(".answer_total_points").find("."+ca3ka9zqkdi).html(updated_value);
$.ajax({
    type: 'POST',
    url: "smpanswerminuspoints.php", 
    data: {
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
            var path = encodeURIComponent('displayresult.js/(sub)smpanswerminuspoints.php/error=else');
            $.post("senderror.php", 
            {
             'errormessage': errormessage,
             'path': path  
        });
        value = $("."+ca3ka9zqkdi).html(); 
        updated_value = parseInt(value) + 1;
       $(".answer_total_points").find("."+ca3ka9zqkdi).html(updated_value);
             alert("there is something problem. Please contact 9640096621");
         }
}
   });       
  });
});

//start: for updating question
$(document).ready(function(){
    $("#edit_question").click(function(){
        var questionid = getParameterByName('uuid');       
        window.location = "solvemyproblem.html?questionid=" + questionid;
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