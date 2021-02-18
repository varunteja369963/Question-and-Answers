var counter = true;
$(document).ready(function() {
    $(document).on("click", "#edit_button", function(){
        var button_uuid = $(this).data('uuid');
        var button_num = $(this).data('num');
        if (counter) { 
       $('.' + button_uuid).attr('contenteditable', 'true');
       $('.' + button_uuid).html('');   
       $('.' + button_uuid).focus();
       $('.' + button_uuid).css({'overflow':'hidden'});
       $(this).html('post'); 
       counter = false;
        }
        else {
            var bef_answer = $('.' + button_uuid).html();
            var before_answer = bef_answer.replace(/<br>+/g,'');          
            var before_answer1 = before_answer.replace(/&nbsp;/g, " ");
            var before_answer2 = $.trim(before_answer1); 
            var answer = encodeURIComponent(before_answer2);
         
       if (answer == "") {
        $('.' + button_uuid).html('........');  
        counter = true;
        $('.' + button_uuid).attr('contenteditable', 'false');
        $(this).html('edit');                              
           return false;
       }
            $.ajax({
                type: 'POST',
                url: 'updatemydata.php',
                data: {
                    'answer': answer,
                    'num': button_num
                },
                success: function(data){
            if (data === '1') {
                decondeURIComponent($('.' + button_uuid).html(answer));
            }
            else if (data === '2') {
                alert("there is something problem. Please contact 9640096621 for futher help");
                $('.' + button_uuid).html('........');   
                var errormessage = encodeURIComponent(data);
                var path = encodeURIComponent('aboutme.js/(sub)updatemydata.php/error=2');
                $.post("senderror.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });         
            }
            else {
                var errormessage = encodeURIComponent(data);
                var path = encodeURIComponent('aboutme.js/(sub)updatemydata.php/error=else');
                $.post("senderror.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });
               window.location = "loginform.php";
            }
                }
            });
         counter = true;
       $('.' + button_uuid).attr('contenteditable', 'false');
       $('.' + button_uuid).css({'overflow':'auto'});                
         $(this).html('edit');
        }
    });
});

var counter1 = true;
$(document).ready(function(){
    $(document).on("click", "#edit_quote_button", function(){
        if (counter1) { 
      $("#quote").attr('contenteditable', 'true');
      $("#quote").focus();
      $("#quote").css({"background-color": "#dee3df", "overflow": "hidden", "padding": "5px 10px", "border": "none"});
      $(this).html('post');
      $("#quote").html('');
      counter1 = false;
        }
        else {
            var quote_of_the_day = $("#quote").html();
            if (quote_of_the_day == "") {
                return false;
            }
$.ajax({
    type: 'POST',
    url: 'insertquote.php',
    data: {
        'quote': quote_of_the_day
    },
    success: function(data){
if (data == 1) {
    $("#quote").html(quote_of_the_day);
}
else if (data == 2) {
    alert("there is something problem. Please contact 9640096642 for futher help");
    $("#quote").html('......');
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('aboutme.js/(sub)insertquote.php/error=2');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});  
}
else {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('aboutme.js/(sub)insertquote.php/error=else');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
}); 
    window.location = "loginform.php";
}
    }
});
$("#quote").attr('contenteditable', 'false');
$("#quote").css({"background-color":"#fff", "overflow-y": "auto", "padding": "0px", "border": "none"});
$(this).html('edit');
counter1 = true;
        }
    });
});

$(document).ready(function(){
    $("#message").click(function(){
      window.location = "messaging.html";
    });
});



$(document).ready(function() {
  $('#update_profile_pic').change(function(e) { 
      e.preventDefault();
      $(".loader").css({"display": "block"});
      $("#picture").css({"display": "none"});
      var form = $('form')[0];
      var imagedata = new FormData(form);
      $.ajax({
        url: 'fileupload.php',
        type: 'POST',
        data: imagedata,
        cache:false,
        contentType: false,
        processData: false,
        success: function(bef_data) {
            var data = $.trim(bef_data);
            if (data === '1') {
               window.location = "loginform.html";
            }
            else if (data === '2') {
                alert('Only JPEG or PNG images are allowed');
                location.reload(true);
            }
            else if (data === '3') {
                alert("This image is more than 1.5MB. Sorry, it has to be less than or equal to 1.5MB");
                location.reload(true);
            }
            else if (data === '4') {
                location.reload(true);
            }

            else if (data === '5') {
                var errormessage = encodeURIComponent(data);
                var path = encodeURIComponent('aboutme.js/(sub)fileupload.php/error=5');
                $.post("senderror.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });
                alert("An error occured. Please contact 9640096621 for more detials");
                location.reload(true);
            }
            else {
                var errormessage = encodeURIComponent(data);
                var path = encodeURIComponent('aboutme.js/(sub)fileupload.php/error=else');
                $.post("senderror.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });
                alert("An error occured. Please contact 9640096621 for more detials");
                location.reload(true);
            }
        }
      });
  });
});
/*
var pic_bool = false;
$(document).ready(function(){
    $("#picture").click(function(){
if (!pic_bool) {
  $(".profile_pic").css({"width": "98vh", "height": " 80vh", "z-index": "100"});
  pic_bool = true;
}
else {
    $(".profile_pic").css({"width": "200px", "height": "200px", "margin-top": "0%", "margin-bottom": "0%", "z-index": "100"});
    pic_bool = false;
}
    })
})*/

