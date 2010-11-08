<?php
$type = $_REQUEST['type'];
require 'Template.php'; 
require 'usermessage.php'; //used to send message to compent component in page.

switch($type)
{
	case 'new':
		$templateName = $_REQUEST['name'];
		$t = new Template();
		$t->newTemplate($templateName,false);
		$t->save();		
		usermessage("Template Created successfuly");
		break;
	default:
		usermessage("An Error Occured.");
		break;
	
}



?>