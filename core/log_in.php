<?php 
session_start();
require_once 'db.php';

$surname = $_POST['surname'];
$name = $_POST['name'];
$patronymic = $_POST['patronymic'];
$login = $_POST['login'];
$email = $_POST['email'];
$type = $_POST['user_rule'];
$password = $_POST['password'];
$conf_password = $_POST['conf_password'];
if (preg_match("/^[а-яё]*+$/", $_POST['surname'] & $_POST['name'] & $_POST['patronymic'])) {
    if (preg_match("/^[a-zA-Z\d_-]*+$/", $_POST['login'])) {
        if (preg_match("/^[A-Z]{1}[a-zA-Z\d`~!@#$%^&*()_+-={}|:;<>?,.\/\"\'\\\[\]]*[`~!@#$%^&*()_+-={}|:;<>?,.\/\"\'\\\[\]]{1}+$/", $_POST['password'])) {
            if (mysqli_num_rows(mysqli_query($connect, "SELECT `login_auth` FROM `auth` WHERE `login_auth` = '$login'")) == 0) {
                if (mysqli_num_rows(mysqli_query($connect, "SELECT `email_auth` FROM `auth` WHERE `email_auth` = '$email'")) == 0) {
                    if (strlen($_POST['password']) >= 8) {
                        if ($password === $conf_password) {
                            $password = md5($password);
                            
                            mysqli_query($connect, "INSERT INTO `auth` (`id_auth`, `login_auth`, `email_auth`, `password_auth`, `id_type`) VALUES (NULL, '$login', '$email', '$password', '$type')");
                            $_SESSION['message'] = 'Регистрация прошла успешно!';
                            // header('Location: ../auth.php');

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