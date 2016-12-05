<?php
include_once 'php/room/RoomController.php';
include_once 'php/room/RoomModel.php';
$roomModel = new RoomModel();
$roomController = new RoomController($roomModel);

if(isset($_GET['action'])){
    if($_GET['action']=='edit_room_name'){
        $newName = json_decode($_POST['data'])->name;
        if($roomController->setRoomName($newName))echo $newName;
        else echo 'fail';
    }
    elseif ($_GET['action']=='fromRoom'){
        $id = json_decode($_POST['data'])->id;
        $res = $roomController->userFromRoom($id);
        if(!$res)echo 'fail';
        else echo json_encode($res);
    }
    elseif ($_GET['action']=='toRoom'){
        $userId = json_decode($_POST['data'])->userId;
        $roomId = json_decode($_POST['data'])->roomId;
        $res = $roomController->userToRoom($userId,$roomId);
        if(!$res)echo 'fail';
        else echo json_encode($res);
    }
    elseif ($_GET['action']=='delRoom'){
        $roomId = json_decode($_POST['data'])->id;
        $res = $roomController->delRoom($roomId);
        if(!$res)echo 'fail';
        else echo json_encode($res);
    }
}
else{
    $roomInfo = $roomController->getInfo($_GET['roomId']);
    $roomMembers = $roomController->getRoomMembers($_GET['roomId']);
    $people = $roomController->getAllMembers();
    include 'php/room/RoomView.php';
}
