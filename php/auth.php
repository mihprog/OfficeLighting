<?php
//файл для обработки авторизации
include_once "auth/AuthController.php";
include_once "additionalClasses/Validator.php";

$data = $_POST['regData'];
$data = json_decode($data);

$email = $data->log_email;
$password = $data->log_password;
if(Validator::validEmail($email)&&Validator::validPassword($password)){
    $auth = new AuthController();
    if($auth->auth($email,$password)!=false){
        echo $auth->auth($email,$password);
    }
    else echo 'fail';
}
else{
    echo 'invalid';
}
