<?php

include_once ('models/EmployeeModel.php');
class EmployeeController
{
    public function actionIndex($empId){
        $empData = EmployeeModel::getEmployeeData($empId);
        include_once ('views/EmployeeView.php');
    }
    public function actionSendmessage($empId){
        $message = $_POST['data'];
        echo EmployeeModel::sendMessage($empId,$message);
    }
}