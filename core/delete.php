<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: reg.php');
}
require_once 'db.php';

$task_id = $_SESSION['task_id'];

mysqli_query($connect, "DELETE FROM `task` WHERE `task`.`task_id` = '$task_id'");
header('Location: ../index.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="ar">
        <h1>Регистрация</h1>
        <p>Вы уверены что хотите удалить данное задание?</p>
        <div class="st">
            <a href="index.php">Нет</a>
            <a href="delete.php">Да</a>
        </div>
    </main>
</body>
</html>