<?php

class RoomModel
{
    public function getRoomInfo($roomId){
        return array('roomName'=>'room1','managerId'=>'1','membCount'=>'10','messCount'=>'13','light'=>'150');
    }
    public function getAllFreeMembers(){
        return array('2'=>array('name'=>'member2','description'=>'member2 description'),'3'=>array('name'=>'member3','description'=>'member3 description'));

    }
    public function getRoomMembers($roomId){
        return array('0'=>array('name'=>'member0','description'=>'member0 description'),'1'=>array('name'=>'member1','description'=>'member1 description'));
    }

}