<?
class User {
	const DB_NAME = 'Z:\home\SQLite\www\try.db';
	public $_db;
	
	function __construct(){
		if(is_file (self::DB_NAME)){
			$this->_db = new SQLite3(self::DB_NAME);
			$sql = "INSERT INTO users ('name', 'lastname', 'age') VALUES('Ivan', 'Ivanov', 25)";
			$this->_db->exec($sql);
				
		}
		else{
			$this->_db = new SQLite3(self::DB_NAME);
			$sql = 'CREATE TABLE users (
						id INTEGER PRIMARY KEY AUTOINCREMENT,
						name TEXT,
						lastname TEXT,
						age INTEGER,
						dt DATETIME)';
			$this->_db->exec($sql) or die ($_db->lastErrorMsg());
		}
	}
	
	function ShowUsers(){
		$sql = "SELECT * FROM users";
		$res = $this->_db->query($sql);
		$arr = array();
			while ($row = $res->fetchArray(SQLITE3_ASSOC)){
			$arr[] = $row;
			}		
		echo "Всего юзеров ".count ($arr)."<br>";
		foreach ($arr as $item){
			$id = $item['id'];
			$name = $item['name'];
			$lastname = $item['lastname'];
			$age = $item['age'];
			$dt = $item['dt'];
			$dt = date('d-m-Y H:i:s');
			echo "$id $name $lastname $age $dt<br>";
		}
		}
	}


$user1 = new User;
$array = $user1->ShowUsers();
//var_dump($array);

?>