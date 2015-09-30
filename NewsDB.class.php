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
		}
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
		try{
			$dt = time();
			$sql = "INSERT INTO msgs(
					title, 
					category, 
					description, 
					source, 
					datetime)
				VALUES ('$title', $category, '$description', '$source', $dt)";
			$res = $this->_db->exec($sql);
				if (!$res)
				throw new Exception($this->_db->lastErrorMsg());
		}
		catch(Exception $e){
			return false;		
		}
	}
	
	protected function db2Arr($data ){
		$arr = array();
			while ($row = $data->fetchArray(SQLITE3_ASSOC)){
			$arr[] = $row;
			}		
		return $arr;
		}

	function getNews(){
		try{
			$sql ="SELECT msgs.id as id, title, msgs.category as category, description, source, datetime FROM msgs, category WHERE category.id = msgs.category ORDER BY msgs.id DESC";
			$res = $this->_db->query($sql);
				if (!is_object ($res))
				throw new Exception($this->_db->lastErrorMsg());			
			return $this->db2Arr($res);
		}catch(Exception $e){
			// $e->getMessage(); // можно послать себе письмо с ошибкой
			return false;	
		}
	}

	function deleteNews($id){
		try{
		$sql = "DELETE FROM msgs WHERE id = $id";
		$res = $this->_db->exec($sql);
		if (!$res)
			throw new Exception($this->_db->lastErrorMsg());		
		return true;
		}
		
		catch(Exception $e){
			// $e->getMessage(); // можно послать себе письмо с ошибкой
			return false;
		}
	}
	
	function editNews($id){}

	function clearStr($data){
		$data = strip_tags(trim($data));	
		return $this->_db->escapeString($data);
	}

	function clearInt($data){
		return (int)(abs($data));
	}
	
	function __destruct(){
		unset($this->_db);
	}
}
?>