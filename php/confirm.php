<?php
//файл, получающий get-запрос о подтверждении регистрации
include "RegAuth.php";
$hash = $_GET['hash'];
$md5Email = $_GET['md5'];

RegAuth::confirmReg($hash,$md5Email);

header("Location:../index.php");