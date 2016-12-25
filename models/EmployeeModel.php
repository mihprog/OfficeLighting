<?php

require_once(ROOT.'/components/ServerApi.php');

class EmployeeModel
{
    public static function getEmployeeData($empId){
        $data = json_encode(array('empId'=>$empId));
        return ServerApi::sendRequest($data,'getemployeedata');
        //return array('name'=>$empId.'name','email'=>$empId.'email','id'=>1);
    }
    public static function sendMessage($empId,$message){
        $data = json_encode(array('empId'=>$empId,'message'=>$message));
        return ServerApi::sendRequest($data,'sendmessage');
        //return 'complete';
    }
}