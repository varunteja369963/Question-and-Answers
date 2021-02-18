//start: for getting url
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
//end: for getting url

//start: checking the url
$(document).ready(function(){
 var grpname = getUrlParameter('name');    
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
                var path = encodeURIComponent('groupsearch.js/(sub)securitynetwork.php/error=2');
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
                var path = encodeURIComponent('groupsearch.js/(sub)securitynetwork.php/error=else');
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
//end: checking the url

     $(document).ready(function() {      
  $(window).keydown(function(event){
    if( (event.keyCode == 13)  ) {
      event.preventDefault();
      return false;
    }
  });
});

$(document).ready(function(){
 $("#display").css({"display": "none"});  
 $("#search").keyup(function(){
    var str = $("#search").val();
    if (str == "") { 
        $("#content").css({"display": "block"});
    $("#display").css({"display": "none"});                      
    } 
    else { 
        $("#content").css({"display": "none"});
        $("#display").css({"display": "block"});
    var grpname = getUrlParameter('name');
        if (str.length <= 2) { 
            document.getElementById("display").innerHTML = "no suggestions";
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
               document.getElementById("display").innerHTML = this.responseText;
            }
        };
        ajaxRequest.open("GET", "groupsearchlinkedlist.php?q=" + str + "&grpname=" + grpname, true);
        ajaxRequest.send();
    }  
}  
 });           
});

$(document).ready(function(){
        $(document).on("click","#addtogroup", function(){ 
          var cyke3lx93ja3lnkczldyb = $(this).data("cyke3lx93ja3lnkczldyb");
          var grpname = getUrlParameter('name');
          //$(this).val('Group Member');
            $.ajax({
                type: "POST",
                url: "addtogroup.php",
                data: {
                    "grpname" : grpname,
                    "cyke3lx93ja3lnkczldyb": cyke3lx93ja3lnkczldyb
                },
                success: function(bef_data){
                    var data = $.trim(bef_data);
                   if (data === '1') {
                    window.location = 'loginform.html';
                   }
                   else if (data === '2') {
                    var errormessage = encodeURIComponent(data);
                    var path = encodeURIComponent('groupsearch.js/(sub)addtogroup.php/error=2');
                    $.post("senderror.php", 
                    {
                     'errormessage': errormessage,
                     'path': path  
                });
                    alert('There is something problem. Please contanct 9640096621 for futher help');
                    location.reload(true);
                   }
                   else if(data === '3'){
                    location.reload(true);                       
                   }
                   else if (data === '4') {
                    $("[data-cyke3lx93ja3lnkczldyb='"+ cyke3lx93ja3lnkczldyb +"']").val("Group Member");
                    alert('Successfully added to the group'); 
                   }
                   else {
                    var errormessage = encodeURIComponent(data);
                    var path = encodeURIComponent('groupsearch.js/(sub)addtogroup.php/error=else');
                    $.post("senderror.php", 
                    {
                     'errormessage': errormessage,
                     'path': path  
                });
                    alert('There is something problem. Please contanct 9640096621 for futher help');
                    location.reload(true); 
                   }
                }
            });
       });
    });

