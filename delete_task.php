<?php session_start();
if (!$_SESSION['user']) {
    header('Location: reg.php');
}
$_SESSION['task_id'] = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление задачи</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="ar sty">
        <h1>Удаление задачи</h1>
        <p>Вы уверены что хотите удалить данное задание?</p>
        <div class="st">
            <a href="index.php">Нет</a>
            <a href="core/delete.php">Да</a>
        </div>
    </main>
</body>
</html>