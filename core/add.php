<?php 
session_start();
require_once 'db.php';

$login_cus = $_SESSION['user']['user_login'];
$email_cus = $_SESSION['user']['user_email'];
$login_exe = $_POST['login_exe'];
$email_exe = $_POST['email_exe'];
$name_task = $_POST['name_task'];
$text_task = $_POST['text_task'];
$date_star_task = $_POST['date_star_task'];
$date_end_task = $_POST['date_end_task'];

mysqli_query($connect, "INSERT INTO `task` (`task_id`, `task_login_customer`, `task_email_customer`, `task_login_executor`, `task_email_executor`, `task_name`, `task_text`, `task_start_date`, `task_end_date`) VALUES (NULL, '$login_cus', '$email_cus', '$login_exe', '$email_exe', '$name_task', '$text_task', '$date_star_task', '$date_end_task') ");

header('Location: ../index.php');