<?php

require_once 'adodb5/adodb.inc.php';
//require_once 'adodb_lite/tohtml.inc.php';

class DatabaseConnection
{
  public static function get()
  {
    static $db = null;
    if ( $db == null )
      $db = new DatabaseConnection();
    return $db;
  }

  private $_handle = null;

  private function __construct()
  {  
	$db = ADONewConnection('mysql','pear:extend');
	$db->createdatabase = true ;
	$db->Connect("jinahadam.db.4081957.hostedresource.com", "jinahadam", "Relevation#666", "jinahadam");

	$this->_handle =& $db;
  }
  
  public function handle()
  {
    return $this->_handle;
  }
}

?>