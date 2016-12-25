<?php

return array(
    'count-([0-9]+)/page-([0-9]+)/source-([a-z]+)/sort-([\w\.]+)'=> 'employees/index/$1/$2/$3/$4',
    'count-([0-9]+)/page-([0-9]+)/source-([a-z]+)'=> 'employees/index/$1/$2/$3',
    'count-([0-9]+)/page-([0-9]+)'=> 'employees/index/$1/$2',
    'manager/editdata' => 'manager/editdata',
    'manager/removeMessage' => 'manager/rmmess',
    'manager/([0-9]+)'=> 'manager/index/$1',
    'room/([0-9]+)/([a-zA-Z]+)'=> 'room/room/$1/$2',
    'room/([0-9]+)'=> 'room/index/$1',
    'employee/([0-9]+)/sendmessage'=> 'employee/sendmessage/$1',
    'employee/([0-9]+)'=> 'employee/index/$1',
    'post' => 'employees/post',
    'reg' => 'site/reg',
    'auth' => 'site/auth',
    '' => 'site/index',
);