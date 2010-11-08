<?php
//initialize comet
$msg = "<span class='Green'>Please enter a password in the textbox below.Guide to bettern pattern generation can be found <a href='#'>here</a>. Once you are done. Press Enter (Return) Key. And repeat. You need minimum 12 successfull patterns before you can create a Template for Authentication</span>";
$filename  = dirname(__FILE__).'/data.txt';
file_put_contents($filename,$msg);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Keystroke Dynamics - Home</title>
<script src="js/jquery.js" > </script> <!-- need for animations, ajax, UI effects. etc..-->
<script src="js/jquery.corner.js" > </script> <!-- round corners in UI etc..-->
<script src="js/main.js" type="text/javascript" ></script> <!-- Controller file to facilitate all js on page etc..-->
 <script src="jquery.alerts/jquery.alerts.js" type="text/javascript"></script> <!-- Jquery alert plugin js file..-->
<link href="jquery.alerts/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" /> <!-- Jquery alert plugin css file-->
<script type="text/javascript" src="js/prototype.js"></script> <!-- Needed for comet implimentation..-->
<script type="text/javascript" src="js/comet.js"></script> <!-- The actual implementation of comet etc..-->
<link href="css/global.css" rel="stylesheet" type="text/css" /> <!-- All the style information..-->
</head>
<body>
    
<div id="sub-link-bar"> </div>
<!-- End sub-link-bar -->
<div id="wrap">
  <?php require 'menu.php'; ?>
  
  <div id="leftheader">
  
    <h3>Register</h3>
  </div> <!-- end of lefthead -->

   <div id="headerwrapper">
      <div id="header" >
        <h3>Keystroke Dynamics</h3>
        <p class="minitext">a final year project
        <p> 
      </div>
   </div> <!--end headerwrapper -->
	<div id="cometinfo"></div>
	<div id="appletdiv">
  <span class="minitext">Enter Password below:(Press return when you are done.)</span><br /><iframe id='appletframe' width="250px" height="50px" frameborder="0" scrolling="no"></iframe>
  <br />
  <input type="button" name="attempt" id="attempt" value="New Attempt" />
  </div>
  <div id="leftcontent">
    <form id="form1" name="form1" method="post" action="">
      <label>Name
      <input name="username" type="text" id="username" />
      </label>
        <label>
        <input type="button" name="proceed" id="proceed" value="Proceed"  /><input type='button' id='create' name='create' value='Create Template' />
        </label>
    <span id="usernameinfo"></span></form>
	

  </div> <!--end leftcontent -->
  
  

  
</div>
<!-- End wrap -->
<div id="footer">copyleft 2009 . jinahadam </div>
</body>
</html>
