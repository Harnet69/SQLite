<?php
$title = $news->clearStr ($_POST['title']);
$category = $news->clearInt ($_POST['category']);
$description = $news->clearStr ($_POST['description']);
$source = $news->clearStr ($_POST['source']);
	if (empty($title) or empty ($description)){
		$errMSG = "Заполните поля правильно!";
	}
	else {
		if (!$news->saveNews($title, $category, $description, $source)){
		$errMSG = "Ошибка при записи!";	
		}
		else {
		header ('Location: news.php');	
		exit;		
		}
	}
?>