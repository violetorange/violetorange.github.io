<?php
require "db.php";

// Запрос текста статьи из БД
$articleId = (int)$_POST['Id'];

$stmt = $myDbConnection->prepare('SELECT article FROM articles WHERE id_article = :articleId ;');
$stmt->bindParam("articleId", $articleId);
$stmt->execute();
$requestedArticle = $stmt->fetchAll();

echo '<p>'.$requestedArticle[0]["article"].'</p>';










