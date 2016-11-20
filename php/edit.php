<?php
//файл, отвечающий на ajax-запрос и редактирующий данные пользователя
include 'RegAuth.php';

$data = $_POST['regData'];
RegAuth::editData($data);