
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
        var path = encodeURIComponent('findfriends.js/(sub)securitynetwork2.php/error=else');
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


var sno = '<?php echo $sno;?>';
function ajaxFunction(str){
    if (str.length == 0 || str == "") {
        $("#displaybox").css({"display": "none"});     
        $("#starting_div").css({"display": "block"}); 
        return false;
    }
    else { 
    $("#displaybox").css({"display": "block"});     
    $("#starting_div").css({"display": "none"});
    }
if (str.length < 1) { 
document.getElementById("displaybox").innerHTML = "no suggestions";
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
  document.getElementById("displaybox").innerHTML = this.responseText;
}
};
ajaxRequest.open("GET", "groupsearchlinkedlist2.php?q=" + str + "&sno=" + sno, true);
ajaxRequest.send();
}   
}

$(document).ready(function(){
  $("#friend_request_div").load('friendrequestgot.php');
  $('html, body').animate({scrollTop: 0}, 800);  
});

$(document).ready(function(){
    $(document).on("click", ".addfriend",function(){
      var axiy2wi3 = $(this).data("axiy2wi3");
      var aic2eyz3 = $(this).data("aic2eyz3");
      var si2x0ezp = $(this).data("si2x0ezp");
      $.ajax ({
    type: 'POST', 
    url: 'addfriend.php',
    data: {
        'axiy2wi3': axiy2wi3,
        'aic2eyz3': aic2eyz3
    }, 
    success: function(bef_data){
        data = $.trim(bef_data);
if (data === '1') {
    window.location = "loginform.html";
}
else if (data === '2') {
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Cancel Sent Request");
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","cancelsentrequest");
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class", "cancelsentrequest");
}
else if (data === '3') {
    location.reload();
}
else {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('findfriends.js/(sub)addfriend.php/error=else');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
   alert("There is something problem. Please contact 9640096621 for more details.");
   window.location = "loginform.html";    
}
    }
      });
    });
});

$(document).ready(function(){
    $(document).on("click", ".cancelsentrequest",function(){
      var axiy2wi3 = $(this).data("axiy2wi3");
      var aic2eyz3 = $(this).data("aic2eyz3");            
      var si2x0ezp = $(this).data("si2x0ezp");      
      $.ajax ({
    type: 'POST', 
    url: 'cancelsentrequest.php',
    data: {
        'axiy2wi3': axiy2wi3,
        'aic2eyz3': aic2eyz3
    }, 
    success: function(bef_data){
        data = $.trim(bef_data);
        if (data === '1') {
            window.location = "loginform.html";
        }
        else if (data === '2') {
            $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","addfriend");
            $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class","addfriend");            
            $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Add Friend");  
        }
        else if (data === '3') {
            $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","addfriend");
            $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class","addfriend");            
            $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Add Friend");
        }
        else { 
            var errormessage = encodeURIComponent(data);
            var path = encodeURIComponent('findfriends.js/(sub)cancelsentrequest.php/error=else');
            $.post("senderror.php", 
            {
             'errormessage': errormessage,
             'path': path  
        });
            alert("There is something problem. Please contact 9640096621 for more details.");
            window.location = "loginform.html"; 
        }
    }
      });
    });
});

$(document).ready(function(){
    $(document).on("click", ".cancelrequest",function(){
      var axiy2wi3 = $(this).data("axiy2wi3");
      var aic2eyz3 = $(this).data("aic2eyz3");      
      var si2x0ezp =  $(this).data("si2x0ezp");
      var si2x0ezp2 = si2x0ezp + 'aic';
      $.ajax ({
    type: 'POST', 
    url: 'cancelrequest.php',
    data: {
        'axiy2wi3': axiy2wi3,
        'aic2eyz3': aic2eyz3        
    }, 
    success: function(bef_data){
        data = $.trim(bef_data);
if (data === '1') {
    window.location = "loginform.html";
}
else if (data === '2') {
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp2 +"']").hide();
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","addfriend");
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class", "addfriend");
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Add Friend");
}
else if (data === '3') {
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp2 +"']").hide();
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","addfriend");
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class", "addfriend");
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Add Friend");
}
else {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('findfriends.js/(sub)cancelrequest.php/error=else');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
    alert("There is something problem. Please contact 9640096621 for more details.");
    window.location = "loginform.html"; 
}
    }
      });
    });
});

