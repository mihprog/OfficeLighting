<?php

class RoomController
{
    public $roomModel;
    public function __construct($model){
        $this->roomModel = $model;
    }

    public function getInfo($id){
        $info = $this->roomModel->getRoomInfo($id);
        return $info;
    }
    public function getAllMembers(){
        $members = $this->roomModel->getAllFreeMembers();
        return $members;
    }
    public function getRoomMembers($id){
        $members = $this->roomModel->getRoomMembers($id);
        return $members;
    }
    public function setRoomName($name){
        return $this->roomModel->setRoomName($name);
    }
    public function userFromRoom($id){
        return $this->roomModel->userFromRoom($id);
    }
    public function userToRoom($userId,$roomId){
        return $this->roomModel->userToRoom($userId,$roomId);
    }
    public function delRoom($roomId){
        return $this->roomModel->delRoom($roomId);
    }

}