<!-- Подключение БД и сессии с проверкой сессии пользователя -->
<?php session_start(); 
require_once 'core/db.php';
if (!$_SESSION['user']) {
    header('Location: reg.php');
}
$user = $_SESSION['user']['user_login'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задачи</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="ar task">
        <?php print_r($_SESSION['user']['id_rule']);?>
        <h1>Задачи</h1>
        <div class="menu">
            <a class="exit"href="logout_user.php">Выйти</a>
            <a class="add"href="add_task.php">Добавить</a>
        </div>
        <?php
            if ($_SESSION['user']['id_rule'] > 1) {
                $tasks = mysqli_query($connect, "SELECT * FROM `task` WHERE `task_login_customer` = '$user '");
            } else {
                $tasks = mysqli_query($connect, "SELECT * FROM `task`");
            }
            $tasks = mysqli_fetch_all($tasks);
            foreach ($tasks as $task) {
        ?>
        <div class="ts">
        <div class="edt dt">
            <p class="strt"><?= $task[7]?></p>
            <p class="nd"><?= $task[8]?></p>
        </div>
            <div class="tsk">
                <div class="header_tsk">
                    <div class="customer">
                        <p class="hc">Заказчик:</p>
                        <p class="nc"><?= $task[1]?></p>
                        <p class="ec"><?= $task[2]?></p>
                    </div>
                    <div class="executor">
                    <p class="he">Исполнитель:</p>
                        <p class="ne"><?= $task[3]?></p>
                        <p class="ee"><?= $task[4]?></p>
                    </div>
                </div>
                <h3 class="nm_tsk"><?= $task[5]?></h3>
                <p class="text"><?= $task[6]?></p>
            </div>
            <div class="edt">
                <a class="delete" href="delete_task.php?id=<?= $task[0]?>">Удалить</a>
                <a class="edit" href="edit_task.php?id=<?= $task[0]?>">Редактировать</a>
            </div>
        </div>
        <?php } ?>
    </main>
</body>
</html>