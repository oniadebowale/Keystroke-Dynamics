<?php
function usermessage($msg)
{
	$smsg = $msg;
	$msg = "<span class='Error'>$smsg</span>";
	$filename  = dirname(__FILE__).'/data.txt';
	file_put_contents($filename,$msg);
}

?>