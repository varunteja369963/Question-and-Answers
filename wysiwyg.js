        
 window.addEventListener("load", function(){
           var richeditor = wysiwyg.document;
           richeditor.designMode = "on";
           var status1 = false; 
           var status2 = false; 
           var status3 = false; 
           var status4 = false; 
           var status5 = false; 
           var status6 = false; 
           var status7 = false; 
           var status8 = false; 
           var status9 = false; 
           var status10 = false; 
           var status11 = false; 
           var status12 = false; 
           var status13 = false; 
           var status14 = false; 
           var status15 = false; 

            Bold.addEventListener("click", function(){      
               richeditor.execCommand("Bold", false, null);
               if (!status1) {
                       document.getElementById("Bold").style.backgroundColor = "rgba(236, 239, 236, 1)";
                       document.getElementById("Bold").style.color = "rgba(80, 94, 83, 1)";
                       status1 = true;
               }
               else {
                       document.getElementById("Bold").style.backgroundColor = "#fff";
                       document.getElementById("Bold").style.color = "#000000";                       
                       status1 = false;
               }
               var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len); 
               
       },false);

       Italic.addEventListener("click", function(){ 
        if (!status2) {
                       document.getElementById("Italic").style.backgroundColor = "rgba(236, 239, 236, 1)";
                       document.getElementById("Italic").style.color = "rgba(80, 94, 83, 1)";
                       status2 = true;
               }
               else {
                       document.getElementById("Italic").style.backgroundColor = "#fff";
                       document.getElementById("Italic").style.color = "#000000";                       
                       status2 = false;
               }
               richeditor.execCommand("Italic", false, null);
               var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len);
       },false);
         
       Underline.addEventListener("click", function(){
        if (!status3) {
                       document.getElementById("Underline").style.backgroundColor = "rgba(236, 239, 236, 1)";
                       document.getElementById("Underline").style.color = "rgba(80, 94, 83, 1)";
                       status3 = true;
               }
               else {
                       document.getElementById("Underline").style.backgroundColor = "#fff";
                       document.getElementById("Underline").style.color = "#000000";                       
                       status3 = false;
               }
               richeditor.execCommand("Underline", false, null);
               var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len);
       },false);

        Strike.addEventListener("click", function(){
                if (!status4) {
                       document.getElementById("Strike").style.backgroundColor = "rgba(236, 239, 236, 1)";
                       document.getElementById("Strike").style.color = "rgba(80, 94, 83, 1)";
                       status4 = true;
               }
               else {
                       document.getElementById("Strike").style.backgroundColor = "#fff";
                       document.getElementById("Strike").style.color = "#000000";                       
                       status4 = false;
               }
               richeditor.execCommand("Strikethrough", false, null);
               var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len);
       },false);

       orderedList.addEventListener("click", function(){
                if (!status5) {
                       document.getElementById("orderedList").style.backgroundColor = "rgba(236, 239, 236, 1)";
                       document.getElementById("orderedList").style.color = "rgba(80, 94, 83, 1)";
                       status5 = true;
               }
               else {
                       document.getElementById("orderedList").style.backgroundColor = "#fff";
                       document.getElementById("orderedList").style.color = "#000000";                       
                       status5 = false;
               }
               richeditor.execCommand("InsertOrderedList", false, "newOL" + Math.round(Math.random() * 1000));
               var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len);
       },false);

           unorderedList.addEventListener("click", function(){
                if (!status6) {
                       document.getElementById("unorderedList").style.backgroundColor = "rgba(236, 239, 236, 1)";
                       document.getElementById("unorderedList").style.color = "rgba(80, 94, 83, 1)";
                       status6 = true;
               }
               else {
                       document.getElementById("unorderedList").style.backgroundColor = "#fff";
                       document.getElementById("unorderedList").style.color = "#000000";                       
                       status6 = false;
               }
               richeditor.execCommand("InsertUnorderedList", false, "newOL" + Math.round(Math.random() * 1000));
               var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len);
       },false);
       
       alignleft.addEventListener("click", function(){
               richeditor.execCommand("justifyleft", false, null);
               var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len);
       },false);

       aligncenter.addEventListener("click", function(){
               richeditor.execCommand("justifycenter", false, null);
               var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len);
       },false);

            alignright.addEventListener("click", function(){
               richeditor.execCommand("justifyright", false, null);
               var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len);
       },false);

       auto.addEventListener("click", function(){
               richeditor.execCommand("FontSize", false, "4");
               var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len);
       },false);

       h1.addEventListener("click", function(){
               richeditor.execCommand("FontSize", false, "10");
               var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len);
       },false);
       
       h3.addEventListener("click", function(){
               richeditor.execCommand("FontSize", false, "6");
               var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len);
       },false);

       h6.addEventListener("click", function(){
               richeditor.execCommand("FontSize", false, "2");
               var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len);
       },false);
  
       textcolor.addEventListener("change",function(event){
           richeditor.execCommand("ForeColor", false, event.target.value); 
           var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len);  
       },false);

       backcolor.addEventListener("change",function(event){
           richeditor.execCommand("BackColor", false, event.target.value);   
       },false);
       Link.addEventListener("click", function(){
               var url = prompt("Enter a URL", "http://");
               richeditor.execCommand("CreateLink", false, url);
               var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len);
       },false);

       Unlink.addEventListener("click", function(){
               richeditor.execCommand("UnLink", false, null);
               var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len);
       },false);

       sup.addEventListener("click", function(){
                if (!status14) {
                       document.getElementById("sup").style.backgroundColor = "rgba(236, 239, 236, 1)";
                       document.getElementById("sup").style.color = "rgba(80, 94, 83, 1)";
                       status14 = true;
               }
               else {
                       document.getElementById("sup").style.backgroundColor = "#fff";
                       document.getElementById("sup").style.color = "#000000";                       
                       status14 = false;
               }
               richeditor.execCommand("Superscript", false, null);
               var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len);
       },false);

       sub.addEventListener("click", function(){
                if (!status15) {
                       document.getElementById("sub").style.backgroundColor = "rgba(236, 239, 236, 1)";
                       document.getElementById("sub").style.color = "rgba(80, 94, 83, 1)";
                       status15 = true;
               }
               else {
                       document.getElementById("sub").style.backgroundColor = "#fff";
                       document.getElementById("sub").style.color = "#000000";                       
                       status15 = false;
               }
               richeditor.execCommand("Subscript", false, null);
               var iframeElement = document.getElementById("wysiwyg").contentWindow;
               iframeElement.focus();
               var len = iframeElement.length ;
               iframeElement.setSelectionRange(len, len);
       },false);

       },false);

           
    //start: for including vedio into wysiwyg
    var video_val = 0;
    $(document).ready(function(){
      $("#video").click(function(){
            var url1_before = prompt("Enter a URL", "http://");
            if (url1_before == null) {
                    return false;
            }
    var res = url1_before.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
    if (res == null) { 
    alert("Please enter a valid url");
    return false;
    }
    if (url1_before.length === 43) { 
    if (url1_before.substring(0, 32) === 'https://www.youtube.com/watch?v=') {
            var string = url1_before.substring(32, 43);
    video_val++;
    var video_name = "video" + video_val;
    var button_name = "button"+ video_val;
    $("#wysiwyg").contents().find('body').append("<div><input type = 'text' id = "+video_name+" class = 'vedio_content' value = "+url1_before+" readonly = 'readonly'/></div>");
    $("#wysiwyg").contents().find('body').append("<div><br/></div>"); 
    $("#wysiwyg").contents().find('body').append("<div><br/></div>"); 
    $("#wysiwyg").contents().find('body').find("#vedio_content").prop("readonly", true);
    }
    else {
            alert("Please enter a valid youtube url.");
            return false;
    }
    }
    else {
            alert("Please enter a valid youtube url.");
            return false;      
    }
    var url1 = encodeURIComponent(url1_before);
     });
    });
      