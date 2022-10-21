<!-- Подключение к БД -->
<?php
    $connect = mysqli_connect('localhost' ,'root', '', 'tasklog');
if (!$connect) {
    die("Ошибка: " . mysqli_connect_error()); //Вывод ошибки подключения к БД
} 