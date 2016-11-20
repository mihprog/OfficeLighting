<?php
//скрипт, удаляющий сессию и переносящий юзера на главную страничку
session_start();
unset($_SESSION['hash']);
unset($_SESSION['emailHash']);
setcookie('hash','',time() - 3600,'/');
setcookie('emailHash','',time() - 3600,'/');
header("Location:../index.php");