/*
$(document).ready(function(){
    $.ajax({
        type: 'POST',
        url: "securitynetwork2.php", 
        success: function(data){
       if (data === '1') {
       window.location = "loginform.html";
       }
       else if (data === '2') {
       }
       else {
        var errormessage = encodeURIComponent(data);
        var path = encodeURIComponent('shareideatoolbar.js/(sub)securitynetwork2.php/error=else');
        $.post("senderror.php", 
        {
         'errormessage': errormessage,
         'path': path  
    });
           alert("There is something wrong. Please contact 9640096621 for futher help");
       }
    }
 });
});
*/

var maxid;
var this_page;
$(document).ready(function(){
this_page = true;
$.ajax({
 type: 'POST',
 url: "getrecords3.php", 
 data: {
},
 success: function(data){
     if (data === 'nothing') {
         maxid = data;
     }
     else { 
maxid = data;
}
$.ajax({
 type: 'POST',
 url: "shareideaquestions.php", 
 data: {
     'maxid': maxid
},
 success: function(data){
$("#content_window").html(data);
 }
});
 }
});
});

//start: fetching data after scrolling down
$(document).ready(function(){  
$(window).scroll(function(){    
 if (this_page && maxid >= 1) {
if ($(window).scrollTop() >= $(document).height()-$(window).height()) {
    $(".loader2").css('display', 'block');
        $(".loader2").css('margin-top', height);
maxid = maxid - 10;
if (maxid >= 1) { 
$.ajax({
 type: 'POST',
 url: "shareideaquestions.php", 
 data: {
     'maxid': maxid
},
 success: function(data){
$("#content_window").append(data);
allowmaxid = true;
 }
});
}
}
}
else {
    $(".loader2").css("display", "none");
}
});   
});
//end: fetching data after scrolling down 

//start: when button click
$(document).ready(function(){
$('.shareideaquestions').click(function(){
 this_page = true;
 location.reload(true);
});
});
//end: when button click

$(document).ready(function(){
    $(".home").click(function(){
       $.ajax({
               type: 'POST',
               url: "securitynetwork2.php", 
               success: function(bef_data){
                   var data = $.trim(bef_data);
              if (data === '1') {
                  var accept = confirm("You need to sign in to visit your Homepage.");
                                 if (accept) { 
                                 window.location = "loginform.html";
                                 }
                                 else {
                                         return false;
                                 }
              }
              else if (data === '2') {
               window.location = "homepage.html";
              }
              else {
                var errormessage = encodeURIComponent(data);
                var path = encodeURIComponent('solvemyproblemtoolbar.js/(sub)securitynetwork2.php/error=else');
                $.post("senderror.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });
                  alert("There is something wrong. Please contact 9640096621 for futher help");
              }
           }
        }); 
    }); 
});

$(document).ready(function(){
    $(".askquestion").click(function(){
       $.ajax({
               type: 'POST',
               url: "securitynetwork2.php", 
               success: function(bef_data){
                   var data = $.trim(bef_data);
              if (data === '1') {
                  var accept = confirm("You need to sign in to Ask Question.");
                                 if (accept) { 
                                 window.location = "loginform.html";
                                 }
                                 else {
                                         return false;
                                 }
              }
              else if (data === '2') {
               window.location = "shareidea.html";
              }
              else {
                var errormessage = encodeURIComponent(data);
                var path = encodeURIComponent('solvemyproblemtoolbar.js/(sub)securitynetwork2.php/error=else');
                $.post("senderror.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });
                  alert("There is something wrong. Please contact 9640096621 for futher help");
              }
           }
        }); 
    }); 
});

$(document).ready(function(){
    $(".personaldatabase").click(function(){
        this_page = false;
         $.ajax({
               type: 'POST',
               url: "securitynetwork2.php", 
               success: function(bef_data){
                   var data = $.trim(bef_data);
              if (data === '1') {
                var accept = confirm("You need to sign in to view your personal data.");
                if (accept) { 
                window.location = "loginform.html";
                }
                else {
                        return false;
                }
              }
              else if (data === '2') {
                  $("#content_window").html("<div class = 'loader'></div>");
                  $("#content_window").load("sidata.php");   
              }
              else {
                var errormessage = encodeURIComponent(data);
                var path = encodeURIComponent('solvemyproblemtoolbar.js/(sub)securitynetwork2.php/error=else');
                $.post("senderror.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });
                  alert("There is something wrong. Please contact 9640096621 for futher help");
              }
           }
        });       
    }); 
});

var counter = true;
$(document).ready(function(){
$(document).on("click", "#edit_quote_button", function(){
 if (counter) { 
$("#content_window").find("#quote").attr('contenteditable', 'true');
$("#content_window").find("#quote").focus();
$("#content_window").find("#quote").css({"background-color": "#dee3df", "overflow": "hidden", "padding": "5px 10px"});
$(this).html('post');
$("#content_window").find("#quote").html('');
counter = false;
 }
 else {
     var quote_of_the_day = $("#content_window").find("#quote").html();
     if (quote_of_the_day == "") {
         return false;
     }
$.ajax({
type: 'POST',
url: 'insertquote.php',
data: {
 'quote': quote_of_the_day
},
success: function(bef_data){
    var data = $.trim(bef_data);
if (data === '1') {
$("#content_window").find("#quote").html(quote_of_the_day);
}
else if (data === '2') {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('shareideatoolbar.js/(sub)insertquote.php/error=2');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
alert("there is something problem. Please contact 9640096621 for futher help");
$("#content_window").find("#quote").html('......');

}
else {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('shareideatoolbar.js/(sub)insertquote.php/error=else');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
window.location = "loginform.php";
}
}
});
$("#content_window").find("#quote").attr('contenteditable', 'false');
$("#content_window").find("#quote").css({"background-color":"#fff", "overflow-y": "auto", "padding": "0px"});
$(this).html('edit');
counter = true;
 }
});
});

$(document).ready(function() {
$(document).on("click", "#my_name", function(){
 var userax0z = $(this).data('cz0x8h');
 window.location = "aboutme.php?q=" + userax0z;
});
});
