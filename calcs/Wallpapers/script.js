    // Контроль вводимых символов
document.querySelector('#room__length').addEventListener('keyup', function(){
    this.value = this.value.replace(/[^\d\.\,]/g, '');
});
document.querySelector('#room__width').addEventListener('keyup', function(){
    this.value = this.value.replace(/[^\d\.\,]/g, '');
});
document.querySelector('#room__height').addEventListener('keyup', function(){
    this.value = this.value.replace(/[^\d\.\,]/g, '');
});
document.querySelector('#roll__width').addEventListener('keyup', function(){
    this.value = this.value.replace(/[^\d\.\,]/g, '');
});
document.querySelector('#roll__length').addEventListener('keyup', function(){
    this.value = this.value.replace(/[^\d\.\,]/g, '');
});

    // Нажатие на кнопку
$(".btn").on('click', function () {
    calculation();
});

function calculation() {
    // Получение переменных
    var roomLength = Number($('#room__length').val().replace(/\,/g,'.'));
    var roomWidth = Number($('#room__width').val().replace(/\,/g,'.'));
    var roomHeight = Number($('#room__height').val().replace(/\,/g,'.'));
    var rollWidth = Number($('#roll__width').val().replace(/\,/g,'.'));
    var rollLength = Number($('#roll__length').val().replace(/\,/g,'.'));
    
    // Рассчёты
    var perimeter = (roomLength + roomWidth) * 2;
    var countOfClothNeeds = Math.ceil(perimeter / rollWidth);
    var countOfClothsInRoll = Math.floor(rollLength / roomHeight);
    var rollCountValue = Math.ceil(countOfClothNeeds / countOfClothsInRoll);

    // Вставить значение
    var $rollCount = document.querySelector('.count__rolls');
    $rollCount.innerText = rollCountValue;
}
