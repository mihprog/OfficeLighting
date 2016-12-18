<?php

//общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);

//подключение файлов системы
define('ROOT', dirname(__FILE__));
define('HTTP_SERVER', 'http://OfficeLighting.com');
require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/components/DB.php');

//Вызов роутинга
$router = new Router();
$router->run();

