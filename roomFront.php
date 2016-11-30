<?php
include_once 'php/room/RoomController.php';
include_once 'php/room/RoomModel.php';

$roomModel = new RoomModel();
$roomController = new RoomController($roomModel);

$roomInfo = $roomController->getInfo($_GET['roomId']);
$roomMembers = $roomController->getRoomMembers($_GET['roomId']);
$people = $roomController->getAllMembers();

include 'php/room/RoomView.php';