<form id="searchForm" class="form-group form-row" action="include/find.php" method="post">
    <input style="margin-left: 5px;" class="form-control col-3" type="text" name="searchWord" placeholder="Введите слово">
    <button class="btn btn-primary" type="submit" name="send">Найти</button>
    <div class="searchProgress col-3 form-control"></div>
</form>

<hr style="margin: 32px 0">

<div class="row">
    <div class="wordsContent col-6">
        <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th scope="col">Название статьи</th>
                <th scope="col">Кол-во вхождений</th>
            </tr>
        </thead>
        <tbody id="searchTable">
        </tbody>
        </table>
    </div>
    <div class="articleContent col-6">
        <p id="textWillBeHere">Здесь будет содержимое выбранной статьи</p>
    </div>
</div>
