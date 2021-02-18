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

function passingname(value){
    $(document).ready(function(){
        var grpname = $(value).attr('id');
        $.ajax({
            type: 'post',
            url: 'checkingfriends.php',
            data: {
                'grpname': grpname
            },
            success: function(bef_data) {
                var data = $.trim(bef_data);
              if (data === '1') {
                window.location = "toolbar.html?name=" + grpname;
              }
              else if (data === '2') {
                  alert("Add your friends into this group.");
              }
              else if (data === '3') {
                  window.location = 'loginform.html';
              }
              else {
                var errormessage = encodeURIComponent(data);
                var path = encodeURIComponent('groupfrontpage.js/(sub)checkingfriends.php/error=else');
                $.post("senderror.php", 
                {
                 'errormessage': errormessage,
                 'path': path  
            });
                  alert("There is something problem. Please contact 9640096621 for futher details.");
              }
            }

        });
    });
}

function passingid(value){
    $(document).ready(function(){
        var sno = $(value).attr('id');
        var grpname = $(value).data('grpname');
        window.location = "groupsearch.php?name=" + grpname;
    });
}

    $(document).ready(function(){
        $(".creategroup").click(function(){      
$("#creategroupbox").show();            
         $("#creategroupbox").addClass("addingclass");     
        $("#creategroupbox").load("groupname.html");
    });

        $(document).on("click", "#close", function(){
            $("#creategroupbox").hide();            
        });
    });
 
 
         $(document).ready(function(){  
             $(document).on("keyup", "#groupname", function(){ 
                 var str = $("#groupname").val();      
            count = 25;
            length = str.length;
            count = count - length;
         $("#counttag").text(count + " characters left");
           }); 
        });  

        
    $(document).ready(function(){
        $(document).on('click', "#group_submit", function(e){
            e.preventDefault(); 
            var check_groupname = $.trim($("#groupname").val());
            $("#groupname_ack").text("");
            if (check_groupname.length < 4 || check_groupname > 25) {
                $("#groupname_ack").text("Your groupname should contain atleast 4 characters")
                return false;
            }
        
            if(!/[^a-zA-Z0-9 ]/.test(check_groupname)) {
$.ajax({
  type: 'POST', 
  url: 'creategroup.php', 
  data: $('#form').serialize(),
  success: function (bef_data) {
      var data = $.trim(bef_data);
  if (data === '1'){
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('groupfrontpage.js/(sub)creategroup.php/error=1');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
     alert("Please do not change any javascript code");
      location.reload();
  }
  else if (data === '2') {
      alert('Group created successfully');
      location.reload();
  }
  else if (data === '3') {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('groupfrontpage.js/(sub)creategroup.php/error=3');
    $.post("senderror.php", 
    {
     'errormessage': errormessage,
     'path': path  
});
    alert('There is something problem. Please contact 9640096621 for futher help');
    location.reload();
  }
  else if (data === '4') {
      window.location = "loginform.html";
  }
  else {
    var errormessage = encodeURIComponent(data);
    var path = encodeURIComponent('groupfrontpage.js/(sub)creategroup.php/error=else');
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
                $("#groupname_ack").text("Your groupname should not contains any special characters like (ex:_#$%*(!@\")")
            }
        
        });
    });

