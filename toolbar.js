var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};


 var grpname = getUrlParameter('name');
$(document).ready(function(){
   if (grpname === undefined) {
       window.location = "loginform.html";
       return false;
   }
   else {
       if (grpname.length !== 70) {
           window.location = "loginform.html";
           return false;
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
                var errormessage = encodeURIComponent(data);
                var path = encodeURIComponent('toolbar.js/(sub)securitynetwork.php/error=1');
                $.post("senderror.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });
                  alert("Sorry for interrupting you. Please login again to continue");
                  window.location = "loginform.html";
              }
              else if (data === '3') {

              }
              else {
                var errormessage = encodeURIComponent(data);
                var path = encodeURIComponent('toolbar.js/(sub)securitynetwork.php/error=else');
                $.post("senderror.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });
                  alert("There is something wrong. Please contact 7675805437 for futher help");
              }
           }
           });
       }
   }
});

//start: get total number of records from database
var maxid;
var this_page;
$(document).ready(function(){
    this_page = true;
    $.ajax({
        type: 'POST',
        url: "getrecords.php", 
        data: {
            'groupname': grpname
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
        url: "questions.php", 
        data: {
            'groupname': grpname,
            'maxid': maxid
    },
        success: function(data){
            if (data === '1') {
                window.location = "loginform.html";
            }
            else { 
    $("#content_window").append(data);
            }
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
     maxid = maxid - 10;
     if (maxid >= 1) { 
     $.ajax({
        type: 'POST',
        url: "questions.php", 
        data: {
            'groupname': grpname,
            'maxid': maxid
    },
        success: function(data){
    $("#content_window").append(data);
        }
    });
}
  }
}
});   
});
//end: fetching data after scrolling down 

//start: when button click
$(document).ready(function(){
    $('.questions').click(function(){
        this_page = true;
        location.reload(true);
 });
});
//end: when button click

//start: edit groupname
$(document).ready(function(){
    $(".askquestion").click(function(){
        window.location = "askquestion.html?groupname=" + grpname;
    }); 
});

$(document).ready(function(){
    $(".personaldatabase").click(function(){
        this_page = false;
        $("#content_window").load("personaldatabase.php?name=" + grpname);
    }); 
});

$(document).ready(function(){
    $(document).on("click", "#edit_grpname", function(){
            var check_groupname_bef = $("#content_window").find("#groupname_edit").val();
            var check_groupname = $.trim(check_groupname_bef);
            if (check_groupname.length < 4 || check_groupname > 25) {
            $("#groupname_ack").text("");                
                $("#groupname_ack").text("Your groupname should contain atleast 4 characters")
                return false;
            }
            if (check_groupname == "") {
                return false;
            }
            if(!/[^a-zA-Z0-9 ]/.test(check_groupname)) {
               var cile50xllsy = $(this).data('cile50xllsy'); 
                $.ajax({
                  type: 'POST', 
                  url: 'updategroupname.php', 
                  data: { 
                      'cile50xllsy': cile50xllsy,
                      'groupname': check_groupname
                  },
                  success: function (data) {
                  if (data === '1'){
                        var errormessage = encodeURIComponent(data);
                        var path = encodeURIComponent('toolbar.js/(sub)updategroupname.php/error=1');
                        $.post("senderror.php", 
                        {
                         'errormessage': errormessage,
                         'path': path  
                    }); 
                    window.location = "loginform.html";
                  }
                  else if (data === '2') { 
                    var errormessage = encodeURIComponent(data);
                    var path = encodeURIComponent('toolbar.js/(sub)updategroupname.php/error=2');
                    $.post("senderror.php", 
                    {
                     'errormessage': errormessage,
                     'path': path  
                });                      
                     alert("Please do not change any javascript code");
                     location.reload();
                  }
                  else if (data === '3') {
                    $("#groupname_ack").text("");
                    $("#groupname_edit").val(check_groupname);
                  }
                  else {
                    var errormessage = encodeURIComponent(data);
                    var path = encodeURIComponent('toolbar.js/(sub)updategroupname.php/error=else');
                    $.post("senderror.php", 
                    {
                     'errormessage': errormessage,
                     'path': path  
                }); 
                      alert("There is something problem. Please contact 9640096621 for futher help");
                      location.reload();
                  }
                  }
                });
            }
                else { 
                    $("#groupname_ack").text("");                                
                    $("#groupname_ack").text("Your groupname should not contains any special characters like (ex:_#$%*(!@\")")
                    }
    });
});
//end: edit groupname

$(document).ready(function(){  
    $(document).on("keyup", "#groupname_edit", function(){ 
        var str = $("#content_window").find("#groupname_edit").val();      
   count = 25;
   length = str.length;
   count = count - length;
$("#groupname_ack").text(count + " characters left");
  }); 
});  

$(document).ready(function(){
    $(".askquestion").click(function(){
        window.location = "askquestion.html?groupname=" + grpname;
    }); 
});

$(document).ready(function(){
    $(".personaldatabase").click(function(){
        this_page = false;
        $("#content_window").load("personaldatabase.php?name=" + grpname);
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
        var data = alert(bef_data);
if (data === '1') {
    $("#content_window").find("#quote").html(quote_of_the_day);
}
else if (data === '2') {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('toolbar.js/(sub)insertquote.php/error=2');
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
    var path = encodeURIComponent('toolbar.js/(sub)insertquote.php/error=else');
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
    $(document).on("click", "#fri_name", function(){
        var userax0z = $(this).data('userax0z');
        window.location = "aboutme.php?q=" + userax0z;
    });
});

$(document).ready(function() {
    $(document).on("click", "#my_name", function(){
        var userax0z = $(this).data('cz0x8h');
        window.location = "aboutme.php?q=" + userax0z;
    });
});

