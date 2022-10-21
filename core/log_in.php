<?php 
// Подключение БД и сессии
session_start();
require_once 'db.php';

// Занесение значений из формы в переменные
$surname = $_POST['surname'];
$name = $_POST['name'];
$patronymic = $_POST['patronymic'];
$login = $_POST['login'];
$email = $_POST['email'];
$type = $_POST['user_rule'];
$password = $_POST['password'];
$conf_password = $_POST['conf_password'];

// Проверка условий

// Проверка на содержание в ФИО символов на крирлице и с заглавной буквы
if (preg_match("/[А-ЯЁ]{1}[а-яё]*/", $_POST['surname'] & $_POST['name'] & $_POST['patronymic'])) {
    // Проверка на содержание в логине символов на латинице и цифры, а также на разделительных знаков ( _ и -)
    if (preg_match("/^[a-zA-Z\d_-]*+$/", $_POST['login'])) {
        // Проверка на содержание в пароле симовлов на латиницеи и цифры, которые начинаются с заглавной буквы и закачиваются на знак.
        if (preg_match("/^[A-Z]{1}[a-zA-Z\d`~!@#$%^&*()_+-={}|:;<>?,.\/\"\'\\\[\]]*[`~!@#$%^&*()_+-={}|:;<>?,.\/\"\'\\\[\]]{1}+$/", $_POST['password'])) {
            // Проверка на существовани логина и электронной почты
            if (mysqli_num_rows(mysqli_query($connect, "SELECT `login_auth` FROM `auth` WHERE `login_auth` = '$login'")) == 0) {
                if (mysqli_num_rows(mysqli_query($connect, "SELECT `email_auth` FROM `auth` WHERE `email_auth` = '$email'")) == 0) {
                    // Проверерка на длину пароля
                    if (strlen($_POST['password']) >= 8) {
                        if ($password === $conf_password) {
                            // Шифрование пароля
                            $password = md5($password);
                            // Запрос на запись введенных данных в БД
                            mysqli_query($connect, "INSERT INTO `auth` (`id_auth`, `login_auth`, `email_auth`, `password_auth`, `id_type`) VALUES (NULL, '$login', '$email', '$password', '$type')");
                            // Занесенние в сессию сообщения об успешной регистрации
                            $_SESSION['message'] = 'Регистрация прошла успешно!';
                            header('Location: ../auth.php');
                        
                        // Занесение в сессию сообщений об ошибке:
                        } else {
                            $_SESSION['message'] = 'Пароли не совпадают!';
                            header('Location: ../reg.php');
                        }
                    } else {
                        $_SESSION['message'] = 'Пароль должен быть не менее 8 символов!';
                        header('Location: ../reg.php');
                    }
                } else {
                    $_SESSION['message'] = 'Данная почта уже зарегестрирована!';
                    header('Location: ../reg.php');
                }
            } else {
                $_SESSION['message'] = 'Такой логин уже существует!';
                header('Location: ../reg.php');
            }
        } else {
            $_SESSION['message'] = 'Пароль должен быть на латинице, начинаться с заглавной буквы, а заканчиваться на символе!';
            header('Location: ../reg.php');
        }
    } else {
        $_SESSION['message'] = 'Логин может содержать в себе только латинские буквы, цифры, а также разделительные символы ( _ и - )!';
        header('Location: ../reg.php');
    }
} else {
    $_SESSION['message'] = 'ФИО пишется только на кириллице с заглавной буквы!';
        header('Location: ../reg.php');
}