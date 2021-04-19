<?php
    require "db.php";
    // Таблица названий статей с количеством вхождений искомого слова
?>
<?php foreach ($entryDatas as $item) { ?>
            <tr>
                <td><?php echo '<a href="#" id="'.$item["id_article"].'" class="articleLink">'.$item["title"].'</a>' ?></td>
                <td><?php echo $item["count"] ?></td>
            </tr>
<?php } ?>
