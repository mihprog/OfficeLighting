<?php

require_once(ROOT.'/components/ServerApi.php');

class SiteController
{
    public function actionIndex(){
        include_once('views/index.html');
    }
    public function actionReg(){
        echo ServerApi::sendRequest($_POST['regData'],'reg');
    }
}