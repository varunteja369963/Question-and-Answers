
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
        var path = encodeURIComponent('homepage.js/(sub)securitynetwork2.php/error=else');
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

$(document).ready(function() { 
        $.get("stillalive.php");
   /* $("#menubox").show();
    $("#menubox").addClass("addingclass2");*/
});
        
$(document).ready(function() {
$(window).keydown(function(event){
if( (event.keyCode == 13)  ) {
event.preventDefault();
return false;
}
});
});

   var sno = "<?php echo $sno;?>";
   function ajaxFunction(str){
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

   
   $(document).ready(function() {
    $("#textbox").focus(function(){
        $("#displaybox").show();
      $("#displaybox").addClass("addingclass");
    });
    $('#close').click(function(){
       $("#displaybox").hide();
    });
});

var menucount = false;
$(document).ready(function(){
    $("#menubox").show();
    $("#menubox").addClass("addingclass2");
menucount = true;

    $("#menu").click(function(){
  if (!menucount) {
    $("#menubox").show();
    $("#menubox").addClass("addingclass2");
    menucount = true;
  }
  else {
    $("#menubox").hide();
    menucount = false;    
  }
    });
});

$(document).ready(function(){
  $(".messaging").click(function(){
      window.location = "messaging.html";
  });

  $(".register").click(function(){
      window.location = "solvemyproblemtoolbar.html";
  });

  $(".login").click(function(){
    window.location = "shareideatoolbar.html";
});

$("#menu2").click(function(){
    window.location = "groupfrontpage.php";
});

$("#myprofile").click(function(){
    window.location = "redirect.php";
});

$("#logout").click(function(){
  window.location = "logout.php";
});
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
    $("#displaybox").load(" #displaybox > * ");
}
else {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('homepage.js/(sub)addfriend.php/error=else');
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
            var path = encodeURIComponent('homepage.js/(sub)cancelsentrequest.php/error=else');
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
    var path = encodeURIComponent('homepage.js/(sub)cancelrequest.php/error=else');
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
    var path = encodeURIComponent('homepage.js/(sub)addtofriendslist.php/error=else');
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
    var path = encodeURIComponent('homepage.js/(sub)unfriend.php/error=else');
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

$(window).on('pageshow', function(){          
    $.ajax({
        type: 'POST',
        url: 'requestgot.php',
      success: function(output){
        $("#request_got_text").html(output);
      }
    });
});

$(window).on('pageshow', function(){          
    $.ajax({
        type: 'POST',
        url: 'pendingmessages.php',
        success: function(output) {
            if (output == 0) { 
            $(".pending_messages").remove();
            }
            else {
                $(".pending_messages").css("display", "block");
            $(".pending_messages").html(output);                
            }
        }
    });
});

$(document).ready(function(){
  $("#request_got").click(function(){
      window.location = "findfriends.php";
  })
});
 
   


   