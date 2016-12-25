<?php

class ServerApi
{
    //отправляем json по урлу с экшном и получаем json в ответ
    /**
     * @param $jsonData
     * @param $action
     * @return mixed
     */
    public static function sendRequest($jsonData,$action){

        $ch = curl_init('http://officelightingserver.com/'.$action);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonData))
        );

        $result = curl_exec($ch);
        $result = json_decode($result,true);
        return $result;
    }
}