$(document).ready(function(){
    $(document).on("click", ".acceptrequest",function(){
      var axiy2wi3 = $(this).data("axiy2wi3");
      var aic2eyz3 = $(this).data("aic2eyz3");      
      var si2x0ezp =  $(this).data("si2x0ezp");
      si2x0ezp2 = si2x0ezp.substring(0, 37); 
     
      $.ajax ({
    type: 'POST', 
    url: 'addtofriendslist.php',
    data: {
        'axiy2wi3': axiy2wi3, 
        'aic2eyz3': aic2eyz3
    }, 
    success: function(bef_data){
        data = $.trim(bef_data);
if (data === '1') {
    window.location = "loginform.html";
}
else if (data === '2') {
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp2 +"']").hide();
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","addfriend");
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class", "addfriend");
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Add Friend");
}
else if (data === '3') {
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp2 +"']").hide();
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","unfriend");
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class", "unfriend");
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Unfriend");    
}
else {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('findfriends.js/(sub)addtofriendslist.php/error=else');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
    alert("There is something problem. Please contact 9640096621 for more details.");
    window.location = "loginform.html";   
}
    }
      });
    });
});


$(document).ready(function(){
    $(document).on("click", ".unfriend",function(){
      var axiy2wi3 = $(this).data("axiy2wi3");
      var aic2eyz3 = $(this).data("aic2eyz3");
      var si2x0ezp = $(this).data("si2x0ezp");
      $.ajax ({
    type: 'POST', 
    url: 'unfriend.php',
    data: {
        'axiy2wi3': axiy2wi3,
        'aic2eyz3': aic2eyz3
    }, 
    success: function(bef_data){
        data = $.trim(bef_data);
if (data === '1') {
    window.location = "loginform.html";
}
else if (data === '2') {
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","addfriend");
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class", "addfriend");
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Add Friend");
}
else if (data === '3') {
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","addfriend");
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class", "addfriend");
    $("#displaybox").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Add Friend");
}
else {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('findfriends.js/(sub)unfriend.php/error=else');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
   alert("There is something problem. Please contact 9640096621 for more details.");
   window.location = "loginform.html";    
}
    }
      });
    });
});

$(document).ready(function(){
    $(document).on("click", ".acceptrequest_button",function(){
      var axiy2wi3 = $(this).data("axiy2wi3");
      var aic2eyz3 = $(this).data("aic2eyz3");       
     
      $.ajax ({
    type: 'POST', 
    url: 'addtofriendslist.php',
    data: {
        'axiy2wi3': axiy2wi3, 
        'aic2eyz3': aic2eyz3
    }, 
    success: function(bef_data){
        data = $.trim(bef_data);
if (data === '1') {
    window.location = "loginform.html";
}
else if (data === '2') {
    $("#friend_request_div").load(" #friend_request_div > * "); 
  $("#friend_request_div").load('friendrequestgot.php');        
}
else if (data === '3') {
    $("#friend_request_div").load(" #friend_request_div > * "); 
  $("#friend_request_div").load('friendrequestgot.php');      
}
else {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('findfriends.js/(sub)addtofriendslist.php"acceptrequest_button"/error=else');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
    alert("There is something problem. Please contact 9640096621 for more details.");
    window.location = "loginform.html";   
}
    }
      });
    });
});


$(document).ready(function(){
    $(document).on("click", ".cancelrequest_button",function(){
      var axiy2wi3 = $(this).data("axiy2wi3");
      var aic2eyz3 = $(this).data("aic2eyz3");      
      $.ajax ({
    type: 'POST', 
    url: 'cancelrequest.php',
    data: {
        'axiy2wi3': axiy2wi3,
        'aic2eyz3': aic2eyz3        
    }, 
    success: function(bef_data){
        data = $.trim(bef_data);
if (data === '1') {
    window.location = "loginform.html";
}
else if (data === '2') {
    $("#friend_request_div").load(" #friend_request_div > * ");    
  $("#friend_request_div").load('friendrequestgot.php'); 
}
else if (data === '3') {
    $("#friend_request_div").load(" #friend_request_div > * ");   
  $("#friend_request_div").load('friendrequestgot.php');     
}
else {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('findfriends.js/(sub)cancelrequest.php"cancelrequest_button"/error=else');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
    alert("There is something problem. Please contact 9640096621 for more details.");
    window.location = "loginform.html"; 
}
    }
      });
    });
});

$(document).ready(function(){
    $(document).on("click", ".addfriend_sf",function(){
      var axiy2wi3 = $(this).data("axiy2wi3");
      var aic2eyz3 = $(this).data("aic2eyz3");
      var si2x0ezp = $(this).data("si2x0ezp");
      $.ajax ({
    type: 'POST', 
    url: 'addfriend.php',
    data: {
        'axiy2wi3': axiy2wi3,
        'aic2eyz3': aic2eyz3
    }, 
    success: function(bef_data){
        data = $.trim(bef_data);
if (data === '1') {
    window.location = "loginform.html";
}
else if (data === '2') {
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Cancel Sent Request");
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","cancelsentrequest");
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class", "cancelsentrequest_sf");
}
else if (data === '3') {
    location.reload();
}
else {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('findfriends.js/(sub)addfriend.php"addfriend_sf"/error=else');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
   alert("There is something problem. Please contact 9640096621 for more details.");
   window.location = "loginform.html";    
}
    }
      });
    });
});

