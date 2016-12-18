<?php

include_once 'models/RoomModel.php';

class RoomController
{
    public function actionIndex($roomId,$action){
        $roomInfo = RoomModel::getRoomInfo($roomId);
        $roomMembers = RoomModel::getRoomMembers($roomId);
        $people = RoomModel::getAllFreeMembers();

        include 'views/RoomView.php';
    }
}