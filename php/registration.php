<?php
include 'RegAuth.php';

//получаем данные с клиента
$data = json_decode($_POST['regData']);
$dataReg = $_POST['regData'];

$name = $data->reg_name;
$email = $data->reg_email;
$telephone = $data->reg_telephone;
$password = $data->reg_password;

//проверяем их валидность и возвращаем fail в случае невалидности данных
if(RegAuth::validName($name)==true&&RegAuth::validEmail($email)==true&&RegAuth::validNumber($telephone)==true&&
RegAuth::validPassword($password)==true)
{
    RegAuth::register($dataReg);
}
else
{
    echo 'fail';
}
