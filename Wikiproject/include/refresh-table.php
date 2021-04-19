<?php
    require "db.php";
    // Таблица статей, найденных в wiki
?>
<?php foreach ($articlesDatas as $item) { ?>
            <tr>
                <td><?php echo $item["title"] ?></td>
                <td><?php echo $item["url"] ?></td>
                <td><?php echo $item["size"] ?></td>
                <td><?php echo $item["countOfWords"] ?></td>
            </tr>
<?php } ?>