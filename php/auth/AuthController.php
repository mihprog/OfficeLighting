<?php
include_once "AuthModel.php";

class AuthController
{
    //проверка уникальности емейла
    private function uniqueEmail($email){

        return true;
    }
    //регистрируем юзера
    public function register($userData){
        $result = array();
        if($this->uniqueEmail($userData['email'])){
            //типо регистрируем
            $authModel = new AuthModel();
            return true;
        }
        else {
            $result['error'] = 'emailInUse';
            return $result;
        }
    }

    public function auth($email,$password){
        return'completed';
    }
}