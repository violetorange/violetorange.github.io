<form id="importForm" class="form-group form-row" action="include/insert.php" method="GET">
    <input style="margin-left: 5px;" class="form-control col-3" type="text" name="articleName" placeholder="Введите запрос">
    <button class="btn btn-primary" type="submit" name="send">Скопировать</button>
    <div class="progress col-3 form-control"></div>
</form>

<div class="importResult mt-3 mb-3"></div>

<hr>

<table class="tableResult table table-bordered table-hover">
    <thead>
        <tr>
            <th scope="col">Название статьи</th>
            <th scope="col">Ссылка</th>
            <th scope="col">Размер статьи</th>
            <th scope="col">Кол-во слов</th>
        </tr>
    </thead>
    <tbody id="importTable">
    </tbody>
</table>
    
    