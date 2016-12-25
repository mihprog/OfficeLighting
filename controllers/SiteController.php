<?php


class SiteController
{
    public function actionIndex(){
        include_once('views/index.html');
    }
    public function actionTest(){
        $data = array('test1'=>'test1','test2'=>'test2');
        $data_string = json_encode($data);

        $ch = curl_init('http://officelightingserver.com/');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );

        $result = curl_exec($ch);
        $result = json_decode($result,true);
        var_dump($result);
    }
}