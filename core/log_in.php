<?php 
session_start();
require_once 'db.php';


$login = $_POST['login'];
$email = $_POST['email'];
$user_rule = $_POST['user_rule'];
$password = $_POST['password'];
$conf_password = $_POST['conf_password'];
if (preg_match("/^[a-zA-Z\d_-]*+$/", $_POST['login'])) {
    if (preg_match("/^[A-Z]{1}[a-zA-Z\d`~!@#$%^&*()_+-={}|:;<>?,.\/\"\'\\\[\]]*[`~!@#$%^&*()_+-={}|:;<>?,.\/\"\'\\\[\]]{1}+$/", $_POST['password'])) {
        if (mysqli_num_rows(mysqli_query($connect, "SELECT `user_login` FROM `db_user` WHERE `user_login` = '$login'")) == 0) {
            if (mysqli_num_rows(mysqli_query($connect, "SELECT `user_email` FROM `db_user` WHERE `user_email` = '$email'")) == 0) {    
                if (strlen($_POST['password']) >= 8) {
                    if ($password === $conf_password) {
                        $password = md5($password);
                        
                        mysqli_query($connect, "INSERT INTO `db_user` (`user_id`, `user_login`, `user_email`, `id_rule`, `user_password`) VALUES (NULL, '$login', '$email', '$user_rule', '$password')");
                        $_SESSION['message'] = 'Регистрация прошла успешно!';
                        header('Location: ../auth.php');

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