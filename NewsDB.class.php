<?php
 function __autoload($name){
	include $name.".class.php";
}

class NewsDB implements INewsDB{
	const DB_NAME = 'Z:\home\SQLite\www\news.db';
	protected $_db;
	
	function __construct(){
		if (is_file(self:: DB_NAME)){
			$this->_db = new SQLite3(self:: DB_NAME);
			echo "Какаха";}
		else{
			$this->_db = new SQLite3(self:: DB_NAME);
			$sql = "CREATE TABLE msgs(
				id INTEGER PRIMARY KEY AUTOINCREMENT,
				title TEXT,
				category INTEGER,
				description TEXT,
				source TEXT,
				datetime INTEGER
				)";
			$this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
			$sql = "CREATE TABLE category(
				id INTEGER,
				name TEXT
				)";
			$this->_db->exec($sql) or die ($this->_db->lastErrorMsg());

			$sql = "INSERT INTO category(id, name)
				SELECT 1 as id, 'Политика' as name
				UNION SELECT 2 as id, 'Культура' as name
				UNION SELECT 3 as id, 'Спорт' as name ";
			$this->_db->exec($sql) or die ($this->_db->lastErrorMsg());
		}
	}

	function saveNews($title, $category, $description, $source){
		$dt = time();
		$sql = "";
}
	
	function getNews(){}

	function deleteNews($id){}

	function __destruct(){
		unset($this->_db);
	}
}

?>