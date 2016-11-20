<?php
include_once "auth/AuthController.php";
include_once "auth/AuthModel.php";
include_once "additionalClasses/Validator.php";

//получаем данные с клиента
$data = json_decode($_POST['regData']);
$dataReg = $_POST['regData'];

$name = $data->reg_name;
$email = $data->reg_email;
$telephone = $data->reg_telephone;
$password = $data->reg_password;
$role = $data->reg_role;

//проверяем их валидность и возвращаем fail в случае невалидности данных
if(Validator::validName($name)==true&&Validator::validEmail($email)==true&&Validator::validNumber($telephone)==true&&
    Validator::validPassword($password)==true)
{
    //вызов контроллера
    $authController = new AuthController();
    $result = $authController->register($dataReg);
    if(!isset($result['error'])) {
        echo 'complete';
    }
    else echo $result['error'];
}
else
{
    echo 'fail';
}