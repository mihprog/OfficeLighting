<?php

include_once 'models/ManagerModel.php';

class ManagerController
{
    public function actionIndex($managerId){
        $messages = ManagerModel::getMessagesByManId($managerId);
        $rooms = ManagerModel::getRoomsByManId($managerId);
        $managerData = ManagerModel::getManagerData($managerId);

        include_once 'views/ManagerView.php';
    }
}