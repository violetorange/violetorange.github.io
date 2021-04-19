// Ajax на поиск статей в wiki. Отображение полученного контента   
$(document).on('submit', '#importForm', function(e) {
    e.preventDefault();
    NProgress.configure({ parent: '.progress', showSpinner: false });
    NProgress.start();
    $(".btn").attr("disabled", "disabled");
    $.ajax({
        type: $(this).prop('method'),
        url : $(this).prop('action'),
        data: $(this).serialize(),
        success: function(res) {
            $(".btn").removeAttr("disabled", "disabled");
            $('#importForm')[0].reset();
        }
    }).done(function() {
        NProgress.done();
        $('.importResult').load("include/refresh-importResult.php");
        $('#importTable').load("include/refresh-table.php");
    });
});

// Ajax на поиск слов в DB
$(document).on('submit', '#searchForm', function(e) {
    e.preventDefault();
    NProgress.configure({ parent: '.searchProgress', showSpinner: false });
    NProgress.start();
    $('.btn').attr('disabled', 'disabled');
    $.ajax({
        type: $(this).prop('method'),
        url : $(this).prop('action'),
        data: $(this).serialize(),
        success: function(res) {
            $(".btn").removeAttr("disabled", "disabled");
            $('#searchForm')[0].reset();
        }
    }).done(function() {
        NProgress.done();
        $('#searchTable').load("include/refresh-searchTable.php");
    });
});

// Показ текста статьи при клике на ссылку
$(function() {
    $(document).on('click', '.articleLink', function(e){
        e.preventDefault();
        // var myClass = "SomeClass";
        var articleId = $(this).prop('id');
             $.ajax({
                type: "POST",
                url: "include/refresh-articleBox.php",
                data: {"Id": articleId},
                cache: false,                       
                success: function(response){ 
                    if(response){
                            $('.articleContent').html(response); // выводим статью в нужный блок
                        } else {
                            $('.articleContent').html('<p>Возникла проблема</p>'); // сообщение об ошибке
                        }
                    }
            });
        return false;
    });
});

// Стирание таблиц при обновлении/покидании страницы
$(window).on('beforeunload', function(e) {
    $(document).load('include/leave.php');
    //Если не добавить подтверждение, страница может не успеть вызвать leave.php и не удалить данные из БД
    var confirmationMessage = "Удаление статей из БД";    
    (e || window.event).returnValue = confirmationMessage;
    return confirmationMessage;
});