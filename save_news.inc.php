<?php
//$title', $category, '$description', '$source', $dt
$title = $news->clearStr ($_POST['title']);
$category = $news->clearInt ($_POST['category']);
$description = $news->clearStr ($_POST['description']);
$source = $news->clearStr ($_POST['source']);
	if (empty($title) or empty ($description)){
		$errMSG = "Заполните поля правильно!";
	}
	else {
		$news->saveNews($title, $category, $description, $source);
		header ('Location: news.php');		
	}
?>