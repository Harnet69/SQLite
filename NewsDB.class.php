<?php
/* function __autoload($name){
	include $name.".class.php";
}
*/
class NewsDB {// implements INewsDB
	const DB_NAME = 'Z:\home\SQLite\www\test.db';
	protected $_db;
	
	function __construct(){
		$this_db = new SQLite3(self:: DB_NAME);
	}
	
	function __destruct(){
		unset($this->_db);
	}
}

$news = new NewsDB();
?>