$(document).ready(function(){
    $(document).on("click", ".cancelsentrequest_sf",function(){
      var axiy2wi3 = $(this).data("axiy2wi3");
      var aic2eyz3 = $(this).data("aic2eyz3");            
      var si2x0ezp = $(this).data("si2x0ezp");      
      $.ajax ({
    type: 'POST', 
    url: 'cancelsentrequest.php',
    data: {
        'axiy2wi3': axiy2wi3,
        'aic2eyz3': aic2eyz3
    }, 
    success: function(bef_data){
        data = $.trim(bef_data);
        if (data === '1') {
            window.location = "loginform.html";
        }
        else if (data === '2') {
            $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","addfriend");
            $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class","addfriend_sf");            
            $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Add Friend");  
        }
        else if (data === '3') {
            $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","addfriend");
            $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class","addfriend_sf");            
            $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Add Friend");
        }
        else { 
            var errormessage = encodeURIComponent(data);
            var path = encodeURIComponent('findfriends.js/(sub)cancelsentrequest.php"cancelsentrequest_sf"/error=else');
            $.post("senderror.php", 
            {
             'errormessage': errormessage,
             'path': path  
        });
            alert("There is something problem. Please contact 9640096621 for more details.");
            window.location = "loginform.html"; 
        }
    }
      });
    });
});

$(document).ready(function(){
    $(document).on("click", ".cancelrequest_sf",function(){
      var axiy2wi3 = $(this).data("axiy2wi3");
      var aic2eyz3 = $(this).data("aic2eyz3");      
      var si2x0ezp =  $(this).data("si2x0ezp");
      var si2x0ezp2 = si2x0ezp + 'aic';
      $.ajax ({
    type: 'POST', 
    url: 'cancelrequest.php',
    data: {
        'axiy2wi3': axiy2wi3,
        'aic2eyz3': aic2eyz3        
    }, 
    success: function(bef_data){
        data = $.trim(bef_data);
if (data === '1') {
    window.location = "loginform.html";
}
else if (data === '2') {
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp2 +"']").hide();
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","addfriend");
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class", "addfriend_sf");
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Add Friend");
}
else if (data === '3') {
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp2 +"']").hide();
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","addfriend");
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class", "addfriend_sf");
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Add Friend");
}
else {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('findfriends.js/(sub)cancelrequest.php"cancelrequest_sf"/error=else');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
    alert("There is something problem. Please contact 9640096621 for more details.");
    window.location = "loginform.html"; 
}
    }
      });
    });
});

$(document).ready(function(){
    $(document).on("click", ".acceptrequest_sf",function(){
      var axiy2wi3 = $(this).data("axiy2wi3");
      var aic2eyz3 = $(this).data("aic2eyz3");      
      var si2x0ezp =  $(this).data("si2x0ezp");
      si2x0ezp2 = si2x0ezp.substring(0, 37); 
     
      $.ajax ({
    type: 'POST', 
    url: 'addtofriendslist.php',
    data: {
        'axiy2wi3': axiy2wi3, 
        'aic2eyz3': aic2eyz3
    }, 
    success: function(bef_data){
        data = $.trim(bef_data);
if (data === '1') {
    window.location = "loginform.html";
}
else if (data === '2') {
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp2 +"']").hide();
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","addfriend");
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class", "addfriend_sf");
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Add Friend");
}
else if (data === '3') {
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp2 +"']").hide();
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","unfriend");
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class", "unfriend_sf");
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Unfriend");    
}
else {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('findfriends.js/(sub)addtofriendslist.php"acceptrequest_sf"/error=else');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
    alert("There is something problem. Please contact 9640096621 for more details.");
    window.location = "loginform.html";   
}
    }
      });
    });
});


$(document).ready(function(){
    $(document).on("click", ".unfriend_sf",function(){
      var axiy2wi3 = $(this).data("axiy2wi3");
      var aic2eyz3 = $(this).data("aic2eyz3");
      var si2x0ezp = $(this).data("si2x0ezp");
      $.ajax ({
    type: 'POST', 
    url: 'unfriend.php',
    data: {
        'axiy2wi3': axiy2wi3,
        'aic2eyz3': aic2eyz3
    }, 
    success: function(bef_data){
        data = $.trim(bef_data);
if (data === '1') {
    window.location = "loginform.html";
}
else if (data === '2') {
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","addfriend");
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class", "addfriend_sf");
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Add Friend");
}
else if (data === '3') {
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("id","addfriend");
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("class", "addfriend_sf");
    $("#suggested_friends").find("[data-si2x0ezp='"+ si2x0ezp +"']").attr("value", "Add Friend");
}
else {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('findfriends.js/(sub)unfriend.php"unfriend"/error=else');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
   alert("There is something problem. Please contact 9640096621 for more details.");
   window.location = "loginform.html";    
}
    }
      });
    });
});

