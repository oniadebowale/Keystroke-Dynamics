<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/
TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title>jQuery Comet demo</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /

  <script type="text/javascript" src="js/jquery.js"></script>
 </head>
 <body>
 <div id="comet_div"></div>
 <div id="content"></div>
 <input type="button" id="newframe" value="Start">
 <script type="text/javascript">
  byteoffset = 0;

  var comet =
   {
    load: function()
     {
      xstream  = new XMLHttpRequest();
      xstream.open("GET", "backend.php", true);
      xstream.onreadystatechange = function()
       {
        if(xstream.readyState == 3)
         {
          $("#comet_div").html(xstream.responseText);
		   comet.load();
         }
       }
      xstream.send(null);
     },

    clearMem: function()
     {
      $("#comet_div").html("");
     },
    time: function(ctime)
     {
      $("#content").html(ctime);
     }
   }

 $(document).ready(function()
   {
   comet.load();
   
   });
 </script>
 <body> 