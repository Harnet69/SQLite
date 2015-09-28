<?
class User {
	const DB_NAME = 'Z:\home\SQLite\www\try.db';
	private $_db;
	
	function __construct(){
		if(is_file (self::DB_NAME)){
			$_db = new SQLite3(self::DB_NAME);
			$sql = "INSERT INTO users ('name', 'lastname', 'age') VALUES('Ivan', 'Ivanov', 25)";
			$_db->exec($sql);
			//$sql = "SELECT * FROM user";
			
		}
		else{
			$_db = new SQLite3(self::DB_NAME);
			$sql = "CREATE TABLE users (
						id INTEGER PRIMARY KEY AUTOINCREMENT,
						name TEXT,
						lastname TEXT,
						age INTEGER)";
			$_db->exec($sql) or die ($_db->lastErrorMsg());
		}
	}
}

$user1 = new User;

?>