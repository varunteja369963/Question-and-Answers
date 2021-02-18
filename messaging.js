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
        var path = encodeURIComponent('messaging.js/(sub)securitynetwork.php/error=else');
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

function searching(str){
  $(document).ready(function(){ 
  if ($("#search_friend_box").val() == "") {
  $("#search_friend_box").css({"width": "53%", "color": "#fff", "background-color": "#545454", "transition" : "width 1s"});        
$("#users_for_chat_outerbox").load("messaging.php");   
}
});
$("#search_friend_box").css({"width": "93%", "color": "#000000", "background-color": "#fff", "transition" : "width 1s"});        

      if (str.length < 3) { 
      document.getElementById("users_for_chat_outerbox").innerHTML = "";
     return;
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
             document.getElementById("users_for_chat_outerbox").innerHTML = this.responseText;
          }
      };
      ajaxRequest.open("GET", "messaginglinkedlist.php?q=" + str, true);
      ajaxRequest.send();
  }  
}

$(document).ready(function() {
    $("#search_friend_box").val("");
});

$(document).ready(function(){
  $("#search_friend_box").click(function() {
    $("#search_friend_box").css({"width": "93%", "color": "#000000", "background-color": "#fff", "transition" : "width 1s"});
  });
});

$(document).ready(function(){
  $("#users_for_chat_outerbox").load("messaging.php");
});

$(document).ready(function(){
  $(document).on("click", ".button_details", function(){
    $("#main_frame").css("display", "none");
    $(".message_display").css({"display":"block"});
    var fid = $(this).attr("id");
    var fname = $(this).attr("name");
    $("#message_display").load("message.php?id=" + fid + '&username=' + fname, function(){
        $("#displaymessages").animate({ scrollTop: $('#displaymessages').prop("scrollHeight")}, 50);
    //  $('#displaymessages').scrollTop($('#displaymessages')[0].scrollHeight - $('#displaymessages')[0].clientHeight);
    });
  });
});

$(document).ready(function(){
    $(document).on("click", "#close_button", function(){
location.reload(true);
    });
});

