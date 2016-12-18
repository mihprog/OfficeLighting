<?php

return array(
    'count-([0-9]+)/page-([0-9]+)/source-([a-z]+)/sort-([\w\.]+)'=> 'employees/index/$1/$2/$3/$4',
    'count-([0-9]+)/page-([0-9]+)/source-([a-z]+)'=> 'employees/index/$1/$2/$3',
    'count-([0-9]+)/page-([0-9]+)'=> 'employees/index/$1/$2',
    'manager/([0-9]+)'=> 'manager/index/$1',
    'room/([0-9]+)/([a-zA-Z]+)'=> 'room/index/$1/$2',
    'room/([0-9]+)'=> 'room/index/$1',
    'employee/([0-9]+)'=> 'employee/index/$1',
    'post' => 'employees/post',
    '' => 'site/index',
);