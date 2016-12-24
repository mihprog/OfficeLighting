<?php

class ManagerModel
{
    public static function getMessagesByManId($id){
        return array('1'=>array('id'=>'1','person'=>'person1','message'=>'we need help!'),
            '2'=>array('id'=>'2','person'=>'person2','message'=>'we need water!'));
    }
    public static function getRoomsByManId($id){
        return array('1'=>array('id'=>'1','name'=>'room1','numPersons'=>'5'),
            '2'=>array('id'=>'2','name'=>'room2','numPersons'=>'7'));
    }
    public static function getManagerData($id){
        return array('name'=>'Manager1','email'=>'manager@man.com','telephone'=>'+380963803464');
    }
    public static function removeMessage($id){
        return true;
    }
    public static function editData($name,$telephone){
        return array('newName'=>'newManagerName','newTel'=>'+380963803463');
    }
}