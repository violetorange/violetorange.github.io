<?php
    require "db.php";
    // Когда пользователь покидает или перезагружает страницу, все таблицы очищаются
    $clearStmt = $myDbConnection->prepare("SET FOREIGN_KEY_CHECKS = 0;");
    $clearStmt->execute();
    $clearStmt = $myDbConnection->prepare("TRUNCATE words;");
    $clearStmt->execute();
    $clearStmt = $myDbConnection->prepare("TRUNCATE articles;");
    $clearStmt->execute();
    $clearStmt = $myDbConnection->prepare("TRUNCATE count_table;");
    $clearStmt->execute();
    $clearStmt = $myDbConnection->prepare("SET FOREIGN_KEY_CHECKS = 1;");
    $clearStmt->execute();
?>