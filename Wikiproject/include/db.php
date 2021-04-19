<?php
    // Соединение с БД
$serverName = "localhost";
$dataBase = "wiki_data"; 
$userName = "root";
$password = "root";
$sql = "mysql:host=$serverName;dbname=$dataBase;";
$dsnOptions = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::MYSQL_ATTR_LOCAL_INFILE => true];
$myDbConnection = new PDO($sql, $userName, $password, $dsnOptions);

    // Вывести данные из БД
    function articlesDatas() {
        global $myDbConnection;
        $stmt = $myDbConnection->query("SELECT * FROM articles");
        $data = $stmt->fetchAll();
        return $data;
    }
    $articlesDatas = articlesDatas();

    function wordsDatas() {
        global $myDbConnection;
        $stmt = $myDbConnection->query("SELECT * FROM words");
        $data = $stmt->fetchAll();
        return $data;
    }
    $wordsDatas = wordsDatas();

    function entryDatas() {
        global $myDbConnection;
        $stmt = $myDbConnection->query("SELECT articles.title, articles.article, articles.id_article, count_table.count FROM articles JOIN count_table ON count_table.id_article = articles.id_article ORDER BY count DESC;");
        $data = $stmt->fetchAll();
        return $data;
    }
    $entryDatas = entryDatas();