<?php
$result = $news->getNews();
	if (is_array(!$result)){
		$errMsg = "Произошла ошибка при выводе ленты!";
	}
	else{ 
echo "<p>Всего последних новостей ".count ($result)."</p>";
foreach ($result as $item){
	$id = $item['id'];
	$title = $item['title'];
	$category = $item['category'];
	$description = $item['description'];
	$source = nl2br ($item['source']);
	$datetime = $item['datetime'];
	$datetime = date('d-m-Y H:i:s');
	echo <<<LABEL
	<hr>
	<h2>$title</h2>
	<p>$description</p>
	<p>$category @ $datetime</p>
	<p align="right"><a href="news.php?del=$id">Удаление</a>	
	<a href="news.php?edit=$id">Редактирование</a></p>	
LABEL;
}
	}
?>