<?
include 'NewsDB.class.php';
$id = newsDB::clearInt($_COOKIE['id']);
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$title = $_POST['title'];
	$category = $_POST['category'];
	$description = $_POST['description'];
	$source = $_POST['source'];
		if (empty($title) or empty ($description)){
			$errMSG = "Заполните поля правильно!";
		}
		else {
			$str = 'UPDATE msgs SET title = $title, category = $category, description = $description, source = $source WHERE id = $id';
			
			header ('Location: news.php');		
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
<input type="text" name="title" /><br />
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
<input type="submit" value="Добавить!" />

</form>