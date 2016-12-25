<?php

include_once 'models/RoomModel.php';

class RoomController
{
    public function actionIndex($roomId,$action=''){
        $roomInfo = RoomModel::getRoomInfo($roomId);
        $roomMembers = RoomModel::getRoomMembers($roomId);
        $people = RoomModel::getAllFreeMembers();

        include 'views/RoomView.php';
    }
    public function actionRoom($roomId,$action){
        if($action=='toRoom'){
            $userId = json_decode($_POST['data'])->userId;
            $roomId = json_decode($_POST['data'])->roomId;
            $res = RoomModel::userToRoom($userId,$roomId);
            if(!$res)echo 'fail';
            else echo json_encode($res);
        }
        elseif ($action=='fromRoom'){
            $id = json_decode($_POST['data'])->id;
            $res = RoomModel::userFromRoom($id);
            if(!$res)echo 'fail';
            else echo json_encode($res);
        }
        elseif($action=='edit_room_name'){
            $newName = json_decode($_POST['data'])->name;
            $id = json_decode($_POST['data'])->id;
            if(RoomModel::setRoomName($newName,$id))echo $newName;
            else echo 'fail';
        }
        elseif ($action=='delRoom'){
            $res = RoomModel::delRoom($roomId);
            if(!$res)echo 'fail';
            else echo json_encode($res);
        }
        elseif ($action=='changeLight'){
            $newLight = $_POST['data'];
            $res = RoomModel::changeLight($newLight,$roomId);
            if(!$res)echo 'fail';
            else echo 'complete';
        }
    }
}