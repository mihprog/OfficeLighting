<?php

require_once(ROOT.'/components/ServerApi.php');

class ManagerModel
{
    public static function getMessagesByManId($id){
        $data = json_encode(array('id'=>$id));
        $res = ServerApi::sendRequest($data,'getmess');
        return $res;
    }
    public static function getRoomsByManId($id){
        $data = json_encode(array('id'=>$id));
        $res = ServerApi::sendRequest($data,'getrooms');
        return $res;
    }
    public static function getManagerData($id){
        $data = json_encode(array('id'=>$id));
        $res = ServerApi::sendRequest($data,'getmanager');
        return $res;
    }
    public static function removeMessage($id){
        $data = json_encode(array('id'=>$id));
        $res = ServerApi::sendRequest($data,'rmmess');
        return true;
    }
    public static function editData($name,$telephone,$id){
        $data = json_encode(array('name'=>$name,'tel'=>$telephone,'id'=>$id));
        $res = ServerApi::sendRequest($data,'editman');
        return array('newName'=>$name,'newTel'=>$telephone);
    }
}