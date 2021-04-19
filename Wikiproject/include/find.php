<?php
    require "db.php";
        // Очистка таблицы количества вхождений перед новым поиском
        $clearStmt = $myDbConnection->prepare("TRUNCATE count_table;");
        $clearStmt->execute();
        // Поиск количества вхождений и добавление в БД
        $myInsertStatement = $myDbConnection->prepare("INSERT INTO count_table SELECT id_word, id_article, COUNT(*) AS count FROM words WHERE word = :searchWord GROUP BY id_article ORDER BY count DESC;");
        $myInsertStatement->bindParam('searchWord', $_POST['searchWord']);
        $myInsertStatement->execute();

?>
