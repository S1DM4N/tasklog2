<?php
session_start();
require_once 'db.php';

$login = $_POST['login'];
$password = md5($_POST['password']);

$check_user = mysqli_query($connect, "SELECT * FROM `auth` WHERE `login_auth` = '$login' AND `password_auth` = '$password'");

if (preg_match("/^[a-zA-Z\d_-]*+$/", $_POST['login'])) {
    if (preg_match("/^[A-Z]{1}[a-zA-Z\d]*[`~!@#$%^&*()_+-={}|:;<>?,.\/\"\'\\\[\]]{1}+$/", $_POST['password'])) {
        if (mysqli_num_rows($check_user) > 0) {
    
            $user = mysqli_fetch_assoc($check_user);
        
            $_SESSION['user'] = [
                "id_auth " => $user['id_auth'],
                "login_auth" => $user['login_auth'],
                "email_auth" => $user['email_auth'],
                "id_type " => $user['id_type ']
            ];

            header('Location: ../index.php');
        } else {
            $_SESSION['message'] = 'Не верный логин или пароль!';
            header('Location: ../auth.php');
        }
    } else {
        $_SESSION['message'] = 'Пароль должен быть на латинице и цифрах, начинаться с заглавной буквы и закачиваться на символ!';
        header('Location: ../auth.php');
    }
} else {
    $_SESSION['message'] = 'Логин должен быть на латинице, на цифрах, а также разделительных символах ( _ и - )!!';
    header('Location: ../auth.php');
}