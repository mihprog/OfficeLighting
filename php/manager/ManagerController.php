<?php
class ManagerController
{
    public $managerModel;

    public function __construct($managerModel){
        $this->managerModel = $managerModel;
    }
    public function getMessagesByManId($managerId){

        $messages = $this->managerModel->getMessagesByManId($managerId);
        return $messages;
    }
    public function getRoomsByManId($managerId){
        $rooms = $this->managerModel->getRoomsByManId($managerId);
        return $rooms;
    }
    public function getManagerData($managerId){
        $managerData = $this->managerModel->getManagerData($managerId);
        return $managerData;
    }
}