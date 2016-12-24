<?php

class EmployeeModel
{
    public static function getEmployeeData($empId){
        return array('name'=>$empId.'name','email'=>$empId.'email','id'=>1);
    }
    public static function sendMessage($empId,$message){
        return 'complete';
    }
}