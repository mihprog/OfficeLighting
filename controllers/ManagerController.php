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
    public function actionRmmess(){
        $messId = $_POST['data'];
        if(ManagerModel::removeMessage($messId))echo $messId;
    }
    public function actionEditdata(){
        $data = json_decode($_POST['data']);
        $newName = $data->name;
        $newTelephone = $data->tel;
        $id = $data->id;
        echo json_encode(ManagerModel::editData($newName,$newTelephone,$id));
    }
    public function actionEditpswd(){

    }
}