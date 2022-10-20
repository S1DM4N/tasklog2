<?php session_start(); 
if (!$_SESSION['user']) {
    header('Location: reg.php');
}
require_once 'core/db.php';

$task_id = $_GET['id'];
$task = mysqli_query($connect, "SELECT * FROM `task` WHERE `task_id` = '$task_id'");
$task = mysqli_fetch_assoc($task);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="ar t_add">
        <h1>Редактирование задачи</h1>
        <form action="core/edit.php" method="post">
            <input type="hidden" name="task_id" value="<?= $task['task_id']?>">
            <h3>Заказчик:</h3>
            <label>Логин</label>
            <input type="text" name="login_cus" value="<?= $task['task_login_customer']?>" placeholder="Введите логин">
            <label>Почта</label>
            <input type="email" name="email_cus" value="<?= $task['task_email_customer']?>" placeholder="Введите эл.почту">
            <h3>Исполнитель:</h3>
            <label>Логин</label>
            <input type="text" name="login_exe" value="<?= $task['task_login_executor']?>" placeholder="Введите логин">
            <label>Почта</label>
            <input type="email" name="email_exe" value="<?= $task['task_email_executor']?>" placeholder="Введите эл.почту">
            <h3>Задание:</h3>
            <label>Название задания</label>
            <input type="text" name="name_task" value="<?= $task['task_name']?>" placeholder="Введите название задания">
            <label>Текст задания</label>
            <textarea name="text_task" placeholder="Введите задание" cols="30" rows="10"><?= $task['task_text']?></textarea>
            <h3>Сроки выполнения:</h3>
            <label>Дата начала:</label>
            <input type="date" name="date_star_task"  value="<?= $task['task_start_date']?>">
            <label>Дата окончания:</label>
            <input type="date" name="date_end_task" value="<?= $task['task_end_date']?>">
            <button>Отправить</button>
        </form>
        <a class="back" href="index.php">Назад</a>
    </main>
</body>
</html>