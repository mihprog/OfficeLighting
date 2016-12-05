<?php

class RoomModel
{
    public function getRoomInfo($roomId){
        return array('roomName'=>'room1','roomId'=>'1','membCount'=>'10','messCount'=>'13','light'=>'150');
    }
    public function getAllFreeMembers(){
        return array('2'=>array('id'=>2,'name'=>'member2','description'=>'member2 description'),'3'=>array('id'=>3,'name'=>'member3','description'=>'member3 description'));

    }
    public function getRoomMembers($roomId){
        return array('0'=>array('id'=>0,'name'=>'member0','description'=>'member0 description'),'1'=>array('id'=>1,'name'=>'member1','description'=>'member1 description'));
    }
    public function setRoomName($newName){
        //метод-заглушка для изменения названия комнаты
        return true;
    }
    public function userFromRoom($id){
        //метод-заглушка для удаления пользователя из комнаты
        return array('id'=>$id,'roomId'=>'0','name'=>'member0','description'=>'member0 description');
    }
    public function userToRoom($userId,$roomId){
        return array('id'=>$userId,'roomId'=>$roomId,'name'=>'member0','description'=>'member0 description');
    }
    public function delRoom($roomId){
        return array('managerId'=>'1');
    }

}