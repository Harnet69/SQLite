<?
//include 'NewsDB.class.php';
$id = newsDB::clearInt($_COOKIE['id']);
//$title = newsDB::clearStr($_COOKIE['title']);
if (isset ($_POST['edited'])){
	$title = $_POST['title'];
	$category = $_POST['category'];
	$description = $_POST['description'];
	$source = $_POST['source'];
	echo "$title $category $description $source";
		if (empty($title) or empty ($description)or empty ($category)or empty ($source)){
			$errMSG = "Заполните все поля!";
		}
		else {
			$sql = "UPDATE msgs SET title = '$title', category = '$category', description = '$description', source = '$source' WHERE id = '$id'";
			$this->_db->exec($sql);
			//header ('Location: news.php');
			exit;	
		}
}

?>
<h1>Редактирование новости</h1>
<?php
	if ($errMSG){
		echo "<h3>".$errMSG."</h3>";
	}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

Заголовок новости:<br />
<input type="text" name="title"/><br />
Выберите категорию:<br />
<select name="category">
<option value="1">Политика</option>
<option value="2">Культура</option>
<option value="3">Спорт</option>
</select>
<br />
Текст новости:<br />
<textarea name="description" cols="50" rows="5"></textarea><br />
Источник:<br />
<input type="text" name="source" /><br />
<br />
<input type="submit" name="edited" value="Редактировать!" />

</form>