<?php

require_once(ROOT.'/components/ServerApi.php');

class RoomModel
{
    public static function getRoomInfo($roomId){
        $data = json_encode(array('roomId'=>$roomId));
        return ServerApi::sendRequest($data,'roominfo');
    }
    public static function getAllFreeMembers(){
        return ServerApi::sendRequest('','getfreeemp');
    }
    public static function getRoomMembers($roomId){
        $data = json_encode(array('roomId'=>$roomId));
        return ServerApi::sendRequest($data,'roommembers');
    }
    public static function setRoomName($newName,$roomId){
        $data = json_encode(array('name'=>$newName,'id'=>$roomId));
        $res = ServerApi::sendRequest($data,'setroomname');
        return $res;
    }
    public static function userFromRoom($id){
        $data = json_encode(array('id'=>$id));
        $res = ServerApi::sendRequest($data,'fromroom');
        if(!isset($res['error'])) return $res;
        else return false;
    }
    public static function userToRoom($userId,$roomId){
        $data = json_encode(array('userid'=>$userId,'roomid'=>$roomId));
        $res = ServerApi::sendRequest($data,'toroom');
        if(!isset($res['error'])) return $res;
        else return false;
    }
    public static function delRoom($roomId){
        $data = json_encode(array('roomId'=>$roomId));
        $res = ServerApi::sendRequest($data,'delroom');
        if(!isset($res['error'])) return $res;
        else return false;
    }
    public static function changeLight($newLight,$roomId){
        $data = json_encode(array('newLight'=>$newLight,'roomId'=>$roomId));
        $res = ServerApi::sendRequest($data,'light');
        if(!isset($res['error'])) return true;
        else return false;
    }

}