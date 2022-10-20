<?php session_start(); 
if (isset($_SESSION['user'])) {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="h_ar"><p>Добро пожаловать! Зарегистрируйтесь или войдите в аккаунт.</p></header>
    <main class="ar">
        <h1>Регистрация</h1>
        <form action="core/log_in.php" method="post">
            <h3>Личная информация:</h3>
            <label>Фамилия</label>
            <input type="text" name="surname" placeholder="Введите фамилию">
            <label>Имя</label>
            <input type="text" name="name" placeholder="Введите имя">
            <label>Отчество</label>
            <input type="text" name="patronymic" placeholder="Введите отчество">
            <h3>Персональные данные:</h3>
            <label>Логин</label>
            <input type="text" name="login" placeholder="Введите логин">
            <label>Почта</label>
            <input type="email" name="email" placeholder="Введите эл.почту">
            <label>Тип пользователя</label>
            <select name="user_rule" required="required">
                <option class="one" value="">Выберите значение</option>
                <option value="2">Заказчик</option>
                <option value="3">Исполнитель</option>
            </select>
            <label>Пароль</label>
            <input type="password" name="password" placeholder="Введите пароль">
            <label>Подтверждение пароля</label>
            <input type="password" name="conf_password" placeholder="Подтвердите пароль">
            <button>Войти</button>
        </form>
        <?php 
            if (isset ($_SESSION['message'])) {
                echo '<div class= mes><p class=msg>' . $_SESSION['message'] . ' </p></div>';
            }
            unset($_SESSION['message']);
        ?>
        <a class="link" href="auth.php">Войти в аккаунт</a>
    </main>
</body>
</html>