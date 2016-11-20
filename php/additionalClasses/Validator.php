<?php

class Validator
{
    /*вход - строка с именем юзера
     * выход - true или тип ошибки
     */
    static public function validName($name)
    {
        if(strlen($name)===0)return 'name_zero';
        elseif (strlen($name)>30)return 'name_long';
        else return true;
    }

    /*вход - строка с email
     * выход - true или false
     */
    static public function validEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;
        return true;
    }

    //Валидация телефонного номера
    static public function validNumber($tel)
    {
        return is_numeric($tel);
    }

    /*валидация пароля. Вход - строка
     * выход - true или название ошибки
     */
    static public function validPassword($password)
    {
        if(strlen($password)===0)return 'password_zero';
        elseif (strlen($password)>30)return 'password_long';
        else return true;
    }
}