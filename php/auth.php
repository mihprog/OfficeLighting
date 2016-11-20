<?php
//файл для обработки авторизации
include "RegAuth.php";

$data = $_POST['regData'];
$data = json_decode($data);

$email = $data->log_email;
$password = $data->log_password;
RegAuth::auth($email,$password);
//echo $data;