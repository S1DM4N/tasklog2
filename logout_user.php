<?php session_start();
if (!$_SESSION['user']) {
    header('Location: reg.php');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Выход</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="ar sty">
        <h1>Выход</h1>
        <p>Вы уверены что хотите выйти из аккаута?</p>
        <div class="st">
            <a href="index.php">Нет</a>
            <a href="core/log_out.php">Да</a>
        </div>
    </main>
</body>
</html>