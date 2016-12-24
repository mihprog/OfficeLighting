<?php

class RoomModel
{
    public static function getRoomInfo($roomId){
        return array('roomName'=>'room1','roomId'=>'1','membCount'=>'10','messCount'=>'13','light'=>'150','managerId'=>'0');
    }
    public static function getAllFreeMembers(){
        return array('2'=>array('id'=>2,'name'=>'member2','description'=>'member2 description'),'3'=>array('id'=>3,'name'=>'member3','description'=>'member3 description'));

    }
    public static function getRoomMembers($roomId){
        return array('0'=>array('id'=>0,'name'=>'member0','description'=>'member0 description'),'1'=>array('id'=>1,'name'=>'member1','description'=>'member1 description'));
    }
    public static function setRoomName($newName){
        //метод-заглушка для изменения названия комнаты
        return true;
    }
    public static function userFromRoom($id){
        //метод-заглушка для удаления пользователя из комнаты
        return array('id'=>$id,'roomId'=>'0','name'=>'member0','description'=>'member0 description');
    }
    public static function userToRoom($userId,$roomId){
        return array('id'=>$userId,'roomId'=>$roomId,'name'=>'member0','description'=>'member0 description');
    }
    public static function delRoom($roomId){
        return array('managerId'=>'1');
    }
    public static function changeLight($newLight){
        return true;
    }

}