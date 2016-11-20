<?php
//по ajax-запросу отдаем данные о юзере
require_once 'RegAuth.php';
$data = RegAuth::getUserData();
$data = json_encode($data);
echo $data;