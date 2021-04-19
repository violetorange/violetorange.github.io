<?php
    require "db.php";

    echo "<p>Импорт завершен</p><br>";
    echo "Найдена статья по адресу: ".end($articlesDatas)["url"]."<br>";
    echo "Время обработки: ".end($articlesDatas)["timing"]."<br>";
    echo "Размер статьи: ".end($articlesDatas)["size"]."<br>";
    echo "Кол-во слов: ".end($articlesDatas)["countOfWords"];
?>