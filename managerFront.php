<?php
include 'php/manager/ManagerController.php';
include 'php/manager/ManagerModel.php';

$managerModel = new ManagerModel();
$managerController = new ManagerController($managerModel);

$messages = $managerController->getMessagesByManId($_SESSION['managerId']);
$rooms = $managerController->getRoomsByManId($_SESSION['managerId']);
$managerData = $managerController->getManagerData($_SESSION['managerId']);

include 'php/manager/ManagerView.php';