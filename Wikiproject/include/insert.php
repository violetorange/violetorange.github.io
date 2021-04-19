<?php 
    require "db.php";

    $startTime = microtime(true); // Старт отсчёта времени выполнения запроса

    // Получить контент по api
    $nameEncoded = urlencode($_GET['articleName']);
    $urlApi = 'https://ru.wikipedia.org/w/api.php?action=query&format=json&prop=extracts&redirects=1&utf8=1&explaintext=1&exsectionformat=plain&titles='.$nameEncoded;

    // Обработка ответа
    $response = file_get_contents($urlApi);
    $jsonArray = json_decode($response,true);
    $normalizedArray = array_shift($jsonArray['query']['pages']);
    $title = $normalizedArray['title'];
    $url = "https://ru.wikipedia.org/wiki/".$title;
    $article = $normalizedArray['extract'];

    if ($article) {

        //Форматирование текста статьи
        $firstItr = preg_replace("(<[^<>]+>)", ' ', $normalizedArray['extract']); // Удаление тегов
        $secondItr = str_replace(["\n", "—", " - ", "́"], [" ", " ", " ", ""], $firstItr); // Замена тире, ошибочных дефисов, удаление ударений в словах
        $thirdItr = mb_eregi_replace("[^a-zа-яё0-9  -]", ' ', $secondItr); // Исключение всех лишних символов
        $textExplode = explode(" ", $thirdItr);
        foreach ($textExplode as $element) {
            if (!empty($element)) {
                $arrayOfWords[] = $element;
            }
        }
        $countOfWords = count($arrayOfWords);
        $articleSize = round((strlen($article) / 1024))."Kb";

        // Вставить результат в БД
        $myInsertStatement = $myDbConnection->prepare("INSERT INTO articles (title, url, size, countOfWords, article) VALUES (:title, :url, :articleSize, :countOfWords, :article)");
        $myInsertStatement->bindParam('title', $title);
        $myInsertStatement->bindParam('url', $url);
        $myInsertStatement->bindParam('articleSize', $articleSize);
        $myInsertStatement->bindParam('countOfWords', $countOfWords);
        $myInsertStatement->bindParam('article', $article);
        $myInsertStatement->execute();

        // Подготовить и записать атомы в файл для LOAD DATA INFILE
        $articleId = end($articlesDatas)['id_article'] + 1;
        foreach ($arrayOfWords as &$word) {
            $word = "|".$articleId.",".$word."\n";
        }
        $fp = fopen('file.csv', 'w');
        fwrite($fp, implode('', $arrayOfWords).";");
        fclose($fp);

        // Вставить в таблицу атомы
        $myInsertStatement = $myDbConnection->prepare("LOAD DATA LOCAL INFILE 'file.csv' INTO TABLE words FIELDS TERMINATED BY ',' LINES STARTING BY '|' (id_article, word);");
        $myInsertStatement->execute();

        // Подсчёт времени запроса и запись времени в БД
        $endTime = microtime(true);
        $timing = round($endTime - $startTime, 2)." сек."; // Итоговое время запроса
        $myInsertStatement = $myDbConnection->prepare("UPDATE articles SET timing = :timing WHERE id_article = (SELECT * FROM (SELECT MAX(id_article) FROM articles) AS id_article1);");
        $myInsertStatement->bindParam('timing', $timing);
        $myInsertStatement->execute();
    }
?>