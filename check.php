<?php
//process Ajax username request
$username =  htmlspecialchars($_REQUEST['username']);
//include db singleton object
require_once 'Singleton.php';
$db = DatabaseConnection::get()->handle();
//$db->debug = true;
//query to check weather username exist
$recordSet = &$db->Execute('select Name from Patterns where Name = "'.$username.'" group by Name');
if($recordSet->RecordCount() == 1) echo 1;
else 0;
$recordSet->Close();	

?>